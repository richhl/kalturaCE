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
				else
				{
					if ( $entry->getMediaType() == entry::ENTRY_MEDIA_TYPE_AUDIO )
					{
						// for audio - force format flv regardless what the user really asked for
						$file_format = "flv";
					}
						
					$job = myBatchDownloadVideoServer::addJob($puser_id, $entry, $version, $file_format);
					
					$this->addMsg( "download" , objectWrapperBase::getWrapperClass( $job , objectWrapperBase::DETAIL_LEVEL_DETAILED)  );
				}
					
			}
		}
	}
}
?>