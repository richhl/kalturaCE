<?php
include('common.php');
session_start();
include('header.html');
?>

<h2>Step 2 - Database Configuration</h2>
<div id="stepsMenu">
 <div>
   <ul>
    <li>Welcome</li>
    <li class="done">Verify Requirements</li>
    <li class="active">Set up Database</li>
    <li>Configure</li>
    <li>Finished</li>
   </ul>
 </div>
</div><!--stepsMenu-->

<div id="stepDetails">

    <form id="db_setup" action="general_info.php" method="POST">
    
   <?php if(isset($_GET['error']) && $_GET['error'] == 'true'): ?>
    <div class="failed">
     <h2>An Error Occured: could not connect to the database</h2>
     <ul>
      <li>Please review the form and make sure all the details are correct.</li>
      <li>If you added a user through MySql commad-line, make sure you flush priveleges, and that you are able to connect with that user.</li>
     </ul>
    </div>
   <?php endif; ?>
    
        <table width="520" border="0" cellspacing="0" cellpadding="0">
          <tr>
           <td colspan="2"><h4>Basic Options</h4></td>
          </tr>
          <tr>
            <td class="fieldName"><label for="kdbname">&nbsp;Database Name: </label></td>
            <td class="theField"><input type="text" name="kdbname" id="kdbname" value="<? kdb_default('kdbname', ''); ?>" /></td>
          </tr>
          <tr>
           <td>&nbsp;</td>
           <td class="fieldDescribe">The name of the database where your Kaltura metadata will be stored.<br />It must exist on your server before Kaltura can be installed.</td>
          </tr>
          <tr>
            <td class="fieldName"><label for="kdbuser">&nbsp;Database Username:</label></td>
            <td class="theField"><input type="text" name="kdbuser" value="<? kdb_default('kdbuser', ''); ?>" /></td>
          </tr>
          <tr>
            <td class="fieldName"><label for="kdbpass">&nbsp;Database Password:</label></td>
            <td class="theField"><input type="password" name="kdbpass" value="<? kdb_default('kdbpass', ''); ?>" /></td>
          </tr>
          <tr>
           <td colspan="2"><br /><h4>Advanced Options</h4></td>
          </tr>
          <tr>
            <td class="fieldName"><label for="kdbhost">&nbsp;Database Host:</label></td>
            <td class="theField"><input type="text" name="kdbhost" value="<? kdb_default('kdbhost', 'localhost'); ?>" /></td>
          </tr>
          <tr>
           <td>&nbsp;</td>
           <td class="fieldDescribe">If your database is located in a different host, change this.</td>
          </tr>
          <tr>
            <td class="fieldName"><label for="kdbport">&nbsp;Database Port:</label></td>
            <td class="theField"><input type="text" name="kdbport" value="<? kdb_default('kdbport', '3306'); ?>" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="fieldDescribe">Optional: if your database is listening on a non standard port, insert its number.</td>
          </tr>
        </table>
        <p><input class="submit" type="button" value="< back " onclick="history.back()" /> &nbsp; <input class="submit" type="submit" name="kdboptions" value=" Save and Continue >" /></p>
    </form>
  
  </div><!--stepDetails-->
  
  <script>
   window.onload=function(){var tmp=document.getElementById("kdbname");tmp.focus();tmp.select();}
  </script>
<?
function kdb_default($var, $def)
{
  if ($_SESSION['kdb_defaults'] && $_SESSION[$var])
    echo $_SESSION[$var];
  else
    echo $def;
}
include('footer.html'); ?>