<?php
public class KalturaSession()
{
	/* Private Fields */

	private $ksString;
	private $partnersAccess;
	private $usersAccess;
	
	public function KalturaSession($ksString)
	{
		$this->ksString = $ksString;
	}
	
	public function getUserId()
	{
		return $this->userId;
	}
	
	public function canAccessPartner($partnerId)
	{
		return true;
	}
	
	public function canAccessUser($userId)
	{
		return true;
	}
	
	public function hasPrivileges($privilegeName, $privilegeValue = null)
	{
			
	}
}