using System;
using System.Xml;
using System.Collections.Generic;
using System.IO;

namespace Kaltura
{

    public class KalturaBulkUploadService : KalturaServiceBase
	{
    public KalturaBulkUploadService(KalturaClient client)
			: base(client)
		{
		}

		public KalturaBulkUpload Add(int conversionProfileId, FileStream csvFileData)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddIntIfNotNull("conversionProfileId", conversionProfileId);
			KalturaFiles kfiles = new KalturaFiles();
			kfiles.Add("csvFileData", csvFileData);
			_Client.QueueServiceCall("bulkUpload", "add", kparams, kfiles);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaBulkUpload)KalturaObjectFactory.Create(result);
		}

		public KalturaBulkUpload Get(int id)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddIntIfNotNull("id", id);
			_Client.QueueServiceCall("bulkUpload", "get", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaBulkUpload)KalturaObjectFactory.Create(result);
		}

		public KalturaBulkUploadListResponse List()
		{
			return this.List(null);
		}

		public KalturaBulkUploadListResponse List(KalturaFilterPager pager)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("pager", pager.ToParams());
			_Client.QueueServiceCall("bulkUpload", "list", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaBulkUploadListResponse)KalturaObjectFactory.Create(result);
		}
	}
}
