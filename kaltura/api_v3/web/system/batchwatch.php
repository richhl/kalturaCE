<?php 
require_once("systembase.php");
$comp_name = trim(`uname -n`).'-';
if (!$comp_name)
{
  exec('uname -n',$output,$error);
  $comp_name = trim($output[0]).'-';
}
$kaltura_root_folder = str_replace('kaltura/api_v3/web/system', '', dirname(__FILE__));

function getBatchDescription ( $batch_name , $highlight_log )
{
	global $kaltura_root_folder,$comp_name;
	
	$style = "";
	if ( $highlight_log ) $style = 'background-color:#FF6666';
	
	$batch_log = "<br /><br /><span style=\"$style\">log file: ".$kaltura_root_folder.'logs/'.$comp_name.$batch_name.'.log</span>';

	$res = "";
	switch ( $batch_name )
	{
		case "all" :
			$res = "Use the buttons to the left to start, stop or restart all of the processes.";
			break;
		case "batchImportServer":
			$res = "File importing process from external URLs. This process pulls a URL and entryId from the database. Uses CURL to download the media from the given URL and creates a file for ConvertClient to process.<br>
				<br /><span class=\"tip\">If this batch is down, the system will not download files from remote URLs added by calling the addEntry service.</span>".$batch_log;
			break;
		case "batchEmailServer":
			$res = "Sends emails asynchronously. This process requires the SMTP server to be running and configured properly on the machine.<br>
				<br /><span class=\"tip\">If this batch is down, no emails will be sent.</span>".$batch_log;
			break;
		case "batchDownloadVideoServer":
			$res = "Handles the conversion jobs requested by the addDownload service. <span id=\"batchDownloadVideoServer\">Similar to newBatchConvertClient, this process creates jobs for the newBatchConvertServer. When a conversion job is completed, this process sends a notification email stating that the conversion is done and the file is ready for download.</span><a id=\"more_batchDownloadVideoServer\" href=\"#\">more</a><br>
				<br /><span class=\"tip\">If this batch is down, users will not be able to download content either via Content tab in management console nor via the addDownload API</span>".$batch_log;
			break;
		case "newBatchConvertClient":
			$res = "When a new video / audio entry is created, the media file is marked for conversion, this process reads the conversion profile for the entry <span id=\"newBatchConvertClient\">(if a profile does not exist for the entry, it retrieves the conversion profile for the partner that owns the entry) and creates a new job for the newBatchConvertServer indicating the path to the source file, the path to create the new converted file at, the log file name and result log path. When the file conversion is completed by the newBatchConvertServer, the newBatchConvertClient is updates the database and conversions tables and also creates a notification indicating the conversion was completed.</span><a id=\"more_newBatchConvertClient\" href=\"#\">more</a><br>
				<br /><span class=\"tip\">If this batch is down, new entries will not be converted and reconvert requests will not be processed.</span>".$batch_log;
			break;
		case "batchNotificationServer":
			$res = "Sends notifications to services hosted on external servers (usually partner's CMS/ web site)<span id=\"batchNotificationServer\">, providing information and status about various actions in the system (i.e file conversion completed, for the full list of notifications see [link:api docs on notifications]). A Notification is a message, sent by the Kaltura server, in order to notify external applications about events that occur on the Kaltura server.</span> <a id=\"more_batchNotificationServer\" href=\"#\">more</a><br>
				<br /><span class=\"tip\">If this batch is down, notifications will not be sent.</span>".$batch_log;
			break;
		case "batchBulkUpload":
 			$res = "Handles multiple imports of media from external URLs. The process parses a given csv file and calls the addEntry service for each line.<br>
				<br /><span class=\"tip\">If this batch is down, the CSV files submitted by the addBulkUpload service will not be handled.</span>".$batch_log;
			break;		
		case "newBatchConvertServer":
			$res = "A wrapper process for the transcoders (ffmpeg, mencoder or flix). This process is responsible for the actual conversion of media files. <span class=\"more\" id=\"newBatchConvertServer\">The process works on the conversion commands (location of the input file, target file and conversion properties) that newBatchConvertClient or batchDownloadVideoServer create, and performs the conversion. When a conversion is completed, the client (responsible for the job command) finalizes the conversion process by updating the database. This process is designed to run in multiple instances in order to maximize system capabilities to handle concurrent multiple conversions.</span><a id=\"more_newBatchConvertServer\" href=\"#\">more</a><br>
				<br /><span class=\"tip\">If this batch is down, entries will not be converted.</span>".$batch_log;
			break;
	}
	
	return str_replace ( "'" , "&apos;" ,  $res );
}

function formatStyle ( $value )
{
	if ( $value == 0 ) $res = "";//background-color:black";
	if ( $value > 0  ) $res = "background-color:#0066CC; color: white;";
	if ( $value > 10 ) $res = "background-color:#66FF66";
	if ( $value > 30 ) $res = "background-color:#FF9900";
	if ( $value > 50 ) $res = "background-color:#FF3333; color: white;";
	return $res;
}

$batch = getP( "batch") ;
$action = getP( "action") ;

if ( $batch && $action )
{
	if ( $batch == "all" )
	{
		batchStatus::executeRunBatch ( $action , "" );
		sleep ( 3 ) ;
	}
	else
	{
		$batch_status = new batchStatus();
		$batch_status->batch_name = $batch;
		if ($action == "start" )
			$batch_status->start();
		elseif ($action == "stop" )
			$batch_status->stop();
		elseif ($action == "restart" )
			$batch_status->restart();
			
		// sleep after updating the status so the process will indeed start/stop and it will reflect in the new status 
		sleep ( 2 );
	}
}

$all_batch_status = myBatchBase::getAllRegistered();
require_once('header.php');
require_once('systemStatus.php');

// loop over all the batches to see if any of them are causing an error
$exists_error = false;
foreach ( $all_batch_status as $batch_status )
{
	$status = $batch_status->getStatus();
	
	// see if the desired action n the batch was completed successfully
	if ( $batch == $batch_status->batch_name || $batch == "all" )
	{
		// for action "stop" - status should be 0
		// for other actions ('start' / 'restart') - status should be > 0
		if ( ( $status && $action == "stop" ) || ( ! $status && $action != "stop" ) ) 
		{
			$exists_error = true;
		}
	}
}

?>
<script type="text/javascript">
function updateBatchStatus ( batch , action )
{
	document.getElementById("batch").value = batch;
	document.getElementById("action").value = action;
	document.getElementById("form1").submit();
	//window.location ="?batch=" + batch + "&action=" + action;
}
</script>
<form id='form1' method='post'>
	<input type='hidden' name='batch' id='batch' value='<?= $batch ?>'>
	<input type='hidden' name='action' id='action' value='<?= $action ?>'>
</form>
<h3>Batchwatch</h3>
<div class="status_summary">
	<?php
	include('batchwatchStatus.php');
	if ($batch_status > 0) {
		$word = ($batch_status > 1)? 'are': 'is';
		echo $batch_status;
	?>
	 of the batches <?php echo $word; ?> down. 
	<?
	}
	?>
	<a href="#batchwatch_status">Jump to batch status</a>
</div>
<div class="intro">
	<p>The information below indicates the status of the different Kaltura batch processes running in the system.</p>
	<p>* Batch processing is execution of a series of programs ("jobs") on a computer without human interaction.<sup>[<a href="http://en.wikipedia.org/wiki/Batch_processing">source</a>]</sup></p>
	<p>Every line in the table below represents a batch process in the system.<br />
	Using the buttons in the "Actions" column, you can start, stop or restart the specific process that each line represents.<br />
	The "Usage Statistics" column indicates the load on the system. It shows the amount of work each process is currently handling and the amount of work in queue for each process. This provides the administrator with an overview of the current status and helps to identify bottlenecks. </p>
	<p>* Tip: The names of the processes represent the name of their respective source files located at the following path: <br />
	kalturaCE/kaltura/alpha/batch</p>

	<div class="batch_logs">
		<h5>General Batch Logs</h5>
		<p>All batch processes are being controlled and watched by two scripts:</p>
	<ul>
		<li>BatchRunner
			<ul>
				<li>Description: the script that is responsible of running and stopping the batch processes in the system listed below.</li>
				<li>log: 
				<?php if ( $exists_error ) { ?>
				<span style='background-color:#FF6666''><?php echo $kaltura_root_folder.'logs/'.$comp_name.'batchRunner.log'; ?></span> Please check the log for possible errors.
				<?php } else { ?>	
				<?php echo $kaltura_root_folder.'logs/'.$comp_name.'batchRunner.log'; ?>
				<?php } ?>
				</li>
			</ul>
		<li>BatchWatch
			<ul>
				<li>Description: the main process responsible of monitoring the various running processes.</li>
				<li>log: <?php echo $kaltura_root_folder.'logs/'.$comp_name.'batchWatch.log'; ?></li>
			</ul>
		</li>
	</ul>
	</div>

</div>

<a name="batchwatch_status"></a>
<div class="all_batch_control">
	<h5>All batchs</h5>
	<a class="startAll" href='javascript:updateBatchStatus ( "all" , "start" )' alt="">Start all batchs</a>
	<a class="stopAll" href='javascript:updateBatchStatus ( "all" , "stop" )' alt="">Stop all batchs</a>
	<a class="restartAll" href='javascript:updateBatchStatus ( "all" , "restart" )' alt="">Restart all batchs</a>
	<div class="clear-fix"></div>
</div>
<table class='batchwatch_table' border="0" cellpadding="0" cellspacing="0">
<tr class='batchwatch_table_header'>
	<th width="100px">Process</th>
	<th width="100px">Description</th>
	<th width='60px'>Status</th>
	<th width="100px">Usage Statistics</th>
	<th width="60px">Action</th>
</tr>

<?
$even = 1;
foreach ( $all_batch_status as $batch_status )
{
	$class = ($even%2)? ' class="even"': '';
	$even++;
//	$batchStatus = new batchStatus();
	$status = $batch_status->getStatus();
	
	$error = "";
	// see if the desired action n the batch was completed successfully
	if ( $batch == $batch_status->batch_name || $batch == "all" )
	{
		// for action "stop" - status should be 0
		// for other actions ('start' / 'restart') - status should be > 0
		if ( ( $status && $action == "stop" ) || ( ! $status && $action != "stop" ) ) 
		{
			$error = "<br/><br/><span style='background-color:#FF6666'>Request [$action] failed.</span><br/>See the log file for more information.";
		}
	}
	
	$pending_data = htmlspecialchars ( print_r ( $batch_status->getPendingData() , true ) , ENT_QUOTES );
	$in_proc_data = htmlspecialchars ( print_r ( $batch_status->getInProcData() , true ) , ENT_QUOTES );
	
	echo "<tr".$class.">" .
		"<td>" . $batch_status->getName() . "$error</td>" . 
		"<td style='width:500px;' >" . getBatchDescription ( $batch_status->getName() , ( $error ? true : false ) ) . "</td>" .
		"<td style='" . ( $status ? "background-color:#66FF66" : "background-color:#FF6666" ). "'>" . ( $status ? "Up" : "Down" ) . "</td>" .
		"<td class=\"status\"><b>Now:</b>" . 
			"<ul><li title='$pending_data' style='" . formatStyle ( $batch_status->pending ) . "'>In queue: " . $batch_status->pending ."</li>" . 
			"<li title='$in_proc_data' style='" . formatStyle ( $batch_status->in_proc ) . "'>In process: " . $batch_status->in_proc . "</li></ul>"; 

/*			"<span style='" . formatStyle ( $batch_status->pending ) . "'>In queue:" . $batch_status->pending ."</span><br/>" . 
//			"<span>" . print_r ( $batch_status->getPendingData() , true ) ."</span><br/>" .
			"<span style='" . formatStyle ( $batch_status->in_proc ) . "'>In process:" . $batch_status->in_proc . "</span><br/>" ;
//			"<span>" . print_r ( $batch_status->getInProcData() , true ) . "</span><br/>" ;*/

	if ( $batch_status->succeedded_in_period !== null || $batch_status->failed_in_period !== null )
	{
		echo	"<b>Last 24 Hours:</b><ul>" . 
			( $batch_status->succeedded_in_period !== null ? "<li>Success: " . $batch_status->succeedded_in_period . "</li>" : "" ) .
			( $batch_status->failed_in_period !== null ? "<li>Fail: " . $batch_status->failed_in_period . "</li>" : "" ) ;
		echo "</ul>";
	}
	echo	"<td style='vertical-align:top'>" .
			"<a href='javascript:updateBatchStatus ( \"" . $batch_status->batch_name . "\" , \"start\" )'>Start</a><br><br>" .
			"<a href='javascript:updateBatchStatus ( \"" . $batch_status->batch_name . "\" , \"stop\" )'>Stop</a><br><br>" .
			"<a href='javascript:updateBatchStatus ( \"" . $batch_status->batch_name . "\" , \"restart\" )'>Restart</a><br>" .
		"</tr>";
}
 ?>
 
 </table>
<script>
	$(function(){
		$('.batchwatch_table td span').each(function(){
			if (this.id.indexOf('atch') >= 0) $(this).css('display', 'none');
		});
		$('.batchwatch_table td a').each(function(){
			a_id = this.id;
			if (a_id.indexOf('more_') >= 0){
				$(this).click(function(){
					span_id = this.id.substr(5);
					$('#'+span_id).toggle();
					if ($('#'+span_id).css('display') == 'none')
						this.innerHTML = 'more';
					else
						this.innerHTML = 'less';
					
					return false;
				});
			}
		});
	});
</script>
<?php require_once('footer.php'); ?>