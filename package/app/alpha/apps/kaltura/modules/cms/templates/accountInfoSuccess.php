<div class="page_header">
	<h1>General Info</h1>
</div>

<div id="page_account_info">
		<form action="" method="post">
			<?php /*
			<fieldset class="logo type2">
				<legend>Logo <span class="btn" onclick="void(0)">[change]</span></legend>		
				<img src="images/logo_weplay.gif" alt="weplay.com" />
				<input id="logoupload" type="file" name="logo" size="20" style="display:none; margin-top:8px;" > 
			</fieldset>
			*/ ?>
			<fieldset>
				<div class="item">
					<label for="partner_id">Partner Id:</label>
					<input id="partner_id" name="partner_id" type="text" readonly="readonly" style="width:80px" value="<?php echo $partner->getId(); ?>"/>
				</div>
				<div class="item">
					<label for="sub_partner_id">Sub-Partner Id:</label>
					<input id="sub_partner_id" name="sub_partner_id" type="text" readonly="readonly" style="width:80px" value="<?php echo $sub_partner_id; ?>"/>
				</div>
				<div class="item">
					<label for="aministrator_secret">Administrator Secret:</label>
					<input id="aministrator_secret" name="aministrator_secret" type="text" readonly="readonly" style="width:250px" value="<?php echo $partner->getAdminSecret(); ?>"/>
				</div>
				<div class="item">
					<label for="web_service_secret">Web Service Secret:</label>
					<input id="web_service_secret" name="web_service_secret" type="text" readonly="readonly" style="width:250px" value="<?php echo $partner->getSecret(); ?>"/>
				</div>
			</fieldset>
		</form>
</div><!-- page_new_app -->
<?php /* ?>
<script type="text/javascript">
	
	function uploadLogo(btn){
		var e = $("#logoupload");
		(e.css("display") == "none") ? e.show("fast") : e.hide("fast");
	}

	$("input:file").change(function(){
		var trimpath = this.value.lastIndexOf('\\');
		var filename = this.value.substring(trimpath+1);
		var trimpath = filename.lastIndexOf('.');
		var ext = filename.substring(trimpath+1);
	});
</script>
*/?>