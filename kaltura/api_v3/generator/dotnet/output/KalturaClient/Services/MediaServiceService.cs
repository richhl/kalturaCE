using System;
using System.Xml;
using System.Collections.Generic;

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
			kparams.Add("url", url);
			XmlElement result = _Client.CallService("media", "addFromUrl", kparams);
			return (KalturaMediaEntry)KalturaObjectFactory.Create(result);
		}

		public KalturaMediaEntry AddFromSearchResult(KalturaMediaEntry mediaEntry, KalturaSearchResult searchResult)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("mediaEntry", mediaEntry.ToParams());
			kparams.Add("searchResult", searchResult.ToParams());
			XmlElement result = _Client.CallService("media", "addFromSearchResult", kparams);
			return (KalturaMediaEntry)KalturaObjectFactory.Create(result);
		}

		public KalturaMediaEntry AddFromUploadedFile(KalturaMediaEntry mediaEntry, string uploadTokenId)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("mediaEntry", mediaEntry.ToParams());
			kparams.Add("uploadTokenId", uploadTokenId);
			XmlElement result = _Client.CallService("media", "addFromUploadedFile", kparams);
			return (KalturaMediaEntry)KalturaObjectFactory.Create(result);
		}

		public KalturaMediaEntry AddFromRecordedWebcam(KalturaMediaEntry mediaEntry, string webcamTokenId)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("mediaEntry", mediaEntry.ToParams());
			kparams.Add("webcamTokenId", webcamTokenId);
			XmlElement result = _Client.CallService("media", "addFromRecordedWebcam", kparams);
			return (KalturaMediaEntry)KalturaObjectFactory.Create(result);
		}

		public KalturaMediaEntry Get(string entryId)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("entryId", entryId);
			XmlElement result = _Client.CallService("media", "get", kparams);
			return (KalturaMediaEntry)KalturaObjectFactory.Create(result);
		}

		public KalturaMediaEntry Update(string entryId, KalturaMediaEntry mediaEntry)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("entryId", entryId);
			kparams.Add("mediaEntry", mediaEntry.ToParams());
			XmlElement result = _Client.CallService("media", "update", kparams);
			return (KalturaMediaEntry)KalturaObjectFactory.Create(result);
		}

		public void Delete(string entryId)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("entryId", entryId);
			XmlElement result = _Client.CallService("media", "delete", kparams);
		}

		public KalturaMediaListResponse List(KalturaMediaEntryFilter filter, KalturaFilterPager pager)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("filter", filter.ToParams());
			kparams.Add("pager", pager.ToParams());
			XmlElement result = _Client.CallService("media", "list", kparams);
			return (KalturaMediaListResponse)KalturaObjectFactory.Create(result);
		}

		public KalturaMediaEntry UpdateThumbnail(string entryId, int timeOffset)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("entryId", entryId);
			kparams.Add("timeOffset", timeOffset.ToString());
			XmlElement result = _Client.CallService("media", "updateThumbnail", kparams);
			return (KalturaMediaEntry)KalturaObjectFactory.Create(result);
		}

		public int RequestConversion(string entryId, string fileFormat)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("entryId", entryId);
			kparams.Add("fileFormat", fileFormat);
			XmlElement result = _Client.CallService("media", "requestConversion", kparams);
			return int.Parse(result.InnerText);
		}
	}
}
