using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaUser : KalturaObjectBase
	{
		#region Properties
		public string Id = null;
		public int PartnerId = Int32.MinValue;
		public string ScreenName = null;
		public string FullName = null;
		public string Email = null;
		public int DateOfBirth = Int32.MinValue;
		public string Country = null;
		public string State = null;
		public string City = null;
		public string Zip = null;
		public string ThumbnailUrl = null;
		public string Description = null;
		public string Tags = null;
		public string AdminTags = null;
		public KalturaGender Gender = (KalturaGender)Int32.MinValue;
		public KalturaUserStatus Status = (KalturaUserStatus)Int32.MinValue;
		public int CreatedAt = Int32.MinValue;
		public int UpdatedAt = Int32.MinValue;
		public string PartnerData = null;
		public int IndexedPartnerDataInt = Int32.MinValue;
		public string IndexedPartnerDataString = null;
		public int StorageSize = Int32.MinValue;
		#endregion

		#region CTor
		public KalturaUser()
		{
		}

		public KalturaUser(XmlElement node)
		{
			foreach (XmlElement propertyNode in node.ChildNodes)
			{
				string txt = propertyNode.InnerText;
				switch (propertyNode.Name)
				{
					case "id":
						this.Id = txt;
						continue;
					case "partnerId":
						this.PartnerId = ParseInt(txt);
						continue;
					case "screenName":
						this.ScreenName = txt;
						continue;
					case "fullName":
						this.FullName = txt;
						continue;
					case "email":
						this.Email = txt;
						continue;
					case "dateOfBirth":
						this.DateOfBirth = ParseInt(txt);
						continue;
					case "country":
						this.Country = txt;
						continue;
					case "state":
						this.State = txt;
						continue;
					case "city":
						this.City = txt;
						continue;
					case "zip":
						this.Zip = txt;
						continue;
					case "thumbnailUrl":
						this.ThumbnailUrl = txt;
						continue;
					case "description":
						this.Description = txt;
						continue;
					case "tags":
						this.Tags = txt;
						continue;
					case "adminTags":
						this.AdminTags = txt;
						continue;
					case "gender":
						this.Gender = (KalturaGender)ParseEnum(typeof(KalturaGender), txt);
						continue;
					case "status":
						this.Status = (KalturaUserStatus)ParseEnum(typeof(KalturaUserStatus), txt);
						continue;
					case "createdAt":
						this.CreatedAt = ParseInt(txt);
						continue;
					case "updatedAt":
						this.UpdatedAt = ParseInt(txt);
						continue;
					case "partnerData":
						this.PartnerData = txt;
						continue;
					case "indexedPartnerDataInt":
						this.IndexedPartnerDataInt = ParseInt(txt);
						continue;
					case "indexedPartnerDataString":
						this.IndexedPartnerDataString = txt;
						continue;
					case "storageSize":
						this.StorageSize = ParseInt(txt);
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
			kparams.AddIntIfNotNull("partnerId", this.PartnerId);
			kparams.AddStringIfNotNull("screenName", this.ScreenName);
			kparams.AddStringIfNotNull("fullName", this.FullName);
			kparams.AddStringIfNotNull("email", this.Email);
			kparams.AddIntIfNotNull("dateOfBirth", this.DateOfBirth);
			kparams.AddStringIfNotNull("country", this.Country);
			kparams.AddStringIfNotNull("state", this.State);
			kparams.AddStringIfNotNull("city", this.City);
			kparams.AddStringIfNotNull("zip", this.Zip);
			kparams.AddStringIfNotNull("thumbnailUrl", this.ThumbnailUrl);
			kparams.AddStringIfNotNull("description", this.Description);
			kparams.AddStringIfNotNull("tags", this.Tags);
			kparams.AddStringIfNotNull("adminTags", this.AdminTags);
			kparams.AddEnumIfNotNull("gender", this.Gender);
			kparams.AddEnumIfNotNull("status", this.Status);
			kparams.AddIntIfNotNull("createdAt", this.CreatedAt);
			kparams.AddIntIfNotNull("updatedAt", this.UpdatedAt);
			kparams.AddStringIfNotNull("partnerData", this.PartnerData);
			kparams.AddIntIfNotNull("indexedPartnerDataInt", this.IndexedPartnerDataInt);
			kparams.AddStringIfNotNull("indexedPartnerDataString", this.IndexedPartnerDataString);
			kparams.AddIntIfNotNull("storageSize", this.StorageSize);
			return kparams;
		}
		#endregion
	}
}

