package com.kaltura.commands.widget
{
	import com.kaltura.vo.KalturaWidgetFilter;
	import com.kaltura.vo.KalturaFilterPager;
	import com.kaltura.delegates.widget.WidgetListDelegate;
	import com.kaltura.net.KalturaCall;

	public class WidgetList extends KalturaCall
	{
		public var filterFields : String;
		public function WidgetList( filter : KalturaWidgetFilter=null,pager : KalturaFilterPager=null )
		{
			if(filter== null)filter= new KalturaWidgetFilter();
			if(pager== null)pager= new KalturaFilterPager();
			service= 'widget';
			action= 'list';
			applySchema(['filter:orderBy','filter:idEqual','filter:idIn','filter:sourceWidgetIdEqual','filter:rootWidgetIdEqual','filter:partnerIdEqual','filter:entryIdEqual','filter:uiConfIdEqual','filter:createdAtGreaterThanOrEqual','filter:createdAtLessThanOrEqual','filter:updatedAtGreaterThanOrEqual','filter:updatedAtLessThanOrEqual','filter:partnerDataLike','pager:pageSize','pager:pageIndex'] , filter.orderBy,filter.idEqual,filter.idIn,filter.sourceWidgetIdEqual,filter.rootWidgetIdEqual,filter.partnerIdEqual,filter.entryIdEqual,filter.uiConfIdEqual,filter.createdAtGreaterThanOrEqual,filter.createdAtLessThanOrEqual,filter.updatedAtGreaterThanOrEqual,filter.updatedAtLessThanOrEqual,filter.partnerDataLike,pager.pageSize,pager.pageIndex);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new WidgetListDelegate( this , config );
		}
	}
}
