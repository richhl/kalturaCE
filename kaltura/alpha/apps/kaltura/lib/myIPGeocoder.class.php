<?php
@include("IP2Location.inc.php");

class myIPGeocoder
{

	function iptocountry($ip) 
	{   
		if (function_exists("IP2Location_open"))
		{
			$ip2Location = IP2Location_open(myContentStorage::getFSContentRootPath()."/geoip/IP-COUNTRY-ISP.BIN", IP2LOCATION_STANDARD);
			$record = IP2Location_get_country_short($ip2Location, $ip);
			IP2Location_close($ip2Location);
			return $record ? $record->country_short : "";
		}
		
		$country = "";
	    $numbers = preg_split( "/\./", $ip);   
	    include("ip_files/".$numbers[0].".php");
	    $code=($numbers[0] * 16777216) + ($numbers[1] * 65536) + ($numbers[2] * 256) + ($numbers[3]);   
	    foreach($ranges as $key => $value){
	        if($key<=$code){
	            if($ranges[$key][0]>=$code){$country=$ranges[$key][1];break;}
	            }
	    }
	    return $country;
	}
	
	function iptocountryAndCode($ip) 
	{   
		$country = "";
	    $numbers = preg_split( "/\./", $ip);   
	    include("ip_files/".$numbers[0].".php");
	    $code=($numbers[0] * 16777216) + ($numbers[1] * 65536) + ($numbers[2] * 256) + ($numbers[3]);   
	    foreach($ranges as $key => $value){
	        if($key<=$code){
	            if($ranges[$key][0]>=$code){$country=$ranges[$key][1];break;}
	            }
	    }
	    return array ( $country , $code );
	}	
}
?>