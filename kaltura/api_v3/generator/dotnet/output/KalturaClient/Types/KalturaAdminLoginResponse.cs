using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaAdminLoginResponse : KalturaObjectBase
	{
		#region Properties
		public int PartnerId = Int32.MinValue;
		public int SubpId = Int32.MinValue;
		public string Ks = null;
		public string Uid = null;
		public KalturaAdminUser AdminUser;
		#endregion

		#region CTor
		public KalturaAdminLoginResponse()
		{
		}

		public KalturaAdminLoginResponse(XmlElement node)
		{
			foreach (XmlElement propertyNode in node.ChildNodes)
			{
				string txt = propertyNode.InnerText;
				switch (propertyNode.Name)
				{
					case "partnerId":
						this.PartnerId = ParseInt(txt);
						continue;
					case "subpId":
						this.SubpId = ParseInt(txt);
						continue;
					case "ks":
						this.Ks = txt;
						continue;
					case "uid":
						this.Uid = txt;
						continue;
					case "adminUser":
				        this.AdminUser = (KalturaAdminUser)KalturaObjectFactory.Create(propertyNode);
						continue;
				}
			}
		}
		#endregion

		#region Methods
		public new KalturaParams ToParams()
		{
			KalturaParams kparams = base.ToParams();
			kparams.AddIntIfNotNull("partnerId", this.PartnerId);
			kparams.AddIntIfNotNull("subpId", this.SubpId);
			kparams.AddStringIfNotNull("ks", this.Ks);
			kparams.AddStringIfNotNull("uid", this.Uid);
			return kparams;
		}
		#endregion
	}
}

