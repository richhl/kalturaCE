using System;
using System.Xml;
using System.Collections.Generic;

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
			XmlElement result = _Client.CallService("mixing", "add", kparams);
			return (KalturaMixEntry)KalturaObjectFactory.Create(result);
		}

		public KalturaMixEntry Get(string entryId)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("entryId", entryId);
			XmlElement result = _Client.CallService("mixing", "get", kparams);
			return (KalturaMixEntry)KalturaObjectFactory.Create(result);
		}

		public KalturaMixEntry Update(string entryId, KalturaMixEntry mixEntry)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("entryId", entryId);
			kparams.Add("mixEntry", mixEntry.ToParams());
			XmlElement result = _Client.CallService("mixing", "update", kparams);
			return (KalturaMixEntry)KalturaObjectFactory.Create(result);
		}

		public void Delete(string entryId)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("entryId", entryId);
			XmlElement result = _Client.CallService("mixing", "delete", kparams);
		}

		public KalturaMixListResponse List(KalturaMixEntryFilter filter, KalturaFilterPager pager)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("filter", filter.ToParams());
			kparams.Add("pager", pager.ToParams());
			XmlElement result = _Client.CallService("mixing", "list", kparams);
			return (KalturaMixListResponse)KalturaObjectFactory.Create(result);
		}

		public KalturaMixEntry Clone(string entryId)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("entryId", entryId);
			XmlElement result = _Client.CallService("mixing", "clone", kparams);
			return (KalturaMixEntry)KalturaObjectFactory.Create(result);
		}

		public KalturaMixEntry AppendMediaEntry(string mixEntryId, string mediaEntryId)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("mixEntryId", mixEntryId);
			kparams.Add("mediaEntryId", mediaEntryId);
			XmlElement result = _Client.CallService("mixing", "appendMediaEntry", kparams);
			return (KalturaMixEntry)KalturaObjectFactory.Create(result);
		}

		public int RequestFlattening(string entryId, string fileFormat, int version)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("entryId", entryId);
			kparams.Add("fileFormat", fileFormat);
			kparams.Add("version", version.ToString());
			XmlElement result = _Client.CallService("mixing", "requestFlattening", kparams);
			return int.Parse(result.InnerText);
		}
	}
}
