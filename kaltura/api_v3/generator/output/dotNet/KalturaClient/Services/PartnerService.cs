using System;
using System.Xml;
using System.Collections.Generic;
using System.IO;

namespace Kaltura
{

    public class KalturaPartnerService : KalturaServiceBase
	{
    public KalturaPartnerService(KalturaClient client)
			: base(client)
		{
		}

		public KalturaPartner Register(KalturaPartner partner)
		{
			return this.Register(partner, "");
		}

		public KalturaPartner Register(KalturaPartner partner, string cmsPassword)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("partner", partner.ToParams());
			kparams.AddStringIfNotNull("cmsPassword", cmsPassword);
			_Client.QueueServiceCall("partner", "register", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaPartner)KalturaObjectFactory.Create(result);
		}

		public KalturaPartner Update(KalturaPartner partner)
		{
			return this.Update(partner, false);
		}

		public KalturaPartner Update(KalturaPartner partner, bool allowEmpty)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("partner", partner.ToParams());
			kparams.AddBoolIfNotNull("allowEmpty", allowEmpty);
			_Client.QueueServiceCall("partner", "update", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaPartner)KalturaObjectFactory.Create(result);
		}

		public KalturaPartner GetSecrets(int partnerId, string adminEmail, string cmsPassword)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddIntIfNotNull("partnerId", partnerId);
			kparams.AddStringIfNotNull("adminEmail", adminEmail);
			kparams.AddStringIfNotNull("cmsPassword", cmsPassword);
			_Client.QueueServiceCall("partner", "getSecrets", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaPartner)KalturaObjectFactory.Create(result);
		}

		public KalturaPartner GetInfo()
		{
			KalturaParams kparams = new KalturaParams();
			_Client.QueueServiceCall("partner", "getInfo", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaPartner)KalturaObjectFactory.Create(result);
		}

		public KalturaPartnerUsage GetUsage(int year)
		{
			return this.GetUsage(year, 1);
		}

		public KalturaPartnerUsage GetUsage(int year, int month)
		{
			return this.GetUsage(year, 1, "days");
		}

		public KalturaPartnerUsage GetUsage(int year, int month, string resolution)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddIntIfNotNull("year", year);
			kparams.AddIntIfNotNull("month", month);
			kparams.AddStringIfNotNull("resolution", resolution);
			_Client.QueueServiceCall("partner", "getUsage", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaPartnerUsage)KalturaObjectFactory.Create(result);
		}
	}
}
