using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{

    public class KalturaSearchService : KalturaServiceBase
	{
    public KalturaSearchService(KalturaClient client)
			: base(client)
		{
		}

		public IList<KalturaSearchResult> Search(KalturaSearch search, KalturaFilterPager pager)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("search", search.ToParams());
			kparams.Add("pager", pager.ToParams());
			XmlElement result = _Client.CallService("search", "search", kparams);
			IList<KalturaSearchResult> list = new List<KalturaSearchResult>();
			foreach(XmlElement node in result.ChildNodes)
			{
				list.Add((KalturaSearchResult)KalturaObjectFactory.Create(node));
			}
			return list;
		}

		public KalturaSearchResult GetMediaInfo(KalturaSearchResult searchResult)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("searchResult", searchResult.ToParams());
			XmlElement result = _Client.CallService("search", "getMediaInfo", kparams);
			return (KalturaSearchResult)KalturaObjectFactory.Create(result);
		}

		public KalturaSearchResult SearchUrl(int mediaType, string url)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("mediaType", mediaType.GetHashCode().ToString());
			kparams.Add("url", url);
			XmlElement result = _Client.CallService("search", "searchUrl", kparams);
			return (KalturaSearchResult)KalturaObjectFactory.Create(result);
		}
	}
}
