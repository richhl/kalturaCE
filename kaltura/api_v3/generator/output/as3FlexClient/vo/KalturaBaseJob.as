package com.kaltura.vo
{
	import mx.utils.ObjectProxy;
	[Bindable]
	public dynamic class KalturaBaseJob extends ObjectProxy
	{
		public var id : int = int.MIN_VALUE;
		public var partnerId : int = int.MIN_VALUE;
		public var createdAt : int = int.MIN_VALUE;
		public var updatedAt : int = int.MIN_VALUE;
		public var processorName : String;
		public var processorLocation : String;
		public var processorExpiration : int = int.MIN_VALUE;
	}
}
