using System;
using System.Xml;
using System.Collections.Generic;
using System.IO;

namespace Kaltura
{

    public class KalturaNotificationService : KalturaServiceBase
	{
    public KalturaNotificationService(KalturaClient client)
			: base(client)
		{
		}

		public KalturaClientNotification GetClientNotification(string entryId, KalturaNotificationType type)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddStringIfNotNull("entryId", entryId);
			kparams.AddEnumIfNotNull("type", type);
			_Client.QueueServiceCall("notification", "getClientNotification", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaClientNotification)KalturaObjectFactory.Create(result);
		}
	}
}
