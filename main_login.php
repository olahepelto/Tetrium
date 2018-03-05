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
        <form name="form1" method="post" action="executables/checklogin.php">
            <table width="300" border="0" align="center" cellpadding="2" cellspacing="0">
            <br>
                <tr>
                    <td width="112"><b>Login</b></td>
                    <td width="188"><input name="myusername" type="text" id="myusername"></td>
                </tr>
                <tr>
                    <td><b>Password</b></td>
                    <td><input name="mypassword" type="password" id="mypassword"></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" name="Submit" value="Login"></td>
                </tr>
            </table>
        </form>
      <center><a href="register.php">Registration</a></center>
        </p>
    </div>
    <div id="content2"><br>
        <b><a href=""><font size=3>Other Projects</font></a></b><br>
        <?php if (!isset ($_GET["msg"]) or $_GET["msg"] == ""){ ?>
        <!--<font size="3">Looking for beta testers!<br><a href="registration.php">Registration</a><br></font>-->
        Tetrium is a mmo village warfare browser game i started making somewhere around 2011 to learn web development. 
        The last official version was released in 2015.<br>
        <?php } else {
            echo $_GET["msg"];
            $_GET["msg"] = "";
        } ?></font>
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
