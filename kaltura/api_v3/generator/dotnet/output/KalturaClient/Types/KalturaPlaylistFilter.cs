using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaPlaylistFilter : KalturaObjectBase
	{
		#region Properties
		public int IdGreaterThanEqual = Int32.MinValue;
		public int StatusEqual = Int32.MinValue;
		public string NameLike = null;
		public string TagsMultiLikeOr = null;
		public string CreatedAtGreaterThanEqual = null;
		public string CreatedAtLessThanEqual = null;
		public string UpdatedAtGreaterThanEqual = null;
		public string UpdatedAtLessThanEqual = null;
		#endregion

		#region CTor
		public KalturaPlaylistFilter()
		{
		}

		public KalturaPlaylistFilter(XmlElement node)
		{
			foreach (XmlElement propertyNode in node.ChildNodes)
			{
				string txt = propertyNode.InnerText;
				switch (propertyNode.Name)
				{
					case "idGreaterThanEqual":
						this.IdGreaterThanEqual = ParseInt(txt);
						continue;
					case "statusEqual":
						this.StatusEqual = ParseInt(txt);
						continue;
					case "nameLike":
						this.NameLike = txt;
						continue;
					case "tagsMultiLikeOr":
						this.TagsMultiLikeOr = txt;
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
			kparams.AddIntIfNotNull("idGreaterThanEqual", this.IdGreaterThanEqual);
			kparams.AddIntIfNotNull("statusEqual", this.StatusEqual);
			kparams.AddStringIfNotNull("nameLike", this.NameLike);
			kparams.AddStringIfNotNull("tagsMultiLikeOr", this.TagsMultiLikeOr);
			kparams.AddStringIfNotNull("createdAtGreaterThanEqual", this.CreatedAtGreaterThanEqual);
			kparams.AddStringIfNotNull("createdAtLessThanEqual", this.CreatedAtLessThanEqual);
			kparams.AddStringIfNotNull("updatedAtGreaterThanEqual", this.UpdatedAtGreaterThanEqual);
			kparams.AddStringIfNotNull("updatedAtLessThanEqual", this.UpdatedAtLessThanEqual);
			return kparams;
		}
		#endregion
	}
}

