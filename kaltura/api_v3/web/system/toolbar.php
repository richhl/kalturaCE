

 <ul id="kmcSubMenu">
 	<li class="<? echo is_active_class('batchwatch.php'); ?>">
     <a href='./batchwatch.php?tabname=server' title="Get overview of system statuses, view and change the status of the system batches">System Status</a>
    </li>
    <li class="<? echo is_active_class('entries.php'); ?>">
     <a href='./entries.php?tabname=server' title="View a full list of all entries on the server, use the filters to get additional views">Entries In Process</a>
    </li>
    <li class="<? echo is_active_class('investigate.php'); ?>">
     <a href='./investigate.php?tabname=server' title="See a detailed status of a single entry, pending jobs, notification history etc.">Investigate</a>
    </li>
  <?php if (kConf::get('system_allow_edit_kConf')): ?>
    <li class="<? echo is_active_class('server_settings.php'); ?>">
	 <a href='./server_settings.php?tabname=server' title="Change basic server settings like server URL and CDN host">Server Settings</a>
    </li>
  <? endif; ?>
 </ul><!--kmcSubMenu-->

<!--
	<a href='../testme?tabname=developer' title="API Tryout Console for Kaltura's API V3">TestMe Console</a>
    <a href='../testmeDoc?tabname=developer' title="Kaltura's API V3 documentation">API Documentation</a>
-->


<?
function is_active_class($file){
    if (strpos($_SERVER['PHP_SELF'], $file))
        return 'active';
    return '';
}
?>