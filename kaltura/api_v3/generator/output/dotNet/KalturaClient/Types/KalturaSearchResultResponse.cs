using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaSearchResultResponse : KalturaObjectBase
	{
		#region Properties
		public IList<KalturaSearchResult> Objects;
		public bool? NeedMediaInfo = false;
		#endregion

		#region CTor
		public KalturaSearchResultResponse()
		{
		}

		public KalturaSearchResultResponse(XmlElement node)
		{
			foreach (XmlElement propertyNode in node.ChildNodes)
			{
				string txt = propertyNode.InnerText;
				switch (propertyNode.Name)
				{
					case "objects":
				        this.Objects = new List<KalturaSearchResult>();
						foreach(XmlElement arrayNode in propertyNode.ChildNodes)
						{
					        this.Objects.Add((KalturaSearchResult)KalturaObjectFactory.Create(arrayNode));
						}
						continue;
					case "needMediaInfo":
						this.NeedMediaInfo = ParseBool(txt);
						continue;
				}
			}
		}
		#endregion

		#region Methods
		public new KalturaParams ToParams()
		{
			KalturaParams kparams = base.ToParams();
			kparams.AddBoolIfNotNull("needMediaInfo", this.NeedMediaInfo);
			return kparams;
		}
		#endregion
	}
}

