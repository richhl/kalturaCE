using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{

    public class KalturaUiConfService : KalturaServiceBase
	{
    public KalturaUiConfService(KalturaClient client)
			: base(client)
		{
		}

		public KalturaUiConf Add(KalturaUiConf uiConf)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("uiConf", uiConf.ToParams());
			XmlElement result = _Client.CallService("uiConf", "add", kparams);
			return (KalturaUiConf)KalturaObjectFactory.Create(result);
		}

		public KalturaUiConf Update(int id, KalturaUiConf uiConf)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("id", id.ToString());
			kparams.Add("uiConf", uiConf.ToParams());
			XmlElement result = _Client.CallService("uiConf", "update", kparams);
			return (KalturaUiConf)KalturaObjectFactory.Create(result);
		}

		public KalturaUiConf Get(int id)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("id", id.ToString());
			XmlElement result = _Client.CallService("uiConf", "get", kparams);
			return (KalturaUiConf)KalturaObjectFactory.Create(result);
		}

		public void Delete(int id)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("id", id.ToString());
			XmlElement result = _Client.CallService("uiConf", "delete", kparams);
		}

		public KalturaUiConf Clone(int id)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("id", id.ToString());
			XmlElement result = _Client.CallService("uiConf", "clone", kparams);
			return (KalturaUiConf)KalturaObjectFactory.Create(result);
		}

		public IList<KalturaUiConf> List(KalturaUiConfFilter filter, KalturaFilterPager pager)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("filter", filter.ToParams());
			kparams.Add("pager", pager.ToParams());
			XmlElement result = _Client.CallService("uiConf", "list", kparams);
			IList<KalturaUiConf> list = new List<KalturaUiConf>();
			foreach(XmlElement node in result.ChildNodes)
			{
				list.Add((KalturaUiConf)KalturaObjectFactory.Create(node));
			}
			return list;
		}
	}
}
