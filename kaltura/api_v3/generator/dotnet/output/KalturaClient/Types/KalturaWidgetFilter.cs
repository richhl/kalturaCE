using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaWidgetFilter : KalturaObjectBase
	{
		#region Properties
		public string Id = null;
		public string SourceWidgetId = null;
		public string RootWidgetId = null;
		public string EntryId = null;
		public int UiConfId = Int32.MinValue;
		public string PartnerData = null;
		public string CreatedAtGreaterThanEqual = null;
		public string CreatedAtLessThanEqual = null;
		public string UpdatedAtGreaterThanEqual = null;
		public string UpdatedAtLessThanEqual = null;
		#endregion

		#region CTor
		public KalturaWidgetFilter()
		{
		}

		public KalturaWidgetFilter(XmlElement node)
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
					case "entryId":
						this.EntryId = txt;
						continue;
					case "uiConfId":
						this.UiConfId = ParseInt(txt);
						continue;
					case "partnerData":
						this.PartnerData = txt;
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
		public new KalturaParams ToParams()
		{
			KalturaParams kparams = base.ToParams();
			kparams.AddStringIfNotNull("id", this.Id);
			kparams.AddStringIfNotNull("sourceWidgetId", this.SourceWidgetId);
			kparams.AddStringIfNotNull("rootWidgetId", this.RootWidgetId);
			kparams.AddStringIfNotNull("entryId", this.EntryId);
			kparams.AddIntIfNotNull("uiConfId", this.UiConfId);
			kparams.AddStringIfNotNull("partnerData", this.PartnerData);
			kparams.AddStringIfNotNull("createdAtGreaterThanEqual", this.CreatedAtGreaterThanEqual);
			kparams.AddStringIfNotNull("createdAtLessThanEqual", this.CreatedAtLessThanEqual);
			kparams.AddStringIfNotNull("updatedAtGreaterThanEqual", this.UpdatedAtGreaterThanEqual);
			kparams.AddStringIfNotNull("updatedAtLessThanEqual", this.UpdatedAtLessThanEqual);
			return kparams;
		}
		#endregion
	}
}

