<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
	<title>Kaltura CMS</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="text/JavaScript" src="/js/jqkaltura.packed.js"></script>
	<link rel="stylesheet" type="text/css" href="/css/sdk_admin.css"/>
	
	<script type="text/javascript">
		jQuery(document).ready(function(){		
		});
	
		function forgotPassword()
		{
			if (confirm("This will reset your current password\nAre you sure?"))
			{ 
				document.forms["cmsLoginForm"]["forgot_password"].value = true;
				$("#cmsLoginForm")[0].submit();;
			}
		}

	</script>

<?php
	if ( $signinstatus == 'SIGNIN_STATUS_SUCCESS' ) { ?>
	<script type="text/javascript">
	window.location = "dashboard";
	</script>
<? } ?>
<?php
	if ( $signinstatus == 'SIGNIN_STATUS_FORGOT_SENT' ) { ?>
	<script type="text/javascript">
		alert("An email has been sent to you\nwith the new password.");
	</script>	
<? } ?>

</head>
<body>
	<div style="text-align:center; margin:10px 0 0 0;"><img src="/images/cms/klogo.png" alt="kaltura &ndash; creating together" /></div>	
	<div class="login scheme1 clearfix">
		<h1>Login</h1>
		<form method="post" name="cmsLoginForm" id="cmsLoginForm" action="login">
			<fieldset>
			<input type="hidden" name="exit" value="false"/>
			<input type="hidden" name="forgot_password" value="false"/>
		<? if (( $signinstatus == 'SIGNIN_STATUS_WRONGPWD') ||
			   ( $signinstatus == 'SIGNIN_STATUS_USER_NOT_FOUND')) { ?>
			<div style="color:red">Error: Invalid login information</div>
			<br />
		<? } ?>		
		<? if ( $signinstatus == 'SIGNIN_STATUS_FORGOT_NOT_FOUND') { ?>
			<div style="color:red">Error: email not found</div>
			<br />
		<? } ?>
		<? if ( $signinstatus == 'SIGNIN_STATUS_NO_INPUT_EMAIL') { ?>
			<div style="color:red">Error: Please enter email</div>
			<br />
		<? } ?>	
			<div class="item">
				<label>Email</label><br />
				<input type="text" name="email" value="<? echo $email ?>"/>
			</div>
			<div class="item">
				<label>Password</label><br />
				<input type="password" name="pwd" value=""/>
			</div>
			<button onclick='$("#cmsLoginForm")[0].submit();'>Login</button>
			</fieldset>
		</form>
		<a href="javascript:forgotPassword();">forgot password?</a>
	</div><!-- login -->

</body>
</html>
