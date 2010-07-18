<?php
require_once ( "defPartnerservices2Action.class.php");

class addsearchresultAction extends defPartnerservices2Action
{
	public function describe()
	{
		return 
			array (
				"display_name" => "addSearchResult",
				"desc" => "" ,
				"in" => array (
					"mandatory" => array ( 
						"search_result" => array ("type" => "SearchResult", "desc" => ""),
						),
					"optional" => array (
						)
					),
				"out" => array (
					"search_result" => array ("type" => "SearchResult", "desc" => "")
					),
				"errors" => array (
				)
			); 
	}
	
	protected function getObjectPrefix()
	{
		return "searchResult";
	}
	
	public function executeImpl ( $partner_id , $subp_id , $puser_id , $partner_prefix , $puser_kuser )
	{
		// get the new properties for the kuser from the request
		$search_result = new SearchResult();
		
		$obj_wrapper = objectWrapperBase::getWrapperClass( $search_result , 0 );
		
		$updateable_fields = $obj_wrapper->getUpdateableFields(  );
		
		// TODO - always use fillObjectFromMapOrderedByFields rather than fillObjectFromMap
		$fields_modified = baseObjectUtils::fillObjectFromMapOrderedByFields( 
			$this->getInputParams() , $search_result , $this->getObjectPrefix() ."_" , $updateable_fields );
		// check that mandatory fields were set
		// TODO
		if ( count ( $fields_modified ) > 0 )
		{
			$search_result->setPartnerId( $partner_id );
			$search_result->save();
										
			$this->addMsg ( $this->getObjectPrefix() , objectWrapperBase::getWrapperClass( $search_result ) );
			$this->addDebug ( "added_fields" , $fields_modified );
		}
		else
		{
			$this->addError( APIErrors::NO_FIELDS_SET_FOR_SEARCH_RESULT );
		}
	}
}
?>