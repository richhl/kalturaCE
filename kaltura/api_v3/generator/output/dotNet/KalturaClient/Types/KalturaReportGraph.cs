using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaReportGraph : KalturaObjectBase
	{
		#region Properties
		public string Id = null;
		public string Data = null;
		#endregion

		#region CTor
		public KalturaReportGraph()
		{
		}

		public KalturaReportGraph(XmlElement node)
		{
			foreach (XmlElement propertyNode in node.ChildNodes)
			{
				string txt = propertyNode.InnerText;
				switch (propertyNode.Name)
				{
					case "id":
						this.Id = txt;
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
			kparams.AddStringIfNotNull("id", this.Id);
			kparams.AddStringIfNotNull("data", this.Data);
			return kparams;
		}
		#endregion
	}
}

