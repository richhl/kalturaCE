<?php
require_once ( "kalturaCmsAction.class.php" );

class dashboardAction extends kalturaCmsAction
{

	public function executeImpl($partner_id)
	{
		$id = $this->getContext()->getUser()->getAttribute('adminkuser_id');
		
		
		//TODO: if this is the first time the user visits this page
		// i ask him to fill missing records to complete full registration (like partner_name, alias, etc)
		$c = new Criteria(); 
		$c->add(adminKuserPeer::ID, $id ); 
		$user = adminKuserPeer::doSelectOne($c);
		if (!$user) {
			throw new Exception("CMS: invalid user id in select"); 
		}
		
		$this->secureMe = new AdminSecurity($user);
		
		$this->screenName = $user->getScreenname();
		$this->fullName = $user->getFullname();
		
		$c = new Criteria(); 
		$c->add(PartnerPeer::ID, $user->getPartnerId() ); 
		$partner = PartnerPeer::doSelectOne($c);
		
		$this->selectedApp = "";
		$this->partnerApp = array(
			($partner->getId()*100) => "Default app"
		);

		//TODO: decide which option to show by partner_id
	
		//TODO: check if there is an extra option here, and display that extra option automatilcaly
		// such as "start building my app" from the signup page
		
		return sfView::SUCCESS;
	}

}