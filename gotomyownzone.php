<!DOCTYPE html>
<html>
<head>
    <link href="main_page.css" rel="stylesheet" type="text/css" media="screen">
    <title>My zone</title>
</head>
<body class="background">
<?php
session_start();
require 'database.php';

if (!isset ($_SESSION['username'])) {
    echo "Please login first"."<br><br>";
    echo "<a href='login_page.php'>Login</a>"."<br><br>";
    echo "<a href='news_page.php'>Back</>";
    exit;
}

$userid =$_SESSION['userid'];


//show all articles from one user who is login
$stmt = $mysqli->prepare("SELECT storyid, title, link, substring(content,1,300)
		 FROM story WHERE userid = ?");
if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}
$stmt->bind_param('i',$userid);
$stmt->execute();
$stmt->bind_result($storyid, $title, $link, $subContent);
while($stmt->fetch()){
    echo"
    <div class='title'>$title</div>
    <div class='context'>$subContent</div> 
	<div>
		<form action = 'viewstory.php' method = 'POST'>
		    <input type = 'hidden' name = 'storyid' value = '$storyid'>
			<input class='viewfull' type = 'submit' value = 'View full story'>
		</form>
	</div>";
}

?>
<div class = 'default'>
    <a href = 'poststory.php'>I want to write an article</a>
    <br>
    <a href = 'news_page.php'>Home</a>
    <br>
    <a href = 'logout.php'>Log out</a>
</div>
</body>
</html>
