package com.kaltura.vo
{
	import com.kaltura.vo.KalturaFilter;

	public dynamic class KalturaBaseEntryFilter extends KalturaFilter
	{
		public var idEqual : String;
		public var idIn : String;
		public var nameLike : String;
		public var nameMultiLikeOr : String;
		public var nameMultiLikeAnd : String;
		public var nameEqual : String;
		public var partnerIdEqual : int = int.MIN_VALUE;
		public var partnerIdIn : String;
		public var userIdEqual : String;
		public var tagsLike : String;
		public var tagsMultiLikeOr : String;
		public var tagsMultiLikeAnd : String;
		public var adminTagsLike : String;
		public var adminTagsMultiLikeOr : String;
		public var adminTagsMultiLikeAnd : String;
		public var statusEqual : int = int.MIN_VALUE;
		public var statusIn : String;
		public var typeEqual : int = int.MIN_VALUE;
		public var typeIn : String;
		public var createdAtGreaterThanOrEqual : int = int.MIN_VALUE;
		public var createdAtLessThanOrEqual : int = int.MIN_VALUE;
		public var groupIdEqual : int = int.MIN_VALUE;
		public var searchTextMatchAnd : String;
		public var searchTextMatchOr : String;
		public var tagsNameMultiLikeOr : String;
		public var tagsAdminTagsMultiLikeOr : String;
		public var tagsAdminTagsNameMultiLikeOr : String;
		public var tagsNameMultiLikeAnd : String;
		public var tagsAdminTagsMultiLikeAnd : String;
		public var tagsAdminTagsNameMultiLikeAnd : String;
		override protected function setupPropertyList():void
		{
			super.setupPropertyList();
			propertyList.push('idEqual');
			propertyList.push('idIn');
			propertyList.push('nameLike');
			propertyList.push('nameMultiLikeOr');
			propertyList.push('nameMultiLikeAnd');
			propertyList.push('nameEqual');
			propertyList.push('partnerIdEqual');
			propertyList.push('partnerIdIn');
			propertyList.push('userIdEqual');
			propertyList.push('tagsLike');
			propertyList.push('tagsMultiLikeOr');
			propertyList.push('tagsMultiLikeAnd');
			propertyList.push('adminTagsLike');
			propertyList.push('adminTagsMultiLikeOr');
			propertyList.push('adminTagsMultiLikeAnd');
			propertyList.push('statusEqual');
			propertyList.push('statusIn');
			propertyList.push('typeEqual');
			propertyList.push('typeIn');
			propertyList.push('createdAtGreaterThanOrEqual');
			propertyList.push('createdAtLessThanOrEqual');
			propertyList.push('groupIdEqual');
			propertyList.push('searchTextMatchAnd');
			propertyList.push('searchTextMatchOr');
			propertyList.push('tagsNameMultiLikeOr');
			propertyList.push('tagsAdminTagsMultiLikeOr');
			propertyList.push('tagsAdminTagsNameMultiLikeOr');
			propertyList.push('tagsNameMultiLikeAnd');
			propertyList.push('tagsAdminTagsMultiLikeAnd');
			propertyList.push('tagsAdminTagsNameMultiLikeAnd');
		}
	}
}
