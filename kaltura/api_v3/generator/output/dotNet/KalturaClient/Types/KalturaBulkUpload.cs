using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaBulkUpload : KalturaObjectBase
	{
		#region Properties
		public int Id = Int32.MinValue;
		public string UploadedBy = null;
		public int UploadedOn = Int32.MinValue;
		public int NumOfEntries = Int32.MinValue;
		public KalturaBatchJobStatus Status = (KalturaBatchJobStatus)Int32.MinValue;
		public string LogFileUrl = null;
		public string CsvFileUrl = null;
		#endregion

		#region CTor
		public KalturaBulkUpload()
		{
		}

		public KalturaBulkUpload(XmlElement node)
		{
			foreach (XmlElement propertyNode in node.ChildNodes)
			{
				string txt = propertyNode.InnerText;
				switch (propertyNode.Name)
				{
					case "id":
						this.Id = ParseInt(txt);
						continue;
					case "uploadedBy":
						this.UploadedBy = txt;
						continue;
					case "uploadedOn":
						this.UploadedOn = ParseInt(txt);
						continue;
					case "numOfEntries":
						this.NumOfEntries = ParseInt(txt);
						continue;
					case "status":
						this.Status = (KalturaBatchJobStatus)ParseEnum(typeof(KalturaBatchJobStatus), txt);
						continue;
					case "logFileUrl":
						this.LogFileUrl = txt;
						continue;
					case "csvFileUrl":
						this.CsvFileUrl = txt;
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
			kparams.AddStringIfNotNull("uploadedBy", this.UploadedBy);
			kparams.AddIntIfNotNull("uploadedOn", this.UploadedOn);
			kparams.AddIntIfNotNull("numOfEntries", this.NumOfEntries);
			kparams.AddEnumIfNotNull("status", this.Status);
			kparams.AddStringIfNotNull("logFileUrl", this.LogFileUrl);
			kparams.AddStringIfNotNull("csvFileUrl", this.CsvFileUrl);
			return kparams;
		}
		#endregion
	}
}

