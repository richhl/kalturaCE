using System;
using System.Xml;
using System.Collections.Generic;
using System.IO;

namespace Kaltura
{

    public class KalturaSessionService : KalturaServiceBase
	{
    public KalturaSessionService(KalturaClient client)
			: base(client)
		{
		}

		public string Start(string secret)
		{
			return this.Start(secret, "");
		}

		public string Start(string secret, string userId)
		{
			return this.Start(secret, "", (KalturaSessionType)(0));
		}

		public string Start(string secret, string userId, KalturaSessionType type)
		{
			return this.Start(secret, "", (KalturaSessionType)(0), -1);
		}

		public string Start(string secret, string userId, KalturaSessionType type, int partnerId)
		{
			return this.Start(secret, "", (KalturaSessionType)(0), -1, 86400);
		}

		public string Start(string secret, string userId, KalturaSessionType type, int partnerId, int expiry)
		{
			return this.Start(secret, "", (KalturaSessionType)(0), -1, 86400, "");
		}

		public string Start(string secret, string userId, KalturaSessionType type, int partnerId, int expiry, string privileges)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddStringIfNotNull("secret", secret);
			kparams.AddStringIfNotNull("userId", userId);
			kparams.AddEnumIfNotNull("type", type);
			kparams.AddIntIfNotNull("partnerId", partnerId);
			kparams.AddIntIfNotNull("expiry", expiry);
			kparams.AddStringIfNotNull("privileges", privileges);
			_Client.QueueServiceCall("session", "start", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return result.InnerText;
		}

		public KalturaStartWidgetSessionResponse StartWidgetSession(string widgetId)
		{
			return this.StartWidgetSession(widgetId, 86400);
		}

		public KalturaStartWidgetSessionResponse StartWidgetSession(string widgetId, int expiry)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddStringIfNotNull("widgetId", widgetId);
			kparams.AddIntIfNotNull("expiry", expiry);
			_Client.QueueServiceCall("session", "startWidgetSession", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaStartWidgetSessionResponse)KalturaObjectFactory.Create(result);
		}
	}
}
