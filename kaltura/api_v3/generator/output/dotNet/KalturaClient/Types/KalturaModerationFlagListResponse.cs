using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaModerationFlagListResponse : KalturaObjectBase
	{
		#region Properties
		public IList<KalturaModerationFlag> Objects;
		public int TotalCount = Int32.MinValue;
		#endregion

		#region CTor
		public KalturaModerationFlagListResponse()
		{
		}

		public KalturaModerationFlagListResponse(XmlElement node)
		{
			foreach (XmlElement propertyNode in node.ChildNodes)
			{
				string txt = propertyNode.InnerText;
				switch (propertyNode.Name)
				{
					case "objects":
				        this.Objects = new List<KalturaModerationFlag>();
						foreach(XmlElement arrayNode in propertyNode.ChildNodes)
						{
					        this.Objects.Add((KalturaModerationFlag)KalturaObjectFactory.Create(arrayNode));
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

