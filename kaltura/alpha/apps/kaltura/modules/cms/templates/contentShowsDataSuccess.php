<tr style="display: none;">
	<td>
		<div id="result_count"><?=$count; ?></div>
	</td>
</tr>

<?php if (!count($shows)): ?> 
<tr>
	<td class="name" colspan="14" align="center">No data found</td>
</tr>
<? endif; ?>

<?php foreach ($shows as $show): ?>
<tr>
	<td class="more"><div></div></td>
	<td class="thumb"><div><img src="<?=$show->getThumbnailUrl(); ?>" alt="" onclick="openPlayerWidget('<?=$show->getId(); ?>')" class="hand"></div></td>
	<td class="name">
		<a href="javascript:void(0)" onclick="openPlayerWidget('<?=$show->getId(); ?>')">
			<span><?=$show->getName(); ?></span>
		</a> 
		<br/><?=$show->getId(); ?>
		
		(<?=sprintf("%d:%02d", $show->getLengthInMsecs() / 1000 / 60, $show->getLengthInMsecs() / 1000 % 60); ?>)</td>
	<td><?=$show->getPermissions(); ?></td>
	<td class="by"><?=$show->getKuser()->getScreenName(); ?></td>
	<td class="updated"><?=kString::formatDate($show->getCreatedAt(null)); ?></td>
	<td class="updated"><?=kString::formatDate($show->getUpdatedAt(null)); ?></td>
	<td class="contributors"><?=$show->getContributors(); ?></td>
	<td class="entries"><?=$show->getEntries(); ?></td>
	<td class="views"><?=$show->getViews(); ?></td>
	<td></td>
	<td></td>
	<td></td>
	<td class="actions"><input name="delete_shows" type="checkbox" value="<?=$show->getId(); ?>" onclick="updateDeleteButtonState()" /></td>
</tr>
<tr class="moreInfo">
	<td colspan="14">
		<p><?=$show->getDescription(); ?>&nbsp;</p>
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