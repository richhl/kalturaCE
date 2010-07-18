<?php 
	chdir('../');
	require_once("systembase.php");
	require_once('header.php');
	 
	$schedulers = SchedulerPeer::doSelect(new Criteria());
	?>
	<script type="text/javascript" src="/api_v3/system/js/client/KalturaJsUtils.js"></script>
	<script type="text/javascript" src="/api_v3/system/js/client/KalturaClientBase.js"></script>
	<script type="text/javascript" src="/api_v3/system/js/client/KalturaClient.js"></script>
	<script type="text/javascript" src="/api_v3/system/js/controlPanel.js"></script>
	<script type="text/javascript">
	<!--

		function onStopScheduler(cmd)
		{
			alert("TODO - implement (<?php echo 'file: ' . __FILE__ . '[' . __LINE__ . ']' ?>)");
		}

		function onStopWorker(cmd)
		{
			alert("TODO - implement (<?php echo 'file: ' . __FILE__ . '[' . __LINE__ . ']' ?>)");
		}

		function onStartWorker(cmd)
		{
			alert("TODO - implement (<?php echo 'file: ' . __FILE__ . '[' . __LINE__ . ']' ?>)");
		}

		function onKillBatch(cmd)
		{
			alert("TODO - implement (<?php echo 'file: ' . __FILE__ . '[' . __LINE__ . ']' ?>)");
		}

	//-->
	</script>
	
	<h2>Scheduler Control Panel</h2>
	<table>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Description</th>
		</tr>
		<?php 
		
			foreach($schedulers as $scheduler)
			{
				?>
					<tr>
						<td><?php echo $scheduler->getConfiguredId() ?></td>
						<td><a href="configPanel.php?schedulerId=<?php echo $scheduler->getId() ?>&title=<?php echo $scheduler->getName() ?>"><?php echo $scheduler->getName() ?></a></td>
						<td><?php echo $scheduler->getDescription() ?></td>
					</tr>
				<?php 
			}
			
		?>
	</table>
	<br/>
	<?php 
		
		$worker_names = array();
		$scheduler_names = array();
		foreach($schedulers as $scheduler)
		{
			$scheduler_names[$scheduler->getId()] = $scheduler->getName();
			
			$c = new Criteria();
			$c->add(SchedulerWorkerPeer::SCHEDULER_ID, $scheduler->getId());
			$workers = SchedulerWorkerPeer::doSelect($c);
			
			?>
				<table>
					<tr>
						<th><?php echo $scheduler->getName() ?></th>
						<td><input type="button" style="background-color: red" value="stop" onclick="stopScheduler(onStopScheduler, <?php echo $scheduler->getId() . ', \'' . $scheduler->getName() . '\'' ?>)"/></td>
					</tr>
					<tr>
						<td colspan="2">
							<table>
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th>Type</th>
									<th>Processes</th>
									<th></th>
								</tr>
								<?php 
								
									$worker_names[$scheduler->getId()] = array();
									foreach($workers as $worker)
									{
										$worker_names[$scheduler->getId()][$worker->getId()] = $worker->getName();
										$count_status = $worker->getStatus(SchedulerStatus::RUNNING_BATCHES_COUNT);
										$running_status = $worker->getStatus(SchedulerStatus::RUNNING_BATCHES_IS_RUNNING);
										$color = 'red';
										if($running_status)
											$color = 'green';
										
										?>
											<tr style="color: <?php echo $color ?>">
												<td><?php echo $worker->getConfiguredId() ?></td>
												<td><a href="configPanel.php?schedulerId=<?php echo $worker->getSchedulerId() ?>&workerId=<?php echo $worker->getId() ?>&title=<?php echo $scheduler->getName() . ' - ' . $worker->getName() ?>"><?php echo $worker->getName() ?></a></td>
												<td><?php echo BatchJob::getTypeName($worker->getType()) ?></td>
												<td><?php echo $count_status ?></td>
												<td>
													<?php
														if($running_status)
														{
															?><input type="button" style="background-color: red" value="stop" onclick="stopWorker(onStopWorker, <?php echo $scheduler->getId() . ', \'' . $scheduler->getName() . '\', ' . $worker->getId() . ', \'' . $worker->getName() . '\'' ?>)"/><?php 
														}
														else
														{
															?><input type="button" style="background-color: green" value="start" onclick="startWorker(onStartWorker, <?php echo $scheduler->getId() . ', \'' . $scheduler->getName() . '\', ' . $worker->getId() . ', \'' . $worker->getName() . '\'' ?>)"/><?php
														}
													?>
												</td>
											</tr>
										<?php 
									}
									
								?>
							</table>
						</td>
					</tr>
				</table>
				<br/>
			<?php 
	}
	
	$c = new Criteria();
	$c->add(BatchJobPeer::SCHEDULER_ID, 0, Criteria::GREATER_THAN);
		
	$jobs = BatchJobPeer::doSelect($c);
	?>
		<br/>
		<table>
			<tr>
				<th>ID</th>
				<th>Scheduler</th>
				<th>Worker</th>
				<th>Batch Index</th>
				<th>Type</th>
				<th>Create Time</th>
				<th>Status</th>
				<th>Progress</th>
				<th>Message</th>
				<th>Priority</th>
				<td></td>
			</tr>
			<?php 
			
				foreach($jobs as $job)
				{
					?>
						<tr title="<?php echo $job->getDescription() ?>">
							<td><?php echo $job->getId() ?></td>
							<td><?php echo $scheduler_names[$job->getSchedulerId()] ?></td>
							<td><?php echo $worker_names[$job->getSchedulerId()][$job->getWorkerId()] ?></td>
							<td><?php echo $job->getBatchIndex() ?></td>
							<td><?php echo BatchJob::getTypeName($job->getJobType()) ?></td>
							<td><?php echo $job->getCreatedAt('d/m H:i') ?></td>
							<td><?php echo BatchJob::getStatusName($job->getStatus()) ?></td>
							<td><?php echo $job->getProgress() ?></td>
							<td><?php echo $job->getMessage() ?></td>
							<td><?php echo $job->getPriority() ?></td>
							<td><input type="button" style="background-color: black; color: white; font-weight: bold" value="kill" onclick="killBatch(onKillBatch, <?php echo $job->getSchedulerId() . ', \'' . $scheduler_names[$job->getSchedulerId()] . '\', ' . $job->getWorkerId() . ', \'' . $worker_names[$job->getSchedulerId()][$job->getWorkerId()] . '\', ' . $job->getBatchIndex() ?>)"/></td>
						</tr>
					<?php 
				}
				
			?>
		</table>
	<?php
	
	require_once('footer.php'); 

?>