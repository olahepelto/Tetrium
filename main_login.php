<!DOCTYPE html>
<script>
    if (/MSIE (\d+\.\d+);/.test(navigator.userAgent)) {
        window.alert("No ie allowed !")
        window.location.replace("https://www.google.com/intl/en/chrome/browser/");
    }
    else
</script>
<html>
<head>
    <link rel="shortcut icon" type="image/ico" href="/images/favicon.ico"/>
    <title>Tetrium Login</title>
    <link rel="stylesheet" type="text/css" href="style/login-form.css"/>
</head>
<body>


<?php include("includes/analytics.php"); ?>

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
                <tr>
                    <center><b><a style="color: indigo;"
                                  href="https://bitbucket.org/tetrium/tetrium/issues?status=new&status=open">Issue &
                                Feature tracker</a></b></center>
                </tr>
            </table>
        </form>
        </p>
    </div>
    <div id="content2">
        <?php if (!isset ($_GET["msg"]) or $_GET["msg"] == ""){ ?>
        <font size="3">Looking for beta testers!<br><a href="registration.php">Registration</a><br></font>
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
