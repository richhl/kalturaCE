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
	
	const INVALID_SERVICE_CONFIGURATION = "INVALID_SERVICE_CONFIGURATION,Invalid service configuration";
	
	const PROPERTY_VALIDATION_CANNOT_BE_NULL =  "PROPERTY_VALIDATION_CANNOT_BE_NULL,The property \"%s\" cannot be NULL";
	
	const PROPERTY_VALIDATION_MIN_LENGTH = "PROPERTY_VALIDATION_MIN_LENGTH,The property \"%s\" must have a min length of %s characters";
	
	const PROPERTY_VALIDATION_MAX_LENGTH = "PROPERTY_VALIDATION_MAX_LENGTH,The property \"%s\" cannot have more than %s characters";
	
	const PROPERTY_VALIDATION_NOT_UPDATABLE = "PROPERTY_VALIDATION_NOT_UPDATABLE,The property \"%s\" cannot be updated";
	
	/**
	 * Service Oriented Errors
	 *
	 */
	
	/**
	 * Media Service
	 */
	
	const CANNOT_UPDATE_ADMIN_TAGS = "CANNOT_UPDATE_ADMIN_TAGS, Cannot update admin tags with normal user session";
	
	const ENTRY_ID_NOT_FOUND = "ENTRY_ID_NOT_FOUND,Entry id \"%s\" not found";
	
	const UPLOADED_FILE_NOT_FOUND_BY_TOKEN = "UPLOADED_FILE_NOT_FOUND_BY_TOKEN,The uploaded file was not found by the given token id, or was already used";
	
	const PERMISSION_DENIED_TO_UPDATE_ENTRY = "PERMISSION_DENIED_TO_UPDATE_ENTRY,User can update only the entries he own, otherwise an admin session must be used";
}