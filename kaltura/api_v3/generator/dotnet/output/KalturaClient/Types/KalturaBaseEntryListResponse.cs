using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaBaseEntryListResponse : KalturaObjectBase
	{
		#region Properties
		public IList<KalturaBaseEntry> Objects;
		public int TotalCount = Int32.MinValue;
		#endregion

		#region CTor
		public KalturaBaseEntryListResponse()
		{
		}

		public KalturaBaseEntryListResponse(XmlElement node)
		{
			foreach (XmlElement propertyNode in node.ChildNodes)
			{
				string txt = propertyNode.InnerText;
				switch (propertyNode.Name)
				{
					case "objects":
				        this.Objects = new List<KalturaBaseEntry>();
						foreach(XmlElement arrayNode in propertyNode.ChildNodes)
						{
					        this.Objects.Add((KalturaBaseEntry)KalturaObjectFactory.Create(arrayNode));
						}
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
			kparams.AddIntIfNotNull("totalCount", this.TotalCount);
			return kparams;
		}
		#endregion
	}
}

