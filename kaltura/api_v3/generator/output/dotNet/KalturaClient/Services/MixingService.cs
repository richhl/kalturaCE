using System;
using System.Xml;
using System.Collections.Generic;
using System.IO;

namespace Kaltura
{

    public class KalturaMixingService : KalturaServiceBase
	{
    public KalturaMixingService(KalturaClient client)
			: base(client)
		{
		}

		public KalturaMixEntry Add(KalturaMixEntry mixEntry)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("mixEntry", mixEntry.ToParams());
			_Client.QueueServiceCall("mixing", "add", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaMixEntry)KalturaObjectFactory.Create(result);
		}

		public KalturaMixEntry Get(string entryId)
		{
			return this.Get(entryId, -1);
		}

		public KalturaMixEntry Get(string entryId, int version)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddStringIfNotNull("entryId", entryId);
			kparams.AddIntIfNotNull("version", version);
			_Client.QueueServiceCall("mixing", "get", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaMixEntry)KalturaObjectFactory.Create(result);
		}

		public KalturaMixEntry Update(string entryId, KalturaMixEntry mixEntry)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddStringIfNotNull("entryId", entryId);
			kparams.Add("mixEntry", mixEntry.ToParams());
			_Client.QueueServiceCall("mixing", "update", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaMixEntry)KalturaObjectFactory.Create(result);
		}

		public void Delete(string entryId)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddStringIfNotNull("entryId", entryId);
			_Client.QueueServiceCall("mixing", "delete", kparams);
			if (this._Client.IsMultiRequest)
				return;
			XmlElement result = _Client.DoQueue();
		}

		public KalturaMixListResponse List()
		{
			return this.List(null);
		}

		public KalturaMixListResponse List(KalturaMixEntryFilter filter)
		{
			return this.List(null, null);
		}

		public KalturaMixListResponse List(KalturaMixEntryFilter filter, KalturaFilterPager pager)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("filter", filter.ToParams());
			kparams.Add("pager", pager.ToParams());
			_Client.QueueServiceCall("mixing", "list", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaMixListResponse)KalturaObjectFactory.Create(result);
		}

		public KalturaMixEntry Clone(string entryId)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddStringIfNotNull("entryId", entryId);
			_Client.QueueServiceCall("mixing", "clone", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaMixEntry)KalturaObjectFactory.Create(result);
		}

		public KalturaMixEntry AppendMediaEntry(string mixEntryId, string mediaEntryId)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddStringIfNotNull("mixEntryId", mixEntryId);
			kparams.AddStringIfNotNull("mediaEntryId", mediaEntryId);
			_Client.QueueServiceCall("mixing", "appendMediaEntry", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaMixEntry)KalturaObjectFactory.Create(result);
		}

		public int RequestFlattening(string entryId, string fileFormat)
		{
			return this.RequestFlattening(entryId, fileFormat, -1);
		}

		public int RequestFlattening(string entryId, string fileFormat, int version)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddStringIfNotNull("entryId", entryId);
			kparams.AddStringIfNotNull("fileFormat", fileFormat);
			kparams.AddIntIfNotNull("version", version);
			_Client.QueueServiceCall("mixing", "requestFlattening", kparams);
			if (this._Client.IsMultiRequest)
				return 0;
			XmlElement result = _Client.DoQueue();
			return int.Parse(result.InnerText);
		}

		public IList<KalturaMixEntry> GetMixesByMediaId(string mediaEntryId)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddStringIfNotNull("mediaEntryId", mediaEntryId);
			_Client.QueueServiceCall("mixing", "getMixesByMediaId", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			IList<KalturaMixEntry> list = new List<KalturaMixEntry>();
			foreach(XmlElement node in result.ChildNodes)
			{
				list.Add((KalturaMixEntry)KalturaObjectFactory.Create(node));
			}
			return list;
		}

		public IList<KalturaMediaEntry> GetReadyMediaEntries(string mixId)
		{
			return this.GetReadyMediaEntries(mixId, -1);
		}

		public IList<KalturaMediaEntry> GetReadyMediaEntries(string mixId, int version)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddStringIfNotNull("mixId", mixId);
			kparams.AddIntIfNotNull("version", version);
			_Client.QueueServiceCall("mixing", "getReadyMediaEntries", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			IList<KalturaMediaEntry> list = new List<KalturaMediaEntry>();
			foreach(XmlElement node in result.ChildNodes)
			{
				list.Add((KalturaMediaEntry)KalturaObjectFactory.Create(node));
			}
			return list;
		}
	}
}
