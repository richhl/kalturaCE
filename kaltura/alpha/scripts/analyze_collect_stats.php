<?

function parse_vars($s)
{
	$params = explode("&", $s);
	$vars = array();
	foreach($params as $param)
	{
		$pair = explode("=", $param, 2);
		if (count($pair) == 2)
			$vars[$pair[0]] = $pair[1];
	}

	return $vars;
}


$stderr = fopen("php://stderr", "w");

$i = 0;

$file_name = @$argv[1];
if ($file_name)
{
	fprintf($stderr, "\nfilename: $file_name\n");
	$f = @fopen($file_name, "r");
	if (!$f)
	{
		fprintf(stderr, "no file or file not found [$file_name]\n");
		die;
	}
}
else
	$f = fopen("php://stdin", "w");


while(!feof($f))
{
	++$i;
	if ($i % 10000 == 0)
		fprintf($stderr, "$i\r");

	$s = fgets($f);
	if (!strstr($s, "collectstats"))
		continue;

	$arr = explode(" ", $s);
	$ip = ip2long($arr[0]);
	$date = $arr[3]." ".$arr[4];
	$url = $arr[6];
	
	$uv = @$arr[count($arr) - 2];
		if (strpos($uv, '"uv_') === 0)
	$uv = substr($uv, 4, 32);
	else
		$uv = "";
                
	$date = strtotime(substr($date, 1, strlen($date) - 2));
	$date = strftime("%Y-%m-%d %H:%M:%S", $date);

	$s = urldecode($url);
	$s = parse_url($s, PHP_URL_QUERY);

	$vars = parse_vars($s);

	$partner_id = @$vars["partner_id"];
	$obj_type = @$vars["obj_type"];

	if ($obj_type == "entry")
	{
		$extra_info = @$vars["extra_info"];
		$evars = parse_vars($extra_info);

		if (!array_key_exists("obj_id", $vars) || !array_key_exists("command", $vars))
		{
			fprintf($stderr, "\n%s\n", $s);
			continue;
		}
			
		$entry_id = $vars["obj_id"];

		$command = $vars["command"];

		$widget_id = @$evars["widgetId"];
		
		if (strpos($entry_id, "'") !== false || strpos($widget_id, "'") !== false)
			continue;

		print "INSERT INTO collect_stats VALUES(".
		"$ip,'$date','$partner_id','$entry_id','$widget_id','$command', '$uv');\n";
		//print $ip." ".$date." ";
		//print "$partner_id $entry_id [$command] [$widget_id]\n";
	}

}


fclose($stderr);
fclose($f);

?>
