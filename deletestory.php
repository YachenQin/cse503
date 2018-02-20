<?php
session_start();
require 'database.php';

$storyid = $_POST['storyid'];

//delete story with specific story id
$stmt = $mysqli->prepare("DELETE FROM story WHERE storyid = ?");
if(!$stmt) {
    printf("Query Prep Failed: %s", $mysqli->error);
    exit;
}
$stmt->bind_param('i',$storyid);
$stmt->execute();
$stmt->close();


$stmt = $mysqli->prepare("DELETE FROM comment WHERE storyid = ?");
if(!$stmt) {
    printf("Query Prep Failed: %s", $mysqli->error);
    exit;
}
$stmt->bind_param('i',$storyid);
$stmt->execute();
$stmt->close();

echo "You article has been already delete<br>";
echo "<a href='logout.php'>Log out</a><br>";
echo "<a href='news_page.php'>Home</a>";
?>
