package com.kaltura.vo
{
	public dynamic class KalturaFilter
	{
		public var orderBy : String;
		override protected function setupPropertyList():void
		{
			super.setupPropertyList();
			propertyList.push('orderBy');
		}
	}
}
