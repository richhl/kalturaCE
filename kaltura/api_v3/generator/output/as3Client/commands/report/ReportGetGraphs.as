package com.kaltura.commands.report
{
	import com.kaltura.vo.KalturaReportInputFilter;
	import com.kaltura.delegates.report.ReportGetGraphsDelegate;
	import com.kaltura.net.KalturaCall;

	public class ReportGetGraphs extends KalturaCall
	{
		public var filterFields : String;
		public function ReportGetGraphs( reportType : int,reportInputFilter : KalturaReportInputFilter,dimension : String='',objectIds : String='' )
		{
			service= 'report';
			action= 'getGraphs';
			applySchema(['reportType','reportInputFilter:fromDate','reportInputFilter:toDate','reportInputFilter:keywords','reportInputFilter:searchInTags','reportInputFilter:searchInAdminTags','dimension','objectIds'] , reportType,reportInputFilter.fromDate,reportInputFilter.toDate,reportInputFilter.keywords,reportInputFilter.searchInTags,reportInputFilter.searchInAdminTags,dimension,objectIds);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new ReportGetGraphsDelegate( this , config );
		}
	}
}
