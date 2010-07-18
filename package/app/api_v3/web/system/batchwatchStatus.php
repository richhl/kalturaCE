<?php
$skip_auth = true;
$folder = dirname(__FILE__);
require_once($folder."/../../bootstrap.php");
$databaseManager = new DbManager();
$databaseManager->initialize();

Propel::setLogger( KalturaLog::getInstance());

$all_batch_status = myBatchBase::getAllRegistered();

// loop over all the batches to see if any of them are causing an error
$error_count = 0;
foreach ( $all_batch_status as $batch_status )
{
  if (!$batch_status->getStatus()) $error_count++;
}
$batch_status = $error_count;
?>