package com.kaltura.vo
{
	import mx.utils.ObjectProxy;
	[Bindable]
	public dynamic class KalturaAdminUser extends ObjectProxy
	{
		public var password : String;
		public var email : String;
		public var screenName : String;
		override protected function setupPropertyList():void
		{
			super.setupPropertyList();
			propertyList.push('password');
			propertyList.push('email');
			propertyList.push('screenName');
		}
	}
}
