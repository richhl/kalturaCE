package com.kaltura.commands.uiConf
{
	import com.kaltura.vo.KalturaUiConfFilter;
	import com.kaltura.vo.KalturaFilterPager;
	import com.kaltura.delegates.uiConf.UiConfListDelegate;
	import com.kaltura.net.KalturaCall;

	public class UiConfList extends KalturaCall
	{
		public var filterFields : String;
		public function UiConfList( filter : KalturaUiConfFilter=null,pager : KalturaFilterPager=null )
		{
			if(filter== null)filter= new KalturaUiConfFilter();
			if(pager== null)pager= new KalturaFilterPager();
			service= 'uiConf';
			action= 'list';
			applySchema(['filter:orderBy','filter:idEqual','filter:idIn','filter:nameLike','filter:tagsMultiLikeOr','filter:tagsMultiLikeAnd','filter:createdAtGreaterThanOrEqual','filter:createdAtLessThanOrEqual','filter:updatedAtGreaterThanOrEqual','filter:updatedAtLessThanOrEqual','pager:pageSize','pager:pageIndex'] , filter.orderBy,filter.idEqual,filter.idIn,filter.nameLike,filter.tagsMultiLikeOr,filter.tagsMultiLikeAnd,filter.createdAtGreaterThanOrEqual,filter.createdAtLessThanOrEqual,filter.updatedAtGreaterThanOrEqual,filter.updatedAtLessThanOrEqual,pager.pageSize,pager.pageIndex);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new UiConfListDelegate( this , config );
		}
	}
}
