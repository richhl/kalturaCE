package com.kaltura.vo
{
	public dynamic class KalturaModerationFlag
	{
		public var id : int = int.MIN_VALUE;
		public var partnerId : int = int.MIN_VALUE;
		public var userId : String;
		public var objectType : int = int.MIN_VALUE;
		public var flaggedEntryId : String;
		public var flaggedUserId : String;
		public var status : int = int.MIN_VALUE;
		public var comments : String;
		public var flagType : int = int.MIN_VALUE;
		public var createdAt : int = int.MIN_VALUE;
		public var updatedAt : int = int.MIN_VALUE;
		override protected function setupPropertyList():void
		{
			super.setupPropertyList();
			propertyList.push('id');
			propertyList.push('partnerId');
			propertyList.push('userId');
			propertyList.push('objectType');
			propertyList.push('flaggedEntryId');
			propertyList.push('flaggedUserId');
			propertyList.push('status');
			propertyList.push('comments');
			propertyList.push('flagType');
			propertyList.push('createdAt');
			propertyList.push('updatedAt');
		}
	}
}
