<?php
require_once ( "defPartnerservices2Action.class.php");
require_once ( "myPartnerUtils.class.php");

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
		$entry_id = $this->getPM ( "entry_id" );
		$version = $this->getP ( "version" );
		$file_format = $this->getPM ( "file_format" );
		$conversion_quality = $this->getP ( "conversion_quality" , null );
		$force_download = $this->getP ( "force_download" , null );
		$entry = entryPeer::retrieveByPK( $entry_id );
		
		if ( ! $entry )
		{
			$this->addError ( APIErrors::INVALID_ENTRY_ID, $this->getObjectPrefix() , $entry_id );
		}
		else
		{
			$content_path = myContentStorage::getFSContentRootPath();
			$file_name = $content_path . $entry->getDataPath( $version ); 
			if (!file_exists($file_name))
			{
				$this->addError ( APIErrors::INVALID_ENTRY_VERSION, $this->getObjectPrefix(), $entry_id, $version );
			}
			else
			{
				if ( $entry->getType() == entry::ENTRY_TYPE_SHOW  )
				{
					// TODO - should return the job ??
					myBatchFlattenClient::addJob($puser_id, $entry, $version, $file_format);
				}
				elseif ( $entry->getType() != entry::ENTRY_TYPE_DOCUMENT )
				{
					if ( $entry->getMediaType() == entry::ENTRY_MEDIA_TYPE_AUDIO )
					{
						// for audio - force format flv regardless what the user really asked for
						$file_format = "flv";
					}
						
					$job = myBatchDownloadVideoServer::addJob($puser_id, $entry, $version, $file_format , $conversion_quality , $force_download );
					
					$this->addMsg( "download" , objectWrapperBase::getWrapperClass( $job , objectWrapperBase::DETAIL_LEVEL_DETAILED)  );
				}
				else
				{
					
					if ( $entry->getMediaType() == entry::ENTRY_MEDIA_TYPE_DOCUMENT )
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
						$download_path = str_replace('/web/', '', stripslashes($job_data->downoladPath));
						$this->addMsg( 'downloadUrl' , requestUtils::getRequestHost().$download_path );
					}
				}
			}
		}
	}
}
?>