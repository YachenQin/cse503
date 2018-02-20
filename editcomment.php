
<?php
session_start();
require 'database.php';

$cmtid = $_POST['cmtid'];


//get specific comment show on screen
$stmt = $mysqli->prepare("SELECT storyid, comment, userid FROM comment
			WHERE id = ?");
if(!$stmt) {
    printf("Query Prep Failed: %s", $mysqli->error);
    exit;
}
$stmt->bind_param('i',$cmtid);
$stmt->execute();
$stmt->bind_result($storyid, $comment, $userid);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html>
<head>
    <link href="main_page.css" rel="stylesheet" type="text/css" media="screen">
    <title> Edit your comment</title>
</head>

<body class="background"">
<form action = 'editingcomment.php' method = "POST">
    <label for = "comment">Comment:</label>
    <br>
    <textarea name = "comment" id = "comment" rows = "8" cols = "80"><?php echo $comment;?></textarea>
    <br>
    <input type = "hidden" name = "storyid" value = "<?php echo $storyid;?>"/>
    <input type = "hidden" name = "cmtid" value = "<?php echo $cmtid;?>"/>
    <input type = "submit" value = "submit">
</form>
</body>
</html>