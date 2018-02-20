<?php
require 'database.php';
$username=$_GET['username'];
$password=$_GET['password'];
$stmt = $mysqli->prepare("SELECT COUNT(*) FROM username WHERE username=?");

if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}

$stmt->bind_param('s',$username);
$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();

//check if the username has been used
if ($count == 1) {
    echo "This username has been registered. Please try another one.";
    echo "<a href='createnewuser.php'>Try a new one!</a>";
    exit;
}
$stmt->close();

$user_name=strlen($username);
$pass_word=strlen($password);

//the username length should be larger than 0 and smaller than 20.
if ($user_name ==0 || pass_word > 20) {
    echo "The length of the username should be 0 ~ 20 charactor long.";
    echo "<a href='newuser.php'>Try a new one</a>";
    exit;
}
//the password length should be larger than 0 and smaller than 20.
if ($pass_word <6 || pass_word > 20) {
    echo "The length of the password should be 6 ~ 20 charactor long.";
    echo "<a href='newuser.php'>Try a new one</a>";
    exit;
}
else {

    //store password into sql as hashpassword
    $hashpass = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $mysqli->prepare("insert into username (username, password) values (?, ?)");
    if (!$stmt) {
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }

    $stmt->bind_param('ss', $username, $hashpass);
    $stmt->execute();
    $stmt->close();


    header('Location: login_page.php');
}
?>
