<?php
class myPartnerGroups
{
	const GROUP_SEPARATOR = ";";
	const GROUP_WILDCARD = "*";
	
	private $groups_definition ;
	private $groups_arr;
	
	private $current_group_index=0;
	
	
	public function __construct( $groups_definition )
	{
		$this->groups_definition = $groups_definition;
		$this->groups_arr = explode ( self::GROUP_SEPARATOR , $groups_definition );
	}
	
	public function getPartnerGroup ()
	{
		if ( $this->current_group_index > count( $this->groups_arr )  ) 
			return false;
		
		$current_group = trim(@$this->groups_arr[$this->current_group_index]);
		return 	$current_group;	
	}
	
	public function applyPartnerGroupToCriteria ( Criteria $c , $peer )
	{
		if ( $this->current_group_index >= count( $this->groups_arr )  ) 
			return false;
		
echo "[" .  $this->current_group_index . "]";
	
		$current_group = trim(@$this->groups_arr[$this->current_group_index]);

		$this->current_group_index++;
		
		if ( $current_group == self::GROUP_WILDCARD )
		{
			
		}
		else
		{
			$exclude = false;
			if ( strpos( $current_group , "-" ) === 0 )
			{
				$current_group = substr ( $current_group , 1 ); // remove the first char
				$exclude = true;
			}
			elseif ( strpos( $current_group , "+" ) === 0 )
			{
				$current_group = substr ( $current_group , 1 ); // remove the first char
			}
			if ( trim ( $current_group ) == "" )
				return true; // don't filter - no partner group 
				
			// add to the criteria - the list of partners
			$c->addAnd ( 
				$peer->translateFieldName( "partner_id" , BasePeer::TYPE_FIELDNAME , BasePeer::TYPE_COLNAME ) , 
				explode ( "," , $current_group ),
				$exclude ? Criteria::NOT_IN  : Criteria::IN );
		}
		return true;
	}
}
?>