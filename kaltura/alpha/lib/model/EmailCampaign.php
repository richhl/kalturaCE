<?php

/**
 * Subclass for representing a row from the 'email_campaign' table.
 *
 * 
 *
 * @package lib.model
 */ 
class EmailCampaign extends BaseEmailCampaign
{
	const MARKUP_PREFIX = "kl:";
	
	const STATUS_SENDING = 0;
	const STATUS_ENDED = 1;
	
	private $template_content = null;
	
	private static function getUserFields ()
	{
		return 	array( "id" , "screenName" , "email" , "entries" , "producedKshows" , "views" , "status" , "genderText" , "tags" , 
			"blockEmailStr" , /*"lastKshowUrl"  , */"blockEmailUrl" );
	}

	private static function getSiteLinks ()
	{
		return 	array( "link-home" , "link-faq" , "link-forum" );
	}
	
	public function submitCampaign ( $recipient , $priority , $should_simulate=false )
	{
		if ( $this->template_content == null )
		{
			$path = $this->getTemplatePath();
			if ( $path == null )
			{
				throw new Exception( "Cannot submit campaign without a template");	
			}
			
			$this->template_content = myTemplateUtils::getTemplateContent( $this->getTemplatePath() );
		}
		
		$mailjob = new MailJob();
		$mailjob->setCampaignId( $this->getId() );
	 	$mailjob->Initialize( 0 , $priority ); // 0 will indicate generic
	 	$mailjob->setFromEmail( $this->getkuser()->getEmail() );
	 	$mailjob->setFromName( $this->getkuser()->getScreenName() );
	 	$mailjob->setTemplatePath( $this->getTemplatePath() );
//	 	$mailjob->setSubjectParamsArray( $this->getSubjectParamsArray() );
	
		// add ONLY the relevant fields from the template to the user's details
		$params_str = baseObjectUtils::objToString 
			( $recipient , self::getUserFields() );

		$mailjob->setBodyParams ( $params_str );
		$mailjob->setRecipientId( $recipient->getId() );
		$mailjob->setRecipientEmail( $recipient->getEmail() );
		$mailjob->setRecipientName( $recipient->getScreenName() );
		$mailjob->save();
		
		$simulation = $should_simulate ? $this->simulateCampaign ( $mailjob ) : "";
		return array ( $mailjob , $simulation );
	}
	
	
	public function simulateCampaign ( MailJob $mailjob )
	{
		$params_str = $mailjob->getBodyParams();
		
		$params = baseObjectUtils::arrayFromString ( $params_str );
		
		return myTemplateUtils::replaceMarkupByParts ( $mailjob->getTemplatePath() , $params , self::MARKUP_PREFIX );
	}
	
	
	public static function getMarkupTags ( )
	{
		 $possible_tags = self::getUserFields();
		 
		 $markup_tags = array();
		 
		 $generic_markups = myTemplateUtils::getGenericMarkup();
		 
		 
		 foreach ( $generic_markups as $tag => $value)
		 {
		 	$markup_tags[] = "<" .self::MARKUP_PREFIX. $tag . ">" ;
		 }
		 
		 foreach ( $possible_tags as $tag )
		 {
		 	$markup_tags[] = "<" .self::MARKUP_PREFIX. $tag . ">" ;
		 }
		 
		 return $markup_tags;
	}
}
