<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
	<title>Kaltura CMS</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="/css/sdk_admin.css"/>
</head>
<body>
<div id="kaltura_player_div"></div>
	<script type="text/javascript">
		$ = jQuery;
		$(function () {
			var so = new SWFObject("<?=$swf_url; ?>", "kaltura_player", "<?=$width; ?>", "<?=$height; ?>", "9", "#000000");
			so.addParam("flashVars", "<?=$flash_vars_str; ?>");
			so.addParam("allowFullScreen", true);
			so.addParam("allowScriptAccess", "always");
			so.addParam("allowNetworking", "all");
			so.write("kaltura_player_div");
		});	
	</script>
</body>
</html>