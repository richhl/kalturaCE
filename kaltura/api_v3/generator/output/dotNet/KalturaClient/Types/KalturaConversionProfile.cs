using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaConversionProfile : KalturaObjectBase
	{
		#region Properties
		public int Id = Int32.MinValue;
		public int PartnerId = Int32.MinValue;
		public string Name = null;
		public string ProfileType = null;
		public bool? CommercialTranscoder = false;
		public int Width = Int32.MinValue;
		public int Height = Int32.MinValue;
		public KalturaAspectRatioType AspectRatioType = (KalturaAspectRatioType)Int32.MinValue;
		public bool? BypassFlv = false;
		public int CreatedAt = Int32.MinValue;
		public int UpdatedAt = Int32.MinValue;
		public int ProfileTypeSuffix = Int32.MinValue;
		#endregion

		#region CTor
		public KalturaConversionProfile()
		{
		}

		public KalturaConversionProfile(XmlElement node)
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
					case "name":
						this.Name = txt;
						continue;
					case "profileType":
						this.ProfileType = txt;
						continue;
					case "commercialTranscoder":
						this.CommercialTranscoder = ParseBool(txt);
						continue;
					case "width":
						this.Width = ParseInt(txt);
						continue;
					case "height":
						this.Height = ParseInt(txt);
						continue;
					case "aspectRatioType":
						this.AspectRatioType = (KalturaAspectRatioType)ParseEnum(typeof(KalturaAspectRatioType), txt);
						continue;
					case "bypassFlv":
						this.BypassFlv = ParseBool(txt);
						continue;
					case "createdAt":
						this.CreatedAt = ParseInt(txt);
						continue;
					case "updatedAt":
						this.UpdatedAt = ParseInt(txt);
						continue;
					case "profileTypeSuffix":
						this.ProfileTypeSuffix = ParseInt(txt);
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
			kparams.AddStringIfNotNull("name", this.Name);
			kparams.AddStringIfNotNull("profileType", this.ProfileType);
			kparams.AddBoolIfNotNull("commercialTranscoder", this.CommercialTranscoder);
			kparams.AddIntIfNotNull("width", this.Width);
			kparams.AddIntIfNotNull("height", this.Height);
			kparams.AddEnumIfNotNull("aspectRatioType", this.AspectRatioType);
			kparams.AddBoolIfNotNull("bypassFlv", this.BypassFlv);
			kparams.AddIntIfNotNull("createdAt", this.CreatedAt);
			kparams.AddIntIfNotNull("updatedAt", this.UpdatedAt);
			kparams.AddIntIfNotNull("profileTypeSuffix", this.ProfileTypeSuffix);
			return kparams;
		}
		#endregion
	}
}

