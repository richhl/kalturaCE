<?php 
require_once("systembase.php");
$comp_name = php_uname('n');
$kaltura_root_folder = str_replace('kaltura/api_v3/web/system', '', dirname(__FILE__));

function getBatchDescription ( $batch_name , $highlight_log )
{
	global $kaltura_root_folder,$comp_name;
	
	$style = "";
	if ( $highlight_log ) $style = 'background-color:#FF6666';
	
	$batch_log = "<li>Log file: ".$kaltura_root_folder.'logs/'.$comp_name.$batch_name.'.log</li>';

	$res = "";
	switch ( $batch_name )
	{
		case "all" :
			$res = "Use the buttons to the left to start, stop or restart all of the processes.";
			break;
		case "batchImportServer":
			$res = "<p>File importing process from external URLs. This process pulls a URL and entryId from the database. Uses CURL to download the media from the given URL and creates a file for ConvertClient to process.</p>
				<ul><li>If this batch is down, the system will not download files from remote URLs added by calling the addEntry service.</li>".$batch_log.'</ul>';
			break;
		case "batchEmailServer":
			$res = "<p>Sends emails asynchronously. This process requires the SMTP server to be running and configured properly on the machine.</p>
				<ul><li>If this batch is down, no emails will be sent.</li>".$batch_log.'</ul>';
			break;
		case "batchDownloadVideoServer":
			$res = "<p>Handles the conversion jobs requested by the addDownload service. <span id=\"batchDownloadVideoServer\">Similar to newBatchConvertClient, this process creates jobs for the newBatchConvertServer. When a conversion job is completed, this process sends a notification email stating that the conversion is done and the file is ready for download.</span><a id=\"more_batchDownloadVideoServer\" href=\"#\">more</a></p>
				<ul><li>If this batch is down, users will not be able to download content either via Content tab in management console nor via the addDownload API</li>".$batch_log.'</ul>';
			break;
		case "newBatchConvertClient":
			$res = "<p>When a new video / audio entry is created, the media file is marked for conversion. This process reads the conversion profile for the entry <span id=\"newBatchConvertClient\">(if a profile does not exist for the entry, it retrieves the conversion profile for the partner that owns the entry), and creates a new job for the newBatchConvertServer indicating the path to the source file, the path to create the new converted file at, the log file name and the result log path. When the file conversion is completed by the newBatchConvertServer, the newBatchConvertClient updates the database and conversions tables and also creates a notification indicating the conversion was completed.</span><a id=\"more_newBatchConvertClient\" href=\"#\">more</a></p>
				<ul><li>If this batch is down, new entries will not be converted and reconvert requests will not be processed.</li>".$batch_log.'</ul>';
			break;
		case "batchNotificationServer":
			$res = "<p>Sends notifications to services hosted on external servers (usually partner's CMS/ web site)<span id=\"batchNotificationServer\">, providing information and status about various actions in the system (i.e file conversion completed, for the full list of notifications see <a href=\"http://corp.kaltura.com/wiki/index.php/KalturaAPI:notifications\">here</a>). A Notification is a message, sent by the Kaltura server, in order to notify external applications about events that occur on the Kaltura server.</span> <a id=\"more_batchNotificationServer\" href=\"#\">more</a></p>
				<ul><li>If this batch is down, notifications will not be sent.</li>".$batch_log.'</ul>';
			break;
		case "batchBulkUpload":
 			$res = "<p>Handles multiple imports of media from external URLs. The process parses a given csv file and calls the addEntry service for each line.</p>
				<ul><li>If this batch is down, the CSV files submitted by the addBulkUpload service will not be handled.</li>".$batch_log.'</ul>';
			break;		
		case "newBatchConvertServer":
			$res = "<p>A wrapper process for the transcoders (ffmpeg, mencoder or flix). This process is responsible for the actual conversion of media files. <span class=\"more\" id=\"newBatchConvertServer\">The process works on the conversion commands (location of the input file, target file and conversion properties) that newBatchConvertClient or batchDownloadVideoServer create, and performs the conversion. When a conversion is completed, the client (responsible for the job command) finalizes the conversion process by updating the database. This process is designed to run in multiple instances in order to maximize system capabilities to handle concurrent multiple conversions.</span><a id=\"more_newBatchConvertServer\" href=\"#\">more</a></p>
				<ul><li>If this batch is down, entries will not be converted.</li>".$batch_log.'</ul>';
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

$batch = urldecode(getP( "batch")) ;
$action = getP( "action") ;

if ( $batch && $action )
{
	if ( $batch == "all" )
	{
		batchStatus::executeRunBatch ( $action , "" );
		sleep ( 8 ) ;
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
		sleep ( 4 );
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
	<input type='hidden' name='batch' id='batch' value='<?php echo  $batch ?>'>
	<input type='hidden' name='action' id='action' value='<?php echo  $action ?>'>
</form>

<h3>BatchWatch
	<?php
	include('batchwatchStatus.php');
	if ($batch_status > 0) {
		$word = ($batch_status > 1)? 'are': 'is';
		echo '<span>: ' . $batch_status;
	?>
	 of the batches <?php echo $word?> down. </span>
	<?php
	}
	?>
</h3>
<ul id="show_options">
 <li><a href="javascript:sh('howwhen')">What is this and how should I use it ?</a>
  <ul id="howwhen">
   <li>Batch processing is the execution of a series of programs ("jobs") on a computer without human interaction.</li>
   <li>The table below shows you the status of the different Kaltura batch processes running on your CE server.</li>
   <li>Use this page to get an overview of the current load on your server and to identify bottlenecks.</li>
   <li>The "Usage Statistics" column indicates the load on the system. It shows both the number of jobs currently being processed and the number of jobs waiting in queue for that batch process.</li>
   <li>Use the buttons in the "Actions" column to start, stop or restart a specific batch process.</li>
   <li>To start, stop or restart ALL the batch processes running on your CE server, use the bigger buttons located above the table.</li>
   <li>In the &quot;Process&quot; column are the names of the batch processes' source files (located at: kalturaCE/kaltura/alpha/batch).</li>
   <!--<li>All batch processes are controlled and watched by two batch scripts:
     <ul>
	 <li>BatchRunner: the script that is responsible for running and stopping the
	   batch processes.&nbsp; The log file for this script can be found at<br>
	   <?php echo $kaltura_root_folder.'logs/'.$comp_name.'batchRunner.log'; ?></li>
	 <li>BatchWatch: the main process responsible for monitoring the various running
	   processes.&nbsp; The log file for this script can be found at<br>
	   <?php echo $kaltura_root_folder.'logs/'.$comp_name.'batchWatch.log'; ?></li>
    </ul>
   </li>-->
  </ul>
 </li>
</ul>
  
<div id="batch_controler">
  <a href="javascript:updateBatchStatus ( 'all' , 'start' )"><img src="images/play.png" alt="Start all batches"> Start All Batches</a>
  <a href="javascript:updateBatchStatus ( 'all' , 'stop' )"><img src="images/stop.png" alt="Stop all batches"> Stop All Batches</a>
  <a href="javascript:updateBatchStatus ( 'all' , 'restart' )"><img src="images/refresh.png" alt="Restart all batches"> Restart All Batches</a>
 </div>

<table id="batchwatch_table" border="0" cellpadding="0" cellspacing="0">
<tr>
	<th width="100">Process</th>
	<th width="500">Description</th>
	<th width="60">Status</th>
	<th width="100">Usage Statistics</th>
	<th width="60">Action</th>
</tr>

<?php
$even = 0;
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
		"<td>" . getBatchDescription ( $batch_status->getName() , ( $error ? true : false ) ) . "</td>" .
		"<td><div". ((!$status)? ' class="error"': '') .">" . ( $status ? "Up" : "Down" ) . "</div></td>" .
		"<td class=\"status\">Now:" . 
			"<ul><li title='$pending_data' style='" . formatStyle ( $batch_status->pending ) . "'>In queue: " . $batch_status->pending ."</li>" . 
			"<li title='$in_proc_data' style='" . formatStyle ( $batch_status->in_proc ) . "'>In process: " . $batch_status->in_proc . "</li></ul>"; 

/*			"<span style='" . formatStyle ( $batch_status->pending ) . "'>In queue:" . $batch_status->pending ."</span><br/>" . 
//			"<span>" . print_r ( $batch_status->getPendingData() , true ) ."</span><br/>" .
			"<span style='" . formatStyle ( $batch_status->in_proc ) . "'>In process:" . $batch_status->in_proc . "</span><br/>" ;
//			"<span>" . print_r ( $batch_status->getInProcData() , true ) . "</span><br/>" ;*/

	if ( $batch_status->succeedded_in_period !== null || $batch_status->failed_in_period !== null )
	{
		echo	"Last 24 Hours:<ul>" . 
			( $batch_status->succeedded_in_period !== null ? "<li>Success: " . $batch_status->succeedded_in_period . "</li>" : "" ) .
			( $batch_status->failed_in_period !== null ? "<li>Fail: " . $batch_status->failed_in_period . "</li>" : "" ) ;
		echo "</ul>";
	}
	echo	"<td>" .
			"<p><a href='javascript:updateBatchStatus ( \"" . urlencode(addslashes($batch_status->batch_name)) . "\" , \"start\" )'>Start</a></p>" .
			"<p><a href='javascript:updateBatchStatus ( \"" . urlencode(addslashes($batch_status->batch_name)) . "\" , \"stop\" )'>Stop</a></p>" .
			"<p><a href='javascript:updateBatchStatus ( \"" . urlencode(addslashes($batch_status->batch_name)) . "\" , \"restart\" )'>Restart</a></p>" .
		"</tr>";
}
 ?>
 
 </table>
<script>
	$(function(){
		$('#batchwatch_table td span').each(function(){
			if (this.id.indexOf('atch') >= 0) $(this).css('display', 'none');
		});
		$('#batchwatch_table td a').each(function(){
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