using System;
using System.Text;
using System.Xml;
using System.Runtime.Serialization;

namespace Kaltura
{
	public static class KalturaObjectFactory
	{
		public static object Create(XmlElement xmlElement)
		{
			switch (xmlElement["objectType"].InnerText)
			{
				case "KalturaAdminLoginResponse":
					return new KalturaAdminLoginResponse(xmlElement);
				case "KalturaAdminUser":
					return new KalturaAdminUser(xmlElement);
				case "KalturaBaseEntry":
					return new KalturaBaseEntry(xmlElement);
				case "KalturaBaseEntryFilter":
					return new KalturaBaseEntryFilter(xmlElement);
				case "KalturaBaseEntryListResponse":
					return new KalturaBaseEntryListResponse(xmlElement);
				case "KalturaClientNotification":
					return new KalturaClientNotification(xmlElement);
				case "KalturaFilterPager":
					return new KalturaFilterPager(xmlElement);
				case "KalturaMediaEntry":
					return new KalturaMediaEntry(xmlElement);
				case "KalturaMediaEntryFilter":
					return new KalturaMediaEntryFilter(xmlElement);
				case "KalturaMediaListResponse":
					return new KalturaMediaListResponse(xmlElement);
				case "KalturaMixEntry":
					return new KalturaMixEntry(xmlElement);
				case "KalturaMixEntryFilter":
					return new KalturaMixEntryFilter(xmlElement);
				case "KalturaMixListResponse":
					return new KalturaMixListResponse(xmlElement);
				case "KalturaPartner":
					return new KalturaPartner(xmlElement);
				case "KalturaPartnerUsage":
					return new KalturaPartnerUsage(xmlElement);
				case "KalturaPlayableEntry":
					return new KalturaPlayableEntry(xmlElement);
				case "KalturaPlaylist":
					return new KalturaPlaylist(xmlElement);
				case "KalturaPlaylistFilter":
					return new KalturaPlaylistFilter(xmlElement);
				case "KalturaSearch":
					return new KalturaSearch(xmlElement);
				case "KalturaSearchResult":
					return new KalturaSearchResult(xmlElement);
				case "KalturaUiConf":
					return new KalturaUiConf(xmlElement);
				case "KalturaUiConfFilter":
					return new KalturaUiConfFilter(xmlElement);
				case "KalturaUser":
					return new KalturaUser(xmlElement);
				case "KalturaUserFilter":
					return new KalturaUserFilter(xmlElement);
				case "KalturaWidget":
					return new KalturaWidget(xmlElement);
				case "KalturaWidgetFilter":
					return new KalturaWidgetFilter(xmlElement);
			}
			throw new SerializationException("Invalid object type");
		}
	}
}
