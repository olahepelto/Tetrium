<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:2px 8px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:2px 8px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-rujl{font-weight:bold;font-size:14px;background-color:#9b9b9b;color:#333333}
</style>

<?
include "includes/databasedetails.php";
?>

<html>
<head>
<link rel="stylesheet" href="style/tetriumstyle.css" type="text/css" media="screen, projection" />
	<title>Tetrium Map</title>
	<link rel="shortcut icon" type="image/ico" href="http://www.tetrium.tk/tetrium/images/favicon.ico"/>
</head>
	<body onfocus="onfocus()" onblur="onblur()">
<?
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
	<div id="content">	
	
		
		
		

<div id="mapbox">
	<br><br><br>
		
<?
	/*-----------------------------------------
	REPORTS FUNCTION
	-----------------------------------------*/	
	
	$data = mysql_query("SELECT * FROM reports WHERE player_id='$id'") or die(mysql_error());
?><table class="tg">
	<tr>
<th class="tg-rujl" style="width:300px;">Topic:</th>
<th class="tg-rujl" style="width:100px;">Date:</th>
<th class="tg-rujl" style="width:10px;">Del:</th>
	</tr>

	<tr>
		<?
while($info = mysql_fetch_array($data)){	
	echo "<tr>";
	if($info['is_read']==0){
	$rep_status="(new)";
	}else{
	$rep_status="";
	}
	$del_rep_url="executables/del_report.php?rep_id=".$info['report_id'];
	echo "<td>","<a style='color: #333; text-decoration: none;' href=viewreport.php?rep_id=",$info['report_id'],">",$info['topic'],$rep_status,"</a></td><td>",$info['time'],"</td><td><a href=",$del_rep_url,">","X","</a></td></tr>"; 
}
?></table>
		<?
	/*-----------------------------------------
	REPORTS FUNCTION ==END==
	-----------------------------------------*/	
?>
		</div><!-- #mapbox-->

		<br><div id="uppgrades"><!-- #uppgrades -->
			<?
			include "includes/buildingtimer.php";
			if($admin=1){ 
			?> <br><a href="reset.php?speed=1">Speed Up</a><br>
			<a href="reset.php?resources=1">More resources</a>	
			<?}?>
		</div><!-- #uppgrades -->
		
		
		</div><!-- #content-->
		</div><!-- #container-->
		
	<!-- SIDEBARS AND FOOTER -->
		
		<?php $map2=true;
			include("includes/tetriumsidebarsandfooter.php");
		?>
	<!-- SIDEBARS AND FOOTER -->
		
</div><!-- #wrapper -->
</center>
	
	<?php include("includes/tetriumjavascript.php"); ?>

	</body>
	</html>