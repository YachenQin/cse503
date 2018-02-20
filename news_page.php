<html lang="en">
<head>
    <link href="main_page.css" rel="stylesheet" type="text/css" media="screen">
    <title>News page</title>
</head>
<body class="background">


<?php
session_start();

if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    $userid=$_SESSION['userid'];
}
else{
    $username = -1;
    $userid=0;
}

require 'database.php';
$stmt = $mysqli->prepare(
    "SELECT title AS title, 
username.username AS author, 
story.storyid,
COUNT(likes.like) as numoflike, 
COUNT(dislikes.dislike) as numofdislike,
substring(content,1,200) AS subcontent, 
link 
FROM story JOIN username ON (username.userid = story.userid) 
LEFT JOIN likes ON (story.storyid = likes.storyid)
LEFT JOIN dislikes ON (story.storyid = dislikes.storyid)
GROUP BY (story.storyid)");
if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}

$stmt->execute();
$stmt->bind_result($title, $author, $storyid,$numoflike,$numofdislike,$subContent, $link);

while($stmt->fetch()) {
    //show all articles
    echo"
    <div class='title'>$title</div>
    <div class='author'>author:$author</div>
    <div class='context'>$subContent</div> 
    <span class='like'>like($numoflike)</span> 
    <span class='dislike'>dislike($numofdislike)</span> ";

    //you can see specific article with this
    echo"
				<div>
					<form action = 'viewstory.php' method = 'POST'>
						<input type = 'hidden' name = 'storyid' value = '$storyid'>
						<input class='viewfull' type = 'submit' value = 'View full story'>
					</form>
				</div>";

    //you can like or dislike an article
    echo"
                <span>
                    <form action = 'like.php' method = 'POST'>
						<input type = 'hidden' name = 'storyid' value = '$storyid'>
						<img src='like.png' style='width:20px;height:20px';>
						<input class='likebutton' type = 'submit' value = 'like'>
					</form>
				</span>
				<span>
					<form action = 'dislike.php' method = 'POST'>
						<input type = 'hidden' name = 'storyid' value = '$storyid'>
						<img src='dislike.png' style='width:20px;height:20px'>
						<input class='dislikebutton' type = 'submit' value= 'dislike'>
					</form>
				</span>";
}

//show on the page the user's information
if($username!=-1){
    echo"<div class='infomation'>now is $username login</div>";
}
else{
    echo"<div class='infomation'>You are guest</div>";
}
$stmt->close();

?>
<div class = "default">
    <a href = "poststory.php">I want to write an article</a>
    <br>
    <a href = "gotomyownzone.php">Go to my own zone</a>
    <br>
    <a href = "logout.php">Log out</a>

</div>
</body>
</html>
