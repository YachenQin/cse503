<?php

session_start();
require 'database.php';

if (!isset ($_SESSION['username'])) {
    echo "You have to login first"."<br><br>";
    echo "<a href='login_page.php'>Login</a>"."<br>";
    echo "<a href='news_page.php'>Home</>";
    exit;
}

$userid = $_SESSION['userid'];
$storyid = $_POST['storyid'];
$comment = $_POST['comment'];

//add new comment
$stmt = $mysqli->prepare("INSERT INTO comment (userid, comment, storyid) values (?,?,?)");
if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}

$stmt->bind_param('isi', $userid, $comment, $storyid);
$stmt->execute();
$stmt->close();

echo "<strong>You post a comment successfully!</strong>"."<br><br>";
echo "<a href = 'logout.php'>Log out</a>" . "<br>";
echo "
    <div>
          <form action='viewstory.php' method='POST'>
	   		<input type='hidden' name='storyid' value='$storyid'>
	   		<input type='submit' value='Back'>
	 	  </form>
    </div>";
?>

