<?php
/**
 * @package api
 * @subpackage filters
 */
class KalturaFilter extends KalturaObject
{
	const LT = "lt";
	const LTE = "lte";
	const GT = "gt";
	const GTE = "gte";
	const EQ = "eq";
	const LIKE = "like";
	const XLIKE = "xlike";
	const LIKEX = "likex";
	const IN = "in";
	const NOT_IN = "notin";
	const NOT = "not";
	const BIT_AND = "bitand";
	const BIT_OR = "bitor";
	const MULTI_LIKE_OR = "mlikeor";
	const MULTI_LIKE_AND = "mlikeand";
	const MATCH_OR = "matchor";
	const MATCH_AND = "matchand";

	private $operator_map = array ( 
		);
	
	protected function getMapBetweenObjects ( )
	{
		return array_merge(parent::getMapBetweenObjects(), array("orderBy" => "_order_by"));
	}
	
	protected function getOrderByMap ( )
	{
		return array();
	}
	
	/**
	 * @var string $orderBy
	 */
	public $orderBy;
	
	// not supposed to be populated from core objects
/*		
	protected function fromObject ( $source_object  )
	{
		foreach ( $this->getMapBetweenObjects() as $this_prop => $object_prop )
		{
//	echo "Mapping $this_prop => $entry_prop<br>";
			if ( is_numeric( $this_prop) ) $this_prop = $object_prop;
//	echo "setting  $this_prop => $entry_prop<br>";
			$this->$this_prop = call_user_func(array ( $source_object ,"get{$object_prop}"  ) );
		}
	}
*/
	// must fill an object of type baseObjectFilter
	public function toObject ( $object_to_fill , $props_to_skip = array() )
	{
	    // translate the order by properties
	    $newOrderBy = "";
	    $orderByMap = $this->getOrderByMap();
	    if ($orderByMap)
		{
		    $orderProps = explode(",", $this->orderBy);
		    foreach($orderProps as $prop)
		    {
		         if (isset($orderByMap[$prop]))
		         {
		             $newOrderBy .= ($orderByMap[$prop] . ","); 
		         }
		    }
		}
		if (strpos($newOrderBy,",") === strlen($newOrderBy) - 1)
		    $newOrderBy = substr($newOrderBy, 0, strlen($newOrderBy) - 1);
		
		$this->orderBy = $newOrderBy;
		
		foreach ( $this->getMapBetweenObjects() as $this_prop => $object_prop )
		{
		 	if ( is_numeric( $this_prop) ) $this_prop = $object_prop;
		 	// convert the v3 prop name to the naming convension of the core filter
		 	$filter_prop_name = self::translatePropNames ( $object_prop );
		 	call_user_func_array( array ( $object_to_fill ,"set"  ) , array ($filter_prop_name , $this->$this_prop ) );
		 }		
		 
		
		
		return $object_to_fill;		
	}	
	
	private static function translatePropNames ( $prop_name_with_operator )
	{
		return $prop_name_with_operator;
//		@list ( $field , $operator ) = explode ( "_" , $this_prop_name );
//		if ( ! $operator ) $operator = "eq";
//		return "_{$operator}_"
	}
	
}
?>