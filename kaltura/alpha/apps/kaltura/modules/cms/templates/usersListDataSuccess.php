<tr style="display: none;">
	<td>
		<div id="result_count"><?=$count; ?></div>
	</td>
</tr>

<?php if ($count <= 0): ?> 
<tr>
	<td class="name" colspan="8" align="center">No data found</td>
</tr>
<? endif; ?>
<?php foreach($pusersKusers as $puserKuser): ?>
<tr>
	<td class="more"></td>
	<td align="center"><?=$puserKuser->getKuserId();?></td>
	<td align="center"><?=$puserKuser->getPuserId();?></td>
	<td><?=$puserKuser->getPuserName();?></td>
	<td><?=$puserKuser->getkuser()->getEmail();?></td>
	<td><a onclick="$.history.load('contentEntries/userId/<?=$puserKuser->getKuserId();?>');" class="hand"><u><?=$puserKuser->num_of_entries;?></u></a></td>
	<td><a onclick="$.history.load('contentShows/userId/<?=$puserKuser->getKuserId();?>');" class="hand"><u><?=$puserKuser->num_of_shows;?></u></a></td>
	<td><?=kString::formatDate($puserKuser->getCreatedAt(null));?></td>
</tr>
<?php endforeach; ?>