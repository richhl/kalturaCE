<?php
$service_url = requestUtils::getRequestHost();
$host = str_replace ( "http://" , "" , $service_url );
$cdn_host = str_replace ( "http://" , "" , requestUtils::getCdnHost() );
$kmc_content_version = 'v1.1.7';
$kmc_account_version = 'v1.1.4';
$kmc_appstudio_version = 'v1.1.2';
$flash_dir = $service_url . myContentStorage::getFSFlashRootPath ();

$beta_str = $beta ? "/beta/{$beta}" : "";

if ( kConf::get('kmc_display_server_tab') )
{
  $_SESSION['api_v3_login'] = true;
}
if ( $host == "www.kaltura.com" ) $host = "1";
?>

	<div id="kmcHeader">
     <img src="<?php echo $service_url; ?>/lib/images/kmc/logo_kmc.png" alt="Kaltura CMS" />
     <ul>
      <li><a id="content" href="javascript:void(0)"><span>Content</span></a></li>
	 <?php if ( kConf::get ( "kmc_display_customize_tab" ) && version_compare( $beta , "1.0" , ">" ) ) { ?>
	  <li><a id="appstudio" href="javascript:void(0)"><span>Application Studio</span></a></li>
	 <?php } ?> 			 
	  <!-- <li><a href="#Ad Networks">Ad Networks</a></li> -->
	  <!-- <li><a href="#Reports">Reports</a></li> -->
	 <?php if ( kConf::get ( "kmc_display_account_tab" ) ) { ?>
      <li><a id="account" href="javascript:void(0)"><span>Account</span></a></li>
	 <?php } ?>
	 <?php if ( kConf::get ( "kmc_display_server_tab" ) ) { ?>
      <li><a id="server" href="<?php echo $service_url; ?>/api_v3/system/batchwatch.php" target="_server"><span>Server</span></a></li>
	 <?php } ?>
	 <?php if ( kConf::get ( "kmc_display_developer_tab" ) ) { ?>
      <li><a id="developer" href="<?php echo $service_url; ?>/api_v3/testme/index.php"><span>Developer</span></a></li>
	 <?php } ?>
	 </ul>

     <div>
      <span>Hi <?php echo $screen_name ?></span><br />
      <a href="<?php echo $service_url ?>/lib/pdf/KMC_Quick_Start_Guide.pdf" target="_blank">Quickstart Guide</a> &nbsp; | &nbsp; <a href="javascript:logout()">Logout</a> &nbsp; | &nbsp; <a target="_blank" href="http://corp.kaltura.com/support/form/project/30/partnerId/<? echo ($host != 1)? '': $partner_id; ?>">Support</a>
	 </div>

	</div><!-- kmcHeader -->

	<div id="main">
		<div id="flash_wrap" class="flash_wrap" style="">
			<div id="kcms"></div>
		</div><!-- end #flashcontent -->
        <div id="server_wrap">
         <iframe frameborder="0" id="server_frame" height="100%" width="100%"></iframe>
        </div> <!--server_wrap-->
	</div><!-- end #main -->
	
<script type="text/javascript">
var current_module = 'content';
var partner_id = <?php echo $partner_id; ?>;
var subpid = <?php echo $subp_id; ?>;
var user_id = '<?php echo $uid; ?>';
var ks = '<?php echo $ks; ?>';
var screen_name = '<?php echo $screen_name; ?>';
var email = '<?php echo $email; ?>';
var next_module = null;
var selected_uiconfId = null;
var sub_nav_tab = "";

var refreshPlayerList = 0;
var refreshPlaylistList = 0;

var ui_confs_player;
<?php
		$uiconfs_array = array();
		foreach($player_uiconf_list as $uiconf)
		{
		    $uiconf_array = array();
            $uiconf_array["id"] = $uiconf->getId();
            $uiconf_array["name"] = $uiconf->getName();
            $uiconf_array["width"] = $uiconf->getWidth();
            $uiconf_array["height"] = $uiconf->getHeight();

            $uiconfs_array[] = $uiconf_array;
		}
	echo "ui_confs_player=" . json_encode($uiconfs_array);
?>	

var ui_confs_playlist;
<?php
		$uiconfs_array = array();
		foreach($playlist_uiconf_list as $uiconf)
		{
		    $uiconf_array = array();
            $uiconf_array["id"] = $uiconf->getId();
            $uiconf_array["name"] = $uiconf->getName();
            $uiconf_array["width"] = $uiconf->getWidth();
            $uiconf_array["height"] = $uiconf->getHeight();

            $uiconfs_array[] = $uiconf_array;
		}
	echo "ui_confs_playlist=" . json_encode($uiconfs_array);
?>	

function playerAdded()
{
	refreshPlayerList = 1;
	jQuery.ajax({
		url: "<? echo url_for('kmc/getuiconfs'); ?>",
		type: "POST",
		data: { "type": "player", "partner_id": partner_id, "ks": ks },
		dataType: "json",
		success: function(data) {
			if (data && data.length) {
				ui_confs_player = data;
			}
		}
	});
}

function playlistAdded()
{
	refreshPlaylistList = 1;
	jQuery.ajax({
		url: "<? echo url_for('kmc/getuiconfs'); ?>",
		type: "POST",
		data: { "type": "playlist", "partner_id": partner_id, "ks": ks },
		dataType: "json",
		success: function(data) {
			if (data && data.length) {
				ui_confs_playlist = data;
			}
		}
	});
}

function expiredF ( )
{
	window.location = "<? echo $service_url; ?>/index.php/kmc/kmc<? echo $beta_str ?>";
}

function refreshSWF()
{
	sub_nav_tab = "";
	loadModule( current_module, partner_id, subpid,  user_id,  ks, screen_name, email );
}

function selectPlaylistContent(playerId,isPlaylist)
{
	if(isPlaylist == "true")
		sub_nav_tab = "Playlist";
	else
		sub_nav_tab = "";
		
	selected_uiconfId = playerId;
	next_module = "content";
	$("#kmcHeader ul li a").removeClass('active');
	$("a#content").addClass('active');
	loadModule(next_module, partner_id, subpid, user_id, ks, screen_name, email);
}

function loadModule ( module_name , partner_id , subp_id ,  uid  ,  ks , screen_name , email )
{
	if ( module_name == "content" ) 
	{
		setDivToHide ( "kcms" );
		current_module = 'content';
		var flashVars = {	
				'host' : "<? echo $host ?>" , 
				'cdnhost' : "<? echo $cdn_host ?>" ,
				'uid' : uid ,
				'partnerid' : partner_id,
				'subpid' : subp_id ,
				'openCw' : "openCw" ,
				'ks' : ks ,
				'devFlag' : 'false' ,
				'entryId' : "-1" ,
				'kshowId' : '-1', 
				'refreshPlayerList' : refreshPlayerList, 
				'refreshPlaylistList' : refreshPlaylistList, 
				'widget_id' : '_' + partner_id ,
				'openPlaylist' : 'openPlaylist',
				'openPlayer' : 'openPlayer' ,
				'expiredF' : 'expiredF',
				'subNavTab' : sub_nav_tab,
				'innerKdpVersion':'v2.0.12',
				'firstLogin' : '<? echo $first_login; ?>',
				'visibleCT' : '<? echo $visibleCT; ?>'
				};
				
			var params = {
				allowscriptaccess: "always",
				allownetworking: "all",
				bgcolor: "#1B1E1F",
				bgcolor: "#1B1E1F",				
				quality: "high",
//				wmode: "opaque" ,
				movie: "<?php echo $flash_dir ?>/kmc/content/<? echo $kmc_content_version ?>/content.swf?r113"
			};
			swfobject.embedSWF("<?php echo $flash_dir ?>/kmc/content/<? echo $kmc_content_version ?>/content.swf?r113", 
				"kcms", "100%", "100%", "9.0.0", false, flashVars , params);	
			
		// setTimeout ( "content_resize()" , 1000 );
	}
	if ( module_name == "account" ) //***
	{
	    sub_nav_tab = "";
		setDivToHide ( "kcms" );
		current_module = 'account';
		var flashVars = {	
				'host' : "<? echo $host ?>" , 
				'cdnhost' : "<? echo $cdn_host ?>" ,
				'uid' : uid ,
				'partnerid' : partner_id,
				'subpid' : subp_id ,
				'email': email ,
				'openCw' : "openCw" ,
				'ks' : ks ,
				'devFlag' : 'true' ,
				'entryId' : "-1" ,
				'kshowId' : '-1', 
				'widget_id' : '_' + partner_id ,
				'openPlaylist' : 'openPlaylist',
				'openPlayer' : 'openPlayer',
				'firstLogin' : '<? echo $first_login ?>',
				'showUsage' : '<?php echo (kConf::get('kmc_account_show_usage'))? 'true': 'false'; ?>'
				};
				
			var params = {
				allowscriptaccess: "always",
				allownetworking: "all",
				bgcolor: "#1B1E1F",
				bgcolor: "#1B1E1F",				
				quality: "high",
//				wmode: "opaque" ,
				movie: "<?php echo $flash_dir ?>/kmc/account/<? echo $kmc_account_version ?>/account.swf"
			};
			swfobject.embedSWF("<?php echo $flash_dir ?>/kmc/account/<? echo $kmc_account_version ?>/account.swf", 
				"kcms", "100%", "100%", "9.0.0", false, flashVars , params);	
			
		setTimeout ( "content_resize()" , 1000 );
	}	
	if ( module_name == "appstudio" ) 
	{
		sub_nav_tab = "";
		setDivToHide ( "kcms" );
		current_module = 'appstudio';
		var flashVars = {	
				'host' : "<? echo $host ?>" , 
				'cdnhost' : "<? echo $cdn_host ?>" ,
				'uid' : uid ,
				'partner_id' : partner_id,
				'subp_id' : subp_id ,
				'email': email ,
				'openCw' : "openCw" ,
				'ks' : ks ,
				'devFlag' : 'true' ,
				'entryId' : "_KMCLOGO" ,
				'kshowId' : '-1', 
				'widget_id' : '_' + partner_id ,
				'openPlaylist' : 'openPlaylist',
				'openPlayer' : 'openPlayer',
				'devFlag' : 'false' ,
				'servicesPath' : '/index.php/partnerservices2/',
				'serverPath' : "<? echo $service_url; ?>",
				'kdpUrl' : "<?php echo $flash_dir ?>/kdp/v2.0.12/kdp.swf"
				};
				
			var params = {
				allowscriptaccess: "always",
				allownetworking: "all",
				bgcolor: "#1B1E1F",
				bgcolor: "#1B1E1F",				
				quality: "high",
//				wmode: "opaque" ,
				movie: "<?php echo $flash_dir ?>/kmc/appstudio/<? echo $kmc_appstudio_version ?>/applicationstudio.swf"
			};
			swfobject.embedSWF("<?php echo $flash_dir ?>/kmc/appstudio/<? echo $kmc_appstudio_version ?>/applicationstudio.swf", 
				"kcms", "100%", "100%", "9.0.0", false, flashVars , params);	
			
		setTimeout ( "content_resize()" , 1000 );
	}		
}

var modal = null;
function openCw ( ks ,conversion_quality )
{
	// use wrap = 0 to indicate se should be open withou the html & form wrapper
	modal = kalturaInitModalBox ( null , { width: 700, height: 360 } );
	modal.innerHTML = "<div id='kaltura_cw'></div>" ;
	
	
	var flashVars = {	
		'host' : "<? echo $host ?>" , 
		'cdnhost' : "<? echo $cdn_host ?>" ,
		'userId' : "<?php echo $uid ?>",
		'partnerid' : "<?php echo $partner_id ?>",
		'subPartnerId' : "<?php echo $subp_id ?>",
		'sessionId' : ks ,
		'devFlag' : 'true' ,
		'entryId' : "-1" ,
		'kshow_id' : '-1',
		'terms_of_use' : "<?php echo kConf::get('terms_of_use_uri'); ?>",
		'close' : 'onCloseCw' ,
		'quick_edit' : 0 , 		// when opening from the KMC - don't add to the roughcut
		'kvar_conversionQuality' : conversion_quality ,
		'partnerData' : "conversionQuality:" + conversion_quality + ";"	// this is a hack until the CW supports kvar
		};
		
		var params = {
			allowscriptaccess: "always",
			allownetworking: "all",
			//bgcolor: "#1B1E1F",
			bgcolor: "#DBE3E9",
			quality: "high",
			wmode: "opaque" ,
			movie: "<? echo $service_url; ?>/kcw/ui_conf_id/36202"
		};
		
		swfobject.embedSWF("<? echo $service_url; ?>/kcw/ui_conf_id/36202",  // 36201 - new CW with ability to pass params not ready for this version
			"kaltura_cw", "680", "400" , "9.0.0", false, flashVars , params);
			
		setObjectToRemove ( "kaltura_cw" );
}

var global_embed_code; 
// TODO - this should open a dialog box and call a flash object 
function openPlaylist ( embed_code , playlist_id , pl_width_str , pl_height_str , ui_conf_id )
{
	global_embed_code = embed_code;
	if ( ! ui_conf_id || ui_conf_id == 190 || ui_conf_id == 199 )
	{
<?
if (false && kConf::get('www_host') == 'www.kaltura.com'){
?>
		ui_conf_id = 48206;
		pl_width_str = 660;
		pl_height_str = 272;
<?
} else {
?>
		// check if the page is now in state where there is a selected_uiconfId 
		if ( ! ui_conf_id && selected_uiconfId != null && ui_confs_playlist )
		{
			for(var i = 0; i < ui_confs_playlist.length; i++)
			{
				var uiconf = ui_confs_playlist[i];
				if ( uiconf.id == selected_uiconfId )
				{
					ui_conf_id = uiconf.id;
					pl_width_str = uiconf.width;
					pl_height_str = uiconf.height;
					break;
				}
			}
		}
		else
		{
			// override the default values from the depricated ui_conf
			ui_conf_id = <? echo $playlist_uiconf_list[0]->getId();  ?>; //48206;
			pl_width_str = <? echo $playlist_uiconf_list[0]->getWidth();  ?>;// 660;
			pl_height_str = <? echo $playlist_uiconf_list[0]->getHeight();  ?>;//272;
		}
<?
}
?>
	}
	
//	alert ( embed_code );
	// override the ui_conf_id from the embed code
	// replace the embed_code to use the ui_conf_id + width + height	 
	embed_code = embed_code.replace ( /ui_conf_id\/[0-9a-zA-Z]*/g , "ui_conf_id/" + ui_conf_id );
	embed_code = embed_code.replace ( /width="[0-9a-zA-Z]*"/g , 'width="' + pl_width_str + '"' );
	embed_code = embed_code.replace ( /height="[0-9a-zA-Z]*"/g , 'height="' + pl_height_str + '"' );
	
	var ui_conf_select = createSelectUiConfForPlaylist ( playlist_id , ui_conf_id );
	
//	alert ( ui_conf_select );
	
	pl_width = parseInt ( pl_width_str );
	pl_height = parseInt ( pl_height_str );
	modal = kalturaInitModalBox ( null , { width:pl_width+20 , height: (pl_height + 200)  } );
	playlist_html = 
		"<div class='title'><a href='#close' onclick='kalturaCloseModalBox(); return false;' class='closeBtn'></a><a href='<? echo $service_url; ?>/index.php/kmc/help#contentSection147' target='_blank' class='help'></a>Playlist ID: " + playlist_id + ui_conf_select + "</div>" + // third tr will have the playlist_id
		"<div class='kplayer' style='height:" + pl_height + "px'>" + embed_code + "</div>" + // create div to hold the playlist
		"<div class='embed_code' style='text-align:center'><textarea  id='embed_code' cols='30' rows='5' readonly='true' onclick='copyToClipboard(\"embed_code\");'>" + embed_code + "</textarea></div>" + // raw embed code
		"<div class='buttons'><button onclick='copyToClipboard(\"embed_code\");'>Select code</div>";
	
	setObjectToRemove ( "kaltura_playlist" );	
	modal.innerHTML = playlist_html;
}

function createSelectUiConfForPlaylist ( playlist_id , ui_conf_id )
{
	var ui_conf_select = "<span style='display:block; padding-left:10px;'><select onchange='" +
		"reopenPlaylist( \"" +  playlist_id  + "\" , this );'>";

	if (ui_confs_playlist)
	{
		for(var i = 0; i < ui_confs_playlist.length; i++)
		{
			var uiconf = ui_confs_playlist[i];
			ui_conf_select += createSelectUiConfAddOption(ui_conf_id ,uiconf.id, uiconf.width, uiconf.height, uiconf.name);
		}
	}
	else
	{
<?php
if (false && kConf::get('www_host') != 'www.kaltura.com'){
	foreach ( $playlist_uiconf_list as $ui_conf )
	{
		$name = $ui_conf->getName();
		$name =  substr( htmlspecialchars  ( $name , ENT_QUOTES ) ,0 , 30 );
		echo "ui_conf_select += createSelectUiConfAddOption ( ui_conf_id ," . $ui_conf->getId() . "," .   $ui_conf->getWidth() . "," .  $ui_conf->getHeight() . ",'$name'); \n";
	}
}else {
?>
			ui_conf_select += createSelectUiConfAddOption ( ui_conf_id , 48206 ,660,272 , "Horizontal" );
			ui_conf_select += createSelectUiConfAddOption ( ui_conf_id , 48207 ,724,322 , "Horizontal Compact" );
			ui_conf_select += createSelectUiConfAddOption ( ui_conf_id , 48205 ,400,600 , "Vertical" );	
			ui_conf_select += createSelectUiConfAddOption ( ui_conf_id , 48204 ,400,600 , "Vertical Compact" );
<?
}
?>
	}
	
	ui_conf_select += "</select></span>";
	 
	return 	ui_conf_select;
}

function createSelectUiConfAddOption ( current_ui_conf_id , ui_conf_id , width, height , name )
{
	var selected = ( current_ui_conf_id == ui_conf_id ? " selected " : "" ); 
	var option = "<option value='" + ui_conf_id + "," + width + "," + height + "' " + selected + " >" + name + "</option>";
	return option;
}

// assume the ui_conf_data will be of the structure:
// {id,name;width,height} 
function reopenPlaylist ( playlist_id , select_elem )
{
	jelem = jQuery ( select_elem );
	
//	alert ( "reopenPlaylist [" + jelem[0].value + "]" );
	ui_conf_data = jelem[0].value.split(",");
	
	// replace the ui_conf in the embed_code
	var embed_code = global_embed_code.replace ( /ui_conf_id\/[0-9a-zA-Z]*/g , "ui_conf_id/" + ui_conf_data[0] );
	embed_code = embed_code.replace ( /width="[0-9a-zA-Z]*"/g , 'width="' + ui_conf_data[1] + '"' );
	embed_code = embed_code.replace ( /height="[0-9a-zA-Z]*"/g , 'height="' + ui_conf_data[2] + '"' );
	kalturaCloseModalBox();
	openPlaylist ( embed_code , playlist_id , ui_conf_data[1] , ui_conf_data[2], ui_conf_data[0] );
}

function openPlayer ( entry_id , pl_width_str , pl_height_str , ui_conf_id  , a )
{
		width_str = '400';
		height_str = '332';

//alert ( "openPlayer" );
<? 	if (false && kConf::get('www_host') == 'www.kaltura.com') {		?>
		width_str = '400';
		height_str = '332';
		ui_conf_id = '48110';
<?	}	else { ?>
		// check if the page is now in state where there is a selected_uiconfId 
		if ( ! ui_conf_id && selected_uiconfId != null && ui_confs_player )
		{
			for(var i = 0; i < ui_confs_player.length; i++)
			{
				var uiconf = ui_confs_player[i];
				if ( uiconf.id == selected_uiconfId )
				{
					ui_conf_id = uiconf.id;
					width_str = pl_width_str = uiconf.width;
					height_str = pl_height_str = uiconf.height;
					break;
				}
			}
		}
		else
		{
			if ( ! ui_conf_id )
			{
				ui_conf_id = '<? echo $player_uiconf_list[0]->getId(); ?>';
			}
			
			if ( pl_width_str )
			{
				width_str = pl_width_str;
			}
			else
			{
				width_str = '<? echo $player_uiconf_list[0]->getWidth(); ?>';
			}
			
			if ( pl_height_str )
			{
				height_str = pl_height_str;
			}
			else
			{
				height_str = '<? echo $player_uiconf_list[0]->getHeight(); ?>';
			}
		}
<?	} ?>
	
	
	// for now the embed code will be hard-coded
	embed_code = "<?php echo str_replace ( '"' , '\"' , $embed_code ) ?>";

//	embed_code = embed_code.replace ( /\/wid\/_([0-9]*)/g , '/wid/_$1/ui_conf_id/' + ui_conf_id  +"/entry_id/" + entry_id );
	// remove the original uiconf_id and replace it with the new one + entry_id now playing 
	if ( entry_id ) entry_str = '/entry_id/' + entry_id;
	else entry_str = "";
	embed_code = embed_code.replace ( /\/uiconf_id\/[0-9]*/g , '/uiconf_id/' + ui_conf_id  + entry_str );
	embed_code = embed_code.replace ( /width="[0-9a-zA-Z]*"/g , 'width="' + width_str + '"' );
	embed_code = embed_code.replace ( /height="[0-9a-zA-Z]*"/g , 'height="' + height_str + '"' );
	
	global_embed_code = embed_code;
	
	// replace the embed_code to use the ui_conf_id + width + height
	var ui_conf_select = createSelectUiConfForPlayer ( entry_id , ui_conf_id );
	
	pl_width = parseInt ( width_str );
	pl_height = parseInt ( height_str );
	modal = kalturaInitModalBox ( null , { width:pl_width+20 , height: (pl_height + 200)  } );
	playlist_html = 
		"<div class='title'><a href='#close' onclick='kalturaCloseModalBox(); return false;' class='closeBtn'></a><a href='<? echo $service_url; ?>/index.php/kmc/help#contentSection118' target='_blank'></a>";
	if ( entry_id ) 
		playlist_html += "Entry ID: " + entry_id + ui_conf_select ;
	else
		playlist_html += "&nbsp;";
	playlist_html +=  "</div>" + // third tr will have the playlist_id
		"<div class='kplayer' style='height:" + pl_height + "px'>" + embed_code + "</div>" + // create div to hold the playlist
		"<div class='embed_code'style='text-align:center'><textarea id='embed_code' cols='30' rows='5' readonly='true' onclick='copyToClipboard(\"embed_code\");'>" + embed_code + "</textarea></div>" + // raw embed code
		"<div class='buttons'><button onclick='copyToClipboard(\"embed_code\");'>Select code</div>";
	
	setObjectToRemove ( "kaltura_player" );
	modal.innerHTML = playlist_html;
}

function createSelectUiConfForPlayer ( entry_id , ui_conf_id )
{
	var ui_conf_select = "<span style='display:block; padding-left:10px;'><select onchange='" +
		"reopenPlayer( \"" +  entry_id  + "\" , this );'>";

	if (ui_confs_player)
	{
		for(var i = 0; i < ui_confs_player.length; i++)
		{
			var uiconf = ui_confs_player[i];
			ui_conf_select += createSelectUiConfAddOption(ui_conf_id ,uiconf.id, uiconf.width, uiconf.height, uiconf.name);
		}
	}
	else
	{
<?php
if (false && kConf::get('www_host') != 'www.kaltura.com'){
	foreach ( $player_uiconf_list as $ui_conf )
	{
		$name = $ui_conf->getName();
		$name =  substr( htmlspecialchars  ( $name , ENT_QUOTES ) ,0 , 30 );
		
		echo "ui_conf_select += createSelectUiConfAddOption ( ui_conf_id ," . $ui_conf->getId() . "," .   $ui_conf->getWidth() . "," .  $ui_conf->getHeight() . ",'$name'); \n";
	}
}
else {
?>
		ui_conf_select += createSelectUiConfAddOption ( ui_conf_id , 48110,400,332 , "Dark player skin" ); 
		ui_conf_select += createSelectUiConfAddOption ( ui_conf_id , 48111,400,332 , "Light player skin" );
<?
}
?>
	}
	
	ui_conf_select += "</select></span>";
	 
	return 	ui_conf_select;
}

//assume the ui_conf_data will be of the structure:
//{id,name;width,height} 
function reopenPlayer ( entry_id , select_elem )
{
	jelem = jQuery ( select_elem );
	
//	alert ( "reopenPlaylist [" + jelem[0].value + "]" );
	ui_conf_data = jelem[0].value.split(",");
	
	kalturaCloseModalBox();
	openPlayer ( entry_id , ui_conf_data[1] , ui_conf_data[2], ui_conf_data[0] , "a" );
}

function onCloseCw ()
{
	kalturaCloseModalBox();
	modal = null;
}


function closeLoginF()
{
	alert('closeLoginF');
}

function logout()
{
	path = '<?php echo $service_url; ?>/index.php/kmc/kmc<? echo $beta_str ?>';
	deleteCookie ( "pid" , path );
	deleteCookie ( "subpid" , path );
	deleteCookie ( "uid" , path );
	deleteCookie ( "ks" , path );
	// Codes by Quackit.com
	location = "<? echo $service_url; ?>/index.php/kmc/kmc<? echo $beta_str ?>";

}

// will load the content modul by default 
loadModule ( <?php echo "'$module' , '$partner_id' , '$subp_id' , '$uid' , '$ks' ,'$screen_name' , '$email' " ?> );

</script>