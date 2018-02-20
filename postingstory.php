<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="login.css" media="screen">
    <title>Upload a new story</title>
</head>
<body style="background-image: url(loginbg.jpg);">
</body>
<html>

<?php
session_start();
require 'database.php';

if($_SESSION['token'] != $_POST['token']){
    die("Request forgery detected");
}

$userid = $_POST['userid'];
$title = $_POST['title'];
$link = $_POST['link'];
$content = $_POST['content'];

//store into sql new story
$stmt = $mysqli->prepare("INSERT INTO story (userid, title, content,link) values (?,?,?,?)");
if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}

$stmt->bind_param('isss', $userid, $title, $content,$link);
$stmt->execute();
$stmt->close();

echo "<strong>You have already upload a new story</strong>s<br>";
echo "<a href = 'logout.php'>Log out</a><br>";
echo "<a href = 'news_page.php'>Home</a>";
?>