<?php
include('common.php');
$GA_ACTION = "generalInfo";
session_start();
foreach($_POST as $field => $value)
{
  $_SESSION['kdb_defaults'] = TRUE;
  if (substr($field, 0, 3) == 'kdb')
    $_SESSION[$field] = $value;
}

validate_mysql_connection();

include('header.html');

if(isset($_SESSION['php_path_value']) && $_SESSION['php_path_value'] != '')
{
  $php_path = $_SESSION['php_path_value'];
}
else
{
  $request_php_bin = true;
}
$server_base = ($_SERVER['SERVER_NAME'])? $_SERVER['SERVER_NAME']: $_SERVER['SERVER_ADDR'];
$default_server = rtrim($server_base.str_replace('/install/general_info.php', '', $_SERVER['REQUEST_URI']),'/');
$default_server = str_replace('::1', 'localhost', $default_server);
// ignore localhost / 127.0.0.1
if (substr_count($default_server, 'localhost') || substr_count($default_server, '127.0.0.1'))
{
  $default_server = '';
}
?>

<h2>Step 3 - Configure</h2>
<div id="stepsMenu">
 <div>
   <ul>
    <li>Welcome</li>
    <li class="done">Verify Requirements</li>
    <li class="done">Set up Database</li>
    <li class="active">Configure</li>
    <li>Finished</li>
   </ul>
 </div>
</div><!--stepsMenu-->

<div id="stepDetails">
    <form id="gnrl_info" action="install.php" method="post" onsubmit="return validate_general_form();">
      <?php
        foreach($_POST as $field => $value)
        {
          if (substr($field, 0, 3) == 'kdb')
            echo '<input type="hidden" name="'.$field.'" value="'.$value.'" />';
        }
      ?>

      <table cellspacing="0" cellpadding="0" border="0" width="625">
          <tr>
            <td colspan="2"><h4>Server Configuration</h4></td>
          </tr>
          <tr>
            <td><label for="host">&nbsp;Server URL</label>:</td>
            <td class="theField"><input type="text" name="host" id="host" value="<? echo $default_server ?>" />
            <br /><span id="verify_host" class="error_hidden">Cannot reach host, make sure you typed correctly and the server is configured properly</span></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="fieldDescribe">Enter the public address of this server (this host should be accessible from the internet/ intranet: it will be used by KalturaCE's components).<br />
            <br />For example: <br />10.0.0.27/kalturaCE<br/>OR<br />www.mykalturadomain.com (kalturaCE in installed on a virtualHost)</td>
          </tr>
          <tr>
            <td><label for="iscdnhost">&nbsp;Streaming Settings:</label><br /><br /><br /></td>
            <td>
				<p><input onclick="toggle_cdnhost(0);"  type="radio" name="iscdnhost" value="0" checked="checked"  /> Content will be streamed from this KCE Server</p>
				<p><input onclick="toggle_cdnhost(1);" type="radio" name="iscdnhost" value="1" /> 
				  Content will be streamed from a Content Delivery Network (CDN)</p>
				&nbsp; &nbsp; &nbsp;<label for="cdnhost">CDN Address:</label>
				<input type="text" disabled="disabled" id="field_cdnhost" name="cdnhost" value="" />
            </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="fieldDescribe">&nbsp; &nbsp; &nbsp; &nbsp;The CDN must support "Pull" mode, so that upon request the CDN can pull<br />&nbsp; &nbsp; &nbsp; &nbsp;content from this KCE server.</td>
          </tr>
          <tr>
            <td><label for="encoding2">Encoding Settings:</label><br /><br /></td>
            <td>
             <p><input type="radio" name="encoding" value="0" checked="checked" /> Open Source encoder - Content will be encoded on this KCE Server</p>
             <p><input type="radio" disabled="disabled" name="encoding" value="" /> Premium encoder - Coming Soon...</p>
            </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="fieldDescribe">The premium encoder provides better video quality, creates smaller files and smoother&nbsp;playback.</td>
          </tr>
         <?php if($request_php_bin): ?>
          <tr>
            <td><label for="php_path">&nbsp;PHP executable path:</label></td>
            <td class="theField"><input type="text" name="php_path2" value="" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="fieldDescribe"><span class="desc">absolute path to php executable on your system. for example /usr/local/custom_php5/bin/php</span></td>
          </tr>
        <?php else: ?>
          <input type="hidden" name="php_path" value="<? echo $php_path; ?>" />&nbsp;
        <?php endif; ?>
          <tr>
            <td colspan="2"><br /><h4>Administrator Account</h4></td>
          </tr>
          <tr>
            <td class="fieldName"><label for="name">&nbsp;Name: </label></td>
            <td class="theField"><input type="text" name="name" id="general_name" value="" /><br /><span id="verify_name" class="error_hidden">You must enter name</span></td>
          </tr>
          <tr>
            <td><label for="email">&nbsp;Email:</label></td>
            <td class="theField"><input type="text" name="email" id="account_email" value="" /><span id="verify_email" class="error_hidden">You must enter a valid email address</span></td>
          </tr>
          <tr>
            <td><div class="desc"></div></td>
            <td class="fieldDescribe"><span class="desc">The email of the administrator, will be used for login</span></td>
          </tr>
          <tr>
            <td><label for="password">&nbsp;Password:</label></td>
            <td class="theField"><input type="password" id="account_pass1" name="password" value="" /><br /><span id="verify_pass1" class="error_hidden">You must choose password</span></td>
          </tr>
          <tr>
            <td><label for="password2">&nbsp;Confirm password:</label></td>
            <td class="theField"><input type="password" id="account_pass2" name="password2" value="" /><span id="verify_pass2" class="error_hidden">You must verify password</span><span class="error_hidden" id="verify_passwords">Passwords don't match.</span></td>
          </tr>
          <tr>
            <td colspan="2"><br /><h4>Register with Kaltura.com</h4></td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;<input type="checkbox" name="will_register" value="1" checked="checked" /> Free Registration with Kaltura.com</td>
          </tr>
          <tr>
            <td colspan="2" class="fieldDescribe">&nbsp;This will allow you to consume services and support from Kaltura.com<br />&nbsp;Your media items will remain private and will not be exposed to Kaltura.com.</td>
          </tr>
        </table>

    <p>
        <!-- REGISTRAION FIELDS -->
      <input type="hidden" name="phone" value="" />
      <input type="hidden" name="description" value="CE version 1.0" />
      <input type="hidden" name="contentCategories" value="N/A" />
      <input type="hidden" name="describe_yourself" value="N/A" />
      <input type="hidden" name="adult_content" value="0" />
      <input type="hidden" name="type" value="105" />
      <br />
      <input type="button" name="back" value="< Back " onclick="history.back()" /> &nbsp; <input class="submit" type="submit" name="kgeneraloptions" value=" Finish Installation " />
    </p>
    </form>
  </div>
  
  </div><!--stepDetails-->
  
  <script>
	window.onload=function(){
		var tmp=document.getElementById("host");
		tmp.focus();tmp.select();
		tmp.onblur=function(){
				if(this.value.indexOf("127.0.0.1")!=-1 || this.value.indexOf("localhost")!=-1) {
					if (!confirm("IMPORTANT:\n\nIf you use 'localhost' or '127.0.0.1', the KalturaCE server\nwill only work on the computer it is installed on.\n\nIf you try to work with that KalturaCE server from another\ncomputer, it will not work properly.\n\nAre you sure you want to keep this server url?")) {
						tmp.focus();
						tmp.select();
					}
				}
		}
	}
  </script>
  
<?
function validate_mysql_connection()
{
  $server = $_POST['kdbhost'];
  if (isset($_POST['kdbport']) && $_POST['kdbport'] != '')
    $server .= ':'.$_POST['kdbport'];
  @mysql_connect($server , $_POST['kdbuser'], $_POST['kdbpass']);
  $res = @mysql_select_db($_POST['kdbname']);
  if (!$res)
    header('Location: database_info.php?error=true');
  
  return true;  
}
include('footer.html'); ?>