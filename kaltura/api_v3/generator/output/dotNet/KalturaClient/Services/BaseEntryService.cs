using System;
using System.Xml;
using System.Collections.Generic;
using System.IO;

namespace Kaltura
{

    public class KalturaBaseEntryService : KalturaServiceBase
	{
    public KalturaBaseEntryService(KalturaClient client)
			: base(client)
		{
		}

		public KalturaBaseEntry AddFromUploadedFile(KalturaBaseEntry entry, string uploadTokenId)
		{
			return this.AddFromUploadedFile(entry, uploadTokenId, (KalturaEntryType)(-1));
		}

		public KalturaBaseEntry AddFromUploadedFile(KalturaBaseEntry entry, string uploadTokenId, KalturaEntryType type)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("entry", entry.ToParams());
			kparams.AddStringIfNotNull("uploadTokenId", uploadTokenId);
			kparams.AddEnumIfNotNull("type", type);
			_Client.QueueServiceCall("baseEntry", "addFromUploadedFile", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaBaseEntry)KalturaObjectFactory.Create(result);
		}

		public KalturaBaseEntry Get(string entryId)
		{
			return this.Get(entryId, -1);
		}

		public KalturaBaseEntry Get(string entryId, int version)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddStringIfNotNull("entryId", entryId);
			kparams.AddIntIfNotNull("version", version);
			_Client.QueueServiceCall("baseEntry", "get", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaBaseEntry)KalturaObjectFactory.Create(result);
		}

		public IList<KalturaBaseEntry> GetByIds(string entryIds)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddStringIfNotNull("entryIds", entryIds);
			_Client.QueueServiceCall("baseEntry", "getByIds", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			IList<KalturaBaseEntry> list = new List<KalturaBaseEntry>();
			foreach(XmlElement node in result.ChildNodes)
			{
				list.Add((KalturaBaseEntry)KalturaObjectFactory.Create(node));
			}
			return list;
		}

		public void Delete(string entryId)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddStringIfNotNull("entryId", entryId);
			_Client.QueueServiceCall("baseEntry", "delete", kparams);
			if (this._Client.IsMultiRequest)
				return;
			XmlElement result = _Client.DoQueue();
		}

		public KalturaBaseEntryListResponse List()
		{
			return this.List(null);
		}

		public KalturaBaseEntryListResponse List(KalturaBaseEntryFilter filter)
		{
			return this.List(null, null);
		}

		public KalturaBaseEntryListResponse List(KalturaBaseEntryFilter filter, KalturaFilterPager pager)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("filter", filter.ToParams());
			kparams.Add("pager", pager.ToParams());
			_Client.QueueServiceCall("baseEntry", "list", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaBaseEntryListResponse)KalturaObjectFactory.Create(result);
		}

		public KalturaMediaEntry UpdateThumbnailJpeg(string entryId, FileStream fileData)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddStringIfNotNull("entryId", entryId);
			KalturaFiles kfiles = new KalturaFiles();
			kfiles.Add("fileData", fileData);
			_Client.QueueServiceCall("baseEntry", "updateThumbnailJpeg", kparams, kfiles);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaMediaEntry)KalturaObjectFactory.Create(result);
		}

		public void Flag(KalturaModerationFlag moderationFlag)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("moderationFlag", moderationFlag.ToParams());
			_Client.QueueServiceCall("baseEntry", "flag", kparams);
			if (this._Client.IsMultiRequest)
				return;
			XmlElement result = _Client.DoQueue();
		}

		public void Reject(string entryId)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddStringIfNotNull("entryId", entryId);
			_Client.QueueServiceCall("baseEntry", "reject", kparams);
			if (this._Client.IsMultiRequest)
				return;
			XmlElement result = _Client.DoQueue();
		}

		public void Approve(string entryId)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddStringIfNotNull("entryId", entryId);
			_Client.QueueServiceCall("baseEntry", "approve", kparams);
			if (this._Client.IsMultiRequest)
				return;
			XmlElement result = _Client.DoQueue();
		}

		public KalturaModerationFlagListResponse ListFlags(string entryId)
		{
			return this.ListFlags(entryId, null);
		}

		public KalturaModerationFlagListResponse ListFlags(string entryId, KalturaFilterPager pager)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddStringIfNotNull("entryId", entryId);
			kparams.Add("pager", pager.ToParams());
			_Client.QueueServiceCall("baseEntry", "listFlags", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaModerationFlagListResponse)KalturaObjectFactory.Create(result);
		}
	}
}
