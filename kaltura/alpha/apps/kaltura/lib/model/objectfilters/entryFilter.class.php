<?php
class entryFilter extends baseObjectFilter
{
	// this flag will indicate if the uiser_id set in the _eq_user_id field shouyld be translated to kuser_id or not.
	// if $user_id_is_kuser_id is true, the switch was already done   
	public $user_id_is_kuser_id = false;
	
	public function setSwitchUserIdToKuserId( $kuser_id )
	{
		$this->user_id_is_kuser_id = true;
		$this->fields["_eq_user_id"] = $kuser_id;
	}
	 
	public function init ()
	{
		// TODO - should separate the schema of the fields from the actual values
		// or can use this to set default valuse
		$this->fields = kArray::makeAssociativeDefaultValue ( array (
			"_in_id" , 
			"_eq_user_id" ,  // is in fact the kuser_id - see aliases
			"_eq_kshow_id" ,
			"_eq_status" ,
			"_in_status" ,
			"_eq_type"   ,
			"_in_type"   ,
			"_eq_media_type"   ,
			"_in_media_type"   ,
			"_eq_indexed_custom_data_1"   ,
			"_in_indexed_custom_data_1"   ,			
			"_like_name"   ,
			"_eq_name"   ,
			"_eq_tags" ,			
			"_like_tags" ,
			"_mlikeor_tags" ,			
			"_mlikeand_tags" ,
			"_mlikeor_admin_tags" ,			
			"_mlikeand_admin_tags" ,
			"_like_admin_tags" ,			
			"_mlikeor_name" ,			
			"_mlikeand_name" ,
			"_mlikeor_search_text" ,			
			"_mlikeand_search_text" ,			
//			"_gte_votes" ,
			"_eq_group_id" ,
			"_gte_views" ,
			"_gte_created_at" ,
			"_lte_created_at" ,
			"_gte_updated_at" ,
			"_lte_updated_at" ,
			"_gte_modified_at" ,
			"_lte_modified_at" ,
			"_in_partner_id"   ,
			"_eq_partner_id" ,
			"_eq_source_link" ,
			"_gte_media_date" ,
			"_lte_media_date" ,
			"_eq_moderation_status" , 
			"_in_moderation_status" ,
			"_in_display_in_search" ,
			"_mlikeor_tags-name" ,
			"_mlikeor_tags-admin_tags" ,
			"_mlikeor_tags-admin_tags-name" ,
			"_mlikeand_tags" ,	
			"_mlikeand_tags-admin_tags" ,
			"_mlikeand_tags-admin_tags-name" ,			
			"_matchand_search_text" ,
			"_matchor_search_text" ,
			) , NULL );

		$this->allowed_order_fields = array ( "created_at" , "views", "name", "media_date" , 
			"type" , "media_type" , "plays" , "views" , "rank" , "moderation_count" , "moderation_status" , "modified_at" ,)	;

		$this->aliases = array ( "user_id" => "kuser_id" );
	}

	public function describe()
	{
		return
			array (
				"display_name" => "EntryFilter",
				"desc" => "",
				"fields" => array(
					"user_id" => array("type" => "integer", "desc" => ""),
					"kshow_id" => array("type" => "integer", "desc" => ""),
					"type" => array("type" => "enum,entry,ENTRY_TYPE", "desc" => ""),
					"media_type" => array("type" => "enum,entry,ENTRY_MEDIA_TYPE", "desc" => ""),
					"view" => array("type" => "integer", "desc" => ""),
					"created_at" => array("type" => "date", "desc" => "")
				)
			);
	}

	// TODO - move to base class, all that should stay here is the peer class, not the logic of the field translation !
	// The base class should invoke $peek_class::translateFieldName( $field_name , BasePeer::TYPE_FIELDNAME , BasePeer::TYPE_COLNAME );
	public function getFieldNameFromPeer ( $field_name )
	{
		return entryPeer::translateFieldName( $field_name , BasePeer::TYPE_FIELDNAME , BasePeer::TYPE_COLNAME );
	}

	public function getIdFromPeer (  )
	{
		return entryPeer::ID;
	}
	
	
	// this function should be called when we should prefer the MATCH mechanism over the regular LIKE.
	// it will copy all the values from the fields 'name' 'tags' 'admin_tags' to the search_text filter and use
	// MATCH rather than LIKE 
	public function forceMatch ( )
	{
		$mlikeand_current_tags = ""; 
		$mlikeor_current_tags = "";
		foreach ( $this->fields as $f => &$val )
		{
			if ( ! $val ) continue;
			if ( strpos ( $f , "mlikeor" ) > 0  )
			{
				if ( self::hasMachableField( $f  ) )
				{
					// if the value is of type  abc, def, ghi jkl,mno
					// the result should be abc* def* (ghi* jkl*) mno*  
					// replace all OR_SEPARATOR with IN_SEPARATOR
					
//					 $mlikeor_current_tags .= "," . str_replace( self::OR_SEPARATOR , self::IN_SEPARATOR  , $val ) ;
					 $mlikeor_current_tags .= " " .self::formatMatchKey(  explode ( "," , str_replace( self::OR_SEPARATOR , self::IN_SEPARATOR  , $val ) ), self::MATCH_OR );
					 $val = null; /// null the previous value - we copied it to the match string     
				}
			}
			// LIKE alone implies that tall we are searching for MUST appear in the text - like in AND			
			elseif ( strpos ( $f , "mlikeand" ) > 0 || strpos ( $f , "like" ) > 0 )
			{
				if ( self::hasMachableField( $f  ) )
				{
					// replace all OR_SEPARATOR with IN_SEPARATOR
//					 $mlikeand_current_tags .= "," . str_replace( self::OR_SEPARATOR , self::IN_SEPARATOR , $val ) ;
 					 $mlikeand_current_tags .= " " .self::formatMatchKey(  explode ( "," , str_replace( self::OR_SEPARATOR , self::IN_SEPARATOR  , $val ) ), self::MATCH_AND );
					 $val = null; /// null the previous value - we copied it to the match string    
				}
			}
		}
	
	
		// in this case the value will be an array that will indicate the structure of the original request
		// this will format the match string 
		if ($mlikeand_current_tags ) $this->fields["_matchand_search_text"] =	$this->fields["_matchand_search_text"] . " " . $mlikeand_current_tags;
		// keep this line if we want to format the match key onl once at the end
		//.self::formatMatchKey(  explode ( "," , $mlikeand_current_tags ), self::MATCH_AND );
/*			
		if ($mlikeor_current_tags ) $this->fields["_matchor_search_text"] = $this->fields["_matchor_search_text"]  . " " .  $mlikeor_current_tags;
		//	$this->fields["_matchor_search_text"] . " " .self::formatMatchKey( explode ( "," , $mlikeor_current_tags ), self::MATCH_OR );
*/
			
		// because we format the correct representation of the match caluse here - we can mount all the string on _matchand_search_text rather than 
		// split some for _matchand_search_text and some for _matchor_search_text - a single etry in the filter will do
		if ($mlikeor_current_tags ) $this->fields["_matchand_search_text"] = $this->fields["_matchand_search_text"] . " " . $mlikeor_current_tags;
//			$this->fields["_matchand_search_text"] . " " .self::formatMatchKey( explode ( "," , $mlikeor_current_tags ), self::MATCH_OR );

	}
	
	private static function hasMachableField ( $field_name )
	{
		return ( strpos ( $field_name , "name" ) > 0 ||
			strpos ( $field_name , "tags" ) > 0 ||
			strpos ( $field_name , "admin_tags" ) > 0 );
	}
}

?>