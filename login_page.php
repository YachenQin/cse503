<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="login.css" media="screen">
    <title>login page</title>
</head>
<body class="background">
<div class="logfont">WELCOME</div>
<div class="login">
    <form action="login.php" method="POST">
        <label class="logfont">Username: </label>
        <input class="inputdesign" type="text" name="username" id="username"/>
        <br/>
        <label class="logfont">Password: </label>
        <input class="inputdesign" type="password" name="password" id="password"/>
        <br/>
        <input class="inputdesign" type="submit" value="login" name="submit"/>
    </form>
</div>
<div class="guest">
    <a href="newuser.php">Register</a>
    <a href="guest.php">Guest</a>
</div>
</body>
</html>