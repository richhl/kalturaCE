<?php
/**
 * @package plugins.annotation
 * @subpackage api.filters
 */
class KalturaAnnotationFilter extends KalturaAnnotationBaseFilter
{
	
	/**
	 * @param AnnotationFilter $annotationFilter
	 * @param array $propsToSkip
	 * @return AnnotationFilter
	 */
	public function toObject($annotationFilter = null, $propsToSkip = array())
	{
		if(!$annotationFilter)
			$annotationFilter = new AnnotationFilter();
			
		if(isset($this->userIdEqual)){
			$dbKuser = kuserPeer::getKuserByPartnerAndUid(kCurrentContext::$ks_partner_id, $this->userIdEqual);
			$this->userIdEqual = $dbKuser->getId();
		}
			
		
		if(isset($this->userIdIn)){
			$userIds = explode(",", $this->userIdIn);
			foreach ($userIds as $userId){
				$dbKuser = kuserPeer::getKuserByPartnerAndUid(kCurrentContext::$ks_partner_id, $userId);
				$kuserIds = $dbKuser->getId().",";
			}
			
			$this->userIdIn = $kuserIds;
		}
		
		return parent::toObject($annotationFilter, $propsToSkip);
	}
}