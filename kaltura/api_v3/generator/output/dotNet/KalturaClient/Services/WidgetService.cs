using System;
using System.Xml;
using System.Collections.Generic;
using System.IO;

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
			_Client.QueueServiceCall("widget", "add", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaWidget)KalturaObjectFactory.Create(result);
		}

		public KalturaWidget Update(string id, KalturaWidget widget)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddStringIfNotNull("id", id);
			kparams.Add("widget", widget.ToParams());
			_Client.QueueServiceCall("widget", "update", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaWidget)KalturaObjectFactory.Create(result);
		}

		public KalturaWidget Get(string id)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddStringIfNotNull("id", id);
			_Client.QueueServiceCall("widget", "get", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaWidget)KalturaObjectFactory.Create(result);
		}

		public KalturaWidget Clone(KalturaWidget widget)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("widget", widget.ToParams());
			_Client.QueueServiceCall("widget", "clone", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaWidget)KalturaObjectFactory.Create(result);
		}

		public KalturaWidgetListResponse List()
		{
			return this.List(null);
		}

		public KalturaWidgetListResponse List(KalturaWidgetFilter filter)
		{
			return this.List(null, null);
		}

		public KalturaWidgetListResponse List(KalturaWidgetFilter filter, KalturaFilterPager pager)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("filter", filter.ToParams());
			kparams.Add("pager", pager.ToParams());
			_Client.QueueServiceCall("widget", "list", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaWidgetListResponse)KalturaObjectFactory.Create(result);
		}
	}
}
