using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{

    public class KalturaPartnerService : KalturaServiceBase
	{
    public KalturaPartnerService(KalturaClient client)
			: base(client)
		{
		}

		public KalturaPartner Register(KalturaPartner partner, string cmsPassword)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("partner", partner.ToParams());
			kparams.Add("cmsPassword", cmsPassword);
			XmlElement result = _Client.CallService("partner", "register", kparams);
			return (KalturaPartner)KalturaObjectFactory.Create(result);
		}

		public KalturaPartner Update(KalturaPartner partner, bool allowEmpty)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("partner", partner.ToParams());
			kparams.Add("allowEmpty", allowEmpty.ToString());
			XmlElement result = _Client.CallService("partner", "update", kparams);
			return (KalturaPartner)KalturaObjectFactory.Create(result);
		}

		public KalturaPartner Getsecrets(int partnerId, string adminEmail, string cmsPassword)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("partnerId", partnerId.ToString());
			kparams.Add("adminEmail", adminEmail);
			kparams.Add("cmsPassword", cmsPassword);
			XmlElement result = _Client.CallService("partner", "getsecrets", kparams);
			return (KalturaPartner)KalturaObjectFactory.Create(result);
		}

		public KalturaPartner Getinfo()
		{
			KalturaParams kparams = new KalturaParams();
			XmlElement result = _Client.CallService("partner", "getinfo", kparams);
			return (KalturaPartner)KalturaObjectFactory.Create(result);
		}

		public KalturaPartnerUsage Getusage(int year, int month, string resolution)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("year", year.ToString());
			kparams.Add("month", month.ToString());
			kparams.Add("resolution", resolution);
			XmlElement result = _Client.CallService("partner", "getusage", kparams);
			return (KalturaPartnerUsage)KalturaObjectFactory.Create(result);
		}
	}
}
