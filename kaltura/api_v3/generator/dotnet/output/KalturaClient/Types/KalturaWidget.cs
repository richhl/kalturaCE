using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
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

		public KalturaWidget(XmlElement node)
		{
			foreach (XmlElement propertyNode in node.ChildNodes)
			{
				string txt = propertyNode.InnerText;
				switch (propertyNode.Name)
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
						this.PartnerId = ParseInt(txt);
						continue;
					case "kshowId":
						this.KshowId = txt;
						continue;
					case "entryId":
						this.EntryId = txt;
						continue;
					case "uiConfId":
						this.UiConfId = ParseInt(txt);
						continue;
					case "securityType":
						this.SecurityType = (KalturaWidgetSecurityType)ParseEnum(typeof(KalturaWidgetSecurityType), txt);
						continue;
					case "securityPolicy":
						this.SecurityPolicy = ParseInt(txt);
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
					case "widgetHTML":
						this.WidgetHTML = txt;
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
			kparams.AddStringIfNotNull("sourceWidgetId", this.SourceWidgetId);
			kparams.AddStringIfNotNull("rootWidgetId", this.RootWidgetId);
			kparams.AddIntIfNotNull("partnerId", this.PartnerId);
			kparams.AddStringIfNotNull("kshowId", this.KshowId);
			kparams.AddStringIfNotNull("entryId", this.EntryId);
			kparams.AddIntIfNotNull("uiConfId", this.UiConfId);
			kparams.AddEnumIfNotNull("securityType", this.SecurityType);
			kparams.AddIntIfNotNull("securityPolicy", this.SecurityPolicy);
			kparams.AddIntIfNotNull("createdAt", this.CreatedAt);
			kparams.AddIntIfNotNull("updatedAt", this.UpdatedAt);
			kparams.AddStringIfNotNull("partnerData", this.PartnerData);
			kparams.AddStringIfNotNull("widgetHTML", this.WidgetHTML);
			return kparams;
		}
		#endregion
	}
}

