using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaBatchJob : KalturaBaseJob
	{
		#region Properties
		public string EntryId = null;
		public KalturaBatchJobType JobType = (KalturaBatchJobType)Int32.MinValue;
		public string Data = null;
		public KalturaBatchJobStatus Status = (KalturaBatchJobStatus)Int32.MinValue;
		public int Abort = Int32.MinValue;
		public int CheckAgainTimeout = Int32.MinValue;
		public int Progress = Int32.MinValue;
		public string Message = null;
		public string Description = null;
		public int UpdatesCount = Int32.MinValue;
		public int ParentJobId = Int32.MinValue;
		#endregion

		#region CTor
		public KalturaBatchJob()
		{
		}

		public KalturaBatchJob(XmlElement node) : base(node)
		{
			foreach (XmlElement propertyNode in node.ChildNodes)
			{
				string txt = propertyNode.InnerText;
				switch (propertyNode.Name)
				{
					case "entryId":
						this.EntryId = txt;
						continue;
					case "jobType":
						this.JobType = (KalturaBatchJobType)ParseEnum(typeof(KalturaBatchJobType), txt);
						continue;
					case "data":
						this.Data = txt;
						continue;
					case "status":
						this.Status = (KalturaBatchJobStatus)ParseEnum(typeof(KalturaBatchJobStatus), txt);
						continue;
					case "abort":
						this.Abort = ParseInt(txt);
						continue;
					case "checkAgainTimeout":
						this.CheckAgainTimeout = ParseInt(txt);
						continue;
					case "progress":
						this.Progress = ParseInt(txt);
						continue;
					case "message":
						this.Message = txt;
						continue;
					case "description":
						this.Description = txt;
						continue;
					case "updatesCount":
						this.UpdatesCount = ParseInt(txt);
						continue;
					case "parentJobId":
						this.ParentJobId = ParseInt(txt);
						continue;
				}
			}
		}
		#endregion

		#region Methods
		public new KalturaParams ToParams()
		{
			KalturaParams kparams = base.ToParams();
			kparams.AddStringIfNotNull("entryId", this.EntryId);
			kparams.AddEnumIfNotNull("jobType", this.JobType);
			kparams.AddStringIfNotNull("data", this.Data);
			kparams.AddEnumIfNotNull("status", this.Status);
			kparams.AddIntIfNotNull("abort", this.Abort);
			kparams.AddIntIfNotNull("checkAgainTimeout", this.CheckAgainTimeout);
			kparams.AddIntIfNotNull("progress", this.Progress);
			kparams.AddStringIfNotNull("message", this.Message);
			kparams.AddStringIfNotNull("description", this.Description);
			kparams.AddIntIfNotNull("updatesCount", this.UpdatesCount);
			kparams.AddIntIfNotNull("parentJobId", this.ParentJobId);
			return kparams;
		}
		#endregion
	}
}

