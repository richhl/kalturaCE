<?php
require_once ( "defPartnerservices2Action.class.php");
require_once ( "myPartnerUtils.class.php");

class getpartnerusageAction extends defPartnerservices2Action
{
	public function describe()
	{
		return
			array (
				"display_name" => "getPartnerUsage",
				"desc" => "Get the usage data of a partner by partner_id." ,
				"in" => array (
					"mandatory" => array (
						"partner_id" 		=> array ("type" => "integer", "desc" => ""),
						"year"				=> array ("type" => "string", "desc" => ""),
						),
					"optional" => array (
						"month"				=> array ("type" => "string", "desc" => ""),
						"resolution"		=> array ("type" => "string", "desc" => "usage graph resolution (days,month)"),
						)
					),
				"out" => array (
					"partner" => array ("type" => "Partner", "desc" => ""),
					),
				"errors" => array (
				 	APIErrors::UNKNOWN_PARTNER_ID,
				 	
				)
			);
	}

		
	public function executeImpl ( $partner_id , $subp_id , $puser_id , $partner_prefix , $puser_kuser )
	{
		// make sure the secret fits the one in the partner's table
		$partner = PartnerPeer::retrieveByPK( $partner_id );
		
		if ( ! $partner )
		{
			// CANNOT be because we are already in the service. it would hae fallen before...
			$this->addException( APIErrors::UNKNOWN_PARTNER_ID );
		}
		
		if ($partner->getUsagePercent() == 0) {
			$debug_data = "usage percent 0, validated by calculating manually.";
			myPartnerUtils::doPartnerUsage($partner);
		} 
		$packages = new PartnerPackages();
		$partnerPackage = $packages->getPackageDetails($partner->getPartnerPackage());
		$return['hostingGB'] = round($partner->getStorageUsage()/1024 , 2);
		$return['Percent'] = $partner->getUsagePercent()/100;
		$return['package_bw'] = $partnerPackage['cycle_bw'];
		$return['GB'] = ($return['Percent']/100)*$return['package_bw'];
		
		$return['reached_limit_date'] = $partner->getUsageLimitWarning();			
		
		/* total usage status */

		/*  --- ended total usage status --- */
		
		/* usage graph */
		$year = $this->getPM("year");
		$month = $this->getP("month");
		$resolution = $this->getP("resolution");
		$graph_points = myPartnerUtils::getPartnerUsageGraph($year, $month, $partner, $resolution);
		/* --- ended usage graph --- */ 
		

		$this->addMsg ( "usage" , $return ) ;
		if (isset($debug_data))
		{
			$this->addDebug('debug_data', $debug_data);
		}
		$this->addMsg ( "graph", $graph_points );
/*
 * ADD ATTRIBUTES TO GRAPH
 
<graph caption=""
bgcolor="0xffffff" 
border="false" 
bordercolor="0xffffa7" 
customxaxis="true" 
minimumx="0"  
maximumx="10" 
intervalx="1" 
xaxisname="Time"
xtype="Category" 
dataunits="hours"
customyaxis="false" 
minimumy="0" 
maximumy="100" 
intervaly="10" 
yaxisname=""
showdatatips="true" 
mousesensitivity="50" 
datatipmode="multiple"
gridlinesdirection="both"
customgridlines="true" 
lineshadow="false"
horizontalstrokecolor="0xeeeeee" 
horizontalstrokesize=".3" 
horizontalfillcolor="0xffffff" 
horizontalfillsize=".3" 
horizontalstrokealpha="0.1"
horizontalalternatefillcolor="0xffffff" 
horizontalalternatefillsize=".3"
verticalstrokecolor="0xcccccc" 
verticalstrokesize=".5"  
verticalstrokealpha="0.5"
verticalfillcolor="0xffffff" 
verticalfillsize=".3" 
verticalalternatefillcolor="0xffffff"
verticalalternatefillsize=".3">
 
 * 
 */		
	}
	

}
?>