using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaBaseJob : KalturaObjectBase
	{
		#region Properties
		public int Id = Int32.MinValue;
		public int PartnerId = Int32.MinValue;
		public int CreatedAt = Int32.MinValue;
		public int UpdatedAt = Int32.MinValue;
		public string ProcessorName = null;
		public string ProcessorLocation = null;
		public int ProcessorExpiration = Int32.MinValue;
		#endregion

		#region CTor
		public KalturaBaseJob()
		{
		}

		public KalturaBaseJob(XmlElement node)
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
					case "createdAt":
						this.CreatedAt = ParseInt(txt);
						continue;
					case "updatedAt":
						this.UpdatedAt = ParseInt(txt);
						continue;
					case "processorName":
						this.ProcessorName = txt;
						continue;
					case "processorLocation":
						this.ProcessorLocation = txt;
						continue;
					case "processorExpiration":
						this.ProcessorExpiration = ParseInt(txt);
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
			kparams.AddIntIfNotNull("createdAt", this.CreatedAt);
			kparams.AddIntIfNotNull("updatedAt", this.UpdatedAt);
			kparams.AddStringIfNotNull("processorName", this.ProcessorName);
			kparams.AddStringIfNotNull("processorLocation", this.ProcessorLocation);
			kparams.AddIntIfNotNull("processorExpiration", this.ProcessorExpiration);
			return kparams;
		}
		#endregion
	}
}

