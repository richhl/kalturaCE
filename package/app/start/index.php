<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">

<?php

include_once(dirname(__FILE__).'/php/check_status.php');

?>



<html lang="en">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Kaltura Video Platfrom - Home Page</title>
		<link rel="stylesheet" rev="stylesheet" media="screen" href="./css/style.css">
	</head>


<body>

	<div id="pageWrap">
	<h1></h1>

	<div id="insideWrap">
	
	<h2>
	Welcome to Kaltura Video Platform - Community Edition
	<?php
		$i = strrpos(kConf::get('kaltura_version'), ' ');
		echo ' '.substr(kConf::get('kaltura_version'), $i+1);
	?>
	</h2>
	
	<a name="top"></a>
	
	<div id="menu">
			<p><strong>Jump To:</strong></p>
			<ul>
				<li><a href="#about">What is Kaltura CE?</a></li>
				<li><a href="#samples">How can I integrate Kaltura within a web site?</a></li>
				<li><a href="#manage">How do I manage the content?</a></li>
				<li><a href="#monitor">How can I administrate my platform?</a></li>
				<li><a href="#extend">How can I extend the functionality?</a></li>
				<li><a href="#cms">How can I share my Kaltura applications?</a></li>
				<li><a href="#gethelp">Where do I go for help?</a></li>
			
			</ul>		
	</div> <!--menu-->
	
	<div id="content">
	
		<div id="systemStatus">
		
			<?php echo $status_div; ?>
			
		</div> <!-- systemStatus -->
		
		<a name="start"></a>
		<h3>Get Started Now !</h3>
		<p>
		To get started, please log-in to the <a href="/admin_console" target="_blank">Kaltura Administration Console</a> and go to the <a href="/admin_console/index.php/partner/create" target="_blank">Add New Publisher</a> page to create your first publisher account within the <a href="/kmc" target="_blank">Kaltura Management Console (KMC)</a>.<br/>
		You will receive an email with the registration confirmation and full credentials to access this new KMC account directly, or you can seamlessly access and manage this KMC account from the Kaltura Administration Console itself. 
		</p>
		
	
		<a name="about"></a>
		<h3>What is Kaltura Community Edition and what can I use it for?</h3>
		<p>Kaltura Community Edition is the self-hosted Open Source version of the Kaltura Video Platform. It provides a fully-featured online video platform as well as a robust framework for managing rich-media content and developing a variety of online workflows for video publishing, E-commerce, education and training, and more. You can use Kaltura as an integral part of:</p>
		<ul>
		<li>Your own web site </li> 
		<li>The multiple web sites you are building or providing services for</li>
		<li>Your organization/school rich-media portals </li> 
		<li>Online video service packages added to your current/planned service offering</li>
		<li>More…
		</ul>
		
		<a name="samples"></a>
		<h3>How can I integrate online video workflows within a web site?</h3>
		<p>Kaltura provides a robust online-video framework comprised of APIs, client libraries and self-contained widgets and applications. It allows you and your customers to easily design, develop and integrate rich-media workflows within web sites.</p>
<p>Common integration scenarios include:  
</p>
		<ul>
			<li><h3>Embedded Players</h3>
			<p>Kaltura provides a default set of ready-to-embed flash players. You can easily design the style and functionalities of your own player via the <a href="/kmc#appstudio" target="_blank">Application Studio.</a></p>
			</li>
			<li><h3>Playlist Gallery</h3>
			<p>Playlist galleries can be integrated within web sites, either as ready-to-embed Flash objects or as part of your HTML design.
Flash playlists are created through the <a href="/kmc#appstudio" target="_blank">Application Studio.</a>, and are already integrated with manual, tag/category based or rule-based playlists. HTML playlists can be easily created using Kaltura’s API supporting extended filtering, ordering and paging options for any type of content view required on you site.
</p>
			</li>
			
			<li><h3>UGC Site </h3>
			<p>Engage your end-users through content contribution and collaborative editing workflows using Kaltura’s content ingestion and online editing widgets. You can also use Kaltura API for developing advanced UGC workflows</p>
			<div>
			<div></div>
			</div>
			</li>
			
		</ul>
		
			
		
		<a name="manage"></a>
		<h3>How do I manage my rich-media content?</h3>
			<p>Kaltura Community Edition includes a full <a href="/kmc" target="_blank">Kaltura Management Console (KMC)</a>. The KMC supports content ingestion, video and playlist management, player design, rich-media syndication, advertising and much more - all within an intuitive user interface. Learn more about the KMC in the <a
			href="/lib/pdf/KMC_Quick_Start_Guide.pdf"
			target="_blank">quick start guide.</a></p>
		
		
		<a name="monitor"></a>
		<h3>How can I administrate and monitor my service?</h3>
			<p>Kaltura Community Edition comes with a full <a href="/admin_console" target="_blank">Kaltura
		Administration Console</a>.The console supports multi-publisher management, admin user management, batch processing control and monitoring. Additional information is available in the <a
			href="http://www.kaltura.org/kaltura-community-edition-kalturace"
			target="_blank">Kaltura platform administration guides</a> at the <a
			href="http://www.kaltura.org"
			target="_blank">kaltura.org </a>site</p>
		
		
		<a name="extend"></a>
		<h3>How can I extend the functionality?</h3>
		<p>The entire <U><a href="http://kaltura.org/project/kalturaCE"
			target="_blank">code</a></u>; <U><a
			href="/api_v3/testmeDoc"
			target="_blank">API documentation</a></u> and an <U><a
			href="/api_v3/testme"
			target="_blank">API test console</a></u> are available.&nbsp; Using these
		tools, you should have everything you need to build upon the Kaltura
		platform.</p>
		<br/>
		
		<a name="cms"></a>
		<h3>How can I share the Kaltura applications that I developed? </h3>
		<p>You can share and trade your applications at the <a
			href="http://exchange.kaltura.com/"
			target="_blank">Kaltura Application Exchange.</a> This is a virtual marketplace for publishers, developers, integrators and web shops to “trade” in video applications related to the Kaltura open source online video platform.</p>
		
		<a name="gethelp"></a>
		<h3>Where do I go for help ? </h3>
		<p>The KalturaCE is a community-supported open source project.&nbsp;
		The best place to get help is in our <U><a
			href="http://kaltura.org/forums/kaltura-server-community-edition-forums"
			target="_blank">Community Forums</a></u>.</p>
		<p>&nbsp;</p>
	
	
	
	</div> <!-- content -->
	
	</div> <!-- insideWrap -->
	</div> <!-- pageWrap -->

</body>
</html>