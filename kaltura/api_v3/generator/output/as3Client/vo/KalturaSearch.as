package com.kaltura.vo
{
	public dynamic class KalturaSearch
	{
		public var keyWords : String;
		public var searchSource : int = int.MIN_VALUE;
		public var mediaType : int = int.MIN_VALUE;
		public var extraData : String;
		override protected function setupPropertyList():void
		{
			super.setupPropertyList();
			propertyList.push('keyWords');
			propertyList.push('searchSource');
			propertyList.push('mediaType');
			propertyList.push('extraData');
		}
	}
}
