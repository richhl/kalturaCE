package com.kaltura.vo
{
	public dynamic class KalturaSearchResultResponse
	{
		public var objects : Array = new Array();
		public var needMediaInfo : Boolean;
		override protected function setupPropertyList():void
		{
			super.setupPropertyList();
			propertyList.push('objects');
			propertyList.push('needMediaInfo');
		}
	}
}
