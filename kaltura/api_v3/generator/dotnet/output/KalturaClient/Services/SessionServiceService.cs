using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{

    public class KalturaSessionService : KalturaServiceBase
	{
    public KalturaSessionService(KalturaClient client)
			: base(client)
		{
		}

		public string Start(string secret, string userId, int type, int partnerId, int expiry, string privileges)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("secret", secret);
			kparams.Add("userId", userId);
			kparams.Add("type", type.GetHashCode().ToString());
			kparams.Add("partnerId", partnerId.ToString());
			kparams.Add("expiry", expiry.ToString());
			kparams.Add("privileges", privileges);
			XmlElement result = _Client.CallService("session", "start", kparams);
			return result.InnerText;
		}

		public string StartWidgetSession(string widgetId, int expiry)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("widgetId", widgetId);
			kparams.Add("expiry", expiry.ToString());
			XmlElement result = _Client.CallService("session", "startWidgetSession", kparams);
			return result.InnerText;
		}
	}
}
