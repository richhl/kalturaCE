package com.kaltura.vo
{
	import com.kaltura.vo.KalturaBaseJob;

	public dynamic class KalturaBatchJob extends KalturaBaseJob
	{
		public var entryId : String;
		public var jobType : int = int.MIN_VALUE;
		public var data : String;
		public var status : int = int.MIN_VALUE;
		public var abort : int = int.MIN_VALUE;
		public var checkAgainTimeout : int = int.MIN_VALUE;
		public var progress : int = int.MIN_VALUE;
		public var message : String;
		public var description : String;
		public var updatesCount : int = int.MIN_VALUE;
		public var parentJobId : int = int.MIN_VALUE;
	}
}
