using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaUserFilter : KalturaFilter
	{
		#region Properties
		public string IdEqual = null;
		public string IdIn = null;
		public int PartnerIdEqual = Int32.MinValue;
		public string ScreenNameLike = null;
		public string ScreenNameStartsWith = null;
		public string EmailLike = null;
		public string EmailStartsWith = null;
		public string TagsMultiLikeOr = null;
		public string TagsMultiLikeAnd = null;
		public int CreatedAtGreaterThanOrEqual = Int32.MinValue;
		public int CreatedAtLessThanOrEqual = Int32.MinValue;
		#endregion

		#region CTor
		public KalturaUserFilter()
		{
		}

		public KalturaUserFilter(XmlElement node) : base(node)
		{
			foreach (XmlElement propertyNode in node.ChildNodes)
			{
				string txt = propertyNode.InnerText;
				switch (propertyNode.Name)
				{
					case "idEqual":
						this.IdEqual = txt;
						continue;
					case "idIn":
						this.IdIn = txt;
						continue;
					case "partnerIdEqual":
						this.PartnerIdEqual = ParseInt(txt);
						continue;
					case "screenNameLike":
						this.ScreenNameLike = txt;
						continue;
					case "screenNameStartsWith":
						this.ScreenNameStartsWith = txt;
						continue;
					case "emailLike":
						this.EmailLike = txt;
						continue;
					case "emailStartsWith":
						this.EmailStartsWith = txt;
						continue;
					case "tagsMultiLikeOr":
						this.TagsMultiLikeOr = txt;
						continue;
					case "tagsMultiLikeAnd":
						this.TagsMultiLikeAnd = txt;
						continue;
					case "createdAtGreaterThanOrEqual":
						this.CreatedAtGreaterThanOrEqual = ParseInt(txt);
						continue;
					case "createdAtLessThanOrEqual":
						this.CreatedAtLessThanOrEqual = ParseInt(txt);
						continue;
				}
			}
		}
		#endregion

		#region Methods
		public new KalturaParams ToParams()
		{
			KalturaParams kparams = base.ToParams();
			kparams.AddStringIfNotNull("idEqual", this.IdEqual);
			kparams.AddStringIfNotNull("idIn", this.IdIn);
			kparams.AddIntIfNotNull("partnerIdEqual", this.PartnerIdEqual);
			kparams.AddStringIfNotNull("screenNameLike", this.ScreenNameLike);
			kparams.AddStringIfNotNull("screenNameStartsWith", this.ScreenNameStartsWith);
			kparams.AddStringIfNotNull("emailLike", this.EmailLike);
			kparams.AddStringIfNotNull("emailStartsWith", this.EmailStartsWith);
			kparams.AddStringIfNotNull("tagsMultiLikeOr", this.TagsMultiLikeOr);
			kparams.AddStringIfNotNull("tagsMultiLikeAnd", this.TagsMultiLikeAnd);
			kparams.AddIntIfNotNull("createdAtGreaterThanOrEqual", this.CreatedAtGreaterThanOrEqual);
			kparams.AddIntIfNotNull("createdAtLessThanOrEqual", this.CreatedAtLessThanOrEqual);
			return kparams;
		}
		#endregion
	}
}

