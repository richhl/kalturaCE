<!-- state fields -->
<input type="hidden" id="current_page_index" value="1" />
<input type="hidden" id="current_page_size" value="20" />
<input type="hidden" id="sort_by" value="" />
<input type="hidden" id="sort_direction" value="asc" />

<div class="page_header">
	<div id="search_page"></div>
	<h1>Moderation Queue</h1>
	<br />
	<input id="waiting_for_approval_radio" name="moderation_display" type="radio" checked="checked" />
	<label for="waiting_for_approval_radio">Waiting for approval entries</label>
	<br />
	<input id="reported_radio" name="moderation_display" type="radio" />
	<label for="reported_radio">Reported entries</label> 
	<br />
	<input id="rejected_radio" name="moderation_display" type="radio" />
	<label for="rejected_radio">Rejected entries</label>
</div>

<div class="section">
	<div class="top_table clearfix">
		<div id="pager" class="pager floatr"></div>
	</div>

	<table cellspacing="0" cellpadding="0" id="tableData">
			<thead>
				<tr class="unselectable">
					<td class="thumb">&nbsp;</td>
					<td id="sortByName" class="name">Name / ID</td>
					<td id="sortByViewingPermissions" class="permissions">Viewing permissions</td>
					<td id="sortByCreatedBy">Created by</td>
					<td id="sortByCreatedOn">Created on</td>
					<td class="actions">Actions</td>
				</tr>
			</thead>
			<colgroup></colgroup>
			<colgroup></colgroup>
			<colgroup></colgroup>
			<colgroup></colgroup>
			<colgroup></colgroup>
			<colgroup></colgroup>
			<colgroup></colgroup>
			<tbody>
				
			</tbody>
		</table>
</div>
<script type="text/javascript">
	
	function addDisplayRejectedFilter () {
		if ($("#waiting_for_approval_radio").get(0).checked)
			tableManager.addCustomFilter('moderationDisplay', 0);
			
		else if ($("#reported_radio").get(0).checked)
			tableManager.addCustomFilter('moderationDisplay', 1);
			
		else if ($("#rejected_radio").get(0).checked)
			tableManager.addCustomFilter('moderationDisplay', 2);	
	}
		
	function allowModeration(moderationId) {
		var url = "contentModerationAllow";
		$.ajax(
			{
				type: "POST",
				url: url,
				success: function (data) {
					if (data == "SUCCESS")
						tableManager.loadData();
					else
						alert("Failed to update entry status");
				},
				error: function () {
					alert("Failed to update entry status");
				},
				data: {"moderationId": moderationId}
			}
		)
	};
	
	function rejectModeration(moderationId) {
		var url = "contentModerationReject";
		$.ajax(
			{
				type: "POST",
				url: url,
				success: function (data) {
					if (data == "SUCCESS")
						tableManager.loadData();
					else
						alert("Failed to update entry status");						
				},
				error: function () {
					alert("Failed to update entry status");
				},
				data: {"moderationId": moderationId}
			}
		)
	};
		
	var tableManager = new TableManager($('#tableData'), 'contentModerationData');
	
	addDisplayRejectedFilter();

	tableManager.loadData();
	
	$('#waiting_for_approval_radio').bind("click", function () {
		addDisplayRejectedFilter();
		tableManager.loadData();
	});
	
	$('#rejected_radio').bind("click", function () {
		addDisplayRejectedFilter();
		tableManager.loadData();
	});
	
	$('#reported_radio').bind("click", function () {
		addDisplayRejectedFilter();
		tableManager.loadData();
	});

</script>
