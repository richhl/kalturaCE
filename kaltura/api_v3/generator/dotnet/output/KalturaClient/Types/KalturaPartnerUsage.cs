using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaPartnerUsage : KalturaObjectBase
	{
		#region Properties
		public float HostingGB = Single.MinValue;
		public float Percent = Single.MinValue;
		public int PackageBW = Int32.MinValue;
		public int UsageGB = Int32.MinValue;
		public int ReachedLimitDate = Int32.MinValue;
		public string UsageGraph = null;
		#endregion

		#region CTor
		public KalturaPartnerUsage()
		{
		}

		public KalturaPartnerUsage(XmlElement node)
		{
			foreach (XmlElement propertyNode in node.ChildNodes)
			{
				string txt = propertyNode.InnerText;
				switch (propertyNode.Name)
				{
					case "hostingGB":
						this.HostingGB = ParseFloat(txt);
						continue;
					case "Percent":
						this.Percent = ParseFloat(txt);
						continue;
					case "packageBW":
						this.PackageBW = ParseInt(txt);
						continue;
					case "usageGB":
						this.UsageGB = ParseInt(txt);
						continue;
					case "reachedLimitDate":
						this.ReachedLimitDate = ParseInt(txt);
						continue;
					case "usageGraph":
						this.UsageGraph = txt;
						continue;
				}
			}
		}
		#endregion

		#region Methods
		public new KalturaParams ToParams()
		{
			KalturaParams kparams = base.ToParams();
			kparams.AddFloatIfNotNull("hostingGB", this.HostingGB);
			kparams.AddFloatIfNotNull("Percent", this.Percent);
			kparams.AddIntIfNotNull("packageBW", this.PackageBW);
			kparams.AddIntIfNotNull("usageGB", this.UsageGB);
			kparams.AddIntIfNotNull("reachedLimitDate", this.ReachedLimitDate);
			kparams.AddStringIfNotNull("usageGraph", this.UsageGraph);
			return kparams;
		}
		#endregion
	}
}

