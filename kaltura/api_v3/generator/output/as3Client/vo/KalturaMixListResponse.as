package com.kaltura.vo
{
	public dynamic class KalturaMixListResponse
	{
		public var objects : Array = new Array();
		public var totalCount : int = int.MIN_VALUE;
		override protected function setupPropertyList():void
		{
			super.setupPropertyList();
			propertyList.push('objects');
			propertyList.push('totalCount');
		}
	}
}
