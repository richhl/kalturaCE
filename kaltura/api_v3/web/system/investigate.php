<?php
require_once("systembase.php");
require_once("investigateHelper.class.php");

//entryPeer::setUseCriteriaFilter( false );
$entry_id = getP ("entry_id");
$entry = entryPeer::retrieveByPK( $entry_id );

$message = getP ( "message" , "" );

$error = "";

if ( $entry_id && ! $entry)
{
	$error = "No such entry [$entry_id]";
}
else
{

// from conversion table
$c = new Criteria();
$c->add ( conversionPeer::ENTRY_ID , $entry_id );
$c->addAscendingOrderByColumn( conversionPeer::ID );
$conversions = conversionPeer::doSelect( $c );


// from batch_job table
$c = new Criteria();
//$c->add ( BatchJobPeer::DATA , "%\"entryId\";i:" . $entry_id . ";%" , Criteria::LIKE );
$c->add ( BatchJobPeer::ENTRY_ID, $entry_id ); 
$c->addAscendingOrderByColumn( BatchJobPeer::ID );
$batch_jobs = BatchJobPeer::doSelect( $c );

// from notification table
$c = new Criteria();
//$c->add ( BatchJobPeer::DATA , "%\"entryId\";i:" . $entry_id . ";%" , Criteria::LIKE );
$c->add ( notificationPeer::OBJECT_TYPE, notification::NOTIFICATION_OBJECT_TYPE_ENTRY ); 
$c->add ( notificationPeer::OBJECT_ID, $entry_id ); 
$c->addAscendingOrderByColumn( notificationPeer::ID ); 
$notifications  = notificationPeer::doSelect( $c );
}
?>

<? require ( "header.php") ?>

<style type="text/css">
.investigate { font-family: arial ; font-size : 12px; }

</style>

<script type="text/javascript" src="./js/jquery-1.3.1.min.js"></script>
<script type="text/javascript">
jQuery.noConflict();
function show ( elem )
{
//	alert ( "1" );
	e = jQuery ( elem );
	t = e.find( "textarea" ).text() ;
	_the_text = jQuery ( "#the_text" );
	text_area  = _the_text.find ( "textarea" );
	text_area.text ( t );
	_the_text.css ( "display" , "block" );
}

function closeText()
{
	_the_text = jQuery ( "#the_text" );
	_the_text.css ( "display" , "none" );
}

function restartJob(url)
{
	if (confirm("Restart Job?"))
		document.location = url;
}

function reconvert ( url )
{
	if (confirm("Reconvert ?"))
		document.location = url;
}

function resendNotification(url)
{
	if (confirm("Resend Notification?"))
		document.location = url;
}

function update ( val , id , property_name )
{
//	val = elem.innerHTML; 
	var new_val = prompt ( "Change propery '" +  property_name + "' from [" + val + "]" );
	if ( new_val )
	{
		res = confirm  ("are you sure you'd like to update propery '" +  property_name + "' with value [" + new_val + "] ??" );
		if ( res )
		{
			// TODO - executeCommand .... 
			url = "./executeCommand?command=updateEntry&id=" + id + "&name=" + property_name + "&value=" + new_val;
			// ajax for the poor :-()
			var temp_image = new Image();
			temp_image.src = url; 
			
			setTimeout ( 'delayedReload()' , 1000 );
		}
	} 
}

var conv_window = null;
function conversionProfileMgr ( conv_quality )
{
	partner_id = '<? echo $entry ? $entry->getpartnerId() : "" ?>';
	// TODO - conversionProfileMgr
	url = "./conversionProfileMgr?go=go&filter__eq_partner_id=" + partner_id + "&filter__eq_profile_type=" + conv_quality;
	conv_window = window.open ( url , "conv_window" );
}

function delayedReload()
{
	window.location.reload();
}
</script>

<h3>Investigate</h3>
<p class="investigate_desc">In this page you can research a specific entry and its ingestion flow. You can see the conversion parameters of the encoder (ffmpeg / man),<br /> view error logs, and retry processes that failed to execute or complete (import, conversion).<br />
The tables below provide details about a specific entry, it's status and tools to investigate what went wrong during the entry ingestion process.</p>

<div style="width: 80%; font-family: arial; font-size: 12px; ">

<span style="display:none;position:absolute;top:100px;left:100px; width:400; height:600;" id="the_text">
<textarea style="border:3px solid gold" cols=80 rows=30></textarea>
<button onclick="closeText()">X</button>
</span>

<br>
<? echo $error; ?>
<form action="./investigate.php">
	Entry Id: <input type="text" name="entry_id" value="<? echo $entry_id ?>">

<input type="submit" id="Go" name="Go" value="Go"/>
</form>

<?
if ( ! $entry ) die();
 ?>

<span style='color:red'><?= $message ?></span><br/>

Entry:
<br>
	This table provides basic information regarding the investigated entry.
<br>
<table border=1 cellspacing=0 class='investigate'	>
	<? echo investigateHelper::printEntryHeader() . " " . investigateHelper::printEntry ( $entry ) ?>
</table>

<br>
Conversions (<? echo count ($conversions) ?>):<br />
This table provides a log of the conversions applied to this entry media file. Every conversion attempt is logged as a new row in the table.
<br>
<table border=1 cellspacing=0 class='investigate'>
	<? echo investigateHelper::printConversionHeader(  $entry->getId() , ($entry->getMediaType() == 1 ) && $entry->getStatus() >= 1 ) ; ?>
	<? foreach ( $conversions as $conversion ) { 
			echo investigateHelper::printConversion( $conversion ,  $entry->getId() ,  false , ($entry->getMediaType() == 1 ));
	} ?>
</table>

<br>
Batch Jobs (<? echo count ($batch_jobs) ?>):
<br>
	This table describes the various batch jobs that were and are being carried out on the investigated entry, typically import and conversion<br />
<table border=1 cellspacing=0 class='investigate'>
<? echo investigateHelper::printBatchjobHeader() ?>
	<? foreach ( $batch_jobs as $bj ) {
		echo investigateHelper::printBatchjob( $bj );
	} ?>
</table>

<br>
<?php 
$data_file_name = myContentStorage::getFSContentRootPath() . $entry->getDataPath();
$data_file_dir  = dirname ( $data_file_name ) ;
?>
<? echo investigateHelper::listFilesInDir( "Data" , $entry_id, $data_file_dir . "/" . $entry->getId() . "*" , true , "This table describes the various files that were created during the ingestion process of this entry and the related media files that were imported and converted (e.g. log files, media files, info and binary files used to read video metadata, etc.)." ); ?>
<br>
<?
$thumbnail_file_name = myContentStorage::getFSContentRootPath() . $entry->getThumbnailPath();
$thumbnail_file_dir  = dirname ( $thumbnail_file_name ) ; 
echo investigateHelper::listFilesInDir( "Thumbnail" , $entry_id, $thumbnail_file_dir . "/" . $entry->getId() . "*" , true , "This table describes all the thumbnails created for this entry." ); ?>

<br>
<?php
$archive_path = str_replace( "content/entry" ,  "archive" , $data_file_dir ); 
echo investigateHelper::listFilesInDir( "Archive" , $entry_id, $archive_path . "/" . $entry->getId() . "*" , true , "This table describes the original files copied to the archive folder." ); ?>

<br>
<?php 
$download_path =  str_replace( "data" ,  "download" , $data_file_dir );
echo investigateHelper::listFilesInDir( "Download" , $entry_id, $download_path . "/" . $entry->getId() . "*" , true , "This table describes all the available files (in various format requests by the addDownload and requestConversion services) created for download." ); ?>


<br>
Notifications (<? echo count ($notifications) ?>):<br>
This table logs all the various notifications sent regarding this entry.<br />
<table border=1 cellspacing=0 class='investigate notifications'>
<? echo investigateHelper::printNotificationHeader() ?>
	<? foreach ( $notifications as $notification ) {
		echo investigateHelper::printNotification( $notification );
	} ?>
</table>

<br>
<script>
	$(function(){
		$('#entries_table th').mouseover(function(e){
			$(this).find('.tooltip').show();
			if ((e.pageX + $(this).find('.tooltip').width()+50) >= $(window).width()){
				$(this).find('.tooltip').css('margin-left', '-200px');
			}
			
		}).mouseout(function(){
			$('.tooltip').hide();
		});		
		$('.investigate td').mouseover(function(e){
			$(this).find('.tooltip').show();
			if ((e.pageX + $(this).find('.tooltip').width()+100) >= $(window).width()){
				$(this).find('.tooltip').css('margin-left', '-200px');
			}
		}).mouseout(function(){
			$('.tooltip').hide();
		});
	});
</script>
</div>
<? require ( "footer.php") ?>