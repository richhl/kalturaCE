package com.kaltura.commands.media
{
	import com.kaltura.vo.KalturaFilterPager;
	import com.kaltura.delegates.media.MediaListFlagsDelegate;
	import com.kaltura.net.KalturaCall;

	public class MediaListFlags extends KalturaCall
	{
		public var filterFields : String;
		public function MediaListFlags( entryId : String,pager : KalturaFilterPager=null )
		{
			if(pager== null)pager= new KalturaFilterPager();
			service= 'media';
			action= 'listFlags';
			applySchema(['entryId','pager:pageSize','pager:pageIndex'] , entryId,pager.pageSize,pager.pageIndex);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new MediaListFlagsDelegate( this , config );
		}
	}
}
