package com.kaltura.vo
{
	import mx.utils.ObjectProxy;
	[Bindable]
	public dynamic class KalturaCEError extends ObjectProxy
	{
		public var id : String;
		public var partnerId : int = int.MIN_VALUE;
		public var browser : String;
		public var serverIp : String;
		public var serverOs : String;
		public var phpVersion : String;
		public var ceAdminEmail : String;
		public var type : String;
		public var description : String;
		public var data : String;
		override protected function setupPropertyList():void
		{
			super.setupPropertyList();
			propertyList.push('id');
			propertyList.push('partnerId');
			propertyList.push('browser');
			propertyList.push('serverIp');
			propertyList.push('serverOs');
			propertyList.push('phpVersion');
			propertyList.push('ceAdminEmail');
			propertyList.push('type');
			propertyList.push('description');
			propertyList.push('data');
		}
	}
}
