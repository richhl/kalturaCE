<tr style="display: none;">
	<td>
		<div id="result_count"><?php echo $count; ?></div>
	</td>
</tr>

<?php if (!count($shows)): ?> 
<tr>
	<td class="name" colspan="14" align="center">No data found</td>
</tr>
<?php endif; ?>

<?php foreach ($shows as $show): ?>
<tr>
	<td class="more"><div></div></td>
	<td class="thumb"><div><img src="<?php echo $show->getThumbnailUrl(); ?>" alt="" onclick="openPlayerWidget('<?php echo $show->getId(); ?>')" class="hand"></div></td>
	<td class="name">
		<a href="javascript:void(0)" onclick="openPlayerWidget('<?php echo $show->getId(); ?>')">
			<span><?php echo $show->getName(); ?></span>
		</a> 
		<br/><?php echo $show->getId(); ?>
		
		(<?php echo sprintf("%d:%02d", $show->getLengthInMsecs() / 1000 / 60, $show->getLengthInMsecs() / 1000 % 60); ?>)</td>
	<td><?php echo $show->getPermissions(); ?></td>
	<td class="by"><?php echo $show->getKuser()->getScreenName(); ?></td>
	<td class="updated"><?php echo kString::formatDate($show->getCreatedAt(null)); ?></td>
	<td class="updated"><?php echo kString::formatDate($show->getUpdatedAt(null)); ?></td>
	<td class="contributors"><?php echo $show->getContributors(); ?></td>
	<td class="entries"><?php echo $show->getEntries(); ?></td>
	<td class="views"><?php echo $show->getViews(); ?></td>
	<td></td>
	<td></td>
	<td></td>
	<td class="actions"><input name="delete_shows" type="checkbox" value="<?php echo $show->getId(); ?>" onclick="updateDeleteButtonState()" /></td>
</tr>
<tr class="moreInfo">
	<td colspan="14">
		<p><?php echo $show->getDescription(); ?>&nbsp;</p>
	</td>
</tr>
<?php endforeach; ?>
	
<script type="text/javascript">
	$("#main_content  table tbody td.more").click(function(){						/* show/hide more information, opens the next TR */
		if( $(this).hasClass('open') )
			$(this).removeClass("open").parent("tr").next("tr.moreInfo").hide();
		else{
			var dis = ($.browser.msie) ?  "block" : "table-row";
			$(this).addClass("open").parent("tr").next("tr.moreInfo").css("display",dis);
		}
	});
</script>