using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaUserFilter : KalturaObjectBase
	{
		#region Properties
		public int Status = Int32.MinValue;
		public string ScreenNameLike = null;
		public string TagsLike = null;
		public string EmailLike = null;
		public string CountryLike = null;
		public string EmailLikeRegexp = null;
		public string CreatedAtGreaterThanEqual = null;
		public string CreatedAtLessThanEqual = null;
		public string UpdatedAtGreaterThanEqual = null;
		public string UpdatedAtLessThanEqual = null;
		#endregion

		#region CTor
		public KalturaUserFilter()
		{
		}

		public KalturaUserFilter(XmlElement node)
		{
			foreach (XmlElement propertyNode in node.ChildNodes)
			{
				string txt = propertyNode.InnerText;
				switch (propertyNode.Name)
				{
					case "status":
						this.Status = ParseInt(txt);
						continue;
					case "screenNameLike":
						this.ScreenNameLike = txt;
						continue;
					case "tagsLike":
						this.TagsLike = txt;
						continue;
					case "emailLike":
						this.EmailLike = txt;
						continue;
					case "countryLike":
						this.CountryLike = txt;
						continue;
					case "emailLikeRegexp":
						this.EmailLikeRegexp = txt;
						continue;
					case "createdAtGreaterThanEqual":
						this.CreatedAtGreaterThanEqual = txt;
						continue;
					case "createdAtLessThanEqual":
						this.CreatedAtLessThanEqual = txt;
						continue;
					case "updatedAtGreaterThanEqual":
						this.UpdatedAtGreaterThanEqual = txt;
						continue;
					case "updatedAtLessThanEqual":
						this.UpdatedAtLessThanEqual = txt;
						continue;
				}
			}
		}
		#endregion

		#region Methods
		public new KalturaParams ToParams()
		{
			KalturaParams kparams = base.ToParams();
			kparams.AddIntIfNotNull("status", this.Status);
			kparams.AddStringIfNotNull("screenNameLike", this.ScreenNameLike);
			kparams.AddStringIfNotNull("tagsLike", this.TagsLike);
			kparams.AddStringIfNotNull("emailLike", this.EmailLike);
			kparams.AddStringIfNotNull("countryLike", this.CountryLike);
			kparams.AddStringIfNotNull("emailLikeRegexp", this.EmailLikeRegexp);
			kparams.AddStringIfNotNull("createdAtGreaterThanEqual", this.CreatedAtGreaterThanEqual);
			kparams.AddStringIfNotNull("createdAtLessThanEqual", this.CreatedAtLessThanEqual);
			kparams.AddStringIfNotNull("updatedAtGreaterThanEqual", this.UpdatedAtGreaterThanEqual);
			kparams.AddStringIfNotNull("updatedAtLessThanEqual", this.UpdatedAtLessThanEqual);
			return kparams;
		}
		#endregion
	}
}

