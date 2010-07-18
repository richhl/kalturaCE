<?php 
	chdir('../');
	require_once("systembase.php");
	require_once('header.php');
	 
	
	?>
	<script type="text/javascript" src="/api_v3/system/js/client/KalturaJsUtils.js"></script>
	<script type="text/javascript" src="/api_v3/system/js/client/KalturaClientBase.js"></script>
	<script type="text/javascript" src="/api_v3/system/js/client/KalturaClient.js"></script>
	<script type="text/javascript" src="/api_v3/system/js/controlPanel.js"></script>
	<script type="text/javascript">
	<!--

		function checkField(schedulerId, workerId, variable, variablePart)
		{
			var chk = 'chkConfig$' + schedulerId + '_' + workerId + '$' + variable;
			if(variablePart)
				chk += '$' + variablePart;
	
			var chkField = document.getElementById(chk);
			if(chkField)
				chkField.checked = true;
		}

		function onConfig(cmd)
		{
			alert("TODO - implement (<?php echo 'file: ' . __FILE__ . '[' . __LINE__ . ']' ?>)");
		}
	
		function saveConfig(schedulerId, schedulerName, workerId, workerName)
		{
			// find all checked fields
			var $chk = $(':checkbox[checked=true]');
			$chk.each(function()
			{
				// find the text field
				var txtId = $(this).attr('id').replace('chk', 'txt');
	
				// get the value 
				var field = document.getElementById(txtId);
				var val = field.value;
				
				var vars = txtId.split('$');
				var variable = vars[2];
				var variablePart = null;
				if(vars.length == 4)
					variablePart = vars[3];
	
//				if(variablePart)
//					alert(variable + '.' + variablePart + ' = ' + val);
//				else
//					alert(variable + ' = ' + val);
	
				sendConfig(onConfig, schedulerId, schedulerName, variable, variablePart, val, workerId, workerName);
			});
		}
		
	//-->
	</script>
	<?php 
		
		$schedulerId = 0;
		$workerId = 0;
		$schedulerName = '';
		$workerName = '';
		
		if(isset($_GET['schedulerId']))
		{
			$schedulerId = $_GET['schedulerId'];
			$scheduler = SchedulerPeer::retrieveByPK($schedulerId);
			$schedulerName = $scheduler->getName();
		
			if(isset($_GET['workerId']))
			{
				$workerId = $_GET['workerId'];
				$worker = SchedulerWorkerPeer::retrieveByPK($workerId);
				$workerName = $worker->getName();
			}
			
			$c = new Criteria();
			$c->clearSelectColumns();
			$c->addSelectColumn('MAX(' . SchedulerConfigPeer::ID . ')');
			$c->addGroupByColumn(SchedulerConfigPeer::VARIABLE);
			$c->addGroupByColumn(SchedulerConfigPeer::VARIABLE_PART);
			$c->addAscendingOrderByColumn(SchedulerConfigPeer::VARIABLE);
			if($workerId)
			{
				$c->add(SchedulerConfigPeer::WORKER_ID, $workerId);
			}
			else
			{
				$c->add(SchedulerConfigPeer::SCHEDULER_ID, $schedulerId);
				$c->add(SchedulerConfigPeer::WORKER_ID, null);
			}
			
			$rs = SchedulerConfigPeer::doSelectRs($c);
			$configIds = array();
			while ($rs->next())
				$configIds[] = $rs->getInt(1);
			
			$configItems = SchedulerConfigPeer::retrieveByPKs($configIds);
		
			
			$tree = array();
			foreach($configItems as $configItem)
			{
				//echo $configItem->getId() . ": " . $configItem->getVariable() . " = " . $configItem->getValue() . "<br/>\n";
				if(is_null($configItem->getVariablePart()) || !strlen(trim($configItem->getVariablePart())))
				{
					$tree[$configItem->getVariable()] = $configItem->getValue();
				}
				else
				{
					if(!isset($tree[$configItem->getVariable()]))
						$tree[$configItem->getVariable()] = array();
						
					$tree[$configItem->getVariable()][$configItem->getVariablePart()] = $configItem->getValue();
				}
			}
		}
		$title = '';
		if(isset($_GET['title']))
			$title = $_GET['title'];
			
		?>
			<h2><?php echo $title ?></h2>
			<table>
				<?php 
				
					foreach($tree as $variable => $value)
					{
						if(is_array($value))
							continue;
							
						?>
							<tr>
								<td><b><?php echo $variable ?></b></td>
								<td><input type="text" id="txtConfig$<?php echo $schedulerId . '_' . $workerId . '$' . $variable ?>" value="<?php echo $value ?>" onkeyup="checkField(<?php echo $schedulerId . ', ' . $workerId . ', \'' . $variable . '\'' ?>)"/></td>
								<td><input type="checkbox" id="chkConfig$<?php echo $schedulerId . '_' . $workerId . '$' . $variable ?>"/></td>
							</tr>
						<?php 
					}
					
					foreach($tree as $variable => $value)
					{
						if(!is_array($value))
							continue;
						?>
							<tr>
								<td valign="top"><b><?php echo $variable ?></b></td>
								<td>
									<table>
										<?php 
										
											foreach($value as $variable_part => $part_value)
											{
												?>
													<tr>
														<td><?php echo $variable_part ?></td>
														<td><input type="text" id="txtConfig$<?php echo $schedulerId . '_' . $workerId . '$' . $variable . '$' . $variable_part ?>" value="<?php echo $part_value ?>" onkeyup="checkField(<?php echo $schedulerId . ', ' . $workerId . ', \'' . $variable . '\', \'' . $variable_part . '\'' ?>)"/></td>
														<td><input type="checkbox" id="chkConfig$<?php echo $schedulerId . '_' . $workerId . '$' . $variable . '$' . $variable_part ?>"/></td>
													</tr>
												<?php 
											}
											
										?>
									</table>
								 </td>
							</tr>
						<?php 
					}
					
				?>
			</table>
			<br/>
			<input type="button" value="save" onclick="saveConfig(<?php echo $schedulerId . ', \'' . $schedulerName . '\', ' . $workerId . ', \'' . $workerName . '\'' ?>)"/>
		<?php 
		
	require_once('footer.php'); 

?>