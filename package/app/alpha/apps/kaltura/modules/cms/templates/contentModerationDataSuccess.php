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
<?php foreach($moderations as $moderation): ?>
<tr>
	<td class="thumb">
		<div class="hand" onclick="openPlayerWidget(-1, <?php echo $moderation->moderated_object->getId(); ?>)">
			<?php if ($moderation_display != "2"): ?>
				<img src="<?php echo $moderation->moderated_object->getThumbnailUrl(); ?>" alt=""  border="0">
			<?php endif; ?>
		</div>
	</td>
	<td class="name"><span><a href="javascript:void(0)" onclick="openPlayerWidget(-1, <?php echo $moderation->moderated_object->getId(); ?>)"><?php echo $moderation->moderated_object->getName(); ?></a></span><br/><?php echo $moderation->moderated_object->getId();?></td>
	<td><?php echo $moderation->moderated_object->getPermissions(); ?></td>
	<td><?php echo $moderation->moderated_object->getkuser()->getScreenName(); ?></td>
	<td><?php echo kString::formatDate($moderation->moderated_object->getCreatedAt(null)) ?></td>
	<td class="actions">
		<?php if (($moderation_display != "2")): ?>
		<button name="allow_moderation" moderation_id="<?php echo $moderation->getId(); ?>" onclick="allowModeration($(this).attr('moderation_id'))">Allow</button><br />
		<button name="reject_moderation" moderation_id="<?php echo $moderation->getId(); ?>" onclick="rejectModeration($(this).attr('moderation_id'))">Reject</button>
		<?php endif; ?>
	</td>
</tr>
<?php endforeach; ?>