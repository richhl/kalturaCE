using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaAdminUser : KalturaObjectBase
	{
		#region Properties
		public string Password = null;
		public string Email = null;
		public string ScreenName = null;
		#endregion

		#region CTor
		public KalturaAdminUser()
		{
		}

		public KalturaAdminUser(XmlElement node)
		{
			foreach (XmlElement propertyNode in node.ChildNodes)
			{
				string txt = propertyNode.InnerText;
				switch (propertyNode.Name)
				{
					case "password":
						this.Password = txt;
						continue;
					case "email":
						this.Email = txt;
						continue;
					case "screenName":
						this.ScreenName = txt;
						continue;
				}
			}
		}
		#endregion

		#region Methods
		public new KalturaParams ToParams()
		{
			KalturaParams kparams = base.ToParams();
			kparams.AddStringIfNotNull("password", this.Password);
			kparams.AddStringIfNotNull("email", this.Email);
			kparams.AddStringIfNotNull("screenName", this.ScreenName);
			return kparams;
		}
		#endregion
	}
}

