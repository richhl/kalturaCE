using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaSearchResult : KalturaSearch
	{
		#region Properties
		public string Id = null;
		public string Title = null;
		public string ThumbUrl = null;
		public string Description = null;
		public string Tags = null;
		public string Url = null;
		public string SourceLink = null;
		public string Credit = null;
		public KalturaLicenseType LicenseType = (KalturaLicenseType)Int32.MinValue;
		public string FlashPlaybackType = null;
		#endregion

		#region CTor
		public KalturaSearchResult()
		{
		}

		public KalturaSearchResult(XmlElement node) : base(node)
		{
			foreach (XmlElement propertyNode in node.ChildNodes)
			{
				string txt = propertyNode.InnerText;
				switch (propertyNode.Name)
				{
					case "id":
						this.Id = txt;
						continue;
					case "title":
						this.Title = txt;
						continue;
					case "thumbUrl":
						this.ThumbUrl = txt;
						continue;
					case "description":
						this.Description = txt;
						continue;
					case "tags":
						this.Tags = txt;
						continue;
					case "url":
						this.Url = txt;
						continue;
					case "sourceLink":
						this.SourceLink = txt;
						continue;
					case "credit":
						this.Credit = txt;
						continue;
					case "licenseType":
						this.LicenseType = (KalturaLicenseType)ParseEnum(typeof(KalturaLicenseType), txt);
						continue;
					case "flashPlaybackType":
						this.FlashPlaybackType = txt;
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
			kparams.AddStringIfNotNull("title", this.Title);
			kparams.AddStringIfNotNull("thumbUrl", this.ThumbUrl);
			kparams.AddStringIfNotNull("description", this.Description);
			kparams.AddStringIfNotNull("tags", this.Tags);
			kparams.AddStringIfNotNull("url", this.Url);
			kparams.AddStringIfNotNull("sourceLink", this.SourceLink);
			kparams.AddStringIfNotNull("credit", this.Credit);
			kparams.AddEnumIfNotNull("licenseType", this.LicenseType);
			kparams.AddStringIfNotNull("flashPlaybackType", this.FlashPlaybackType);
			return kparams;
		}
		#endregion
	}
}

