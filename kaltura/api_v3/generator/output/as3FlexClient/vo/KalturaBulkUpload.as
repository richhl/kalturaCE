package com.kaltura.vo
{
	import mx.utils.ObjectProxy;
	[Bindable]
	public dynamic class KalturaBulkUpload extends ObjectProxy
	{
		public var id : int = int.MIN_VALUE;
		public var uploadedBy : String;
		public var uploadedOn : int = int.MIN_VALUE;
		public var numOfEntries : int = int.MIN_VALUE;
		public var status : int = int.MIN_VALUE;
		public var logFileUrl : String;
		public var csvFileUrl : String;
		override protected function setupPropertyList():void
		{
			super.setupPropertyList();
			propertyList.push('id');
			propertyList.push('uploadedBy');
			propertyList.push('uploadedOn');
			propertyList.push('numOfEntries');
			propertyList.push('status');
			propertyList.push('logFileUrl');
			propertyList.push('csvFileUrl');
		}
	}
}
