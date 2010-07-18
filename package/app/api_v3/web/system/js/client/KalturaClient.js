function KalturaBatchJobType()
{
}
KalturaBatchJobType.prototype.CONVERT = 0;
KalturaBatchJobType.prototype.IMPORT = 1;
KalturaBatchJobType.prototype.DELETE = 2;
KalturaBatchJobType.prototype.FLATTEN = 3;
KalturaBatchJobType.prototype.BULKUPLOAD = 4;
KalturaBatchJobType.prototype.DVDCREATOR = 5;
KalturaBatchJobType.prototype.DOWNLOAD = 6;
KalturaBatchJobType.prototype.OOCONVERT = 7;
KalturaBatchJobType.prototype.CONVERT_PROFILE = 10;
KalturaBatchJobType.prototype.POSTCONVERT = 11;
KalturaBatchJobType.prototype.PULL = 12;
KalturaBatchJobType.prototype.REMOTE_CONVERT = 13;
KalturaBatchJobType.prototype.EXTRACT_MEDIA = 14;
KalturaBatchJobType.prototype.MAIL = 15;
KalturaBatchJobType.prototype.NOTIFICATION = 16;
KalturaBatchJobType.prototype.CLEANUP = 17;
KalturaBatchJobType.prototype.SCHEDULER_HELPER = 18;
KalturaBatchJobType.prototype.PROJECT = 1000;

function KalturaControlPanelCommandStatus()
{
}
KalturaControlPanelCommandStatus.prototype.PENDING = 1;
KalturaControlPanelCommandStatus.prototype.HANDLED = 2;
KalturaControlPanelCommandStatus.prototype.DONE = 3;
KalturaControlPanelCommandStatus.prototype.FAILED = 4;

function KalturaControlPanelCommandTargetType()
{
}
KalturaControlPanelCommandTargetType.prototype.DATA_CENTER = 1;
KalturaControlPanelCommandTargetType.prototype.SCHEDULER = 2;
KalturaControlPanelCommandTargetType.prototype.JOB_TYPE = 3;
KalturaControlPanelCommandTargetType.prototype.JOB = 4;
KalturaControlPanelCommandTargetType.prototype.BATCH = 5;

function KalturaControlPanelCommandType()
{
}
KalturaControlPanelCommandType.prototype.STOP = 1;
KalturaControlPanelCommandType.prototype.START = 2;
KalturaControlPanelCommandType.prototype.CONFIG = 3;
KalturaControlPanelCommandType.prototype.KILL = 4;

function KalturaSchedulerStatusType()
{
}
KalturaSchedulerStatusType.prototype.RUNNING_BATCHES_COUNT = 1;
KalturaSchedulerStatusType.prototype.RUNNING_BATCHES_CPU = 2;
KalturaSchedulerStatusType.prototype.RUNNING_BATCHES_MEMORY = 3;
KalturaSchedulerStatusType.prototype.RUNNING_BATCHES_NETWORK = 4;
KalturaSchedulerStatusType.prototype.RUNNING_BATCHES_DISC_IO = 5;
KalturaSchedulerStatusType.prototype.RUNNING_BATCHES_DISC_SPACE = 6;
KalturaSchedulerStatusType.prototype.RUNNING_BATCHES_IS_RUNNING = 7;

function KalturaSessionType()
{
}
KalturaSessionType.prototype.USER = 0;
KalturaSessionType.prototype.ADMIN = 2;

function KalturaBatchQueuesStatus()
{
}
KalturaBatchQueuesStatus.prototype = new KalturaObjectBase();
/**
 * The job type
 *
 * @var KalturaBatchJobType
 */
KalturaBatchQueuesStatus.prototype.jobType = null;

/**
 * The size of the queue
 *
 * @var int
 */
KalturaBatchQueuesStatus.prototype.size = null;


function KalturaControlPanelCommand()
{
}
KalturaControlPanelCommand.prototype = new KalturaObjectBase();
/**
 * The id of the Category
 *
 * @var int
 * @readonly
 */
KalturaControlPanelCommand.prototype.id = null;

/**
 * Creation date as Unix timestamp (In seconds)
 *
 * @var int
 * @readonly
 */
KalturaControlPanelCommand.prototype.createdAt = null;

/**
 * Creator name
 *
 * @var string
 */
KalturaControlPanelCommand.prototype.createdBy = null;

/**
 * Update date as Unix timestamp (In seconds)
 *
 * @var int
 * @readonly
 */
KalturaControlPanelCommand.prototype.updatedAt = null;

/**
 * Updater name
 *
 * @var string
 */
KalturaControlPanelCommand.prototype.updatedBy = null;

/**
 * Creator id
 *
 * @var int
 */
KalturaControlPanelCommand.prototype.createdById = null;

/**
 * The id of the scheduler that the command refers to
 *
 * @var int
 */
KalturaControlPanelCommand.prototype.schedulerId = null;

/**
 * The id of the scheduler worker that the command refers to
 *
 * @var int
 */
KalturaControlPanelCommand.prototype.workerId = null;

/**
 * The name of the scheduler worker that the command refers to
 *
 * @var int
 */
KalturaControlPanelCommand.prototype.workerName = null;

/**
 * The index of the batch process that the command refers to
 *
 * @var int
 */
KalturaControlPanelCommand.prototype.batchIndex = null;

/**
 * The command type - stop / start / config
 *
 * @var KalturaControlPanelCommandType
 */
KalturaControlPanelCommand.prototype.type = null;

/**
 * The command target type - data center / scheduler / job / job type
 *
 * @var KalturaControlPanelCommandTargetType
 */
KalturaControlPanelCommand.prototype.targetType = null;

/**
 * The command status
 *
 * @var KalturaControlPanelCommandStatus
 */
KalturaControlPanelCommand.prototype.status = null;

/**
 * The reason for the command
 *
 * @var string
 */
KalturaControlPanelCommand.prototype.cause = null;

/**
 * Command description
 *
 * @var string
 */
KalturaControlPanelCommand.prototype.description = null;

/**
 * Error description
 *
 * @var string
 */
KalturaControlPanelCommand.prototype.errorDescription = null;


function KalturaSchedulerConfig()
{
}
KalturaSchedulerConfig.prototype = new KalturaObjectBase();
/**
 * The id of the Category
 *
 * @var int
 * @readonly
 */
KalturaSchedulerConfig.prototype.id = null;

/**
 * Creator name
 *
 * @var string
 */
KalturaSchedulerConfig.prototype.createdBy = null;

/**
 * Updater name
 *
 * @var string
 */
KalturaSchedulerConfig.prototype.updatedBy = null;

/**
 * Id of the control panel command that created this config item 
 *
 * @var string
 */
KalturaSchedulerConfig.prototype.commandId = null;

/**
 * The status of the control panel command 
 *
 * @var string
 */
KalturaSchedulerConfig.prototype.commandStatus = null;

/**
 * The id of the scheduler 
 *
 * @var int
 */
KalturaSchedulerConfig.prototype.schedulerId = null;

/**
 * The configured id of the scheduler 
 *
 * @var int
 */
KalturaSchedulerConfig.prototype.schedulerConfiguredId = null;

/**
 * The name of the scheduler 
 *
 * @var string
 */
KalturaSchedulerConfig.prototype.schedulerName = null;

/**
 * The id of the job worker
 *
 * @var int
 */
KalturaSchedulerConfig.prototype.workerId = null;

/**
 * The configured id of the job worker
 *
 * @var int
 */
KalturaSchedulerConfig.prototype.workerConfiguredId = null;

/**
 * The name of the job worker
 *
 * @var string
 */
KalturaSchedulerConfig.prototype.workerName = null;

/**
 * The name of the variable
 *
 * @var string
 */
KalturaSchedulerConfig.prototype.variable = null;

/**
 * The part of the variable
 *
 * @var string
 */
KalturaSchedulerConfig.prototype.variablePart = null;

/**
 * The value of the variable
 *
 * @var string
 */
KalturaSchedulerConfig.prototype.value = null;


function KalturaSchedulerStatus()
{
}
KalturaSchedulerStatus.prototype = new KalturaObjectBase();
/**
 * The id of the Category
 *
 * @var int
 * @readonly
 */
KalturaSchedulerStatus.prototype.id = null;

/**
 * Creator name
 *
 * @var string
 */
KalturaSchedulerStatus.prototype.createdBy = null;

/**
 * Updater name
 *
 * @var string
 */
KalturaSchedulerStatus.prototype.updatedBy = null;

/**
 * The configured id of the scheduler
 *
 * @var int
 */
KalturaSchedulerStatus.prototype.schedulerConfiguredId = null;

/**
 * The configured id of the job worker
 *
 * @var int
 */
KalturaSchedulerStatus.prototype.workerConfiguredId = null;

/**
 * The type of the job worker.
	 * Could be KalturaBatchJobType or extended type
 *
 * @var int
 */
KalturaSchedulerStatus.prototype.workerType = null;

/**
 * The status type
 *
 * @var KalturaSchedulerStatusType
 */
KalturaSchedulerStatus.prototype.type = null;

/**
 * The status value
 *
 * @var int
 */
KalturaSchedulerStatus.prototype.value = null;

/**
 * The id of the scheduler
 *
 * @var int
 * @readonly
 */
KalturaSchedulerStatus.prototype.schedulerId = null;

/**
 * The id of the worker
 *
 * @var int
 * @readonly
 */
KalturaSchedulerStatus.prototype.workerId = null;


function KalturaSchedulerStatusResponse()
{
}
KalturaSchedulerStatusResponse.prototype = new KalturaObjectBase();
/**
 * The status of all queues on the server
 *
 * @var KalturaBatchQueuesStatusArray
 */
KalturaSchedulerStatusResponse.prototype.queuesStatus = null;

/**
 * The commands that sent from the control panel
 *
 * @var KalturaControlPanelCommandArray
 */
KalturaSchedulerStatusResponse.prototype.controlPanelCommands = null;

/**
 * The configuration that sent from the control panel
 *
 * @var KalturaSchedulerConfigArray
 */
KalturaSchedulerStatusResponse.prototype.schedulerConfigs = null;



function KalturaSessionService(client)
{
	this.init(client);
}

KalturaSessionService.prototype = new KalturaServiceBase();

KalturaSessionService.prototype.start = function(callback, secret, userId, type, partnerId, expiry, privileges)
{
	if(!userId)
		userId = "";
	if(!type)
		type = 0;
	if(!partnerId)
		partnerId = -1;
	if(!expiry)
		expiry = 86400;
	if(!privileges)
		privileges = null;

	kparams = new Object();
	this.client.addParam(kparams, "secret", secret);
	this.client.addParam(kparams, "userId", userId);
	this.client.addParam(kparams, "type", type);
	this.client.addParam(kparams, "partnerId", partnerId);
	this.client.addParam(kparams, "expiry", expiry);
	this.client.addParam(kparams, "privileges", privileges);
	this.client.queueServiceActionCall("session", "start", kparams);
	if (!this.client.isMultiRequest())
		this.client.doQueue(callback);
};

function KalturaBatchcontrolService(client)
{
	this.init(client);
}

KalturaBatchcontrolService.prototype = new KalturaServiceBase();

KalturaBatchcontrolService.prototype.reportStatus = function(callback, schedulerConfigId, schedulerName, schedulerStatuses)
{

	kparams = new Object();
	this.client.addParam(kparams, "schedulerConfigId", schedulerConfigId);
	this.client.addParam(kparams, "schedulerName", schedulerName);
	for(var index in schedulerStatuses)
	{
		var obj = schedulerStatuses[index];
		this.client.addParam(kparams, "schedulerStatuses:" + index, obj.toParams());
	}
	this.client.queueServiceActionCall("batchcontrol", "reportStatus", kparams);
	if (!this.client.isMultiRequest())
		this.client.doQueue(callback);
};

KalturaBatchcontrolService.prototype.configLoaded = function(callback, schedulerConfigId, schedulerName, configParam, configValue, configParamPart, workerConfigId, workerName)
{
	if(!configParamPart)
		configParamPart = null;
	if(!workerConfigId)
		workerConfigId = null;
	if(!workerName)
		workerName = null;

	kparams = new Object();
	this.client.addParam(kparams, "schedulerConfigId", schedulerConfigId);
	this.client.addParam(kparams, "schedulerName", schedulerName);
	this.client.addParam(kparams, "configParam", configParam);
	this.client.addParam(kparams, "configValue", configValue);
	this.client.addParam(kparams, "configParamPart", configParamPart);
	this.client.addParam(kparams, "workerConfigId", workerConfigId);
	this.client.addParam(kparams, "workerName", workerName);
	this.client.queueServiceActionCall("batchcontrol", "configLoaded", kparams);
	if (!this.client.isMultiRequest())
		this.client.doQueue(callback);
};

KalturaBatchcontrolService.prototype.stop = function(callback, schedulerId, schedulerName, targetType, adminId, adminName, cause, workerId, workerName)
{
	if(!workerId)
		workerId = null;
	if(!workerName)
		workerName = null;

	kparams = new Object();
	this.client.addParam(kparams, "schedulerId", schedulerId);
	this.client.addParam(kparams, "schedulerName", schedulerName);
	this.client.addParam(kparams, "targetType", targetType);
	this.client.addParam(kparams, "adminId", adminId);
	this.client.addParam(kparams, "adminName", adminName);
	this.client.addParam(kparams, "cause", cause);
	this.client.addParam(kparams, "workerId", workerId);
	this.client.addParam(kparams, "workerName", workerName);
	this.client.queueServiceActionCall("batchcontrol", "stop", kparams);
	if (!this.client.isMultiRequest())
		this.client.doQueue(callback);
};

KalturaBatchcontrolService.prototype.kill = function(callback, schedulerId, schedulerName, workerId, workerName, batchIndex, adminId, adminName, cause)
{

	kparams = new Object();
	this.client.addParam(kparams, "schedulerId", schedulerId);
	this.client.addParam(kparams, "schedulerName", schedulerName);
	this.client.addParam(kparams, "workerId", workerId);
	this.client.addParam(kparams, "workerName", workerName);
	this.client.addParam(kparams, "batchIndex", batchIndex);
	this.client.addParam(kparams, "adminId", adminId);
	this.client.addParam(kparams, "adminName", adminName);
	this.client.addParam(kparams, "cause", cause);
	this.client.queueServiceActionCall("batchcontrol", "kill", kparams);
	if (!this.client.isMultiRequest())
		this.client.doQueue(callback);
};

KalturaBatchcontrolService.prototype.start = function(callback, schedulerId, schedulerName, targetType, adminId, adminName, workerId, workerName, cause)
{
	if(!cause)
		cause = null;

	kparams = new Object();
	this.client.addParam(kparams, "schedulerId", schedulerId);
	this.client.addParam(kparams, "schedulerName", schedulerName);
	this.client.addParam(kparams, "targetType", targetType);
	this.client.addParam(kparams, "adminId", adminId);
	this.client.addParam(kparams, "adminName", adminName);
	this.client.addParam(kparams, "workerId", workerId);
	this.client.addParam(kparams, "workerName", workerName);
	this.client.addParam(kparams, "cause", cause);
	this.client.queueServiceActionCall("batchcontrol", "start", kparams);
	if (!this.client.isMultiRequest())
		this.client.doQueue(callback);
};

KalturaBatchcontrolService.prototype.setConfig = function(callback, schedulerId, schedulerName, adminId, adminName, configParam, configValue, configParamPart, workerId, workerName)
{
	if(!configParamPart)
		configParamPart = null;
	if(!workerId)
		workerId = null;
	if(!workerName)
		workerName = null;

	kparams = new Object();
	this.client.addParam(kparams, "schedulerId", schedulerId);
	this.client.addParam(kparams, "schedulerName", schedulerName);
	this.client.addParam(kparams, "adminId", adminId);
	this.client.addParam(kparams, "adminName", adminName);
	this.client.addParam(kparams, "configParam", configParam);
	this.client.addParam(kparams, "configValue", configValue);
	this.client.addParam(kparams, "configParamPart", configParamPart);
	this.client.addParam(kparams, "workerId", workerId);
	this.client.addParam(kparams, "workerName", workerName);
	this.client.queueServiceActionCall("batchcontrol", "setConfig", kparams);
	if (!this.client.isMultiRequest())
		this.client.doQueue(callback);
};

KalturaBatchcontrolService.prototype.setCommandResult = function(callback, commandId, status, error_description)
{
	if(!error_description)
		error_description = null;

	kparams = new Object();
	this.client.addParam(kparams, "commandId", commandId);
	this.client.addParam(kparams, "status", status);
	this.client.addParam(kparams, "error_description", error_description);
	this.client.queueServiceActionCall("batchcontrol", "setCommandResult", kparams);
	if (!this.client.isMultiRequest())
		this.client.doQueue(callback);
};

KalturaBatchcontrolService.prototype.getCommand = function(callback, commandId)
{

	kparams = new Object();
	this.client.addParam(kparams, "commandId", commandId);
	this.client.queueServiceActionCall("batchcontrol", "getCommand", kparams);
	if (!this.client.isMultiRequest())
		this.client.doQueue(callback);
};

function KalturaClient(config)
{
	this.init(config);
}

KalturaClient.prototype = new KalturaClientBase()
/**
 * Session service
 *
 * @var KalturaSessionService
 */
KalturaClient.prototype.session = null;

/**
 * batch service lets you handle different batch process from remote machines.
	 * As oppesed to other ojects in the system, locking mechanism is critical in this case.
	 * For this reason the GetExclusiveXX, UpdateExclusiveXX and FreeExclusiveXX actions are important for the system's intergity.
	 * In general - updating batch object should be done only using the UpdateExclusiveXX which in turn can be called only after 
	 * acuiring a batch objet properly (using  GetExclusiveXX).
	 * If an object was aquired and should be returned to the pool in it's initial state - use the FreeExclusiveXX action 
 *
 * @var KalturaBatchcontrolService
 */
KalturaClient.prototype.batchcontrol = null;


KalturaClient.prototype.init = function(config)
{
	KalturaClientBase.prototype.init.apply(this, arguments);
	this.session = new KalturaSessionService(this);
	this.batchcontrol = new KalturaBatchcontrolService(this);
}
