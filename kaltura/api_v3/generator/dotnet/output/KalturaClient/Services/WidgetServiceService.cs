using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{

    public class KalturaWidgetService : KalturaServiceBase
	{
    public KalturaWidgetService(KalturaClient client)
			: base(client)
		{
		}

		public KalturaWidget Add(KalturaWidget widget)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("widget", widget.ToParams());
			XmlElement result = _Client.CallService("widget", "add", kparams);
			return (KalturaWidget)KalturaObjectFactory.Create(result);
		}

		public KalturaWidget Update(string id, KalturaWidget widget)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("id", id);
			kparams.Add("widget", widget.ToParams());
			XmlElement result = _Client.CallService("widget", "update", kparams);
			return (KalturaWidget)KalturaObjectFactory.Create(result);
		}

		public KalturaWidget Get(string id)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("id", id);
			XmlElement result = _Client.CallService("widget", "get", kparams);
			return (KalturaWidget)KalturaObjectFactory.Create(result);
		}

		public KalturaWidget Clone(KalturaWidget widget)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("widget", widget.ToParams());
			XmlElement result = _Client.CallService("widget", "clone", kparams);
			return (KalturaWidget)KalturaObjectFactory.Create(result);
		}

		public IList<KalturaUiConf> List(KalturaWidgetFilter filter, KalturaFilterPager pager)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("filter", filter.ToParams());
			kparams.Add("pager", pager.ToParams());
			XmlElement result = _Client.CallService("widget", "list", kparams);
			IList<KalturaUiConf> list = new List<KalturaUiConf>();
			foreach(XmlElement node in result.ChildNodes)
			{
				list.Add((KalturaUiConf)KalturaObjectFactory.Create(node));
			}
			return list;
		}
	}
}
