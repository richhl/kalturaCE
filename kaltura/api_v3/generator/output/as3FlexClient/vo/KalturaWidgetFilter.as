package com.kaltura.vo
{
	import com.kaltura.vo.KalturaFilter;

	public dynamic class KalturaWidgetFilter extends KalturaFilter
	{
		public var idEqual : String;
		public var idIn : String;
		public var sourceWidgetIdEqual : String;
		public var rootWidgetIdEqual : String;
		public var partnerIdEqual : int = int.MIN_VALUE;
		public var entryIdEqual : String;
		public var uiConfIdEqual : int = int.MIN_VALUE;
		public var createdAtGreaterThanOrEqual : int = int.MIN_VALUE;
		public var createdAtLessThanOrEqual : int = int.MIN_VALUE;
		public var updatedAtGreaterThanOrEqual : int = int.MIN_VALUE;
		public var updatedAtLessThanOrEqual : int = int.MIN_VALUE;
		public var partnerDataLike : String;
		override protected function setupPropertyList():void
		{
			super.setupPropertyList();
			propertyList.push('idEqual');
			propertyList.push('idIn');
			propertyList.push('sourceWidgetIdEqual');
			propertyList.push('rootWidgetIdEqual');
			propertyList.push('partnerIdEqual');
			propertyList.push('entryIdEqual');
			propertyList.push('uiConfIdEqual');
			propertyList.push('createdAtGreaterThanOrEqual');
			propertyList.push('createdAtLessThanOrEqual');
			propertyList.push('updatedAtGreaterThanOrEqual');
			propertyList.push('updatedAtLessThanOrEqual');
			propertyList.push('partnerDataLike');
		}
	}
}
