using System;
using System.Xml;
using System.Collections.Generic;
using System.IO;

namespace Kaltura
{

    public class KalturaUserService : KalturaServiceBase
	{
    public KalturaUserService(KalturaClient client)
			: base(client)
		{
		}

		public KalturaUser Add(KalturaUser user)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("user", user.ToParams());
			_Client.QueueServiceCall("user", "add", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaUser)KalturaObjectFactory.Create(result);
		}

		public KalturaUser Update(string userId, KalturaUser user)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddStringIfNotNull("userId", userId);
			kparams.Add("user", user.ToParams());
			_Client.QueueServiceCall("user", "update", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaUser)KalturaObjectFactory.Create(result);
		}

		public KalturaUser Get(string userId)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddStringIfNotNull("userId", userId);
			_Client.QueueServiceCall("user", "get", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaUser)KalturaObjectFactory.Create(result);
		}

		public KalturaUser Delete(string userId)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddStringIfNotNull("userId", userId);
			_Client.QueueServiceCall("user", "delete", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaUser)KalturaObjectFactory.Create(result);
		}

		public KalturaUserListResponse List()
		{
			return this.List(null);
		}

		public KalturaUserListResponse List(KalturaUserFilter filter)
		{
			return this.List(null, null);
		}

		public KalturaUserListResponse List(KalturaUserFilter filter, KalturaFilterPager pager)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("filter", filter.ToParams());
			kparams.Add("pager", pager.ToParams());
			_Client.QueueServiceCall("user", "list", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaUserListResponse)KalturaObjectFactory.Create(result);
		}
	}
}
