<?php

class adddownloadAction extends defPartnerservices2Action
{
	public function describe()
	{
		return
			array (
				"display_name" => "addDownload",
				"desc" => "" ,
				"in" => array (
					"mandatory" => array (
						"entry_id" => array ("type" => "string", "desc" => ""),
						"file_format" => array ("type" => "string", "desc" => ""),
						),
					"optional" => array (
						"entry_version" => array ("type" => "string", "desc" => ""),
						"conversion_quality" => array ("type" => "string", "desc" => ""),
						"force_download" => array ("type" => "boolean", "desc" => "")
						)
					),
				"out" => array (
					"entry" => array ("type" => "entry", "desc" => "")
					),
				"errors" => array (
					APIErrors::INVALID_ENTRY_ID,
					APIErrors::INVALID_ENTRY_VERSION,
					)
			);
	}

	protected function ticketType()
	{
		return self::REQUIED_TICKET_REGULAR;
	}

	// ask to fetch the kuser from puser_kuser - so we can tel the difference between a
	public function needKuserFromPuser ( )
	{
		return self::KUSER_DATA_NO_KUSER;
	}

    protected function getObjectPrefix()
    {
    	return "entry";
    }
    
	public function executeImpl ( $partner_id , $subp_id , $puser_id , $partner_prefix , $puser_kuser )
	{
		kLog::log("adddownloadAction: executeImpl ( $partner_id , $subp_id , $puser_id , $partner_prefix , $puser_kuser )");
		
		$entry_id = $this->getPM ( "entry_id" );
		$version = $this->getP ( "version" );
		$file_format = $this->getPM ( "file_format" );
		$conversion_quality = $this->getP ( "conversion_quality" , null );
		$force_download = $this->getP ( "force_download" , null );
		$entry = entryPeer::retrieveByPK( $entry_id );
		
		if ( ! $entry )
		{
			kLog::log("add download Action entry not found");
			$this->addError ( APIErrors::INVALID_ENTRY_ID, $this->getObjectPrefix() , $entry_id );
			return;
		}
		
		kLog::log("adddownloadAction: entry found [$entry_id]");
		
		/*			
		$content_path = myContentStorage::getFSContentRootPath();
		$file_name = $content_path . $entry->getDataPath( $version ); // replaced__getDataPath
		if (!file_exists($file_name))
		*/
		
		$sync_key = null;
		if($entry->getMediaType() == entry::ENTRY_MEDIA_TYPE_AUDIO ||
		   $entry->getMediaType() == entry::ENTRY_MEDIA_TYPE_VIDEO)
		{
			$originalFlavorAsset = flavorAssetPeer::retrieveByEntryIdAndFlavorParams($entry->getId(), 0); // search for source
			if($originalFlavorAsset)
			{
				$sync_key = $originalFlavorAsset->getSyncKey(flavorAsset::FILE_SYNC_FLAVOR_ASSET_SUB_TYPE_ASSET);
			}
		}
		
		if(!$sync_key)
		{
			$sync_key = $entry->getSyncKey ( entry::FILE_SYNC_ENTRY_SUB_TYPE_DATA , $version );
		}
		
		if ( ! kFileSyncUtils::file_exists( $sync_key ) )
		{
			kLog::log("add download Action sync key doesn't exists");
			$this->addError ( APIErrors::INVALID_ENTRY_VERSION, $this->getObjectPrefix(), $entry_id, $version );
			return; 
		}
		
		if ( $entry->getType() == entry::ENTRY_TYPE_SHOW  )
		{
			// TODO - should return the job ??
			// the original flavor should be considered as flv in case this is a roughcut
			if ( $file_format == "original" )	
				$file_format = "flv";
				
			$job = myBatchFlattenClient::addJob($puser_id, $entry, $version, $file_format);
			kLog::log("add download Action flatten job [" . $job->getId() . "] created");
		}
		elseif ( $entry->getType() != entry::ENTRY_TYPE_DOCUMENT )
		{
			$flavorParamsId = 0;
			
			if ( $file_format != "original" )
			{
				if ( $entry->getMediaType() == entry::ENTRY_MEDIA_TYPE_AUDIO )
					$file_format = "flv";
					
				$flavorParams = myConversionProfileUtils::getFlavorParamsFromFileFormat ( $partner_id , $file_format );
				$flavorParamsId = $flavorParams->getId();
			}
			
			$job = kJobsManager::addBulkDownloadJob($partner_id, $puser_id, $entry->getId(), $flavorParamsId);
		
			// remove kConvertJobData object from batchJob.data
			$job->setData(null);
			$this->addMsg( "download" , objectWrapperBase::getWrapperClass( $job , objectWrapperBase::DETAIL_LEVEL_DETAILED)  );
		}
		elseif ( $entry->getMediaType() == entry::ENTRY_MEDIA_TYPE_DOCUMENT )
		{
			$job = myBatchOpenOfficeConvert::addJob( $puser_id, $entry, $version, $file_format = 'swf' );
			$this->addMsg( "OOconvert" , objectWrapperBase::getWrapperClass( $job , objectWrapperBase::DETAIL_LEVEL_DETAILED)  );
			if (is_array($job))
			{
				$job_data = json_decode($job[0]->getData());
			}
			else
			{
				$job_data = json_decode($job->getData());
			}
			//$download_path = str_replace(myContentStorage::getFSContentRootPath(), '', stripslashes($job_data->downoladPath));
			$download_path = $entry->getDownloadUrl().'/direct_serve/true/type/download/forceproxy/true/format/swf';
			$this->addMsg( 'downloadUrl' , $download_path );
		}
	}
}
?>