using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{

    public class KalturaBaseEntryService : KalturaServiceBase
	{
    public KalturaBaseEntryService(KalturaClient client)
			: base(client)
		{
		}

		public KalturaBaseEntry AddFromUploadedFile(KalturaBaseEntry entry, string uploadTokenId, int type)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("entry", entry.ToParams());
			kparams.Add("uploadTokenId", uploadTokenId);
			kparams.Add("type", type.GetHashCode().ToString());
			XmlElement result = _Client.CallService("baseEntry", "addFromUploadedFile", kparams);
			return (KalturaBaseEntry)KalturaObjectFactory.Create(result);
		}

		public KalturaBaseEntry Get(string entryId)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("entryId", entryId);
			XmlElement result = _Client.CallService("baseEntry", "get", kparams);
			return (KalturaBaseEntry)KalturaObjectFactory.Create(result);
		}

		public void Delete(string entryId)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("entryId", entryId);
			XmlElement result = _Client.CallService("baseEntry", "delete", kparams);
		}

		public KalturaBaseEntryListResponse List(KalturaBaseEntryFilter filter, KalturaFilterPager pager)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("filter", filter.ToParams());
			kparams.Add("pager", pager.ToParams());
			XmlElement result = _Client.CallService("baseEntry", "list", kparams);
			return (KalturaBaseEntryListResponse)KalturaObjectFactory.Create(result);
		}
	}
}
