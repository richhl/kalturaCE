<?php
require_once ( "myMultiRequest.class.php");
class defPartnerservices2baseAction extends kalturaAction
{
	public function execute()
	{
		// can't read using $_REQUEST because the 'myaction' paramter is created in a routing.yml rule
		$service_name = $this->getRequestParameter( "myaction" );

		// remove all '_' and set to lowercase
		$myaction_name = strtolower( str_replace ( "_" , "" , $service_name ) );
		$clazz_name = $myaction_name . "Action";
//		echo "[$myaction_name] [$clazz_name]<br>";

//		$clazz = get_class ( $clazz_name );

		//$multi_request = $this->getRequestParameter( "multirequest" , null );
		$multi_request = $myaction_name ==  "multirequest" ;
		if ( $multi_request  )
		{
			$multi_request = new myMultiRequest ( $_REQUEST, $this );
			$response = $multi_request->execute();
		}
		else
		{
			$include_result = include_once ( "{$clazz_name}.class.php");
			if ( $include_result )
			{
				$myaction = new $clazz_name( $this );
				$myaction->setInputParams ( $_REQUEST );
				$response = $myaction->execute( );
			}
			else
			{
				$format = $this->getP ( "format" );
				$response = "Error: Invalid service [$service_name]";
			}
		}

		$format = $this->getP ( "format" );
		if ( $format == kalturaWebserviceRenderer::RESPONSE_TYPE_PHP_ARRAY || $format == kalturaWebserviceRenderer::RESPONSE_TYPE_PHP_OBJECT )
		{
			//$this->setHttpHeader ( "Content-Type" , "text/html; charset=utf-8" );
			$response = "<pre>" . print_r ( $response , true ) . "</pre>" ;
		}

		return $this->renderText( $response );

	}

	public function setHttpHeader ( $hdr_name , $hdr_value  )
	{
		$this->getResponse()->setHttpHeader ( $hdr_name , $hdr_value  );
	}
}
?>