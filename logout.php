<?php
session_start();
session_destroy();
unset($_SESSION);
//logout delete all data
header("Location: login_page.php");
?>