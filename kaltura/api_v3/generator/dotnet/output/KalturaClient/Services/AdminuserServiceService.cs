using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{

    public class KalturaAdminuserService : KalturaServiceBase
	{
    public KalturaAdminuserService(KalturaClient client)
			: base(client)
		{
		}

		public KalturaAdminUser Updatepassword(string email, string password, string newEmail, string newPassword)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("email", email);
			kparams.Add("password", password);
			kparams.Add("newEmail", newEmail);
			kparams.Add("newPassword", newPassword);
			XmlElement result = _Client.CallService("adminuser", "updatepassword", kparams);
			return (KalturaAdminUser)KalturaObjectFactory.Create(result);
		}

		public string Resetpassword(string email)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("email", email);
			XmlElement result = _Client.CallService("adminuser", "resetpassword", kparams);
			return result.InnerText;
		}

		public KalturaAdminLoginResponse Login(string email, string password)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.Add("email", email);
			kparams.Add("password", password);
			XmlElement result = _Client.CallService("adminuser", "login", kparams);
			return (KalturaAdminLoginResponse)KalturaObjectFactory.Create(result);
		}
	}
}
