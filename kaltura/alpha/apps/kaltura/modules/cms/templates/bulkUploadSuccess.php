<script type="text/javascript" src="/js/ajaxfileupload.js"></script>
<?php use_helper('Url') ?>

<script type="text/javascript">
	function ajaxFileUpload()
	{
		var uid = $('#uid').val();
		var name = $('#name').val();
		var homePageLink = $('#homePageLink').val();

		var conversionQuality = 1;
		if ($('#high_quality').get(0).checked)
			conversionQuality = 2;

		var contentPermissions = <?php echo myPrivilegesMgr::PERMISSIONS_PUBLIC; ?>;
		if ($('#content_private').get(0).checked)
			contentPermissions = <?php echo myPrivilegesMgr::PERMISSIONS_PRIVATE; ?>;
		
		uploadTextInterval = setInterval(updateUploadText, 500);

		$('#btnUpload').attr('disabled', 'disabled');
		$.ajaxFileUpload
		(
			{
				url: '<?php echo url_for('cms/bulkUploadDoUpload'); ?>?uid='+uid+'&name='+name+'&homePageLink='+homePageLink+'&conversionQuality='+conversionQuality+'&contentPermissions='+contentPermissions,
				secureuri: false,
				fileElementId: 'fileToUpload',
				dataType: 'json',
				success: function (data, status)
				{
					clearInterval(uploadTextInterval);
					$("#loading").hide();
					$('#fileToUpload').val("");
					$('#btnUpload').removeAttr('disabled');
					if(typeof(data.error) != 'undefined')
					{
						if (data.error != '')
						{
							alert(data.error);
						}
						else
						{
							tableManager.loadData();
						}
					}
				},
				error: function (data, status, e)
				{
					clearInterval(uploadTextInterval);
					$("#loading").hide();
					$('#fileToUpload').val("");
					$('#btnUpload').removeAttr('disabled');
					alert(e);
				}
			}
		)
		
		return false;

	}
	
	var numOfDots = 3;
	function updateUploadText() 
	{
		$("#loading").show();
		
		if (numOfDots > 3)
			numOfDots = 0;
		
		var dots = "";
		for(var i = 0; i < numOfDots; i++)
		{
			dots += ".";
		}
		
		numOfDots++;
		
		$("#loading").text("Sending" + dots);
	}
	</script>	

<!-- state fields -->
<input type="hidden" id="current_page_index" value="1" />
<input type="hidden" id="current_page_size" value="20" />

<div class="page_header">
	<h1>Add Content</h1>
</div>
<?php if (@$error): ?>
	<div style="background-color:#FBE3E4; padding:10px; margin-top:-15px; margin-bottom: 20px; border:1px dashed #FBC2C4; color:#8a1f11; "><?php echo $error; ?></div>
<?php endif; ?>
<div class="section">
	<form method="post" class="rows clearfix">	
		<fieldset class="type2 floatl" style="height:27ex;">
			<legend>1. Select Import Options</legend>
			<div class="item clearfix">
				<fieldset class="type3"><legend>Media Quality:</legend></fieldset>
				<label class="radio floatl" style="white-space:nowrap;"><input type="radio" value="web_optimized" id="web_optimized" name="media_quality" checked="checked" />Web optimized</label>
				<label class="radio floatl" style="white-space:nowrap;"><input type="radio" value="high_quality" id="high_quality" name="media_quality" />High quality</label>
			</div>
			<div class="item clearfix" style="margin-top:35px;">
				<fieldset class="type3"><legend>Content Privacy:</legend></fieldset>
				<label class="radio floatl" style="white-space:nowrap;"><input type="radio" value="public" id="content_public" name="content_privacy" checked="checked" />Public</label>
				<label class="radio floatl" style="white-space:nowrap;"><input type="radio" value="private" id="content_private" name="content_privacy" />Private</label>
			</div>
		</fieldset>
	
		<fieldset class="type2 floatr" style="height:27ex;">
			<legend>3. Upload CSV File</legend>
			<input id="fileToUpload" type="file" name="fileToUpload"/>
			<br /><br />
			<button onclick="return ajaxFileUpload();" id="btnUpload">Upload</button> <span id="loading">Uploading...</span>
			<div style="background-color:#CDDABB; padding:10px; margin-top:20px; border:1px dashed #6A804A;">
				<p>Data syntax for CSV files:</p>
				<p>Title, description, tags (space seperated), media url (either HTTP or FTP), content type (image or video)</p>
			</div>	 
		</fieldset>
		
		<fieldset class="type2 center" style="">
			<legend>2. Import Existing Video</legend>
			<div class="item">
				<label>Video ID number:</label>
				<input type="text" name="videoID"/>
			</div>
		</fieldset>	
		<br />
		<fieldset class="type2 center" style="margin-top:10px;">
			<legend>Uploader Identity:</legend>
			<div class="item">
				<label>Partner User Id:</label>
				<input type="text" id="uid" name="uid"/>
			</div>
			<fieldset class="type3"><legend>For anonymous user:</legend></fieldset>
			<div class="item">
				<label>User name:</label>
				<input type="text" id="name" name="name"/>
			</div>
			<div class="item">
				<label>Homepage link:</label>
				<input type="text" id="homePageLink" name="homePageLink"/>
			</div>
		</fieldset>	
		
	</form>
</div><!-- end section -->

<div class="section">
	<div class="top_table clearfix">
		<div id="pager" class="pager floatr"></div>
		<h2>Import Log</h2>
	</div>

	<table cellspacing="0" cellpadding="0" id="tableData">
		<thead>
			<tr class="unselectable">
				<td class="name">Uploaded By</td>
				<td class="permissions">Uploaded On</td>
				<td>Num of Entries</td>
				<td>Status</td>
				<td>Errors</td>
				<td>View Log</td>
				<td>CSV</td>
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
		<form></form>
</div><!-- end section -->

<script type="text/javascript">

	var tableManager = new TableManager($('#tableData'), 'bulkUploadData');
	
	tableManager.loadData();
	
	$("#loading").hide();
</script>
