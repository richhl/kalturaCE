<?php 
class KalturaServicesMap
{
	static function getMap()
	{
		return array(
			"media" => KALTURA_ROOT_PATH . "/services/MediaService.php",
			"mixing" => KALTURA_ROOT_PATH . "/services/MixingService.php",
			"baseentry" => KALTURA_ROOT_PATH . "/services/BaseEntryService.php",
			"session" => KALTURA_ROOT_PATH . "/services/SessionService.php",
			"uiconf" => KALTURA_ROOT_PATH . "/services/UiConfService.php",
			"playlist" => KALTURA_ROOT_PATH . "/services/PlaylistService.php",
			"user" => KALTURA_ROOT_PATH . "/services/UserService.php",
			"widget" => KALTURA_ROOT_PATH . "/services/WidgetService.php",
			"search" => KALTURA_ROOT_PATH . "/services/SearchService.php",
			"partner" => KALTURA_ROOT_PATH . "/services/PartnerService.php",
			"adminuser" => KALTURA_ROOT_PATH . "/services/AdminUserService.php",
			"system" => KALTURA_ROOT_PATH . "/services/SystemService.php",
			"notification" => KALTURA_ROOT_PATH . "/services/NotificationService.php",			
		);
	}
}