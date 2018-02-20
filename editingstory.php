<?php
session_start();
require 'database.php';


$title = $_POST['title'];
$content = $_POST['content'];
$link = $_POST['link'];
$storyid = $_POST['storyid'];


//update the content of your story
$stmt = $mysqli->prepare("UPDATE story SET title=?, content=?, link=?
		WHERE storyid = ?");
if(!$stmt){
    printf("Query Prep Failed: %s", $mysqli->error);
    exit;
}
$stmt->bind_param('sssi',$title,$content,$link,$storyid);
$stmt->execute();
$stmt->close();

echo "Edit successfully!<br>";
echo "<a href='logout.php'>Log out</a><br>";
echo "<a href='news_page.php'>Home</a><br>";
echo "<form action='viewstory.php' method='POST'>
	   		<input type='hidden' name='storyid' value='$storyid'>
	   		<input type='submit' value='View story'>
	 	  </form>";
?>
