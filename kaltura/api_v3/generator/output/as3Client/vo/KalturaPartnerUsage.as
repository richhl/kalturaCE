package com.kaltura.vo
{
	public dynamic class KalturaPartnerUsage
	{
		public var hostingGB : Number = NaN;
		public var Percent : Number = NaN;
		public var packageBW : int = int.MIN_VALUE;
		public var usageGB : int = int.MIN_VALUE;
		public var reachedLimitDate : int = int.MIN_VALUE;
		public var usageGraph : String;
		override protected function setupPropertyList():void
		{
			super.setupPropertyList();
			propertyList.push('hostingGB');
			propertyList.push('Percent');
			propertyList.push('packageBW');
			propertyList.push('usageGB');
			propertyList.push('reachedLimitDate');
			propertyList.push('usageGraph');
		}
	}
}
