<?php

/**
 * Subclass for representing a row from the 'storage_profile' table.
 *
 * 
 *
 * @package lib.model
 */ 
class StorageProfile extends BaseStorageProfile
{
	const PLAY_FORMAT_HTTP = 'http';
	const PLAY_FORMAT_RTMP = 'rtmp';
	const PLAY_FORMAT_SILVER_LIGHT = 'sl';
	
	const STORAGE_SERVE_PRIORITY_KALTURA_ONLY = 1;
	const STORAGE_SERVE_PRIORITY_KALTURA_FIRST = 2;
	const STORAGE_SERVE_PRIORITY_EXTERNAL_FIRST = 3;
	const STORAGE_SERVE_PRIORITY_EXTERNAL_ONLY = 4;
	
	const STORAGE_STATUS_DISABLED = 1;
	const STORAGE_STATUS_AUTOMATIC = 2;
	const STORAGE_STATUS_MANUAL = 3;
	
	const STORAGE_KALTURA_DC = 0;
	const STORAGE_PROTOCOL_FTP = 1;
	const STORAGE_PROTOCOL_SCP = 2;
	const STORAGE_PROTOCOL_SFTP = 3;
	
	const STORAGE_DEFAULT_KALTURA_PATH_MANAGER = 'kPathManager';
	const STORAGE_DEFAULT_EXTERNAL_PATH_MANAGER = 'kExternalPathManager';
	
	private $m_custom_data = null;

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

	private function putInCustomData ( $name , $value , $namespace = null )
	{
		$custom_data = $this->getCustomDataObj( );
		$custom_data->put ( $name , $value , $namespace );
	}
	
	private function getFromCustomData ( $name , $namespace = null , $def_value = null )
	{
		$custom_data = $this->getCustomDataObj( );
		$res = $custom_data->get ( $name , $namespace );
		if ( $res === null ) return $def_value;
		return $res;
	}
	
	public function save ( $con = null )
	{
		// if the custom_data obj has change - serialize it
		$this->setCustomDataObj();
		
		return parent::save ( $con ) ;		
	}
	
	/**
	 * @return kPathManager
	 */
	public function getPathManager()
	{
		$class = $this->getPathManagerClass();
		if(!$class || !strlen(trim($class)) || !class_exists($class))
		{
			if($this->getProtocol() == self::STORAGE_KALTURA_DC)
			{
				$class = self::STORAGE_DEFAULT_KALTURA_PATH_MANAGER;
			}
			else
			{
				$class = self::STORAGE_DEFAULT_EXTERNAL_PATH_MANAGER;
			}
		}
			
		return new $class();
	}
	
	/* ---------------------------------- TODO - temp solution -----------------------------------------*/
	// remove after event manager implemented
	
	const STORAGE_TEMP_TRIGGER_CONVERT_FINISHED = 1;
	const STORAGE_TEMP_TRIGGER_MODERATION_APPROVED = 2;
	const STORAGE_TEMP_TRIGGER_FLAVOR_READY = 3;
		
	public function getTrigger() { return $this->getFromCustomData("trigger", null, self::STORAGE_TEMP_TRIGGER_CONVERT_FINISHED); }
	public function setTrigger( $v ) { $this->putInCustomData("trigger", (int)$v); }
	
	/* ---------------------------------- TODO - temp solution -----------------------------------------*/
	
}
