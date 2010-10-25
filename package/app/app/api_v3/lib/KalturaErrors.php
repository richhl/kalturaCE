<?php
class KalturaErrors extends APIErrors
{
	/**
	 * General Errors
	 *
	 */
	
	//
	const INTERNAL_SERVERL_ERROR = "INTERNAL_SERVERL_ERROR,Internal server error occured";
	
	//
	const MISSING_KS ="MISSING_KS,Missing KS, session not established";
	
	// %s - the ks string, %s - error code, %s - error description
	const INVALID_KS ="INVALID_KS,Invalid KS \"%s\", Error \"%s,%s\"";
	
	//
	const SERVICE_NOT_SPECIFIED = "SERVICE_NOT_SPECIFIED,Service name was not specified, please specify one";
	
	// %s - service name
	const SERVICE_DOES_NOT_EXISTS = "SERVICE_DOES_NOT_EXISTS,Service \"%s\" does not exists";
	
	//
	const ACTION_NOT_SPECIFIED = "ACTION_NOT_SPECIFIED,Action name was not specified, please specify one";
	
	// %s - action name, %s - service name
	const ACTION_DOES_NOT_EXISTS = "ACTION_DOES_NOT_EXISTS,Action \"%s\" does not exists for service \"%s\"";
	
	// %s - parameter name
	const MISSING_MANDATORY_PARAMETER = "MISSING_MANDATORY_PARAMETER,Missing parameter \"%s\"";
	
	// %s - invalid object type
	const INVALID_OBJECT_TYPE = "INVALID_OBJECT_TYPE,Invalid object type \"%s\"";
	
	// %s - enum value, %s - parameter name, %s - enum type
	const INVALID_ENUM_VALUE = "INVALID_ENUM_VALUE,Invalid enumeration value \"%s\" for parameter \"%s\", expecting enumeration type \"%s\"";
	
	// %s - partner id
	const INVALID_PARTNER_ID = "INVALID_PARTNER_ID,Invalid partner id \"%s\"";
	
	// %s - service , %s - action
	const INVALID_SERVICE_CONFIGURATION = "INVALID_SERVICE_CONFIGURATION,Invalid service configuration. Unknown service [%s:%s].";
	
	const PROPERTY_VALIDATION_CANNOT_BE_NULL =  "PROPERTY_VALIDATION_CANNOT_BE_NULL,The property \"%s\" cannot be NULL";
	
	const PROPERTY_VALIDATION_MIN_LENGTH = "PROPERTY_VALIDATION_MIN_LENGTH,The property \"%s\" must have a min length of %s characters";
	
	const PROPERTY_VALIDATION_MAX_LENGTH = "PROPERTY_VALIDATION_MAX_LENGTH,The property \"%s\" cannot have more than %s characters";
	
	const PROPERTY_VALIDATION_NOT_UPDATABLE = "PROPERTY_VALIDATION_NOT_UPDATABLE,The property \"%s\" cannot be updated";
	
	const PROPERTY_VALIDATION_ADMIN_PROPERTY = "PROPERTY_VALIDATION_ADMIN_PROPERTY,The property \"%s\" is updatable with admin session only";
	
	const INVALID_USER_ID = "INVALID_USER_ID,Invalid user id";
	
	/**
	 * Service Oriented Errors
	 *
	 */
	
	/**
	 * Media Service
	 */
	
	const ENTRY_ID_NOT_FOUND = "ENTRY_ID_NOT_FOUND,Entry id \"%s\" not found";
	
	const UPLOADED_FILE_NOT_FOUND_BY_TOKEN = "UPLOADED_FILE_NOT_FOUND_BY_TOKEN,The uploaded file was not found by the given token id, or was already used";
	
	const RECORDED_WEBCAM_FILE_NOT_FOUND = "RECORDED_WEBCAM_FILE_NOT_FOUND,The recorded webcam file was not found by the given token id, or was already used";
	
	const PERMISSION_DENIED_TO_UPDATE_ENTRY = "PERMISSION_DENIED_TO_UPDATE_ENTRY,User can update only the entries he own, otherwise an admin session must be used";
	
	const INVALID_RANK_VALUE = "INVALID_RANK_VALUE,Invalid rank value, rank should be between 1 and 5";
	
	const MAX_CATEGORIES_FOR_ENTRY_REACHED = "MAX_CATEGORIES_FOR_ENTRY_REACHED,Entry can be linked with a maximum of \"%s\" categories";

	const INVALID_ENTRY_SCHEDULE_DATES = "INVALID_ENTRY_SCHEDULE_DATES,Invalid entry schedule dates";
	
	const INVALID_ENTRY_STATUS = "INVALID_ENTRY_STATUS,Invalid entry status";
	
	const ENTRY_CANNOT_BE_FLAGGED = "ENTRY_CANNOT_BE_FLAGGED,Entry cannot be flagged";
	
	/**
	 * Notification Service
	 */
	
	const NOTIFICATION_FOR_ENTRY_NOT_FOUND = "NOTIFICATION_FOR_ENTRY_NOT_FOUND,Notification for entry id \"%s\" not found";
	
	/**
	 * Bulk Upload Service
	 */
	
	const BULK_UPLOAD_NOT_FOUND = "BULK_UPLOAD_NOT_FOUND,Bulk upload id \"%s\" not found";
	
	/**
	 * Widget Service
	 */
	
	const SOURCE_WIDGET_OR_UICONF_REQUIRED = "SOURCE_WIDGET_OR_UICONF_REQUIRED,SourceWidgetId or UiConfId id are required";
	
	const SOURCE_WIDGET_NOT_FOUND = "SOURCE_WIDGET_NOT_FOUND,Source widget id \"%s\" not found";
	
	/**
	 * UiConf Service
	 */
	const UICONF_ID_NOT_FOUND = "UICONF_ID_NOT_FOUND,Ui conf id \"%s\" not found";
	
	/**
	 * AccessControl Service
	 */
	const ACCESS_CONTROL_ID_NOT_FOUND = "ACCESS_CONTROL_ID_NOT_FOUND,Access control id \"%s\" not found";
	
	const MAX_NUMBER_OF_ACCESS_CONTROLS_REACHED = "MAX_NUMBER_OF_ACCESS_CONTROLS_REACHED,Max number of \"%s\" access controls was reached";
	
	const CANNOT_DELETE_DEFAULT_ACCESS_CONTROL = "CANNOT_DELETE_DEFAULT_ACCESS_CONTROL,Default access control cannot be deleted";
	
	/**
	 * ConversionProfile Service
	 */
	const CONVERSION_PROFILE_ID_NOT_FOUND = "CONVERSION_PROFILE_ID_NOT_FOUND,Conversion profile id \"%s\" not found";
	
	const CANNOT_DELETE_DEFAULT_CONVERSION_PROFILE = "CANNOT_DELETE_DEFAULT_CONVERSION_PROFILE,Default conversion profile cannot be deleted";
	
	/**
	 * FlavorParams Service
	 */
	const FLAVOR_PARAMS_ID_NOT_FOUND = "FLAVOR_PARAMS_ID_NOT_FOUND,Flavor params id \"%s\" not found";
	
	const FLAVOR_PARAMS_NOT_FOUND = "FLAVOR_PARAMS_NOT_FOUND,Flavor params not found";
	
	const FLAVOR_PARAMS_DUPLICATE = "FLAVOR_PARAMS_DUPLICATE,Flavor params [%s] defined more than once";
	
	const FLAVOR_PARAMS_SOURCE_DUPLICATE = "FLAVOR_PARAMS_SOURCE_DUPLICATE,More than onc source flavor defined";
	
	/**
	 * FlavorAsset Service
	 */
	const FLAVOR_ASSET_ID_NOT_FOUND = "FLAVOR_ASSET_ID_NOT_FOUND,Flavor asset id \"%s\" not found";
	
	const FLAVOR_ASSET_RECONVERT_ORIGINAL = "FLAVOR_ASSET_RECONVERT_ORIGINAL,Cannot reconvert original flavor asset";
	
	const FLAVOR_ASSET_IS_NOT_READY = "FLAVOR_ASSET_IS_NOT_READY,The flavor asset is not ready";
	
	const ORIGINAL_FLAVOR_ASSET_IS_MISSING = "ORIGINAL_FLAVOR_ASSET_IS_MISSING,The original flavor asset is missing";
	
	const ORIGINAL_FLAVOR_ASSET_NOT_CREATED = "ORIGINAL_FLAVOR_ASSET_NOT_CREATED,The original flavor asset could not be created [%s]";
	
	const NO_FLAVORS_FOUND = "NO_FLAVORS_FOUND,No flavors found";
	
	/**
	 * Category Service
	 */
	const CATEGORY_NOT_FOUND = "CATEGORY_NOT_FOUND,Category id \"%s\" not found";
	
	const PARENT_CATEGORY_NOT_FOUND = "PARENT_CATEGORY_NOT_FOUND,Parent category id \"%s\" not found";
	
	const DUPLICATE_CATEGORY = "DUPLICATE_CATEGORY,The category \"%s\" already exists";
	
	const PARENT_CATEGORY_IS_CHILD = "PARENT_CATEGORY_IS_CHILD,The parent category \"%s\" is one of the childs for category \"%s\"";
	
	const MAX_CATEGORY_DEPTH_REACHED = "MAX_CATEGORY_DEPTH_REACHED,Category can have a max depth of \"%s\" levels";
	
	const MAX_NUMBER_OF_CATEGORIES_REACHED = "MAX_NUMBER_OF_CATEGORIES_REACHED,Max number of \"%s\" categories was reached";
	
	const CATEGORIES_LOCKED = "CATEGORIES_LOCKED,Categories are locked, lock will be automatically released in \"%s\" seconds";
	
	/**
	 * Batch Service
	 */
	
	const SCHEDULER_HOST_CONFLICT = "SCHEDULER_HOST_CONFLICT, Scheduler id \"%s\" conflicts between hosts: \"%s\" and \"%s\"";
	
	const SCHEDULER_NOT_FOUND = "SCHEDULER_NOT_FOUND, Scheduler id \"%s\" not found";
	
	const WORKER_NOT_FOUND = "WORKER_NOT_FOUND, Worker id \"%s\" not found";
	
	const COMMAND_NOT_FOUND = "COMMAND_NOT_FOUND, Command id \"%s\" not found";
	
	const COMMAND_ALREADY_PENDING = "COMMAND_ALREADY_PENDING, Command already pending";
	
	const PARTNER_NOT_SET = "PARTNER_NOT_SET, Partner not set";
	
	/**
	 * Upload Service
	 */
	const INVALID_UPLOAD_TOKEN_ID = "INVALID_UPLOAD_TOKEN_ID,Invalid upload token id";
	
	const UPLOAD_PARTIAL_ERROR = "UPLOAD_PARTIAL_ERROR,File was uploaded partially";
	
	const UPLOAD_ERROR = "UPLOAD_ERROR,Upload failed";
	
	const BULK_UPLOAD_CREATE_CSV_FILE_SYNC_ERROR = "BULK_UPLOAD_CREATE_CSV_FILE_SYNC_ERROR,Unable to create file sync object for bulk upload csv";
	
	const BULK_UPLOAD_CREATE_RESULT_FILE_SYNC_ERROR = "BULK_UPLOAD_CREATE_RESULT_FILE_SYNC_ERROR,Unable to create file sync object for bulk upload result";
	
	const BULK_UPLOAD_CREATE_CONVERT_FILE_SYNC_ERROR = "BULK_UPLOAD_CREATE_CONVERT_FILE_SYNC_ERROR,Unable to create file sync object for flavor conversion";
	
	/**
	 * Upload Token Service
	 */
	const UPLOAD_TOKEN_NOT_FOUND = "UPLOAD_TOKEN_NOT_FOUND,Upload token not found";
	
	const UPLOAD_TOKEN_INVALID_STATUS_FOR_UPLOAD = "UPLOAD_TOKEN_INVALID_STATUS_FOR_UPLOAD,Upload token is in an invalid status for uploading a file, maybe the file was already uploaded";
	
	const UPLOAD_TOKEN_INVALID_STATUS_FOR_ADD_ENTRY = "UPLOAD_TOKEN_INVALID_STATUS_FOR_ADD_ENTRY,Upload token is in an invalid status for adding entry, maybe the a file was not uploaded or the token was used";
	
	const UPLOAD_TOKEN_CANNOT_RESUME = "UPLOAD_TOKEN_CANNOT_RESUME,Cannot resume the upload, original file was not found";
	
	const UPLOAD_TOKEN_RESUMING_NOT_ALLOWED = "UPLOAD_TOKEN_RESUMING_NOT_ALLOWED,Resuming not allowed when file size was not specified";
	
	const UPLOAD_TOKEN_RESUMING_INVALID_POSITION = "UPLOAD_TOKEN_RESUMING_INVALID_POSITION,Resuming not allowed after end of file";
	
	/*
	 * Partenrs service
	 * %s - the parent partner_id
	 */
	const NON_GROUP_PARTNER_ATTEMPTING_TO_ASSIGN_CHILD = "NON_GROUP_PARTNER_ATTEMPTING_TO_ASSIGN_CHILD,Partner id [%s] is not a VAR/GROUP, but is attempting to create child partner";	
	
	
	const INVALID_OBJECT_ID = "INVALID_OBJECT_ID,Invalid object id [%s]";
	
	const USER_NOT_FOUND = "USER_NOT_FOUND,User was not found";
	
	const USER_WRONG_PASSWORD = "USER_WRONG_PASSWORD,Wrong password supplied";
}