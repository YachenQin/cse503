<?php

require 'database.php';
session_start();

//login
$stmt = $mysqli->prepare("SELECT COUNT(*), userid, password FROM username WHERE username=?");


$stmt->bind_param('s', $username);
$username = $_POST['username'];
$stmt->execute();

$stmt->bind_result($cnt, $userid, $pwd_hash);
$stmt->fetch();

$pwd_guess = $_POST['password'];


if($cnt == 1 && password_verify($pwd_guess, $pwd_hash)){
    $_SESSION['username'] = $username;
    $_SESSION['userid'] = $userid;
    header('Location: news_page.php');
}
else{
    echo "Not a valid login. Please try again<br>";
    echo  "<a href='login_page.php'>Login again</a>";
}

?>