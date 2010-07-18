<?php

/**
 * Subclass for representing a row from the 'email_ingestion_profile' table.
 *
 * 
 *
 * @package lib.model
 */ 
class EmailIngestionProfile extends BaseEmailIngestionProfile
{
	const EMAIL_INGESTION_PROFILE_STATUS_INACTIVE = 0;
	const EMAIL_INGESTION_PROFILE_STATUS_ACTIVE = 1;
	
	public function save ( $con = null )
	{
		// if the custom_data obj has change - serialize it
		$this->setCustomDataObj();
		
		return parent::save ( $con ) ;		
	}
	
	public function getDefaultCategory() { return $this->getFromCustomData("defaultCategory", null); }
	public function setDefaultCategory( $v ) { $this->putInCustomData("defaultCategory", $v); } 

	public function getDefaultUserId() { return $this->getFromCustomData("defaultUserId", null); }
	public function setDefaultUserId( $v ) { $this->putInCustomData("defaultUserId", $v); }
	
	public function getDefaultTags() { return $this->getFromCustomData("defaultTags", null); }
	public function setDefaultTags( $v ) { $this->putInCustomData("defaultTags", $v); }
	
	public function getDefaultAdminTags() { return $this->getFromCustomData("defaultAdminTags", null); }
	public function setDefaultAdminTags( $v ) { $this->putInCustomData("defaultAdminTags", $v); }
	
	public function getMaxAttachmentSizeKbytes() { return $this->getFromCustomData("maxAttachmentSizeKbytes", null); }
	public function setMaxAttachmentSizeKbytes( $v ) { $this->putInCustomData("maxAttachmentSizeKbytes", $v); }
	
	public function getMaxAttachmentsPerMail() { return $this->getFromCustomData("maxAttachmentsPerMail", null); }
	public function setMaxAttachmentsPerMail( $v ) { $this->putInCustomData("maxAttachmentsPerMail", $v); }
	

/* ---------------------- CustomData functions ------------------------- */
	private $m_custom_data = null;
	
	public function getPriority($isBulk)
	{
		$priorityGroup = PriorityGroupPeer::retrieveByPK($this->getPriorityGroupId());
		
		if(!$priorityGroup)
		{
			if($isBulk)
				return PriorityGroup::DEFAULT_BULK_PRIORITY;
				
			return PriorityGroup::DEFAULT_PRIORITY;
		}
		
		if($isBulk)
			return $priorityGroup->getBulkPriority();
			
		return $priorityGroup->getPriority();
	}
	
	public function putInCustomData ( $name , $value , $namespace = null )
	{
//		sfLogger::getInstance()->warning ( __METHOD__ . " " . ( $namespace ? $namespace. ":" : "" ) . "[$name]=[$value]");
		$custom_data = $this->getCustomDataObj( );
		$custom_data->put ( $name , $value , $namespace );
	}

	public function getFromCustomData ( $name , $namespace = null , $def_value = null )
	{
		$custom_data = $this->getCustomDataObj( );
		$res = $custom_data->get ( $name , $namespace );
		if ( $res === null ) return $def_value;
		return $res;
	}

	public function removeFromCustomData ( $name , $namespace = null)
	{

		$custom_data = $this->getCustomDataObj( );
		return $custom_data->remove ( $name , $namespace );
	}

	public function incInCustomData ( $name , $delta = 1, $namespace = null)
	{
		$custom_data = $this->getCustomDataObj( );
		return $custom_data->inc ( $name , $delta , $namespace  );
	}

	public function decInCustomData ( $name , $delta = 1, $namespace = null)
	{
		$custom_data = $this->getCustomDataObj(  );
		return $custom_data->dec ( $name , $delta , $namespace );
	}

	private function getCustomDataObj( )
	{
		if ( ! $this->m_custom_data )
		{
			$this->m_custom_data = myCustomData::fromString ( $this->getCustomData() );
		}
		return $this->m_custom_data;
	}
	
	private function setCustomDataObj()
	{
		if ( $this->m_custom_data != null )
		{
			$this->setCustomData( $this->m_custom_data->toString() );
		}
	}
/* ---------------------- CustomData functions ------------------------- */
}
