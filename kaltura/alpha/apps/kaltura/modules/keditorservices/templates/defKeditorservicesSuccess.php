<?php

?>

<div style="font-family:verdana; font-size: 11px">
Options for kshow (id=<? echo $kshow_id ?>)<br> 
add '&debug=true' to the url to see the result in a textarea<br> 
<a href="./keditorservices/getAllEntries?kshow_id=<? echo $kshow_id ?>&debug=<? echo $debug ?>">getAllEntries</a><br>
<a href="./keditorservices/getKshowInfo?kshow_id=<? echo $kshow_id ?>&debug=<? echo $debug ?>">getKshowInfo</a>
<br>
<a href="./keditorservices/getMetadata?kshow_id=<? echo $kshow_id ?>&debug=<? echo $debug ?>">getMetadata</a>
<br>
<a href="./keditorservices/setMetadata?kshow_id=<? echo $kshow_id ?>&debug=<? echo $debug ?>">setMetadata</a> 
<br>
<a href="./keditorservices/getGlobalAssets?kshow_id=<? echo $kshow_id ?>&debug=<? echo $debug ?>">getGlobalAssets (we don't yet have global assets in the DB)</a>
<br>
<a href="./keditorservices/getAllKshows?debug=<? echo $debug ?>">getAllKshows</a>
</div>
