using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{

    public class KalturaNotificationService : KalturaServiceBase
	{
    public KalturaNotificationService(KalturaClient client)
			: base(client)
		{
		}

		public KalturaClientNotification GetClientNotification(string entryId, int type)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("entryId", entryId);
			kparams.Add("type", type.GetHashCode().ToString());
			XmlElement result = _Client.CallService("notification", "getClientNotification", kparams);
			return (KalturaClientNotification)KalturaObjectFactory.Create(result);
		}
	}
}
