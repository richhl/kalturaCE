<?php
public class ManagerBase
{
	protected $ks;
	
	public function ManagerBase(KalturaSession $ks)
	{
		if ($ks === null)
			throw new Exception("Can't initialize manager with null session");
			
		$this->ks = $ks;	
	}
}