using System;
using System.Xml;
using System.Collections.Generic;
using System.IO;

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
			_Client.QueueServiceCall("uiConf", "add", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaUiConf)KalturaObjectFactory.Create(result);
		}

		public KalturaUiConf Update(int id, KalturaUiConf uiConf)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddIntIfNotNull("id", id);
			kparams.Add("uiConf", uiConf.ToParams());
			_Client.QueueServiceCall("uiConf", "update", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaUiConf)KalturaObjectFactory.Create(result);
		}

		public KalturaUiConf Get(int id)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddIntIfNotNull("id", id);
			_Client.QueueServiceCall("uiConf", "get", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaUiConf)KalturaObjectFactory.Create(result);
		}

		public void Delete(int id)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddIntIfNotNull("id", id);
			_Client.QueueServiceCall("uiConf", "delete", kparams);
			if (this._Client.IsMultiRequest)
				return;
			XmlElement result = _Client.DoQueue();
		}

		public KalturaUiConf Clone(int id)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddIntIfNotNull("id", id);
			_Client.QueueServiceCall("uiConf", "clone", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaUiConf)KalturaObjectFactory.Create(result);
		}

		public KalturaUiConfListResponse List()
		{
			return this.List(null);
		}

		public KalturaUiConfListResponse List(KalturaUiConfFilter filter)
		{
			return this.List(null, null);
		}

		public KalturaUiConfListResponse List(KalturaUiConfFilter filter, KalturaFilterPager pager)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("filter", filter.ToParams());
			kparams.Add("pager", pager.ToParams());
			_Client.QueueServiceCall("uiConf", "list", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaUiConfListResponse)KalturaObjectFactory.Create(result);
		}
	}
}
