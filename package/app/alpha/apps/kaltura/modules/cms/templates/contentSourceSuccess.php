<!-- state fields -->
<input type="hidden" id="current_page_index" value="1" />
<input type="hidden" id="current_page_size" value="20" />
<input type="hidden" id="sort_by" value="" />
<input type="hidden" id="sort_direction" value="asc" />

<div class="page_header">
	<div id="search_page"></div>
	<h1>Content Source</h1>
</div>

<div class="section">
	<div class="top_table clearfix">
		<div id="pager" class="pager floatr"></div>
	</div>

	<table cellspacing="0" cellpadding="0">
		<thead>
			<tr>
				<td>&nbsp;</td>
				<td>Content Source</td>
				<td>Num of Entries</td>
			</tr>
		</thead>
		<tbody>
			<?php foreach($result as $obj): ?>
			<tr class="unselectable">
				<td class="more"></td>
				<td class="id" style="width:250px;"><?php echo $obj["source_name"]; ?></td>
				<td class="id"><?php echo $obj["num_of_entries"]; ?></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
		</table>
</div>
