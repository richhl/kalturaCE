<?
function replace_root($file_path, $server_root)
{
  if (substr_count($file_path, "kae_generic_generic.xml") > 0)
	return;
	
  if (substr_count($file_path, "kae_generic_generic_no_thumbnail.xml") > 0)
	return;

  if (substr_count($file_path, "kse_samplekit.xml") > 0)
        return;
	
  if (substr_count($file_path, "se_wordpress.xml") > 0)
        return;
	
  if (substr_count($file_path, "se_drupal.xml") > 0)
        return;

  $data = file_get_contents($file_path);
  //avoid replacement of static urls
  $data = str_replace("kaltura.com/content", "kaltura.com_content", $data);
  // replace /content with /SERVER_ROOT/content
  $data = str_replace("/content/", "$server_root/content/", $data);
  // restore static urls
  $data = str_replace("kaltura.com_content", "kaltura.com/content", $data);
  // save file
  file_put_contents($file_path, $data);
}
