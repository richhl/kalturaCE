package com.kaltura.commands.report
{
	import com.kaltura.vo.KalturaReportInputFilter;
	import com.kaltura.vo.KalturaFilterPager;
	import com.kaltura.delegates.report.ReportGetUrlForReportAsCsvDelegate;
	import com.kaltura.net.KalturaCall;

	public class ReportGetUrlForReportAsCsv extends KalturaCall
	{
		public var filterFields : String;
		public function ReportGetUrlForReportAsCsv( reportTitle : String,reportText : String,headers : String,reportType : int,reportInputFilter : KalturaReportInputFilter,dimension : String='',pager : KalturaFilterPager=null,order : String='',objectIds : String='' )
		{
			if(pager== null)pager= new KalturaFilterPager();
			service= 'report';
			action= 'getUrlForReportAsCsv';
			applySchema(['reportTitle','reportText','headers','reportType','reportInputFilter:fromDate','reportInputFilter:toDate','reportInputFilter:keywords','reportInputFilter:searchInTags','reportInputFilter:searchInAdminTags','dimension','pager:pageSize','pager:pageIndex','order','objectIds'] , reportTitle,reportText,headers,reportType,reportInputFilter.fromDate,reportInputFilter.toDate,reportInputFilter.keywords,reportInputFilter.searchInTags,reportInputFilter.searchInAdminTags,dimension,pager.pageSize,pager.pageIndex,order,objectIds);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new ReportGetUrlForReportAsCsvDelegate( this , config );
		}
	}
}
