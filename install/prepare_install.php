<?php
include('common.php');
session_start();
include('header.html');
include('requirements.php');
$GA_ACTION = "requirementsCheck";
$requirements_stats = 0;
$perms_script = false;
$reqs_error = true;
$reqs = array( 'exec', 'php52', 'phpmysql', 'phpcli', 'GD', 'DOMDocument', 'libcURL' , 'memcache', 'ffmpeg', 'mail', 'upload', 'conversions', 'archive', 
  'logs', 'cache', 'indicators', 'batchwatch', 'content', 'appsconfig', 'alphaconfig', 'api3config', 'alphabatch', 'api3cache' );

$mail_server = false;
$memcache_server = false;
$warnings = array();
$status = verifyRequirements();
?>

<h2>Step 1 - Verify Requirements</h2>
<div id="stepsMenu">
 <div>
   <ul>
    <li>Welcome</li>
    <li class="active">Verify Requirements</li>
    <li>Set up Database</li>
    <li>Configure</li>
    <li>Finished</li>
   </ul>
 </div>
</div><!--stepsMenu-->

<div id="stepDetails">

    <?php
      if($perms_script || $requirements_stats!=count($reqs))
      {
	      echo '<div class="failed">';
      }
      if ($requirements_stats != count($reqs) && !$reqs_error)
      {
        $GA_ACTION .= "_errorsFound";
        echo '<p><span class="status_error">Errors found - see details below:</span><br />You can <a href="http://kaltura.org/forums/kaltura-server-community-edition-forums" target="_blank">get help at the community forums</a>, or report bugs / make feature requests through the <a href="http://corp.kaltura.com/support/form/project/13" target="_blank">Issues Tracker</a>.</p>';
      }
      if ($perms_script)
      {
        $GA_ACTION .= "_permissionsError";
        echo '<p><span class="status_error">Not all permissions are set correctly</span> (this is typical for this stage).<br />You can set these permissions manually to 777 (using chmod), or <strong>just run the following script</strong>:<br /><em>'.dirname(__FILE__).'/fixperms.sh</em></p>';
      }
      if(!$perms_script && $requirements_stats==count($reqs))
      {
	if (!$mail_server || !$memcache_server)
	{
	  $GA_ACTION .= "_passedMissing";
	  $GA_ACTION .= (!$mail_server)? "_smtp": "";
	  $GA_ACTION .= (!$memcache_server)? "_memcache": "";
          echo '<div class="passed"><h2 class="passed"><strong>Configuration is not ideal:</strong></h2>';
	  echo '<ul>'.implode($warnings).'</ul><p>You can <a href="http://kaltura.org/forums/kaltura-server-community-edition-forums" target="_blank">get help at the community forums</a>, or report a bug / make a feature request through <a href="http://www.kaltura.org/project/issues/418" target="_blank">issues tracker</a></p>';
	  echo '<h2>Fixed the problems? <a href="prepare_install.php">Check Again</a></h2><h2><a href="database_info.php">Continue (ignore these warnings) &raquo;</a></h2>';
	}
	else
	{
	  $GA_ACTION .= "_Passed";
          echo '<div class="passed"><h2 class="passed"><strong>Everything\'s Good</strong>. &nbsp;<a href="database_info.php">Let\'s continue &raquo;</a></h2>';
	}
      }
      else
      {
	echo '<p><strong>Fixed the problems?</strong> &nbsp;<a href="prepare_install.php">Check Again</a></p>';
      }
      echo '</div><ul id="status_list">' . $status . '</ul>';
    ?>
 
  <div class="nextaction clear-fix">
    <?php if ($requirements_stats == count($reqs)): ?>
        <input type="button" value="< Back " onclick="history.back();" /> &nbsp; <input type="button" value=" Continue Installation >" onclick="location.href='database_info.php'" />
    <?php else: ?>
    <input type="button" value="Check Again" onclick="location.href='prepare_install.php'>" />
    
    <?php endif; ?>
  </div>  

</div><!--stepDetails-->


<?php include('footer.html'); ?>
