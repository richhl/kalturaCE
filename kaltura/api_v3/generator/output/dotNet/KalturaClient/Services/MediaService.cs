using System;
using System.Xml;
using System.Collections.Generic;
using System.IO;

namespace Kaltura
{

    public class KalturaMediaService : KalturaServiceBase
	{
    public KalturaMediaService(KalturaClient client)
			: base(client)
		{
		}

		public KalturaMediaEntry AddFromUrl(KalturaMediaEntry mediaEntry, string url)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("mediaEntry", mediaEntry.ToParams());
			kparams.AddStringIfNotNull("url", url);
			_Client.QueueServiceCall("media", "addFromUrl", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaMediaEntry)KalturaObjectFactory.Create(result);
		}

		public KalturaMediaEntry AddFromSearchResult()
		{
			return this.AddFromSearchResult(null);
		}

		public KalturaMediaEntry AddFromSearchResult(KalturaMediaEntry mediaEntry)
		{
			return this.AddFromSearchResult(null, null);
		}

		public KalturaMediaEntry AddFromSearchResult(KalturaMediaEntry mediaEntry, KalturaSearchResult searchResult)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("mediaEntry", mediaEntry.ToParams());
			kparams.Add("searchResult", searchResult.ToParams());
			_Client.QueueServiceCall("media", "addFromSearchResult", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaMediaEntry)KalturaObjectFactory.Create(result);
		}

		public KalturaMediaEntry AddFromUploadedFile(KalturaMediaEntry mediaEntry, string uploadTokenId)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("mediaEntry", mediaEntry.ToParams());
			kparams.AddStringIfNotNull("uploadTokenId", uploadTokenId);
			_Client.QueueServiceCall("media", "addFromUploadedFile", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaMediaEntry)KalturaObjectFactory.Create(result);
		}

		public KalturaMediaEntry AddFromRecordedWebcam(KalturaMediaEntry mediaEntry, string webcamTokenId)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("mediaEntry", mediaEntry.ToParams());
			kparams.AddStringIfNotNull("webcamTokenId", webcamTokenId);
			_Client.QueueServiceCall("media", "addFromRecordedWebcam", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaMediaEntry)KalturaObjectFactory.Create(result);
		}

		public KalturaMediaEntry Get(string entryId)
		{
			return this.Get(entryId, -1);
		}

		public KalturaMediaEntry Get(string entryId, int version)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddStringIfNotNull("entryId", entryId);
			kparams.AddIntIfNotNull("version", version);
			_Client.QueueServiceCall("media", "get", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaMediaEntry)KalturaObjectFactory.Create(result);
		}

		public KalturaMediaEntry Update(string entryId, KalturaMediaEntry mediaEntry)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddStringIfNotNull("entryId", entryId);
			kparams.Add("mediaEntry", mediaEntry.ToParams());
			_Client.QueueServiceCall("media", "update", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaMediaEntry)KalturaObjectFactory.Create(result);
		}

		public void Delete(string entryId)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddStringIfNotNull("entryId", entryId);
			_Client.QueueServiceCall("media", "delete", kparams);
			if (this._Client.IsMultiRequest)
				return;
			XmlElement result = _Client.DoQueue();
		}

		public KalturaMediaListResponse List()
		{
			return this.List(null);
		}

		public KalturaMediaListResponse List(KalturaMediaEntryFilter filter)
		{
			return this.List(null, null);
		}

		public KalturaMediaListResponse List(KalturaMediaEntryFilter filter, KalturaFilterPager pager)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("filter", filter.ToParams());
			kparams.Add("pager", pager.ToParams());
			_Client.QueueServiceCall("media", "list", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaMediaListResponse)KalturaObjectFactory.Create(result);
		}

		public string Upload(FileStream fileData)
		{
			KalturaParams kparams = new KalturaParams();
			KalturaFiles kfiles = new KalturaFiles();
			kfiles.Add("fileData", fileData);
			_Client.QueueServiceCall("media", "upload", kparams, kfiles);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return result.InnerText;
		}

		public KalturaMediaEntry UpdateThumbnail(string entryId, int timeOffset)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddStringIfNotNull("entryId", entryId);
			kparams.AddIntIfNotNull("timeOffset", timeOffset);
			_Client.QueueServiceCall("media", "updateThumbnail", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaMediaEntry)KalturaObjectFactory.Create(result);
		}

		public KalturaMediaEntry UpdateThumbnailJpeg(string entryId, FileStream fileData)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddStringIfNotNull("entryId", entryId);
			KalturaFiles kfiles = new KalturaFiles();
			kfiles.Add("fileData", fileData);
			_Client.QueueServiceCall("media", "updateThumbnailJpeg", kparams, kfiles);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaMediaEntry)KalturaObjectFactory.Create(result);
		}

		public int RequestConversion(string entryId, string fileFormat)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddStringIfNotNull("entryId", entryId);
			kparams.AddStringIfNotNull("fileFormat", fileFormat);
			_Client.QueueServiceCall("media", "requestConversion", kparams);
			if (this._Client.IsMultiRequest)
				return 0;
			XmlElement result = _Client.DoQueue();
			return int.Parse(result.InnerText);
		}

		public void Flag(KalturaModerationFlag moderationFlag)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("moderationFlag", moderationFlag.ToParams());
			_Client.QueueServiceCall("media", "flag", kparams);
			if (this._Client.IsMultiRequest)
				return;
			XmlElement result = _Client.DoQueue();
		}

		public void Reject(string entryId)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddStringIfNotNull("entryId", entryId);
			_Client.QueueServiceCall("media", "reject", kparams);
			if (this._Client.IsMultiRequest)
				return;
			XmlElement result = _Client.DoQueue();
		}

		public void Approve(string entryId)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddStringIfNotNull("entryId", entryId);
			_Client.QueueServiceCall("media", "approve", kparams);
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
			_Client.QueueServiceCall("media", "listFlags", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaModerationFlagListResponse)KalturaObjectFactory.Create(result);
		}
	}
}
