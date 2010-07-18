
var partnerId = -1;
var secret = "c2d5c06481e0a444ea8c3f7f0dab16bd";
var serviceUrl = "http://localhost/";

var kConfig = new KalturaConfiguration(partnerId);
kConfig.serviceUrl = serviceUrl;

var kClient = new KalturaClient(kConfig);

function sessionStarted(ks)
{
	kClient.setKs(ks);
}

kClient.session.start(sessionStarted, secret, "controlPanel", KalturaSessionType.prototype.ADMIN);

function stopScheduler(callback, schedulerId, schedulerName)
{
	//var cause = prompt("Please specify why you stop the scheduler");
	//if(!cause)
	var cause = "Stopped by the control panel";
	
	kClient.batchcontrol.stop(callback, schedulerId, schedulerName, KalturaControlPanelCommandTargetType.prototype.SCHEDULER, 1, "Control Panel", cause); 
}

function stopWorker(callback, schedulerId, schedulerName, workerId, workerName)
{
	var cause = "Stopped by the control panel";
	
	kClient.batchcontrol.stop(callback, schedulerId, schedulerName, KalturaControlPanelCommandTargetType.prototype.JOB, 1, "Control Panel", cause, workerId, workerName);
}

function killBatch(callback, schedulerId, schedulerName, workerId, workerName, batchIndex)
{
	var cause = "Killed by the control panel";
	
	kClient.batchcontrol.kill(callback, schedulerId, schedulerName, workerId, workerName, batchIndex, 1, "Control Panel", cause);
}

function startWorker(callback, schedulerId, schedulerName, workerId, workerName)
{	
	kClient.batchcontrol.start(callback, schedulerId, schedulerName, KalturaControlPanelCommandTargetType.prototype.JOB, 1, "Control Panel", workerId, workerName);
}

function sendConfig(callback, schedulerId, schedulerName, variable, variablePart, value, workerId, workerName)
{
	kClient.batchcontrol.setConfig(callback, schedulerId, schedulerName, 1, "Control Panel", variable, value, variablePart, workerId, workerName);
}
