<!-- state fields -->
<input type="hidden" id="current_page_index" value="1" />
<input type="hidden" id="current_page_size" value="20" />
<input type="hidden" id="sort_by" value="" />
<input type="hidden" id="sort_direction" value="asc" />

<div class="page_header">
	<div id="search_page"></div>
	<h1>All Shows</h1>
</div>

<div class="section">
	<div class="top_table clearfix">
		<div id="pager" class="pager floatr"></div>
	</div>
	<table cellspacing="0" cellpadding="0" id="tableData">
		<thead>
			<tr class="unselectable">
				<td class="more">&nbsp;</td>
				<td class="thumb">&nbsp;</td>
				<td id="sortByName" class="name">Name</td>
				<td id="sortByPermissions" class="name">Permissions</td>
				<td id="sortByCreatedBy" class="by">Created By</td>
				<td id="sortByCreatedOn" class="by">Created On</td>
				<td id="sortByLastUpdate" class="updated">Last Update</td>
				<td id="sortByContributors" class="contributors">Contributors</td>
				<td id="sortByEntries" class="entries">Entries</td>
				<td id="sortByViews" class="views">Views</td>
				<td id="sortByEdits" class="views">Edits</td>
				<td id="sortByShares" class="views">Shares</td>
				<td id="sortByClones" class="views">Clones</td>
				<td class="actions"><button id="delete_button" disabled="disabled">Delete</button></td>
			</tr>
		</thead>
		<colgroup span="1" width="15px"></colgroup>
		<colgroup></colgroup>
		<colgroup></colgroup>
		<colgroup></colgroup>
		<colgroup></colgroup>
		<colgroup></colgroup>
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
</div><!-- section -->

<script type="text/javascript">
	var tableManager = new TableManager($('#tableData'), 'contentShowsData');
	tableManager.addSortableColumn($("#sortByName"), "name");
	tableManager.addSortableColumn($("#sortByDuration"), "duration");
	tableManager.addSortableColumn($("#sortByPermissions"), "permissions");
	tableManager.addSortableColumn($("#sortByCreatedBy"), "created_by");
	tableManager.addSortableColumn($("#sortByCreatedOn"), "created_on");
	tableManager.addSortableColumn($("#sortByLastUpdate"), "last_update");
	tableManager.addSortableColumn($("#sortByContributors"), "contributors");
	tableManager.addSortableColumn($("#sortByEntries"), "entries");
	tableManager.addSortableColumn($("#sortByViews"), "views");
	
	tableManager.addSearchFilter($('#search_page'));

	// add user if to the filter if passed in hash	
	var route = Utils.getRoute();
	var userId = route.params.userId;
	if (userId) {
		tableManager.addCustomFilter('userId', userId);
		
		// will set the header for "Entries for user blabla"
		tableManager.onDataLoaded.subscribe(function() {
			// hack to find the user name by the first table row
			var userName = tableManager.jQuery.find("tbody tr td")[5].innerHTML;
			tableManager.setPageHeader("Shows by " + userName);
		});
	}
	
	tableManager.setDefaultSort('created_on', 'desc');
	
	tableManager.onFilterChanged.subscribe(updateDeleteButtonState);
	
	tableManager.loadFilterDataFromCookie();

	tableManager.loadData();
	
	
	
	function deleteShowsClickHandler() {
		if (confirm("Are you certain?")) {
			var checkedCheckboxes = $('input[@name="delete_shows"][@checked]');
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
			
			var url = "deleteShows";
			$.ajax(
				{
					type: "POST",
					url: url,
					success: success,
					error: error,
					data: {"showIds[]": entryIds}
				}
			)
		}
	};
	
	function updateDeleteButtonState() {
		var checkedCheckboxes = $('input[@name="delete_shows"][@checked]');
		if (checkedCheckboxes.size() > 0) 
			$('#delete_button').removeAttr('disabled');			
		else
			$('#delete_button').attr('disabled', 'disabled');
	};
	
	$('#delete_button').bind("click", deleteShowsClickHandler);
	
</script>