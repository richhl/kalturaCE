<?php
// helper functionto convert from enums to strings
function getFromMap ( $value , $map , $display_value=true)
{
	if ( isset($map[$value]) ) return $map[$value] . ( $display_value ? " ($value)" : "" );
	return "($value)";	
}

$status_list = array ( 
	"" => "All" ,
	entry::ENTRY_STATUS_ERROR_CONVERTING => "Error",
	entry::ENTRY_STATUS_IMPORT => "Importing" ,
	entry::ENTRY_STATUS_PRECONVERT => "Converting" ,
	entry::ENTRY_STATUS_READY => "Ready" ,
	entry::ENTRY_STATUS_DELETED => "Deleted" ,
	entry::ENTRY_STATUS_MODERATE => "Auto-moderated" , 
	entry::ENTRY_STATUS_BLOCKED=> "Blocked" , 
);

$type_list = array (
	"" => "All" ,
	entry::ENTRY_TYPE_MEDIACLIP => "Media",
	entry::ENTRY_TYPE_SHOW => "Roughcut", 
	entry::ENTRY_TYPE_PLAYLIST => "Playlist" ,
	entry::ENTRY_TYPE_DOCUMENT => "Document" ,
);


$media_type_list = array (
	"" => "All" ,
	entry::ENTRY_MEDIA_TYPE_VIDEO => "Single Video",
	entry::ENTRY_MEDIA_TYPE_IMAGE => "Image", 
	entry::ENTRY_MEDIA_TYPE_AUDIO => "Audio" ,
	entry::ENTRY_MEDIA_TYPE_SHOW => "Mixed Video" ,
);

$type_list = array (
	"" => "All" ,
	entry::ENTRY_TYPE_MEDIACLIP => "Clip",
	entry::ENTRY_TYPE_SHOW => "Roughcut",
	entry::ENTRY_TYPE_PLAYLIST => "playlis" ,
	entry::ENTRY_TYPE_DOCUMENT => "Document", 
);

$conversion_status_list = array ( 
	"" => "All" ,
	conversion::CONVERSION_STATUS_ERROR => "Error" ,
	conversion::CONVERSION_STATUS_PRECONVERT => "Preconvert",
	conversion::CONVERSION_STATUS_COMPLETED => "Ready" ,
);

$batchjob_status_list = array ( 
	"" => "All" ,
	BatchJob::BATCHJOB_STATUS_PENDING => "Pending" ,
	BatchJob::BATCHJOB_STATUS_QUEUED => "Queued" , 
	BatchJob::BATCHJOB_STATUS_PROCESSING => "Processing" ,
	BatchJob::BATCHJOB_STATUS_PROCESSED => "Processed" ,
	BatchJob::BATCHJOB_STATUS_MOVEFILE => "MoveFile" ,
	BatchJob::BATCHJOB_STATUS_FINISHED => "Ready" ,
	BatchJob::BATCHJOB_STATUS_FAILED => "Error" ,
	BatchJob::BATCHJOB_STATUS_ABORTED => "Aborted" ,
);

function url_for ( $url )
{
	return $url;
}

class investigateHelper
{
	private static $not_type_statuses = array(
		"1" => "PENDING",
		"2" => "SENT",
		"3" => "ERROR",
		"4" => "SHOULD_RESEND",
		"5" => "ERROR_RESENDING",
		"6" => "SENT_SYNCH");
	
	private static $not_type_texts = array(
		"1" => "ENTRY_ADD",
		"2" => "ENTRY_UPDATE_PERMISSIONS",
		"3" => "ENTRY_DELETE",
		"4" => "ENTRY_BLOCK",
		"5" => "ENTRY_UPDATE",
		"6" => "ENTRY_UPDATE_THUMBNAIL",
	);
	
	private static $not_result_texts = array(
		"0" => "OK", 
		"-1" => "ERROR_RETRY", 
		"-2" => "ERRROR_NO_RETRY");
	
	public static function addIdIfNotNull ( $arr , $obj )
	{
		if ( $obj ) $arr[] = $obj;
	}
	
	public static function formatEntryType ( $val )
	{
		return $val;
		$str = "($val) ";
		$str .= ( $val== 0 ? "BACKGROUND" : ( $val == 1 ? "MEDIACLIP" : "SHOW" ) );
		return $str;
	}

	public static function printEntryTypeStr ( )
	{
		$NL = "\n";
			$str = "0=BACKGROUND" . $NL .
				"1=MEDIACLIP" . $NL .
				"2=SHOW"  ;
		return $str;
	}
	

	public static function printEntryStatusStr ( )
	{
		$NL = "\n";
		$str = 
			entry::ENTRY_STATUS_ERROR_CONVERTING . "=ERROR_CONVERTING" . $NL .
			entry::ENTRY_STATUS_IMPORT . "=IMPORT" . $NL .
			entry::ENTRY_STATUS_PRECONVERT . "=PRECONVERT" . $NL .
			entry::ENTRY_STATUS_READY . "=READY" . $NL . 
			entry::ENTRY_STATUS_DELETED . "=DELETED" . $NL ;
//			entry::ENTRY_STATUS_MODETATE . "=MODERATE" . $NL ;
	
		return $str;
	}
	
	public static function entryStatusClass ( $val )
	{
		$str = "";
		switch ( $val )
		{
			case entry::ENTRY_STATUS_ERROR_CONVERTING:
				$str .= "error"; break;
			case entry::ENTRY_STATUS_IMPORT:
				$str .= "import"; break;
			case entry::ENTRY_STATUS_PRECONVERT:
				$str .= "preconvert"; break;
			case entry:: ENTRY_STATUS_READY:
				$str .= "ready"; break;
			case entry::ENTRY_STATUS_DELETED:
				$str .= "deleted"; break;
			case entry::ENTRY_STATUS_MODERATE:
				$str .= "moderate"; break;
			case entry::ENTRY_STATUS_BLOCKED:
				$str .= "blocked"; break;
		}
		return $str;
	}
	
	public static function entryStatusColor ( $val )
	{
		$str = "";
		switch ( $val )
		{
			case entry::ENTRY_STATUS_ERROR_CONVERTING:
				$str .= "red"; break;
			case entry::ENTRY_STATUS_IMPORT:
				$str .= "yellow"; break;
			case entry::ENTRY_STATUS_PRECONVERT:
				$str .= "#66CCFF"; break;
			case entry:: ENTRY_STATUS_READY:
				$str .= "lime"; break;
			case entry::ENTRY_STATUS_DELETED:
				$str .= "#333; color: white;"; break;
				$str .= "#333; color: white;"; break;
			case entry::ENTRY_STATUS_MODERATE:
				$str .= "orange"; break;
			case entry::ENTRY_STATUS_BLOCKED:
				$str .= "purple; color:white"; break;
				
		}
		return $str;
	}

	public static function formatBatchJobType ( $type )
	{

	}

	public static function printFileData ( $files )
	{
		$str = '<table border=1 cellspacing=0 class="investigate" style="font-family:verdana; font-size:12px">' .
		'<tr>' .
		'<td style="width:400px">Full Path<span class="tooltip">Full path to the created file.</span></td>' .
		'<td style="width:200px">Name<span class="tooltip">The file name.</span></td>' .
		'<td style="width:50px">Ext<span class="tooltip">File extension.</span></td>' .
		'<td style="width:80px">Size<span class="tooltip">File size in bytes.</span></td>' .
		'<td style="width:150px">Date<span class="tooltip">File creation date.</span></td>' .
		'<td>More<span class="tooltip">On text-files such as log files, this column will contain a clickable X indicating that more info is available. Clicking the X button will open a pop-up window with the file contents.</span></td>' .
		'</tr>' ;

		if ( ! is_array( $files ) ) { $files = array ( $files ); }
		foreach ( $files as $file )
		{
			$has_content = ! empty ( $file->content ) ;

			$id = preg_replace( "/[^a-zA-Z0-9_\-]/" , "_" , $file->full_path );

			$str .= '<tr>' .
			'<td>' . $file->full_path . '</td>' .
			'<td>' . $file->name . '</td>' .
			'<td>' . $file->ext . '</td>' .
			'<td>' . $file->size . '</td>' .
			'<td>' . $file->timestamp . '</td>' .
			( $has_content ? '<td onclick="show(this)">X<textarea style="display:none">' . htmlspecialchars( $file->content ) . '</textarea></td>' :	'<td>&nbsp;</td>' ) .
			'</tr>' ;
		}

		$str .= 		'</table>' ;
		return $str;
	}

	public static function printEntryHeader (  )
	{
		$str = "<tr>" .
			"<td>Id(pid)<span class='tooltip'>The ID of the entry being investigated, the ID of the Partner that the entry belong to (in parentheses)</span></td>" .
			"<td>Name<span class='tooltip'>The name of the entry.</span></td>" . 
			"<td width='150px'>Tags<span class='tooltip'>The tags related to this entry as specified by the contributor of this entry.</span></td>" . 
			"<td width='50px'>Admin tags<span class='tooltip'>The tags related to this entry as specified by the partner administrator.</span></td>" .
			"<td>Kuser Id<span class='tooltip'>TheID of the user that contributed the entry, followed by the name (if exists).</span></td>".
			"<td title='" . self::printEntryStatusStr() . "'>Status<span class='tooltip'>The phase of the entry in the ingestion flow</span></td>".
			"<td title='" . self::printEntryTypeStr() . "'>Type<span class='tooltip'>This defines a conceptual type of the entry. Among other things, this is used internally to determine what APIs can be performed on a given entry.</span></td>".
			"<td width='40px'>Media Type<span class='tooltip'>The media type of the actual file stored on the disk (for example: a video file).</span></td>".
			"<td>Thumbnail<span class='tooltip'>The thumbnail of the entry, this is also the image that will be shown in the player when loaded when autoPlay=false.</span></td>".
			"<td>Data (size)<span class='tooltip'>The version ID of the entry (every entry in the system can have multiple versions. This field represents the latest version ID of the entry) and (inside the parentheses) the dimensions (width x height) of the media file that the entry represents.</span></td>".
			"<td width='100px'>Custom<br/>Data<span class='tooltip'>PHP serialized array that contains additional details regarding the entry (e.g. conversion settings, user ID, dimensions etc.).</span></td>".
			"<td title='conversion quality'>C/Q<span class='tooltip'>The ID of the conversion quality profile used to convert this entry media file. See Conversion Quality Profiles</span></td>".
			"<td>Duration<span class='tooltip'>The duration of the media file (video / audio) in milliseconds (int).</span></td>".	
			"<td width='70px'>Media Date<span class='tooltip'>This is the creation date taken from the <a target='_blank' href='http://en.wikipedia.org/wiki/Exif'>EXIF</a> data on contributed images.</span></td>".	
			"<td width='70px'>Created At<span class='tooltip'>The date this entry was created on.</span></td>".
			"<td width='70px'>Modified At<span class='tooltip'>This field is updated once on addEntry, deleteEntry and every time a mix (roughcut) is updated (setMetaData). Use this field to determine when the last time a mix entry was changed or when the entry was deleted.</span></td>".
			"<td width='70px'>Updated At<span class='tooltip'>This field is updated every time an entry object is saved. Use this to determine the most recent date the entry was changed / updated.</span></td>".
		"</tr>";
		
		return $str;
	}
	
	
	public static function printEntry ( $entry , $create_link = false , $kshow = null , $text = null )
	{
		global $status_list , $media_type_list , $type_list;;
		
		if ( $entry === NULL )	{	return ""; 	}
		
		if ( $entry instanceof entry )
			$entry = new genericObjectWrapper ( $entry  , true  );
		
		$id_partner_id = $entry->id . "(" . $entry->partnerId . ")<br>" . $entry->intId;
			
		$kshow_name = (  $entry->kshow ? $entry->kshow->name : "" );
			
		$str = "" .
			'<tr style="vertical-align: top">' .
			'<td>' . $id_partner_id  . '</td>' .
			'<td>' . $entry->Name . ' </td>'.
			'<td>' . htmlentities( $entry->Tags ). ' </td>'.
			'<td>' . htmlentities( $entry->AdminTags ). ' </td>'.
			'<td>' . $entry->KuserId . ", " . ( $entry->kuser ? $entry->kuser->screenName : "" ). '</td>'.
			'<td style="background-color:' . self::entryStatusColor ( $entry->Status) . '">' . getFromMap ( $entry->Status , $status_list ) . '</td>'.
			'<td>' . getFromMap (  $entry->type , $type_list ) . '</td>'.
			'<td>' . getFromMap ( $entry->mediaType , $media_type_list ) .'</td>'.
			'<td><img title="'. $entry->ThumbnailUrl . '" width="100px" height="80px"	src="' . $entry->ThumbnailUrl . '"></td>'.
			'<td>' . ( $entry->data ? "<a href='$entry->dataUrl'>" . $entry->data . "</a><br><br>" : "" ) .
				'(' . $entry->width . "x" . $entry->height . ')' . 
				'</td>'.
			'<td><div style="width:300px">' . str_replace ( ";" , "; " , ( $entry->customData ? $entry->customData : '&nbsp;' ) ) . '</div></td>'.
			'<td >' .
				( $entry->conversionQuality ? $entry->conversionQuality : '&nbsp;' ) .
//			'<span onclick="update ( \'' . $entry->conversionQuality . '\' , \'' . $entry->id . '\' , \'conversionQuality\' );">[?]</span> ' .
//				'<a href="javascript:conversionProfileMgr ( \'' . $entry->conversionQuality . '\' )"; return false;>' . $entry->conversionQuality . '</a> </td>'.
			'</td>'.
			'<td>' . $entry->lengthInMsecs . '</td>'.
			'<td>' . $entry->mediaDate . '</td>'.
			'<td>' . $entry->createdAt . '</td>'.
			'<td>' . $entry->modifiedAt . '</td>'.
			'<td>' . $entry->updatedAt . '</td>'.
			'</tr>' ; 
		
		return $str;
	}
	
	public static function printConversionHeader ( $entry_id , $add_reconvert_link = false )
	{
		$status_txt = "-1=CONVERSION_STATUS_ERROR\n".
			"1=CONVERSION_STATUS_PRECONVERT\n" . 
			"2=CONVERSION_STATUS_COMPLETED" ;

		$reconvert_link = $add_reconvert_link ? 
				"<br/><a href='javascript:reconvert(\"updateEntry.php?action=reconvert&conversion_id=&entry_id={$entry_id}\")'>reconvert</a>" :
				"";
							
		$str = "<tr>" .
			"<td>Id $reconvert_link<span class='tooltip'>Chronological ID of the conversion job creation.</span></td>" .
			"<td>Entry Id<span class='tooltip'>The ID of the entry being converted.</span></td>".
			"<td>In File Name<span class='tooltip'>The path to the original media file on the disk to be converted.</span></td>".
			"<td>In File Ext<span class='tooltip'>The extension of the file to be converted.</span></td>".
			"<td>In File Size<span class='tooltip'>The file size (in bytes) of the original file to be converted.</span></td>".
			"<td title=\"$status_txt\">Status<span class='tooltip'>The batch process conversion job status (-1: an error occurred, 1: entry is being converted or waiting to be converted, 2: conversion successfully completed). </span></td>".
			"<td>Conversion Params<span class='tooltip'>Parameters passed to the conversion engine (ffmpeg or mencoder) to convert the file.</span></td>".
			"<td>Out File Name<span class='tooltip'>The file name of the converted file.</span></td>".
			"<td>Out File Size<span class='tooltip'>The size of the converted file after conversion completion and (in parentheses) the change percentage from the original file.</span></td>".
			"<td style='width:50px'>Out File Name (Edit flavor)<span class='tooltip'>The file name of the converted file that will be used for remixing in the Kaltura Editors (KAE and KSE).</span></td>".
			"<td style='width:100px'>Out File Size (Edit flavor)<span class='tooltip'>The size of the converted file that will be used for remixing in the Kaltura Editors (KAE and KSE) and (in parentheses) the change percentage from the original file.</span></td>".
			"<td>Conversion Time(secs)<span class='tooltip'>The time in seconds it took to convert the media file.</span></td>".
			"<td>Total Time (secs)<span class='tooltip'>The total time in seconds it took for the entire conversion process to complete.</span></td>".
			"<td>Created<span class='tooltip'>The time the conversion job was created.</span></td>".
			"<td>Updated<span class='tooltip'>The most recent time the conversion job status was updated. </span></td>".
		"</tr>";
		return $str;
	}

	public static function printConversion ( $conversion , $entry_id , $link_to_investigate = false , $add_reconvert_link = false )
	{
		global $conversion_status_list;
		
		$orig_conv = $conversion;
		if ( $conversion instanceof $conversion )
			$conversion = new genericObjectWrapper ( $conversion  , true );
//		$entry_id = $conversion->entryId ;
			
		if ( $orig_conv )
			$orig_created_at = $orig_conv->getCreatedAt ( null );
		else
			$orig_created_at  = null;

		$status_bg = "lime";
		$created_at_bg = "lime";
		
		$title = "";
		if ( $conversion->status == conversion::CONVERSION_STATUS_ERROR )
		{
			$status_bg = "red";
			$created_at_bg = "white";
		}
		elseif ( $conversion->status == conversion::CONVERSION_STATUS_PRECONVERT )
		{
			$delta = time() - $orig_created_at;
			if ( $delta > 1600 ) // 1/2 an hour
			{
				$minutes = (int)($delta / 60 );
				$title = "Over $delta seconds ($minutes minutes) since created!";
				$status_bg = "yellow";
				$created_at_bg = "yellow";
			}
		}
		
		$reconvert_link = $add_reconvert_link ? 
				"<br/><a href='javascript:reconvert(\"updateEntry.php?action=reconvert&entry_id={$entry_id}\")'>reconvert</a>" :
				"";
		$str = 	'<tr style="vertical-align: top">' .
				'<td>' . $conversion->id . $reconvert_link . '</td>' . 
				'<td>' . ( $link_to_investigate ? "<a href='" . url_for ( "/system" ) . "/investigate?entry_id=" . $entry_id . "'> $entry_id </a>" : $entry_id ) . '</td>' .
				'<td>' . $conversion->inFileName . '</td>' .
				'<td>' . $conversion->inFileExt . '</td>' .
				'<td>' . $conversion->inFileSize .'</td>'. 
				'<td title="' . $title . '" style="background-color:' . $status_bg . '">' . getFromMap ( $conversion->status , $conversion_status_list ).'</td>'.
				'<td>' . str_replace ( "|" , "<br>" , $conversion->conversionParams ) .'</td>'.
				'<td>' . $conversion->outFileName .'</td>'.
				'<td ' . ( ! $conversion->outFileOk ? "style='color:red'" : "" ) . ">" . $conversion->outFileSize . '<br/>' . self::fileSizeRatio( $conversion->outFileSize ,  $conversion->inFileSize ). '</td>'.
				'<td>' . $conversion->outFileName2 .'</td>'.
				'<td ' . ( ! $conversion->outFile2Ok ? "style='color:red'" : "" ) . ">". $conversion->outFileSize2 . '<br/>' . self::fileSizeRatio( $conversion->outFileSize2 ,  $conversion->inFileSize ).'</td>'.
				'<td>' . $conversion->conversionTime .'</td>'.
				'<td>' . $conversion->totalProcessTime .'</td>'.
				'<td title="' . $title . '" style="background-color:' . $created_at_bg . '">' . $conversion->createdAt .'</td>'.
				'<td>' . $conversion->updatedAt .'</td>'.
				'</tr>' ; 
		return $str;				
	}
	
	private static function fileSizeRatio ( $f1 , $f2 )
	{
		if ( !$f2 ) return "-";
		return  "(" . floor(100 * $f1 / $f2 ) . "%)"; 	
	}
	
	public static function printBatchjobHeader ()
	{
/*
 * 	const BATCHJOB_STATUS_PENDING = 0;
	const BATCHJOB_STATUS_QUEUED = 1;
	const BATCHJOB_STATUS_PROCESSING = 2;
	const BATCHJOB_STATUS_PROCESSED = 3;
	const BATCHJOB_STATUS_MOVEFILE = 4;
	const BATCHJOB_STATUS_FINISHED = 5;
	const BATCHJOB_STATUS_FAILED = 6;
	const BATCHJOB_STATUS_ABORTED = 7;
 */		
		$status_txt = "0=BATCHJOB_STATUS_PENDING\n".
			"1=BATCHJOB_STATUS_QUEUED\n".
			"2=BATCHJOB_STATUS_PROCESSING\n".
			"3=BATCHJOB_STATUS_PROCESSED\n".
			"4=BATCHJOB_STATUS_MOVEFILE\n".
			"5=BATCHJOB_STATUS_FINISHED\n".
			"6=BATCHJOB_STATUS_FAILED\n".
			"7=BATCHJOB_STATUS_ABORTED";
		
		$str = "<tr>".
		"<td>Id<span class='tooltip'>Chronological ID of the conversion job creation.</span></td>".
		"<td>Type<span class='tooltip'>The type of the batch job (1: import, 2: delete, 4: bulkupload, 6: download) WHAT HAPPENED TO 5??? [link: Batch processes].</span></td>".
		"<td>Sub Type<span class='tooltip'>represents the source of the import (YouTube, Jamendo, CCMixter, etc).</span></td>".
		"<td>EntryId<span class='tooltip'>The ID of the entry being converted.</span></td>".
		"<td>Data<span class='tooltip'>PHP serialized array that contains additional details regarding the job (e.g. entry ID, source url etc.).</span></td>".
		"<td title=\"$status_txt\">Status<span class='tooltip'>The batch process conversion job status (0: job is pending, 1: job is queued, 2: job is being processed, 3: job mission completed, 4: job is moving a file, 5: job completed, 6: job failed to complete, 7: job was aborted). </span></td>".
		"<td>Abort<span class='tooltip'>This field indicates if the job was aborted.</span></td>".
		"<td>Check Again Timeout<span class='tooltip'>Batch processes update their status in intervals, this field indicates the time in seconds until the next update to this job.</span></td>".
		"<td>Progress<span class='tooltip'>The progress of this job in percentage.</span></td>".
		"<td>Message<span class='tooltip'>Messages provided by the processes executing this job.</span></td>".
		"<td>Description<span class='tooltip'>Possible details about the job progress, status and errors.</span></td>".
		"<td>Updates Count<span class='tooltip'>Total number of times this job was updated.</span></td>".
		"<td>Created<span class='tooltip'>The time the conversion job was created.</span></td>".
		"<td>Updated<span class='tooltip'>The most recent time the conversion job status was updated. </span></td>".
		"</tr>"; 
		return $str;
	}

	public static function printBatchjob ( $bj , $link_to_investigate = false )
	{
		global $batchjob_status_list;
		$orig = $bj;
		
		$orig_created_at = $orig->getCreatedAt ( null );

			$status_bg = "lime";
		$created_at_bg = "lime";
		
			
			
		if ( $bj instanceof BatchJob  )
			$bj = new genericObjectWrapper ( $bj  , true );
		
		preg_match( "/\"entryId\"\;i:([^;]*)\;/" , $bj->data ,$ids );
		//preg_match( "/\"entryId\".*([^;]*)\;/" , $bj->data ,$ids );
		
		$data = preg_replace( "/;/" , ";<br>" , $bj->data  )  ;
		$data = preg_replace( "/&/" , "<br> &" , $data  )  ;
		
		$entry_id = $bj->entryId;

		$title = "";
		if ( $bj->status == BatchJob::BATCHJOB_STATUS_FAILED )
		{
			$status_bg = "red";
			$created_at_bg = "white";
		}
		elseif ( $bj->status != BatchJob::BATCHJOB_STATUS_FINISHED && $bj->status != BatchJob::BATCHJOB_STATUS_ABORTED )
		{
			$delta = time() - $orig_created_at;
			if ( $delta > 1600 ) // 1/2 an hour
			{
				$minutes = (int)($delta / 60 );
				$title = "Over $delta seconds ($minutes minutes) since created!";
				$status_bg = "yellow";
				$created_at_bg = "yellow";
			}
		}
	
		
		$resubmit_import_job = $bj->jobType == BatchJob::BATCHJOB_TYPE_IMPORT ?
			("<br/><a href='javascript:restartJob(\"updateEntry.php?action=restartJob&batchjob_id={$bj->id}&entry_id={$entry_id}\")'>restart</a>") : "";
		
		$str = '<tr style="vertical-align: top">'.
		'<td>'. $bj->id .$resubmit_import_job.'</td>'.
		'<td>'. $bj->jobType .'</td>'.
		'<td>'. $bj->jobSubType .'</td>'.
		'<td>' . ( $link_to_investigate ? "<a href='" . url_for ( "/system" ) . "/investigate?entry_id=" . $entry_id . "'> $entry_id </a>" : $entry_id ) . '</td>' .
		'<td style="width:100px; height:50px; overflow: hidden">'. str_replace ( ";" , "; " , $data ) .'</td>'.
		'<td title="' . $title . '" style="background-color:' . $status_bg . '">' . getFromMap ( $bj->status , $batchjob_status_list )  .'</td>'.
		'<td>'. $bj->abort .'</td>'.
		'<td>'. $bj->checkAgainTimeout .'</td>'.
		'<td>'. $bj->progress .'</td>'.
		'<td>'. $bj->message .'</td>'.
		'<td>'. $bj->description  .'</td>'.
		'<td>'. $bj->updatesCount .'</td>'.
		'<td title="' . $title . '" style="background-color:' . $created_at_bg . '">' . $bj->createdAt .'</td>'.
		'<td>'. $bj->updatedAt .'</td>'.
		'</tr>';
		
		return $str;
	}
	
	public static function printNotificationHeader ()
	{
		$str = "<tr>".
		"<td>Id<span class='tooltip'>Chronological unique ID of the notification.</span></td>".
		"<td>Type<span class='tooltip'>The type of <a target='_blank' href='../testmeDoc/'>notification</a></span></td>".
		"<td>Status<span class='tooltip'>Notification phase (1: notification pending, 2: notification sent to partner application, 3: an error occured, 4: should send notification again, 5: there was an error sending the notification, 6: notification was sent synchronously through the client).</span></td>".
		"<td>Attempts<span class='tooltip'>The total number of times the server tried to send this notification (If a notification was attempted to be sent more than twice, there might be a problem in the partner implementation that is asking the notification to be sent over and over again).</span></td>".
		"<td>Result<span class='tooltip'>The result recieved from the notification handler.</span></td>".
		"<td>Data<span class='tooltip'>The data that was sent with the notification (the notification parameters).</span></td>".
		"<td>Partner Id<span class='tooltip'>The ID of the partner this notification should be sent to.  Default Partner ID for CE is 1.</span></td>".
		"<td>Puser Id<span class='tooltip'>The ID of the user that performed the action which triggered the notification.</span></td>".
		"<td>Created<span class='tooltip'>The time the notification was created.</span></td>".
		"<td>Updated<span class='tooltip'>The most recent time the notification status was updated. </span></td>".
		"</tr>"; 
		return $str;
	}

	public static function printNotification ( $not , $link_to_investigate = false )
	{
		$orig = $not;
		
		$orig_created_at = $orig->getCreatedAt ( null );

		$status_bg = "lime";
		$created_at_bg = "lime";
			
		$data = preg_replace( "/;/" , ";<br>" , $not->getNotificationData() )  ;
		$data = preg_replace( "/&/" , "<br> &" , $data  )  ;
		
		$entry_id = $not->getObjectId();

		if ( $not instanceof notification   )
			$not = new genericObjectWrapper ( $not  , true );
		else
			return "";

		$not_type_status = @self::$not_type_statuses[$not->status];
		$not_type_text = @self::$not_type_texts[$not->type];
		$not_result_text = @self::$not_result_texts[$not->notificationResult];
		
		$title = "";
		if ( $not->status == notification::NOTIFICATION_STATUS_ERROR || $not->status == notification::NOTIFICATION_STATUS_ERROR_RESENDING)
		{
			$status_bg = "red";
			$created_at_bg = "white";
		}
		elseif ( $not->status != notification::NOTIFICATION_STATUS_SENT )
		{
			$delta = time() - $orig_created_at;
			if ( $delta > 1600 ) // 1/2 an hour
			{
				$minutes = (int)($delta / 60 );
				$title = "Over $delta seconds ($minutes minutes) since created!";
				$status_bg = "yellow";
				$created_at_bg = "yellow";
			}
		}
		
		$resubmit_notification = "<br/><a href='javascript:resendNotification(\"updateEntry.php?action=resendNotification&notification_id={$not->id}&entry_id={$entry_id}\")'>resend</a>";
		
		$str = '<tr style="vertical-align: top">'.
		'<td>'. $not->id .$resubmit_notification.'</td>'.
		'<td>'.$not_type_text .'('.$not->type.')</td>'.
		'<td title="' . $title . '" style="background-color:' . $status_bg . '">' . $not_type_status .'('.$not->status.')</td>'.
		'<td>'. $not->numberOfAttempts .'</td>'.
		'<td>'.$not_result_text .'('.$not->notificationResult.')</td>'.
		'<td style="width:800px; height:50px; overflow: hidden">'. $data .'</td>'.
		'<td>'. $not->partnerId .'</td>'.
		'<td>'. $not->puserId .'</td>'.
		'<td title="' . $title . '" style="background-color:' . $created_at_bg . '">' . $not->createdAt .'</td>'.
		'<td>'. $not->updatedAt .'</td>'.
		'</tr>';
		
		return $str;
	}
	
	public static function listFilesInDir ( $title, $entry_id , $path_and_pattern  , $include_content = false , $table_description = '')
	{
		$entry_pattern = "/" . $entry_id . "/..*/";
		$getFileData_method = array ( 'kFile' , 'getFileData' );
		$getFileDataWithContent_method = array ( 'kFile' , 'getFileDataWithContent' );
		
		$data_files = glob ( $path_and_pattern );  // all versions of file
		$data_files = kArray::foreachElem( $data_files , $include_content ? $getFileDataWithContent_method : $getFileData_method , true );
		
		$str = $title . " (" . $path_and_pattern . "):<br>".$table_description."<br />";
		$str .= investigateHelper::printFileData ( $data_files );
		return $str;
	}
}
?>