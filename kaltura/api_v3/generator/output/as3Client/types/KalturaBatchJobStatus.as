package com.kaltura.types
{
	public class KalturaBatchJobStatus
	{
		public static const PENDING : int = 0;
		public static const QUEUED : int = 1;
		public static const PROCESSING : int = 2;
		public static const PROCESSED : int = 3;
		public static const MOVEFILE : int = 4;
		public static const FINISHED : int = 5;
		public static const FAILED : int = 6;
		public static const ABORTED : int = 7;
	}
}
