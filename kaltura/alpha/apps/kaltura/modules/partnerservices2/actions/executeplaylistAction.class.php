<?php
require_once ( "defPartnerservices2Action.class.php");

class executeplaylistAction extends defPartnerservices2Action
{
	public function describe()
	{
		return
			array (
				"display_name" => "executePlaylist",
				"desc" => "" ,
				"in" => array (
					"mandatory" => array (
						"playlist_id" => array ("type" => "integer", "desc" => "")
						),
					"optional" => array (
						"fp" => array ("type" => "string", "desc" => "filter prefix used for all the following filters") ,
						"filter1" => array ("type" => "entryFilter", "desc" => "") ,
						"filter2" => array ("type" => "entryFilter", "desc" => "") ,
						"filter3" => array ("type" => "entryFilter", "desc" => "") ,
						"filter4" => array ("type" => "entryFilter", "desc" => "") ,
						"detailed" => array ("type" => "boolean", "desc" => ""),
						"page_size" => array ("type" => "integer", "default" => 10, "desc" => ""),
						"page" => array ("type" => "boolean", "default" => 1, "desc" => ""),
						"use_filter_puser_id" => array ("type" => "boolean", "desc" => ""),
						)
					),
				"out" => array (
					"count" => array ("type" => "integer", "desc" => ""),
					"page_size" => array ("type" => "integer", "desc" => ""),
					"page" => array ("type" => "integer", "desc" => ""),
					"entries" => array ("type" => "*entry", "desc" => ""),
					"user" => array ("type" => "PuserKuser", "desc" => ""),
					),
				"errors" => array (
				)
			);
	}

	const MAX_FILTER_COUNT = 10;
	

	protected function getExecutionCacheKey ( $partner_id , $subp_id , $puser_id  )
	{
		return $this->executeImpl( $partner_id , $subp_id , $puser_id , null , null , true );
	}
	

	
	protected function setExtraFilters ( entryFilter &$fields_set )	{	}
	
	protected function joinOnDetailed () { return true;}

	protected function getObjectPrefix () { return "entries"; } 

	
	public function executeImpl ( $partner_id , $subp_id , $puser_id , $partner_prefix , $puser_kuser , $create_cachekey=false)
	{
		// TODO -  verify permissions for viewing lists

		$detailed = $this->getP ( "detailed" , false );
		$limit = $this->getP ( "page_size" , 10 );
		$limit = $this->maxPageSize ( $limit );

		$page = $this->getP ( "page" , 1 );

		$user_filter_prefix = $this->getP ( "fp" , "filter" );
		
		$offset = ($page-1)* $limit;

		// TODO - should limit search to partner ??
//		kuserPeer::setUseCriteriaFilter( false );
//		entryPeer::setUseCriteriaFilter( false );

		$playlist_id= $this->getPM ( "playlist_id" );
		$input_params = $this->getInputParams();
		
		$extra_filters = array();
		for ( $i=1 ; $i< self::MAX_FILTER_COUNT ; $i++ )
		{
			// filter
			$extra_filter = new entryFilter(  );
			
			$fields_set = $extra_filter->fillObjectFromRequest( $input_params , "{$user_filter_prefix}{$i}_" , null );
			if ( $fields_set )		
				$extra_filters[$i] = $extra_filter;
		}
		if ( $create_cachekey ) 
		{
			$cache_key_arr = array ( "playlist_id" => $playlist_id , "filters" => $extra_filters );
			$cahce_key = new executionCacheKey( );
			$cahce_key->expiry =  600 ;
			$cahce_key->key = md5( print_r($cache_key_arr,true ) );
			return $cahce_key;
		}
		
		$entry_list = myPlaylistUtils::executePlaylistById( $partner_id , $playlist_id , $extra_filters , $detailed );

		myEntryUtils::updatePuserIdsForEntries ( $entry_list );
		
		$level = $detailed ? objectWrapperBase::DETAIL_LEVEL_DETAILED : objectWrapperBase::DETAIL_LEVEL_REGULAR ;
		$wrapper =  objectWrapperBase::getWrapperClass( $entry_list  , $level );
		$this->addMsg ( "count" , count ( $entry_list )) ;
		$this->addMsg ( $this->getObjectPrefix() , $wrapper ) ;
		
	}
}
?>