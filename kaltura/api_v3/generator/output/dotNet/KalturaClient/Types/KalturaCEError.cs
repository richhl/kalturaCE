using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaCEError : KalturaObjectBase
	{
		#region Properties
		public string Id = null;
		public int PartnerId = Int32.MinValue;
		public string Browser = null;
		public string ServerIp = null;
		public string ServerOs = null;
		public string PhpVersion = null;
		public string CeAdminEmail = null;
		public string Type = null;
		public string Description = null;
		public string Data = null;
		#endregion

		#region CTor
		public KalturaCEError()
		{
		}

		public KalturaCEError(XmlElement node)
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
					case "browser":
						this.Browser = txt;
						continue;
					case "serverIp":
						this.ServerIp = txt;
						continue;
					case "serverOs":
						this.ServerOs = txt;
						continue;
					case "phpVersion":
						this.PhpVersion = txt;
						continue;
					case "ceAdminEmail":
						this.CeAdminEmail = txt;
						continue;
					case "type":
						this.Type = txt;
						continue;
					case "description":
						this.Description = txt;
						continue;
					case "data":
						this.Data = txt;
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
			kparams.AddStringIfNotNull("browser", this.Browser);
			kparams.AddStringIfNotNull("serverIp", this.ServerIp);
			kparams.AddStringIfNotNull("serverOs", this.ServerOs);
			kparams.AddStringIfNotNull("phpVersion", this.PhpVersion);
			kparams.AddStringIfNotNull("ceAdminEmail", this.CeAdminEmail);
			kparams.AddStringIfNotNull("type", this.Type);
			kparams.AddStringIfNotNull("description", this.Description);
			kparams.AddStringIfNotNull("data", this.Data);
			return kparams;
		}
		#endregion
	}
}

