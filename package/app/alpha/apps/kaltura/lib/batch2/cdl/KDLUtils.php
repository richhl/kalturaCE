<?php

class KDLUtils
{
	/* ------------------------------
	 * trima
	 */
	public static function trima($str)
	{
		$str = str_replace(array("\n", "\r", "\t", " ", "\o", "\xOB"), '', $str);
		return $str;
	}

	/* ------------------------------
	 * convertDuration2msec
	 */
	public static function convertDuration2msec($str)
	{
	//echo $str;
		preg_match_all("/(([0-9]*)h ?)?(([0-9]*)mn ?)?(([0-9]*)s ?)?(([0-9]*)ms ?)?/",
			$str, $res);

		$hour = @$res[2][0];
		$min  = @$res[4][0];
		$sec  = @$res[6][0];
		$msec = @$res[8][0];
	//echo "<br>Time ". $hour . "hr:".$min . "mn:" . $sec . "sec:". $msec ."msec<br>";
		$rv = ($hour*3600 + $min*60 + $sec)*1000 + $msec;
		settype($rv, "integer");
		return $rv;
	}

	/* ------------------------------
	 * convertValue2kbits
	 */
	public static function convertValue2kbits($str)
	{
		preg_match_all("/(([0-9.]*)b ?)?(([0-9.]*)k ?)?(([0-9.]*)m ?)?(([0-9.]*)g ?)?/",
			$str, $res);

		if(@$res[2][0]!=="")
			$kbps=@$res[2][0]/1024;
		else if(@$res[4][0]!=="")
			$kbps=@$res[4][0];
		else if(@$res[6][0]!=="")
			$kbps=@$res[6][0]*1024;
		else if(@$res[8][0]!=="")
			$kbps=@$res[8][0]*1048576;
		settype($kbps, "float");
		return $kbps;
	}

	/* ------------------------------
	 * function arrayToString
	 */
	public static function arrayToString($arr) {
		$str = null;
		$prevKey = null;
		foreach ($arr as $key => $item){
			if($str){
				$str = $str.",";
			}
			if(is_array($item)) {
				if($prevKey && $key==$prevKey) {
					$str = $str.",".KDLUtils::arrayToString($item);
				}
				else
					$str = $str.$key."=>".KDLUtils::arrayToString($item);
			}
			else {
				if($prevKey && $key==$prevKey) {
					$str = $str.",".$item;
				}
				else {
					$str = $str.$key."=>".$item;
				}
			}
			$prevkey = $key;
		}
		return $str;
	}
	
	/* ------------------------------
	 * function arrayToString
	 */
	public static function AddXMLElement(SimpleXMLElement $dest, SimpleXMLElement $source)
    {
        $new_dest = $dest->addChild($source->getName(), $source[0]);

		foreach($source->attributes() as $name => $val) {
			$new_dest->addAttribute($name, $val);
		} 
        foreach ($source->children() as $child) {
            self::AddXMLElement($new_dest, $child);
        }
    }
	
}
	
?>