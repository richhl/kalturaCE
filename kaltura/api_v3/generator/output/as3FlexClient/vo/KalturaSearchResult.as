package com.kaltura.vo
{
	import com.kaltura.vo.KalturaSearch;

	public dynamic class KalturaSearchResult extends KalturaSearch
	{
		public var id : String;
		public var title : String;
		public var thumbUrl : String;
		public var description : String;
		public var tags : String;
		public var url : String;
		public var sourceLink : String;
		public var credit : String;
		public var licenseType : int = int.MIN_VALUE;
		public var flashPlaybackType : String;
		override protected function setupPropertyList():void
		{
			super.setupPropertyList();
			propertyList.push('id');
			propertyList.push('title');
			propertyList.push('thumbUrl');
			propertyList.push('description');
			propertyList.push('tags');
			propertyList.push('url');
			propertyList.push('sourceLink');
			propertyList.push('credit');
			propertyList.push('licenseType');
			propertyList.push('flashPlaybackType');
		}
	}
}
