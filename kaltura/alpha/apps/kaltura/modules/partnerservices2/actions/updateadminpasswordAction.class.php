<?php
require_once ( "defPartnerservices2Action.class.php");
require_once ( "myPartnerUtils.class.php");

class updateadminpasswordAction extends defPartnerservices2Action
{
	public function describe()
	{
		return
			array (
				"display_name" => "updateAdminPassword",
				"desc" => "" ,
				"in" => array (
					"mandatory" => array (
						"adminKuser_email" => array ("type" => "string", "desc" => "") ,
						"adminKuser_password" => array ("type" => "string", "desc" => "") ,
						"new_password" => array ("type" => "string", "desc" => "") ,
						),
					"optional" => array (
						"new_email" => array ("type" => "string", "desc" => "") ,			
						)
					),
				"out" => array (
					"new_password" => array ( "type" => "string" , "desc" => "" ),
					),
				"errors" => array (
					APIErrors::INVALID_FIELD_VALUE,
					APIErrors::ADMIN_KUSER_NOT_FOUND,
					)
			);
	}

    
	public function executeImpl ( $partner_id , $subp_id , $puser_id , $partner_prefix , $puser_kuser )
	{
		$email = trim ( $this->getPM ( "adminKuser_email" ) );
		$new_email = trim ( $this->getP ( "new_email" ) );
		$old_password = trim (  $this->getPM ( "adminKuser_password" , null ) );
		$password = trim (  $this->getPM ( "new_password" , null ) );
		
		if ( $new_email )
		{
			if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $new_email))
			{
				$f_name = "new_email";
				$this->addException( APIErrors::INVALID_FIELD_VALUE, $f_name );
			}
		}

		$akp = new adminKuserPeer(); // TODO - why not static ?
		list( $new_password , $new_email ) = $akp->resetUserPassword ( $email , $password , $old_password , $new_email );

		if ( ! $new_password )
		{
			$this->addException( APIErrors::ADMIN_KUSER_WRONG_OLD_PASSWORD );
			//$this->addException( APIErrors::ADMIN_KUSER_NOT_FOUND );
		}
		if ( $new_email )
		{
			$this->addMsg ( "new_email" , $new_email ) ;
		}
		$this->addMsg ( "new_password" , $new_password ) ;
	}
}
?>