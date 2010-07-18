<tr style="display: none;">
	<td>
		<div id="result_count"><?php echo $count; ?></div>
	</td>
</tr>

<?php if (!count($entries)): ?> 
<tr>
	<td class="name" colspan="8" align="center">No data found</td>
</tr>
<?php endif; ?>
<?php foreach($entries as $entry): ?>
<tr>
	<td class="thumb"><div class="hand" onclick="openPlayerWidget(-1, '<?php echo $entry->getId(); ?>')"><img src="<?php echo $entry->getThumbnailUrl(); ?>" alt=""  border="0"></div></td>
	<td class="name"><span><a href="javascript:void(0)" onclick="openPlayerWidget(-1, '<?php echo $entry->getId(); ?>')"><?php echo $entry->getName(); ?></a></span><br/><?php echo $entry->getId();?></td>
	<td><?php echo $entry->getPermissions(); ?></td>
	<td><?php echo $entry->getkuser()->getScreenName(); ?></td>
	<td><?php echo kString::formatDate($entry->getCreatedAt(null)) ?></td>
	<td><?php echo $entry->getViews(); ?></td>
	<td>
		<?php if (count($entry->shows)): ?>
		<select id="inshows<?php echo $entry->getId(); ?>" style="width: 160px;" class="hand">
		<?php foreach($entry->shows as $show): ?>
			<option value="<?php echo $show->getId(); ?>">
				<?php if (trim($show->getName()) != ""): ?>
					<?php echo $show->getName(); ?>
				<?php else: ?>
					<?php echo $show->getId(); ?>
				<?php endif; ?>
			</option>
		<?php endforeach; ?>
		</select>
		<a class="hand" onclick="openPlayerWidget($('#inshows<?php echo $entry->getId(); ?>').val());">View</a>
		<?php endif; ?>
	</td>
	<td class="actions"><input name="delete_entries" type="checkbox" value="<?php echo $entry->getId(); ?>" onclick="updateDeleteButtonState()" /></td>
</tr>
<?php endforeach; ?>