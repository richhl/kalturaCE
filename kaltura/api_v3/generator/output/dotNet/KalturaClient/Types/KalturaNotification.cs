using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaNotification : KalturaBaseJob
	{
		#region Properties
		public string PuserId = null;
		public KalturaNotificationType Type = (KalturaNotificationType)Int32.MinValue;
		public string ObjectId = null;
		public KalturaNotificationStatus Status = (KalturaNotificationStatus)Int32.MinValue;
		public string NotificationData = null;
		public int NumberOfAttempts = Int32.MinValue;
		public string NotificationResult = null;
		public KalturaNotificationObjectType ObjectType = (KalturaNotificationObjectType)Int32.MinValue;
		#endregion

		#region CTor
		public KalturaNotification()
		{
		}

		public KalturaNotification(XmlElement node) : base(node)
		{
			foreach (XmlElement propertyNode in node.ChildNodes)
			{
				string txt = propertyNode.InnerText;
				switch (propertyNode.Name)
				{
					case "puserId":
						this.PuserId = txt;
						continue;
					case "type":
						this.Type = (KalturaNotificationType)ParseEnum(typeof(KalturaNotificationType), txt);
						continue;
					case "objectId":
						this.ObjectId = txt;
						continue;
					case "status":
						this.Status = (KalturaNotificationStatus)ParseEnum(typeof(KalturaNotificationStatus), txt);
						continue;
					case "notificationData":
						this.NotificationData = txt;
						continue;
					case "numberOfAttempts":
						this.NumberOfAttempts = ParseInt(txt);
						continue;
					case "notificationResult":
						this.NotificationResult = txt;
						continue;
					case "objectType":
						this.ObjectType = (KalturaNotificationObjectType)ParseEnum(typeof(KalturaNotificationObjectType), txt);
						continue;
				}
			}
		}
		#endregion

		#region Methods
		public new KalturaParams ToParams()
		{
			KalturaParams kparams = base.ToParams();
			kparams.AddStringIfNotNull("puserId", this.PuserId);
			kparams.AddEnumIfNotNull("type", this.Type);
			kparams.AddStringIfNotNull("objectId", this.ObjectId);
			kparams.AddEnumIfNotNull("status", this.Status);
			kparams.AddStringIfNotNull("notificationData", this.NotificationData);
			kparams.AddIntIfNotNull("numberOfAttempts", this.NumberOfAttempts);
			kparams.AddStringIfNotNull("notificationResult", this.NotificationResult);
			kparams.AddEnumIfNotNull("objectType", this.ObjectType);
			return kparams;
		}
		#endregion
	}
}

