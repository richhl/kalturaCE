<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Kaltura - Test Me Console Documentation</title>
	<link rel="stylesheet" type="text/css" href="css/main.css" />
	<script type="text/javascript" src="../testme/js/jquery-1.3.1.min.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
</head>
<body>
	<?php 
		require_once("../../bootstrap.php"); 
	
		$serviceMap = KalturaServicesMap::getMap();
		$services = array_keys($serviceMap);
		foreach($services as $service)
		{
			$serviceReflector = new KalturaServiceReflector($service);

			$actions = array_keys($serviceReflector->getActions());
			foreach($actions as $action)
			{
				//echo $action;				
			}
		}
	?>
	<div id="wrap">
<ul id="kmcSubMenu">
 	<li>
     <a href="../testme/index.php">Test Console</a>
    </li>
    <li class="active">
     <a href="#">API Documentation</a>
    </li>
   </ul>
	<div class="left">
		<div class="left-content">
			<div id="general">
				<h2>General</h2>
				<ul>
					<li><a href="overview">Overview</a></li>
					<li><a href="terminology">Terminology</a></li>
					<li><a href="inout">API input/output</a></li>
					<li><a href="notifications">Notifications</a></li>
				</ul>
			</div>

			<div id="services">
				<h2>Services</h2>
				<ul class="services">
				<?php foreach($services as $service): ?>
					<li class="service"><a href="<?php echo $service; ?>"><?php echo $service; ?></a>
				<?php
					$serviceReflector = new KalturaServiceReflector($service);
					$actions = array_keys($serviceReflector->getActions());
					echo '<ul class="actions">';
					foreach($actions as $action)
					{
						echo '<li class="action"><a href="'. $action .'">'. $action .'</a></li>';
					}
					echo '</ul>';
				?>
					</li>
				<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>

	<div class="right">
		<div id="doc" ></div>
	</div>
	</div>

</body>
</html>