using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaBaseEntry : KalturaObjectBase
	{
		#region Properties
		public string Id = null;
		public string Name = null;
		public string Description = null;
		public int PartnerId = Int32.MinValue;
		public string UserId = null;
		public string Tags = null;
		public string AdminTags = null;
		public KalturaEntryStatus Status = (KalturaEntryStatus)Int32.MinValue;
		public KalturaEntryType Type = (KalturaEntryType)Int32.MinValue;
		public int CreatedAt = Int32.MinValue;
		public int Rank = Int32.MinValue;
		public int TotalRank = Int32.MinValue;
		public int Votes = Int32.MinValue;
		public int GroupId = Int32.MinValue;
		public string PartnerData = null;
		public string DownloadUrl = null;
		public KalturaLicenseType LicenseType = (KalturaLicenseType)Int32.MinValue;
		#endregion

		#region CTor
		public KalturaBaseEntry()
		{
		}

		public KalturaBaseEntry(XmlElement node)
		{
			foreach (XmlElement propertyNode in node.ChildNodes)
			{
				string txt = propertyNode.InnerText;
				switch (propertyNode.Name)
				{
					case "id":
						this.Id = txt;
						continue;
					case "name":
						this.Name = txt;
						continue;
					case "description":
						this.Description = txt;
						continue;
					case "partnerId":
						this.PartnerId = ParseInt(txt);
						continue;
					case "userId":
						this.UserId = txt;
						continue;
					case "tags":
						this.Tags = txt;
						continue;
					case "adminTags":
						this.AdminTags = txt;
						continue;
					case "status":
						this.Status = (KalturaEntryStatus)ParseEnum(typeof(KalturaEntryStatus), txt);
						continue;
					case "type":
						this.Type = (KalturaEntryType)ParseEnum(typeof(KalturaEntryType), txt);
						continue;
					case "createdAt":
						this.CreatedAt = ParseInt(txt);
						continue;
					case "rank":
						this.Rank = ParseInt(txt);
						continue;
					case "totalRank":
						this.TotalRank = ParseInt(txt);
						continue;
					case "votes":
						this.Votes = ParseInt(txt);
						continue;
					case "groupId":
						this.GroupId = ParseInt(txt);
						continue;
					case "partnerData":
						this.PartnerData = txt;
						continue;
					case "downloadUrl":
						this.DownloadUrl = txt;
						continue;
					case "licenseType":
						this.LicenseType = (KalturaLicenseType)ParseEnum(typeof(KalturaLicenseType), txt);
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
			kparams.AddStringIfNotNull("name", this.Name);
			kparams.AddStringIfNotNull("description", this.Description);
			kparams.AddIntIfNotNull("partnerId", this.PartnerId);
			kparams.AddStringIfNotNull("userId", this.UserId);
			kparams.AddStringIfNotNull("tags", this.Tags);
			kparams.AddStringIfNotNull("adminTags", this.AdminTags);
			kparams.AddEnumIfNotNull("status", this.Status);
			kparams.AddEnumIfNotNull("type", this.Type);
			kparams.AddIntIfNotNull("createdAt", this.CreatedAt);
			kparams.AddIntIfNotNull("rank", this.Rank);
			kparams.AddIntIfNotNull("totalRank", this.TotalRank);
			kparams.AddIntIfNotNull("votes", this.Votes);
			kparams.AddIntIfNotNull("groupId", this.GroupId);
			kparams.AddStringIfNotNull("partnerData", this.PartnerData);
			kparams.AddStringIfNotNull("downloadUrl", this.DownloadUrl);
			kparams.AddEnumIfNotNull("licenseType", this.LicenseType);
			return kparams;
		}
		#endregion
	}
}

