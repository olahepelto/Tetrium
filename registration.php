<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" type="image/ico" href="/images/favicon.ico"/>
	<title>Registration</title>
<link rel="stylesheet" type="text/css" href="style/login-form.css" />
</head>
<body>
    <div id="wrapper">
        <div id="headerwrap">
        <div id="header"    
            <p><img src="images/ottoco.png" alt="ottoco"> </p>
        </div>
        </div>
        <div id="contentwrap">
        <div id="content">
			
	<p><form name="form1" method="post" action="executables/register.php">
  <table width="300" border="0" align="center" cellpadding="2" cellspacing="0">
    <tr>
      <td width="112"><b>Username</b></td>
      <td width="188"><input name="myusername" type="text" id="myusername"></td>
    </tr>
    <tr>
      <td><b>Password</b></td>
      <td><input name="mypassword" type="password" id="mypassword"></td>
    </tr>
    <tr>
      <td><b>Email</b></td>
      <td><input name="myemail" type="text" id="myemail"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="Login"></td>
    </tr>
  </table>
</form></p>
        </div>
            <?php if (isset($_GET["msg"])){ ?>
	<div id="content2">
            <?php echo $_GET["msg"]; ?>
	</div>
            <?php }?>
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
