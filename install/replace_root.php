<?
if (substr_count($argv[1], "kae_generic_generic.xml") > 0)
	exit();
	
if (substr_count($argv[1], "kae_generic_generic_no_thumbnail.xml") > 0)
	exit();

if (substr_count($argv[1], "kse_samplekit.xml") > 0)
    exit();
	
if (substr_count($argv[1], "se_wordpress.xml") > 0)
    exit();
	
if (substr_count($argv[1], "se_drupal.xml") > 0)
    exit();

$data = file_get_contents($argv[1]);
$data = str_replace("/content/", "$argv[2]/content/", $data);
file_put_contents($argv[1], $data);
?>
