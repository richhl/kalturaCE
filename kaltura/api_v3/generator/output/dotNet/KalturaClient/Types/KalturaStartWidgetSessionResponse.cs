using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaStartWidgetSessionResponse : KalturaObjectBase
	{
		#region Properties
		public int PartnerId = Int32.MinValue;
		public string Ks = null;
		public string UserId = null;
		#endregion

		#region CTor
		public KalturaStartWidgetSessionResponse()
		{
		}

		public KalturaStartWidgetSessionResponse(XmlElement node)
		{
			foreach (XmlElement propertyNode in node.ChildNodes)
			{
				string txt = propertyNode.InnerText;
				switch (propertyNode.Name)
				{
					case "partnerId":
						this.PartnerId = ParseInt(txt);
						continue;
					case "ks":
						this.Ks = txt;
						continue;
					case "userId":
						this.UserId = txt;
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
			kparams.AddStringIfNotNull("ks", this.Ks);
			kparams.AddStringIfNotNull("userId", this.UserId);
			return kparams;
		}
		#endregion
	}
}

