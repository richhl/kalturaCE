using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{

    public class KalturaSystemService : KalturaServiceBase
	{
    public KalturaSystemService(KalturaClient client)
			: base(client)
		{
		}

		public bool Ping()
		{
			KalturaParams kparams = new KalturaParams();
			XmlElement result = _Client.CallService("system", "ping", kparams);
			return bool.Parse(result.InnerText);
		}
	}
}
