using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaClientNotification : KalturaObjectBase
	{
		#region Properties
		public string Url = null;
		public string Data = null;
		#endregion

		#region CTor
		public KalturaClientNotification()
		{
		}

		public KalturaClientNotification(XmlElement node)
		{
			foreach (XmlElement propertyNode in node.ChildNodes)
			{
				string txt = propertyNode.InnerText;
				switch (propertyNode.Name)
				{
					case "url":
						this.Url = txt;
						continue;
					case "data":
						this.Data = txt;
						continue;
				}
			}
		}
		#endregion

		#region Methods
		public new KalturaParams ToParams()
		{
			KalturaParams kparams = base.ToParams();
			kparams.AddStringIfNotNull("url", this.Url);
			kparams.AddStringIfNotNull("data", this.Data);
			return kparams;
		}
		#endregion
	}
}

