using System;
using System.Text;
using System.Collections.Generic;
using System.Collections.Specialized;
using System.Xml;

namespace Kaltura
{
	public enum KalturaEntryStatus
	{
		ERROR_CONVERTING = -1,
		IMPORT = 0,
		PRECONVERT = 1,
		READY = 2,
		DELETED = 3,
		PENDING = 4,
		MODERATE = 5,
		BLOCKED = 6,
	}

	public enum KalturaEntryType
	{
		MEDIA_CLIP = 1,
		MIX = 2,
		PLAYLIST = 5,
	}

	public enum KalturaLicenseType
	{
		UNKNOWN = -1,
		NONE = 0,
		CC25 = 1,
		CC3 = 2,
	}

	public enum KalturaMediaType
	{
		VIDEO = 1,
		IMAGE = 2,
		AUDIO = 5,
	}

	public enum KalturaSourceType
	{
		FILE = 1,
		WEBCAM = 2,
		URL = 5,
		SEARCH_PROVIDER = 6,
	}

	public enum KalturaSearchProviderType
	{
		FLICKR = 3,
		YOUTUBE = 4,
		MYSPACE = 7,
		PHOTOBUCKET = 8,
		JAMENDO = 9,
		CCMIXTER = 10,
		NYPL = 11,
		CURRENT = 12,
		MEDIA_COMMONS = 13,
		KALTURA = 20,
		KALTURA_USER_CLIPS = 21,
		ARCHIVE_ORG = 22,
		KALTURA_PARTNER = 23,
		METACAFE = 24,
		SEARCH_PROXY = 28,
	}

	public class KalturaMediaEntry : KalturaObjectBase
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
		public int Plays = Int32.MinValue;
		public int Views = Int32.MinValue;
		public int Width = Int32.MinValue;
		public int Height = Int32.MinValue;
		public string ThumbnailUrl = null;
		public int Duration = Int32.MinValue;
		public KalturaMediaType MediaType = (KalturaMediaType)Int32.MinValue;
		public string ConversionQuality = null;
		public KalturaSourceType SourceType = (KalturaSourceType)Int32.MinValue;
		public KalturaSearchProviderType SearchProviderType = (KalturaSearchProviderType)Int32.MinValue;
		public string SearchProviderId = null;
		public string CreditUserName = null;
		public string CreditUrl = null;
		public int MediaDate = Int32.MinValue;
		public string DataUrl = null;
		#endregion

		#region CTor
		public KalturaMediaEntry()
		{
		}

		public KalturaMediaEntry(XmlNode node)
		{
			foreach (XmlNode propertyNode in node.ChildNodes)
			{
				string txt = propertyNode.InnerText;
				switch (propertyNode.Value)
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
						this.PartnerId = int.Parse(txt);
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
						this.Status = (KalturaEntryStatus)Int32.Parse(txt);
						continue;
					case "type":
						this.Type = (KalturaEntryType)Int32.Parse(txt);
						continue;
					case "createdAt":
						this.CreatedAt = int.Parse(txt);
						continue;
					case "rank":
						this.Rank = int.Parse(txt);
						continue;
					case "totalRank":
						this.TotalRank = int.Parse(txt);
						continue;
					case "votes":
						this.Votes = int.Parse(txt);
						continue;
					case "groupId":
						this.GroupId = int.Parse(txt);
						continue;
					case "partnerData":
						this.PartnerData = txt;
						continue;
					case "downloadUrl":
						this.DownloadUrl = txt;
						continue;
					case "licenseType":
						this.LicenseType = (KalturaLicenseType)Int32.Parse(txt);
						continue;
					case "plays":
						this.Plays = int.Parse(txt);
						continue;
					case "views":
						this.Views = int.Parse(txt);
						continue;
					case "width":
						this.Width = int.Parse(txt);
						continue;
					case "height":
						this.Height = int.Parse(txt);
						continue;
					case "thumbnailUrl":
						this.ThumbnailUrl = txt;
						continue;
					case "duration":
						this.Duration = int.Parse(txt);
						continue;
					case "mediaType":
						this.MediaType = (KalturaMediaType)Int32.Parse(txt);
						continue;
					case "conversionQuality":
						this.ConversionQuality = txt;
						continue;
					case "sourceType":
						this.SourceType = (KalturaSourceType)Int32.Parse(txt);
						continue;
					case "searchProviderType":
						this.SearchProviderType = (KalturaSearchProviderType)Int32.Parse(txt);
						continue;
					case "searchProviderId":
						this.SearchProviderId = txt;
						continue;
					case "creditUserName":
						this.CreditUserName = txt;
						continue;
					case "creditUrl":
						this.CreditUrl = txt;
						continue;
					case "mediaDate":
						this.MediaDate = int.Parse(txt);
						continue;
					case "dataUrl":
						this.DataUrl = txt;
						continue;
				}
			}
		}
		#endregion

		#region Methods
		public KalturaParams ToParams()
		{
			KalturaParams kparams = new KalturaParams();
			this.AddStringIfNotNull(kparams, "id", this.Id);
			this.AddStringIfNotNull(kparams, "name", this.Name);
			this.AddStringIfNotNull(kparams, "description", this.Description);
			this.AddIntIfNotNull(kparams, "partnerId", this.PartnerId);
			this.AddStringIfNotNull(kparams, "userId", this.UserId);
			this.AddStringIfNotNull(kparams, "tags", this.Tags);
			this.AddStringIfNotNull(kparams, "adminTags", this.AdminTags);
			this.AddEnumIfNotNull(kparams, "status", this.Status);
			this.AddEnumIfNotNull(kparams, "type", this.Type);
			this.AddIntIfNotNull(kparams, "createdAt", this.CreatedAt);
			this.AddIntIfNotNull(kparams, "rank", this.Rank);
			this.AddIntIfNotNull(kparams, "totalRank", this.TotalRank);
			this.AddIntIfNotNull(kparams, "votes", this.Votes);
			this.AddIntIfNotNull(kparams, "groupId", this.GroupId);
			this.AddStringIfNotNull(kparams, "partnerData", this.PartnerData);
			this.AddStringIfNotNull(kparams, "downloadUrl", this.DownloadUrl);
			this.AddEnumIfNotNull(kparams, "licenseType", this.LicenseType);
			this.AddIntIfNotNull(kparams, "plays", this.Plays);
			this.AddIntIfNotNull(kparams, "views", this.Views);
			this.AddIntIfNotNull(kparams, "width", this.Width);
			this.AddIntIfNotNull(kparams, "height", this.Height);
			this.AddStringIfNotNull(kparams, "thumbnailUrl", this.ThumbnailUrl);
			this.AddIntIfNotNull(kparams, "duration", this.Duration);
			this.AddEnumIfNotNull(kparams, "mediaType", this.MediaType);
			this.AddStringIfNotNull(kparams, "conversionQuality", this.ConversionQuality);
			this.AddEnumIfNotNull(kparams, "sourceType", this.SourceType);
			this.AddEnumIfNotNull(kparams, "searchProviderType", this.SearchProviderType);
			this.AddStringIfNotNull(kparams, "searchProviderId", this.SearchProviderId);
			this.AddStringIfNotNull(kparams, "creditUserName", this.CreditUserName);
			this.AddStringIfNotNull(kparams, "creditUrl", this.CreditUrl);
			this.AddIntIfNotNull(kparams, "mediaDate", this.MediaDate);
			this.AddStringIfNotNull(kparams, "dataUrl", this.DataUrl);
			return kparams;
		}
		#endregion
	}

	public class KalturaSearchResult : KalturaObjectBase
	{
		#region Properties
		public string KeyWords = null;
		public KalturaSearchProviderType SearchSource = (KalturaSearchProviderType)Int32.MinValue;
		public KalturaMediaType MediaType = (KalturaMediaType)Int32.MinValue;
		public string ExtraData = null;
		public string Id = null;
		public string Title = null;
		public string ThumbUrl = null;
		public string Description = null;
		public string Tags = null;
		public string Url = null;
		public string SourceLink = null;
		public string Credit = null;
		public KalturaLicenseType LicenseType = (KalturaLicenseType)Int32.MinValue;
		#endregion

		#region CTor
		public KalturaSearchResult()
		{
		}

		public KalturaSearchResult(XmlNode node)
		{
			foreach (XmlNode propertyNode in node.ChildNodes)
			{
				string txt = propertyNode.InnerText;
				switch (propertyNode.Value)
				{
					case "keyWords":
						this.KeyWords = txt;
						continue;
					case "searchSource":
						this.SearchSource = (KalturaSearchProviderType)Int32.Parse(txt);
						continue;
					case "mediaType":
						this.MediaType = (KalturaMediaType)Int32.Parse(txt);
						continue;
					case "extraData":
						this.ExtraData = txt;
						continue;
					case "id":
						this.Id = txt;
						continue;
					case "title":
						this.Title = txt;
						continue;
					case "thumbUrl":
						this.ThumbUrl = txt;
						continue;
					case "description":
						this.Description = txt;
						continue;
					case "tags":
						this.Tags = txt;
						continue;
					case "url":
						this.Url = txt;
						continue;
					case "sourceLink":
						this.SourceLink = txt;
						continue;
					case "credit":
						this.Credit = txt;
						continue;
					case "licenseType":
						this.LicenseType = (KalturaLicenseType)Int32.Parse(txt);
						continue;
				}
			}
		}
		#endregion

		#region Methods
		public KalturaParams ToParams()
		{
			KalturaParams kparams = new KalturaParams();
			this.AddStringIfNotNull(kparams, "keyWords", this.KeyWords);
			this.AddEnumIfNotNull(kparams, "searchSource", this.SearchSource);
			this.AddEnumIfNotNull(kparams, "mediaType", this.MediaType);
			this.AddStringIfNotNull(kparams, "extraData", this.ExtraData);
			this.AddStringIfNotNull(kparams, "id", this.Id);
			this.AddStringIfNotNull(kparams, "title", this.Title);
			this.AddStringIfNotNull(kparams, "thumbUrl", this.ThumbUrl);
			this.AddStringIfNotNull(kparams, "description", this.Description);
			this.AddStringIfNotNull(kparams, "tags", this.Tags);
			this.AddStringIfNotNull(kparams, "url", this.Url);
			this.AddStringIfNotNull(kparams, "sourceLink", this.SourceLink);
			this.AddStringIfNotNull(kparams, "credit", this.Credit);
			this.AddEnumIfNotNull(kparams, "licenseType", this.LicenseType);
			return kparams;
		}
		#endregion
	}

	public enum KalturaEditorType
	{
		SIMPLE = 1,
		ADVANCED = 2,
	}

	public class KalturaMixEntry : KalturaObjectBase
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
		public int Plays = Int32.MinValue;
		public int Views = Int32.MinValue;
		public int Width = Int32.MinValue;
		public int Height = Int32.MinValue;
		public string ThumbnailUrl = null;
		public int Duration = Int32.MinValue;
		public bool HasRealThumbnail = false;
		public KalturaEditorType EditorType = (KalturaEditorType)Int32.MinValue;
		public string DataContent = null;
		public int Version = Int32.MinValue;
		#endregion

		#region CTor
		public KalturaMixEntry()
		{
		}

		public KalturaMixEntry(XmlNode node)
		{
			foreach (XmlNode propertyNode in node.ChildNodes)
			{
				string txt = propertyNode.InnerText;
				switch (propertyNode.Value)
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
						this.PartnerId = int.Parse(txt);
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
						this.Status = (KalturaEntryStatus)Int32.Parse(txt);
						continue;
					case "type":
						this.Type = (KalturaEntryType)Int32.Parse(txt);
						continue;
					case "createdAt":
						this.CreatedAt = int.Parse(txt);
						continue;
					case "rank":
						this.Rank = int.Parse(txt);
						continue;
					case "totalRank":
						this.TotalRank = int.Parse(txt);
						continue;
					case "votes":
						this.Votes = int.Parse(txt);
						continue;
					case "groupId":
						this.GroupId = int.Parse(txt);
						continue;
					case "partnerData":
						this.PartnerData = txt;
						continue;
					case "downloadUrl":
						this.DownloadUrl = txt;
						continue;
					case "licenseType":
						this.LicenseType = (KalturaLicenseType)Int32.Parse(txt);
						continue;
					case "plays":
						this.Plays = int.Parse(txt);
						continue;
					case "views":
						this.Views = int.Parse(txt);
						continue;
					case "width":
						this.Width = int.Parse(txt);
						continue;
					case "height":
						this.Height = int.Parse(txt);
						continue;
					case "thumbnailUrl":
						this.ThumbnailUrl = txt;
						continue;
					case "duration":
						this.Duration = int.Parse(txt);
						continue;
					case "hasRealThumbnail":
						this.HasRealThumbnail = bool.Parse(txt);
						continue;
					case "editorType":
						this.EditorType = (KalturaEditorType)Int32.Parse(txt);
						continue;
					case "dataContent":
						this.DataContent = txt;
						continue;
					case "version":
						this.Version = int.Parse(txt);
						continue;
				}
			}
		}
		#endregion

		#region Methods
		public KalturaParams ToParams()
		{
			KalturaParams kparams = new KalturaParams();
			this.AddStringIfNotNull(kparams, "id", this.Id);
			this.AddStringIfNotNull(kparams, "name", this.Name);
			this.AddStringIfNotNull(kparams, "description", this.Description);
			this.AddIntIfNotNull(kparams, "partnerId", this.PartnerId);
			this.AddStringIfNotNull(kparams, "userId", this.UserId);
			this.AddStringIfNotNull(kparams, "tags", this.Tags);
			this.AddStringIfNotNull(kparams, "adminTags", this.AdminTags);
			this.AddEnumIfNotNull(kparams, "status", this.Status);
			this.AddEnumIfNotNull(kparams, "type", this.Type);
			this.AddIntIfNotNull(kparams, "createdAt", this.CreatedAt);
			this.AddIntIfNotNull(kparams, "rank", this.Rank);
			this.AddIntIfNotNull(kparams, "totalRank", this.TotalRank);
			this.AddIntIfNotNull(kparams, "votes", this.Votes);
			this.AddIntIfNotNull(kparams, "groupId", this.GroupId);
			this.AddStringIfNotNull(kparams, "partnerData", this.PartnerData);
			this.AddStringIfNotNull(kparams, "downloadUrl", this.DownloadUrl);
			this.AddEnumIfNotNull(kparams, "licenseType", this.LicenseType);
			this.AddIntIfNotNull(kparams, "plays", this.Plays);
			this.AddIntIfNotNull(kparams, "views", this.Views);
			this.AddIntIfNotNull(kparams, "width", this.Width);
			this.AddIntIfNotNull(kparams, "height", this.Height);
			this.AddStringIfNotNull(kparams, "thumbnailUrl", this.ThumbnailUrl);
			this.AddIntIfNotNull(kparams, "duration", this.Duration);
			this.AddBoolIfNotNull(kparams, "hasRealThumbnail", this.HasRealThumbnail);
			this.AddEnumIfNotNull(kparams, "editorType", this.EditorType);
			this.AddStringIfNotNull(kparams, "dataContent", this.DataContent);
			this.AddIntIfNotNull(kparams, "version", this.Version);
			return kparams;
		}
		#endregion
	}

	public enum KalturaSessionType
	{
		USER = 0,
		ADMIN = 2,
	}

	public enum KalturaUiConfObjType
	{
		WIDGET = 1,
		CW = 2,
		EDITOR = 3,
		ADVANCED_EDITOR = 4,
		PLAYLIST = 5,
		APP_STUDIO = 6,
	}

	public enum KalturaUiConfCreationMode
	{
		WIZARD = 2,
		ADVANCED = 3,
	}

	public class KalturaUiConf : KalturaObjectBase
	{
		#region Properties
		public string Id = null;
		public string Name = null;
		public string Description = null;
		public int PartnerId = Int32.MinValue;
		public KalturaUiConfObjType ObjType = (KalturaUiConfObjType)Int32.MinValue;
		public string ObjTypeAsString = null;
		public int Width = Int32.MinValue;
		public int Height = Int32.MinValue;
		public string HtmlParams = null;
		public string SwfUrl = null;
		public string ConfFilePath = null;
		public string ConfFile = null;
		public string ConfVars = null;
		public bool UseCdn = false;
		public string Tags = null;
		public string SwfUrlVersion = null;
		public int CreatedAt = Int32.MinValue;
		public int UpdatedAt = Int32.MinValue;
		public KalturaUiConfCreationMode CreationMode = (KalturaUiConfCreationMode)Int32.MinValue;
		#endregion

		#region CTor
		public KalturaUiConf()
		{
		}

		public KalturaUiConf(XmlNode node)
		{
			foreach (XmlNode propertyNode in node.ChildNodes)
			{
				string txt = propertyNode.InnerText;
				switch (propertyNode.Value)
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
						this.PartnerId = int.Parse(txt);
						continue;
					case "objType":
						this.ObjType = (KalturaUiConfObjType)Int32.Parse(txt);
						continue;
					case "objTypeAsString":
						this.ObjTypeAsString = txt;
						continue;
					case "width":
						this.Width = int.Parse(txt);
						continue;
					case "height":
						this.Height = int.Parse(txt);
						continue;
					case "htmlParams":
						this.HtmlParams = txt;
						continue;
					case "swfUrl":
						this.SwfUrl = txt;
						continue;
					case "confFilePath":
						this.ConfFilePath = txt;
						continue;
					case "confFile":
						this.ConfFile = txt;
						continue;
					case "confVars":
						this.ConfVars = txt;
						continue;
					case "useCdn":
						this.UseCdn = bool.Parse(txt);
						continue;
					case "tags":
						this.Tags = txt;
						continue;
					case "swfUrlVersion":
						this.SwfUrlVersion = txt;
						continue;
					case "createdAt":
						this.CreatedAt = int.Parse(txt);
						continue;
					case "updatedAt":
						this.UpdatedAt = int.Parse(txt);
						continue;
					case "creationMode":
						this.CreationMode = (KalturaUiConfCreationMode)Int32.Parse(txt);
						continue;
				}
			}
		}
		#endregion

		#region Methods
		public KalturaParams ToParams()
		{
			KalturaParams kparams = new KalturaParams();
			this.AddStringIfNotNull(kparams, "id", this.Id);
			this.AddStringIfNotNull(kparams, "name", this.Name);
			this.AddStringIfNotNull(kparams, "description", this.Description);
			this.AddIntIfNotNull(kparams, "partnerId", this.PartnerId);
			this.AddEnumIfNotNull(kparams, "objType", this.ObjType);
			this.AddStringIfNotNull(kparams, "objTypeAsString", this.ObjTypeAsString);
			this.AddIntIfNotNull(kparams, "width", this.Width);
			this.AddIntIfNotNull(kparams, "height", this.Height);
			this.AddStringIfNotNull(kparams, "htmlParams", this.HtmlParams);
			this.AddStringIfNotNull(kparams, "swfUrl", this.SwfUrl);
			this.AddStringIfNotNull(kparams, "confFilePath", this.ConfFilePath);
			this.AddStringIfNotNull(kparams, "confFile", this.ConfFile);
			this.AddStringIfNotNull(kparams, "confVars", this.ConfVars);
			this.AddBoolIfNotNull(kparams, "useCdn", this.UseCdn);
			this.AddStringIfNotNull(kparams, "tags", this.Tags);
			this.AddStringIfNotNull(kparams, "swfUrlVersion", this.SwfUrlVersion);
			this.AddIntIfNotNull(kparams, "createdAt", this.CreatedAt);
			this.AddIntIfNotNull(kparams, "updatedAt", this.UpdatedAt);
			this.AddEnumIfNotNull(kparams, "creationMode", this.CreationMode);
			return kparams;
		}
		#endregion
	}

	public class KalturaUiConfFilter : KalturaObjectBase
	{
		#region Properties
		public int IdEqual = Int32.MinValue;
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

		public KalturaUiConfFilter(XmlNode node)
		{
			foreach (XmlNode propertyNode in node.ChildNodes)
			{
				string txt = propertyNode.InnerText;
				switch (propertyNode.Value)
				{
					case "idEqual":
						this.IdEqual = int.Parse(txt);
						continue;
					case "id":
						this.Id = int.Parse(txt);
						continue;
					case "idGreaterThanEqual":
						this.IdGreaterThanEqual = int.Parse(txt);
						continue;
					case "status":
						this.Status = int.Parse(txt);
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
		public KalturaParams ToParams()
		{
			KalturaParams kparams = new KalturaParams();
			this.AddIntIfNotNull(kparams, "idEqual", this.IdEqual);
			this.AddIntIfNotNull(kparams, "id", this.Id);
			this.AddIntIfNotNull(kparams, "idGreaterThanEqual", this.IdGreaterThanEqual);
			this.AddIntIfNotNull(kparams, "status", this.Status);
			this.AddStringIfNotNull(kparams, "nameLike", this.NameLike);
			this.AddStringIfNotNull(kparams, "tagsMultiLikeOr", this.TagsMultiLikeOr);
			this.AddStringIfNotNull(kparams, "createdAtGreaterThanEqual", this.CreatedAtGreaterThanEqual);
			this.AddStringIfNotNull(kparams, "createdAtLessThanEqual", this.CreatedAtLessThanEqual);
			this.AddStringIfNotNull(kparams, "updatedAtGreaterThanEqual", this.UpdatedAtGreaterThanEqual);
			this.AddStringIfNotNull(kparams, "updatedAtLessThanEqual", this.UpdatedAtLessThanEqual);
			return kparams;
		}
		#endregion
	}

	public class KalturaFilterPager : KalturaObjectBase
	{
		#region Properties
		public int PageSize = Int32.MinValue;
		public int PageIndex = Int32.MinValue;
		#endregion

		#region CTor
		public KalturaFilterPager()
		{
		}

		public KalturaFilterPager(XmlNode node)
		{
			foreach (XmlNode propertyNode in node.ChildNodes)
			{
				string txt = propertyNode.InnerText;
				switch (propertyNode.Value)
				{
					case "pageSize":
						this.PageSize = int.Parse(txt);
						continue;
					case "pageIndex":
						this.PageIndex = int.Parse(txt);
						continue;
				}
			}
		}
		#endregion

		#region Methods
		public KalturaParams ToParams()
		{
			KalturaParams kparams = new KalturaParams();
			this.AddIntIfNotNull(kparams, "pageSize", this.PageSize);
			this.AddIntIfNotNull(kparams, "pageIndex", this.PageIndex);
			return kparams;
		}
		#endregion
	}

	public enum KalturaPlaylistType
	{
		DYNAMIC = 10,
		STATIC_LIST = 3,
		EXTERNAL = 101,
	}

	public class KalturaPlaylist : KalturaObjectBase
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
		public string PlaylistContent = null;
		public KalturaPlaylistType PlaylistType = (KalturaPlaylistType)Int32.MinValue;
		public int Plays = Int32.MinValue;
		public int Views = Int32.MinValue;
		public int Duration = Int32.MinValue;
		public string Version = null;
		#endregion

		#region CTor
		public KalturaPlaylist()
		{
		}

		public KalturaPlaylist(XmlNode node)
		{
			foreach (XmlNode propertyNode in node.ChildNodes)
			{
				string txt = propertyNode.InnerText;
				switch (propertyNode.Value)
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
						this.PartnerId = int.Parse(txt);
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
						this.Status = (KalturaEntryStatus)Int32.Parse(txt);
						continue;
					case "type":
						this.Type = (KalturaEntryType)Int32.Parse(txt);
						continue;
					case "createdAt":
						this.CreatedAt = int.Parse(txt);
						continue;
					case "rank":
						this.Rank = int.Parse(txt);
						continue;
					case "totalRank":
						this.TotalRank = int.Parse(txt);
						continue;
					case "votes":
						this.Votes = int.Parse(txt);
						continue;
					case "groupId":
						this.GroupId = int.Parse(txt);
						continue;
					case "partnerData":
						this.PartnerData = txt;
						continue;
					case "downloadUrl":
						this.DownloadUrl = txt;
						continue;
					case "licenseType":
						this.LicenseType = (KalturaLicenseType)Int32.Parse(txt);
						continue;
					case "playlistContent":
						this.PlaylistContent = txt;
						continue;
					case "playlistType":
						this.PlaylistType = (KalturaPlaylistType)Int32.Parse(txt);
						continue;
					case "plays":
						this.Plays = int.Parse(txt);
						continue;
					case "views":
						this.Views = int.Parse(txt);
						continue;
					case "duration":
						this.Duration = int.Parse(txt);
						continue;
					case "version":
						this.Version = txt;
						continue;
				}
			}
		}
		#endregion

		#region Methods
		public KalturaParams ToParams()
		{
			KalturaParams kparams = new KalturaParams();
			this.AddStringIfNotNull(kparams, "id", this.Id);
			this.AddStringIfNotNull(kparams, "name", this.Name);
			this.AddStringIfNotNull(kparams, "description", this.Description);
			this.AddIntIfNotNull(kparams, "partnerId", this.PartnerId);
			this.AddStringIfNotNull(kparams, "userId", this.UserId);
			this.AddStringIfNotNull(kparams, "tags", this.Tags);
			this.AddStringIfNotNull(kparams, "adminTags", this.AdminTags);
			this.AddEnumIfNotNull(kparams, "status", this.Status);
			this.AddEnumIfNotNull(kparams, "type", this.Type);
			this.AddIntIfNotNull(kparams, "createdAt", this.CreatedAt);
			this.AddIntIfNotNull(kparams, "rank", this.Rank);
			this.AddIntIfNotNull(kparams, "totalRank", this.TotalRank);
			this.AddIntIfNotNull(kparams, "votes", this.Votes);
			this.AddIntIfNotNull(kparams, "groupId", this.GroupId);
			this.AddStringIfNotNull(kparams, "partnerData", this.PartnerData);
			this.AddStringIfNotNull(kparams, "downloadUrl", this.DownloadUrl);
			this.AddEnumIfNotNull(kparams, "licenseType", this.LicenseType);
			this.AddStringIfNotNull(kparams, "playlistContent", this.PlaylistContent);
			this.AddEnumIfNotNull(kparams, "playlistType", this.PlaylistType);
			this.AddIntIfNotNull(kparams, "plays", this.Plays);
			this.AddIntIfNotNull(kparams, "views", this.Views);
			this.AddIntIfNotNull(kparams, "duration", this.Duration);
			this.AddStringIfNotNull(kparams, "version", this.Version);
			return kparams;
		}
		#endregion
	}

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
		public string Tagline = null;
		public string NetworkHighschool = null;
		public string NetworkCollege = null;
		public string NetworkOther = null;
		public string MobileNum = null;
		public int MatureContent = Int32.MinValue;
		public int Gender = Int32.MinValue;
		public int RegistrationIp = Int32.MinValue;
		public int RegistrationCookie = Int32.MinValue;
		public int ImList = Int32.MinValue;
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

		public KalturaUser(XmlNode node)
		{
			foreach (XmlNode propertyNode in node.ChildNodes)
			{
				string txt = propertyNode.InnerText;
				switch (propertyNode.Value)
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
						this.Icon = int.Parse(txt);
						continue;
					case "aboutMe":
						this.AboutMe = txt;
						continue;
					case "tags":
						this.Tags = txt;
						continue;
					case "tagline":
						this.Tagline = txt;
						continue;
					case "networkHighschool":
						this.NetworkHighschool = txt;
						continue;
					case "networkCollege":
						this.NetworkCollege = txt;
						continue;
					case "networkOther":
						this.NetworkOther = txt;
						continue;
					case "mobileNum":
						this.MobileNum = txt;
						continue;
					case "matureContent":
						this.MatureContent = int.Parse(txt);
						continue;
					case "gender":
						this.Gender = int.Parse(txt);
						continue;
					case "registrationIp":
						this.RegistrationIp = int.Parse(txt);
						continue;
					case "registrationCookie":
						this.RegistrationCookie = int.Parse(txt);
						continue;
					case "imList":
						this.ImList = int.Parse(txt);
						continue;
					case "views":
						this.Views = int.Parse(txt);
						continue;
					case "fans":
						this.Fans = int.Parse(txt);
						continue;
					case "entries":
						this.Entries = int.Parse(txt);
						continue;
					case "producedKshows":
						this.ProducedKshows = int.Parse(txt);
						continue;
					case "status":
						this.Status = int.Parse(txt);
						continue;
					case "createdAt":
						this.CreatedAt = int.Parse(txt);
						continue;
					case "updatedAt":
						this.UpdatedAt = int.Parse(txt);
						continue;
					case "partnerId":
						this.PartnerId = int.Parse(txt);
						continue;
					case "displayInSearch":
						this.DisplayInSearch = int.Parse(txt);
						continue;
					case "partnerData":
						this.PartnerData = int.Parse(txt);
						continue;
				}
			}
		}
		#endregion

		#region Methods
		public KalturaParams ToParams()
		{
			KalturaParams kparams = new KalturaParams();
			this.AddStringIfNotNull(kparams, "id", this.Id);
			this.AddStringIfNotNull(kparams, "screenName", this.ScreenName);
			this.AddStringIfNotNull(kparams, "fullName", this.FullName);
			this.AddStringIfNotNull(kparams, "email", this.Email);
			this.AddStringIfNotNull(kparams, "dateOfBirth", this.DateOfBirth);
			this.AddStringIfNotNull(kparams, "country", this.Country);
			this.AddStringIfNotNull(kparams, "state", this.State);
			this.AddStringIfNotNull(kparams, "city", this.City);
			this.AddStringIfNotNull(kparams, "zip", this.Zip);
			this.AddStringIfNotNull(kparams, "urlList", this.UrlList);
			this.AddStringIfNotNull(kparams, "picture", this.Picture);
			this.AddIntIfNotNull(kparams, "icon", this.Icon);
			this.AddStringIfNotNull(kparams, "aboutMe", this.AboutMe);
			this.AddStringIfNotNull(kparams, "tags", this.Tags);
			this.AddStringIfNotNull(kparams, "tagline", this.Tagline);
			this.AddStringIfNotNull(kparams, "networkHighschool", this.NetworkHighschool);
			this.AddStringIfNotNull(kparams, "networkCollege", this.NetworkCollege);
			this.AddStringIfNotNull(kparams, "networkOther", this.NetworkOther);
			this.AddStringIfNotNull(kparams, "mobileNum", this.MobileNum);
			this.AddIntIfNotNull(kparams, "matureContent", this.MatureContent);
			this.AddIntIfNotNull(kparams, "gender", this.Gender);
			this.AddIntIfNotNull(kparams, "registrationIp", this.RegistrationIp);
			this.AddIntIfNotNull(kparams, "registrationCookie", this.RegistrationCookie);
			this.AddIntIfNotNull(kparams, "imList", this.ImList);
			this.AddIntIfNotNull(kparams, "views", this.Views);
			this.AddIntIfNotNull(kparams, "fans", this.Fans);
			this.AddIntIfNotNull(kparams, "entries", this.Entries);
			this.AddIntIfNotNull(kparams, "producedKshows", this.ProducedKshows);
			this.AddIntIfNotNull(kparams, "status", this.Status);
			this.AddIntIfNotNull(kparams, "createdAt", this.CreatedAt);
			this.AddIntIfNotNull(kparams, "updatedAt", this.UpdatedAt);
			this.AddIntIfNotNull(kparams, "partnerId", this.PartnerId);
			this.AddIntIfNotNull(kparams, "displayInSearch", this.DisplayInSearch);
			this.AddIntIfNotNull(kparams, "partnerData", this.PartnerData);
			return kparams;
		}
		#endregion
	}

	public class KalturaUserFilter : KalturaObjectBase
	{
		#region Properties
		public int IdEqual = Int32.MinValue;
		public int Id = Int32.MinValue;
		public int IdGreaterThanEqual = Int32.MinValue;
		public int Status = Int32.MinValue;
		public string ScreenNameLike = null;
		public string TagsMultiLikeOr = null;
		public string CreatedAtGreaterThanEqual = null;
		public string CreatedAtLessThanEqual = null;
		public string UpdatedAtGreaterThanEqual = null;
		public string UpdatedAtLessThanEqual = null;
		#endregion

		#region CTor
		public KalturaUserFilter()
		{
		}

		public KalturaUserFilter(XmlNode node)
		{
			foreach (XmlNode propertyNode in node.ChildNodes)
			{
				string txt = propertyNode.InnerText;
				switch (propertyNode.Value)
				{
					case "idEqual":
						this.IdEqual = int.Parse(txt);
						continue;
					case "id":
						this.Id = int.Parse(txt);
						continue;
					case "idGreaterThanEqual":
						this.IdGreaterThanEqual = int.Parse(txt);
						continue;
					case "status":
						this.Status = int.Parse(txt);
						continue;
					case "screenNameLike":
						this.ScreenNameLike = txt;
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
		public KalturaParams ToParams()
		{
			KalturaParams kparams = new KalturaParams();
			this.AddIntIfNotNull(kparams, "idEqual", this.IdEqual);
			this.AddIntIfNotNull(kparams, "id", this.Id);
			this.AddIntIfNotNull(kparams, "idGreaterThanEqual", this.IdGreaterThanEqual);
			this.AddIntIfNotNull(kparams, "status", this.Status);
			this.AddStringIfNotNull(kparams, "screenNameLike", this.ScreenNameLike);
			this.AddStringIfNotNull(kparams, "tagsMultiLikeOr", this.TagsMultiLikeOr);
			this.AddStringIfNotNull(kparams, "createdAtGreaterThanEqual", this.CreatedAtGreaterThanEqual);
			this.AddStringIfNotNull(kparams, "createdAtLessThanEqual", this.CreatedAtLessThanEqual);
			this.AddStringIfNotNull(kparams, "updatedAtGreaterThanEqual", this.UpdatedAtGreaterThanEqual);
			this.AddStringIfNotNull(kparams, "updatedAtLessThanEqual", this.UpdatedAtLessThanEqual);
			return kparams;
		}
		#endregion
	}

	public enum KalturaWidgetSecurityType
	{
		NONE = 1,
		TIMEHASH = 2,
	}

	public class KalturaWidget : KalturaObjectBase
	{
		#region Properties
		public string Id = null;
		public string SourceWidgetId = null;
		public string RootWidgetId = null;
		public int PartnerId = Int32.MinValue;
		public string KshowId = null;
		public string EntryId = null;
		public int UiConfId = Int32.MinValue;
		public KalturaWidgetSecurityType SecurityType = (KalturaWidgetSecurityType)Int32.MinValue;
		public int SecurityPolicy = Int32.MinValue;
		public int CreatedAt = Int32.MinValue;
		public int UpdatedAt = Int32.MinValue;
		public string PartnerData = null;
		public string WidgetHTML = null;
		#endregion

		#region CTor
		public KalturaWidget()
		{
		}

		public KalturaWidget(XmlNode node)
		{
			foreach (XmlNode propertyNode in node.ChildNodes)
			{
				string txt = propertyNode.InnerText;
				switch (propertyNode.Value)
				{
					case "id":
						this.Id = txt;
						continue;
					case "sourceWidgetId":
						this.SourceWidgetId = txt;
						continue;
					case "rootWidgetId":
						this.RootWidgetId = txt;
						continue;
					case "partnerId":
						this.PartnerId = int.Parse(txt);
						continue;
					case "kshowId":
						this.KshowId = txt;
						continue;
					case "entryId":
						this.EntryId = txt;
						continue;
					case "uiConfId":
						this.UiConfId = int.Parse(txt);
						continue;
					case "securityType":
						this.SecurityType = (KalturaWidgetSecurityType)Int32.Parse(txt);
						continue;
					case "securityPolicy":
						this.SecurityPolicy = int.Parse(txt);
						continue;
					case "createdAt":
						this.CreatedAt = int.Parse(txt);
						continue;
					case "updatedAt":
						this.UpdatedAt = int.Parse(txt);
						continue;
					case "partnerData":
						this.PartnerData = txt;
						continue;
					case "widgetHTML":
						this.WidgetHTML = txt;
						continue;
				}
			}
		}
		#endregion

		#region Methods
		public KalturaParams ToParams()
		{
			KalturaParams kparams = new KalturaParams();
			this.AddStringIfNotNull(kparams, "id", this.Id);
			this.AddStringIfNotNull(kparams, "sourceWidgetId", this.SourceWidgetId);
			this.AddStringIfNotNull(kparams, "rootWidgetId", this.RootWidgetId);
			this.AddIntIfNotNull(kparams, "partnerId", this.PartnerId);
			this.AddStringIfNotNull(kparams, "kshowId", this.KshowId);
			this.AddStringIfNotNull(kparams, "entryId", this.EntryId);
			this.AddIntIfNotNull(kparams, "uiConfId", this.UiConfId);
			this.AddEnumIfNotNull(kparams, "securityType", this.SecurityType);
			this.AddIntIfNotNull(kparams, "securityPolicy", this.SecurityPolicy);
			this.AddIntIfNotNull(kparams, "createdAt", this.CreatedAt);
			this.AddIntIfNotNull(kparams, "updatedAt", this.UpdatedAt);
			this.AddStringIfNotNull(kparams, "partnerData", this.PartnerData);
			this.AddStringIfNotNull(kparams, "widgetHTML", this.WidgetHTML);
			return kparams;
		}
		#endregion
	}

	public class KalturaSearch : KalturaObjectBase
	{
		#region Properties
		public string KeyWords = null;
		public KalturaSearchProviderType SearchSource = (KalturaSearchProviderType)Int32.MinValue;
		public KalturaMediaType MediaType = (KalturaMediaType)Int32.MinValue;
		public string ExtraData = null;
		#endregion

		#region CTor
		public KalturaSearch()
		{
		}

		public KalturaSearch(XmlNode node)
		{
			foreach (XmlNode propertyNode in node.ChildNodes)
			{
				string txt = propertyNode.InnerText;
				switch (propertyNode.Value)
				{
					case "keyWords":
						this.KeyWords = txt;
						continue;
					case "searchSource":
						this.SearchSource = (KalturaSearchProviderType)Int32.Parse(txt);
						continue;
					case "mediaType":
						this.MediaType = (KalturaMediaType)Int32.Parse(txt);
						continue;
					case "extraData":
						this.ExtraData = txt;
						continue;
				}
			}
		}
		#endregion

		#region Methods
		public KalturaParams ToParams()
		{
			KalturaParams kparams = new KalturaParams();
			this.AddStringIfNotNull(kparams, "keyWords", this.KeyWords);
			this.AddEnumIfNotNull(kparams, "searchSource", this.SearchSource);
			this.AddEnumIfNotNull(kparams, "mediaType", this.MediaType);
			this.AddStringIfNotNull(kparams, "extraData", this.ExtraData);
			return kparams;
		}
		#endregion
	}

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

		public KalturaPartner(XmlNode node)
		{
			foreach (XmlNode propertyNode in node.ChildNodes)
			{
				string txt = propertyNode.InnerText;
				switch (propertyNode.Value)
				{
					case "id":
						this.Id = int.Parse(txt);
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
						this.AppearInSearch = int.Parse(txt);
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
						this.Type = int.Parse(txt);
						continue;
					case "phone":
						this.Phone = txt;
						continue;
					case "describeYourself":
						this.DescribeYourself = txt;
						continue;
					case "adultContent":
						this.AdultContent = bool.Parse(txt);
						continue;
					case "defConversionProfileType":
						this.DefConversionProfileType = txt;
						continue;
					case "notify":
						this.Notify = int.Parse(txt);
						continue;
					case "status":
						this.Status = int.Parse(txt);
						continue;
					case "allowQuickEdit":
						this.AllowQuickEdit = int.Parse(txt);
						continue;
					case "mergeEntryLists":
						this.MergeEntryLists = int.Parse(txt);
						continue;
					case "notificationsConfig":
						this.NotificationsConfig = txt;
						continue;
					case "maxUploadSize":
						this.MaxUploadSize = int.Parse(txt);
						continue;
					case "partnerPackage":
						this.PartnerPackage = int.Parse(txt);
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
		public KalturaParams ToParams()
		{
			KalturaParams kparams = new KalturaParams();
			this.AddIntIfNotNull(kparams, "id", this.Id);
			this.AddStringIfNotNull(kparams, "name", this.Name);
			this.AddStringIfNotNull(kparams, "website", this.Website);
			this.AddStringIfNotNull(kparams, "notificationUrl", this.NotificationUrl);
			this.AddIntIfNotNull(kparams, "appearInSearch", this.AppearInSearch);
			this.AddStringIfNotNull(kparams, "createdAt", this.CreatedAt);
			this.AddStringIfNotNull(kparams, "adminName", this.AdminName);
			this.AddStringIfNotNull(kparams, "adminEmail", this.AdminEmail);
			this.AddStringIfNotNull(kparams, "description", this.Description);
			this.AddStringIfNotNull(kparams, "commercialUse", this.CommercialUse);
			this.AddStringIfNotNull(kparams, "landingPage", this.LandingPage);
			this.AddStringIfNotNull(kparams, "userLandingPage", this.UserLandingPage);
			this.AddStringIfNotNull(kparams, "contentCategories", this.ContentCategories);
			this.AddIntIfNotNull(kparams, "type", this.Type);
			this.AddStringIfNotNull(kparams, "phone", this.Phone);
			this.AddStringIfNotNull(kparams, "describeYourself", this.DescribeYourself);
			this.AddBoolIfNotNull(kparams, "adultContent", this.AdultContent);
			this.AddStringIfNotNull(kparams, "defConversionProfileType", this.DefConversionProfileType);
			this.AddIntIfNotNull(kparams, "notify", this.Notify);
			this.AddIntIfNotNull(kparams, "status", this.Status);
			this.AddIntIfNotNull(kparams, "allowQuickEdit", this.AllowQuickEdit);
			this.AddIntIfNotNull(kparams, "mergeEntryLists", this.MergeEntryLists);
			this.AddStringIfNotNull(kparams, "notificationsConfig", this.NotificationsConfig);
			this.AddIntIfNotNull(kparams, "maxUploadSize", this.MaxUploadSize);
			this.AddIntIfNotNull(kparams, "partnerPackage", this.PartnerPackage);
			this.AddStringIfNotNull(kparams, "secret", this.Secret);
			this.AddStringIfNotNull(kparams, "adminSecret", this.AdminSecret);
			this.AddStringIfNotNull(kparams, "cmsPassword", this.CmsPassword);
			return kparams;
		}
		#endregion
	}

	public class KalturaAdminUser : KalturaObjectBase
	{
		#region Properties
		public string Password = null;
		public string Email = null;
		public string ScreenName = null;
		#endregion

		#region CTor
		public KalturaAdminUser()
		{
		}

		public KalturaAdminUser(XmlNode node)
		{
			foreach (XmlNode propertyNode in node.ChildNodes)
			{
				string txt = propertyNode.InnerText;
				switch (propertyNode.Value)
				{
					case "password":
						this.Password = txt;
						continue;
					case "email":
						this.Email = txt;
						continue;
					case "screenName":
						this.ScreenName = txt;
						continue;
				}
			}
		}
		#endregion

		#region Methods
		public KalturaParams ToParams()
		{
			KalturaParams kparams = new KalturaParams();
			this.AddStringIfNotNull(kparams, "password", this.Password);
			this.AddStringIfNotNull(kparams, "email", this.Email);
			this.AddStringIfNotNull(kparams, "screenName", this.ScreenName);
			return kparams;
		}
		#endregion
	}

	public class KalturaAdminLoginResponse : KalturaObjectBase
	{
		#region Properties
		public int PartnerId = Int32.MinValue;
		public int SubpId = Int32.MinValue;
		public string Ks = null;
		public string Uid = null;
		public KalturaAdminUser AdminUser;
		#endregion

		#region CTor
		public KalturaAdminLoginResponse()
		{
		}

		public KalturaAdminLoginResponse(XmlNode node)
		{
			foreach (XmlNode propertyNode in node.ChildNodes)
			{
				string txt = propertyNode.InnerText;
				switch (propertyNode.Value)
				{
					case "partnerId":
						this.PartnerId = int.Parse(txt);
						continue;
					case "subpId":
						this.SubpId = int.Parse(txt);
						continue;
					case "ks":
						this.Ks = txt;
						continue;
					case "uid":
						this.Uid = txt;
						continue;
					case "adminUser":
						continue;
				}
			}
		}
		#endregion

		#region Methods
		public KalturaParams ToParams()
		{
			KalturaParams kparams = new KalturaParams();
			this.AddIntIfNotNull(kparams, "partnerId", this.PartnerId);
			this.AddIntIfNotNull(kparams, "subpId", this.SubpId);
			this.AddStringIfNotNull(kparams, "ks", this.Ks);
			this.AddStringIfNotNull(kparams, "uid", this.Uid);
			return kparams;
		}
		#endregion
	}

	public class KalturaClient : KalturaClientBase
	{
		public KalturaClient(KalturaConfiguration config) : base(config)
		{
		}

		KalturaMediaService _MediaService;
		public KalturaMediaService MediaService
		{
			get
			{
				if (_MediaService == null)
					_MediaService = new KalturaMediaService(this);

				return _MediaService;
			}
		}

		public class KalturaMediaService : KalturaServiceBase
		{
			public KalturaMediaService(KalturaClient _Client)
				: base(_Client)
			{
			}

			public KalturaMediaEntry AddFromUrl(KalturaMediaEntry mediaEntry, string url)
			{
				KalturaParams kparams = new KalturaParams();
				kparams.Add("mediaEntry", mediaEntry.ToParams());
				kparams.Add("url", url);
				XmlNode result = _Client.CallService("media", "addFromUrl", kparams);
				_Client.ValidateObjectType(result, "KalturaMediaEntry");
				return new KalturaMediaEntry(result.ChildNodes[0]);
			}

			public KalturaMediaEntry AddFromSearchResult(KalturaMediaEntry mediaEntry = null, KalturaSearchResult searchResult)
			{
				KalturaParams kparams = new KalturaParams();
				kparams.Add("mediaEntry", mediaEntry.ToParams());
				kparams.Add("searchResult", searchResult.ToParams());
				XmlNode result = _Client.CallService("media", "addFromSearchResult", kparams);
				_Client.ValidateObjectType(result, "KalturaMediaEntry");
				return new KalturaMediaEntry(result.ChildNodes[0]);
			}

			public KalturaMediaEntry AddFromUploadedFile(KalturaMediaEntry mediaEntry, string uploadTokenId)
			{
				KalturaParams kparams = new KalturaParams();
				kparams.Add("mediaEntry", mediaEntry.ToParams());
				kparams.Add("uploadTokenId", uploadTokenId);
				XmlNode result = _Client.CallService("media", "addFromUploadedFile", kparams);
				_Client.ValidateObjectType(result, "KalturaMediaEntry");
				return new KalturaMediaEntry(result.ChildNodes[0]);
			}

			public KalturaMediaEntry Get(string entryId)
			{
				KalturaParams kparams = new KalturaParams();
				kparams.Add("entryId", entryId);
				XmlNode result = _Client.CallService("media", "get", kparams);
				_Client.ValidateObjectType(result, "KalturaMediaEntry");
				return new KalturaMediaEntry(result.ChildNodes[0]);
			}

			public KalturaMediaEntry Update(string entryId, KalturaMediaEntry mediaEntry)
			{
				KalturaParams kparams = new KalturaParams();
				kparams.Add("entryId", entryId);
				kparams.Add("mediaEntry", mediaEntry.ToParams());
				XmlNode result = _Client.CallService("media", "update", kparams);
				_Client.ValidateObjectType(result, "KalturaMediaEntry");
				return new KalturaMediaEntry(result.ChildNodes[0]);
			}

			public void Delete(string entryId)
			{
				KalturaParams kparams = new KalturaParams();
				kparams.Add("entryId", entryId);
				XmlNode result = _Client.CallService("media", "delete", kparams);
			}

			public IList<KalturaMediaEntry> List()
			{
				KalturaParams kparams = new KalturaParams();
				XmlNode result = _Client.CallService("media", "list", kparams);
				_Client.ValidateArrayType(result, "KalturaMediaEntry");
				IList<KalturaMediaEntry> list = new List<KalturaMediaEntry>();
				foreach(XmlNode node in result.ChildNodes)
				{
					list.Add(new KalturaMediaEntry(node.ChildNodes[0]));
				}
				return list;
			}

			public KalturaMediaEntry UpdateThumbnail(string entryId, int timeOffset)
			{
				KalturaParams kparams = new KalturaParams();
				kparams.Add("entryId", entryId);
				kparams.Add("timeOffset", timeOffset.ToString());
				XmlNode result = _Client.CallService("media", "updateThumbnail", kparams);
				_Client.ValidateObjectType(result, "KalturaMediaEntry");
				return new KalturaMediaEntry(result.ChildNodes[0]);
			}
		}

		KalturaMixingService _MixingService;
		public KalturaMixingService MixingService
		{
			get
			{
				if (_MixingService == null)
					_MixingService = new KalturaMixingService(this);

				return _MixingService;
			}
		}

		public class KalturaMixingService : KalturaServiceBase
		{
			public KalturaMixingService(KalturaClient _Client)
				: base(_Client)
			{
			}

			public KalturaMixEntry Add(KalturaMixEntry mixEntry)
			{
				KalturaParams kparams = new KalturaParams();
				kparams.Add("mixEntry", mixEntry.ToParams());
				XmlNode result = _Client.CallService("mixing", "add", kparams);
				_Client.ValidateObjectType(result, "KalturaMixEntry");
				return new KalturaMixEntry(result.ChildNodes[0]);
			}

			public KalturaMixEntry Get(string entryId)
			{
				KalturaParams kparams = new KalturaParams();
				kparams.Add("entryId", entryId);
				XmlNode result = _Client.CallService("mixing", "get", kparams);
				_Client.ValidateObjectType(result, "KalturaMixEntry");
				return new KalturaMixEntry(result.ChildNodes[0]);
			}

			public KalturaMixEntry Update(string entryId, KalturaMixEntry mixEntry)
			{
				KalturaParams kparams = new KalturaParams();
				kparams.Add("entryId", entryId);
				kparams.Add("mixEntry", mixEntry.ToParams());
				XmlNode result = _Client.CallService("mixing", "update", kparams);
				_Client.ValidateObjectType(result, "KalturaMixEntry");
				return new KalturaMixEntry(result.ChildNodes[0]);
			}

			public void Delete(string entryId)
			{
				KalturaParams kparams = new KalturaParams();
				kparams.Add("entryId", entryId);
				XmlNode result = _Client.CallService("mixing", "delete", kparams);
			}

			public void Clone(string entryId)
			{
				KalturaParams kparams = new KalturaParams();
				kparams.Add("entryId", entryId);
				XmlNode result = _Client.CallService("mixing", "clone", kparams);
			}

			public KalturaMixEntry AppendMediaEntry(string mixEntryId, string mediaEntryId)
			{
				KalturaParams kparams = new KalturaParams();
				kparams.Add("mixEntryId", mixEntryId);
				kparams.Add("mediaEntryId", mediaEntryId);
				XmlNode result = _Client.CallService("mixing", "appendMediaEntry", kparams);
				_Client.ValidateObjectType(result, "KalturaMixEntry");
				return new KalturaMixEntry(result.ChildNodes[0]);
			}
		}

		KalturaSessionService _SessionService;
		public KalturaSessionService SessionService
		{
			get
			{
				if (_SessionService == null)
					_SessionService = new KalturaSessionService(this);

				return _SessionService;
			}
		}

		public class KalturaSessionService : KalturaServiceBase
		{
			public KalturaSessionService(KalturaClient _Client)
				: base(_Client)
			{
			}

			public string Start(int partnerId, string secret, string userId, KalturaSessionType type, int expiry = 86400, string privileges = )
			{
				KalturaParams kparams = new KalturaParams();
				kparams.Add("partnerId", partnerId.ToString());
				kparams.Add("secret", secret);
				kparams.Add("userId", userId);
				kparams.Add("type", type.GetHashCode().ToString());
				kparams.Add("expiry", expiry.ToString());
				kparams.Add("privileges", privileges);
				XmlNode result = _Client.CallService("session", "start", kparams);
				_Client.ValidateObjectType(result, "string");
				return new string(result.ChildNodes[0]);
			}

			public string StartWidgetSession(string widgetId, int expiry = 86400)
			{
				KalturaParams kparams = new KalturaParams();
				kparams.Add("widgetId", widgetId);
				kparams.Add("expiry", expiry.ToString());
				XmlNode result = _Client.CallService("session", "startWidgetSession", kparams);
				_Client.ValidateObjectType(result, "string");
				return new string(result.ChildNodes[0]);
			}
		}

		KalturaIntegrationService _IntegrationService;
		public KalturaIntegrationService IntegrationService
		{
			get
			{
				if (_IntegrationService == null)
					_IntegrationService = new KalturaIntegrationService(this);

				return _IntegrationService;
			}
		}

		public class KalturaIntegrationService : KalturaServiceBase
		{
			public KalturaIntegrationService(KalturaClient _Client)
				: base(_Client)
			{
			}
		}

		KalturaUiconfService _UiconfService;
		public KalturaUiconfService UiconfService
		{
			get
			{
				if (_UiconfService == null)
					_UiconfService = new KalturaUiconfService(this);

				return _UiconfService;
			}
		}

		public class KalturaUiconfService : KalturaServiceBase
		{
			public KalturaUiconfService(KalturaClient _Client)
				: base(_Client)
			{
			}

			public KalturaUiConf Add(KalturaUiConf _uiConf)
			{
				KalturaParams kparams = new KalturaParams();
				kparams.Add("_uiConf", _uiConf.ToParams());
				XmlNode result = _Client.CallService("uiconf", "add", kparams);
				_Client.ValidateObjectType(result, "KalturaUiConf");
				return new KalturaUiConf(result.ChildNodes[0]);
			}

			public KalturaUiConf Update(int id, KalturaUiConf _uiConf)
			{
				KalturaParams kparams = new KalturaParams();
				kparams.Add("id", id.ToString());
				kparams.Add("_uiConf", _uiConf.ToParams());
				XmlNode result = _Client.CallService("uiconf", "update", kparams);
				_Client.ValidateObjectType(result, "KalturaUiConf");
				return new KalturaUiConf(result.ChildNodes[0]);
			}

			public KalturaUiConf Get(int id)
			{
				KalturaParams kparams = new KalturaParams();
				kparams.Add("id", id.ToString());
				XmlNode result = _Client.CallService("uiconf", "get", kparams);
				_Client.ValidateObjectType(result, "KalturaUiConf");
				return new KalturaUiConf(result.ChildNodes[0]);
			}

			public KalturaUiConf Delete(int id)
			{
				KalturaParams kparams = new KalturaParams();
				kparams.Add("id", id.ToString());
				XmlNode result = _Client.CallService("uiconf", "delete", kparams);
				_Client.ValidateObjectType(result, "KalturaUiConf");
				return new KalturaUiConf(result.ChildNodes[0]);
			}

			public KalturaUiConf Clone(int id)
			{
				KalturaParams kparams = new KalturaParams();
				kparams.Add("id", id.ToString());
				XmlNode result = _Client.CallService("uiconf", "clone", kparams);
				_Client.ValidateObjectType(result, "KalturaUiConf");
				return new KalturaUiConf(result.ChildNodes[0]);
			}

			public IList<KalturaUiConf> List(KalturaUiConfFilter filter = null, KalturaFilterPager pager = null)
			{
				KalturaParams kparams = new KalturaParams();
				kparams.Add("filter", filter.ToParams());
				kparams.Add("pager", pager.ToParams());
				XmlNode result = _Client.CallService("uiconf", "list", kparams);
				_Client.ValidateArrayType(result, "KalturaUiConf");
				IList<KalturaUiConf> list = new List<KalturaUiConf>();
				foreach(XmlNode node in result.ChildNodes)
				{
					list.Add(new KalturaUiConf(node.ChildNodes[0]));
				}
				return list;
			}
		}

		KalturaPlaylistService _PlaylistService;
		public KalturaPlaylistService PlaylistService
		{
			get
			{
				if (_PlaylistService == null)
					_PlaylistService = new KalturaPlaylistService(this);

				return _PlaylistService;
			}
		}

		public class KalturaPlaylistService : KalturaServiceBase
		{
			public KalturaPlaylistService(KalturaClient _Client)
				: base(_Client)
			{
			}

			public KalturaPlaylist Add(KalturaPlaylist _playlist, bool updateStats = )
			{
				KalturaParams kparams = new KalturaParams();
				kparams.Add("_playlist", _playlist.ToParams());
				kparams.Add("updateStats", updateStats.ToString());
				XmlNode result = _Client.CallService("playlist", "add", kparams);
				_Client.ValidateObjectType(result, "KalturaPlaylist");
				return new KalturaPlaylist(result.ChildNodes[0]);
			}

			public KalturaPlaylist Get(string id)
			{
				KalturaParams kparams = new KalturaParams();
				kparams.Add("id", id);
				XmlNode result = _Client.CallService("playlist", "get", kparams);
				_Client.ValidateObjectType(result, "KalturaPlaylist");
				return new KalturaPlaylist(result.ChildNodes[0]);
			}

			public KalturaUiConf Update(string id, KalturaPlaylist _playlist, bool updateStats = )
			{
				KalturaParams kparams = new KalturaParams();
				kparams.Add("id", id);
				kparams.Add("_playlist", _playlist.ToParams());
				kparams.Add("updateStats", updateStats.ToString());
				XmlNode result = _Client.CallService("playlist", "update", kparams);
				_Client.ValidateObjectType(result, "KalturaUiConf");
				return new KalturaUiConf(result.ChildNodes[0]);
			}

			public KalturaPlaylist Delete(string id)
			{
				KalturaParams kparams = new KalturaParams();
				kparams.Add("id", id);
				XmlNode result = _Client.CallService("playlist", "delete", kparams);
				_Client.ValidateObjectType(result, "KalturaPlaylist");
				return new KalturaPlaylist(result.ChildNodes[0]);
			}

			public IList<KalturaMediaEntry> List(KalturaFilterPager pager)
			{
				KalturaParams kparams = new KalturaParams();
				kparams.Add("pager", pager.ToParams());
				XmlNode result = _Client.CallService("playlist", "list", kparams);
				_Client.ValidateArrayType(result, "KalturaMediaEntry");
				IList<KalturaMediaEntry> list = new List<KalturaMediaEntry>();
				foreach(XmlNode node in result.ChildNodes)
				{
					list.Add(new KalturaMediaEntry(node.ChildNodes[0]));
				}
				return list;
			}

			public IList<KalturaMediaEntry> Execute(string id, string detailed = )
			{
				KalturaParams kparams = new KalturaParams();
				kparams.Add("id", id);
				kparams.Add("detailed", detailed);
				XmlNode result = _Client.CallService("playlist", "execute", kparams);
				_Client.ValidateArrayType(result, "KalturaMediaEntry");
				IList<KalturaMediaEntry> list = new List<KalturaMediaEntry>();
				foreach(XmlNode node in result.ChildNodes)
				{
					list.Add(new KalturaMediaEntry(node.ChildNodes[0]));
				}
				return list;
			}

			public IList<KalturaMediaEntry> ExecuteFromContent(int playlistType, string playlistContent, string detailed = )
			{
				KalturaParams kparams = new KalturaParams();
				kparams.Add("playlistType", playlistType.ToString());
				kparams.Add("playlistContent", playlistContent);
				kparams.Add("detailed", detailed);
				XmlNode result = _Client.CallService("playlist", "executeFromContent", kparams);
				_Client.ValidateArrayType(result, "KalturaMediaEntry");
				IList<KalturaMediaEntry> list = new List<KalturaMediaEntry>();
				foreach(XmlNode node in result.ChildNodes)
				{
					list.Add(new KalturaMediaEntry(node.ChildNodes[0]));
				}
				return list;
			}

			public IList<KalturaMediaEntry> GetStatsFromContent(int playlistType, string playlistContent)
			{
				KalturaParams kparams = new KalturaParams();
				kparams.Add("playlistType", playlistType.ToString());
				kparams.Add("playlistContent", playlistContent);
				XmlNode result = _Client.CallService("playlist", "getStatsFromContent", kparams);
				_Client.ValidateArrayType(result, "KalturaMediaEntry");
				IList<KalturaMediaEntry> list = new List<KalturaMediaEntry>();
				foreach(XmlNode node in result.ChildNodes)
				{
					list.Add(new KalturaMediaEntry(node.ChildNodes[0]));
				}
				return list;
			}
		}

		KalturaUserService _UserService;
		public KalturaUserService UserService
		{
			get
			{
				if (_UserService == null)
					_UserService = new KalturaUserService(this);

				return _UserService;
			}
		}

		public class KalturaUserService : KalturaServiceBase
		{
			public KalturaUserService(KalturaClient _Client)
				: base(_Client)
			{
			}

			public KalturaUser Add(int id, KalturaUser _user)
			{
				KalturaParams kparams = new KalturaParams();
				kparams.Add("id", id.ToString());
				kparams.Add("_user", _user.ToParams());
				XmlNode result = _Client.CallService("user", "add", kparams);
				_Client.ValidateObjectType(result, "KalturaUser");
				return new KalturaUser(result.ChildNodes[0]);
			}

			public KalturaUser Update(string id, KalturaUser _user)
			{
				KalturaParams kparams = new KalturaParams();
				kparams.Add("id", id);
				kparams.Add("_user", _user.ToParams());
				XmlNode result = _Client.CallService("user", "update", kparams);
				_Client.ValidateObjectType(result, "KalturaUser");
				return new KalturaUser(result.ChildNodes[0]);
			}

			public KalturaUser Updateid(string id, string newId)
			{
				KalturaParams kparams = new KalturaParams();
				kparams.Add("id", id);
				kparams.Add("newId", newId);
				XmlNode result = _Client.CallService("user", "updateid", kparams);
				_Client.ValidateObjectType(result, "KalturaUser");
				return new KalturaUser(result.ChildNodes[0]);
			}

			public KalturaUser Get(string id)
			{
				KalturaParams kparams = new KalturaParams();
				kparams.Add("id", id);
				XmlNode result = _Client.CallService("user", "get", kparams);
				_Client.ValidateObjectType(result, "KalturaUser");
				return new KalturaUser(result.ChildNodes[0]);
			}

			public KalturaUser Delete(string id)
			{
				KalturaParams kparams = new KalturaParams();
				kparams.Add("id", id);
				XmlNode result = _Client.CallService("user", "delete", kparams);
				_Client.ValidateObjectType(result, "KalturaUser");
				return new KalturaUser(result.ChildNodes[0]);
			}

			public IList<KalturaUser> List(KalturaUserFilter filter = null, KalturaFilterPager pager = null)
			{
				KalturaParams kparams = new KalturaParams();
				kparams.Add("filter", filter.ToParams());
				kparams.Add("pager", pager.ToParams());
				XmlNode result = _Client.CallService("user", "list", kparams);
				_Client.ValidateArrayType(result, "KalturaUser");
				IList<KalturaUser> list = new List<KalturaUser>();
				foreach(XmlNode node in result.ChildNodes)
				{
					list.Add(new KalturaUser(node.ChildNodes[0]));
				}
				return list;
			}
		}

		KalturaWidgetService _WidgetService;
		public KalturaWidgetService WidgetService
		{
			get
			{
				if (_WidgetService == null)
					_WidgetService = new KalturaWidgetService(this);

				return _WidgetService;
			}
		}

		public class KalturaWidgetService : KalturaServiceBase
		{
			public KalturaWidgetService(KalturaClient _Client)
				: base(_Client)
			{
			}

			public KalturaWidget Add(KalturaWidget _widget)
			{
				KalturaParams kparams = new KalturaParams();
				kparams.Add("_widget", _widget.ToParams());
				XmlNode result = _Client.CallService("widget", "add", kparams);
				_Client.ValidateObjectType(result, "KalturaWidget");
				return new KalturaWidget(result.ChildNodes[0]);
			}

			public KalturaWidget Update(string id, KalturaWidget _widget)
			{
				KalturaParams kparams = new KalturaParams();
				kparams.Add("id", id);
				kparams.Add("_widget", _widget.ToParams());
				XmlNode result = _Client.CallService("widget", "update", kparams);
				_Client.ValidateObjectType(result, "KalturaWidget");
				return new KalturaWidget(result.ChildNodes[0]);
			}

			public KalturaWidget Get(string id)
			{
				KalturaParams kparams = new KalturaParams();
				kparams.Add("id", id);
				XmlNode result = _Client.CallService("widget", "get", kparams);
				_Client.ValidateObjectType(result, "KalturaWidget");
				return new KalturaWidget(result.ChildNodes[0]);
			}

			public KalturaWidget Delete(string id)
			{
				KalturaParams kparams = new KalturaParams();
				kparams.Add("id", id);
				XmlNode result = _Client.CallService("widget", "delete", kparams);
				_Client.ValidateObjectType(result, "KalturaWidget");
				return new KalturaWidget(result.ChildNodes[0]);
			}

			public KalturaWidget Clone(KalturaWidget _widget)
			{
				KalturaParams kparams = new KalturaParams();
				kparams.Add("_widget", _widget.ToParams());
				XmlNode result = _Client.CallService("widget", "clone", kparams);
				_Client.ValidateObjectType(result, "KalturaWidget");
				return new KalturaWidget(result.ChildNodes[0]);
			}
		}

		KalturaSearchService _SearchService;
		public KalturaSearchService SearchService
		{
			get
			{
				if (_SearchService == null)
					_SearchService = new KalturaSearchService(this);

				return _SearchService;
			}
		}

		public class KalturaSearchService : KalturaServiceBase
		{
			public KalturaSearchService(KalturaClient _Client)
				: base(_Client)
			{
			}

			public IList<KalturaSearchResult> Search(int partnerId, KalturaSearch search, KalturaFilterPager pager = null)
			{
				KalturaParams kparams = new KalturaParams();
				kparams.Add("partnerId", partnerId.ToString());
				kparams.Add("search", search.ToParams());
				kparams.Add("pager", pager.ToParams());
				XmlNode result = _Client.CallService("search", "search", kparams);
				_Client.ValidateArrayType(result, "KalturaSearchResult");
				IList<KalturaSearchResult> list = new List<KalturaSearchResult>();
				foreach(XmlNode node in result.ChildNodes)
				{
					list.Add(new KalturaSearchResult(node.ChildNodes[0]));
				}
				return list;
			}

			public KalturaSearchResult Getmediainfo(int partnerId, KalturaSearchResult searchResult)
			{
				KalturaParams kparams = new KalturaParams();
				kparams.Add("partnerId", partnerId.ToString());
				kparams.Add("searchResult", searchResult.ToParams());
				XmlNode result = _Client.CallService("search", "getmediainfo", kparams);
				_Client.ValidateObjectType(result, "KalturaSearchResult");
				return new KalturaSearchResult(result.ChildNodes[0]);
			}

			public KalturaSearchResult Searchurl(int partnerId, KalturaMediaType mediaType, string url)
			{
				KalturaParams kparams = new KalturaParams();
				kparams.Add("partnerId", partnerId.ToString());
				kparams.Add("mediaType", mediaType.GetHashCode().ToString());
				kparams.Add("url", url);
				XmlNode result = _Client.CallService("search", "searchurl", kparams);
				_Client.ValidateObjectType(result, "KalturaSearchResult");
				return new KalturaSearchResult(result.ChildNodes[0]);
			}
		}

		KalturaPartnerService _PartnerService;
		public KalturaPartnerService PartnerService
		{
			get
			{
				if (_PartnerService == null)
					_PartnerService = new KalturaPartnerService(this);

				return _PartnerService;
			}
		}

		public class KalturaPartnerService : KalturaServiceBase
		{
			public KalturaPartnerService(KalturaClient _Client)
				: base(_Client)
			{
			}

			public KalturaPartner Register(KalturaPartner _partner, string cmsPassword = )
			{
				KalturaParams kparams = new KalturaParams();
				kparams.Add("_partner", _partner.ToParams());
				kparams.Add("cmsPassword", cmsPassword);
				XmlNode result = _Client.CallService("partner", "register", kparams);
				_Client.ValidateObjectType(result, "KalturaPartner");
				return new KalturaPartner(result.ChildNodes[0]);
			}

			public KalturaPartner Update(KalturaPartner _partner, bool allowEmpty = )
			{
				KalturaParams kparams = new KalturaParams();
				kparams.Add("_partner", _partner.ToParams());
				kparams.Add("allowEmpty", allowEmpty.ToString());
				XmlNode result = _Client.CallService("partner", "update", kparams);
				_Client.ValidateObjectType(result, "KalturaPartner");
				return new KalturaPartner(result.ChildNodes[0]);
			}

			public KalturaPartner Getsecrets(int partnerId, string adminEmail, string cmsPassword)
			{
				KalturaParams kparams = new KalturaParams();
				kparams.Add("partnerId", partnerId.ToString());
				kparams.Add("adminEmail", adminEmail);
				kparams.Add("cmsPassword", cmsPassword);
				XmlNode result = _Client.CallService("partner", "getsecrets", kparams);
				_Client.ValidateObjectType(result, "KalturaPartner");
				return new KalturaPartner(result.ChildNodes[0]);
			}

			public KalturaPartner Getinfo()
			{
				KalturaParams kparams = new KalturaParams();
				XmlNode result = _Client.CallService("partner", "getinfo", kparams);
				_Client.ValidateObjectType(result, "KalturaPartner");
				return new KalturaPartner(result.ChildNodes[0]);
			}

			public void Getusage(int year, int month = 1, string resolution = days)
			{
				KalturaParams kparams = new KalturaParams();
				kparams.Add("year", year.ToString());
				kparams.Add("month", month.ToString());
				kparams.Add("resolution", resolution);
				XmlNode result = _Client.CallService("partner", "getusage", kparams);
			}
		}

		KalturaAdminuserService _AdminuserService;
		public KalturaAdminuserService AdminuserService
		{
			get
			{
				if (_AdminuserService == null)
					_AdminuserService = new KalturaAdminuserService(this);

				return _AdminuserService;
			}
		}

		public class KalturaAdminuserService : KalturaServiceBase
		{
			public KalturaAdminuserService(KalturaClient _Client)
				: base(_Client)
			{
			}

			public KalturaAdminUser Updatepasswd(string email, string password, string newEmail = , string newPassword = )
			{
				KalturaParams kparams = new KalturaParams();
				kparams.Add("email", email);
				kparams.Add("password", password);
				kparams.Add("newEmail", newEmail);
				kparams.Add("newPassword", newPassword);
				XmlNode result = _Client.CallService("adminuser", "updatepasswd", kparams);
				_Client.ValidateObjectType(result, "KalturaAdminUser");
				return new KalturaAdminUser(result.ChildNodes[0]);
			}

			public KalturaAdminUser Resetpasswd(string email)
			{
				KalturaParams kparams = new KalturaParams();
				kparams.Add("email", email);
				XmlNode result = _Client.CallService("adminuser", "resetpasswd", kparams);
				_Client.ValidateObjectType(result, "KalturaAdminUser");
				return new KalturaAdminUser(result.ChildNodes[0]);
			}

			public KalturaAdminLoginResponse Login(string email, string password)
			{
				KalturaParams kparams = new KalturaParams();
				kparams.Add("email", email);
				kparams.Add("password", password);
				XmlNode result = _Client.CallService("adminuser", "login", kparams);
				_Client.ValidateObjectType(result, "KalturaAdminLoginResponse");
				return new KalturaAdminLoginResponse(result.ChildNodes[0]);
			}
		}
	}
}
