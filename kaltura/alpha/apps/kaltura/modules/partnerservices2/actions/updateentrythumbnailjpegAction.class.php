<?php
require_once ( "defPartnerservices2Action.class.php");

class updateentrythumbnailjpegAction extends defPartnerservices2Action
{
	public function describe()
	{
		return 
			array (
				"display_name" => "updateEntryThumbnailJpeg",
				"desc" => "Send post data",
				"in" => array (
					"mandatory" => array ( 
						"entry_id" => array ("type" => "string", "desc" => "")
					),
					"optional" => array (
						)
					),
				"out" => array (
					"entry" => array ("type" => "entry", "desc" => "")
					),
				"errors" => array (
					APIErrors::INVALID_USER_ID ,
				)
			); 
	}
	
	// ask to fetch the kuser from puser_kuser 
	public function needKuserFromPuser ( )
	{
		return self::KUSER_DATA_KUSER_DATA;
	}
	
	public function executeImpl ( $partner_id , $subp_id , $puser_id , $partner_prefix , $puser_kuser )
	{
		if ( ! $puser_kuser )
		{
			$this->addError ( APIErrors::INVALID_USER_ID ,$puser_id );
			return;
		}
		
		$entry_id = $this->getPM ( "entry_id" );
		$entry = entryPeer::retrieveByPK( $entry_id );
		
		// TODO - verify the user is allowed to modify the entry
		
		if ($entry->getKshowId() === kshow::SANDBOX_ID)
		{
			$this->addError ( APIErrors::SANDBOX_ALERT );
			return ;
		}
		
		$entry->setThumbnail ( ".jpg");
		$entry->save();
		
		if(isset($HTTP_RAW_POST_DATA))
			$thumb_data = $HTTP_RAW_POST_DATA;
		else
			$thumb_data = file_get_contents("php://input");

		$thumb_data_size = strlen( $thumb_data );
		
		$bigThumbPath = myContentStorage::getFSContentRootPath() .  $entry->getBigThumbnailPath();
		
		kFile::fullMkdir ( $bigThumbPath );
		kFile::setFileContent( $bigThumbPath , $thumb_data );
		
		$path = myContentStorage::getFSContentRootPath() .  $entry->getThumbnailPath();
		
		kFile::fullMkdir ( $path );
		myFileConverter::createImageThumbnail( $bigThumbPath , $path );
		
		// update the metadata in case of a roughcut
		if ($entry->getType() == entry::ENTRY_TYPE_SHOW)
		{
			$roughcutPath = myContentStorage::getFSContentRootPath() . $entry->getDataPath();
			$xml_doc = new DOMDocument();
			$xml_doc->load( $roughcutPath );
			
			if (myMetadataUtils::updateThumbUrl($xml_doc, $entry->getThumbnailUrl()))
				$xml_doc->save($roughcutPath);
				
			myNotificationMgr::createNotification( notification::NOTIFICATION_TYPE_ENTRY_UPDATE_THUMBNAIL , $entry );
		}
			
		$this->res = $entry->getBigThumbnailUrl();
		
		$wrapper = objectWrapperBase::getWrapperClass( $entry , objectWrapperBase::DETAIL_LEVEL_REGULAR );
		$wrapper->removeFromCache( "entry" , $entry->getId() );			
		
		$this->addMsg ( "entry" , $wrapper );

	}
}
?>