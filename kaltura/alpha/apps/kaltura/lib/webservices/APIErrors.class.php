<?php
	class APIErrors 
	{
		//  %s - some text to display in the message
		const INTERNAL_SERVERL_ERROR = "INTERNAL_SERVERL_ERROR,Internal server error %s";
		
		const SERVERL_ERROR = "SERVERL_ERROR,Server error %s";
		
		const MISSING_KS ="MISSING_KS,Missing KS. Session not established";
		// %s - the ks string, %s - error code , %s - error description
		const INVALID_KS ="INVALID_KS,Invalid KS [%s]. Error [%s,%s]";

		// %s - partner_id
		const START_SESSION_ERROR = "START_SESSION_ERROR,Error while starting session for partner [%s]"; 
		
		// $s - media source
		const UNKNOWN_MEDIA_SOURCE = "UNKNOWN_MEDIA_SOURCE,Unknown media source [%s]";
		
		const NO_ENTRIES_ADDED = "NO_ENTRIES_ADDED,Added 0 entries";
		
		const KSHOW_DOES_NOT_EXISTS = "KSHOW_DOES_NOT_EXISTS,Kshow doesn't exist";
		
		const MODERATION_OBJECT_NOT_EXISTS = "MODERATION_OBJECT_NOT_EXISTS,Object to moderate [%s] does not exist in system";
		
		const MODERATION_ONLY_ENTRY = "MODERATION_ONLY_ENTRY,For now can moderate only objects of type [entry] and not [%s]";
		
		const MODERATION_EMPTY_OBJECT = "MODERATION_EMPTY_OBJECT,Please fill the moderation object";
		
		// %s - puser_id 
		const INVALID_USER_ID = "INVALID_USER_ID,Unknown user [%s]";
		
		// %s - name
		const DUPLICATE_USER_BY_SCREEN_NAME= "DUPLICATE_USER_BY_SCREEN_NAME,User with screenName [%s] already exists in system";
		
		const DUPLICATE_USER_BY_ID= "DUPLICATE_USER_BY_ID,User with id [%s] already exists in system";
		
		// %s - param_name
		const MANDATORY_PARAMETER_MISSING = "MANDATORY_PARAMETER_MISSING,Mandatory paramter missing [%s]";
		
		// %s - notification_id
		const INVALID_NOTIFICATION_ID = "INVALID_NOTIFICATION_ID,Unknown notification [%s]";
		
		// ----
		const NO_NOTIFICATIONS_UPDATED = "NO_NOTIFICATIONS_UPDATED,No notifications updated.";
		
		// %s - kshow_id
		const INVALID_KSHOW_ID = "INVALID_KSHOW_ID,Unknown kshow [%s]" ;
		
		// %s - kshow name
		const DUPLICATE_KSHOW_BY_NAME = "DUPLICATE_KSHOW_BY_NAME,Kshow with name [%s] already exists in system " ;
		
		// %s - kshow_id , %s - $desired_version
		const ERROR_KSHOW_ROLLBACK = "ERROR_KSOHW_ROLLBACK,Error while rollbacking kshow [%s] to version [%s]";
		
		// %s - type
		const INVALID_ENTRY_TYPE = "INVALID_ENTRY_TYPE,source entry must be of type [%s]";
		
		// %s - the type (string) of the entry dvdProject / bubbles , ...
		// % entry_id
		const INVALID_ENTRY_ID = "INVALID_ENTRY_ID,Unknown %s [%s]" ;
		
		const INVALID_ENTRY_IDS = "INVALID_ENTRY_IDS,Unknown entry ids [%s]" ;
		
		const INVALID_ENTRY = "INVALID_ENTRY,Unknown %s [%s]" ;
		
		const INVALID_ENTRY_VERSION = "INVALID_ENTRY_VERSION,Unknown %s [%s] [%s]" ;
		
		const INVALID_KSHOW_AND_ENTRY_PAIR = "INVALID_KSHOW_AND_ENTRY_PAIR,Unknown Kshow [%s] and Entry [%s]" ;
		
		const NO_FIELDS_SET_FOR_GENERIC_ENTRY = "NO_FIELDS_SET_FOR_GENERIC_ENTRY,Missing fiedls when adding entry of type %s " ;
		
		const NO_FIELDS_SET_FOR_USER = "NO_FIELDS_SET_FOR_USER,Missing fiedls when adding user" ;
		
		const NO_FIELDS_SET_FOR_WIDGET = "NO_FIELDS_SET_FOR_WIDGET,Missing fiedls when adding widget" ;
		
		// %s - kshow_id
		const KSHOW_CLONE_FAILED = "KSHOW_CLONE_FAILED,clone failed for kshow [%s]";
		
		// %s - entry_id_to_delete , %s - kshow_id
		const CANNOT_DELETE_ENTRY = "CANNOT_DELETE_ENTRY,Entry [%s] does not belong to kshow_id [%s] and will not be deleted";
		
		// %s - file name
		const INVALID_FILE_NAME = "INVALID_FILE_NAME,Cannot find file %s";
		
		const ADMIN_KUSER_NOT_FOUND = "ADMIN_KUSER_NOT_FOUND,The data you entered is invalid";
		
		// %s - ui_conf_id
		const INVALID_UI_CONF_ID = "INVALID_UI_CONF_ID,Unknown uiConf [%s]";
		
		// %s - ui_conf_id
		const UI_CONF_CLONE_FAILED = "UI_CONF_CLONE_FAILED,clone failed for ui_conf [%s]";

		// %s - ui_conf_id
		const ERROR_SETTING_FILE_PATH_FOR_UI_CONF = "ERROR_SETTING_FILE_PATH_FOR_UI_CONF,Error while setting path [%s] for ui_conf.";
		
		// %s - widget_id
		const INVALID_WIDGET_ID = "INVALID_WIDGET_ID,Unknown widget [%s]";
		
		const INVALID_UI_CONF_ID_FOR_WIDGET = "INVALID_UI_CONF_ID_FOR_WIDGET,Unknown uiConf [%s] for widget [%s]";
		
		// %s - rank
		const INVALID_RANK = "INVALID_RANK,Bad rank [%s]";
		
		// %s - user_id , %s - kshow_id
		const USER_ALREADY_RANKED_KSHOW = "USER_ALREADY_RANKED_KSHOW,User [%s] alreay voted for kshow [%s]";
		
		const USER_ALREADY_EXISTS_BY_SCREEN_NAME = "USER_ALREADY_EXISTS_BY_SCREEN_NAME,User with screenName [%s] already exists in system.";
		
		const NO_FIELDS_SET_FOR_PARTNER = "NO_FIELDS_SET_FOR_PARTNER,Missing fiedls when adding partner" ;
		
		// %s - a more specific error from myPartnerRegistration - TODO - make the module use more specific error codes
		const PARTNER_REGISTRATION_ERROR = "PARTNER_REGISTRATION_ERROR,Error while registering partner: %s";
		
		// $s - media_type
		const SEARCH_UNSUPPORTED_MEDIA_TYPE = "SEARCH_UNSUPPORTED_MEDIA_TYPE,Unsupported media type [%s]";

		// $s - media_source
		const SEARCH_UNSUPPORTED_MEDIA_SOURCE = "SEARCH_UNSUPPORTED_MEDIA_SOURCE,Unsupported media source [%s]";
		
		// %s - url
		const SEARCH_UNSUPPORTED_MEDIA_SOURCE_FOR_URL = "SEARCH_UNKNOWN_MEDIA_SOURCE_FOR_URL,Unknown media source for url [%s]";
		
		const START_WIDGET_SESSION_ERROR = "START_WIDGET_SESSION_ERROR,error while starting session for widget id [%s]";
		
		// %s - partner_id
		const UNKNOWN_PARTNER_ID = "UNKNOWN_PARTNER_ID,Unknown partner_id [%s]";
		
		//
		const CANNOT_IMPORT_ONE_OR_MORE_MEDIA_FILES = "CANNOT_IMPORT_ONE_OR_MORE_MEDIA_FILES,One or more media files cannot be imported";
		
		//
		const ADULT_CONTENT = "ADULT_CONTENT,Adult content, age verification required, Please choose another movie";
		
		const SANDBOX_ALERT = "SANDBOX_ALERT,Sandbox demo can not be updated";
		
		const ROUGHCUT_NOT_FOUND = "ROUGHCUT_NOT_FOUND,Roughcut not found";
		
		const SERVICE_FORBIDDEN = "SERVICE_FORBIDDEN,The acces to this service is forbidden";
		
		const SERVICE_FORBIDDEN_PARTNER_DELETED = "SERVICE_FORBIDDEN_PARTNER_DELETED,The access to this service is forbidden since the specified partner is deleted";
		
		const PARTNER_ACCESS_FORBIDDEN = "PARTNER_ACCESS_FORBIDDEN,Partner [%s] cannot access partner [%s]";
		
		const ACCESS_FORBIDDEN_FROM_UNKNOWN_IP = "ACCESS_FORBIDDEN_FROM_UNKNOWN_IP,Access forbidden from unknown ip [%s]";
		
		const INVALID_BATCHJOB_ID = "INVALID_BATCHJOB_ID [%s]" ;
		
		const NO_FIELDS_SET_FOR_CONVERSION_PROFILE = "NO_FIELDS_SET_FOR_CONVERSION_PROFILE,Missing fiedls when adding ConversionProfile" ;
		
		const INVALID_FILE_EXTENSION = "INVALID_FILE_EXTENSION,Invalid file extension";
		
		const NO_FILES_RECEIVED = "NO_FILES_RECEIVED,No files recieved";
		
		const INVALID_FILE_FIELD = "INVALID_FILE_FIELD,The file was send on invalid field, expecting [%s]";
		
		const NO_FIELDS_SET_FOR_UI_CONF = "NO_FIELDS_SET_FOR_UI_CONF,Missing fiedls when adding uiconf" ;
		
		const INVALID_PLAYLIST_TYPE = "INVALID_PLAYLIST_TYPE,Invalid playlist type";
		
		// %s - source file to be converted and downloaded
		const DOWNLOAD_ERROR = "DOWNLOAD_ERROR,Cannot find source file [%s] in archive";

		// %s - type requested for transcoding
		const INVALID_TRANSCODE_TYPE = "INVALID_TRANSCODE_TYPE,Invalid transcode type [%s]";
		
		const INVALID_TRANSCODE_DATA = "INVALID_TRANSCODE_DATA,Invalid transcode data [%s]";
		
		// %s - field name
		const INVALID_FIELD_VALUE = "INVALID_FIELD_VALUE,value in field [%s] is not valid";
		
		const ADMIN_KUSER_WRONG_OLD_PASSWORD = "ADMIN_KUSER_WRONG_OLD_PASSWORD,old password is wrong";

		const INVALID_PARTNER_PACKAGE = "INVALID_PARTNER_PACKAGE,Invalid package id";
		
		const CANNOT_DOWNGRADE_PACKAGE = "CANNOT_DOWNGRADE_PACKAGE,Downgrading package is impossible";

		const CANNOT_USE_ENTRY_TYPE_AUTO_IN_IMPORT = "CANNOT_USE_ENTRY_TYPE_AUTO_IN_IMPORT,entry_type -1 (Auto) can be used only when source is file (1)";
	}
?>