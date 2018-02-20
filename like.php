<!DOCTYPE html>
<html>
<head>
    <title>Like this story</title>
</head>

<body>
<?php
session_start();
$username = -1;
if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
}

//check if user is login
if ($username == -1) {
    echo "You can't do this before login"."<br><br>";
    echo "<a href='login_page.php'>Login</a>"."<br><br>";
    exit;
}
require 'database.php';
$storyid = $_POST['storyid'];


$stmt = $mysqli->prepare("SELECT userid FROM username WHERE username = ?");
if(!$stmt) {
    printf("Query Prep Failed: %s", $mysqli->error);
    exit;
}
$stmt->bind_param('i',$username);
$stmt->execute();
$stmt->bind_result($userid);
$stmt->fetch();
$stmt->close();
$stmt = $mysqli->prepare("SELECT userid FROM likes WHERE storyid = ?");
if(!$stmt) {
    printf("Query Prep Failed: %s", $mysqli->error);
    exit;
}
$stmt->bind_param('i',$storyid);
$stmt->execute();
$stmt->bind_result($id);

//check if user already like this article before
while($stmt->fetch()) {
    if($id == $userid) {
        echo "Sorry, you can't like it twice.<br>";
        echo "<a href = 'news_page.php'>homepage</a>";
        exit;
    }
}
$stmt->close();

//like this article
$stmt = $mysqli->prepare("INSERT INTO likes (storyid,userid) VALUES (?,?)");
if(!$stmt) {
    printf("Query Prep Failed: %s", $mysqli->error);
    exit;
}
$stmt->bind_param('ii',$storyid,$userid);
$stmt->execute();
$stmt->close();

echo "You like this story.<br>";
echo "<a href = 'news_page.php'>homepage</a><br>";
echo "<form action = 'viewstory.php' method = 'POST'>
						<input type = 'hidden' name = 'storyid' value = '$storyid'>
						<input type = 'submit' value = 'View full story'>
			</form>";
?>
</body>
</html>