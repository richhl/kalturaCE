package com.kaltura.vo
{
	import mx.utils.ObjectProxy;
	[Bindable]
	public dynamic class KalturaUser extends ObjectProxy
	{
		public var id : String;
		public var partnerId : int = int.MIN_VALUE;
		public var screenName : String;
		public var fullName : String;
		public var email : String;
		public var dateOfBirth : int = int.MIN_VALUE;
		public var country : String;
		public var state : String;
		public var city : String;
		public var zip : String;
		public var thumbnailUrl : String;
		public var description : String;
		public var tags : String;
		public var adminTags : String;
		public var gender : int = int.MIN_VALUE;
		public var status : int = int.MIN_VALUE;
		public var createdAt : int = int.MIN_VALUE;
		public var updatedAt : int = int.MIN_VALUE;
		public var partnerData : String;
		public var indexedPartnerDataInt : int = int.MIN_VALUE;
		public var indexedPartnerDataString : String;
		public var storageSize : int = int.MIN_VALUE;
		override protected function setupPropertyList():void
		{
			super.setupPropertyList();
			propertyList.push('id');
			propertyList.push('partnerId');
			propertyList.push('screenName');
			propertyList.push('fullName');
			propertyList.push('email');
			propertyList.push('dateOfBirth');
			propertyList.push('country');
			propertyList.push('state');
			propertyList.push('city');
			propertyList.push('zip');
			propertyList.push('thumbnailUrl');
			propertyList.push('description');
			propertyList.push('tags');
			propertyList.push('adminTags');
			propertyList.push('gender');
			propertyList.push('status');
			propertyList.push('createdAt');
			propertyList.push('updatedAt');
			propertyList.push('partnerData');
			propertyList.push('indexedPartnerDataInt');
			propertyList.push('indexedPartnerDataString');
			propertyList.push('storageSize');
		}
	}
}
