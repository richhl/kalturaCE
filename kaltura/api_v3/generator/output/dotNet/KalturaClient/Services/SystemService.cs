using System;
using System.Xml;
using System.Collections.Generic;
using System.IO;

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
			_Client.QueueServiceCall("system", "ping", kparams);
			if (this._Client.IsMultiRequest)
				return false;
			XmlElement result = _Client.DoQueue();
			return bool.Parse(result.InnerText);
		}
	}
}
