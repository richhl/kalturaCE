using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaReportTotal : KalturaObjectBase
	{
		#region Properties
		public string Header = null;
		public string Data = null;
		#endregion

		#region CTor
		public KalturaReportTotal()
		{
		}

		public KalturaReportTotal(XmlElement node)
		{
			foreach (XmlElement propertyNode in node.ChildNodes)
			{
				string txt = propertyNode.InnerText;
				switch (propertyNode.Name)
				{
					case "header":
						this.Header = txt;
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
			kparams.AddStringIfNotNull("header", this.Header);
			kparams.AddStringIfNotNull("data", this.Data);
			return kparams;
		}
		#endregion
	}
}

