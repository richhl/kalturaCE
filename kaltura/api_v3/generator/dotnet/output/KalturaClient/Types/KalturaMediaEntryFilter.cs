using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaMediaEntryFilter : KalturaBaseEntryFilter
	{
		#region Properties
		public KalturaMediaType MediaTypeEqual = (KalturaMediaType)Int32.MinValue;
		public string MediaTypeIn = null;
		public int MediaDateGreaterThanEqual = Int32.MinValue;
		public int MediaDateLessThanEqual = Int32.MinValue;
		#endregion

		#region CTor
		public KalturaMediaEntryFilter()
		{
		}

		public KalturaMediaEntryFilter(XmlElement node) : base(node)
		{
			foreach (XmlElement propertyNode in node.ChildNodes)
			{
				string txt = propertyNode.InnerText;
				switch (propertyNode.Name)
				{
					case "mediaTypeEqual":
						this.MediaTypeEqual = (KalturaMediaType)ParseEnum(typeof(KalturaMediaType), txt);
						continue;
					case "mediaTypeIn":
						this.MediaTypeIn = txt;
						continue;
					case "mediaDateGreaterThanEqual":
						this.MediaDateGreaterThanEqual = ParseInt(txt);
						continue;
					case "mediaDateLessThanEqual":
						this.MediaDateLessThanEqual = ParseInt(txt);
						continue;
				}
			}
		}
		#endregion

		#region Methods
		public new KalturaParams ToParams()
		{
			KalturaParams kparams = base.ToParams();
			kparams.AddEnumIfNotNull("mediaTypeEqual", this.MediaTypeEqual);
			kparams.AddStringIfNotNull("mediaTypeIn", this.MediaTypeIn);
			kparams.AddIntIfNotNull("mediaDateGreaterThanEqual", this.MediaDateGreaterThanEqual);
			kparams.AddIntIfNotNull("mediaDateLessThanEqual", this.MediaDateLessThanEqual);
			return kparams;
		}
		#endregion
	}
}

