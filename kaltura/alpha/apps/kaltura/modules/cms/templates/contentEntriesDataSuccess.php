<tr style="display: none;">
	<td>
		<div id="result_count"><?=$count; ?></div>
	</td>
</tr>

<?php if (!count($entries)): ?> 
<tr>
	<td class="name" colspan="8" align="center">No data found</td>
</tr>
<? endif; ?>
<?php foreach($entries as $entry): ?>
<tr>
	<td class="thumb"><div class="hand" onclick="openPlayerWidget(-1, '<?=$entry->getId(); ?>')"><img src="<?=$entry->getThumbnailUrl(); ?>" alt=""  border="0"></div></td>
	<td class="name"><span><a href="javascript:void(0)" onclick="openPlayerWidget(-1, '<?=$entry->getId(); ?>')"><?=$entry->getName(); ?></a></span><br/><?=$entry->getId();?></td>
	<td><?=$entry->getPermissions(); ?></td>
	<td><?=$entry->getkuser()->getScreenName(); ?></td>
	<td><?=kString::formatDate($entry->getCreatedAt(null)) ?></td>
	<td><?=$entry->getViews(); ?></td>
	<td>
		<?php if (count($entry->shows)): ?>
		<select id="inshows<?=$entry->getId(); ?>" style="width: 160px;" class="hand">
		<?php foreach($entry->shows as $show): ?>
			<option value="<?=$show->getId(); ?>">
				<?php if (trim($show->getName()) != ""): ?>
					<?=$show->getName(); ?>
				<? else: ?>
					<?=$show->getId(); ?>
				<?php endif; ?>
			</option>
		<?php endforeach; ?>
		</select>
		<a class="hand" onclick="openPlayerWidget($('#inshows<?=$entry->getId(); ?>').val());">View</a>
		<?php endif; ?>
	</td>
	<td class="actions"><input name="delete_entries" type="checkbox" value="<?=$entry->getId(); ?>" onclick="updateDeleteButtonState()" /></td>
</tr>
<?php endforeach; ?>