package com.kaltura.commands.report
{
	import com.kaltura.vo.KalturaReportInputFilter;
	import com.kaltura.delegates.report.ReportGetTotalDelegate;
	import com.kaltura.net.KalturaCall;

	public class ReportGetTotal extends KalturaCall
	{
		public var filterFields : String;
		public function ReportGetTotal( reportType : int,reportInputFilter : KalturaReportInputFilter,objectIds : String='' )
		{
			service= 'report';
			action= 'getTotal';
			applySchema(['reportType','reportInputFilter:fromDate','reportInputFilter:toDate','reportInputFilter:keywords','reportInputFilter:searchInTags','reportInputFilter:searchInAdminTags','objectIds'] , reportType,reportInputFilter.fromDate,reportInputFilter.toDate,reportInputFilter.keywords,reportInputFilter.searchInTags,reportInputFilter.searchInAdminTags,objectIds);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new ReportGetTotalDelegate( this , config );
		}
	}
}
