<?php

/**
 * Subclass for representing a row from the 'syndication_feed' table.
 *
 * 
 *
 * @package lib.model
 */ 
class syndicationFeed extends BasesyndicationFeed
{
	// don't stop until a unique hash is created for this object
	private static function calculateId ( )
	{
		$dc = kDataCenterMgr::getCurrentDc();
		for ( $i = 0 ; $i < 10 ; ++$i)
		{
			$id = $dc["id"].'_'.kString::generateStringId();
			$existing_object = entryPeer::retrieveByPk( $id );
			
			if ( ! $existing_object ) return $id;
		}
		
		die();
	}
        
        public function save($con = null)
        {
                $is_new = false;
		if ( $this->isNew() )
		{
			$this->setId(self::calculateId());
                }
                $is_new = true;
                $res = parent::save( $con );
		if ($is_new)
		{
			// when retrieving the entry - ignore thr filter - when in partner has moderate_content =1 - the entry will have status=3 and will fail the retrieveByPk 
			syndicationFeedPeer::setUseCriteriaFilter(false);
			$obj = syndicationFeedPeer::retrieveByPk($this->getId());
			$this->setIntId($obj->getIntId());
			syndicationFeedPeer::setUseCriteriaFilter(true);
		}                
        }
/**
 * This is a partial file - it does not stand alone !
 * It can be included as-is in a lass that has 
 */
/* ---------------------- CustomData functions ------------------------- */
	private $m_custom_data = null;
	
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

	public function getCustomDataObj( )
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
