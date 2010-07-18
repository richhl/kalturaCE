<?php
require_once("systembase.php");
if (!kConf::get('system_allow_edit_kConf'))
{
    header("Location: index.php");
}
$server_host = kConf::get('www_host');
$cdn_host = kConf::get('cdn_host');
if(isset($_POST['save_settings']))
{
    $orig_server_line = '"www_host" => "'.$server_host.'",';
    $new_server_line = '"www_host" => "'.fix_www_host($_POST['host']).'",';
    $orig_cdn_line = '"cdn_host" => "'.$cdn_host.'",';
    if ($_POST['cdnhost'] && $_POST['iscdnhost'] == 1)
    {
        $new_cdn_host = fix_www_host($_POST['cdnhost']);
    }
    else
    {
        if ($_POST['iscdnhost'] == 0)
            $new_cdn_host = $server_host;
    }
    
    $new_cdn_line = '"cdn_host" => "'.$new_cdn_host.'",';
    
    if ( ($orig_server_line != $new_server_line &&  $_POST['host']) ||
         ($orig_cdn_line != $new_cdn_line && ($_POST['cdnhost'] || $_POST['iscdnhost'] == 0)))
    {
    	$source_file = '../../../alpha/config/kConf.php';
		if ( file_exists( $source_file ))
		{
			kLog::log(__METHOD__." - $source_file file exists");	
		}
		else
		{
			kLog::log(__METHOD__." - $source_file file doesnt exist");	
		}
		
        if (!file_exists('../../../alpha/config/kConf.php.orig'))
            copy($source_file, '../../../alpha/config/kConf.php.orig');
            
        $kconf = file_get_contents($source_file);
        $kconf = str_replace($orig_server_line, $new_server_line, $kconf);
        $kconf = str_replace($orig_cdn_line, $new_cdn_line, $kconf);
        $result = file_put_contents($source_file, $kconf);
        $server_host = fix_www_host($_POST['host']);
        $cdn_host = $new_cdn_host;
    }
}
require_once('header.php');
?>
    <script>
        function toggle_cdnhost(to_state)
        {
            if(to_state)
            {
                document.getElementById('field_cdnhost').disabled = '';
            }
            else
            {
                document.getElementById('field_cdnhost').disabled = 'disabled';
            }
        }
    </script>


    <form method="POST" id="server_settings">
        <table cellspacing="0" cellpadding="0" border="0">
            <tr class="even">
                <td><label for="host">Server URL:</label></td>
                <td>
				 <div>The public address of this server.&nbsp; Used by Kaltura's Flash components.&nbsp; Should
				   be accessible from the intranet for intranet applications.<br />
                    </div>
				 <input type="text" name="host" value="<?php echo $server_host ?>" />
                    <span>For example: <ul><li>10.0.0.27/kalturaCE</li><li>www.mykalturadomain.com (kalturaCE in installed on a virtualHost)</li></ul></span>
				</td>
            </tr>
            <tr>
                <td><label for="iscdnhost">Streaming Settings:</label></td>
                <td>
                    <div>The CDN must support &quot;Pull&quot; mode, so that upon request content will be pulled by the CDN from this KCE server.</div>
                    <p><input onclick="toggle_cdnhost(0);"  type="radio" name="iscdnhost" value="0" <?php echo ($cdn_host == $server_host)? 'checked="checked"': ''; ?> /> Content will be streamed from this KCE Server</p>
                    <p><input onclick="toggle_cdnhost(1);" type="radio" name="iscdnhost" value="1" <?php echo ($cdn_host != $server_host)? 'checked="checked"': ''; ?> /> 
                    Content will be streamed from a Content Delivery Network (CDN):<br /> &nbsp; &nbsp; &nbsp; <label>CDN Address: <input type="text" <?php echo ($cdn_host == $server_host)? 'disabled="disabled"': ''; ?> id="field_cdnhost" name="cdnhost" value="<?php echo $cdn_host ?>" /></label></p>
			  </td>
            </tr>
            <tr class="even">
                <td><label for="encoding">Encoding Settings:</label></td>
                <td>
                  <div>The premium encoder provides better video quality and smoother playback as well as smaller files.</div>
                  <p><input type="radio" name="encoding" value="0" checked="checked" /> Open Source encoder - Content will be encoded on this KCE Server</p>
				  <p><input type="radio" disabled="disabled" name="encoding" value="" /> Premium encoder - Coming Soon...</p>
				</td>
            </tr>
        </table>
		<input type="submit" value=" Save " name="save_settings" id="save_settings" />
    </form>

<?php
require_once('footer.php');

function fix_www_host($host)
{
    $host = str_replace('http://', '', $host);
    $host = str_replace('https://', '', $host);
    $host = rtrim($host,'/');
    $host = rtrim($host);
    return $host;
}
?>