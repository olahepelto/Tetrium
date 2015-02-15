<html>
<head>
<link rel="stylesheet" href="style/tetriumstyle.css" type="text/css" media="screen, projection" />
	<title>Tetrium Map</title>
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
	<div id="content">	

<div id="mapbox">
	<br><br><br>
		
<?php
	/*-----------------------------------------
	REPORTS FUNCTION
	-----------------------------------------*/	
	$report_id=$_GET["rep_id"];
	$data = mysql_query("SELECT * FROM reports WHERE report_id='$report_id'");

while($info = mysql_fetch_array($data)){
if ($info['player_id']!=$id){
	echo "you don't have permission to view this report :P";
	$perm=0;
}elseif($info['player_id']==$id){
	$perm=1;
}
//THE REPORT PART
if($perm=1){
mysql_query("UPDATE reports SET is_read=1 WHERE report_id='$report_id'") or die(mysql_error());
?>
<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:2px 8px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:2px 8px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-6eq8{color:#333333}
.tg .tg-rujl{font-weight:bold;font-size:14px;background-color:#9b9b9b;color:#333333}
.tg .tg-gn9g{font-size:14px;color:#333333}
.tg .tg-9sz5{font-weight:bold;background-color:#9b9b9b;color:#333333}
.tg .tg-ygl1{font-weight:bold;background-color:#9b9b9b}
</style>
	
	<?php if ($info['type']=="attack"){?>
<table class="tg">
  <tr>
    <th class="tg-rujl">Topic</th>
    <th class="tg-gn9g"><?php echo $info['topic']; ?></th>
  </tr>
  <tr>
    <td class="tg-9sz5">Date</td>
    <td class="tg-6eq8"><?php echo $info['time']; ?></td>
  </tr>
  <tr>
    <td class="tg-9sz5">Winner</td>
    <td class="tg-6eq8"><?php echo $info['winner']; ?></td>
  </tr>
</table>
<br><br>
<table class="tg">
  <tr>
    <th class="tg-rujl">Attacker</th>
    <th class="tg-gn9g" colspan="3"><?php echo $info['Attacker']; ?></th>
  </tr>
  <tr>
    <td class="tg-9sz5">Troops</td>
    <td class="tg-6eq8">Clubswinger</td>
    <td class="tg-031e">Spearman</td>
    <td class="tg-031e">Axeman</td>
  </tr>
  <tr>
    <td class="tg-9sz5">Amount</td>
    <td class="tg-6eq8"><?php echo $info['clubswinger_att']; ?></td>
    <td class="tg-031e"><?php echo $info['spearman_att']; ?></td>
    <td class="tg-031e"><?php echo $info['axeman_att']; ?></td>
  </tr>
  <tr>
    <td class="tg-ygl1">Deaths</td>
    <td class="tg-031e"><?php echo $info['clubswinger_att_die']; ?></td>
    <td class="tg-031e"><?php echo $info['spearman_att_die']; ?></td>
    <td class="tg-031e"><?php echo $info['axeman_att_die']; ?></td>
  </tr>
  <tr>
    <td class="tg-ygl1">Loot</td>
    <td class="tg-031e" colspan="3">Wood:<?php echo $info['loot_wood']; ?> Clay:<?php echo $info['loot_clay']; ?> Iron:<?php echo $info['loot_iron']; ?> Wheat:<?php echo $info['loot_wheat']; ?></td>
  </tr>
</table>
<br><br>
</style>
<table class="tg">
  <tr>
    <th class="tg-rujl">Defender</th>
    <th class="tg-gn9g" colspan="3"><?php echo $info['Defender']; ?></th>
  </tr>
  <tr>
    <td class="tg-9sz5">Troops</td>
    <td class="tg-6eq8">Clubswinger</td>
    <td class="tg-031e">Spearman</td>
    <td class="tg-031e">Axeman</td>
  </tr>
  <tr>
    <td class="tg-9sz5">Amount</td>
    <td class="tg-6eq8"><?php echo $info['clubswinger_def']; ?></td>
    <td class="tg-031e"><?php echo $info['spearman_def']; ?></td>
    <td class="tg-031e"><?php echo $info['axeman_def']; ?></td>
  </tr>
  <tr>
    <td class="tg-ygl1">Deaths</td>
    <td class="tg-031e"><?php echo $info['clubswinger_def_die']; ?></td>
    <td class="tg-031e"><?php echo $info['spearman_def_die']; ?></td>
    <td class="tg-031e"><?php echo $info['axeman_def_die']; ?></td>
  </tr>
</table>
	
<?
}elseif($info['type']=="sendres"){
?>
<table class="tg">
  <tr>
    <th class="tg-rujl">Topic</th>
    <th class="tg-gn9g"><?php echo $info['topic']; ?></th>
  </tr>
	
  <tr>
    <td class="tg-9sz5">Date</td>
    <td class="tg-6eq8"><?php echo $info['time']; ?></td>
  </tr>
</table>
		
		
		
		
<br><br>
<table class="tg">
  <tr>
    <th class="tg-rujl">Orgin</th>
    <th class="tg-gn9g" colspan="3"><?php echo $info['Attacker']; ?></th>
  </tr>
  <tr>
    <td class="tg-ygl1">Amount</td>
    <td class="tg-031e" colspan="3">Wood:<?php echo $info['loot_wood']; ?> Clay:<?php echo $info['loot_clay']; ?> Iron:<?php echo $info['loot_iron']; ?> Wheat:<?php echo $info['loot_wheat']; ?></td>
  </tr>
</table>
<br><br>
</style>
<?	
}
}
}
?>
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