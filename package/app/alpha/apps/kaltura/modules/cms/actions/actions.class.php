<?php
//require_once ( "kalturaCmsActions.class.php");
//
//
////----- defenitions
//$secret = "ce58fe9e732da6bba354d92e2fcab6ad";
//$partner_id = 68;
//$subp_id = 6800;
// 
////$SERVICE_URL = "http://kaldev.kaltura.com/index.php/partnerservices2/";
////$WIDGET_HOST = "http://kaldev.kaltura.com"; 
//$SERVICE_URL = "http://127.0.0.1/index.php/partnerservices2/";
//$WIDGET_HOST = "http://127.0.0.1";
//
//// define if to log every hit to the server
//$log_kaltura_services = true;
//
//$send_raw_text = true;
//$partner_name = "Kaltura Admin";
//// this will be used as a global parameter
//$ks = null; 
//class kalturaService
//{
//	const KALTURA_SERIVCE_FORMAT_JSON  = 1;
//	const KALTURA_SERIVCE_FORMAT_XML  = 2;
//	const KALTURA_SERIVCE_FORMAT_PHP  = 3;
//	
//	private $partner_id ;
//	private $subp_id;
//	private $format;
//	private  $ks;
//
//	public static function getInstance ( $user_id )
//	{
//		global $partner_id;
//		$kaltura_services = new kalturaService( $partner_id );
//		$result = $kaltura_services->start( $user_id );
//		
//		return $kaltura_services;
//	}
//	
//	public function kalturaService ( $partner_id , $format = self::KALTURA_SERIVCE_FORMAT_PHP /*self::KALTURA_SERIVCE_FORMAT_XML */)
//	{
//		global $subp_id;
//		$this->partner_id = $partner_id;
//		$this->subp_id = $subp_id;
//		$this->format = $format;
//	}
//	
//	public function start ( $user )
//	{
//		global $secret;
//		global $ks;
//		
//		$params = array( "secret" => $secret );
//		$generic_result = $this->hit ( "startsession" , $user, $params );
//		$error = 	@$generic_result["error"];
//		$result = 	@$generic_result["result"];
//		$debug =  	@$generic_result["debug"];
//
//		$this->ks = @$result["ks"];
//		$ks = $this->ks ;
//		
//		return $params;//$generic_result;
//		/*
//		if ( $this->ks ) return true;
//		
//		throw new Exception ( $error[0] );
//		*/
//	}
//	
//	
//	public function getKs()
//	{
//		return $this->ks;
//	}
//	
//	public function hit ($method, $user , $params)
//	{
//		$start_time = microtime (true );
//		global $SERVICE_URL;
//		global $log_kaltura_services;
//		
//		// append the basic params
//		$params['partner_id'] = $this->partner_id;
//		$params['subp_id'] = $this->subp_id;
//		$params['format'] = $this->format;
//		$params['uid'] = $user;
//		if ( $this->ks ) $params['ks'] = $this->ks;  
//		
//		$ch = curl_init();
//		curl_setopt($ch, CURLOPT_URL, $SERVICE_URL . $method);
//		curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
//		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//		curl_setopt($ch, CURLOPT_USERAGENT, '');
//		curl_setopt($ch, CURLOPT_TIMEOUT, 10 );
//
//	if ( $log_kaltura_services ) kalturaLog ( "\n\n--> $method|$user|" . print_r ( $params , true ) );		
//		$result = curl_exec($ch);
//	if ( $log_kaltura_services ) kalturaLog ( "<-- " . print_r ( $result , true ) );
// 
//	
//		curl_close($ch);
//		
//		if ( $this->format == self::KALTURA_SERIVCE_FORMAT_PHP )
//		{
//			if ( $log_kaltura_services ) kalturaLog ( "-PHP-> strlen " .strlen ( $result ) );
//			$final_result = unserialize($result);
//			if ( $log_kaltura_services ) kalturaLog ( "<-PHP- count" . count ( $final_result) );
//		}
//		else
//		{
//			$final_result = $result;
//		}
//		
//		$end_time = microtime (true );
//		
//		if ( $log_kaltura_services ) kalturaLog ( "<--> $method|$user| time [" . ( $end_time - $start_time ) . "]" );
//		return $final_result;
//		
//	}
//}
//
//
//
//
///**
// * cms actions.
// *
// * @package    kaltura
// * @subpackage cms
// * @author     Your name here
// * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
// */
//class cmsActions extends kalturaCmsActions
//{ 
//  /**
//   * Executes index action
//   *
//   */
//	public function executeDefCms()
//	{
//		return;
//	}
//		
//	public function executeTermsOfUse()
//	{
//		return;
//	}
//	
//	public function executeHelpApi()
//	{
//		return;
//	}
//
//	public function executenNewApplication()
//	{
//		//check credentials for this action:
//		$this->forceCymmsAuthentication();
//
//		//curl("www.kaltura.com/index.php/adminservices/report_last30");
//		return;
//	}
//	
//	public function executeReportsLast30()
//	{
//		$this->forceCmsAuthentication();	
//		$this->setTemplate('ReportsLast30');
//		
//		$this->msg = "cool";
//		
//		return sfView::SUCCESS;
//	}
//	
//	/*
//	public function executeContentShows()
//	{
//		$this->forceCmsAuthentication();	
//		$this->setTemplate('ContentShows');
//		
//		//Get all kshows for this pid/subpid
//		global $ks;
//		$ks = new kalturaService(68);
//		$this->koko = print_r($ks->start(0));
//		
//		$this->shows = array( 
//			array(
//				"kshowid" => "1",
//				"thumbnail" => "thumbnail",
//				"title" => "title",
//				"author" => "author",
//				"updated" => "updated",
//				"entries" => "entries",
//				"duration" => "duration",
//				"views" => "views",
//				"participants" => "participants",
//				"moreInfo" => "bla bla"
//			),
//			array(
//				"kshowid" => "2",
//				"thumbnail" => "thumbnail",
//				"title" => "title",
//				"author" => "author",
//				"updated" => "updated",
//				"entries" => "entries",
//				"duration" => "duration",
//				"views" => "views",
//				"participants" => "participants",
//				"moreInfo" => "bla bla"
//			),
//			array(
//				"kshowid" => "3",
//				"thumbnail" => "thumbnail",
//				"title" => "title",
//				"author" => "author",
//				"updated" => "updated",
//				"entries" => "entries",
//				"duration" => "duration",
//				"views" => "views",
//				"participants" => "participants",
//				"moreInfo" => "bla bla"
//			),
//			array(
//				"kshowid" => "4",
//				"thumbnail" => "thumbnail",
//				"title" => "title",
//				"author" => "author",
//				"updated" => "updated",
//				"entries" => "entries",
//				"duration" => "duration",
//				"views" => "views",
//				"participants" => "participants",
//				"moreInfo" => "bla bla"
//			)
//		);
//				
//		return sfView::SUCCESS;
//	}
//*/
//
//	
//	public function executeContentShows() {
//		$this->forceCmsAuthentication();
//		sfView::SUCCESS;
//	}
//}
?>
