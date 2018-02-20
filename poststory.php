

<?php
session_start();
require 'database.php';

if (!isset ($_SESSION['username'])) {
    echo "You have to login first"."<br><br>";
    echo "<a href='login_page.php'>Login</a>"."<br><br>";
    echo "<a href='news_page.php'>Back</>";
    exit;
}

$username = $_SESSION['username'];
$_SESSION['token'] = substr(md5(rand()), 0, 10);

//get user id
$stmt=$mysqli->prepare("SELECT userid FROM username WHERE username=?");
if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}
$stmt->bind_param('s', $username);
$stmt->execute();
$stmt->bind_result($userid);
$stmt->fetch();
$stmt->close();

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="main_page.css" media="screen">
    <title>share my story</title>
</head>

<body class="background">

<form action = 'postingstory.php' method = "POST">
    <label class="title" for = "title">Title:</label>
    <br>
    <textarea name = "title" id = "title" rows = "2" cols = "60"></textarea>
    <br>
    <label for "link">Link:</label>
    <br>
    <textarea name = "link" id = "link" rows = "3" cols = "60">http:</textarea>
    <br>
    <label class="context " for = "content">Content:</label>
    <br>
    <textarea name = "content" id = "content" rows = "9" cols = "80"></textarea>
    <br>
    <input type = "hidden" name = "token" value = "<?php echo $_SESSION['token'];?>">
    <input type = "hidden" name = "userid" value = "<?php echo $userid;?>"/>
    <input class="viewfull" type = "submit" value = "share">
</form>

<div class='default'>
    <a href = 'news_page.php'>Home</a>
    <a href = 'logout.php'>Logout</a>
</div>
</body>
</html>
