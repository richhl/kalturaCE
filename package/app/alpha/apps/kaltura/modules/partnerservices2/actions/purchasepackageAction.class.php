<?php
require_once ( "defPartnerservices2Action.class.php");
require_once ( "myPartnerUtils.class.php");

class purchasepackageAction extends defPartnerservices2Action
{
	public function describe()
	{
		return
			array (
				"display_name" => "purchasePackage",
				"desc" => "pay for package" ,
				"in" => array (
					"mandatory" => array (
						"package_id" 			=> array ("type" => "integer", "desc" => ""),
						"customer_cc_type"		=> array ("type" => "string", "desc" => ""),
						"customer_cc_number"	=> array ("type" => "string", "desc" => ""),
						"cc_expiration_month"	=> array ("type" => "integer", "desc" => ""),
						"cc_expiration_year"	=> array ("type" => "integer", "desc" => ""),
						"cc_cvv2_number"		=> array ("type" => "integer", "desc" => ""),
						"customer_address1"		=> array ("type" => "string", "desc" => ""),
						"customer_city"			=> array ("type" => "string", "desc" => ""),
						"customer_state"		=> array ("type" => "string", "desc" => ""),
						"customer_zip"			=> array ("type" => "string", "desc" => ""),
						"customer_country"		=> array ("type" => "string", "desc" => ""),
						"customer_first_name"	=> array ("type" => "string", "desc" => ""),
						"customer_last_name"	=> array ("type" => "string", "desc" => ""),
						),
					"optional" => array (
						"customer_address2"		=> array ("type" => "string", "desc" => ""),
						)
					),
				"out" => array (
					//"partner" => array ("type" => "Partner", "desc" => ""),
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
		
		$package_id = $this->getPM( "package_id" );
		$packages = new PartnerPackages();
		$package = $packages->getPackageDetails($package_id);
		if (!$package || $package_id == 1)
		{
			$this->addException( APIErrors::INVALID_PARTNER_PACKAGE );
		}
		$partner_package = $packages->getPackageDetails($partner->getPartnerPackage());
		
		/* set paymet variables with service input */

		
		// Set request-specific fields.
		$paymentType = urlencode('Sale');				// or 'Sale'
		$firstName = urlencode($this->getPM( "customer_first_name" ));
		$lastName = urlencode($this->getPM( "customer_last_name" ));
		$creditCardType = urlencode($this->getPM( "customer_cc_type" ));
		$creditCardNumber = urlencode($this->getPM( "customer_cc_number" ));
		$expDateMonth = $this->getPM( "cc_expiration_month" );
		// Month must be padded with leading zero
		$padDateMonth = urlencode(str_pad($expDateMonth, 2, '0', STR_PAD_LEFT));
		
		$expDateYear = urlencode($this->getPM( "cc_expiration_year" ));
		$cvv2Number = urlencode($this->getPM( "cc_cvv2_number" ));
		$address1 = urlencode($this->getPM( "customer_address1" ));
		$address2 = urlencode($this->getP( "customer_address2" ));
		$city = urlencode($this->getPM( "customer_city" ));
		$state = urlencode($this->getPM( "customer_state" ));
		$zip = urlencode($this->getPM( "customer_zip" ));
		$country = urlencode($this->getPM( "customer_country" ));				// US or other valid country code
		$amount = urlencode($package['cycle_fee']);
		$currencyID = urlencode('USD');							// or other currency ('GBP', 'EUR', 'JPY', 'CAD', 'AUD')
		
		// TODO: deal different types of transactions here.
		// upgrade - DDP SALE
		// downgrade - DDP AUTH
		// ETC...		
		
		// Add request-specific fields to the request string.
		$nvpStr =	"&PAYMENTACTION=$paymentType&AMT=$amount&CREDITCARDTYPE=$creditCardType&ACCT=$creditCardNumber".
					"&EXPDATE=$padDateMonth$expDateYear&CVV2=$cvv2Number&FIRSTNAME=$firstName&LASTNAME=$lastName".
					"&STREET=$address1&CITY=$city&STATE=$state&ZIP=$zip&COUNTRYCODE=$country&CURRENCYCODE=$currencyID";
		
		// Execute the API operation; see the PPHttpPost function above.
		$httpParsedResponseAr = $this->PPHttpPost('DoDirectPayment', $nvpStr);
		foreach($httpParsedResponseAr as $key => $val)
		{
			$httpParsedResponseAr[$key] = urldecode($httpParsedResponseAr[$key]);
		}		
		if("Success" == $httpParsedResponseAr["ACK"]) {
			$this->addMsg( "payment", array("ACK" => $httpParsedResponseAr["ACK"] ) );
			/* update partner package, reset partner usage ? */

			$partner->setPartnerPackage($package_id);
			$partner->save();
			
			$mailType = null;
			$bodyParam = array();
			if ($partner->getStatus() == 2) {
		  		$mailType = PartnerPackages::KALTURA_PACKAGE_UPGRADE;
			 	$bodyParam = array( $partner->getAdminName(), $package['name'], $package['cycle_bw'] , $package['cycle_fee'] );
			}
			else
			{
		  		$mailType = PartnerPackages::KALTURA_LOCKED_PACKAGE_UPGRADE;
  			 	$bodyParam = array( $partner->getAdminName(), $package['name'], $package['cycle_bw'] , $package['cycle_fee'] );
			}
			
			kJobsManager::addMailJob(
				null, 
				0, 
				$partner_id, 
				$mailType, 
				kMailJobData::MAIL_PRIORITY_NORMAL, 
				kConf::get( "purchase_package_email" ), 
				kConf::get( "purchase_package_name" ), 
				$partner->getAdminEmail(), 
				$bodyParam);
			
			
			// Update partner usage
			myPartnerUtils::doPartnerUsage($partner);
			
			// TODO: save transaction to DB.
			$transaction = new PartnerTransactions();
			$transaction->setPartnerId($partner->getId());
			$transaction->setPackageId($package_id);
			$transaction->setType(PartnerTransactions::TRANSACTION_TYPE_DDP_SALE);
			// TODO: deal different types of transactions here.
			$transaction->setAmount($httpParsedResponseAr['AMT']);
			$transaction->setCurrency($httpParsedResponseAr['CURRENCYCODE']);
			$transaction->setTransactionId($httpParsedResponseAr['TRANSACTIONID']);
			$transaction->setTimestamp($httpParsedResponseAr['TIMESTAMP']);
			$transaction->setCorrelationId($httpParsedResponseAr['CORRELATIONID']);
			$transaction->setAck($httpParsedResponseAr['ACK']);
			$transaction->setTransactionData(serialize($httpParsedResponseAr));
			$transaction->save();
		} else  {

			$this->addMsg( "payment_failed" , $httpParsedResponseAr);
		}		
		
	}

	/**
	 * Send HTTP POST Request
	 *
	 * @param	string	The API method name
	 * @param	string	The POST Message fields in &name=value pair format
	 * @return	array	Parsed HTTP Response body
	 */
	public function PPHttpPost($methodName_, $nvpStr_) {
	
		// get the paypal data from the configuration
		$paypal_data = kConf::get ( "paypal_data");
		
		// Set up your API credentials, PayPal end point, and API version.
		$API_UserName = urlencode($paypal_data["api_username"]);
		$API_Password = urlencode($paypal_data["api_password"]);
		$API_Signature = urlencode($paypal_data["api_signature"]);
		$API_Endpoint = "https://api-3t.paypal.com/nvp";
		$env = $paypal_data["environment"];
		if("sandbox" === $env || "beta-sandbox" === $env ) {
			$API_Endpoint = "https://api-3t.{$env}.paypal.com/nvp";
		}
		$version = urlencode('51.0');
	
		// Set the curl parameters.
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $API_Endpoint);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
	
		// Turn off the server and peer verification (TrustManager Concept).
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
	
		// Set the API operation, version, and API signature in the request.
		$nvpreq = "METHOD=$methodName_&VERSION=$version&PWD=$API_Password&USER=$API_UserName&SIGNATURE=$API_Signature$nvpStr_";
	
		// Set the request as a POST FIELD for curl.
		curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);
	
		// Get response from the server.
		$httpResponse = curl_exec($ch);
	
		if(!$httpResponse) {
			exit("$methodName_ failed: ".curl_error($ch).'('.curl_errno($ch).')');
		}
	
		// Extract the response details.
		$httpResponseAr = explode("&", $httpResponse);
	
		$httpParsedResponseAr = array();
		foreach ($httpResponseAr as $i => $value) {
			$tmpAr = explode("=", $value);
			if(sizeof($tmpAr) > 1) {
				$httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];
			}
		}
	
		if((0 == sizeof($httpParsedResponseAr)) || !array_key_exists('ACK', $httpParsedResponseAr)) {
			exit("Invalid HTTP Response for POST request($nvpreq) to $API_Endpoint.");
		}
	
		return $httpParsedResponseAr;
	}
}
?>