<?php

require_once ( "kalturaCmsAction.class.php" );

class contentModerationAllowAction extends kalturaCmsAction
{
	public function executeImpl($partner_id) {
		$moderation_id = $this->getRequestParameter("moderationId");
		if (!$moderation_id || !ctype_digit($moderation_id))
			return $this->renderText("ERROR");

		$moderation = moderationPeer::retrieveByPK($moderation_id);
		if (!$moderation)
			return $this->renderText("ERROR");
		
		$moderation->updateStatus(moderation::MODERATION_STATUS_APPROVED);
				
		return $this->renderText("SUCCESS");
	}
}
?>