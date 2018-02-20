<?php
session_start();
session_destroy();
unset($_SESSION);
//login as a guest
header("Location: news_page.php");
?>