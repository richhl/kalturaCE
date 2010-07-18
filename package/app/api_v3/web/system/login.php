<?php
$skip_auth = TRUE;
require_once("systembase.php");
if (!$_GET['dest']) $_GET['dest'] = 'index.php';
$error = null;
if (isset($_POST['username']) && isset($_POST['password']))
{
    if (kConf::get( 'system_pages_login_username' ) == $_POST['username'] &&
        kConf::get( 'system_pages_login_password' ) == sha1($_POST['password']))
    {
        $_SESSION['api_v3_login'] = true;
        header("Location: ".$_POST['dest']);
    }
    $error = false;
}
require_once('header.php');
?>
<div class="login">
  You must login in order to access the system pages.<br />
  If you are a KalturaCE user, the credentials are the email &amp; password you supplied during installation.
</div>
<form method="POST" class="loginform">
<?php
 if($error === false) echo '<div class="login-error">Failed to login. Try again</div>';
?>    
  <input type="hidden" value="<?php echo $_GET['dest']; ?>" name="dest" />
  <label for="username">Email: </label>
  <input type="text" name="username" value="" /><br />
  <label for="password">Password: </label>
  <input type="password" name="password" value="" /><br />
  <input type="submit" value="Login" />
</form>
<?php
require_once('footer.php');
?>