using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaPartner : KalturaObjectBase
	{
		#region Properties
		public int Id = Int32.MinValue;
		public string Name = null;
		public string Website = null;
		public string NotificationUrl = null;
		public int AppearInSearch = Int32.MinValue;
		public string CreatedAt = null;
		public string AdminName = null;
		public string AdminEmail = null;
		public string Description = null;
		public string CommercialUse = null;
		public string LandingPage = null;
		public string UserLandingPage = null;
		public string ContentCategories = null;
		public int Type = Int32.MinValue;
		public string Phone = null;
		public string DescribeYourself = null;
		public bool AdultContent = false;
		public string DefConversionProfileType = null;
		public int Notify = Int32.MinValue;
		public int Status = Int32.MinValue;
		public int AllowQuickEdit = Int32.MinValue;
		public int MergeEntryLists = Int32.MinValue;
		public string NotificationsConfig = null;
		public int MaxUploadSize = Int32.MinValue;
		public int PartnerPackage = Int32.MinValue;
		public string Secret = null;
		public string AdminSecret = null;
		public string CmsPassword = null;
		#endregion

		#region CTor
		public KalturaPartner()
		{
		}

		public KalturaPartner(XmlElement node)
		{
			foreach (XmlElement propertyNode in node.ChildNodes)
			{
				string txt = propertyNode.InnerText;
				switch (propertyNode.Name)
				{
					case "id":
						this.Id = ParseInt(txt);
						continue;
					case "name":
						this.Name = txt;
						continue;
					case "website":
						this.Website = txt;
						continue;
					case "notificationUrl":
						this.NotificationUrl = txt;
						continue;
					case "appearInSearch":
						this.AppearInSearch = ParseInt(txt);
						continue;
					case "createdAt":
						this.CreatedAt = txt;
						continue;
					case "adminName":
						this.AdminName = txt;
						continue;
					case "adminEmail":
						this.AdminEmail = txt;
						continue;
					case "description":
						this.Description = txt;
						continue;
					case "commercialUse":
						this.CommercialUse = txt;
						continue;
					case "landingPage":
						this.LandingPage = txt;
						continue;
					case "userLandingPage":
						this.UserLandingPage = txt;
						continue;
					case "contentCategories":
						this.ContentCategories = txt;
						continue;
					case "type":
						this.Type = ParseInt(txt);
						continue;
					case "phone":
						this.Phone = txt;
						continue;
					case "describeYourself":
						this.DescribeYourself = txt;
						continue;
					case "adultContent":
						this.AdultContent = ParseBool(txt);
						continue;
					case "defConversionProfileType":
						this.DefConversionProfileType = txt;
						continue;
					case "notify":
						this.Notify = ParseInt(txt);
						continue;
					case "status":
						this.Status = ParseInt(txt);
						continue;
					case "allowQuickEdit":
						this.AllowQuickEdit = ParseInt(txt);
						continue;
					case "mergeEntryLists":
						this.MergeEntryLists = ParseInt(txt);
						continue;
					case "notificationsConfig":
						this.NotificationsConfig = txt;
						continue;
					case "maxUploadSize":
						this.MaxUploadSize = ParseInt(txt);
						continue;
					case "partnerPackage":
						this.PartnerPackage = ParseInt(txt);
						continue;
					case "secret":
						this.Secret = txt;
						continue;
					case "adminSecret":
						this.AdminSecret = txt;
						continue;
					case "cmsPassword":
						this.CmsPassword = txt;
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
			kparams.AddStringIfNotNull("name", this.Name);
			kparams.AddStringIfNotNull("website", this.Website);
			kparams.AddStringIfNotNull("notificationUrl", this.NotificationUrl);
			kparams.AddIntIfNotNull("appearInSearch", this.AppearInSearch);
			kparams.AddStringIfNotNull("createdAt", this.CreatedAt);
			kparams.AddStringIfNotNull("adminName", this.AdminName);
			kparams.AddStringIfNotNull("adminEmail", this.AdminEmail);
			kparams.AddStringIfNotNull("description", this.Description);
			kparams.AddStringIfNotNull("commercialUse", this.CommercialUse);
			kparams.AddStringIfNotNull("landingPage", this.LandingPage);
			kparams.AddStringIfNotNull("userLandingPage", this.UserLandingPage);
			kparams.AddStringIfNotNull("contentCategories", this.ContentCategories);
			kparams.AddIntIfNotNull("type", this.Type);
			kparams.AddStringIfNotNull("phone", this.Phone);
			kparams.AddStringIfNotNull("describeYourself", this.DescribeYourself);
			kparams.AddBoolIfNotNull("adultContent", this.AdultContent);
			kparams.AddStringIfNotNull("defConversionProfileType", this.DefConversionProfileType);
			kparams.AddIntIfNotNull("notify", this.Notify);
			kparams.AddIntIfNotNull("status", this.Status);
			kparams.AddIntIfNotNull("allowQuickEdit", this.AllowQuickEdit);
			kparams.AddIntIfNotNull("mergeEntryLists", this.MergeEntryLists);
			kparams.AddStringIfNotNull("notificationsConfig", this.NotificationsConfig);
			kparams.AddIntIfNotNull("maxUploadSize", this.MaxUploadSize);
			kparams.AddIntIfNotNull("partnerPackage", this.PartnerPackage);
			kparams.AddStringIfNotNull("secret", this.Secret);
			kparams.AddStringIfNotNull("adminSecret", this.AdminSecret);
			kparams.AddStringIfNotNull("cmsPassword", this.CmsPassword);
			return kparams;
		}
		#endregion
	}
}

