<?php
  /**
	* Will perform get,update and free operations on database objects that implement the IExclusiveLock interface
	*
	*/
class myDbExclusiveLock 
{
	/**
	 * will return $max_count of objects using the peer.
	 * The criteria will be used to filter the basic parameter, the function will encapsulate the inner logic of the   IExclusiveLock interface
	 * and the exclusiveness.
	 *
	 * @param Criteria $c
	 */
	public static function getExclusive ( Criteria $c , IExclusiveLockPeer $peer , 
		$location_id , $server_id , $max_execution_time , $number_of_objects = 1 )
	{
		$try_count=0;
		// loop several times until there are all the required EXCLUSIVE objects.
		// if there are not enough - it may be because there are none in the DB OR because some where grabbed.
		// for the second reason - it's worth trying again.
		$exclusive_objects = array();  
		do 
		{
			list ( $not_exclusive_count , $objects ) = self::getExclusiveImpl ($c , $peer , 
				$location_id , $server_id , $max_execution_time , $number_of_objects );
			$try_count ++;
			$exclusive_objects = array_merge ( $exclusive_objects , $objects );
		}
		while ( ( count($objects) < $number_of_objects && $not_exclusive_count > 0 ) && $try_count < 3 );

		return $exclusive_objects;
	}

	private  static function getExclusiveImpl ( Criteria $c , IExclusiveLockPeer $peer , 
		$location_id , $server_id , $max_execution_time , $number_of_objects = 1 )
	{
		// "my unfinished jobs"
/*		$criterion1 = $c->getNewCriterion( $this->translate ( $peer, IExclusiveLock::PROCESSOR_LOCATION ) , $location_id ) ;
		$criterion1->addAnd ( $c->getNewCriterion( $this->translate ( $peer, IExclusiveLock::PROCESSOR_NAME ) , $server_id ) );
		$criterion1->addAnd ( $c->getNewCriterion( $this->translate ( $peer, IExclusiveLock::STATUS ) , array ( 1,2,3,4) , Criteria::IN ) );
		$criterion1->addAnd ( $c->getNewCriterion( $this->translate ( $peer, IExclusiveLock::EXECUTION_ATTEMPTS ) , MAX_EXECUTION_ATTEMPTS , Criteria::LESS_THAN_EQUAL ) );
*/
		// 	"my unfinished jobs"
		$query1 = "(" . IExclusiveLock::PROCESSOR_LOCATION."='$location_id' AND " . IExclusiveLock::PROCESSOR_NAME ."='$server_id' AND " . 
			IExclusiveLock::STATUS . " IN (" . $peer->getInProcStatusList() . ") " . 
			" AND " . IExclusiveLock::EXECUTION_ATTEMPTS . "<=" . IExclusiveLock::MAX_EXECUTION_ATTEMPTS . ")";
		//	"others unfinished jobs"
		$query2 = "((" . IExclusiveLock::PROCESSOR_LOCATION."<>'$location_id' OR " . IExclusiveLock::PROCESSOR_NAME ."<>'$server_id' ) AND " . 
			IExclusiveLock::STATUS . " IN (" . $peer->getInProcStatusList() . ") " . 
			" AND " . IExclusiveLock::EXECUTION_ATTEMPTS . "<=" . IExclusiveLock::MAX_EXECUTION_ATTEMPTS . " AND " . 
			IExclusiveLock::PROCESSOR_EXPIRATION . "<=" . time() . " )";
		
		// "pending jobs"
		$query3 = "(" .IExclusiveLock::STATUS . " IN (" . $peer->getPendingStatusList()  . ")) ";

		$crit1 = $c->getNewCriterion( self::translate ( $peer, IExclusiveLock::PROCESSOR_LOCATION ) , $query1 , Criteria::CUSTOM ) ;
		$crit1->addOr ( $c->getNewCriterion( self::translate ( $peer, IExclusiveLock::PROCESSOR_LOCATION ) , $query2 , Criteria::CUSTOM ) );
		$crit1->addOr ( $c->getNewCriterion( self::translate ( $peer, IExclusiveLock::PROCESSOR_LOCATION ) , $query3 , Criteria::CUSTOM ) );
		
		$c->addAnd ( $crit1 );
		
		$c->addAscendingOrderByColumn( self::translate ( $peer, "created_at" ) );
		$c->setLimit ( $number_of_objects );
		
		$objects = $peer->doSelect ( $c );
		
		$exclusive_objects = array();

		// make sure the objects where not taken -
		$con = Propel::getConnection();
		
		$not_exclusive_count = 0;

		foreach ( $objects as $object )
		{
			$lock_version = $object->getLockVersion() ;
			$criteria_for_exclusive_update = new Criteria();
			$criteria_for_exclusive_update->add( self::translate( $peer , "id" ) ,$object->getId() ); 
			$criteria_for_exclusive_update->add( self::translate( $peer , IExclusiveLock::LOCK_VERSION ) , $lock_version );
			
			$update = new Criteria();

			// increment the lock_version - this will make sure it's exclusive
			$update->add(self::translate( $peer , IExclusiveLock::LOCK_VERSION ) , $lock_version+1 );
			// increment the execution_attempts 
			$update->add(self::translate( $peer , IExclusiveLock::EXECUTION_ATTEMPTS ) , $object->getExecutionAttempts()+1 );

			$update->add(self::translate( $peer , IExclusiveLock::STATUS ) , $peer->getInProcStatus() );
			$update->add(self::translate( $peer , IExclusiveLock::PROCESSOR_LOCATION ), $location_id );			
			$update->add(self::translate( $peer , IExclusiveLock::PROCESSOR_NAME ), $server_id );
			$processor_expiration = time() + $max_execution_time;
			$update->add(self::translate( $peer , IExclusiveLock::PROCESSOR_EXPIRATION ), $processor_expiration);
			
			$affectedRows = BasePeer::doUpdate( $criteria_for_exclusive_update, $update, $con);
			
			if ( $affectedRows == 1 )
			{
				// fix the object to reflect what is in the DB
				$object->setLockVersion ( $lock_version+1 );
				$object->setExecutionAttempts ( $object->getExecutionAttempts()+1 );
				$object->setProcessorLocation ( $location_id );
				$object->setProcessorName ( $server_id );
				$object->setProcessorExpiration ( $processor_expiration );
				
				$exclusive_objects[] = $object;
			}
			else
			{
				$not_exclusive_count++;
				kLog::log ( "Object not exclusive: [" . get_class ( $object ) . "] id [" . $object->getId() . "]" );  
			}
		}
		
		return array ( $not_exclusive_count , $exclusive_objects );
	}
	
	
	public static function updateExclusive ( $id , $peer , 
		$location_id , $server_id , IExclusiveLock $object )
	{
		$c = new Criteria();
		$c->add(self::translate( $peer , "id" ), $id );
		$c->add(self::translate( $peer , IExclusiveLock::PROCESSOR_LOCATION ), $location_id );			
		$c->add(self::translate( $peer , IExclusiveLock::PROCESSOR_NAME ), $server_id );
		
		$db_object = $peer->doSelectOne ( $c );
		if ( $db_object  )
		{
			baseObjectUtils::fillObjectFromObject( $peer->getFieldNames() ,  $object , $db_object , baseObjectUtils::CLONE_POLICY_PREFER_NEW , null , BasePeer::TYPE_PHPNAME );
			$db_object->save();
			return $db_object;
		}
		
		$db_object = $peer->retrieveByPk ( $id  );
		throw new APIException ( APIErrors::UPDATE_EXCLUSIVE_JOB_FAILED , $id,$location_id,$server_id , print_r ( $db_object , true ));
	}
	
	
	/**
	 * 
	 * @param $id
	 * @param $peer
	 * @param $location_id
	 * @param $server_id
	 * @param $pending_status - optional. will be used to set the status once the object is free 
	 * @return IExclusiveLock
	 */
	public static function freeExclusive ( $id , IExclusiveLockPeer $peer , 
		$location_id , $server_id , $pending_status = null )
	{
		if ( $pending_status === null ) $pending_status = $peer->getPendingStatus() ;
		$c = new Criteria();
		
		$c->add(self::translate( $peer , "id" ), $id );
		$c->add(self::translate( $peer , IExclusiveLock::PROCESSOR_LOCATION ), $location_id );			
		$c->add(self::translate( $peer , IExclusiveLock::PROCESSOR_NAME ), $server_id );
		
		$db_object = $peer->doSelectOne ( $c );
		if ( $db_object  )
		{
			$db_object->setProcessorLocation( null );
			$db_object->setProcessorName( null );
			$db_object->setExecutionAttempts( null );
			$db_object->setProcessorExpiration( null );
			$db_object->setExecutionAttempts( null );
			$db_object->setStatus ( $pending_status );	
			$db_object->save();
			return $db_object;
		}
		
		throw new APIException ( APIErrors::FREE_EXCLUSIVE_JOB_FAILED , $id,$location_id,$server_id );
	}
	
	private static function translate ( $peer ,  $field_name )
	{
		return $peer->translateFieldName( $field_name , BasePeer::TYPE_FIELDNAME , BasePeer::TYPE_COLNAME );
	}
}

interface IExclusiveLock
{
	const MAX_EXECUTION_ATTEMPTS = 3;
	
	const STATUS = "status";
	const PROCESSOR_LOCATION = "processor_location";
	const PROCESSOR_NAME = "processor_name";
	const PROCESSOR_EXPIRATION = "processor_expiration";
	const EXECUTION_ATTEMPTS = "execution_attempts";
	const LOCK_VERSION = "lock_version";
	
	public function getStatus();
	public function setStatus($v);
	public function getProcessorName();
	public function setProcessorName($v);
	public function getProcessorLocation();
	public function setProcessorLocation($v);
	public function getProcessorExpiration($format = 'Y-m-d H:i:s');
	public function setProcessorExpiration($v);
	public function getExecutionAttempts();
	public function setExecutionAttempts($v);
	public function getLockVersion();
	public function setLockVersion($v);
	
}

/**
 * Each peer of a IExclusiveLock will have to implement this interface
 * @author Liron
 *
 */
interface IExclusiveLockPeer
{

	// will be used when exclusive job is free 
	function getPendingStatus();
		
	// a list of statuses to filter when looking new jobs to perform
	function getPendingStatusList();
	
	// the status to set when a job is claimed
	function getInProcStatus();
	
	// the statuses to filter when searching for unfinished jobs
	function getInProcStatusList();
}

?>