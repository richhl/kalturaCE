<!-- state fields -->
<input type="hidden" id="current_page_index" value="1" />
<input type="hidden" id="current_page_size" value="20" />
<input type="hidden" id="sort_by" value="" />
<input type="hidden" id="sort_direction" value="asc" />

<div class="page_header">
	<div id="search_page"></div>
	<h1>Users List</h1>
</div>

<div class="section">
	<div class="top_table clearfix">
		<div id="pager" class="pager floatr"></div>
	</div>

	<table cellspacing="0" cellpadding="0" id="tableData">
			<thead>
				<tr class="unselectable">
					<td class="more"></td>
					<td id="sortById" class="id">Kaltura User ID</td>
					<td id="sortByPuserId" class="id">Partner User ID</td>
					<td id="sortByPuserName" class="name">Name</td>
					<td id="sortByEmail">Email</td>
					<td id="sortByEntries">Entries</td>
					<td id="sortByShows">Shows</td>
					<td id="sortByCreatedAt">Created at</td>
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

	var tableManager = new TableManager($('#tableData'), 'usersListData');
	tableManager.addSortableColumn($("#sortById"), "id");
	tableManager.addSortableColumn($("#sortByPuserId"), "puser_id");
	tableManager.addSortableColumn($("#sortByPuserName"), "puser_name");
	tableManager.addSortableColumn($("#sortByEmail"), "email");
	tableManager.addSortableColumn($("#sortByCreatedAt"), "created_at");
	
	tableManager.setDefaultSort('created_at', 'desc');
	
	tableManager.loadFilterDataFromCookie();

	tableManager.loadData();
</script>
