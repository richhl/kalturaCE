<tr style="display: none;">
	<td>
		<div id="result_count"><?php echo $count; ?></div>
	</td>
</tr>

<?php if ($count <= 0): ?> 
<tr>
	<td class="name" colspan="8" align="center">No data found</td>
</tr>
<?php endif; ?>
<?php foreach($pusersKusers as $puserKuser): ?>
<tr>
	<td class="more"></td>
	<td align="center"><?php echo $puserKuser->getKuserId();?></td>
	<td align="center"><?php echo $puserKuser->getPuserId();?></td>
	<td><?php echo $puserKuser->getPuserName();?></td>
	<td><?php echo $puserKuser->getkuser()->getEmail();?></td>
	<td><a onclick="$.history.load('contentEntries/userId/<?php echo $puserKuser->getKuserId();?>');" class="hand"><u><?php echo $puserKuser->num_of_entries;?></u></a></td>
	<td><a onclick="$.history.load('contentShows/userId/<?php echo $puserKuser->getKuserId();?>');" class="hand"><u><?php echo $puserKuser->num_of_shows;?></u></a></td>
	<td><?php echo kString::formatDate($puserKuser->getCreatedAt(null));?></td>
</tr>
<?php endforeach; ?>