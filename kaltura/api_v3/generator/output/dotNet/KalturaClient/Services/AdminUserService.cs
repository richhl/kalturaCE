using System;
using System.Xml;
using System.Collections.Generic;
using System.IO;

namespace Kaltura
{

    public class KalturaAdminUserService : KalturaServiceBase
	{
    public KalturaAdminUserService(KalturaClient client)
			: base(client)
		{
		}

		public KalturaAdminUser Updatepassword(string email, string password)
		{
			return this.Updatepassword(email, password, "");
		}

		public KalturaAdminUser Updatepassword(string email, string password, string newEmail)
		{
			return this.Updatepassword(email, password, "", "");
		}

		public KalturaAdminUser Updatepassword(string email, string password, string newEmail, string newPassword)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddStringIfNotNull("email", email);
			kparams.AddStringIfNotNull("password", password);
			kparams.AddStringIfNotNull("newEmail", newEmail);
			kparams.AddStringIfNotNull("newPassword", newPassword);
			_Client.QueueServiceCall("adminUser", "updatepassword", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return (KalturaAdminUser)KalturaObjectFactory.Create(result);
		}

		public void ResetPassword(string email)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddStringIfNotNull("email", email);
			_Client.QueueServiceCall("adminUser", "resetPassword", kparams);
			if (this._Client.IsMultiRequest)
				return;
			XmlElement result = _Client.DoQueue();
		}

		public string Login(string email, string password)
		{
			KalturaParams kparams = new KalturaParams();
			kparams.AddStringIfNotNull("email", email);
			kparams.AddStringIfNotNull("password", password);
			_Client.QueueServiceCall("adminUser", "login", kparams);
			if (this._Client.IsMultiRequest)
				return null;
			XmlElement result = _Client.DoQueue();
			return result.InnerText;
		}
	}
}
