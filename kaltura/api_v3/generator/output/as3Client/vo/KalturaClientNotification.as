package com.kaltura.vo
{
	public dynamic class KalturaClientNotification
	{
		public var url : String;
		public var data : String;
		override protected function setupPropertyList():void
		{
			super.setupPropertyList();
			propertyList.push('url');
			propertyList.push('data');
		}
	}
}
