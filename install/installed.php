<?php
define ('SF_ROOT_DIR', dirname(__FILE__).'/../kaltura/alpha');

require_once('../kaltura/alpha/config/kConf.php');
$server_url = $server_host = 'http://'.kConf::get('www_host');
include('../kaltura/api_v3/web/system/batchwatchStatus.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html lang="en">
<head>
    <title>Kaltura Community Edition Server - Home Page</title>
    <link rel="stylesheet" rev="stylesheet" media="screen" href="css/kce.css" />
    <script src="js/functions.js"></script>
</head>

<body id="kce_home">
 <div id="pageWrap">
  <h1><img src="images/k_logo.png" width="135" height="24" alt="Kaltura - creating together"> &nbsp; CE Server</h1>
  <div id="stepWrap">
<!-- above is based on installation header.html -->

<h2>Welcome to Kaltura Community Edition (KalturaCE)</h2>
<a name="top"></a>
<div id="stepsMenu">
 <div>
   <p><strong>Jump To:</strong></p>
   <ul>
     <li><a href="#about">What is it all about?</a></li>
     <li><a href="#samples">What  can I do with KalturaCE?&nbsp; Show me  some examples.</a></li>
     <li><a href="#cms">Can this work with my Existing CMS?</a></li>
     <li><a href="#manage">How do  I manage the content?</a></li>
     <li><a href="#monitor">How can I monitor my server?</a></li>
     <li><a href="#extend">How can I extend the functionality for my own needs?</a></li>
     <li><a href="#gethelp">Where do I go for help?</a></li>
     
   </ul>
 </div>
</div><!--stepsMenu-->

<div id="stepDetails">

<?php
 if ($batch_status != 0) {
	 echo '<div class="failed"><h2><span class="status_error">Your KalturaCE Server Is Only Partially Functional</span></h2><p>'
	 .$batch_status. ' services are down - go to the <a href="'. $server_host . '/index.php/kmc?tab=server" target="_blank">Server Monitor</a> to learn more</p></div>';
 }
 else {
	 echo '<div class="passed"><h2 class="passed"><strong>Your KalturaCE Server Is Up And Running</strong></h2></div>';
 }
?>

<a name="about"></a>
<h3>What is it all about?</h3>
<p>KalturaCE is a self-hosted version  of Kaltura's Open Source Online Video Platform.&nbsp; With KaturaCE any site can gain  full video and rich media functionalities including video management, searching,  uploading, importing, editing, annotating, remixing and sharing.&nbsp; It is intended to solve all your video-related  needs, and allow you to easily create your own rich-media applications.</p>

<a name="samples"></a>
<h3>What  can I do with KalturaCE?&nbsp; Can you show me  some examples?<span>[<a href="#top">top</a>]</span></h3>
<p>The following samples show several capabilities of  the Kaltura platform, the Kaltura API and the different widgets.&nbsp; The samples are included in your CE package  and you can use them as templates to play with and use as a basis for your work.&nbsp; Of course this is just a taste of what the platform can do, but hopefully it  will help jumpstart your website development and spur you to innovate and  create your own interactive video applications.</p>
<ul>
  <li><a href="<?php echo $server_url ?>/api_v3/sample/players/" target="kce_plyrs">Player Gallery</a>
    <p>Test drive some of the different players that are supported by the system,  both default players, players created via the Application Studio (within the Kaltura Management Console) and custom players that can be created by  customizing the Kaltura Dynamic Player widget.&nbsp; The players include customizable functionality such as, including  buttons to upload and remix media, share, report abuse, download and more.</p>
  </li>
  <li><a href="<?php echo $server_url ?>/api_v3/sample/playlists/" target="kce_plist">Playlist Gallery</a>
    <p>View  and play with the different playlist widgets that are supported by the system(Flash  or HTML) - Flash playlists created via the Application Studio (within the  Kaltura Management Console) and custom playlists (Flash &amp; HTML).&nbsp; You can add your own content either manually  or dynamically (tag based or rule based) to the playlists and chose to display  multiple playlists in a single widget</p>
  </li>
  <!--li><a href="//">Dynamic Playlists</a>
    <p>See how you can build a playlist dynamically using tags, and how to keep them updated as users tag additional content.</p></li-->
  <li><a href="<?php echo $server_url ?>/api_v3/sample/" target="kce_ugc">UGC Site</a> &ndash; content contribution & collaborative editing
    <p>Check  out a great template for a UGC-focused site that supports user content  contributions, galleries of most viewed, highest rated, most popular, and more.&nbsp; <br>
Easily tweak this site to meet your own  requirements. </p>
    <div>
      <div> </div>
    </div>
  </li>
  <li><a href="<?php echo $server_url ?>/api_v3/sample/advanced_editor/player.php" target="kce_edit">Advanced Editing</a>
    <p>Play  around with the Kaltura Advanced Editor, including: timeline based editing, video  and audio layers, library of effects, overlays and transitions, and more.&nbsp; Add your own transitions, skin the editor  with your look &amp; feel and make it your own.</p>
  </li>
</ul>

<a name="cms"></a>
<h3>Can  this work with my Existing CMS?<span>[<a href="#top">top</a>]</span></h3>
<p>Yes, Kaltura has developed several ready-made  extensions for leading CMS platforms.&nbsp; Each extension seamlessly integrates with the CMS platform, and provides  a full video solution made specifically to fit each CMS&rsquo;s code, features and  terminology.</p>
<ul>
  <li><a href="<?php echo $server_host ?>/help/drupal-kaltura_integration.html">Drupal integration video module</a><br>
  Kaltura's Drupal video module includes  the full capabilities of Kaltura's platform. &nbsp;The module was developed specifically for Drupal, and integrates with other features and modules, such  as CCK, cron, metadata and taxonomy features.</li>
  <li><a href="<?php echo $server_host ?>/help/wordpress-kaltura_integration.html">WordPress integration video plugin</a><br>
  Kaltura's WordPress plugin includes the full capabilities of Kaltura's platform. &nbsp;It integrates seamlessly into WordPress  blogs and offers a wide range of "blog-friendly" features including video comments, a "recent videos" sidebar widget and more.</li>
 </ul>

<a name="manage"></a>
<h3>How do  I manage the content?<span>[<a href="#top">top</a>]</span></h3>
<p>Kaltura Community Edition is delivered with the full <a href="<? echo $server_host; ?>/index.php/kmc" target="_blank">Kaltura Management Console (KMC)</a>.&nbsp; It supports content and bulk upload, video and playlist management as well as  content moderation, all within an intuitive user interface. You can see  additional guidance regarding the KMC in the <a href="<?php echo $server_host ?>/lib/pdf/KMC_Quick_Start_Guide.pdf" target="_blank">quick start guide</a>.</p><br>

<a name="monitor"></a>
<h3>How can I monitor my server?<span>[<a href="#top">top</a>]</span></h3>
  <p>The <a href="<? echo $server_host; ?>/index.php/kmc?tab=server" target="_blank">server  status section</a> allows you to see the status of the server, including:<br>
  making sure that all processes are up and running, validating that there are no long queues for transcoding or importing services, etc.</p><br>


  <a name="extend"></a>
  <h3>How can I extend the functionality for my own needs?<span>[<a href="#top">top</a>]</span></h3>
    <p>The entire <u><a href="http://kaltura.org/project/kalturaCE" target="_blank">code</a></u>; <u><a href="<? echo $server_host; ?>/index.php/kmc?tab=developer&subtab=testmeDoc" target="_blank">API  documentation</a></u> and an <u><a href="<? echo $server_host; ?>/index.php/kmc?tab=developer&subtab=testme" target="_blank">API test console</a></u> are available.&nbsp; Using these  tools, you should have everything you need to build upon the Kaltura platform.</p><br>
    
    <a name="gethelp"></a>
    <h3>Where do I go for help?<span>[<a href="#top">top</a>]</span></h3>
      <p>The KalturaCE is a community-supported open source project.&nbsp; The best place to get help is in our <u><a href="http://kaltura.org/forums/kaltura-server-community-edition-forums" target="_blank">Community Forums</a></u>.</p>
    <p>&nbsp;</p>



</div><!--stepDetails-->



</div><!--nav-->
</div><!--steps-->
</div><!--wrap-->
<div class="footer">
  <!--<a href="http://corp.kaltura.com/support/form/project/41">Professional Support</a>-->
</div>
<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>

</body>
</html>

