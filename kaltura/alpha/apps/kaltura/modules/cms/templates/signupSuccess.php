<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
	<title>Kaltura CMS</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="text/JavaScript" src="/js/jqkaltura.packed.js"></script>
	<link rel="stylesheet" type="text/css" href="/css/sdk_admin.css" />
	<script type="text/javascript">
		jQuery(document).ready(function(){		
	
			});
		
			<?php if (strlen($err_msg) > 0) {
				echo "alert('$err_msg');";
			} ?>
	
	</script>
</head>
<body>
	<div style="text-align:center; margin:10px 0 0 0;"><img src="/images/cms/klogo.png" alt="kaltura &ndash; creating together" /></div>
	
<!--************** Step 1 ******************-->
	<?php if ($step == 1) { ?>
	<div class="signup scheme1 clearfix">
		<h1>Step 1 <span>Apply for your Kaltura Partner ID</span></h1>
		<form method="POST" action="" id="signupForm">
			<input type="hidden" name="step" value="<?php echo $step; ?>"/>
			<div class="item">
				<label>Your Name</label>
				<input type="text" name="contact" id="contact" value="<?php echo $contact; ?>"/>
			</div>
			<div class="item">
				<label>Email Address</label>
				<input type="text" name="email" id="email" value="<?php echo $email; ?>"/>
			</div>
			<div class="item">
				<label>This ID is for</label>
				<div class="opts">
					<label class="radio"><input type="radio" name="ID_is_for" value="commercial_use" <?php if ($ID_is_for == 'commercial_use') echo 'checked="checked"'; ?> />Commercial use</label>
					<label class="radio"><input type="radio" name="ID_is_for" value="non-commercial_use" <?php if ($ID_is_for == 'non-commercial_use') echo 'checked="checked"'; ?> />Non-commercial use</label>
				</div>
			</div>			
			<div>
				If your project is personal, artistic, free or otherwise non-commercial please mark "Non-commercial use" above.
			</div>
			<p class="textbox">
				Below please provide sufficient details about your project to help us understand it, categorize it and provide a Partner ID. All requests are reviewed by our staff. Thank you!
			</p>
			
			<div class="item2">
				<label>Website URL:</label>
				<input type="text" style="width:564px;" name="website_url" id="website_url" value="<?php echo $website_url; ?>"/>
			</div>						
			<br/>
			<div class="item2">
				<label>Additional information about your project and how you plan to use the Collaborative Video functionality:</label><br />
				<textarea cols="50" rows="6" style="width:564px;"  name="description" id="description"><?php echo $description; ?></textarea>
			</div>
			<br />
			<br />
			<label class="chkbx"><input type="checkbox" name="SDK_terms_agreement" value="yes"/>I agree to comply with the Kaltura SDK <span class="btn" onclick="open_modal('terms')">Terms of Use</span></label>

			<center><button onclick='$("#signupForm")[0].submit();'>Get API key / Partner ID</button></center>
		</form>
	</div><!-- signup -->
	
		
	<div class="modal big" id="terms">
		<div class="contWrap">
			<div class="title">
				<span class="btn close" onclick="close_modal()">Close</span>
				<h2>Kaltura Web Services Agreement</h2>
			</div>
			<div class="content">
			</div><!-- section_content -->
		</div>
		<!-- contWrap -->	
	</div><!-- modal -->

	<?php } ?>
	
	<?php if ($step == 2) { ?>
<!--************** Step 2 ******************-->
	
	<div class="signup scheme1 clearfix">
		<h1>Step 2</h1>
		<form method="POST" action="" id="signupForm">
			<p class="textbox">
				Information you will need in order to install the Kaltura collaborative video technology:<br/>
			</p>
			<input type="hidden" name="step" value="<?php echo $step; ?>"/>
			<div class="item">
				<label>Partner Id:</label>
				<input type="text" readonly="true" value="<?php echo $partnerId; ?>" />
			</div>
			<div class="item">
				<label>Sub-Partner Id:</label>
				<input type="text" readonly="true" value="<?php echo $subPartnerId; ?>" />
			</div>
			<div class="item">
				<label>Administrator Secret:</label>
				<input type="text" readonly="true" value="<?php echo $adminSecret; ?>" />
			</div>
			<div class="item">
				<label>Web Service Secret:</label>
				<input type="text" readonly="true" value="<?php echo $secret; ?>" />
			</div>
			<p class="textbox">
				You can administer your account by logging into the Kaltura CMS (Content Management System) at <a href="http://www.kaltura.com/index.php/cms/dashboard">http://www.kaltura.com/index.php/cms/dashboard</a>. Your login information is as follows:
			</p>
			<div class="item">
				<label>CMS Login email:</label>
				<input type="text" readonly="true" value="<?php echo $loginEmail; ?>" />
			</div>
			<div class="item">
				<label>CMS Login password:</label>
				<input type="text" readonly="true" value="<?php echo $loginPassword; ?>" />
			</div>
			<p class="textbox">
				Please save the API Key information listed above. 
				Your registration information has also been sent to the following email: <?php echo $loginEmail; ?>.<br/>
			</p>
			
			<button onclick='$("#signupForm")[0].submit();'>Continue</button>
		</form>
	</div><!-- signup -->
	<?php } ?>
	
	<?php if ($step == 3) { ?>
<!--************** Step 3 ******************-->
	
	<div class="signup scheme1 clearfix">
		<h1>Step 3 <span>Congratulations!</span></h1>
		<form>
			<ul class="linksList">
				<li>Congratulations!<br/>
				<br/>
				Visit our <a href="http://corp.kaltura.com/wiki/index.php">Developer Wiki</a> for more information and documentation.
				</li>
<?/*
				<li>&raquo; <a href="/index.php/cms/helpApi">Learn more about our API</a></li>
				<li>&raquo; <a href="/index.php/cms/dashboard?c=createapp">Start building your application</a></li>
				<li>&raquo; <a href="/index.php/cms/dashboard?c=addcontent">Add Content</a></li>
				<li>&raquo; <a href="/index.php/cms/dashboard?c=addusers">Add Users</a></li>
*/?>
			</ul>
		</form>
	</div><!-- signup -->		
	<?php } ?>

	<script type="text/javascript">
	//<![CDATA[
		
		function open_modal(e){
			if( $("div.modalOverlay").length == '0' )   // fix a bug - if you click a button the overlay is created, and then click "space" it creates it again for some reason.
				$("body").prepend("<div class='modalOverlay' onclick='close_modal()'></div>");
			if( $("div.modal:visible").length == '0' ){
				var url = "/index.php/cms/TermsOfUse";
				$("#terms div.content").load(url);
				$("#"+e).show();
			}
		};
		
		function close_modal(){
			$("div.modal:visible").hide();
			$("#terms div.content").empty();
			$("div.modalOverlay").remove();
		};
		
		/* Show a loading message whenever an AJAX request starts (and none is already active) */
		$("#terms div.content").ajaxStart(function(){
			$(this).html("<div class='ajaxloader'></div>");
		});
		
	//]]>
	</script>
	
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript"></script>
<script type="text/javascript">
_uacct = "UA-2078931-1";
urchinTracker();
</script>	
</body>

</html>