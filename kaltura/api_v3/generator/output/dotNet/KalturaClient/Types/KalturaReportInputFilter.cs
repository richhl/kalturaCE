using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaReportInputFilter : KalturaObjectBase
	{
		#region Properties
		public int FromDate = Int32.MinValue;
		public int ToDate = Int32.MinValue;
		public string Keywords = null;
		public bool? SearchInTags = false;
		public bool? SearchInAdminTags = false;
		#endregion

		#region CTor
		public KalturaReportInputFilter()
		{
		}

		public KalturaReportInputFilter(XmlElement node)
		{
			foreach (XmlElement propertyNode in node.ChildNodes)
			{
				string txt = propertyNode.InnerText;
				switch (propertyNode.Name)
				{
					case "fromDate":
						this.FromDate = ParseInt(txt);
						continue;
					case "toDate":
						this.ToDate = ParseInt(txt);
						continue;
					case "keywords":
						this.Keywords = txt;
						continue;
					case "searchInTags":
						this.SearchInTags = ParseBool(txt);
						continue;
					case "searchInAdminTags":
						this.SearchInAdminTags = ParseBool(txt);
						continue;
				}
			}
		}
		#endregion

		#region Methods
		public new KalturaParams ToParams()
		{
			KalturaParams kparams = base.ToParams();
			kparams.AddIntIfNotNull("fromDate", this.FromDate);
			kparams.AddIntIfNotNull("toDate", this.ToDate);
			kparams.AddStringIfNotNull("keywords", this.Keywords);
			kparams.AddBoolIfNotNull("searchInTags", this.SearchInTags);
			kparams.AddBoolIfNotNull("searchInAdminTags", this.SearchInAdminTags);
			return kparams;
		}
		#endregion
	}
}

