<?php
$service_url = requestUtils::getRequestHost();
$host = str_replace ( "http://" , "" , $service_url );
if ( $host == "www.kaltura.com" ) $host = "1";
$flash_dir = $service_url . myContentStorage::getFSFlashRootPath ();

$beta_str = $beta ? "/beta/{$beta}" : "";
?>
<script language="JavaScript" type="text/javascript">
<!--
// -----------------------------------------------------------------------------
var _partner_id, _subp_id, _uid;

function loginF( remMe , partner_id , subp_id ,  uid  ,  ks , screen_name , email  )
{
	var has_cookie = false;
	if ( partner_id == null )
	{
		partner_id = getCookie ( "pid" );
		subp_id = getCookie ( "subpid" );
		uid = getCookie ( "uid" );
		ks = getCookie ( "kmcks" );
		screen_name = getCookie ("screen_name" );
		// if any of the required params is null - return false and the login page will be displayed
		if ( empty(partner_id) || empty(subp_id) || empty(uid) || empty(ks) ) return false;
		
		has_cookie = true;
		
	}
	else
	{
	}	
//	alert( partner_id + " | " +  subp_id + " | " +   uid + " | " + ks + " | " + remMe);
	_partner_id = partner_id;
	_subp_id = subp_id;
	_uid = uid;
	path = '/';

	if ( remMe ) exp = 86400; // one day in seconds
	else exp = 10; // set the cookies to expire immediately
	if (!has_cookie)
	{
		setCookie ( "pid" , partner_id , exp, path);
		setCookie ( "subpid" , subp_id , exp, path);
		setCookie ( "uid" , uid , exp, path);
		setCookie ( "kmcks" , ks , exp, path);
		setCookie ( "screen_name" , screen_name , exp, path);
	}
	url = "<? echo $service_url ?>/index.php/kmc/kmc2<? echo $beta_str ?>?partner_id=" + partner_id + "&subp_id=" + subp_id + "&uid=" + 
		uid + "&ks=" + ks + "&screen_name=" + screen_name + "&email=" + email  ;
//	alert ( url );
	window.location = url;

	// TODO - send by post using form1
	return true;			
}

function closeLoginF()
{
//	alert('closeLoginF');
}

function gotoSignup()
{
	window.location = "<? echo $service_url ?>/index.php/kmc/signup";
}

// -->
</script>

<style>
 body { background-color:#272929 !important; background-image:none !important;}
</style>

<form id="form1" action="<? echo $service_url ?>/index.php/kmc/kmc2<? echo $beta_str ?>" method="post">
	<input type="hidden" name="_partner_id">
	<input type="hidden" name="_subp_id">
	<input type="hidden" name="_uid">
	<input type="hidden" name="_ks">
</form>	

<div class="login">
	<div id="kmcHeader">
     <img src="<?php echo $service_url; ?>/lib/images/kmc/logo_kmc.png" alt="Kaltura CMS" />
     <div>
      <a href="<?php echo $service_url; ?>/lib/pdf/KMC_Quick_Start_Guide.pdf" target="_blank">Quickstart Guide</a>
     </div> 
	</div><!-- end kmcHeader -->
	<div id="login">
		<div class="wrapper">
			<div id="kaltura_flash_obj"></div>
		</div><!-- end wrapper -->
	</div><!-- end #login -->
</div>	


<script type="text/javascript">
	// attempt to login without params - see if there are cookies - the remMe is true so the expiry will continue 
	if ( !loginF ( null , null , null , null , true ) ) 
	{
		var flashVars = {
			loginF: "loginF" ,
			closeF: "closeLoginF" ,
			host: "<? echo $host ?>",
			visibleSignup: "<? echo (kConf::get('kmc_login_show_signup_link'))? 'true': 'false'; ?>"
		}
	
		var params = {
			allowscriptaccess: "always",
			allownetworking: "all",
			bgcolor: "#272929",
			quality: "high",
			wmode: "window" ,
			movie: "<?php echo $flash_dir ?>/kmc/login/v1.0.8/login.swf"
		};
		swfobject.embedSWF("<?php echo $flash_dir ?>/kmc/login/v1.0.8/login.swf", 
			"kaltura_flash_obj", "358", "350", "9.0.0", false, flashVars , params);
	}

</script>

