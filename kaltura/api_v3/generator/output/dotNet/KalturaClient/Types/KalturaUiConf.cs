using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
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
		public string ConfFileFeatures = null;
		public string ConfVars = null;
		public bool? UseCdn = false;
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

		public KalturaUiConf(XmlElement node)
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
					case "objType":
						this.ObjType = (KalturaUiConfObjType)ParseEnum(typeof(KalturaUiConfObjType), txt);
						continue;
					case "objTypeAsString":
						this.ObjTypeAsString = txt;
						continue;
					case "width":
						this.Width = ParseInt(txt);
						continue;
					case "height":
						this.Height = ParseInt(txt);
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
					case "confFileFeatures":
						this.ConfFileFeatures = txt;
						continue;
					case "confVars":
						this.ConfVars = txt;
						continue;
					case "useCdn":
						this.UseCdn = ParseBool(txt);
						continue;
					case "tags":
						this.Tags = txt;
						continue;
					case "swfUrlVersion":
						this.SwfUrlVersion = txt;
						continue;
					case "createdAt":
						this.CreatedAt = ParseInt(txt);
						continue;
					case "updatedAt":
						this.UpdatedAt = ParseInt(txt);
						continue;
					case "creationMode":
						this.CreationMode = (KalturaUiConfCreationMode)ParseEnum(typeof(KalturaUiConfCreationMode), txt);
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
			kparams.AddEnumIfNotNull("objType", this.ObjType);
			kparams.AddStringIfNotNull("objTypeAsString", this.ObjTypeAsString);
			kparams.AddIntIfNotNull("width", this.Width);
			kparams.AddIntIfNotNull("height", this.Height);
			kparams.AddStringIfNotNull("htmlParams", this.HtmlParams);
			kparams.AddStringIfNotNull("swfUrl", this.SwfUrl);
			kparams.AddStringIfNotNull("confFilePath", this.ConfFilePath);
			kparams.AddStringIfNotNull("confFile", this.ConfFile);
			kparams.AddStringIfNotNull("confFileFeatures", this.ConfFileFeatures);
			kparams.AddStringIfNotNull("confVars", this.ConfVars);
			kparams.AddBoolIfNotNull("useCdn", this.UseCdn);
			kparams.AddStringIfNotNull("tags", this.Tags);
			kparams.AddStringIfNotNull("swfUrlVersion", this.SwfUrlVersion);
			kparams.AddIntIfNotNull("createdAt", this.CreatedAt);
			kparams.AddIntIfNotNull("updatedAt", this.UpdatedAt);
			kparams.AddEnumIfNotNull("creationMode", this.CreationMode);
			return kparams;
		}
		#endregion
	}
}

