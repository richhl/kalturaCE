<?php
/**
 * This file store all of mwEmbed local configuration ( in a default svn check out this file is empty )
 *
 * See includes/DefaultSettings.php for a configuration options
 */

// Get kaltura configuration file
require_once( realpath( '/opt/kaltura/app/alpha/config' ) . '/kConf.php' );

$kConf = new kConf();

// Kaltura HTML5lib Version
$wgKalturaVersion = basename(getcwd()); // Gets the version by the folder name

// The default Kaltura service url:
$wgKalturaServiceUrl = 'http://' . $kConf->get('www_host');

// Default Kaltura CDN url:
$wgKalturaCDNUrl = 'http://' . $kConf->get('cdn_host');

// Default Kaltura service url:
$wgKalturaServiceBase = '/api_v3/index.php?service=';

// Default Kaltura Cache Path
$wgScriptCacheDirectory = $kConf->get('cache_root_path') . 'html5/' . $wgKalturaVersion;

$wgResourceLoaderUrl = $wgKalturaServiceUrl . '/html5/html5lib/' . $wgKalturaVersion . '/ResourceLoader.php';

// Set debug for true (testing only)
$wgEnableScriptDebug = false;

// This will tell the library to use Iframe Rewrite Method
$wgKalturaIframeRewrite = 'true';

// This will tell the library to enable the Iframe Api
$wgEnableIframeApi = 'true';

// Show control bar on iPad
$wgEnableIpadHTMLControls = 'true';

// Use playManifest
$wgKalturaUseManifestUrls = 'true';

// Define which modules to load
$wgMwEmbedEnabledModules = array( 'EmbedPlayer', 'KalturaSupport', 'AdSupport', 'Playlist', 'TimedText' );

?>