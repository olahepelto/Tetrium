<html>
<head>
<link rel="stylesheet" href="style/tetriumstyle.css" type="text/css" media="screen, projection" />
	<title>Tetrium Attack</title>
</head>
	<body onfocus="onfocus()" onblur="onblur()">
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
	
		
		
		

<div id="mapbox">
	<br><br><br>
		
	<?php
	/*-----------------------------------------
	This is the Attack function
	-----------------------------------------*/	
	?>
	<form name=mail action=executables/func_start.php id=sendres method=GET>
			Village_name: <input type=text id=village name=village><br>
			X: <input type=text id=x name=x size=2 value=<?php echo $_GET["x"]; ?>> Y: <input type=text id=y name=y size=2 value=<?php echo $_GET["y"]; ?>><br>
			Clubswinger: <input type=text id=clubswinger name=clubswinger><br>
			Spearman: <input type=text id=spearman name=spearman><br>
			Axeman: <input type=text id=axeman name=axeman><br>
					<input type="hidden" name="type" value="attack">
				<input type=submit value=Send>
	</form>
	<?
	/*-----------------------------------------
	This is the EPIC Attack function XD
	-----------------------------------------*/
	?>
		
		</div><!-- #mapbox-->
		
		
		
		<br><div id="uppgrades"><!-- #uppgrades -->
			<?
			include "includes/buildingtimer.php";
			if($admin=1){?> <a href="reset.php?resources=1">More resources</a><?}?>
		</div><!-- #uppgrades -->
		
		
		</div><!-- #content-->
		</div><!-- #container-->
		
	<!-- SIDEBARS AND FOOTER -->
		
		<?
include("includes/tetriumsidebarsandfooter.php");
		?>
	<!-- SIDEBARS AND FOOTER -->
		
</div><!-- #wrapper -->
</center>
	
	<?php include("includes/tetriumjavascript.php"); ?>

	</body>
	</html>
	
	
	<script>
	var message = "<?php echo $_GET["message"];?>";
	if (message.length>0){
	alert(message);
	}
</script>
	