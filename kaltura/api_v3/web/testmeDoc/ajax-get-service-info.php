<?php
require_once("../../bootstrap.php");

$service = $_GET["service"];
$serviceReflector = new KalturaServiceReflector($service);

$actions = array_keys($serviceReflector->getActions());
$service_info = $serviceReflector->getServiceInfo();
?>
<h2>Kaltura API</h2>
<table id="serviceInfo">
  <tr>
    <td class="title">Service Name</th>
    <td class="odd"><?= $service; ?></td>
  </tr>
<!--  <tr>
    <th>Package</th>
    <td><?= $service_info->package; ?></td>
  </tr>-->
  <tr>
    <td class="title">Description</th>
    <td><?= nl2br($service_info->description); ?></td>
  </tr>
  <tr>
    <td class="title">Actions</th>
    <td class="odd">
      <table cellspacing="0" class="service_actions">
        <tr>
          <th>Name</th>
          <th>Description</th>
        </tr>
      <?
      foreach($actions as $action)
      {
        $action_info = $serviceReflector->getActionInfo($action);
        echo '<tr><td>'.$action.'</td><td>'.nl2br($action_info->description).'</td></tr>';
      }
      ?>
      </table>
    </td>
  </tr>
</table>
  