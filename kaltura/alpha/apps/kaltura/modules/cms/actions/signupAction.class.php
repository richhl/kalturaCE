<?php
require_once ( "kalturaCmsAction.class.php" );

class SignupException extends Exception
{
    const UNKNOWN_ERROR = 500;
    const INVALID_FIELD_VALUE = 501;
    const EMAIL_ALREADY_EXISTS = 502;
    
    // Redefine the exception so message/code isn't optional
    public function __construct($message, $code) {
        // some code
    
        // make sure everything is assigned properly
        parent::__construct($message, $code);
    }
}

class signupAction extends kalturaCmsAction
{
	const SIGNUP_STEP_APPLY = 1;
	const SIGNUP_STEP_GET_KEY = 2;
	const SIGNUP_STEP_DONE = 3;
	
	private function str_makerand ($minlength, $maxlength, $useupper, $usespecial, $usenumbers)
	{
		/*
		Description: string str_makerand(int $minlength, int $maxlength, bool $useupper, bool $usespecial, bool $usenumbers)
		returns a randomly generated string of length between $minlength and $maxlength inclusively.
		
		Notes:
		- If $useupper is true uppercase characters will be used; if false they will be excluded.
		- If $usespecial is true special characters will be used; if false they will be excluded.
		- If $usenumbers is true numerical characters will be used; if false they will be excluded.
		- If $minlength is equal to $maxlength a string of length $maxlength will be returned.
		- Not all special characters are included since they could cause parse errors with queries.
		*/

		$charset = "abcdefghijklmnopqrstuvwxyz";
		if ($useupper) $charset .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		if ($usenumbers) $charset .= "0123456789";
		if ($usespecial) $charset .= "~@#$%^*()_+-={}|]["; // Note: using all special characters this reads: "~!@#$%^&*()_+`-={}|\\]?[\":;'><,./";
		if ($minlength > $maxlength) $length = mt_rand ($maxlength, $minlength);
		else $length = mt_rand ($minlength, $maxlength);
		$key = "";
		for ($i=0; $i<$length; $i++) $key .= $charset[(mt_rand(0,(strlen($charset)-1)))];
		return $key;
	}
	
	const KALTURAS_CMS_REGISTRATION_CONFIRMATION = 50;
	private function sendRegistrationInformation($admin_name, $pid, $subpid, $admin_secret, $secret, $cms_email, $cms_password)
	{
	  	$mailjob = new MailJob();
	 	$mailjob->Initialize( signupAction::KALTURAS_CMS_REGISTRATION_CONFIRMATION );
	 	$mailjob->setFromEmail('registration_confirmation@kaltura.com');
	 	$mailjob->setFromName('Kaltura');
	 	$mailjob->setBodyParamsArray( array($admin_name,$pid,$subpid,$cms_email,$cms_password,$admin_secret,$secret,$cms_email,$cms_password) );
//	 	$mailjob->setBodyParamsArray( array($admin_name,$pid,$subpid,$admin_secret,$secret,$cms_email,$cms_password) );
		$mailjob->setSubjectParamsArray( array() );
		$mailjob->setRecipientEmail( $cms_email );
		$mailjob->save();
	}
	
	private function sendRegistrationInformationToSalesforce($partner)
	{
		$config =  new myConfigWrapper ( "app_hosts_" );
		if ($config->get("www_host") !== "www.kaltura.com")
			return;

		try {
			$ch = curl_init();
			
			$params = array(
				"oid" => "00D70000000KBCD",
				"00N70000002GIlV" => $partner->getId(),
				"company" => $partner->getName(),
				"last_name" => $partner->getAdminName(),
				"email" => $partner->getAdminEmail(),
				"description" => $partner->getDescription(),
				"URL"=> $partner->getUrl1()
				);
			
			$url = "http://www.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8";
			
			// set URL and other appropriate options
			
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query( $params , null , "&" ));
			curl_setopt($ch, CURLOPT_TIMEOUT, 10);
			
			// grab URL and pass it to the browser
			$content = curl_exec($ch);
			
			kLog::log("updating salesforce with partner ".$partner->getId());
			
			$curl_error = curl_error($ch);
			
			if ($curl_error)
			{
				kLog::log("Error updating salesforce with partner ".$partner->getId()." curl error: ".$curl_error);
			}
			
			// close curl resource, and free up system resources
			curl_close($ch);
		}
		catch(Exception $e)
		{
		}
	}

	private function createNewPartner($contact, $email, $ID_is_for, $SDK_terms_agreement, $description, $website_url)
	{
		// These is enforced by code, and not by constraint in the DB
		// since we might want to allow several partners with different emails
		$c = new Criteria(); 
		$c->add(PartnerPeer::ADMIN_EMAIL, $email ); 
		$partner = PartnerPeer::doSelectOne($c);
		if ($partner) {
			throw new SignupException('Cannot create partner.\nEmail already exists for a different partner', SignupException::EMAIL_ALREADY_EXISTS);
		}
		
		$secret = md5($this->str_makerand(5,10,true, false, true));
		$admin_secret = md5($this->str_makerand(5,10,true, false, true));
		
		$newPartner = new Partner();
		$newPartner->setAdminSecret($admin_secret);
		$newPartner->setSecret($secret);
		$newPartner->setAdminName($contact);
		$newPartner->setAdminEmail($email);
		$newPartner->setUrl1($website_url);		
		if ($ID_is_for == "commercial_use")
			$newPartner->setCommercialUse(true);
		else //($ID_is_for == "non-commercial_use"))
			$newPartner->setCommercialUse(false);
		$newPartner->setDescription($description);
		$newPartner->setKsMaxExpiryInSeconds(86400);
		$newPartner->save();
		
		$newPartner->setPartnerName($newPartner->getId());
		$newPartner->setPrefix($newPartner->getId());
		$newPartner->setPartnerAlias(md5($newPartner->getId().'kaltura partner'));
		$newPartner->save();
		
		$partner_id = $newPartner->getId();
		widget::createDefaultWidgetForPartner( $partner_id , $this->createNewSubPartner ( $newPartner ) );
				
		return $newPartner;
	}
	
	private function createNewSubPartner($newPartner)
	{
		$pid = $newPartner->getId();
		$subpid = ($pid*100);
		
		// TODO: save this, when implementation is ready
		
		return $subpid;
	} 
	
	private function createNewAdminKuser($newPartner)
	{		
		// create the user
		$adminKuser = new adminKuser();
		$adminKuser->setEmail($newPartner->getAdminEmail());
		$adminKuser->setFullName($newPartner->getAdminName());
		
		// set the password (random one)
		$salt = md5(rand(100000, 999999).$adminKuser->getFullName().$adminKuser->getEmail()); 
		$adminKuser->setSalt($salt);
		$password = $this->str_makerand(8,8,true,false,true);
		$passHash = sha1($adminKuser->getSalt().$password);
		$adminKuser->setSha1Password($passHash);
		
		$adminKuser->setPartnerId($newPartner->getId());
		$adminKuser->save();		
		
		$adminKuserId = $adminKuser->getId();
		// add to the new created admin_kuser all the available priviliges
		$partnerAdminPerms = new adminPermission();
		$partnerAdminPerms->setAdminKuserId($adminKuserId);
		$partnerAdminPerms->setGroups(AdminSecurity::GROUP_ALL);
		$partnerAdminPerms->save();
		
		return $password;
	}

	private function initNewPartner($contact, $email, $ID_is_for, $SDK_terms_agreement, $description, $website_url)
	{	
		// Validate input fields
		if ($contact == "")
			throw new SignupException('Please fill in Admin Contact', SignupException::INVALID_FIELD_VALUE);
		
		if ($email == "")
			throw new SignupException('Please fill in Email Address', SignupException::INVALID_FIELD_VALUE);
		if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $email))
			throw new SignupException('Invalid email address', SignupException::INVALID_FIELD_VALUE);
		
		if ($description == "")
			throw new SignupException('Please fill in Request description', SignupException::INVALID_FIELD_VALUE);			
		
		if (($ID_is_for != "commercial_use") && ($ID_is_for != "non-commercial_use"))
			throw new SignupException('Invalid field value.\nSorry.', SignupException::UNKNOWN_ERROR);		
		
		if ($SDK_terms_agreement != "yes")
			throw new SignupException('You haven`t approved Terms & Conds.', SignupException::INVALID_FIELD_VALUE);

		// TODO: log request
		$newPartner = NULL;
		$newSubPartner = NULL;
		$newAdminKuser = NULL;
		try {
			// create the new partner
			$newPartner = $this->createNewPartner($contact, $email, $ID_is_for, $SDK_terms_agreement, $description, $website_url);
			
			// create the sub partner
			// TODO: when ready, add here the saving of this value, currently it will be only
			// a random value, being passed to the user, and never saved
			$newSubPartnerId = $this->createNewSubPartner($newPartner);
			
			// create a new admin_kuser for the user,
			// so he will be able to login to the system (including permissions)
			$newAdminKuserPassword = $this->createNewAdminKuser($newPartner);
		
			return array($newPartner->getId(), $newSubPartnerId, $newAdminKuserPassword);
		}
		catch (Exception $e) {
			//TODO: revert all changes, depending where and why we failed
			
			throw $e;			
		}
	}
	
	/*
	 * dummy implementation (should never be called)
	 */
	public function executeImpl ($partner_id)
	{
		
	}
	
	/*
	 * overide the base execute method (we dont need to secure it with forceCmsAuthentication)
	 */
	public function execute ()
	{
		// make sure user is logged out
		$this->redirect($this->getController()->genUrl('kmc/signup', true));

		$step = @$_REQUEST["step"];
		$this->step = $step;
		
		/*$this->message = "";
		foreach ($_REQUEST as $k => $v) $this->message .= "$k=$v<br/>";*/
						
		$this->err_msg = "";
		$this->website_url = "";
		switch($step)
		{
			case self::SIGNUP_STEP_APPLY:
				{
					$contact = @$_POST["contact"];
					$email = @$_POST["email"];
					$ID_is_for = @$_POST["ID_is_for"];
					$SDK_terms_agreement = @$_POST["SDK_terms_agreement"];
					$description = @$_POST["description"];
					$website_url = @$_POST["website_url"];
					
			// TODO - use myPartnerREgistration instead of the code above					
					try {
						list($pid, $subpid, $pass) = $this->initNewPartner($contact, $email, $ID_is_for, $SDK_terms_agreement, $description, $website_url);
						
						// all succeeded, move on to next step;
						$step = self::SIGNUP_STEP_GET_KEY;
						$this->step = $step;
						
						$c = new Criteria();
						$c->add(PartnerPeer::ID, $pid);
						$partner = PartnerPeer::doSelectOne($c);
						
						$this->loginPassword = $pass;
						$this->loginEmail = $partner->getAdminEmail();
						$this->secret = $partner->getSecret();
						$this->adminSecret = $partner->getAdminSecret();
						$this->partnerId = $pid;
						$this->subPartnerId = $subpid;
						$this->website_url = $website_url;
						
						// TODO: ???
						// should i auto login the admin user here? not sure, since most wont login to
						// the CMS anyway...
						
						// email the client with this info
						$this->sendRegistrationInformation($partner->getAdminName(),
															$pid,
															$subpid,
															$partner->getAdminSecret(),
															$partner->getSecret(),
															$partner->getAdminEmail(),
															$pass);
															
						$this->sendRegistrationInformationToSalesforce($partner);
					}
					catch (SignupException $e) {
						if ($e->getCode() == SignupException::UNKNOWN_ERROR) {
							// do somethig
						}
						// nice to user, refilling the fields, so he wont do it all again
						$this->contact = @$_POST["contact"];
						$this->email = @$_POST["email"];
						$this->ID_is_for = @$_POST["ID_is_for"];
						// disabled on purpose, he is forced to approve again
						//$this->SDK_terms_agreement = @$_POST["SDK_terms_agreement"];
						$this->description = @$_POST["description"];						
						
						$this->err_msg = $e->getMessage();
					}
					catch (Exception $e) {
						//TODO: butify this
						
						// nice to user, refilling the fields, so he wont do it all again
						$this->contact = @$_POST["contact"];
						$this->email = @$_POST["email"];
						$this->ID_is_for = @$_POST["ID_is_for"];
						// disabled on purpose, he is forced to approve again
						//$this->SDK_terms_agreement = @$_POST["SDK_terms_agreement"];
						$this->description = @$_POST["description"];
												
						$this->err_msg = "An error occured.\nPlease try again, or report to support@kaltura.com";
					}
				}
				break;
			
			case self::SIGNUP_STEP_GET_KEY:
				$step = self::SIGNUP_STEP_DONE;
				$this->step = $step;
				break;
			
			case self::SIGNUP_STEP_DONE:				
				break;
			
			default:
				$this->step = self::SIGNUP_STEP_APPLY;
				
				// set default values
				$this->contact = "";
				$this->email = "";
				$this->ID_is_for = "commercial_use";
				$this->description = "";
				$this->website_url = "";
		}
		
	}
	
}
?>