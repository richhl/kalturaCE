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
<script>this_investigate_page = true;</script>
<a name="top"></a>
<h2>Investigate Entry</h2>
<p>Use this page to fully research a specific entry and detailed information
  about the processes, files and log entries that happened or were created over
its lifetime, and their status.&nbsp; This page is the place to go to investigate what went wrong during the entry ingestion process.</p>

<span style="display:none;position:absolute;top:100px;left:100px; width:400; height:600;" id="the_text">
<textarea style="border:3px solid gold" cols=80 rows=30></textarea>
<button onclick="closeText()">X</button>
</span>

<? echo $error; ?>
<form id="investigate_entry" action="./investigate.php">
	<label>Entry Id: <input type="text" name="entry_id" value="<? echo $entry_id ?>"></label>
	<input type="submit" id="Go" name="Go" value="Go"/>
    <p>Jump To: <a href="#batch" title="This table describes the various batch jobs that were and are being carried out on the investigated entry, typically import and conversion">Batch Jobs</a> | <a href="#conv">Conversions
        Log</a> | <a href="#files" title="All files that were created during the ingestion process of this entry as well as related media files that were imported and converted (e.g. log files, media files, info and binary files used to read video metadata, etc.).">Files</a> | <a href="#thumbs" title="All the thumbnails created for this Entry over its history.">Thumbnails'
        Log</a> | <a href="#archive" title="Lists all the original files copied to the archive folder.">Archive</a> | <a href="#download" title="This table describes all the available files (in various format requests by the addDownload and requestConversion services) created for download.">Download</a> | <a href="#notify" title="This table logs all the various notifications sent regarding this entry.">Notifications</a> </p>
</form>
<?
if ( ! $entry ) die();
if ($message):
?>
<span style='color:red'>
<?= $message ?>
</span><br />
<?
endif;
?>
<?php
if ($entry->getStatus() < 0):
?>
<div id="error_get_help">
	<div>
		<h3>Need help?</h3>
		report this error to Kaltura and get support from the Kaltura community<br /><br />
	</div>
	<form action="http://www.kaltura.org/kalturaservices/postthread" method="post" target="_blank" id="error_report_form">
		<input type="hidden" name="requesttype" value="investigate" />
		<input type="hidden" name="partnerid" value="<?php echo kConf::get('kaltura_partner_id'); ?>" />
		<textarea name="investigate" id="investigate_post">
		</textarea>
		<button id="send_investigate">Report error &amp; get support</button>
	</form>
</div><!-- endReportorm -->
<?php
endif;
?>
<table cellspacing=0 class="investigate">
 <caption>
 <h3>General Info:</h3>
 </caption>
	<? echo investigateHelper::printEntryHeader() . " " . investigateHelper::printEntry ( $entry ) ?>
</table>

<a name="conv"></a>
 <table cellspacing=0 class="investigate">
   <caption>
	<h3>Conversions Log <span>(Total: <? echo count ($conversions) ?>) &nbsp; [<a href="#top">top</a>]</span></h3>
   This table provides a log of the conversions applied to this entry media file. Every conversion attempt is logged as a new row in the table.
   </caption>
	<? echo investigateHelper::printConversionHeader(  $entry->getId() , ($entry->getMediaType() == 1 ) && $entry->getStatus() >= 1 ) ; ?>
	<?
	if (!count($conversions))
	{
		echo '<tr><td colspan="15">&nbsp;</td></tr>';
	}
	else
	{
		foreach ( $conversions as $conversion ) { 
			echo investigateHelper::printConversion( $conversion ,  $entry->getId() ,  false , ($entry->getMediaType() == 1 ));
		}
	}
	?>
</table>


<a name="batch"></a>
 <table cellspacing=0 class="investigate">
  <caption>
  <h3>Batch Jobs <span>(Total: <? echo count ($batch_jobs); ?>) &nbsp; [<a href="#top">top</a>]</span></h3>
  This table describes the various batch jobs that were and are being carried out on the investigated entry, typically import and conversion
  </caption>
<? echo investigateHelper::printBatchjobHeader() ?>
	<?
	if (!count($batch_jobs))
	{
		echo '<tr><td colspan="14">&nbsp;</td></tr>';
	}
	else
	{
		foreach ( $batch_jobs as $bj ) {
			echo investigateHelper::printBatchjob( $bj );
		}
	}
	?>
</table>

<?php 
$data_file_name = myContentStorage::getFSContentRootPath() . $entry->getDataPath();
$data_file_dir  = dirname ( $data_file_name ) ;
?>
<a name="files"></a>
 <table cellspacing=0 class="investigate">
  <caption><h3>Files <span>&nbsp; [<a href="#top">top</a>]</span></h3>
   All files that were created during the ingestion process of this entry as well as related media files that were imported and converted (e.g. log files, media files, info and binary files used to read video metadata, etc.).
  </caption>
<? echo investigateHelper::listFilesInDir( "Data" , $entry_id, $data_file_dir . "/" . $entry->getId() . "*" , true , "This table describes the various files that were created during the ingestion process of this entry and the related media files that were imported and converted (e.g. log files, media files, info and binary files used to read video metadata, etc.)." ); ?>
</table>

<?
$thumbnail_file_name = myContentStorage::getFSContentRootPath() . $entry->getThumbnailPath();
$thumbnail_file_dir  = dirname ( $thumbnail_file_name ) ;
?>
 <a name="thumbs"></a>
 <table cellspacing=0 class="investigate">
  <caption>
  <h3>Thumbnails Log <span>&nbsp; [<a href="#top">top</a>]</span></h3>
  All the thumbnails created for this Entry over its history.
  </caption>
<? echo investigateHelper::listFilesInDir( "Thumbnail" , $entry_id, $thumbnail_file_dir . "/" . $entry->getId() . "*" , true , "This table describes all the thumbnails created for this entry." ); ?>
</table>

<?php
$archive_path = str_replace( "content/entry" ,  "archive" , $data_file_dir );
?>
<a name="archive"></a>
 <table cellspacing=0 class="investigate">
  <caption><h3>Archive <span>&nbsp; [<a href="#top">top</a>]</span></h3>Lists all the original files copied to the archive folder.
  </caption>
<? echo investigateHelper::listFilesInDir( "Archive" , $entry_id, $archive_path . "/" . $entry->getId() . "*" , true , "This table describes the original files copied to the archive folder." ); ?>
</table>

<a name="download"></a>
 <table cellspacing=0 class="investigate">
  <caption><h3>Download <span>&nbsp; [<a href="#top">top</a>]</span></h3>
	This table describes all the available files (in various format requests by the addDownload and requestConversion services) created for download.
  </caption>
<?php 
$download_path =  str_replace( "data" ,  "download" , $data_file_dir );
echo investigateHelper::listFilesInDir( "Download" , $entry_id, $download_path . "/" . $entry->getId() . "*" , true , "This table describes all the available files (in various format requests by the addDownload and requestConversion services) created for download." ); ?>
</table>

<a name="notify"></a>
 <table cellspacing=0 class="investigate">
  <caption><h3>Notifications <span>Total: <? echo count ($notifications) ?> &nbsp; [<a href="#top">top</a>]</span></h3>
This table logs all the various notifications sent regarding this entry.</caption>
<? echo investigateHelper::printNotificationHeader() ?>
	<?
	if (!count($notifications))
	{
		echo '<tr><td colspan="10">&nbsp;</td></tr>';
	}
	else
	{
		foreach ( $notifications as $notification ) {
			echo investigateHelper::printNotification( $notification );
		}
	}
	?>
</table>

<br>

<? require ( "footer.php") ?>