using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaSearch : KalturaObjectBase
	{
		#region Properties
		public string KeyWords = null;
		public KalturaSearchProviderType SearchSource = (KalturaSearchProviderType)Int32.MinValue;
		public KalturaMediaType MediaType = (KalturaMediaType)Int32.MinValue;
		public string ExtraData = null;
		#endregion

		#region CTor
		public KalturaSearch()
		{
		}

		public KalturaSearch(XmlElement node)
		{
			foreach (XmlElement propertyNode in node.ChildNodes)
			{
				string txt = propertyNode.InnerText;
				switch (propertyNode.Name)
				{
					case "keyWords":
						this.KeyWords = txt;
						continue;
					case "searchSource":
						this.SearchSource = (KalturaSearchProviderType)ParseEnum(typeof(KalturaSearchProviderType), txt);
						continue;
					case "mediaType":
						this.MediaType = (KalturaMediaType)ParseEnum(typeof(KalturaMediaType), txt);
						continue;
					case "extraData":
						this.ExtraData = txt;
						continue;
				}
			}
		}
		#endregion

		#region Methods
		public new KalturaParams ToParams()
		{
			KalturaParams kparams = base.ToParams();
			kparams.AddStringIfNotNull("keyWords", this.KeyWords);
			kparams.AddEnumIfNotNull("searchSource", this.SearchSource);
			kparams.AddEnumIfNotNull("mediaType", this.MediaType);
			kparams.AddStringIfNotNull("extraData", this.ExtraData);
			return kparams;
		}
		#endregion
	}
}

