using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaReportTable : KalturaObjectBase
	{
		#region Properties
		public string Header = null;
		public string Data = null;
		public int TotalCount = Int32.MinValue;
		#endregion

		#region CTor
		public KalturaReportTable()
		{
		}

		public KalturaReportTable(XmlElement node)
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
					case "totalCount":
						this.TotalCount = ParseInt(txt);
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
			kparams.AddIntIfNotNull("totalCount", this.TotalCount);
			return kparams;
		}
		#endregion
	}
}

