package com.kaltura.commands.search
{
	import com.kaltura.delegates.search.SearchSearchUrlDelegate;
	import com.kaltura.net.KalturaCall;

	public class SearchSearchUrl extends KalturaCall
	{
		public var filterFields : String;
		public function SearchSearchUrl( mediaType : int,url : String )
		{
			service= 'search';
			action= 'searchUrl';
			applySchema(['mediaType','url'] , mediaType,url);
		}

		override public function execute() : void
		{
			setRequestArgument('filterFields',filterFields);
			delegate = new SearchSearchUrlDelegate( this , config );
		}
	}
}
