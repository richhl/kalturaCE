<?php
class SearchResultWrapper extends objectWrapperBase
{
        protected $basic_fields = array ( "id"  , "partnerId");

        protected $regular_fields_ext = array ( "keywords" , "source" , "mediaType" , "title" , "tags" ,
                "description", "url" , "thumbUrl" , "sourceLink" ,   "credit" , "embedCode" , "licenseType" , "thumbUrl" , "sourceLink" , "credit" , 
                "createdAt" , "updatedAt" ,
        );

        protected $detailed_fields_ext = array ( ) ;

        protected $detailed_objs_ext = array ( );

        protected $updateable_fields = array ( "keywords" , "source" , "mediaType" , "title" , "tags" ,
                "description", "url" , "thumbUrl" , "sourceLink" ,   "credit" , "embedCode" , "licenseType" , "thumbUrl" , "sourceLink" , "credit" , 
                "createdAt" , "updatedAt" ,  );
        
        protected $objs_cache = array ( );

		public function describe() 
		{
			return 
				array (
					"display_name" => "SearchResult",
					"desc" => ""
				);
		}
	
        public function getUpdateableFields()
        {
        	return $this->updateable_fields;
        }
}
?>
