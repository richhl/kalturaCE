package com.kaltura.commands.report
{
	import com.kaltura.vo.KalturaReportInputFilter;
	import com.kaltura.vo.KalturaFilterPager;
	import com.kaltura.delegates.report.ReportGetTableDelegate;
	import com.kaltura.net.KalturaCall;

	public class ReportGetTable extends KalturaCall
	{
		public var filterFields : String;
		public function ReportGetTable( reportType : int,reportInputFilter : KalturaReportInputFilter,pager : KalturaFilterPager,order : String='',objectIds : String='' )
		{
			service= 'report';
			action= 'getTable';
			applySchema(['reportType','reportInputFilter:fromDate','reportInputFilter:toDate','reportInputFilter:keywords','reportInputFilter:searchInTags','reportInputFilter:searchInAdminTags','pager:pageSize','pager:pageIndex','order','objectIds'] , reportType,reportInputFilter.fromDate,reportInputFilter.toDate,reportInputFilter.keywords,reportInputFilter.searchInTags,reportInputFilter.searchInAdminTags,pager.pageSize,pager.pageIndex,order,objectIds);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new ReportGetTableDelegate( this , config );
		}
	}
}
