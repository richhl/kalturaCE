package com.kaltura.vo
{
	import com.kaltura.vo.KalturaBaseEntry;

	public dynamic class KalturaPlaylist extends KalturaBaseEntry
	{
		public var playlistContent : String;
		public var playlistType : int = int.MIN_VALUE;
		public var plays : int = int.MIN_VALUE;
		public var views : int = int.MIN_VALUE;
		public var duration : int = int.MIN_VALUE;
		override protected function setupPropertyList():void
		{
			super.setupPropertyList();
			propertyList.push('playlistContent');
			propertyList.push('playlistType');
			propertyList.push('plays');
			propertyList.push('views');
			propertyList.push('duration');
		}
	}
}
