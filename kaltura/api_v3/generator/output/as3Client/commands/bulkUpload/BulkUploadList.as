package com.kaltura.commands.bulkUpload
{
	import com.kaltura.vo.KalturaFilterPager;
	import com.kaltura.delegates.bulkUpload.BulkUploadListDelegate;
	import com.kaltura.net.KalturaCall;

	public class BulkUploadList extends KalturaCall
	{
		public var filterFields : String;
		public function BulkUploadList( pager : KalturaFilterPager=null )
		{
			if(pager== null)pager= new KalturaFilterPager();
			service= 'bulkUpload';
			action= 'list';
			applySchema(['pager:pageSize','pager:pageIndex'] , pager.pageSize,pager.pageIndex);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new BulkUploadListDelegate( this , config );
		}
	}
}
