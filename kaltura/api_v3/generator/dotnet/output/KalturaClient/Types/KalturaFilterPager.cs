using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaFilterPager : KalturaObjectBase
	{
		#region Properties
		public int PageSize = Int32.MinValue;
		public int PageIndex = Int32.MinValue;
		#endregion

		#region CTor
		public KalturaFilterPager()
		{
		}

		public KalturaFilterPager(XmlElement node)
		{
			foreach (XmlElement propertyNode in node.ChildNodes)
			{
				string txt = propertyNode.InnerText;
				switch (propertyNode.Name)
				{
					case "pageSize":
						this.PageSize = ParseInt(txt);
						continue;
					case "pageIndex":
						this.PageIndex = ParseInt(txt);
						continue;
				}
			}
		}
		#endregion

		#region Methods
		public new KalturaParams ToParams()
		{
			KalturaParams kparams = base.ToParams();
			kparams.AddIntIfNotNull("pageSize", this.PageSize);
			kparams.AddIntIfNotNull("pageIndex", this.PageIndex);
			return kparams;
		}
		#endregion
	}
}

