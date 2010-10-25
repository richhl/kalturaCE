<?php
require_once( 'model/objectfilters/filters.class.php');
require_once( 'model/kuserPeer.php');

class kuserFilter extends baseObjectFilter
{
	public function init ()
	{
		// TODO - should separate the schema of the fields from the actual values
		// or can use this to set default valuse
		$this->fields = kArray::makeAssociativeDefaultValue ( array (
			"_likex_screen_name"   , 
			"_like_screen_name"   , 
			"_likex_email" ,
			"_like_country" ,
			"_like_tags" ,
			"_gte_produced_kshows" ,
			"_gte_entries" ,
			"_eq_partner_id" , 
			"_like_tags" ,
			"_gte_id" , 
			"_lte_id" ,
			"_notin_id" ) , NULL );
			
		$this->allowed_order_fields = array("created_at");
	}

	public function describe() 
	{
		return 
			array (
				"display_name" => "UserFilter",
				"desc" => ""
			);
	}
	
	// TODO - move to base class, all that should stay here is the peer class, not the logic of the field translation !
	// The base class should invoke $peek_class::translateFieldName( $field_name , BasePeer::TYPE_FIELDNAME , BasePeer::TYPE_COLNAME );
	public function getFieldNameFromPeer ( $field_name )
	{
		$res = kuserPeer::translateFieldName( $field_name , $this->field_name_translation_type , BasePeer::TYPE_COLNAME );
		return $res;
	}

	public function getIdFromPeer (  )
	{
		return kuserPeer::ID;
	}
}

?>