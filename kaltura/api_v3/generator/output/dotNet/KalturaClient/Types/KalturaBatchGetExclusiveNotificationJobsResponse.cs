using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaBatchGetExclusiveNotificationJobsResponse : KalturaObjectBase
	{
		#region Properties
		public IList<KalturaNotification> Notifications;
		public IList<KalturaPartner> Partners;
		#endregion

		#region CTor
		public KalturaBatchGetExclusiveNotificationJobsResponse()
		{
		}

		public KalturaBatchGetExclusiveNotificationJobsResponse(XmlElement node)
		{
			foreach (XmlElement propertyNode in node.ChildNodes)
			{
				string txt = propertyNode.InnerText;
				switch (propertyNode.Name)
				{
					case "notifications":
				        this.Notifications = new List<KalturaNotification>();
						foreach(XmlElement arrayNode in propertyNode.ChildNodes)
						{
					        this.Notifications.Add((KalturaNotification)KalturaObjectFactory.Create(arrayNode));
						}
						continue;
					case "partners":
				        this.Partners = new List<KalturaPartner>();
						foreach(XmlElement arrayNode in propertyNode.ChildNodes)
						{
					        this.Partners.Add((KalturaPartner)KalturaObjectFactory.Create(arrayNode));
						}
						continue;
				}
			}
		}
		#endregion

		#region Methods
		public new KalturaParams ToParams()
		{
			KalturaParams kparams = base.ToParams();
			return kparams;
		}
		#endregion
	}
}

