package com.kaltura.vo
{
	import com.kaltura.vo.KalturaPlayableEntry;

	public dynamic class KalturaMediaEntry extends KalturaPlayableEntry
	{
		public var mediaType : int = int.MIN_VALUE;
		public var conversionQuality : String;
		public var sourceType : int = int.MIN_VALUE;
		public var searchProviderType : int = int.MIN_VALUE;
		public var searchProviderId : String;
		public var creditUserName : String;
		public var creditUrl : String;
		public var mediaDate : int = int.MIN_VALUE;
		public var dataUrl : String;
		override protected function setupPropertyList():void
		{
			super.setupPropertyList();
			propertyList.push('mediaType');
			propertyList.push('conversionQuality');
			propertyList.push('sourceType');
			propertyList.push('searchProviderType');
			propertyList.push('searchProviderId');
			propertyList.push('creditUserName');
			propertyList.push('creditUrl');
			propertyList.push('mediaDate');
			propertyList.push('dataUrl');
		}
	}
}
