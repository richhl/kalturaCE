<?php

?>

<div style="margin:10px">
<form action="" method="post">
<?
$i=0; 
foreach ( $embed_code_list as $embed_code ) 
{
?>
<div id="embed_<? echo $i ?>_xml">
	<textarea style='width:75%; height:120px; ' id="embed_<? echo $i ?>_xml" name="embed_<? echo $i ?>_xml">
<?  echo html_entity_decode( $embed_code )?>	
	</textarea>
</div>
<?
$i++; 
} ?>

	<input type="submit" name="merge" value="merge">
</form>

<textarea style='width:75%; height:120px;'>
<? echo $embed_merge ?>
</textarea>
<? echo $embed_merge ?>
</div>