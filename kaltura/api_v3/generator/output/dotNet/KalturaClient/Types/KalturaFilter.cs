using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaFilter : KalturaObjectBase
	{
		#region Properties
		public string OrderBy = null;
		#endregion

		#region CTor
		public KalturaFilter()
		{
		}

		public KalturaFilter(XmlElement node)
		{
			foreach (XmlElement propertyNode in node.ChildNodes)
			{
				string txt = propertyNode.InnerText;
				switch (propertyNode.Name)
				{
					case "orderBy":
						this.OrderBy = txt;
						continue;
				}
			}
		}
		#endregion

		#region Methods
		public new KalturaParams ToParams()
		{
			KalturaParams kparams = base.ToParams();
			kparams.AddStringIfNotNull("orderBy", this.OrderBy);
			return kparams;
		}
		#endregion
	}
}

