<?php
include "includes/databasedetails.php";
if($_SESSION['varadmin']==0){
	header("location:tetrium.php");
exit;
}
?>





<html>
<head>
<link rel="stylesheet" href="style/tetriumstyle.css" type="text/css" media="screen, projection" />
	<title>Admin panel</title>
</head>
	<body onfocus="onfocus()" onblur="onblur()">
<?php
//include database login and update resources
include "includes/databasedetails.php";
include "executables/updateresources.php";
?>
	
<!-- CSS GUI BEGINS -->
<center>
<div id="wrapper">
	
	<!-- HEADER -->
	<?php include("includes/tetriumheader.php") ?>
	<!-- HEADER -->
	
	<div id="middle">
	<div id="container">
	<div id="content" style="padding:0 35%;">	
	
		
		
		
		
		<center>
        <br><br><br><br><br>
			
			<font size=1><?php

//from members

$data = mysql_query("SELECT * FROM members");
$data2 = mysql_query("SELECT * FROM map");

Print "<table align=left border cellpadding=1>";
Print "<th>Id:</th><th>Username</th><th>Admin</th><th>Wood</th><th>Clay</th><th>Iron</th><th>Wheat</th><th>Edit</th><th>Login</th></tr>"; 
while($info = mysql_fetch_array($data) && $info2 = mysql_fetch_array($data2)) {	
	
	$info2['wood']=round($info2['wood']);
	$info2['clay']=round($info2['clay']);
	$info2['iron']=round($info2['iron']);
	$info2['wheat']=round($info2['wheat']);
	
	Print "<tr>"; 
	Print "<td>".$info['id'] . "</td><td>".$info['username'] . "</td><td>".$info['admin'] . "</td><td>".$info['wood'] . "</td></td><td>".$info['clay'] . "</td><td>".$info['iron'] . "</td><td>".$info['wheat'] . "</td><td><input type='radio' name='edit' form='admin' value=".$info['id'] . "></td><td><a href='executables/adminaction.php?login=".$info['id']."'>login</a></td></tr>";
}
Print "</table>";
?>

			</font>

<form action="executables/adminaction.php" id="admin" method="get">			
Wood: <input type="text" name="wood"><br>
Clay: <input type="text" name="clay"><br>
Iron: <input type="text" name="iron"><br>
Wheat: <input type="text" name="wheat"><br>
<input type="submit" value="Submit">
</form>
		
		
		
		
		</div><!-- #content-->
				<br><div id="uppgrades"><!-- #uppgrades -->
			<?php
			include "includes/buildingtimer.php";
			if($admin=1){ 
			?> <br><a href="reset.php?speed=1">Speed Up</a><br>
			<a href="reset.php?resources=1">More resources</a>	
			<?php }?>
		</div><!-- #uppgrades -->
		</div><!-- #container-->
		
	<!-- SIDEBARS AND FOOTER -->	
		<?php include("includes/tetriumsidebarsandfooter.php"); ?>
	<!-- SIDEBARS AND FOOTER -->
		
</div><!-- #wrapper -->
</center>
	
	<?php include("includes/tetriumjavascript.php"); ?>

	</body>
	</html>