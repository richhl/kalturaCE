using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaModerationFlag : KalturaObjectBase
	{
		#region Properties
		public int Id = Int32.MinValue;
		public int PartnerId = Int32.MinValue;
		public string UserId = null;
		public KalturaModerationObjectType ObjectType = (KalturaModerationObjectType)Int32.MinValue;
		public string FlaggedEntryId = null;
		public string FlaggedUserId = null;
		public KalturaModerationFlagStatus Status = (KalturaModerationFlagStatus)Int32.MinValue;
		public string Comments = null;
		public KalturaModerationFlagType FlagType = (KalturaModerationFlagType)Int32.MinValue;
		public int CreatedAt = Int32.MinValue;
		public int UpdatedAt = Int32.MinValue;
		#endregion

		#region CTor
		public KalturaModerationFlag()
		{
		}

		public KalturaModerationFlag(XmlElement node)
		{
			foreach (XmlElement propertyNode in node.ChildNodes)
			{
				string txt = propertyNode.InnerText;
				switch (propertyNode.Name)
				{
					case "id":
						this.Id = ParseInt(txt);
						continue;
					case "partnerId":
						this.PartnerId = ParseInt(txt);
						continue;
					case "userId":
						this.UserId = txt;
						continue;
					case "objectType":
						this.ObjectType = (KalturaModerationObjectType)ParseEnum(typeof(KalturaModerationObjectType), txt);
						continue;
					case "flaggedEntryId":
						this.FlaggedEntryId = txt;
						continue;
					case "flaggedUserId":
						this.FlaggedUserId = txt;
						continue;
					case "status":
						this.Status = (KalturaModerationFlagStatus)ParseEnum(typeof(KalturaModerationFlagStatus), txt);
						continue;
					case "comments":
						this.Comments = txt;
						continue;
					case "flagType":
						this.FlagType = (KalturaModerationFlagType)ParseEnum(typeof(KalturaModerationFlagType), txt);
						continue;
					case "createdAt":
						this.CreatedAt = ParseInt(txt);
						continue;
					case "updatedAt":
						this.UpdatedAt = ParseInt(txt);
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
			kparams.AddIntIfNotNull("partnerId", this.PartnerId);
			kparams.AddStringIfNotNull("userId", this.UserId);
			kparams.AddEnumIfNotNull("objectType", this.ObjectType);
			kparams.AddStringIfNotNull("flaggedEntryId", this.FlaggedEntryId);
			kparams.AddStringIfNotNull("flaggedUserId", this.FlaggedUserId);
			kparams.AddEnumIfNotNull("status", this.Status);
			kparams.AddStringIfNotNull("comments", this.Comments);
			kparams.AddEnumIfNotNull("flagType", this.FlagType);
			kparams.AddIntIfNotNull("createdAt", this.CreatedAt);
			kparams.AddIntIfNotNull("updatedAt", this.UpdatedAt);
			return kparams;
		}
		#endregion
	}
}

