package com.kaltura.vo
{
	import com.kaltura.vo.KalturaBaseJob;

	public dynamic class KalturaNotification extends KalturaBaseJob
	{
		public var puserId : String;
		public var type : int = int.MIN_VALUE;
		public var objectId : String;
		public var status : int = int.MIN_VALUE;
		public var notificationData : String;
		public var numberOfAttempts : int = int.MIN_VALUE;
		public var notificationResult : String;
		public var objectType : int = int.MIN_VALUE;
	}
}
