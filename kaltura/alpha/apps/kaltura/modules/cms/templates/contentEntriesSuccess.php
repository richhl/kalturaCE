<!-- state fields -->
<input type="hidden" id="current_page_index" value="1" />
<input type="hidden" id="current_page_size" value="20" />
<input type="hidden" id="sort_by" value="" />
<input type="hidden" id="sort_direction" value="asc" />

<div class="page_header">
	<div id="search_page"></div>
	<h1>All Entries</h1>
</div>

<div class="section">
	<div class="top_table clearfix">
		<div id="date_range" class="date_range"></div>
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
					<td id="sortByViews">Views</td>
					<td id="sortByInShows">In shows</td>
					<td class="actions"><button id="delete_button" disabled="disabled">Delete</button></td>
				</tr>
			</thead>
			<colgroup></colgroup>
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

	var tableManager = new TableManager($('#tableData'), 'contentEntriesData');
	tableManager.addSortableColumn($("#sortByName"), "name");
	tableManager.addSortableColumn($("#sortByViewingPermissions"), "permissions");
	tableManager.addSortableColumn($("#sortByCreatedBy"), "created_by");
	tableManager.addSortableColumn($("#sortByCreatedOn"), "created_on");
	tableManager.addSortableColumn($("#sortByViews"), "views");
	
	tableManager.addDateRangeFilter($('#date_range'));
	tableManager.addSearchFilter($('#search_page'));

	// add user if to the filter if passed in hash	
	var route = Utils.getRoute();
	var userId = route.params.userId;
	if (userId) {
		tableManager.addCustomFilter('userId', userId);
		
		// will set the header for "Entries for user blabla"
		tableManager.onDataLoaded.subscribe(function() {
			// hack to find the user name by the first table row
			var userName = tableManager.jQuery.find("tbody tr td")[4].innerHTML;
			tableManager.setPageHeader("Entries by " + userName);
		});
	}
	
	tableManager.setDefaultSort('created_on', 'desc');
	
	tableManager.onFilterChanged.subscribe(updateDeleteButtonState);
	
	tableManager.loadFilterDataFromCookie();

	tableManager.loadData();
	
	
	function deleteEntriesClickHandler() {
		if (confirm("Are you certain?")) {
			var checkedCheckboxes = $('input[@name="delete_entries"][@checked]');
			var entryIds = [];
			checkedCheckboxes.each(
				function (i) {
					entryIds.push(this.value);
				}
			);
			
			var success = function (data) {
				tableManager.loadData();
			}
			
			var error = function () {
				alert('Failed to delete.');
			}
			
			var url = "deleteEntries";
			$.ajax(
				{
					type: "POST",
					url: url,
					success: success,
					error: error,
					data: {"entryIds[]": entryIds}
				}
			)
		}
	};
	
	function updateDeleteButtonState() {
		var checkedCheckboxes = $('input[@name="delete_entries"][@checked]');
		if (checkedCheckboxes.size() > 0) 
			$('#delete_button').removeAttr('disabled');			
		else
			$('#delete_button').attr('disabled', 'disabled');
	};
	
	
	$('#delete_button').bind("click", deleteEntriesClickHandler);

</script>
