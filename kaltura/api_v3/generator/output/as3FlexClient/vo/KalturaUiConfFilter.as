package com.kaltura.vo
{
	import com.kaltura.vo.KalturaFilter;

	public dynamic class KalturaUiConfFilter extends KalturaFilter
	{
		public var idEqual : String;
		public var idIn : String;
		public var nameLike : String;
		public var tagsMultiLikeOr : String;
		public var tagsMultiLikeAnd : String;
		public var createdAtGreaterThanOrEqual : int = int.MIN_VALUE;
		public var createdAtLessThanOrEqual : int = int.MIN_VALUE;
		public var updatedAtGreaterThanOrEqual : int = int.MIN_VALUE;
		public var updatedAtLessThanOrEqual : int = int.MIN_VALUE;
		override protected function setupPropertyList():void
		{
			super.setupPropertyList();
			propertyList.push('idEqual');
			propertyList.push('idIn');
			propertyList.push('nameLike');
			propertyList.push('tagsMultiLikeOr');
			propertyList.push('tagsMultiLikeAnd');
			propertyList.push('createdAtGreaterThanOrEqual');
			propertyList.push('createdAtLessThanOrEqual');
			propertyList.push('updatedAtGreaterThanOrEqual');
			propertyList.push('updatedAtLessThanOrEqual');
		}
	}
}
