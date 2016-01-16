<!DOCTYPE html>
<script>
    if (/MSIE (\d+\.\d+);/.test(navigator.userAgent)) {
        window.alert("NOPE !")
        window.location.replace("https://www.google.com/intl/en/chrome/browser/");
    }
    else
</script>

<html>
<head>
    <title>Request for beta access</title>
    <link rel="stylesheet" type="text/css" href="../style/login-form.css"/>
</head>
<body>
<div id="wrapper">
    <div id="headerwrap">
        <div id="header"
        <p><img src="../images/ottoco.png" alt="ottoco"></p>
    </div>
</div>
<div id="contentwrap">
    <div id="content">


        <form name="form1" method="post" action="../executables/mail.php">
            Email:
            <input name="email" type="text" id="email"><br>
            Username:
            <input name="username" type="text" id="username"><br>
            Password:
            <input name="password" type="password" id="password"><font size="2">(Will be md5 encrypted. So don't worry,
                I won't be able to see your password)</font><br>
            <?php
            require_once('../executables/recaptchalib.php');
            $publickey = "6LcveOgSAAAAAIvcBmqzoHcMZkBnA9Jtmko_bCQU"; // you got this from the signup page
            echo recaptcha_get_html($publickey);
            ?>

            <input type="submit" value=Submit name="Submit">
        </form>


    </div>
    <div id="content2">
        <?php
        if ($_GET["error"] == "true") {
            echo "Wrong captcha";
        } ?><br>
        <font size="3">Back to login <a href="main_login.php">Here</a></font>
    </div>

</div>
<div id="rightcolumnwrap">
    <?php include("infocolumn.html"); ?>
</div>
<div id="footerwrap">
    <div id="footer">
        <p>All rights reserved OttoCo</p>
    </div>
</div>
</div>
</body>
</html>