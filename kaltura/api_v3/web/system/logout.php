<?php
session_name('kalt'); // to work on the same session as symfony
session_start();
$_SESSION['api_v3_login'] = false;
header("Location: login.php");
?>