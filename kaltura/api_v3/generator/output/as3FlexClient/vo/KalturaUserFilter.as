package com.kaltura.vo
{
	import com.kaltura.vo.KalturaFilter;

	public dynamic class KalturaUserFilter extends KalturaFilter
	{
		public var idEqual : String;
		public var idIn : String;
		public var partnerIdEqual : int = int.MIN_VALUE;
		public var screenNameLike : String;
		public var screenNameStartsWith : String;
		public var emailLike : String;
		public var emailStartsWith : String;
		public var tagsMultiLikeOr : String;
		public var tagsMultiLikeAnd : String;
		public var createdAtGreaterThanOrEqual : int = int.MIN_VALUE;
		public var createdAtLessThanOrEqual : int = int.MIN_VALUE;
		override protected function setupPropertyList():void
		{
			super.setupPropertyList();
			propertyList.push('idEqual');
			propertyList.push('idIn');
			propertyList.push('partnerIdEqual');
			propertyList.push('screenNameLike');
			propertyList.push('screenNameStartsWith');
			propertyList.push('emailLike');
			propertyList.push('emailStartsWith');
			propertyList.push('tagsMultiLikeOr');
			propertyList.push('tagsMultiLikeAnd');
			propertyList.push('createdAtGreaterThanOrEqual');
			propertyList.push('createdAtLessThanOrEqual');
		}
	}
}
