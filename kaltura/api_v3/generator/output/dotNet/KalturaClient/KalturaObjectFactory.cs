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
				case "KalturaAdminUser":
					return new KalturaAdminUser(xmlElement);
				case "KalturaBaseEntry":
					return new KalturaBaseEntry(xmlElement);
				case "KalturaBaseEntryFilter":
					return new KalturaBaseEntryFilter(xmlElement);
				case "KalturaBaseEntryListResponse":
					return new KalturaBaseEntryListResponse(xmlElement);
				case "KalturaBaseEntryOrderBy":
					return new KalturaBaseEntryOrderBy(xmlElement);
				case "KalturaBaseJob":
					return new KalturaBaseJob(xmlElement);
				case "KalturaBatchGetExclusiveNotificationJobsResponse":
					return new KalturaBatchGetExclusiveNotificationJobsResponse(xmlElement);
				case "KalturaBatchJob":
					return new KalturaBatchJob(xmlElement);
				case "KalturaBulkUpload":
					return new KalturaBulkUpload(xmlElement);
				case "KalturaBulkUploadListResponse":
					return new KalturaBulkUploadListResponse(xmlElement);
				case "KalturaCEError":
					return new KalturaCEError(xmlElement);
				case "KalturaClientNotification":
					return new KalturaClientNotification(xmlElement);
				case "KalturaCommercialUseType":
					return new KalturaCommercialUseType(xmlElement);
				case "KalturaConversionProfile":
					return new KalturaConversionProfile(xmlElement);
				case "KalturaFilter":
					return new KalturaFilter(xmlElement);
				case "KalturaFilterPager":
					return new KalturaFilterPager(xmlElement);
				case "KalturaMailJob":
					return new KalturaMailJob(xmlElement);
				case "KalturaMediaEntry":
					return new KalturaMediaEntry(xmlElement);
				case "KalturaMediaEntryFilter":
					return new KalturaMediaEntryFilter(xmlElement);
				case "KalturaMediaEntryOrderBy":
					return new KalturaMediaEntryOrderBy(xmlElement);
				case "KalturaMediaListResponse":
					return new KalturaMediaListResponse(xmlElement);
				case "KalturaMixEntry":
					return new KalturaMixEntry(xmlElement);
				case "KalturaMixEntryFilter":
					return new KalturaMixEntryFilter(xmlElement);
				case "KalturaMixEntryOrderBy":
					return new KalturaMixEntryOrderBy(xmlElement);
				case "KalturaMixListResponse":
					return new KalturaMixListResponse(xmlElement);
				case "KalturaModerationFlag":
					return new KalturaModerationFlag(xmlElement);
				case "KalturaModerationFlagListResponse":
					return new KalturaModerationFlagListResponse(xmlElement);
				case "KalturaNotification":
					return new KalturaNotification(xmlElement);
				case "KalturaPartner":
					return new KalturaPartner(xmlElement);
				case "KalturaPartnerUsage":
					return new KalturaPartnerUsage(xmlElement);
				case "KalturaPlayableEntry":
					return new KalturaPlayableEntry(xmlElement);
				case "KalturaPlayableEntryFilter":
					return new KalturaPlayableEntryFilter(xmlElement);
				case "KalturaPlayableEntryOrderBy":
					return new KalturaPlayableEntryOrderBy(xmlElement);
				case "KalturaPlaylist":
					return new KalturaPlaylist(xmlElement);
				case "KalturaPlaylistFilter":
					return new KalturaPlaylistFilter(xmlElement);
				case "KalturaPlaylistListResponse":
					return new KalturaPlaylistListResponse(xmlElement);
				case "KalturaPlaylistOrderBy":
					return new KalturaPlaylistOrderBy(xmlElement);
				case "KalturaReportGraph":
					return new KalturaReportGraph(xmlElement);
				case "KalturaReportInputFilter":
					return new KalturaReportInputFilter(xmlElement);
				case "KalturaReportTable":
					return new KalturaReportTable(xmlElement);
				case "KalturaReportTotal":
					return new KalturaReportTotal(xmlElement);
				case "KalturaSearch":
					return new KalturaSearch(xmlElement);
				case "KalturaSearchResult":
					return new KalturaSearchResult(xmlElement);
				case "KalturaSearchResultResponse":
					return new KalturaSearchResultResponse(xmlElement);
				case "KalturaStartWidgetSessionResponse":
					return new KalturaStartWidgetSessionResponse(xmlElement);
				case "KalturaStatsEvent":
					return new KalturaStatsEvent(xmlElement);
				case "KalturaUiConf":
					return new KalturaUiConf(xmlElement);
				case "KalturaUiConfFilter":
					return new KalturaUiConfFilter(xmlElement);
				case "KalturaUiConfListResponse":
					return new KalturaUiConfListResponse(xmlElement);
				case "KalturaUiConfOrderBy":
					return new KalturaUiConfOrderBy(xmlElement);
				case "KalturaUser":
					return new KalturaUser(xmlElement);
				case "KalturaUserFilter":
					return new KalturaUserFilter(xmlElement);
				case "KalturaUserListResponse":
					return new KalturaUserListResponse(xmlElement);
				case "KalturaUserOrderBy":
					return new KalturaUserOrderBy(xmlElement);
				case "KalturaWidget":
					return new KalturaWidget(xmlElement);
				case "KalturaWidgetFilter":
					return new KalturaWidgetFilter(xmlElement);
				case "KalturaWidgetListResponse":
					return new KalturaWidgetListResponse(xmlElement);
				case "KalturaWidgetOrderBy":
					return new KalturaWidgetOrderBy(xmlElement);
			}
			throw new SerializationException("Invalid object type");
		}
	}
}
