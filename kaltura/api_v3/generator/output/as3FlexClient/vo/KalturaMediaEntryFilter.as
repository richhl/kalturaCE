package com.kaltura.vo
{
	import com.kaltura.vo.KalturaPlayableEntryFilter;

	public dynamic class KalturaMediaEntryFilter extends KalturaPlayableEntryFilter
	{
		public var mediaTypeEqual : int = int.MIN_VALUE;
		public var mediaTypeIn : String;
		public var mediaDateGreaterThanOrEqual : int = int.MIN_VALUE;
		public var mediaDateLessThanOrEqual : int = int.MIN_VALUE;
		override protected function setupPropertyList():void
		{
			super.setupPropertyList();
			propertyList.push('mediaTypeEqual');
			propertyList.push('mediaTypeIn');
			propertyList.push('mediaDateGreaterThanOrEqual');
			propertyList.push('mediaDateLessThanOrEqual');
		}
	}
}
