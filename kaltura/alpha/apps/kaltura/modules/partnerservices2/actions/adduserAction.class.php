<?php
require_once ( "myInsertEntryHelper.class.php");
require_once ( "myKshowUtils.class.php");
require_once ( "defPartnerservices2Action.class.php");
require_once ( "myPartnerUtils.class.php");

class adduserAction extends defPartnerservices2Action
{
	public function describe()
	{
		return 
			array (
				"display_name" => "addUser",
				"desc" => "" ,
				"in" => array (
					"mandatory" => array ( 
						"user_id" => array ("type" => "integer", "desc" => ""),
						"user" => array ("type" => "kuser", "desc" => "")
						),
					"optional" => array (
						)
					),
				"out" => array (
					"user" => array ("type" => "kuser", "desc" => "")
					),
				"errors" => array (
				)
			); 
	}
	
	protected function ticketType()	{		return self::REQUIED_TICKET_ADMIN;	}
	
	public function needKuserFromPuser ( )	{		return self::KUSER_DATA_NO_KUSER; 	}
	
	public function executeImpl ( $partner_id , $subp_id , $puser_id , $partner_prefix , $puser_kuser )
	{
		$target_puser_id = $this->getPM ( "user_id" );
		
		$target_puser_kuser = PuserKuserPeer::retrieveByPartnerAndUid( $partner_id , null , $target_puser_id );
		
		if ( $target_puser_kuser )
		{
			$this->addDebug ( "puser_exists" , $target_puser_kuser->getId() );
			
			// might be that the puser_kuser exists but the kuser does not
			$kuser = kuserPeer::retrieveByPK( $target_puser_kuser->getKuserId() );
			if ( $kuser )
			{
				$this->addError ( APIErrors::DUPLICATE_USER_BY_ID , $target_puser_id );
				return;
			}
			else
			{
				// puser_kuser exists but need to create the ksuer...
			}
		}
		else
		{
			$target_puser_kuser = new PuserKuser();
			$target_puser_kuser->setPuserId ( $target_puser_id );
			$target_puser_kuser->setPartnerId( $partner_id );
			$target_puser_kuser->save();
			
			$this->addDebug ( "Created_new_puser_kuser" , $target_puser_kuser->getId() );
		}
		
		// get the new properties for the kuser from the request
		$kuser = new kuser();
		
		$obj_wrapper = objectWrapperBase::getWrapperClass( $kuser , 0 );
		
		$fields_modified = baseObjectUtils::fillObjectFromMap ( $this->getInputParams() , $kuser , "user_" , $obj_wrapper->getUpdateableFields() );
		// check that mandatory fields were set
		// TODO
		if ( count ( $fields_modified ) > 0 )
		{
			if (!$partner_id) // is this a partner policy we should enforce?
			{
				$kuser_from_db = kuserPeer::getKuserByScreenName ( $kuser->getScreenName() );
				if ( $kuser_from_db )
				{
					$this->addError( APIErrors::DUPLICATE_USER_BY_SCREEN_NAME , $kuser->getScreenName() );
					return;
				}
			}
			
			$kuser->setPartnerId( $partner_id );		
			$kuser->save();
			
			// now update the puser_kuser
			$target_puser_kuser->setPuserName( $kuser->getScreenName() );
			$target_puser_kuser->setKuserId( $kuser->getId() );
			$target_puser_kuser->save();
			
			$this->addMsg ( "user" , objectWrapperBase::getWrapperClass( $target_puser_kuser , objectWrapperBase::DETAIL_LEVEL_DETAILED) );
			$this->addDebug ( "added_fields" , $fields_modified );
			
		}
		else
		{
			$this->addError( APIErrors::NO_FIELDS_SET_FOR_USER );
		}
		

	}
}
?>