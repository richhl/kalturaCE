using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaUiConfFilter : KalturaObjectBase
	{
		#region Properties
		public int Id = Int32.MinValue;
		public int IdGreaterThanEqual = Int32.MinValue;
		public int Status = Int32.MinValue;
		public string NameLike = null;
		public string TagsMultiLikeOr = null;
		public string CreatedAtGreaterThanEqual = null;
		public string CreatedAtLessThanEqual = null;
		public string UpdatedAtGreaterThanEqual = null;
		public string UpdatedAtLessThanEqual = null;
		#endregion

		#region CTor
		public KalturaUiConfFilter()
		{
		}

		public KalturaUiConfFilter(XmlElement node)
		{
			foreach (XmlElement propertyNode in node.ChildNodes)
			{
				string txt = propertyNode.InnerText;
				switch (propertyNode.Name)
				{
					case "id":
						this.Id = ParseInt(txt);
						continue;
					case "idGreaterThanEqual":
						this.IdGreaterThanEqual = ParseInt(txt);
						continue;
					case "status":
						this.Status = ParseInt(txt);
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
			kparams.AddIntIfNotNull("id", this.Id);
			kparams.AddIntIfNotNull("idGreaterThanEqual", this.IdGreaterThanEqual);
			kparams.AddIntIfNotNull("status", this.Status);
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

