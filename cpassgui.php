<?php
session_start();
if (empty($_SESSION["myusername"])) {
    header("location:main_login.php");
    exit;
} ?>
<html>
<head>
    <title>Change user password</title>
</head>
<body>

<center>
    <form name="cpass" action="executables/func_start.php" method="get">
        New password:<input type="password" name="pass"><br>
        <input name="user" type="hidden" value=<?php echo $_SESSION["myusername"]; ?>>
        <input type="submit" value="Submit">
    </form>
</center>

</body>
</html>