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
        if (!file_exists('../../../alpha/config/kConf.php.orig'))
            copy('../../../alpha/config/kConf.php', '../../../alpha/config/kConf.php.orig');
        $kconf = file_get_contents('../../../alpha/config/kConf.php');
        $kconf = str_replace($orig_server_line, $new_server_line, $kconf);
        $kconf = str_replace($orig_cdn_line, $new_cdn_line, $kconf);
        $result = file_put_contents('../../../alpha/config/kConf.php', $kconf);
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

    <div class="server_settings">
    <form method="POST">
        <table cellspacing="0" cellpadding="0" border="0">
            <tr class="even">
                <td><label for="host">Server URL</label></td>
                <td><input type="text" name="host" value="<? echo $server_host ?>" />
                    <div class="desc">the public address of this server. will be used by the flash components<br />
                    in intranet applications this host should be accessable from the intranet.
                    </div>                
                </td>
            </tr>
            <tr>
                <td><label for="iscdnhost">Streaming Settings:</label></td>
                <td>
                    <input onclick="toggle_cdnhost(0);"  type="radio" name="iscdnhost" value="0" <? echo ($cdn_host == $server_host)? 'checked="checked"': ''; ?> /> Content will be streamed from this KCE Server<br />
                    <input onclick="toggle_cdnhost(1);" type="radio" name="iscdnhost" value="1" <? echo ($cdn_host != $server_host)? 'checked="checked"': ''; ?> /> Content will be streamed from a Content Delivary Network (CDN)<br />
                    <label for="cdnhost">CDN Address:</label>
                    <input type="text" <? echo ($cdn_host == $server_host)? 'disabled="disabled"': ''; ?> id="field_cdnhost" name="cdnhost" value="<? echo $cdn_host ?>" />
                    <div class="desc"> the CDN must support "Pull" mode, so that upon request content will be pulled by the CDN from this KCE server.</div>
                </td>
            </tr>
            <tr class="even">
                <td><label for="encoding">Encoding Settings:</label></td>
                <td>
                  <input type="radio" name="encoding" value="0" checked="checked" /> Open Source encoder - Content will be encoded on this KCE Server<br />
                  <input type="radio" disabled="disabled" name="encoding" value="" /> Premium encoder - <span class="soon">Coming Soon...</span><br />
                  <div class="desc">premium encoder allows better video quality, creates smaller files and smother watching.</div>
                </td>
            </tr>            
            <tr>
                <td colspan="2"><input type="submit" value="save" name="save_settings" /></td>
            </tr>
        </table>
    </form>
    </div>
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