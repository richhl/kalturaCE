using System;
using System.Xml;
using System.Collections.Generic;
using System.IO;

namespace Kaltura
{

    public class KalturaConversionProfileService : KalturaServiceBase
	{
    public KalturaConversionProfileService(KalturaClient client)
			: base(client)
		{
		}

		public KalturaConversionProfile AddCurrent(KalturaConversionProfile conversionProfile)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("conversionProfile", conversionProfile.ToParams());
			_Client.QueueServiceCall("conversionProfile", "addCurrent", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaConversionProfile)KalturaObjectFactory.Create(result);
		}

		public KalturaConversionProfile GetCurrent()
		{
			KalturaParams kparams = new KalturaParams();
			_Client.QueueServiceCall("conversionProfile", "getCurrent", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaConversionProfile)KalturaObjectFactory.Create(result);
		}
	}
}
