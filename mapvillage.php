<?php
include "includes/databasedetails.php";
$map=true;
$x=$_GET["x"];
$y=$_GET["y"];
//show village

$result = mysql_query("SELECT * FROM map WHERE x='$x' and y='$y'");

//fetch everything from the first query
while ($row = mysql_fetch_assoc($result)){
$villagename = $row["village"];
$villagex = $row["x"];
$villagey = $row["y"];
$village_id = $row["village_id"];
$id2 = $row["id"];
}

//check if own village then redirect to tetrium.php
if ($id2==$id){
$_SESSION["current_village_id"]=$village_id;
header("location: tetrium.php");
exit;	
}
?>

<html>
<head>
	<title><?php echo $villagename; ?></title>
<link rel="stylesheet" href="style/tetriumstyle.css" type="text/css" media="screen, projection" />
</head>
	<body onfocus="onfocus()" onblur="onblur()">
<?
//include database login and update resources
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
	<div id="content">	
	<br><br><br>
		<font size=6><?php echo $villagename, " (", $villagex, "|", $villagey, ")"; ?></font><br><br>
		
	
		
		<div id=resourcefields>
			<img src="images/bettervillage.png" alt="Error">
						<br><div id="uppgrades"><!-- #uppgrades -->
			<?php
			include "includes/buildingtimer.php";
			if($admin=1){ 
			?> <br><a href="reset.php?speed=1">Speed Up</a><br>
			<a href="reset.php?resources=1">More resources</a>	
			<?}?>
		</div><!-- #uppgrades -->
		<?php if (isset($_GET["message"])){ ?>
	<script type="text/javascript">
    alert("<?php echo $_GET["message"]; ?>");
	window.location = "../tetrium.php";
    </script>
		<?php } ?>
		<!-- Print out building levels -->
	<a><div id=woodcutter1level2><img src="images/boll.png" alt="Error"></div></a>
	<a><div id=woodcutter2level2><img src="images/boll.png" alt="Error"></div></a>
	<a><div id=woodcutter3level2><img src="images/boll.png" alt="Error"></div></a>
	<a><div id=woodcutter4level2><img src="images/boll.png" alt="Error"></div></a>
	
	<a><div id=claypit1level2><img src="images/boll.png" alt="Error"></div></a>
	<a><div id=claypit2level2><img src="images/boll.png" alt="Error"></div></a>
	<a><div id=claypit3level2><img src="images/boll.png" alt="Error"></div></a>
	<a><div id=claypit4level2><img src="images/boll.png" alt="Error"></div></a>
	
	<a><div id=ironmine1level2><img src="images/boll.png" alt="Error"></div></a>
	<a><div id=ironmine2level2><img src="images/boll.png" alt="Error"></div></a>
	<a><div id=ironmine3level2><img src="images/boll.png" alt="Error"></div></a>
	<a><div id=ironmine4level2><img src="images/boll.png" alt="Error"></div></a>
	
	<a><div id=cropland1level2><img src="images/boll.png" alt="Error"></div></a>
	<a><div id=cropland2level2><img src="images/boll.png" alt="Error"></div></a>
	<a><div id=cropland3level2><img src="images/boll.png" alt="Error"></div></a>
	<a><div id=cropland4level2><img src="images/boll.png" alt="Error"></div></a>
	<a><div id=cropland5level2><img src="images/boll.png" alt="Error"></div></a>
	<a><div id=cropland6level2><img src="images/boll.png" alt="Error"></div></a>
			
		</div><!-- #resourcefields -->
		</div><!-- #content-->
		</div><!-- #container-->
		
	<!-- SIDEBARS AND FOOTER -->	
		<?php include("includes/tetriumsidebarsandfooter.php"); ?>
	<!-- SIDEBARS AND FOOTER -->
		
</div><!-- #wrapper -->
		</center>
	
	<?php include("includes/tetriumjavascript.php"); ?>

	</body>
	</html>