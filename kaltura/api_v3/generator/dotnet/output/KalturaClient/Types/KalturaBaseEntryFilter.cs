using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaBaseEntryFilter : KalturaObjectBase
	{
		#region Properties
		public string IdEqual = null;
		public string IdIn = null;
		public string UserIdEqual = null;
		public string TypeIn = null;
		public KalturaEntryStatus StatusEqual = (KalturaEntryStatus)Int32.MinValue;
		public string StatusIn = null;
		public string NameLike = null;
		public string NameMultiLikeOr = null;
		public string NameMultiLikeAnd = null;
		public string NameEqual = null;
		public string TagsLike = null;
		public string TagsMultiLikeOr = null;
		public string TagsMultiLikeAnd = null;
		public string AdminTagsLike = null;
		public string AdminTagsMultiLikeOr = null;
		public string AdminTagsMultiLikeAnd = null;
		public int GroupIdEqual = Int32.MinValue;
		public int CreatedAtGreaterThanEqual = Int32.MinValue;
		public int CreatedAtLessThenEqual = Int32.MinValue;
		public int UpdatedAtGreaterThanEqual = Int32.MinValue;
		public int UpdatedAtLessThenEqual = Int32.MinValue;
		public int ModifiedAtGreaterThanEqual = Int32.MinValue;
		public int ModifiedAtLessThenEqual = Int32.MinValue;
		public int PartnerIdEqual = Int32.MinValue;
		public string PartnerIdIn = null;
		public int ModerationStatusEqual = Int32.MinValue;
		public string ModerationStatusIn = null;
		public string TagsAndNameMultiLikeOr = null;
		public string TagsAndAdminTagsMultiLikeOr = null;
		public string TagsAndAdminTagsAndNameMultiLikeOr = null;
		public string TagsAndNameMultiLikeAnd = null;
		public string TagsAndAdminTagsMultiLikeAnd = null;
		public string TagsAndAdminTagsAndNameMultiLikeAnd = null;
		public string SearchTextMatchAnd = null;
		public string SearchTextMatchOr = null;
		#endregion

		#region CTor
		public KalturaBaseEntryFilter()
		{
		}

		public KalturaBaseEntryFilter(XmlElement node)
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
					case "userIdEqual":
						this.UserIdEqual = txt;
						continue;
					case "typeIn":
						this.TypeIn = txt;
						continue;
					case "statusEqual":
						this.StatusEqual = (KalturaEntryStatus)ParseEnum(typeof(KalturaEntryStatus), txt);
						continue;
					case "statusIn":
						this.StatusIn = txt;
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
					case "groupIdEqual":
						this.GroupIdEqual = ParseInt(txt);
						continue;
					case "createdAtGreaterThanEqual":
						this.CreatedAtGreaterThanEqual = ParseInt(txt);
						continue;
					case "createdAtLessThenEqual":
						this.CreatedAtLessThenEqual = ParseInt(txt);
						continue;
					case "updatedAtGreaterThanEqual":
						this.UpdatedAtGreaterThanEqual = ParseInt(txt);
						continue;
					case "updatedAtLessThenEqual":
						this.UpdatedAtLessThenEqual = ParseInt(txt);
						continue;
					case "modifiedAtGreaterThanEqual":
						this.ModifiedAtGreaterThanEqual = ParseInt(txt);
						continue;
					case "modifiedAtLessThenEqual":
						this.ModifiedAtLessThenEqual = ParseInt(txt);
						continue;
					case "partnerIdEqual":
						this.PartnerIdEqual = ParseInt(txt);
						continue;
					case "partnerIdIn":
						this.PartnerIdIn = txt;
						continue;
					case "moderationStatusEqual":
						this.ModerationStatusEqual = ParseInt(txt);
						continue;
					case "moderationStatusIn":
						this.ModerationStatusIn = txt;
						continue;
					case "tagsAndNameMultiLikeOr":
						this.TagsAndNameMultiLikeOr = txt;
						continue;
					case "tagsAndAdminTagsMultiLikeOr":
						this.TagsAndAdminTagsMultiLikeOr = txt;
						continue;
					case "tagsAndAdminTagsAndNameMultiLikeOr":
						this.TagsAndAdminTagsAndNameMultiLikeOr = txt;
						continue;
					case "tagsAndNameMultiLikeAnd":
						this.TagsAndNameMultiLikeAnd = txt;
						continue;
					case "tagsAndAdminTagsMultiLikeAnd":
						this.TagsAndAdminTagsMultiLikeAnd = txt;
						continue;
					case "tagsAndAdminTagsAndNameMultiLikeAnd":
						this.TagsAndAdminTagsAndNameMultiLikeAnd = txt;
						continue;
					case "searchTextMatchAnd":
						this.SearchTextMatchAnd = txt;
						continue;
					case "searchTextMatchOr":
						this.SearchTextMatchOr = txt;
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
			kparams.AddStringIfNotNull("userIdEqual", this.UserIdEqual);
			kparams.AddStringIfNotNull("typeIn", this.TypeIn);
			kparams.AddEnumIfNotNull("statusEqual", this.StatusEqual);
			kparams.AddStringIfNotNull("statusIn", this.StatusIn);
			kparams.AddStringIfNotNull("nameLike", this.NameLike);
			kparams.AddStringIfNotNull("nameMultiLikeOr", this.NameMultiLikeOr);
			kparams.AddStringIfNotNull("nameMultiLikeAnd", this.NameMultiLikeAnd);
			kparams.AddStringIfNotNull("nameEqual", this.NameEqual);
			kparams.AddStringIfNotNull("tagsLike", this.TagsLike);
			kparams.AddStringIfNotNull("tagsMultiLikeOr", this.TagsMultiLikeOr);
			kparams.AddStringIfNotNull("tagsMultiLikeAnd", this.TagsMultiLikeAnd);
			kparams.AddStringIfNotNull("adminTagsLike", this.AdminTagsLike);
			kparams.AddStringIfNotNull("adminTagsMultiLikeOr", this.AdminTagsMultiLikeOr);
			kparams.AddStringIfNotNull("adminTagsMultiLikeAnd", this.AdminTagsMultiLikeAnd);
			kparams.AddIntIfNotNull("groupIdEqual", this.GroupIdEqual);
			kparams.AddIntIfNotNull("createdAtGreaterThanEqual", this.CreatedAtGreaterThanEqual);
			kparams.AddIntIfNotNull("createdAtLessThenEqual", this.CreatedAtLessThenEqual);
			kparams.AddIntIfNotNull("updatedAtGreaterThanEqual", this.UpdatedAtGreaterThanEqual);
			kparams.AddIntIfNotNull("updatedAtLessThenEqual", this.UpdatedAtLessThenEqual);
			kparams.AddIntIfNotNull("modifiedAtGreaterThanEqual", this.ModifiedAtGreaterThanEqual);
			kparams.AddIntIfNotNull("modifiedAtLessThenEqual", this.ModifiedAtLessThenEqual);
			kparams.AddIntIfNotNull("partnerIdEqual", this.PartnerIdEqual);
			kparams.AddStringIfNotNull("partnerIdIn", this.PartnerIdIn);
			kparams.AddIntIfNotNull("moderationStatusEqual", this.ModerationStatusEqual);
			kparams.AddStringIfNotNull("moderationStatusIn", this.ModerationStatusIn);
			kparams.AddStringIfNotNull("tagsAndNameMultiLikeOr", this.TagsAndNameMultiLikeOr);
			kparams.AddStringIfNotNull("tagsAndAdminTagsMultiLikeOr", this.TagsAndAdminTagsMultiLikeOr);
			kparams.AddStringIfNotNull("tagsAndAdminTagsAndNameMultiLikeOr", this.TagsAndAdminTagsAndNameMultiLikeOr);
			kparams.AddStringIfNotNull("tagsAndNameMultiLikeAnd", this.TagsAndNameMultiLikeAnd);
			kparams.AddStringIfNotNull("tagsAndAdminTagsMultiLikeAnd", this.TagsAndAdminTagsMultiLikeAnd);
			kparams.AddStringIfNotNull("tagsAndAdminTagsAndNameMultiLikeAnd", this.TagsAndAdminTagsAndNameMultiLikeAnd);
			kparams.AddStringIfNotNull("searchTextMatchAnd", this.SearchTextMatchAnd);
			kparams.AddStringIfNotNull("searchTextMatchOr", this.SearchTextMatchOr);
			return kparams;
		}
		#endregion
	}
}

