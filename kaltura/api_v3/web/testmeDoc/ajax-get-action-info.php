<?php
require_once("../../bootstrap.php");
$service = $_REQUEST["service"];
$action = $_REQUEST["action"];
$bench_start = microtime(true);
KalturaLog::INFO ( ">------- api_v3 testme [$service][$action]-------");

try
{
$serviceReflector = new KalturaServiceReflector($service);
$actions = $serviceReflector->getActions();

$actionParams = $serviceReflector->getActionParams($action);

$action_info = $serviceReflector->getActionInfo($action);

$actionInfo = array(
	"description" => $action_info->description,
	"actionParams" => array() ,
);

?>
<h2>Kaltura API</h2>
<table class="action" width="80%">
	<tr>
		<th colspan="3" class="service_action_title"><?= doc_link('kaltura_service', $service , 1) ?>:<?= $action ?></th>
	</tr>
	<tr>
		<td  colspan="3" class="title">Description:</td>
	</tr>
	<tr>
		<td class="description" colspan="3"><?= nl2br($actionInfo['description']); ?></td>
	</tr>
<?php if($actionParams): ?>
	<tr>
		<td colspan="3" class="title">Input Params</td>
	</tr>
	<tr>
		<th class="subtitle">name</th>
		<th class="subtitle">type</th>
		<th class="subtitle">Description</th>
	</tr>
<?
endif;
foreach($actionParams as $actionParam):
?>
	<tr>
		<td><?= $actionParam->getName() ?></td>
		<td><?= doc_link('kaltura_object', $actionParam->getType(), $actionParam->isComplexType());  ?></td>
		<td><?= $actionParam->getDescription(); ?></td>
	</tr>
<? endforeach;
$return_value = $serviceReflector->getActionOutputType($action);
if ($return_value):
?>
	<tr>
		<td colspan="3" class="title">Output Type</td>
	</tr>
	<tr>
		<th colspan="3" class="subtitle">type</th>
	</tr>
	<tr>
		<td colspan="3" ><? echo doc_link("kaltura_object", $return_value->getType(),$return_value->isComplexType()); ?></td>
	</tr>
<?
else:
?>
	<tr>
		<td colspan="3" class="sub_title_no_output">No Output</td>
	</tr>
<?
endif;
if (is_array($action_info->errors) && count($action_info->errors)):
?>
	<tr>
		<td colspan="3" class="title">Errors</td>
	</tr>
<?
	foreach($action_info->errors as $error):
?>
	<tr>
		<td colspan="3"><?= $error[1]; ?></td>
	</tr>
<?
	endforeach;
endif;
?>
	<tr>
		<td colspan="3" class="title">Example HTTP Hit</td>
	</tr>
	<tr>
		<td colspan="3"><? example_hit($service, $action, $actionParams); ?></td>
	</tr>
</table>
<?
}
catch ( Exception $ex )
{
	KalturaLog::ERR ( "<------- api_v3 testme [$service][$action\n" . 
		 $ex->__toString() .  " " ." -------");
}

$bench_end = microtime(true);
KalturaLog::INFO ( "<------- api_v3 testme [$service][$action][" . ($bench_end - $bench_start) . "] -------");

function doc_link($link_type, $target_obj, $complex_type)
{
	if (!$complex_type)
		return $target_obj;
	$base_link = "../docs/index.html";
	switch ( $link_type )
	{
		case 'kaltura_object':
			return "<a target=\"_blank\" href=\"$base_link?goto=$target_obj.html\" onclick=\"return kalturaInitModalBox('$base_link?goto=$target_obj.html');\">$target_obj</a>";
		case 'kaltura_service':
			return $target_obj;
	}
}

function example_hit( $service, $action , $actionParams )
{
	echo 'http://www.kaltura.com/api_v3/?service='.urlencode($service).'&action='.urlencode($action);
	echo '<br /><strong>POST fields:</strong><div class="post_fields">';
	$hit = '';
	foreach($actionParams as $actionParam)
	{
		if ($actionParam->isComplexType())
		{
			if ($actionParam->isEnum())
				$hit .= $actionParam->getName().'<br />';
			else // assume object
			{
				$props = $actionParam->getTypeReflector()->getProperties();
				foreach($props as $property)
				{
					$hit .= $actionParam->getName().':'.$property->getName().'<br />';
				}
			}
		}
		else
		{
			$hit .= $actionParam->getName().'<br />';
		}
	}
	echo $hit.'</div>';
}