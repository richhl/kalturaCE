using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaWidgetFilter : KalturaFilter
	{
		#region Properties
		public string IdEqual = null;
		public string IdIn = null;
		public string SourceWidgetIdEqual = null;
		public string RootWidgetIdEqual = null;
		public int PartnerIdEqual = Int32.MinValue;
		public string EntryIdEqual = null;
		public int UiConfIdEqual = Int32.MinValue;
		public int CreatedAtGreaterThanOrEqual = Int32.MinValue;
		public int CreatedAtLessThanOrEqual = Int32.MinValue;
		public int UpdatedAtGreaterThanOrEqual = Int32.MinValue;
		public int UpdatedAtLessThanOrEqual = Int32.MinValue;
		public string PartnerDataLike = null;
		#endregion

		#region CTor
		public KalturaWidgetFilter()
		{
		}

		public KalturaWidgetFilter(XmlElement node) : base(node)
		{
			foreach (XmlElement propertyNode in node.ChildNodes)
			{
				string txt = propertyNode.InnerText;
				switch (propertyNode.Name)
				{
					case "idEqual":
						this.IdEqual = txt;
						continue;
					case "idIn":
						this.IdIn = txt;
						continue;
					case "sourceWidgetIdEqual":
						this.SourceWidgetIdEqual = txt;
						continue;
					case "rootWidgetIdEqual":
						this.RootWidgetIdEqual = txt;
						continue;
					case "partnerIdEqual":
						this.PartnerIdEqual = ParseInt(txt);
						continue;
					case "entryIdEqual":
						this.EntryIdEqual = txt;
						continue;
					case "uiConfIdEqual":
						this.UiConfIdEqual = ParseInt(txt);
						continue;
					case "createdAtGreaterThanOrEqual":
						this.CreatedAtGreaterThanOrEqual = ParseInt(txt);
						continue;
					case "createdAtLessThanOrEqual":
						this.CreatedAtLessThanOrEqual = ParseInt(txt);
						continue;
					case "updatedAtGreaterThanOrEqual":
						this.UpdatedAtGreaterThanOrEqual = ParseInt(txt);
						continue;
					case "updatedAtLessThanOrEqual":
						this.UpdatedAtLessThanOrEqual = ParseInt(txt);
						continue;
					case "partnerDataLike":
						this.PartnerDataLike = txt;
						continue;
				}
			}
		}
		#endregion

		#region Methods
		public new KalturaParams ToParams()
		{
			KalturaParams kparams = base.ToParams();
			kparams.AddStringIfNotNull("idEqual", this.IdEqual);
			kparams.AddStringIfNotNull("idIn", this.IdIn);
			kparams.AddStringIfNotNull("sourceWidgetIdEqual", this.SourceWidgetIdEqual);
			kparams.AddStringIfNotNull("rootWidgetIdEqual", this.RootWidgetIdEqual);
			kparams.AddIntIfNotNull("partnerIdEqual", this.PartnerIdEqual);
			kparams.AddStringIfNotNull("entryIdEqual", this.EntryIdEqual);
			kparams.AddIntIfNotNull("uiConfIdEqual", this.UiConfIdEqual);
			kparams.AddIntIfNotNull("createdAtGreaterThanOrEqual", this.CreatedAtGreaterThanOrEqual);
			kparams.AddIntIfNotNull("createdAtLessThanOrEqual", this.CreatedAtLessThanOrEqual);
			kparams.AddIntIfNotNull("updatedAtGreaterThanOrEqual", this.UpdatedAtGreaterThanOrEqual);
			kparams.AddIntIfNotNull("updatedAtLessThanOrEqual", this.UpdatedAtLessThanOrEqual);
			kparams.AddStringIfNotNull("partnerDataLike", this.PartnerDataLike);
			return kparams;
		}
		#endregion
	}
}

