



/**
 * Contruct new Kaltura service action call, if params array contain sub
 * arrays (for objects), it will be flattened
 * 
 * @param string
 *            $service
 * @param string
 *            $action
 * @param array
 *            $params
 * @param array
 *            $files
 */
function KalturaServiceActionCall(service, action, params, files)
{
	if(!params)
		params = new Object();
	if(!files)
		files = new Object();

	this.service = service;
	this.action = action;
	this.params = this.parseParams(params);
	this.files = files;
}

/**
 * @var string
 */
KalturaServiceActionCall.prototype.service = null;
	
/**
 * @var string
 */
KalturaServiceActionCall.prototype.action = null;


/**
 * @var array
 */
KalturaServiceActionCall.prototype.params = null;

/**
 * @var array
 */
KalturaServiceActionCall.prototype.files = null;


/**
 * Parse params array and sub arrays (for objects)
 * 
 * @param array
 *            $params
 */
KalturaServiceActionCall.prototype.parseParams = function(params)
{
	var newParams = new Object();
	for(var key in params) 
	{
		var val = params[key];
		
		if (typeof(val) == 'object')
		{
			newParams[key] = this.parseParams(val);
		}
		else
		{
			newParams[key] = val;
		}
	}
	return newParams;
};

/**
 * Return the parameters for a multi request
 * 
 * @param int
 *            $multiRequestIndex
 */
KalturaServiceActionCall.prototype.getParamsForMultiRequest = function(multiRequestIndex)
{
	var multiRequestParams = new Object();
	multiRequestParams[multiRequestIndex + ":service"] = this.service;
	multiRequestParams[multiRequestIndex + ":action"] = this.action;
	for(var key in this.params)
	{
		var val = this.params[key];
		multiRequestParams[multiRequestIndex + ":" + key] = val;
	}
	return multiRequestParams;
};


/**
 * Implement to get Kaltura Client logs
 * 
 */
function IKalturaLogger() 
{
}
IKalturaLogger.prototype.log = function(msg){};



/**
 * Kaltura client constructor
 * 
 */
function KalturaClientBase()
{
}

/**
 * Kaltura client init
 * 
 * @param KalturaConfiguration
 *            $config
 */
KalturaClientBase.prototype.init = function(config)
{
    this.config = config;
    
    var logger = this.config.getLogger();
	if (logger)
	{
		this.shouldLog = true;	
	}
};

KalturaClientBase.prototype.KALTURA_API_VERSION = "3.0";
KalturaClientBase.prototype.KALTURA_SERVICE_FORMAT_JSON = 1;
KalturaClientBase.prototype.KALTURA_SERVICE_FORMAT_XML = 2;
KalturaClientBase.prototype.KALTURA_SERVICE_FORMAT_PHP = 3;

/**
 * @var KalturaConfiguration
 */
KalturaClientBase.prototype.config = null;
	
/**
 * @var string
 */
KalturaClientBase.prototype.ks = null;
	
/**
 * @var boolean
 */
KalturaClientBase.prototype.shouldLog = false;
	
/**
 * @var boolean
 */
KalturaClientBase.prototype.useMultiRequest = false;
	
/**
 * @var unknown_type
 */
KalturaClientBase.prototype.callsQueue = new Array();

KalturaClientBase.prototype.queueServiceActionCall = function (service, action, params, files)
{
	// in start session partner id is optional (default -1). if partner id was
	// not set, use the one in the config
	if (!params.hasOwnProperty("partnerId") || params["partnerId"] == -1)
		params["partnerId"] = this.config.partnerId;
		
	this.addParam(params, "ks", this.ks);
	
	var call = new KalturaServiceActionCall(service, action, params, files);
	this.callsQueue.push(call);
};
	
KalturaClientBase.prototype.doQueue = function(callback)
{
	if (this.callsQueue.length == 0)
		return null;
		 
	var params = new Object();
	var files = new Object();
	this.log("service url: [" + this.config.serviceUrl + "]");
	
	// append the basic params
	this.addParam(params, "apiVersion", this.KALTURA_API_VERSION);
	this.addParam(params, "format", this.config.format);
	this.addParam(params, "clientTag", this.config.clientTag);
	
	var url = this.config.serviceUrl + "/api_v3/index.php?service=";
	var call = null;
	if (this.useMultiRequest)
	{
		url += "multirequest";
		$i = 1;
		for(var v in this.callsQueue)
		{
			call = this.callsQueue[v];
			var callParams = call.getParamsForMultiRequest($i++);
			for(var sv1 in callParams)
				params[sv1] = callParams[sv1];

			for(var sv2 in call.files)
				files[sv2] = call.files[sv2];
		}
	}
	else
	{
		call = this.callsQueue[0];
		url += call.service + "&action=" + call.action;

		for(var sv3 in call.params)
			params[sv3] = call.params[sv3];

		for(var sv4 in call.files)
			files[sv4] = call.files[sv4];
	}
	
	// reset
	this.callsQueue = new Array();
	this.useMultiRequest = false; 
	
	var signature = this.signature(params);
	this.addParam(params, "kalsig", signature);
	
	this.doHttpRequest(callback, url, params, files);
};

/**
 * Sign array of parameters
 * 
 * @param array
 *            $params
 * @return string
 */
KalturaClientBase.prototype.signature = function(params)
{
	ksort(params);
	var str = "";
	for(var v in params)
	{
		var k = params[v];
		str += k + v;
	}
	return md5(str);
};

/**
 * Send http request by using curl (if available) or php stream_context
 * 
 * @param string
 *            $url
 * @param parameters
 *            $params
 * @return array of result and error
 */
KalturaClientBase.prototype.doHttpRequest = function (callback, url, params, files)
{
	if(!params)
		params = new Object();
	if(!files)
		files = new Object();

	var data = params;
	var enctype = "application/x-www-form-urlencoded";
	if(files.length)
	{
		enctype = "multipart/form-data";
		for(var v in files)
		{
			var $file = files[v]; // must be a jquery object that points to a file input
			data[v] = $file.val();
		}
	}

    $.ajax(
    {
        type: "POST",
		cache: false,
        url: url,
        enctype: enctype,
		dataType: "json",
        data: data,
        error: function(xhr, ajaxOptions, thrownError)
		{
			throw xhr.status + ": " + thrownError;
        },
        success: function(results)
        {
        	if(!results.hasOwnProperty("objectType") && results.hasOwnProperty("code"))
        		throw results.code + ": " + results.message;
        	
	        callback(results);
        }
    });
};

/**
 * @return string
 */
KalturaClientBase.prototype.getKs = function()
{
	return this.ks;
};

/**
 * @param string
 *            $ks
 */
KalturaClientBase.prototype.setKs = function(ks)
{
	this.ks = ks;
};

/**
 * @return KalturaConfiguration
 */
KalturaClientBase.prototype.getConfig = function()
{
	return this.config;
};

/**
 * @param KalturaConfiguration
 *            $config
 */
KalturaClientBase.prototype.setConfig = function(config)
{
	this.config = config;
	
	logger = this.config.getLogger();
	if (logger instanceof IKalturaLogger)
	{
		this.shouldLog = true;	
	}
};

/**
 * Add parameter to array of parameters that is passed by reference
 * 
 * @param arrat
 *            $params
 * @param string
 *            $paramName
 * @param string
 *            $paramValue
 */
KalturaClientBase.prototype.addParam = function(params, paramName, paramValue)
{
	if (paramValue == null)
		return;
		
	if(typeof(paramValue) != 'object')
	{
		params[paramName] = paramValue;
		return;
	}
	
	for(var subParamName in paramValue)
	{
		var subParamValue = paramValue[subParamName];
		this.addParam(params, paramName + ":" + subParamName, subParamValue);
	}
};


KalturaClientBase.prototype.startMultiRequest = function()
{
	this.useMultiRequest = true;
};

KalturaClientBase.prototype.doMultiRequest = function(callback)
{
	return this.doQueue(callback);
};

KalturaClientBase.prototype.isMultiRequest = function()
{
	return this.useMultiRequest;	
};

/**
 * @param string
 *            $msg
 */
KalturaClientBase.prototype.log = function(msg)
{
	if (this.shouldLog)
		this.config.getLogger().log(msg);
};



/**
 * Abstract base class for all client services
 * Initialize the service keeping reference to the KalturaClient
 * 
 * @param KalturaClient
 *            $client
 */
function KalturaServiceBase()
{
}

KalturaServiceBase.prototype.init = function(client)
{
	this.client = client;
};


/**
 * @var KalturaClient
 */
KalturaServiceBase.prototype.client = null;



/**
 * Abstract base class for all client objects
 * 
 */
function KalturaObjectBase()
{
}

KalturaServiceBase.prototype.addIfNotNull = function(params, paramName, paramValue)
{
	if (paramValue != null)
	{
		if(paramValue instanceof KalturaObjectBase)
		{
			params[paramName] = paramValue.toParams();
		}
		else
		{
			params[paramName] = paramValue;
		}
	}
};

KalturaServiceBase.prototype.toParams = function()
{
	var params = new Object();
	params["objectType"] = getClass(this);
    for(var prop in this)
	{
    	var val = this[prop];
		this.addIfNotNull(params, prop, val);
	}
	return params;
};



/**
 * Constructs new Kaltura configuration object
 * 
 */
function KalturaConfiguration(partnerId)
{
	if(!partnerId)
		partnerId = -1;
	
    if (typeof(partnerId) != 'number')
        throw "Invalid partner id";
        
    this.partnerId = partnerId;
}

KalturaConfiguration.prototype.logger		= null;
KalturaConfiguration.prototype.serviceUrl	= "http://www.kaltura.com/";
KalturaConfiguration.prototype.partnerId	= null;
KalturaConfiguration.prototype.format		= KalturaClientBase.prototype.KALTURA_SERVICE_FORMAT_JSON;
KalturaConfiguration.prototype.clientTag	= "js";

/**
 * Set logger to get kaltura client debug logs
 * 
 * @param IKalturaLogger
 *            $log
 */
KalturaConfiguration.prototype.setLogger = function(log)
{
	this.logger = log;
};

/**
 * Gets the logger (Internal client use)
 * 
 * @return IKalturaLogger
 */
KalturaConfiguration.prototype.getLogger = function()
{
	return this.logger;
};
