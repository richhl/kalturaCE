<div class="page_header">
	<h1>Reports</h1>
</div>
<div class="section">
	<table cellspacing="0" cellpadding="0">
		<thead>
			<tr>
				<td>Type</td>
				<td>Total</td>
				<td>Past 24 Hours</td>
				<td>Past Week</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><span class="btn" onclick="$.history.load('contentShows');">Shows</span></td>
				<td><?php echo $reportSummury['shows']['total']; ?></td>
				<td><?php echo $reportSummury['shows']['day']; ?></td>
				<td><?php echo $reportSummury['shows']['week']; ?></td>
			</tr>
			<tr>
				<td><span class="btn" onclick="$.history.load('contentEntries');">Entries</span></td>
				<td><?php echo $reportSummury['entries']['total']; ?></td>
				<td><?php echo $reportSummury['entries']['day']; ?></td>
				<td><?php echo $reportSummury['entries']['week']; ?></td>
			</tr>
			<tr>
				<td><span class="btn" onclick="$.history.load('usersList');">Users</span></td>
				<td><?php echo $reportSummury['users']['total']; ?></td>
				<td><?php echo $reportSummury['users']['day']; ?></td>
				<td><?php echo $reportSummury['users']['week']; ?></td>
			</tr>
			<tr>
				<td>Views</td>
				<td><?php echo $reportSummury['views']['total']; ?></td>
				<td><?php echo $reportSummury['views']['day']; ?></td>
				<td><?php echo $reportSummury['views']['week']; ?></td>
			</tr>
		</tbody>
	</table><br />
	<span>Top Viewed: </span><a href="javascript:void(0);">N/A</a>
	<span style="margin-left:70px;">Moderation queue: </span><span class="btn" onclick="$.history.load('contentModeration');"><?php echo $reportSummury['moderation_queue']; ?></span>
</div><!-- section -->
 <?php /*
<div class="section">
	<div class="title">
		<span class="floatr btn" onclick="$.history.load('contentEntries');">All Entries</span>
		<span class="floatr btn" onclick="$.history.load('contentShows');">All Shows</span>	
		<h2>Last 30</h2>
	</div>
	<div class="section_content">
		<div class="clearfix">
			<ul class="table_tabs">
				<li class="active"><span class="top_shows_table">Shows</span></li>
				<li><span class="top_entries_table">Entries</span></li>
			</ul>
			<div id="pager" class="pager floatr"></div>
		</div>
		<table cellspacing="0" cellpadding="0" id="showsTableData">
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
	</div><!-- end section_content -->
</div><!-- end section -->

<script type="text/javascript">

	var tableManager = new TableManager($('#showsTableData'), 'contentShowsData');
	tableManager.saveFilterToCookieCookie = false;
	tableManager.addSortableColumn($("#sortByName"), "name");
	tableManager.addSortableColumn($("#sortByDuration"), "duration");
	tableManager.addSortableColumn($("#sortByPermissions"), "permissions");
	tableManager.addSortableColumn($("#sortByCreatedBy"), "created_by");
	tableManager.addSortableColumn($("#sortByCreatedOn"), "created_on");
	tableManager.addSortableColumn($("#sortByLastUpdate"), "last_update");
	tableManager.addSortableColumn($("#sortByContributors"), "contributors");
	tableManager.addSortableColumn($("#sortByEntries"), "entries");
	tableManager.addSortableColumn($("#sortByViews"), "views");
	
	tableManager.setDefaultSort('created_on', 'desc');
	
//	tableManager.onFilterChanged.subscribe(updateDeleteButtonState);
	
//	tableManager.loadFilterDataFromCookie();

	tableManager.loadData();
	/*
	$("table tbody td.actions button.del").click(function(){
		if ( confirm ( "Are you certain ?" ) ){
			$(this).parents("tr").next("tr.moreInfo").andSelf().remove();
		}
	});
	
	
</script>
*/
?>