package com.kaltura.vo
{
	import com.kaltura.vo.KalturaBaseEntry;

	public dynamic class KalturaPlayableEntry extends KalturaBaseEntry
	{
		public var plays : int = int.MIN_VALUE;
		public var views : int = int.MIN_VALUE;
		public var width : int = int.MIN_VALUE;
		public var height : int = int.MIN_VALUE;
		public var thumbnailUrl : String;
		public var duration : int = int.MIN_VALUE;
		override protected function setupPropertyList():void
		{
			super.setupPropertyList();
			propertyList.push('plays');
			propertyList.push('views');
			propertyList.push('width');
			propertyList.push('height');
			propertyList.push('thumbnailUrl');
			propertyList.push('duration');
		}
	}
}
