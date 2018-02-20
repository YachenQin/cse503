<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="viewstory.css" media="screen">
    <title>View Story</title>
</head>
<body class="background">


<?php
session_start();
require 'database.php';

$username = -1;
if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
}


$storyid = $_POST['storyid'];

//get information for specific story
$stmtstory = $mysqli->prepare(
    "SELECT title, content, story.userid, username.username AS author
		FROM story JOIN username on (username.userid = story.userid)
		WHERE storyid = ?");

if(!$stmtstory) {
    printf("Query Prep Failed: %s", $mysqli->error);
    exit;
}

$stmtstory -> bind_param('i', $storyid);
$stmtstory -> execute();
$stmtstory -> bind_result($title, $content, $userid, $author);
$stmtstory->fetch();


//show story on the screen
echo
    "
    <div class='title'>$title</div>
    <div class='author'>author:$author</div>
    <div class='context'>$content</div>  
<br>";

//if the user login is author, he/she can edit and delete the article
if($author == $username) {
    echo "<div>
<form action = 'editstory.php' method = 'POST'>
				  <input type = 'hidden' name = 'storyid' value = '$storyid'/>
				  <input class='edbutton' type = 'submit' value = 'Edit this article'/>
				  </form>
				  </div>";

    echo "
<div>
<form action = 'deletestory.php' method = 'POST'>
				  <input type = 'hidden' name = 'storyid' value = '$storyid'/>
				  <input class='deletebutton' type = 'submit' value = 'Delete this article'/>
				  </form>
				  </div>";
};

//post comment
echo"<h3>Comments</h3>
<br><br>
<div>
<form action = 'postcomment.php' method = 'POST'>
    <textarea rows = '5' cols = '70' name = 'comment'>
        Please enter comment here...
    </textarea>
    <br>
    <input type = 'hidden' name = 'storyid' value = '$storyid'>
    <input class='submitbutton' type = 'submit' value = 'Submit'>
</form>
</div>
    ";
$stmtstory -> close();

//show the comments about this article on screen
$stmtComment = $mysqli->prepare(
    "SELECT comment.id, comment, username.username
		 FROM comment JOIN username ON (username.userid = comment.userid)
		 WHERE storyid = ?");

if(!$stmtComment) {
    printf("Query Prep Failed: %s", $mysqli->error);
    exit;
}

$stmtComment -> bind_param('i', $storyid);
$stmtComment -> execute();
$stmtComment -> bind_result($cmtid, $comment, $commenter);


while($stmtComment -> fetch()) {
    echo"
    <div class='comment'>
    <div class='author'>$commenter : $comment</div>
    </div>";

    //if user login is the person who make comment, he/she can edit and delete that comment
    if($username == $commenter) {
        echo "
                <div>
                    <form action = 'editcomment' method = 'POST'>
					  <input type = 'hidden' name = 'cmtid' value = '$cmtid'>
					  <input type = 'hidden' name = 'storyid' value = '$storyid'>
					  <input class='edbutton' type = 'submit' value = 'Edit'>
					  </form>
				</div>";

        echo "
                <div>
                    <form action = 'deletecomment.php' method = 'POST'>
					  <input type = 'hidden' name = 'cmtid' value = '$cmtid'>
					  <input type = 'hidden' name = 'storyid' value = '$storyid'>
					  <input class='deletebutton' type = 'submit' value = 'Delete'>
				    </form>
			    </div>";
    }
    echo "<br>";
}
$stmtComment -> close();


echo "
<div class='default'>
<a href = 'news_page.php'>Home</a>
<a href = 'logout.php'>Logout</a>
</div>";
?>
</body>

