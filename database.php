<?php
$mysqli = new mysqli('localhost', 'qinyachen', 'qinyachen', 'userinformation');

if($mysqli->connect_errno) {
    printf("Connection Failed: %s\n", $mysqli->connect_error);
    exit;
}
?>
