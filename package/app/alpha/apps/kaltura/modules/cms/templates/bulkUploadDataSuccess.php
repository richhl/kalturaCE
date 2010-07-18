<?php
function formatStatus($status)
{
	switch($status)
	{
		case BatchJob::BATCHJOB_STATUS_PENDING:
			return "Verifying file";
		case BatchJob::BATCHJOB_STATUS_QUEUED:
			return "Verified, Queued for import";
		case BatchJob::BATCHJOB_STATUS_PROCESSING:
			return "Processing";
		case BatchJob::BATCHJOB_STATUS_FINISHED:
			return "Finished";
		case BatchJob::BATCHJOB_STATUS_ABORTED:
			return "Aborted";
	}
	return "N/A";
}

?>
<tr style="display: none;">
	<td>
		<div id="result_count"><?php echo $count; ?></div>
	</td>
</tr>

<?php if (!count($jobs)): ?> 
<tr>
	<td class="name" colspan="8" align="center">No data found</td>
</tr>
<?php endif; ?>
<?php foreach($jobs as $job): ?>
<tr>
	<?php $jobData = unserialize($job->getData()); ?>
	<td class="name"><?php echo $jobData["uploadedBy"]; ?></td>
	<td><?php echo kString::formatDate($jobData["uploadedOn"]); ?></td>
	<td><?php echo @$jobData["numOfEntries"] ? $jobData["numOfEntries"] : "N/A"?></td>
	<td><?php echo formatStatus($job->getStatus()); ?></td>
	<td><?php echo @$jobData["error"]; ?></td>
	<td><?php echo @$jobData["logFile"] ? '<a href="'.$jobData["logFile"].'?'.time().'">View Log</a>' : ""; ?></td>
	<td><a href="<?php echo $jobData["fileRelativeLocation"]; ?>">View CSV</a></td>
</tr>
<?php endforeach; ?>