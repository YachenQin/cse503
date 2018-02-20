<?php
session_start();
require 'database.php';


$comment= $_POST['comment'];
$cmtid= $_POST['cmtid'];
$storyid = $_POST['storyid'];

//update your comment
$stmt = $mysqli->prepare("UPDATE comment SET comment=?
		WHERE id = ?");
if(!$stmt){
    printf("Query Prep Failed: %s", $mysqli->error);
    exit;
}
$stmt->bind_param('si',$comment,$cmtid);
$stmt->execute();
$stmt->close();

echo "Update successfully!<br>";
echo "<a href='logout.php'>Log out</a><br>";
echo "<a href='news_page.php'>Home</a><br>";
echo "<form action='viewstory.php' method='POST'>
	   		<input type='hidden' name='storyid' value='$storyid'>
	   		<input type='submit' value='View story'>
	 	  </form>";
?>