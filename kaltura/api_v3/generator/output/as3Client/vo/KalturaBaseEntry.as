package com.kaltura.vo
{
	public dynamic class KalturaBaseEntry
	{
		public var id : String;
		public var name : String;
		public var description : String;
		public var partnerId : int = int.MIN_VALUE;
		public var userId : String;
		public var tags : String;
		public var adminTags : String;
		public var status : int = int.MIN_VALUE;
		public var type : int = int.MIN_VALUE;
		public var createdAt : int = int.MIN_VALUE;
		public var rank : int = int.MIN_VALUE;
		public var totalRank : int = int.MIN_VALUE;
		public var votes : int = int.MIN_VALUE;
		public var groupId : int = int.MIN_VALUE;
		public var partnerData : String;
		public var downloadUrl : String;
		public var searchText : String;
		public var licenseType : int = int.MIN_VALUE;
		public var version : int = int.MIN_VALUE;
		override protected function setupPropertyList():void
		{
			super.setupPropertyList();
			propertyList.push('id');
			propertyList.push('name');
			propertyList.push('description');
			propertyList.push('partnerId');
			propertyList.push('userId');
			propertyList.push('tags');
			propertyList.push('adminTags');
			propertyList.push('status');
			propertyList.push('type');
			propertyList.push('createdAt');
			propertyList.push('rank');
			propertyList.push('totalRank');
			propertyList.push('votes');
			propertyList.push('groupId');
			propertyList.push('partnerData');
			propertyList.push('downloadUrl');
			propertyList.push('searchText');
			propertyList.push('licenseType');
			propertyList.push('version');
		}
	}
}
