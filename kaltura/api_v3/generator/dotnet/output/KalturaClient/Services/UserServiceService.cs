using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{

    public class KalturaUserService : KalturaServiceBase
	{
    public KalturaUserService(KalturaClient client)
			: base(client)
		{
		}

		public KalturaUser Add(int id, KalturaUser user)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("id", id.ToString());
			kparams.Add("user", user.ToParams());
			XmlElement result = _Client.CallService("user", "add", kparams);
			return (KalturaUser)KalturaObjectFactory.Create(result);
		}

		public KalturaUser Update(string id, KalturaUser user)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("id", id);
			kparams.Add("user", user.ToParams());
			XmlElement result = _Client.CallService("user", "update", kparams);
			return (KalturaUser)KalturaObjectFactory.Create(result);
		}

		public KalturaUser Updateid(string id, string newId)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("id", id);
			kparams.Add("newId", newId);
			XmlElement result = _Client.CallService("user", "updateid", kparams);
			return (KalturaUser)KalturaObjectFactory.Create(result);
		}

		public KalturaUser Get(string id)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("id", id);
			XmlElement result = _Client.CallService("user", "get", kparams);
			return (KalturaUser)KalturaObjectFactory.Create(result);
		}

		public KalturaUser Delete(string id)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("id", id);
			XmlElement result = _Client.CallService("user", "delete", kparams);
			return (KalturaUser)KalturaObjectFactory.Create(result);
		}

		public IList<KalturaUser> List(KalturaUserFilter filter, KalturaFilterPager pager)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("filter", filter.ToParams());
			kparams.Add("pager", pager.ToParams());
			XmlElement result = _Client.CallService("user", "list", kparams);
			IList<KalturaUser> list = new List<KalturaUser>();
			foreach(XmlElement node in result.ChildNodes)
			{
				list.Add((KalturaUser)KalturaObjectFactory.Create(node));
			}
			return list;
		}
	}
}
