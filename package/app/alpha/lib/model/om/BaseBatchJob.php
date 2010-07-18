<?php


abstract class BaseBatchJob extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $job_type;


	
	protected $job_sub_type;


	
	protected $data;


	
	protected $file_size = 0;


	
	protected $duplication_key;


	
	protected $status;


	
	protected $abort;


	
	protected $check_again_timeout;


	
	protected $progress;


	
	protected $message;


	
	protected $description;


	
	protected $updates_count;


	
	protected $created_at;


	
	protected $created_by;


	
	protected $updated_at;


	
	protected $updated_by;


	
	protected $deleted_at;


	
	protected $priority;


	
	protected $work_group_id;


	
	protected $queue_time;


	
	protected $finish_time;


	
	protected $entry_id = '';


	
	protected $partner_id = 0;


	
	protected $subp_id = 0;


	
	protected $scheduler_id;


	
	protected $worker_id;


	
	protected $batch_index;


	
	protected $last_scheduler_id;


	
	protected $last_worker_id;


	
	protected $last_worker_remote;


	
	protected $processor_expiration;


	
	protected $execution_attempts;


	
	protected $lock_version;


	
	protected $twin_job_id = 0;


	
	protected $bulk_job_id = 0;


	
	protected $root_job_id = 0;


	
	protected $parent_job_id = 0;


	
	protected $dc;


	
	protected $err_type;


	
	protected $err_number;


	
	protected $on_stress_divert_to;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getJobType()
	{

		return $this->job_type;
	}

	
	public function getJobSubType()
	{

		return $this->job_sub_type;
	}

	
	public function getData()
	{

		return $this->data;
	}

	
	public function getFileSize()
	{

		return $this->file_size;
	}

	
	public function getDuplicationKey()
	{

		return $this->duplication_key;
	}

	
	public function getStatus()
	{

		return $this->status;
	}

	
	public function getAbort()
	{

		return $this->abort;
	}

	
	public function getCheckAgainTimeout()
	{

		return $this->check_again_timeout;
	}

	
	public function getProgress()
	{

		return $this->progress;
	}

	
	public function getMessage()
	{

		return $this->message;
	}

	
	public function getDescription()
	{

		return $this->description;
	}

	
	public function getUpdatesCount()
	{

		return $this->updates_count;
	}

	
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->created_at === null || $this->created_at === '') {
			return null;
		} elseif (!is_int($this->created_at)) {
						$ts = strtotime($this->created_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [created_at] as date/time value: " . var_export($this->created_at, true));
			}
		} else {
			$ts = $this->created_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getCreatedBy()
	{

		return $this->created_by;
	}

	
	public function getUpdatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->updated_at === null || $this->updated_at === '') {
			return null;
		} elseif (!is_int($this->updated_at)) {
						$ts = strtotime($this->updated_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [updated_at] as date/time value: " . var_export($this->updated_at, true));
			}
		} else {
			$ts = $this->updated_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getUpdatedBy()
	{

		return $this->updated_by;
	}

	
	public function getDeletedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->deleted_at === null || $this->deleted_at === '') {
			return null;
		} elseif (!is_int($this->deleted_at)) {
						$ts = strtotime($this->deleted_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [deleted_at] as date/time value: " . var_export($this->deleted_at, true));
			}
		} else {
			$ts = $this->deleted_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getPriority()
	{

		return $this->priority;
	}

	
	public function getWorkGroupId()
	{

		return $this->work_group_id;
	}

	
	public function getQueueTime($format = 'Y-m-d H:i:s')
	{

		if ($this->queue_time === null || $this->queue_time === '') {
			return null;
		} elseif (!is_int($this->queue_time)) {
						$ts = strtotime($this->queue_time);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [queue_time] as date/time value: " . var_export($this->queue_time, true));
			}
		} else {
			$ts = $this->queue_time;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getFinishTime($format = 'Y-m-d H:i:s')
	{

		if ($this->finish_time === null || $this->finish_time === '') {
			return null;
		} elseif (!is_int($this->finish_time)) {
						$ts = strtotime($this->finish_time);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [finish_time] as date/time value: " . var_export($this->finish_time, true));
			}
		} else {
			$ts = $this->finish_time;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getEntryId()
	{

		return $this->entry_id;
	}

	
	public function getPartnerId()
	{

		return $this->partner_id;
	}

	
	public function getSubpId()
	{

		return $this->subp_id;
	}

	
	public function getSchedulerId()
	{

		return $this->scheduler_id;
	}

	
	public function getWorkerId()
	{

		return $this->worker_id;
	}

	
	public function getBatchIndex()
	{

		return $this->batch_index;
	}

	
	public function getLastSchedulerId()
	{

		return $this->last_scheduler_id;
	}

	
	public function getLastWorkerId()
	{

		return $this->last_worker_id;
	}

	
	public function getLastWorkerRemote()
	{

		return $this->last_worker_remote;
	}

	
	public function getProcessorExpiration($format = 'Y-m-d H:i:s')
	{

		if ($this->processor_expiration === null || $this->processor_expiration === '') {
			return null;
		} elseif (!is_int($this->processor_expiration)) {
						$ts = strtotime($this->processor_expiration);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [processor_expiration] as date/time value: " . var_export($this->processor_expiration, true));
			}
		} else {
			$ts = $this->processor_expiration;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getExecutionAttempts()
	{

		return $this->execution_attempts;
	}

	
	public function getLockVersion()
	{

		return $this->lock_version;
	}

	
	public function getTwinJobId()
	{

		return $this->twin_job_id;
	}

	
	public function getBulkJobId()
	{

		return $this->bulk_job_id;
	}

	
	public function getRootJobId()
	{

		return $this->root_job_id;
	}

	
	public function getParentJobId()
	{

		return $this->parent_job_id;
	}

	
	public function getDc()
	{

		return $this->dc;
	}

	
	public function getErrType()
	{

		return $this->err_type;
	}

	
	public function getErrNumber()
	{

		return $this->err_number;
	}

	
	public function getOnStressDivertTo()
	{

		return $this->on_stress_divert_to;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = BatchJobPeer::ID;
		}

	} 
	
	public function setJobType($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->job_type !== $v) {
			$this->job_type = $v;
			$this->modifiedColumns[] = BatchJobPeer::JOB_TYPE;
		}

	} 
	
	public function setJobSubType($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->job_sub_type !== $v) {
			$this->job_sub_type = $v;
			$this->modifiedColumns[] = BatchJobPeer::JOB_SUB_TYPE;
		}

	} 
	
	public function setData($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->data !== $v) {
			$this->data = $v;
			$this->modifiedColumns[] = BatchJobPeer::DATA;
		}

	} 
	
	public function setFileSize($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->file_size !== $v || $v === 0) {
			$this->file_size = $v;
			$this->modifiedColumns[] = BatchJobPeer::FILE_SIZE;
		}

	} 
	
	public function setDuplicationKey($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->duplication_key !== $v) {
			$this->duplication_key = $v;
			$this->modifiedColumns[] = BatchJobPeer::DUPLICATION_KEY;
		}

	} 
	
	public function setStatus($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->status !== $v) {
			$this->status = $v;
			$this->modifiedColumns[] = BatchJobPeer::STATUS;
		}

	} 
	
	public function setAbort($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->abort !== $v) {
			$this->abort = $v;
			$this->modifiedColumns[] = BatchJobPeer::ABORT;
		}

	} 
	
	public function setCheckAgainTimeout($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->check_again_timeout !== $v) {
			$this->check_again_timeout = $v;
			$this->modifiedColumns[] = BatchJobPeer::CHECK_AGAIN_TIMEOUT;
		}

	} 
	
	public function setProgress($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->progress !== $v) {
			$this->progress = $v;
			$this->modifiedColumns[] = BatchJobPeer::PROGRESS;
		}

	} 
	
	public function setMessage($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->message !== $v) {
			$this->message = $v;
			$this->modifiedColumns[] = BatchJobPeer::MESSAGE;
		}

	} 
	
	public function setDescription($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = BatchJobPeer::DESCRIPTION;
		}

	} 
	
	public function setUpdatesCount($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->updates_count !== $v) {
			$this->updates_count = $v;
			$this->modifiedColumns[] = BatchJobPeer::UPDATES_COUNT;
		}

	} 
	
	public function setCreatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [created_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->created_at !== $ts) {
			$this->created_at = $ts;
			$this->modifiedColumns[] = BatchJobPeer::CREATED_AT;
		}

	} 
	
	public function setCreatedBy($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->created_by !== $v) {
			$this->created_by = $v;
			$this->modifiedColumns[] = BatchJobPeer::CREATED_BY;
		}

	} 
	
	public function setUpdatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [updated_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->updated_at !== $ts) {
			$this->updated_at = $ts;
			$this->modifiedColumns[] = BatchJobPeer::UPDATED_AT;
		}

	} 
	
	public function setUpdatedBy($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->updated_by !== $v) {
			$this->updated_by = $v;
			$this->modifiedColumns[] = BatchJobPeer::UPDATED_BY;
		}

	} 
	
	public function setDeletedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [deleted_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->deleted_at !== $ts) {
			$this->deleted_at = $ts;
			$this->modifiedColumns[] = BatchJobPeer::DELETED_AT;
		}

	} 
	
	public function setPriority($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->priority !== $v) {
			$this->priority = $v;
			$this->modifiedColumns[] = BatchJobPeer::PRIORITY;
		}

	} 
	
	public function setWorkGroupId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->work_group_id !== $v) {
			$this->work_group_id = $v;
			$this->modifiedColumns[] = BatchJobPeer::WORK_GROUP_ID;
		}

	} 
	
	public function setQueueTime($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [queue_time] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->queue_time !== $ts) {
			$this->queue_time = $ts;
			$this->modifiedColumns[] = BatchJobPeer::QUEUE_TIME;
		}

	} 
	
	public function setFinishTime($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [finish_time] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->finish_time !== $ts) {
			$this->finish_time = $ts;
			$this->modifiedColumns[] = BatchJobPeer::FINISH_TIME;
		}

	} 
	
	public function setEntryId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->entry_id !== $v || $v === '') {
			$this->entry_id = $v;
			$this->modifiedColumns[] = BatchJobPeer::ENTRY_ID;
		}

	} 
	
	public function setPartnerId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->partner_id !== $v || $v === 0) {
			$this->partner_id = $v;
			$this->modifiedColumns[] = BatchJobPeer::PARTNER_ID;
		}

	} 
	
	public function setSubpId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->subp_id !== $v || $v === 0) {
			$this->subp_id = $v;
			$this->modifiedColumns[] = BatchJobPeer::SUBP_ID;
		}

	} 
	
	public function setSchedulerId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->scheduler_id !== $v) {
			$this->scheduler_id = $v;
			$this->modifiedColumns[] = BatchJobPeer::SCHEDULER_ID;
		}

	} 
	
	public function setWorkerId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->worker_id !== $v) {
			$this->worker_id = $v;
			$this->modifiedColumns[] = BatchJobPeer::WORKER_ID;
		}

	} 
	
	public function setBatchIndex($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->batch_index !== $v) {
			$this->batch_index = $v;
			$this->modifiedColumns[] = BatchJobPeer::BATCH_INDEX;
		}

	} 
	
	public function setLastSchedulerId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->last_scheduler_id !== $v) {
			$this->last_scheduler_id = $v;
			$this->modifiedColumns[] = BatchJobPeer::LAST_SCHEDULER_ID;
		}

	} 
	
	public function setLastWorkerId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->last_worker_id !== $v) {
			$this->last_worker_id = $v;
			$this->modifiedColumns[] = BatchJobPeer::LAST_WORKER_ID;
		}

	} 
	
	public function setLastWorkerRemote($v)
	{

		if ($this->last_worker_remote !== $v) {
			$this->last_worker_remote = $v;
			$this->modifiedColumns[] = BatchJobPeer::LAST_WORKER_REMOTE;
		}

	} 
	
	public function setProcessorExpiration($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [processor_expiration] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->processor_expiration !== $ts) {
			$this->processor_expiration = $ts;
			$this->modifiedColumns[] = BatchJobPeer::PROCESSOR_EXPIRATION;
		}

	} 
	
	public function setExecutionAttempts($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->execution_attempts !== $v) {
			$this->execution_attempts = $v;
			$this->modifiedColumns[] = BatchJobPeer::EXECUTION_ATTEMPTS;
		}

	} 
	
	public function setLockVersion($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->lock_version !== $v) {
			$this->lock_version = $v;
			$this->modifiedColumns[] = BatchJobPeer::LOCK_VERSION;
		}

	} 
	
	public function setTwinJobId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->twin_job_id !== $v || $v === 0) {
			$this->twin_job_id = $v;
			$this->modifiedColumns[] = BatchJobPeer::TWIN_JOB_ID;
		}

	} 
	
	public function setBulkJobId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->bulk_job_id !== $v || $v === 0) {
			$this->bulk_job_id = $v;
			$this->modifiedColumns[] = BatchJobPeer::BULK_JOB_ID;
		}

	} 
	
	public function setRootJobId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->root_job_id !== $v || $v === 0) {
			$this->root_job_id = $v;
			$this->modifiedColumns[] = BatchJobPeer::ROOT_JOB_ID;
		}

	} 
	
	public function setParentJobId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->parent_job_id !== $v || $v === 0) {
			$this->parent_job_id = $v;
			$this->modifiedColumns[] = BatchJobPeer::PARENT_JOB_ID;
		}

	} 
	
	public function setDc($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->dc !== $v) {
			$this->dc = $v;
			$this->modifiedColumns[] = BatchJobPeer::DC;
		}

	} 
	
	public function setErrType($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->err_type !== $v) {
			$this->err_type = $v;
			$this->modifiedColumns[] = BatchJobPeer::ERR_TYPE;
		}

	} 
	
	public function setErrNumber($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->err_number !== $v) {
			$this->err_number = $v;
			$this->modifiedColumns[] = BatchJobPeer::ERR_NUMBER;
		}

	} 
	
	public function setOnStressDivertTo($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->on_stress_divert_to !== $v) {
			$this->on_stress_divert_to = $v;
			$this->modifiedColumns[] = BatchJobPeer::ON_STRESS_DIVERT_TO;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->job_type = $rs->getInt($startcol + 1);

			$this->job_sub_type = $rs->getInt($startcol + 2);

			$this->data = $rs->getString($startcol + 3);

			$this->file_size = $rs->getInt($startcol + 4);

			$this->duplication_key = $rs->getString($startcol + 5);

			$this->status = $rs->getInt($startcol + 6);

			$this->abort = $rs->getInt($startcol + 7);

			$this->check_again_timeout = $rs->getInt($startcol + 8);

			$this->progress = $rs->getInt($startcol + 9);

			$this->message = $rs->getString($startcol + 10);

			$this->description = $rs->getString($startcol + 11);

			$this->updates_count = $rs->getInt($startcol + 12);

			$this->created_at = $rs->getTimestamp($startcol + 13, null);

			$this->created_by = $rs->getString($startcol + 14);

			$this->updated_at = $rs->getTimestamp($startcol + 15, null);

			$this->updated_by = $rs->getString($startcol + 16);

			$this->deleted_at = $rs->getTimestamp($startcol + 17, null);

			$this->priority = $rs->getInt($startcol + 18);

			$this->work_group_id = $rs->getInt($startcol + 19);

			$this->queue_time = $rs->getTimestamp($startcol + 20, null);

			$this->finish_time = $rs->getTimestamp($startcol + 21, null);

			$this->entry_id = $rs->getString($startcol + 22);

			$this->partner_id = $rs->getInt($startcol + 23);

			$this->subp_id = $rs->getInt($startcol + 24);

			$this->scheduler_id = $rs->getInt($startcol + 25);

			$this->worker_id = $rs->getInt($startcol + 26);

			$this->batch_index = $rs->getInt($startcol + 27);

			$this->last_scheduler_id = $rs->getInt($startcol + 28);

			$this->last_worker_id = $rs->getInt($startcol + 29);

			$this->last_worker_remote = $rs->getBoolean($startcol + 30);

			$this->processor_expiration = $rs->getTimestamp($startcol + 31, null);

			$this->execution_attempts = $rs->getInt($startcol + 32);

			$this->lock_version = $rs->getInt($startcol + 33);

			$this->twin_job_id = $rs->getInt($startcol + 34);

			$this->bulk_job_id = $rs->getInt($startcol + 35);

			$this->root_job_id = $rs->getInt($startcol + 36);

			$this->parent_job_id = $rs->getInt($startcol + 37);

			$this->dc = $rs->getInt($startcol + 38);

			$this->err_type = $rs->getInt($startcol + 39);

			$this->err_number = $rs->getInt($startcol + 40);

			$this->on_stress_divert_to = $rs->getInt($startcol + 41);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 42; 
		} catch (Exception $e) {
			throw new PropelException("Error populating BatchJob object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(BatchJobPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			BatchJobPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(BatchJobPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(BatchJobPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(BatchJobPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected function doSave($con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = BatchJobPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += BatchJobPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			$this->alreadyInSave = false;
		}
		return $affectedRows;
	} 
	
	protected $validationFailures = array();

	
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			if (($retval = BatchJobPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = BatchJobPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getJobType();
				break;
			case 2:
				return $this->getJobSubType();
				break;
			case 3:
				return $this->getData();
				break;
			case 4:
				return $this->getFileSize();
				break;
			case 5:
				return $this->getDuplicationKey();
				break;
			case 6:
				return $this->getStatus();
				break;
			case 7:
				return $this->getAbort();
				break;
			case 8:
				return $this->getCheckAgainTimeout();
				break;
			case 9:
				return $this->getProgress();
				break;
			case 10:
				return $this->getMessage();
				break;
			case 11:
				return $this->getDescription();
				break;
			case 12:
				return $this->getUpdatesCount();
				break;
			case 13:
				return $this->getCreatedAt();
				break;
			case 14:
				return $this->getCreatedBy();
				break;
			case 15:
				return $this->getUpdatedAt();
				break;
			case 16:
				return $this->getUpdatedBy();
				break;
			case 17:
				return $this->getDeletedAt();
				break;
			case 18:
				return $this->getPriority();
				break;
			case 19:
				return $this->getWorkGroupId();
				break;
			case 20:
				return $this->getQueueTime();
				break;
			case 21:
				return $this->getFinishTime();
				break;
			case 22:
				return $this->getEntryId();
				break;
			case 23:
				return $this->getPartnerId();
				break;
			case 24:
				return $this->getSubpId();
				break;
			case 25:
				return $this->getSchedulerId();
				break;
			case 26:
				return $this->getWorkerId();
				break;
			case 27:
				return $this->getBatchIndex();
				break;
			case 28:
				return $this->getLastSchedulerId();
				break;
			case 29:
				return $this->getLastWorkerId();
				break;
			case 30:
				return $this->getLastWorkerRemote();
				break;
			case 31:
				return $this->getProcessorExpiration();
				break;
			case 32:
				return $this->getExecutionAttempts();
				break;
			case 33:
				return $this->getLockVersion();
				break;
			case 34:
				return $this->getTwinJobId();
				break;
			case 35:
				return $this->getBulkJobId();
				break;
			case 36:
				return $this->getRootJobId();
				break;
			case 37:
				return $this->getParentJobId();
				break;
			case 38:
				return $this->getDc();
				break;
			case 39:
				return $this->getErrType();
				break;
			case 40:
				return $this->getErrNumber();
				break;
			case 41:
				return $this->getOnStressDivertTo();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = BatchJobPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getJobType(),
			$keys[2] => $this->getJobSubType(),
			$keys[3] => $this->getData(),
			$keys[4] => $this->getFileSize(),
			$keys[5] => $this->getDuplicationKey(),
			$keys[6] => $this->getStatus(),
			$keys[7] => $this->getAbort(),
			$keys[8] => $this->getCheckAgainTimeout(),
			$keys[9] => $this->getProgress(),
			$keys[10] => $this->getMessage(),
			$keys[11] => $this->getDescription(),
			$keys[12] => $this->getUpdatesCount(),
			$keys[13] => $this->getCreatedAt(),
			$keys[14] => $this->getCreatedBy(),
			$keys[15] => $this->getUpdatedAt(),
			$keys[16] => $this->getUpdatedBy(),
			$keys[17] => $this->getDeletedAt(),
			$keys[18] => $this->getPriority(),
			$keys[19] => $this->getWorkGroupId(),
			$keys[20] => $this->getQueueTime(),
			$keys[21] => $this->getFinishTime(),
			$keys[22] => $this->getEntryId(),
			$keys[23] => $this->getPartnerId(),
			$keys[24] => $this->getSubpId(),
			$keys[25] => $this->getSchedulerId(),
			$keys[26] => $this->getWorkerId(),
			$keys[27] => $this->getBatchIndex(),
			$keys[28] => $this->getLastSchedulerId(),
			$keys[29] => $this->getLastWorkerId(),
			$keys[30] => $this->getLastWorkerRemote(),
			$keys[31] => $this->getProcessorExpiration(),
			$keys[32] => $this->getExecutionAttempts(),
			$keys[33] => $this->getLockVersion(),
			$keys[34] => $this->getTwinJobId(),
			$keys[35] => $this->getBulkJobId(),
			$keys[36] => $this->getRootJobId(),
			$keys[37] => $this->getParentJobId(),
			$keys[38] => $this->getDc(),
			$keys[39] => $this->getErrType(),
			$keys[40] => $this->getErrNumber(),
			$keys[41] => $this->getOnStressDivertTo(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = BatchJobPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setJobType($value);
				break;
			case 2:
				$this->setJobSubType($value);
				break;
			case 3:
				$this->setData($value);
				break;
			case 4:
				$this->setFileSize($value);
				break;
			case 5:
				$this->setDuplicationKey($value);
				break;
			case 6:
				$this->setStatus($value);
				break;
			case 7:
				$this->setAbort($value);
				break;
			case 8:
				$this->setCheckAgainTimeout($value);
				break;
			case 9:
				$this->setProgress($value);
				break;
			case 10:
				$this->setMessage($value);
				break;
			case 11:
				$this->setDescription($value);
				break;
			case 12:
				$this->setUpdatesCount($value);
				break;
			case 13:
				$this->setCreatedAt($value);
				break;
			case 14:
				$this->setCreatedBy($value);
				break;
			case 15:
				$this->setUpdatedAt($value);
				break;
			case 16:
				$this->setUpdatedBy($value);
				break;
			case 17:
				$this->setDeletedAt($value);
				break;
			case 18:
				$this->setPriority($value);
				break;
			case 19:
				$this->setWorkGroupId($value);
				break;
			case 20:
				$this->setQueueTime($value);
				break;
			case 21:
				$this->setFinishTime($value);
				break;
			case 22:
				$this->setEntryId($value);
				break;
			case 23:
				$this->setPartnerId($value);
				break;
			case 24:
				$this->setSubpId($value);
				break;
			case 25:
				$this->setSchedulerId($value);
				break;
			case 26:
				$this->setWorkerId($value);
				break;
			case 27:
				$this->setBatchIndex($value);
				break;
			case 28:
				$this->setLastSchedulerId($value);
				break;
			case 29:
				$this->setLastWorkerId($value);
				break;
			case 30:
				$this->setLastWorkerRemote($value);
				break;
			case 31:
				$this->setProcessorExpiration($value);
				break;
			case 32:
				$this->setExecutionAttempts($value);
				break;
			case 33:
				$this->setLockVersion($value);
				break;
			case 34:
				$this->setTwinJobId($value);
				break;
			case 35:
				$this->setBulkJobId($value);
				break;
			case 36:
				$this->setRootJobId($value);
				break;
			case 37:
				$this->setParentJobId($value);
				break;
			case 38:
				$this->setDc($value);
				break;
			case 39:
				$this->setErrType($value);
				break;
			case 40:
				$this->setErrNumber($value);
				break;
			case 41:
				$this->setOnStressDivertTo($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = BatchJobPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setJobType($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setJobSubType($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setData($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setFileSize($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setDuplicationKey($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setStatus($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setAbort($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCheckAgainTimeout($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setProgress($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setMessage($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setDescription($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setUpdatesCount($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCreatedAt($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCreatedBy($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setUpdatedAt($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setUpdatedBy($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setDeletedAt($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setPriority($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setWorkGroupId($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setQueueTime($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setFinishTime($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setEntryId($arr[$keys[22]]);
		if (array_key_exists($keys[23], $arr)) $this->setPartnerId($arr[$keys[23]]);
		if (array_key_exists($keys[24], $arr)) $this->setSubpId($arr[$keys[24]]);
		if (array_key_exists($keys[25], $arr)) $this->setSchedulerId($arr[$keys[25]]);
		if (array_key_exists($keys[26], $arr)) $this->setWorkerId($arr[$keys[26]]);
		if (array_key_exists($keys[27], $arr)) $this->setBatchIndex($arr[$keys[27]]);
		if (array_key_exists($keys[28], $arr)) $this->setLastSchedulerId($arr[$keys[28]]);
		if (array_key_exists($keys[29], $arr)) $this->setLastWorkerId($arr[$keys[29]]);
		if (array_key_exists($keys[30], $arr)) $this->setLastWorkerRemote($arr[$keys[30]]);
		if (array_key_exists($keys[31], $arr)) $this->setProcessorExpiration($arr[$keys[31]]);
		if (array_key_exists($keys[32], $arr)) $this->setExecutionAttempts($arr[$keys[32]]);
		if (array_key_exists($keys[33], $arr)) $this->setLockVersion($arr[$keys[33]]);
		if (array_key_exists($keys[34], $arr)) $this->setTwinJobId($arr[$keys[34]]);
		if (array_key_exists($keys[35], $arr)) $this->setBulkJobId($arr[$keys[35]]);
		if (array_key_exists($keys[36], $arr)) $this->setRootJobId($arr[$keys[36]]);
		if (array_key_exists($keys[37], $arr)) $this->setParentJobId($arr[$keys[37]]);
		if (array_key_exists($keys[38], $arr)) $this->setDc($arr[$keys[38]]);
		if (array_key_exists($keys[39], $arr)) $this->setErrType($arr[$keys[39]]);
		if (array_key_exists($keys[40], $arr)) $this->setErrNumber($arr[$keys[40]]);
		if (array_key_exists($keys[41], $arr)) $this->setOnStressDivertTo($arr[$keys[41]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(BatchJobPeer::DATABASE_NAME);

		if ($this->isColumnModified(BatchJobPeer::ID)) $criteria->add(BatchJobPeer::ID, $this->id);
		if ($this->isColumnModified(BatchJobPeer::JOB_TYPE)) $criteria->add(BatchJobPeer::JOB_TYPE, $this->job_type);
		if ($this->isColumnModified(BatchJobPeer::JOB_SUB_TYPE)) $criteria->add(BatchJobPeer::JOB_SUB_TYPE, $this->job_sub_type);
		if ($this->isColumnModified(BatchJobPeer::DATA)) $criteria->add(BatchJobPeer::DATA, $this->data);
		if ($this->isColumnModified(BatchJobPeer::FILE_SIZE)) $criteria->add(BatchJobPeer::FILE_SIZE, $this->file_size);
		if ($this->isColumnModified(BatchJobPeer::DUPLICATION_KEY)) $criteria->add(BatchJobPeer::DUPLICATION_KEY, $this->duplication_key);
		if ($this->isColumnModified(BatchJobPeer::STATUS)) $criteria->add(BatchJobPeer::STATUS, $this->status);
		if ($this->isColumnModified(BatchJobPeer::ABORT)) $criteria->add(BatchJobPeer::ABORT, $this->abort);
		if ($this->isColumnModified(BatchJobPeer::CHECK_AGAIN_TIMEOUT)) $criteria->add(BatchJobPeer::CHECK_AGAIN_TIMEOUT, $this->check_again_timeout);
		if ($this->isColumnModified(BatchJobPeer::PROGRESS)) $criteria->add(BatchJobPeer::PROGRESS, $this->progress);
		if ($this->isColumnModified(BatchJobPeer::MESSAGE)) $criteria->add(BatchJobPeer::MESSAGE, $this->message);
		if ($this->isColumnModified(BatchJobPeer::DESCRIPTION)) $criteria->add(BatchJobPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(BatchJobPeer::UPDATES_COUNT)) $criteria->add(BatchJobPeer::UPDATES_COUNT, $this->updates_count);
		if ($this->isColumnModified(BatchJobPeer::CREATED_AT)) $criteria->add(BatchJobPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(BatchJobPeer::CREATED_BY)) $criteria->add(BatchJobPeer::CREATED_BY, $this->created_by);
		if ($this->isColumnModified(BatchJobPeer::UPDATED_AT)) $criteria->add(BatchJobPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(BatchJobPeer::UPDATED_BY)) $criteria->add(BatchJobPeer::UPDATED_BY, $this->updated_by);
		if ($this->isColumnModified(BatchJobPeer::DELETED_AT)) $criteria->add(BatchJobPeer::DELETED_AT, $this->deleted_at);
		if ($this->isColumnModified(BatchJobPeer::PRIORITY)) $criteria->add(BatchJobPeer::PRIORITY, $this->priority);
		if ($this->isColumnModified(BatchJobPeer::WORK_GROUP_ID)) $criteria->add(BatchJobPeer::WORK_GROUP_ID, $this->work_group_id);
		if ($this->isColumnModified(BatchJobPeer::QUEUE_TIME)) $criteria->add(BatchJobPeer::QUEUE_TIME, $this->queue_time);
		if ($this->isColumnModified(BatchJobPeer::FINISH_TIME)) $criteria->add(BatchJobPeer::FINISH_TIME, $this->finish_time);
		if ($this->isColumnModified(BatchJobPeer::ENTRY_ID)) $criteria->add(BatchJobPeer::ENTRY_ID, $this->entry_id);
		if ($this->isColumnModified(BatchJobPeer::PARTNER_ID)) $criteria->add(BatchJobPeer::PARTNER_ID, $this->partner_id);
		if ($this->isColumnModified(BatchJobPeer::SUBP_ID)) $criteria->add(BatchJobPeer::SUBP_ID, $this->subp_id);
		if ($this->isColumnModified(BatchJobPeer::SCHEDULER_ID)) $criteria->add(BatchJobPeer::SCHEDULER_ID, $this->scheduler_id);
		if ($this->isColumnModified(BatchJobPeer::WORKER_ID)) $criteria->add(BatchJobPeer::WORKER_ID, $this->worker_id);
		if ($this->isColumnModified(BatchJobPeer::BATCH_INDEX)) $criteria->add(BatchJobPeer::BATCH_INDEX, $this->batch_index);
		if ($this->isColumnModified(BatchJobPeer::LAST_SCHEDULER_ID)) $criteria->add(BatchJobPeer::LAST_SCHEDULER_ID, $this->last_scheduler_id);
		if ($this->isColumnModified(BatchJobPeer::LAST_WORKER_ID)) $criteria->add(BatchJobPeer::LAST_WORKER_ID, $this->last_worker_id);
		if ($this->isColumnModified(BatchJobPeer::LAST_WORKER_REMOTE)) $criteria->add(BatchJobPeer::LAST_WORKER_REMOTE, $this->last_worker_remote);
		if ($this->isColumnModified(BatchJobPeer::PROCESSOR_EXPIRATION)) $criteria->add(BatchJobPeer::PROCESSOR_EXPIRATION, $this->processor_expiration);
		if ($this->isColumnModified(BatchJobPeer::EXECUTION_ATTEMPTS)) $criteria->add(BatchJobPeer::EXECUTION_ATTEMPTS, $this->execution_attempts);
		if ($this->isColumnModified(BatchJobPeer::LOCK_VERSION)) $criteria->add(BatchJobPeer::LOCK_VERSION, $this->lock_version);
		if ($this->isColumnModified(BatchJobPeer::TWIN_JOB_ID)) $criteria->add(BatchJobPeer::TWIN_JOB_ID, $this->twin_job_id);
		if ($this->isColumnModified(BatchJobPeer::BULK_JOB_ID)) $criteria->add(BatchJobPeer::BULK_JOB_ID, $this->bulk_job_id);
		if ($this->isColumnModified(BatchJobPeer::ROOT_JOB_ID)) $criteria->add(BatchJobPeer::ROOT_JOB_ID, $this->root_job_id);
		if ($this->isColumnModified(BatchJobPeer::PARENT_JOB_ID)) $criteria->add(BatchJobPeer::PARENT_JOB_ID, $this->parent_job_id);
		if ($this->isColumnModified(BatchJobPeer::DC)) $criteria->add(BatchJobPeer::DC, $this->dc);
		if ($this->isColumnModified(BatchJobPeer::ERR_TYPE)) $criteria->add(BatchJobPeer::ERR_TYPE, $this->err_type);
		if ($this->isColumnModified(BatchJobPeer::ERR_NUMBER)) $criteria->add(BatchJobPeer::ERR_NUMBER, $this->err_number);
		if ($this->isColumnModified(BatchJobPeer::ON_STRESS_DIVERT_TO)) $criteria->add(BatchJobPeer::ON_STRESS_DIVERT_TO, $this->on_stress_divert_to);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(BatchJobPeer::DATABASE_NAME);

		$criteria->add(BatchJobPeer::ID, $this->id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setJobType($this->job_type);

		$copyObj->setJobSubType($this->job_sub_type);

		$copyObj->setData($this->data);

		$copyObj->setFileSize($this->file_size);

		$copyObj->setDuplicationKey($this->duplication_key);

		$copyObj->setStatus($this->status);

		$copyObj->setAbort($this->abort);

		$copyObj->setCheckAgainTimeout($this->check_again_timeout);

		$copyObj->setProgress($this->progress);

		$copyObj->setMessage($this->message);

		$copyObj->setDescription($this->description);

		$copyObj->setUpdatesCount($this->updates_count);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setCreatedBy($this->created_by);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setUpdatedBy($this->updated_by);

		$copyObj->setDeletedAt($this->deleted_at);

		$copyObj->setPriority($this->priority);

		$copyObj->setWorkGroupId($this->work_group_id);

		$copyObj->setQueueTime($this->queue_time);

		$copyObj->setFinishTime($this->finish_time);

		$copyObj->setEntryId($this->entry_id);

		$copyObj->setPartnerId($this->partner_id);

		$copyObj->setSubpId($this->subp_id);

		$copyObj->setSchedulerId($this->scheduler_id);

		$copyObj->setWorkerId($this->worker_id);

		$copyObj->setBatchIndex($this->batch_index);

		$copyObj->setLastSchedulerId($this->last_scheduler_id);

		$copyObj->setLastWorkerId($this->last_worker_id);

		$copyObj->setLastWorkerRemote($this->last_worker_remote);

		$copyObj->setProcessorExpiration($this->processor_expiration);

		$copyObj->setExecutionAttempts($this->execution_attempts);

		$copyObj->setLockVersion($this->lock_version);

		$copyObj->setTwinJobId($this->twin_job_id);

		$copyObj->setBulkJobId($this->bulk_job_id);

		$copyObj->setRootJobId($this->root_job_id);

		$copyObj->setParentJobId($this->parent_job_id);

		$copyObj->setDc($this->dc);

		$copyObj->setErrType($this->err_type);

		$copyObj->setErrNumber($this->err_number);

		$copyObj->setOnStressDivertTo($this->on_stress_divert_to);


		$copyObj->setNew(true);

		$copyObj->setId(NULL); 
	}

	
	public function copy($deepCopy = false)
	{
				$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new BatchJobPeer();
		}
		return self::$peer;
	}

} 