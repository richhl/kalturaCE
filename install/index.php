<?php
include('common.php');
include('header.html');
@session_destroy();
?>
<h2>Welcome to the Installation Wizard</h2>
<div id="stepsMenu">
 <div>
   <ul>
    <li class="active">Welcome</li>
    <li>Verify Requirements</li>
    <li>Set up Database</li>
    <li>Configure</li>
    <li>Finished</li>
   </ul>
 </div>
</div><!--stepsMenu-->
<div id="stepDetails">
<!--For smoother installation, we recommend you follow our <a target="_blank" href="../installation_guide.pdf">Installation Guide</a>.-->
 <p>We strongly recommend that you read <a target="_blank" href="../kalturaCE_readme.txt">kalturaCE_readme.txt</a> before proceeding with the installation.</p>
 <p>Make sure your system meets the following requirements:
  <ul>
    <li><b>Debian-based</b> linux distribution, <b>32Bit</b></li>
    <li>Apache <b>mod_rewrite</b> enabled</li>
    <li><b>AllowOverride</b> directive set to <b>All</b> for the kalturaCE path - to allow the use of .htaccess</li>
    <li><b>Options</b> directive should include <b>FollowSymlinks</b></li>
  </ul>
  <p>For more information on how to set these requirements, please refer to <a href="../kalturaCE_readme.txt" target="_blank">kalturaCE_readme.txt</a>.</p>
  <p><input type="button" value="Begin Installation" onclick="location.href='prepare_install.php'"></p>
</div><!--stepDetails-->
<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
<?php
include('footer.html');
?>