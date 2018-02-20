<?php
session_start();
require 'database.php';

$cmtid= $_POST['cmtid'];
$storyid=$_POST['storyid'];

// delete comment
$stmt = $mysqli->prepare("DELETE FROM comment WHERE id = ?");
if(!$stmt) {
    printf("Query Prep Failed: %s", $mysqli->error);
    exit;
}
$stmt->bind_param('i',$cmtid);
$stmt->execute();
$stmt->close();


echo "You comment has been delete<br>";
echo "<a href='logout.php'>Log out</a><br>";
echo "<a href='news_page.php'>homepage</a><br>";
echo "<form action='viewstory.php' method='POST'>
	   		<input type='hidden' name='storyid' value='$storyid'>
	   		<input type='submit' value='View story'>
	 	  </form>";

?>