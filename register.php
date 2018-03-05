<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" type="image/ico" href="/images/favicon.ico"/>
    <title>Tetrium Login</title>
    <link rel="stylesheet" type="text/css" href="style/login-form.css"/>
</head>
<body>

<div id="wrapper">
    <div id="headerwrap">
        <div id="header"
        <p><img src="images/ottoco.png" alt="ottoco"></p>
    </div>
</div>
<div id="contentwrap">
    <div id="content">

        <p>
        <form name="form1" method="post" action="do_registration.php">
            <table width="300" border="0" align="center" cellpadding="2" cellspacing="0">
            <br>
                <tr>
                    <td width="125"><b>Registration Code</b></td>
                    <td width="120"><input name="code" type="text" id="code" style="width:120px;"></td>
                </tr>
                <tr>
                    <td><b>Email</b></td>
                    <td><input name="email" type="text" id="email" style="width:120px;"></td>
                </tr>
                <tr>
                    <td><b>Username</b></td>
                    <td><input name="username" type="text" id="username" style="width:120px;"></td>
                </tr>
                <tr>
                    <td><b>Password</b></td>
                    <td><input name="password" type="password" id="password" style="width:120px;"></td>
                </tr>
                <tr>
                    <td><b>Password again</b></td>
                    <td><input name="passwordagain" type="password" id="passwordagain" style="width:120px;"></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" name="Submit" value="Login"></td>
                </tr>
            </table>
        </form>
        </p>
    </div>
</div>
<div id="rightcolumnwrap">
    <?php include("includes/infocolumn.html"); ?>
</div>
<div id="footerwrap">
    <div id="footer">
        <a href="about.php">About</a>
    </div>
</div>
</div>
</body>
</html>
