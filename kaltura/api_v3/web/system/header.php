<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html lang="en">
<head>
 <title>Kaltura Server Management</title>
 <link rel="stylesheet" href="css/main.css" />
 <style type="text/css">@import "./css/system.css";</style>
 <style type="text/css">@import "./css/jquery.datepick.css";</style>
 <script type="text/javascript" src="./js/jquery-1.3.1.min.js"></script>
 <script type="text/javascript" src="./js/jquery.datepick.js"></script>
 <script type="text/javascript">
  function gotoPage( page_to_go ) {
	pg = document.getElementById('page');
	pg.value= page_to_go;
	document.getElementById('form1').submit();
  }

  function investigate ( entryId ) {
	window.location = "./investigate.php?entry_id=" + entryId;
  }

  function get(id) {
	return document.getElementById(id);
  }

  function sh(obj) {
	os=get(obj).style;
    if (os) {
		if(os.display=='none' || !os.display) 
			os.display='block';
		else
			os.display='none';
	}
  }
</script> 
</head>
<body>
	<? include "toolbar.php" ?>
    <div id="content">
