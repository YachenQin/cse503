<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="login.css" media="screen">
    <title>Register</title>
</head>
<body class="background">
<div class="login">
    <form action="createnewuser.php" method="GET">
        <label class="logfont">Create a username: </label>
        <input class="inputdesign" type="text" name="username" id="username"/>
        <br/>
        <label class="note">The length of the username should be 0 ~ 20 charactor long.</label><br />

        <label class="logfont">Create a password: </label>
        <input class="inputdesign" type="password" name="password" id="password"/>
        <br/>
        <label class="note">The length of the password should be 6 ~ 40 charactor long.</label><br />

        <input class="inputdesign" type="submit" value="register" name="register"/>
    </form>
</body>
</html>