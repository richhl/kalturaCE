using System;
using System.Xml;
using System.Collections.Generic;
using System.IO;

namespace Kaltura
{

    public class KalturaStatsService : KalturaServiceBase
	{
    public KalturaStatsService(KalturaClient client)
			: base(client)
		{
		}

		public void Collect(KalturaStatsEvent kevent)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("event", kevent.ToParams());
			_Client.QueueServiceCall("stats", "collect", kparams);
			if (this._Client.IsMultiRequest)
				return;
			XmlElement result = _Client.DoQueue();
		}

		public KalturaCEError ReportKceError(KalturaCEError kalturaCEError)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("kalturaCEError", kalturaCEError.ToParams());
			_Client.QueueServiceCall("stats", "reportKceError", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaCEError)KalturaObjectFactory.Create(result);
		}
	}
}
