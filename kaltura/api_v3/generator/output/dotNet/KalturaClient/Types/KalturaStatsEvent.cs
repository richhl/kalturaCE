using System;
using System.Xml;
using System.Collections.Generic;

namespace Kaltura
{
	public class KalturaStatsEvent : KalturaObjectBase
	{
		#region Properties
		public string ClientVer = null;
		public KalturaStatsEventType EventType = (KalturaStatsEventType)Int32.MinValue;
		public float EventTimestamp = Single.MinValue;
		public string SessionId = null;
		public int PartnerId = Int32.MinValue;
		public string EntryId = null;
		public string UniqueViewer = null;
		public string WidgetId = null;
		public int UiconfId = Int32.MinValue;
		public string UserId = null;
		public int CurrentPoint = Int32.MinValue;
		public int Duration = Int32.MinValue;
		public string UserIp = null;
		public int ProcessDuration = Int32.MinValue;
		public string ControlId = null;
		public bool? Seek = false;
		public int NewPoint = Int32.MinValue;
		public string Referrer = null;
		public bool? IsFirstInSession = false;
		#endregion

		#region CTor
		public KalturaStatsEvent()
		{
		}

		public KalturaStatsEvent(XmlElement node)
		{
			foreach (XmlElement propertyNode in node.ChildNodes)
			{
				string txt = propertyNode.InnerText;
				switch (propertyNode.Name)
				{
					case "clientVer":
						this.ClientVer = txt;
						continue;
					case "eventType":
						this.EventType = (KalturaStatsEventType)ParseEnum(typeof(KalturaStatsEventType), txt);
						continue;
					case "eventTimestamp":
						this.EventTimestamp = ParseFloat(txt);
						continue;
					case "sessionId":
						this.SessionId = txt;
						continue;
					case "partnerId":
						this.PartnerId = ParseInt(txt);
						continue;
					case "entryId":
						this.EntryId = txt;
						continue;
					case "uniqueViewer":
						this.UniqueViewer = txt;
						continue;
					case "widgetId":
						this.WidgetId = txt;
						continue;
					case "uiconfId":
						this.UiconfId = ParseInt(txt);
						continue;
					case "userId":
						this.UserId = txt;
						continue;
					case "currentPoint":
						this.CurrentPoint = ParseInt(txt);
						continue;
					case "duration":
						this.Duration = ParseInt(txt);
						continue;
					case "userIp":
						this.UserIp = txt;
						continue;
					case "processDuration":
						this.ProcessDuration = ParseInt(txt);
						continue;
					case "controlId":
						this.ControlId = txt;
						continue;
					case "seek":
						this.Seek = ParseBool(txt);
						continue;
					case "newPoint":
						this.NewPoint = ParseInt(txt);
						continue;
					case "referrer":
						this.Referrer = txt;
						continue;
					case "isFirstInSession":
						this.IsFirstInSession = ParseBool(txt);
						continue;
				}
			}
		}
		#endregion

		#region Methods
		public new KalturaParams ToParams()
		{
			KalturaParams kparams = base.ToParams();
			kparams.AddStringIfNotNull("clientVer", this.ClientVer);
			kparams.AddEnumIfNotNull("eventType", this.EventType);
			kparams.AddFloatIfNotNull("eventTimestamp", this.EventTimestamp);
			kparams.AddStringIfNotNull("sessionId", this.SessionId);
			kparams.AddIntIfNotNull("partnerId", this.PartnerId);
			kparams.AddStringIfNotNull("entryId", this.EntryId);
			kparams.AddStringIfNotNull("uniqueViewer", this.UniqueViewer);
			kparams.AddStringIfNotNull("widgetId", this.WidgetId);
			kparams.AddIntIfNotNull("uiconfId", this.UiconfId);
			kparams.AddStringIfNotNull("userId", this.UserId);
			kparams.AddIntIfNotNull("currentPoint", this.CurrentPoint);
			kparams.AddIntIfNotNull("duration", this.Duration);
			kparams.AddStringIfNotNull("userIp", this.UserIp);
			kparams.AddIntIfNotNull("processDuration", this.ProcessDuration);
			kparams.AddStringIfNotNull("controlId", this.ControlId);
			kparams.AddBoolIfNotNull("seek", this.Seek);
			kparams.AddIntIfNotNull("newPoint", this.NewPoint);
			kparams.AddStringIfNotNull("referrer", this.Referrer);
			kparams.AddBoolIfNotNull("isFirstInSession", this.IsFirstInSession);
			return kparams;
		}
		#endregion
	}
}

