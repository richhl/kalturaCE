<?php
require_once ( "defPartnerservices2Action.class.php");
require_once ( "myPartnerUtils.class.php");

class transcodeAction extends defPartnerservices2Action
{
	public function describe()
	{
		return
			array (
				"display_name" => "addSaysmeConvert",
				"desc" => "" ,
				"in" => array (
					"mandatory" => array (
						"entry_id" => array ("type" => "string", "desc" => ""),
						"data1" => array ("type" => "string", "desc" => ""),
						"type" => array ("type" => "integer", "desc" => "type of special transcoding"),
						),
					"optional" => array (
						"entry_version" => array ("type" => "string", "desc" => ""),
						)
					),
				"out" => array (
					"job" => array ("type" => "BatchJob", "desc" => "")
					),
				"errors" => array (
					APIErrors::INVALID_ENTRY_ID,
					APIErrors::INVALID_ENTRY_VERSION,
					APIErrors::INVALID_TRANSCODE_TYPE,
					APIErrors::INVALID_TRANSCODE_DATA,
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
		$type = $this->getPM ( "type" ); // will be generalized to convert to different results
		$entry_id = $this->getPM ( "entry_id" );
		$version = $this->getP ( "version" );
		$data1 = $this->getP ( "data1" );

		$entry = entryPeer::retrieveByPK( $entry_id );
		if ( ! $entry )
		{
			$this->addException ( APIErrors::INVALID_ENTRY_ID, $this->getObjectPrefix() , $entry_id );
		}
		
		
		if ( $type == saysmeProject::TRANSCODE )
		{
			if ( $entry->getPartnerData() == "" && ! $data1 )
			{
				$this->addException( APIErrors::INVALID_TRANSCODE_DATA , "ISCI must exists either on the entry:partnerData or as data1" );
			}
			
			$job = saysmeProject::createBatchJob ( $entry, $data1 );
					
			$this->addMsg( "job" , objectWrapperBase::getWrapperClass( $job , objectWrapperBase::DETAIL_LEVEL_DETAILED)  );
		}
		else
		{
			$this->addException ( APIErrors::INVALID_TRANSCODE_TYPE , $type );
		}
	}
}
?>