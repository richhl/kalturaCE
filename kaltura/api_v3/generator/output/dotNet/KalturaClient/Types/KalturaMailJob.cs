using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaMailJob : KalturaBaseJob
	{
		#region Properties
		public int MailType = Int32.MinValue;
		public int MailPriority = Int32.MinValue;
		public KalturaMailJobStatus Status = (KalturaMailJobStatus)Int32.MinValue;
		public string RecipientName = null;
		public string RecipientEmail = null;
		public int RecipientId = Int32.MinValue;
		public string FromName = null;
		public string FromEmail = null;
		public string BodyParams = null;
		public string SubjectParams = null;
		public string TemplatePath = null;
		public int Culture = Int32.MinValue;
		public int CampaignId = Int32.MinValue;
		public int MinSendDate = Int32.MinValue;
		#endregion

		#region CTor
		public KalturaMailJob()
		{
		}

		public KalturaMailJob(XmlElement node) : base(node)
		{
			foreach (XmlElement propertyNode in node.ChildNodes)
			{
				string txt = propertyNode.InnerText;
				switch (propertyNode.Name)
				{
					case "mailType":
						this.MailType = ParseInt(txt);
						continue;
					case "mailPriority":
						this.MailPriority = ParseInt(txt);
						continue;
					case "status":
						this.Status = (KalturaMailJobStatus)ParseEnum(typeof(KalturaMailJobStatus), txt);
						continue;
					case "recipientName":
						this.RecipientName = txt;
						continue;
					case "recipientEmail":
						this.RecipientEmail = txt;
						continue;
					case "recipientId":
						this.RecipientId = ParseInt(txt);
						continue;
					case "fromName":
						this.FromName = txt;
						continue;
					case "fromEmail":
						this.FromEmail = txt;
						continue;
					case "bodyParams":
						this.BodyParams = txt;
						continue;
					case "subjectParams":
						this.SubjectParams = txt;
						continue;
					case "templatePath":
						this.TemplatePath = txt;
						continue;
					case "culture":
						this.Culture = ParseInt(txt);
						continue;
					case "campaignId":
						this.CampaignId = ParseInt(txt);
						continue;
					case "minSendDate":
						this.MinSendDate = ParseInt(txt);
						continue;
				}
			}
		}
		#endregion

		#region Methods
		public new KalturaParams ToParams()
		{
			KalturaParams kparams = base.ToParams();
			kparams.AddIntIfNotNull("mailType", this.MailType);
			kparams.AddIntIfNotNull("mailPriority", this.MailPriority);
			kparams.AddEnumIfNotNull("status", this.Status);
			kparams.AddStringIfNotNull("recipientName", this.RecipientName);
			kparams.AddStringIfNotNull("recipientEmail", this.RecipientEmail);
			kparams.AddIntIfNotNull("recipientId", this.RecipientId);
			kparams.AddStringIfNotNull("fromName", this.FromName);
			kparams.AddStringIfNotNull("fromEmail", this.FromEmail);
			kparams.AddStringIfNotNull("bodyParams", this.BodyParams);
			kparams.AddStringIfNotNull("subjectParams", this.SubjectParams);
			kparams.AddStringIfNotNull("templatePath", this.TemplatePath);
			kparams.AddIntIfNotNull("culture", this.Culture);
			kparams.AddIntIfNotNull("campaignId", this.CampaignId);
			kparams.AddIntIfNotNull("minSendDate", this.MinSendDate);
			return kparams;
		}
		#endregion
	}
}

