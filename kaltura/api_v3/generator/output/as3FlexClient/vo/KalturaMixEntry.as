package com.kaltura.vo
{
	import com.kaltura.vo.KalturaPlayableEntry;

	public dynamic class KalturaMixEntry extends KalturaPlayableEntry
	{
		public var hasRealThumbnail : Boolean;
		public var editorType : int = int.MIN_VALUE;
		public var dataContent : String;
		override protected function setupPropertyList():void
		{
			super.setupPropertyList();
			propertyList.push('hasRealThumbnail');
			propertyList.push('editorType');
			propertyList.push('dataContent');
		}
	}
}
