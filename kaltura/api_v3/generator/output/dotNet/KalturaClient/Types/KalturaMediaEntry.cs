using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaMediaEntry : KalturaPlayableEntry
	{
		#region Properties
		public KalturaMediaType MediaType = (KalturaMediaType)Int32.MinValue;
		public string ConversionQuality = null;
		public KalturaSourceType SourceType = (KalturaSourceType)Int32.MinValue;
		public KalturaSearchProviderType SearchProviderType = (KalturaSearchProviderType)Int32.MinValue;
		public string SearchProviderId = null;
		public string CreditUserName = null;
		public string CreditUrl = null;
		public int MediaDate = Int32.MinValue;
		public string DataUrl = null;
		#endregion

		#region CTor
		public KalturaMediaEntry()
		{
		}

		public KalturaMediaEntry(XmlElement node) : base(node)
		{
			foreach (XmlElement propertyNode in node.ChildNodes)
			{
				string txt = propertyNode.InnerText;
				switch (propertyNode.Name)
				{
					case "mediaType":
						this.MediaType = (KalturaMediaType)ParseEnum(typeof(KalturaMediaType), txt);
						continue;
					case "conversionQuality":
						this.ConversionQuality = txt;
						continue;
					case "sourceType":
						this.SourceType = (KalturaSourceType)ParseEnum(typeof(KalturaSourceType), txt);
						continue;
					case "searchProviderType":
						this.SearchProviderType = (KalturaSearchProviderType)ParseEnum(typeof(KalturaSearchProviderType), txt);
						continue;
					case "searchProviderId":
						this.SearchProviderId = txt;
						continue;
					case "creditUserName":
						this.CreditUserName = txt;
						continue;
					case "creditUrl":
						this.CreditUrl = txt;
						continue;
					case "mediaDate":
						this.MediaDate = ParseInt(txt);
						continue;
					case "dataUrl":
						this.DataUrl = txt;
						continue;
				}
			}
		}
		#endregion

		#region Methods
		public new KalturaParams ToParams()
		{
			KalturaParams kparams = base.ToParams();
			kparams.AddEnumIfNotNull("mediaType", this.MediaType);
			kparams.AddStringIfNotNull("conversionQuality", this.ConversionQuality);
			kparams.AddEnumIfNotNull("sourceType", this.SourceType);
			kparams.AddEnumIfNotNull("searchProviderType", this.SearchProviderType);
			kparams.AddStringIfNotNull("searchProviderId", this.SearchProviderId);
			kparams.AddStringIfNotNull("creditUserName", this.CreditUserName);
			kparams.AddStringIfNotNull("creditUrl", this.CreditUrl);
			kparams.AddIntIfNotNull("mediaDate", this.MediaDate);
			kparams.AddStringIfNotNull("dataUrl", this.DataUrl);
			return kparams;
		}
		#endregion
	}
}

