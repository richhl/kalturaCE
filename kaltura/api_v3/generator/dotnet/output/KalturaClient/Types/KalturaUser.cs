using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaUser : KalturaObjectBase
	{
		#region Properties
		public string Id = null;
		public string ScreenName = null;
		public string FullName = null;
		public string Email = null;
		public string DateOfBirth = null;
		public string Country = null;
		public string State = null;
		public string City = null;
		public string Zip = null;
		public string UrlList = null;
		public string Picture = null;
		public int Icon = Int32.MinValue;
		public string AboutMe = null;
		public string Tags = null;
		public string MobileNum = null;
		public int Gender = Int32.MinValue;
		public int Views = Int32.MinValue;
		public int Fans = Int32.MinValue;
		public int Entries = Int32.MinValue;
		public int ProducedKshows = Int32.MinValue;
		public int Status = Int32.MinValue;
		public int CreatedAt = Int32.MinValue;
		public int UpdatedAt = Int32.MinValue;
		public int PartnerId = Int32.MinValue;
		public int DisplayInSearch = Int32.MinValue;
		public int PartnerData = Int32.MinValue;
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
						this.DateOfBirth = txt;
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
					case "urlList":
						this.UrlList = txt;
						continue;
					case "picture":
						this.Picture = txt;
						continue;
					case "icon":
						this.Icon = ParseInt(txt);
						continue;
					case "aboutMe":
						this.AboutMe = txt;
						continue;
					case "tags":
						this.Tags = txt;
						continue;
					case "mobileNum":
						this.MobileNum = txt;
						continue;
					case "gender":
						this.Gender = ParseInt(txt);
						continue;
					case "views":
						this.Views = ParseInt(txt);
						continue;
					case "fans":
						this.Fans = ParseInt(txt);
						continue;
					case "entries":
						this.Entries = ParseInt(txt);
						continue;
					case "producedKshows":
						this.ProducedKshows = ParseInt(txt);
						continue;
					case "status":
						this.Status = ParseInt(txt);
						continue;
					case "createdAt":
						this.CreatedAt = ParseInt(txt);
						continue;
					case "updatedAt":
						this.UpdatedAt = ParseInt(txt);
						continue;
					case "partnerId":
						this.PartnerId = ParseInt(txt);
						continue;
					case "displayInSearch":
						this.DisplayInSearch = ParseInt(txt);
						continue;
					case "partnerData":
						this.PartnerData = ParseInt(txt);
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
			kparams.AddStringIfNotNull("screenName", this.ScreenName);
			kparams.AddStringIfNotNull("fullName", this.FullName);
			kparams.AddStringIfNotNull("email", this.Email);
			kparams.AddStringIfNotNull("dateOfBirth", this.DateOfBirth);
			kparams.AddStringIfNotNull("country", this.Country);
			kparams.AddStringIfNotNull("state", this.State);
			kparams.AddStringIfNotNull("city", this.City);
			kparams.AddStringIfNotNull("zip", this.Zip);
			kparams.AddStringIfNotNull("urlList", this.UrlList);
			kparams.AddStringIfNotNull("picture", this.Picture);
			kparams.AddIntIfNotNull("icon", this.Icon);
			kparams.AddStringIfNotNull("aboutMe", this.AboutMe);
			kparams.AddStringIfNotNull("tags", this.Tags);
			kparams.AddStringIfNotNull("mobileNum", this.MobileNum);
			kparams.AddIntIfNotNull("gender", this.Gender);
			kparams.AddIntIfNotNull("views", this.Views);
			kparams.AddIntIfNotNull("fans", this.Fans);
			kparams.AddIntIfNotNull("entries", this.Entries);
			kparams.AddIntIfNotNull("producedKshows", this.ProducedKshows);
			kparams.AddIntIfNotNull("status", this.Status);
			kparams.AddIntIfNotNull("createdAt", this.CreatedAt);
			kparams.AddIntIfNotNull("updatedAt", this.UpdatedAt);
			kparams.AddIntIfNotNull("partnerId", this.PartnerId);
			kparams.AddIntIfNotNull("displayInSearch", this.DisplayInSearch);
			kparams.AddIntIfNotNull("partnerData", this.PartnerData);
			return kparams;
		}
		#endregion
	}
}

