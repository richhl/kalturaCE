namespace Kaltura
{
	public enum KalturaBatchJobStatus
	{
		PENDING = 0,
		QUEUED = 1,
		PROCESSING = 2,
		PROCESSED = 3,
		MOVEFILE = 4,
		FINISHED = 5,
		FAILED = 6,
		ABORTED = 7,
	}
}
