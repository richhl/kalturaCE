<?php
require_once("systembase.php");

$action = getP ( "action" );

$entry_id = getP ( "entry_id" );

$message = "";
if ( $action == "restartJob" )
{
	$batchjob_id = getP ( "batchjob_id" );
	
	$job = BatchJobPeer::retrieveByPK($batchjob_id);
	if ($job)
	{
		$job->setStatus(BatchJob::BATCHJOB_STATUS_PENDING);
		$job->save();
		$message = "batch job [$batchjob_id] restarted;";
	}
	else
	{
		$message = "batch job [$batchjob_id] not found;";
	}
	
}
elseif ( $action == "reconvert" )
{
	$entry = entryPeer::retrieveByPK( $entry_id );
	
	if ( ! $entry )
	{
		$message = "entry [$entry_id] could not be found";
	}
	else
	{
			// find file in archive - copy it to the content/preconvert dir and create an indicator
		$int_id = $entry->getIntId();
		$path_name =  $entry->getDataPath();	
		
		$extension = pathinfo ( $path_name , PATHINFO_EXTENSION );
		$base_name = pathinfo ( $path_name , PATHINFO_BASENAME );
		$arr = explode ( "_" , $base_name , 2);
	
		$arcived_path = myContentStorage::getFSContentRootPath (). "/archive/" . str_replace ( "content/entry/"  , "" , dirname ( $path_name )  ) ; // . "/" . $file_name )  ;
	
		// because we don't know the nane of the original file - use glob rather than the file's extension
		foreach ( glob ( $arcived_path . "/{$entry_id}.*") as $full_path_name )
		{
			$file_name = pathinfo ( $full_path_name , PATHINFO_BASENAME );
	
			// for new conversion
			$new_indicator = myContentStorage::getFSContentRootPath (). "/content/new_preconvert/$file_name.indicator";
			touch ( $new_indicator );
		}	
		$message = "entry [$entry_id] reconverted";
	}
}
elseif ( $action == "resendNotification")
{
	$notification_id = getP ( "notification_id" );
	
	$not = notificationPeer::retrieveByPK($notification_id);
	if ($not)
	{
		$not->setStatus(notification::NOTIFICATION_STATUS_PENDING);
		$not->setNumberOfAttempts(0);
		$not->save();
		$message = "notification [$notification_id] resent";
	}	
	else
	{
		$message = "notification [$notification_id] could not be resent";
	}
}
else
{
	// update entry property
}


header("Location: investigate.php?entry_id=$entry_id&message=$message" ); /* Redirect browser */

?>