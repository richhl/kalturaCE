<?php
class sessionRestriction extends baseRestriction
{
	/**
	 * The privelege needed to remove the restriction
	 * 
	 * @var string
	 */
	protected $privilegeName = ks::PRIVILEGE_VIEW;
	
	/**
	 * @param string $privilegeType
	 */
	public function setPrivilegeName($privilegeType)
	{
		$this->privilegeName = $privilegeType;
	}
	
	/**
	 * @return string
	 */
	function getPrivilegeName()
	{
		return $this->privilegeName;
	}
	
	/**
	 * @return bool
	 */
	function isValid()
	{
		$accessControlScope = $this->getAccessControlScope();
		if (!$accessControlScope->getKs() || (!$accessControlScope->getKs() instanceof ks))
			return false;
		
		if ($accessControlScope->getKs()->isAdmin())
			return true;
		else
			return $accessControlScope->getKs()->verifyPrivileges($this->privilegeName, $accessControlScope->getEntryId());
	}
}