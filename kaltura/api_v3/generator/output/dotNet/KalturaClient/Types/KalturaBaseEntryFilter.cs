using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaBaseEntryFilter : KalturaFilter
	{
		#region Properties
		public string IdEqual = null;
		public string IdIn = null;
		public string NameLike = null;
		public string NameMultiLikeOr = null;
		public string NameMultiLikeAnd = null;
		public string NameEqual = null;
		public int PartnerIdEqual = Int32.MinValue;
		public string PartnerIdIn = null;
		public string UserIdEqual = null;
		public string TagsLike = null;
		public string TagsMultiLikeOr = null;
		public string TagsMultiLikeAnd = null;
		public string AdminTagsLike = null;
		public string AdminTagsMultiLikeOr = null;
		public string AdminTagsMultiLikeAnd = null;
		public KalturaEntryStatus StatusEqual = (KalturaEntryStatus)Int32.MinValue;
		public string StatusIn = null;
		public KalturaEntryType TypeEqual = (KalturaEntryType)Int32.MinValue;
		public string TypeIn = null;
		public int CreatedAtGreaterThanOrEqual = Int32.MinValue;
		public int CreatedAtLessThanOrEqual = Int32.MinValue;
		public int GroupIdEqual = Int32.MinValue;
		public string SearchTextMatchAnd = null;
		public string SearchTextMatchOr = null;
		public string TagsNameMultiLikeOr = null;
		public string TagsAdminTagsMultiLikeOr = null;
		public string TagsAdminTagsNameMultiLikeOr = null;
		public string TagsNameMultiLikeAnd = null;
		public string TagsAdminTagsMultiLikeAnd = null;
		public string TagsAdminTagsNameMultiLikeAnd = null;
		#endregion

		#region CTor
		public KalturaBaseEntryFilter()
		{
		}

		public KalturaBaseEntryFilter(XmlElement node) : base(node)
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
					case "nameLike":
						this.NameLike = txt;
						continue;
					case "nameMultiLikeOr":
						this.NameMultiLikeOr = txt;
						continue;
					case "nameMultiLikeAnd":
						this.NameMultiLikeAnd = txt;
						continue;
					case "nameEqual":
						this.NameEqual = txt;
						continue;
					case "partnerIdEqual":
						this.PartnerIdEqual = ParseInt(txt);
						continue;
					case "partnerIdIn":
						this.PartnerIdIn = txt;
						continue;
					case "userIdEqual":
						this.UserIdEqual = txt;
						continue;
					case "tagsLike":
						this.TagsLike = txt;
						continue;
					case "tagsMultiLikeOr":
						this.TagsMultiLikeOr = txt;
						continue;
					case "tagsMultiLikeAnd":
						this.TagsMultiLikeAnd = txt;
						continue;
					case "adminTagsLike":
						this.AdminTagsLike = txt;
						continue;
					case "adminTagsMultiLikeOr":
						this.AdminTagsMultiLikeOr = txt;
						continue;
					case "adminTagsMultiLikeAnd":
						this.AdminTagsMultiLikeAnd = txt;
						continue;
					case "statusEqual":
						this.StatusEqual = (KalturaEntryStatus)ParseEnum(typeof(KalturaEntryStatus), txt);
						continue;
					case "statusIn":
						this.StatusIn = txt;
						continue;
					case "typeEqual":
						this.TypeEqual = (KalturaEntryType)ParseEnum(typeof(KalturaEntryType), txt);
						continue;
					case "typeIn":
						this.TypeIn = txt;
						continue;
					case "createdAtGreaterThanOrEqual":
						this.CreatedAtGreaterThanOrEqual = ParseInt(txt);
						continue;
					case "createdAtLessThanOrEqual":
						this.CreatedAtLessThanOrEqual = ParseInt(txt);
						continue;
					case "groupIdEqual":
						this.GroupIdEqual = ParseInt(txt);
						continue;
					case "searchTextMatchAnd":
						this.SearchTextMatchAnd = txt;
						continue;
					case "searchTextMatchOr":
						this.SearchTextMatchOr = txt;
						continue;
					case "tagsNameMultiLikeOr":
						this.TagsNameMultiLikeOr = txt;
						continue;
					case "tagsAdminTagsMultiLikeOr":
						this.TagsAdminTagsMultiLikeOr = txt;
						continue;
					case "tagsAdminTagsNameMultiLikeOr":
						this.TagsAdminTagsNameMultiLikeOr = txt;
						continue;
					case "tagsNameMultiLikeAnd":
						this.TagsNameMultiLikeAnd = txt;
						continue;
					case "tagsAdminTagsMultiLikeAnd":
						this.TagsAdminTagsMultiLikeAnd = txt;
						continue;
					case "tagsAdminTagsNameMultiLikeAnd":
						this.TagsAdminTagsNameMultiLikeAnd = txt;
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
			kparams.AddStringIfNotNull("nameLike", this.NameLike);
			kparams.AddStringIfNotNull("nameMultiLikeOr", this.NameMultiLikeOr);
			kparams.AddStringIfNotNull("nameMultiLikeAnd", this.NameMultiLikeAnd);
			kparams.AddStringIfNotNull("nameEqual", this.NameEqual);
			kparams.AddIntIfNotNull("partnerIdEqual", this.PartnerIdEqual);
			kparams.AddStringIfNotNull("partnerIdIn", this.PartnerIdIn);
			kparams.AddStringIfNotNull("userIdEqual", this.UserIdEqual);
			kparams.AddStringIfNotNull("tagsLike", this.TagsLike);
			kparams.AddStringIfNotNull("tagsMultiLikeOr", this.TagsMultiLikeOr);
			kparams.AddStringIfNotNull("tagsMultiLikeAnd", this.TagsMultiLikeAnd);
			kparams.AddStringIfNotNull("adminTagsLike", this.AdminTagsLike);
			kparams.AddStringIfNotNull("adminTagsMultiLikeOr", this.AdminTagsMultiLikeOr);
			kparams.AddStringIfNotNull("adminTagsMultiLikeAnd", this.AdminTagsMultiLikeAnd);
			kparams.AddEnumIfNotNull("statusEqual", this.StatusEqual);
			kparams.AddStringIfNotNull("statusIn", this.StatusIn);
			kparams.AddEnumIfNotNull("typeEqual", this.TypeEqual);
			kparams.AddStringIfNotNull("typeIn", this.TypeIn);
			kparams.AddIntIfNotNull("createdAtGreaterThanOrEqual", this.CreatedAtGreaterThanOrEqual);
			kparams.AddIntIfNotNull("createdAtLessThanOrEqual", this.CreatedAtLessThanOrEqual);
			kparams.AddIntIfNotNull("groupIdEqual", this.GroupIdEqual);
			kparams.AddStringIfNotNull("searchTextMatchAnd", this.SearchTextMatchAnd);
			kparams.AddStringIfNotNull("searchTextMatchOr", this.SearchTextMatchOr);
			kparams.AddStringIfNotNull("tagsNameMultiLikeOr", this.TagsNameMultiLikeOr);
			kparams.AddStringIfNotNull("tagsAdminTagsMultiLikeOr", this.TagsAdminTagsMultiLikeOr);
			kparams.AddStringIfNotNull("tagsAdminTagsNameMultiLikeOr", this.TagsAdminTagsNameMultiLikeOr);
			kparams.AddStringIfNotNull("tagsNameMultiLikeAnd", this.TagsNameMultiLikeAnd);
			kparams.AddStringIfNotNull("tagsAdminTagsMultiLikeAnd", this.TagsAdminTagsMultiLikeAnd);
			kparams.AddStringIfNotNull("tagsAdminTagsNameMultiLikeAnd", this.TagsAdminTagsNameMultiLikeAnd);
			return kparams;
		}
		#endregion
	}
}

