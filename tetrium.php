<html> 
<head>
	<title>Tetrium</title>
<link rel="stylesheet" href="style/tetriumstyle.css" type="text/css" media="screen, projection" />
	</head>
	<body>
	<!--onfocus="onfocus()" onblur="onblur()"-->
<?php
//include database login and update resources
include "includes/databasedetails.php";

include "executables/start_logic.php";
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
	<br><br>
	
		
		<font size=6><?php echo $mysql_data["villagenamei"], " (", $mysql_data["villagexi"], "|", $mysql_data["villageyi"], ")"; ?></font><br><br>
		
		<div id=resourcefields>
			<img src="images/bettervillage.png" alt="Error">
				<div id="uppgrades"><!-- #uppgrades -->
<?php
					include "includes/buildingtimer.php";
if($admin=1){ 
			?> <br><a href="reset.php?speed=1">Speed Up</a><br>
			<a href="reset.php?resources=1">More resources</a> <?php 
			}
					?>
					
		</div><!-- #uppgrades -->
		<?php if (isset($_GET["message"])){ ?>
	<script type="text/javascript">
    alert("<?php echo $_GET["message"]; ?>");
	window.location = "tetrium.php";
    </script>
		<?php }

$building_list=array("woodcutter1","woodcutter2","woodcutter3","woodcutter4","claypit1","claypit2","claypit3","claypit4","ironmine1","ironmine2","ironmine3","ironmine4","cropland1","cropland2","cropland3","cropland4","cropland5","cropland6","storage","mainbuilding","barracks","marketplace","stable","wall");
$positive = array();

foreach ($building_list as $building){
$tetrium_boll_query = mysql_query("SELECT * FROM events WHERE userid='$id' AND type='building' AND building='$building' AND village_id='$current_village_id'");	
$tetrium_boll_query_rows = mysql_num_rows($tetrium_boll_query);

if(!$tetrium_boll_query_rows==0){
array_push($positive,$building);
}
}
	



?>			
				<!-- Print out building levels -->
	<a href="upgradegui.php?building=woodcutter1"><div id=woodcutter1level2><img src="<?php if (in_array('woodcutter1',$positive)) {echo "images/boll_gul.png";}else{echo "images/boll.png";}?>" alt="Error"></div><div id=woodcutter1level><?php echo $woodcutter1; ?></div></a>
	<a href="upgradegui.php?building=woodcutter2"><div id=woodcutter2level2><img src="<?php if (in_array('woodcutter2',$positive)) {echo "images/boll_gul.png";}else{echo "images/boll.png";}?>" alt="Error"></div><div id=woodcutter2level><?php echo $woodcutter2; ?></div></a>
	<a href="upgradegui.php?building=woodcutter3"><div id=woodcutter3level2><img src="<?php if (in_array('woodcutter3',$positive)) {echo "images/boll_gul.png";}else{echo "images/boll.png";}?>" alt="Error"></div><div id=woodcutter3level><?php echo $woodcutter3; ?></div></a>
	<a href="upgradegui.php?building=woodcutter4"><div id=woodcutter4level2><img src="<?php if (in_array('woodcutter4',$positive)) {echo "images/boll_gul.png";}else{echo "images/boll.png";}?>" alt="Error"></div><div id=woodcutter4level><?php echo $woodcutter4; ?></div></a>
	
	<a href="upgradegui.php?building=claypit1"><div id=claypit1level2><img src="<?php if (in_array('claypit1',$positive)) {echo "images/boll_gul.png";}else{echo "images/boll.png";}?>" alt="Error"></div><div id=claypit1level><?php echo $claypit1; ?></div></a>
	<a href="upgradegui.php?building=claypit2"><div id=claypit2level2><img src="<?php if (in_array('claypit2',$positive)) {echo "images/boll_gul.png";}else{echo "images/boll.png";}?>" alt="Error"></div><div id=claypit2level><?php echo $claypit2; ?></div></a>
	<a href="upgradegui.php?building=claypit3"><div id=claypit3level2><img src="<?php if (in_array('claypit3',$positive)) {echo "images/boll_gul.png";}else{echo "images/boll.png";}?>" alt="Error"></div><div id=claypit3level><?php echo $claypit3; ?></div></a>
	<a href="upgradegui.php?building=claypit4"><div id=claypit4level2><img src="<?php if (in_array('claypit4',$positive)) {echo "images/boll_gul.png";}else{echo "images/boll.png";}?>" alt="Error"></div><div id=claypit4level><?php echo $claypit4; ?></div></a>
	
	<a href="upgradegui.php?building=ironmine1"><div id=ironmine1level2><img src="<?php if (in_array('ironmine1',$positive)) {echo "images/boll_gul.png";}else{echo "images/boll.png";}?>" alt="Error"></div><div id=ironmine1level><?php echo $ironmine1; ?></div></a>
	<a href="upgradegui.php?building=ironmine2"><div id=ironmine2level2><img src="<?php if (in_array('ironmine2',$positive)) {echo "images/boll_gul.png";}else{echo "images/boll.png";}?>" alt="Error"></div><div id=ironmine2level><?php echo $ironmine2; ?></div></a>
	<a href="upgradegui.php?building=ironmine3"><div id=ironmine3level2><img src="<?php if (in_array('ironmine3',$positive)) {echo "images/boll_gul.png";}else{echo "images/boll.png";}?>" alt="Error"></div><div id=ironmine3level><?php echo $ironmine3; ?></div></a>
	<a href="upgradegui.php?building=ironmine4"><div id=ironmine4level2><img src="<?php if (in_array('ironmine4',$positive)) {echo "images/boll_gul.png";}else{echo "images/boll.png";}?>" alt="Error"></div><div id=ironmine4level><?php echo $ironmine4; ?></div></a>
	
	<a href="upgradegui.php?building=cropland1"><div id=cropland1level2><img src="<?php if (in_array('cropland1',$positive)) {echo "images/boll_gul.png";}else{echo "images/boll.png";}?>" alt="Error"></div><div id=cropland1level><?php echo $cropland1; ?></div></a>
	<a href="upgradegui.php?building=cropland2"><div id=cropland2level2><img src="<?php if (in_array('cropland2',$positive)) {echo "images/boll_gul.png";}else{echo "images/boll.png";}?>" alt="Error"></div><div id=cropland2level><?php echo $cropland2; ?></div></a>
	<a href="upgradegui.php?building=cropland3"><div id=cropland3level2><img src="<?php if (in_array('cropland3',$positive)) {echo "images/boll_gul.png";}else{echo "images/boll.png";}?>" alt="Error"></div><div id=cropland3level><?php echo $cropland3; ?></div></a>
	<a href="upgradegui.php?building=cropland4"><div id=cropland4level2><img src="<?php if (in_array('cropland4',$positive)) {echo "images/boll_gul.png";}else{echo "images/boll.png";}?>" alt="Error"></div><div id=cropland4level><?php echo $cropland4; ?></div></a>
	<a href="upgradegui.php?building=cropland5"><div id=cropland5level2><img src="<?php if (in_array('cropland5',$positive)) {echo "images/boll_gul.png";}else{echo "images/boll.png";}?>" alt="Error"></div><div id=cropland5level><?php echo $cropland5; ?></div></a>
	<a href="upgradegui.php?building=cropland6"><div id=cropland6level2><img src="<?php if (in_array('cropland6',$positive)) {echo "images/boll_gul.png";}else{echo "images/boll.png";}?>" alt="Error"></div><div id=cropland6level><?php echo $cropland6; ?></div></a>

		</div><!-- #resourcefields -->
		</div><!-- #content-->
		</div><!-- #container-->
		
	<!-- SIDEBARS AND FOOTER -->	
		<?php include("includes/tetriumsidebarsandfooter.php"); ?>
	<!-- SIDEBARS AND FOOTER -->
		
</div><!-- #wrapper -->
		</center>
	
	<?php if (isset($_GET["newvillagename"])and !$_GET["newvillagename"]==""){
	$newvillagename=$_GET["newvillagename"];
	mysql_query("UPDATE map SET village='$newvillagename' WHERE village_id='$current_village_id'");
	$url=$_SERVER['REQUEST_URI'];
	$url = strtok($url, '?');
	header("Location: ".$url);
	}

	include("includes/tetriumjavascript.php");
	?>
	</body>
	</html>
