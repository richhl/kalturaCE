using System;
using System.Xml;
using System.Collections.Generic;
using System.IO;

namespace Kaltura
{

    public class KalturaBatchService : KalturaServiceBase
	{
    public KalturaBatchService(KalturaClient client)
			: base(client)
		{
		}

		public KalturaBatchJob AddImportJob(KalturaBatchJob importJob)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("importJob", importJob.ToParams());
			_Client.QueueServiceCall("batch", "addImportJob", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaBatchJob)KalturaObjectFactory.Create(result);
		}

		public IList<KalturaBatchJob> GetExclusiveImportJobs(string processorLocation, string pocessorName, int maxExecutionTime, int numberOfJobs, string partnerGroups)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddStringIfNotNull("processorLocation", processorLocation);
			kparams.AddStringIfNotNull("pocessorName", pocessorName);
			kparams.AddIntIfNotNull("maxExecutionTime", maxExecutionTime);
			kparams.AddIntIfNotNull("numberOfJobs", numberOfJobs);
			kparams.AddStringIfNotNull("partnerGroups", partnerGroups);
			_Client.QueueServiceCall("batch", "getExclusiveImportJobs", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			IList<KalturaBatchJob> list = new List<KalturaBatchJob>();
			foreach(XmlElement node in result.ChildNodes)
			{
				list.Add((KalturaBatchJob)KalturaObjectFactory.Create(node));
			}
			return list;
		}

		public KalturaBatchJob UpdateExclusiveImportJob(int id, string processorLocation, string pocessorName, KalturaBatchJob importJob)
		{
			return this.UpdateExclusiveImportJob(id, processorLocation, pocessorName, importJob, (KalturaEntryStatus)(Int32.MinValue));
		}

		public KalturaBatchJob UpdateExclusiveImportJob(int id, string processorLocation, string pocessorName, KalturaBatchJob importJob, KalturaEntryStatus entryStatus)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddIntIfNotNull("id", id);
			kparams.AddStringIfNotNull("processorLocation", processorLocation);
			kparams.AddStringIfNotNull("pocessorName", pocessorName);
			kparams.Add("importJob", importJob.ToParams());
			kparams.AddEnumIfNotNull("entryStatus", entryStatus);
			_Client.QueueServiceCall("batch", "updateExclusiveImportJob", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaBatchJob)KalturaObjectFactory.Create(result);
		}

		public KalturaBatchJob FreeExclusiveImportJob(int id, string processorLocation, string pocessorName)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddIntIfNotNull("id", id);
			kparams.AddStringIfNotNull("processorLocation", processorLocation);
			kparams.AddStringIfNotNull("pocessorName", pocessorName);
			_Client.QueueServiceCall("batch", "freeExclusiveImportJob", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaBatchJob)KalturaObjectFactory.Create(result);
		}

		public KalturaBatchJob AddPreConvertJob(KalturaBatchJob preConvertJob)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("preConvertJob", preConvertJob.ToParams());
			_Client.QueueServiceCall("batch", "addPreConvertJob", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaBatchJob)KalturaObjectFactory.Create(result);
		}

		public IList<KalturaBatchJob> GetExclusivePreConvertJobs(string processorLocation, string pocessorName, int maxExecutionTime, int numberOfJobs, string partnerGroups)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddStringIfNotNull("processorLocation", processorLocation);
			kparams.AddStringIfNotNull("pocessorName", pocessorName);
			kparams.AddIntIfNotNull("maxExecutionTime", maxExecutionTime);
			kparams.AddIntIfNotNull("numberOfJobs", numberOfJobs);
			kparams.AddStringIfNotNull("partnerGroups", partnerGroups);
			_Client.QueueServiceCall("batch", "getExclusivePreConvertJobs", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			IList<KalturaBatchJob> list = new List<KalturaBatchJob>();
			foreach(XmlElement node in result.ChildNodes)
			{
				list.Add((KalturaBatchJob)KalturaObjectFactory.Create(node));
			}
			return list;
		}

		public KalturaBatchJob UpdateExclusivePreConvertJob(int id, string processorLocation, string pocessorName, KalturaBatchJob preConvertJob)
		{
			return this.UpdateExclusivePreConvertJob(id, processorLocation, pocessorName, preConvertJob, (KalturaEntryStatus)(Int32.MinValue));
		}

		public KalturaBatchJob UpdateExclusivePreConvertJob(int id, string processorLocation, string pocessorName, KalturaBatchJob preConvertJob, KalturaEntryStatus entryStatus)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddIntIfNotNull("id", id);
			kparams.AddStringIfNotNull("processorLocation", processorLocation);
			kparams.AddStringIfNotNull("pocessorName", pocessorName);
			kparams.Add("preConvertJob", preConvertJob.ToParams());
			kparams.AddEnumIfNotNull("entryStatus", entryStatus);
			_Client.QueueServiceCall("batch", "updateExclusivePreConvertJob", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaBatchJob)KalturaObjectFactory.Create(result);
		}

		public KalturaBatchJob FreeExclusivePreConvertJob(int id, string processorLocation, string pocessorName)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddIntIfNotNull("id", id);
			kparams.AddStringIfNotNull("processorLocation", processorLocation);
			kparams.AddStringIfNotNull("pocessorName", pocessorName);
			_Client.QueueServiceCall("batch", "freeExclusivePreConvertJob", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaBatchJob)KalturaObjectFactory.Create(result);
		}

		public void CreateNotification(KalturaNotification notificationJob)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("notificationJob", notificationJob.ToParams());
			_Client.QueueServiceCall("batch", "createNotification", kparams);
			if (this._Client.IsMultiRequest)
				return;
			XmlElement result = _Client.DoQueue();
		}

		public KalturaBatchGetExclusiveNotificationJobsResponse GetExclusiveNotificationJobs(string processorLocation, string pocessorName, int maxExecutionTime, int numberOfJobs, string partnerGroups)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddStringIfNotNull("processorLocation", processorLocation);
			kparams.AddStringIfNotNull("pocessorName", pocessorName);
			kparams.AddIntIfNotNull("maxExecutionTime", maxExecutionTime);
			kparams.AddIntIfNotNull("numberOfJobs", numberOfJobs);
			kparams.AddStringIfNotNull("partnerGroups", partnerGroups);
			_Client.QueueServiceCall("batch", "getExclusiveNotificationJobs", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaBatchGetExclusiveNotificationJobsResponse)KalturaObjectFactory.Create(result);
		}

		public KalturaNotification UpdateExclusiveNotificationJob(int id, string processorLocation, string pocessorName, KalturaNotification notificationJob)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddIntIfNotNull("id", id);
			kparams.AddStringIfNotNull("processorLocation", processorLocation);
			kparams.AddStringIfNotNull("pocessorName", pocessorName);
			kparams.Add("notificationJob", notificationJob.ToParams());
			_Client.QueueServiceCall("batch", "updateExclusiveNotificationJob", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaNotification)KalturaObjectFactory.Create(result);
		}

		public KalturaBatchJob FreeExclusiveNotificationJob(int id, string processorLocation, string pocessorName)
		{
			return this.FreeExclusiveNotificationJob(id, processorLocation, pocessorName, null);
		}

		public KalturaBatchJob FreeExclusiveNotificationJob(int id, string processorLocation, string pocessorName, KalturaNotification notificationJob)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddIntIfNotNull("id", id);
			kparams.AddStringIfNotNull("processorLocation", processorLocation);
			kparams.AddStringIfNotNull("pocessorName", pocessorName);
			kparams.Add("notificationJob", notificationJob.ToParams());
			_Client.QueueServiceCall("batch", "freeExclusiveNotificationJob", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaBatchJob)KalturaObjectFactory.Create(result);
		}

		public void AddMailJob(KalturaMailJob mailJob)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("mailJob", mailJob.ToParams());
			_Client.QueueServiceCall("batch", "addMailJob", kparams);
			if (this._Client.IsMultiRequest)
				return;
			XmlElement result = _Client.DoQueue();
		}

		public IList<KalturaMailJob> GetExclusiveMailJobs(string processorLocation, string pocessorName, int maxExecutionTime, int numberOfJobs, string partnerGroups)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddStringIfNotNull("processorLocation", processorLocation);
			kparams.AddStringIfNotNull("pocessorName", pocessorName);
			kparams.AddIntIfNotNull("maxExecutionTime", maxExecutionTime);
			kparams.AddIntIfNotNull("numberOfJobs", numberOfJobs);
			kparams.AddStringIfNotNull("partnerGroups", partnerGroups);
			_Client.QueueServiceCall("batch", "getExclusiveMailJobs", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			IList<KalturaMailJob> list = new List<KalturaMailJob>();
			foreach(XmlElement node in result.ChildNodes)
			{
				list.Add((KalturaMailJob)KalturaObjectFactory.Create(node));
			}
			return list;
		}

		public KalturaMailJob UpdateExclusiveMailJob(int id, string processorLocation, string pocessorName, KalturaMailJob mailJob)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddIntIfNotNull("id", id);
			kparams.AddStringIfNotNull("processorLocation", processorLocation);
			kparams.AddStringIfNotNull("pocessorName", pocessorName);
			kparams.Add("mailJob", mailJob.ToParams());
			_Client.QueueServiceCall("batch", "updateExclusiveMailJob", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaMailJob)KalturaObjectFactory.Create(result);
		}

		public KalturaMailJob FreeExclusiveMailJob(int id, string processorLocation, string pocessorName)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddIntIfNotNull("id", id);
			kparams.AddStringIfNotNull("processorLocation", processorLocation);
			kparams.AddStringIfNotNull("pocessorName", pocessorName);
			_Client.QueueServiceCall("batch", "freeExclusiveMailJob", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaMailJob)KalturaObjectFactory.Create(result);
		}
	}
}
