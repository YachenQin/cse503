
<?php
session_start();
require 'database.php';

$storyid = $_POST['storyid'];

//show content of your story on screen
$stmt = $mysqli->prepare("SELECT title, content, link FROM story
			WHERE storyid = ?");
if(!$stmt) {
    printf("Query Prep Failed: %s", $mysqli->error);
    exit;
}
$stmt->bind_param('i',$storyid);
$stmt->execute();
$stmt->bind_result($title, $content, $link);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="main_page.css" media="screen">
    <title> Edit story</title>
</head>

<body class="background"">
<form action = 'editingstory.php' method = "POST">
    <label class="title"for = "title">Title:</label>
    <br>
    <textarea name = "title" id = "title" rows = "2" cols = "60"><?php echo $title;?></textarea>
    <br>
    <label for "link">Link:</label>
    <br>
    <textarea name = "link" id = "link" rows = "3" cols = "60"><?php echo $link;?></textarea>
    <br>
    <label class="context" for = "content">Content:</label>
    <br>
    <textarea name = "content" id = "content" rows = "8" cols = "80"><?php echo $content;?></textarea>
    <br>
    <input type = "hidden" name = "storyid" value = "<?php echo $storyid;?>"/>
    <input type = "submit" value = "submit">
</form>
</body>
</html>



