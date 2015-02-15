<html>
<head>
<link rel="stylesheet" href="style/tetriumstyle.css" type="text/css" media="screen, projection" />
	<title>Tetrium Stats</title>
</head>
<body>

<?php
include("includes/databasedetails.php");
include("executables/updateresources.php");
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
		
		<font size=6><?php echo "Stats"; ?></font><br><br>
		
			</div><!-- #content-->
<table>
<tr>
<td>Position</td>
<td>Name</td>
<td>Points</td>
</tr>
	
<tr>
<td>1</td>
<td>dennsva</td>
<td>801983098567129</td>
</tr>
	
<tr>
<td>2</td>
<td>prohaukka</td>
<td>-801983098567129</td>
</tr>
	
</table>
		
				<br><div id="uppgrades"><!-- #uppgrades -->
			<?
			include "includes/buildingtimer.php";
			if($admin=1){ 
			?> <br><a href="reset.php?speed=1">Speed Up</a><br>
			<a href="reset.php?resources=1">More resources</a>	
			<?}?>
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
	
	
	
	
