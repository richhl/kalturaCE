<?php
$serviceReflector = new KalturaServiceReflector($service);

$actions = array_keys($serviceReflector->getActions());
$serviceInfo = $serviceReflector->getServiceInfo();
?>
<h2>Kaltura API</h2>
<table id="serviceInfo">
  <tr>
    <td class="title">Service Name</td>
    <td class="odd"><?= $serviceInfo->serviceName; ?></td>
  </tr>
<!--  <tr>
    <th>Package</th>
    <td><?= $serviceInfo->package; ?></td>
  </tr>-->
  <tr>
    <td class="title">Description</td>
    <td><?= nl2br($serviceInfo->description); ?></td>
  </tr>
  <tr>
    <td class="title">Actions</td>
    <td class="odd">
      <table cellspacing="0" class="service_actions">
        <tr>
          <th>Name</th>
          <th>Description</th>
        </tr>
      <?
      foreach($actions as $action)
      {
        $actionInfo = $serviceReflector->getActionInfo($action);
        echo '<tr><td>'.$actionInfo->action.'</td><td>'.nl2br($actionInfo->description).'</td></tr>';
      }
      ?>
      </table>
    </td>
  </tr>
</table>
  