package com.kaltura.vo
{
	import com.kaltura.vo.KalturaBaseJob;

	public dynamic class KalturaMailJob extends KalturaBaseJob
	{
		public var mailType : int = int.MIN_VALUE;
		public var mailPriority : int = int.MIN_VALUE;
		public var status : int = int.MIN_VALUE;
		public var recipientName : String;
		public var recipientEmail : String;
		public var recipientId : int = int.MIN_VALUE;
		public var fromName : String;
		public var fromEmail : String;
		public var bodyParams : String;
		public var subjectParams : String;
		public var templatePath : String;
		public var culture : int = int.MIN_VALUE;
		public var campaignId : int = int.MIN_VALUE;
		public var minSendDate : int = int.MIN_VALUE;
	}
}
