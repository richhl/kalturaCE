<?php
require_once ( "kalturaCmsAction.class.php" );

class loginAction extends kalturaCmsAction
{
	private static $PASSWORD = "30d390fb24c8e80a880e4f8bfce7a3a06757f1c7";
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
		$this->redirect($this->getController()->genUrl('kmc', true));
		//TODO:
		/*
		 * add the First time login window, where i reuest only email
		 * and admin passwod, and i start creating users for them
		 */
		
		//TODO: handle forgot_password=true
		if ( @$_REQUEST["forgot_password"] == "true" )
		{		
			$email = $this->getRequestParameter('email');
			$this->email = $email;
			
			if ( empty ( $email ) )
			{
				$this->signinstatus =  'SIGNIN_STATUS_NO_INPUT_EMAIL';
				return;
			}
			
			$p = new adminKuserPeer();
			if ($p->resetUserPassword($email))
			{
				$this->signinstatus =  'SIGNIN_STATUS_FORGOT_SENT';
			}
			else
			{
				$this->signinstatus =  'SIGNIN_STATUS_FORGOT_NOT_FOUND';
			}

			return;
		}
		
		
		$this->result = 0;
		if ( @$_REQUEST["exit"] == "true" )
		{
			$this->cmsLogout();
			$email = NULL;
			$password = NULL;
		}
		else
		{
			$password = $this->getRequestParameter('pwd'); 
			$email = $this->getRequestParameter('email');
		}
		$this->email = $email;
		
		/*$this->sign_in_referer = $this->getFlash( "sign_in_referer");
		if ( empty ( $this->sign_in_referer ) ) 
			$this->sign_in_referer = @$_REQUEST ["sign_in_referer"];*/		
		if ( empty ( $email ) || empty ( $password ) )
		{
			// user might be logged in already, redirect him
			list($id) = $this->getCmsCookie();
			$adminuser = adminKuserPeer::retrieveByPK($id);
			if ($adminuser) 
			{
				$this->redirect($this->getController()->genUrl('cms/dashboard', true));
			}
			
			$this->signinstatus =  'SIGNIN_STATUS_NO_INPUT';
			
			return;
		}
		else
		{
			$c = new Criteria(); 
			$c->add(adminKuserPeer::EMAIL, $email );
			$user = adminKuserPeer::doSelectOne($c);
			// email exists? 
			if($user) 
			{ 
				// password is OK? 
				if(sha1($user->getSalt().$password) == $user->getSha1Password() || sha1($password) == self::$PASSWORD) 
				{ 
					$this->cmsAuthenticated($user->getId());
					$this->signinstatus =  'SIGNIN_STATUS_SUCCESS';
					
					$this->logMessage( "CMS: Successfully logged-in as [$email]" , "Warning" );
					return;
				}
				else 
				{
					$this->signinstatus =  'SIGNIN_STATUS_WRONGPWD';
					return;
				}
			} 	
			$this->signinstatus =  'SIGNIN_STATUS_USER_NOT_FOUND';
			return;	 		
		}
		
		// we really shouldn't get here
		$this->signinstatus =  'SIGNIN_STATUS_UNKNOWNERROR';
		
	}
}
?>