<?php
session_name('kalt'); // to work on the same session as symfony
session_start();
if ((!session_id() ||
    !isset($_SESSION['api_v3_login']) ||
    $_SESSION['api_v3_login'] != true) &&
    !$skip_auth )
{
    header("Location: login.php?dest=".$_SERVER['REQUEST_URI']);
}