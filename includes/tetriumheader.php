<div id="header">
<div id=menubar>
	<a href="tetrium.php"><img src="images/resourcefield.png" id="resourcefieldmenu" alt="Error"></a>
	<img src="images/village.png" id="villagemenu" alt="Error">
	<a href="map.php" style="text-decoration: none;"><img width="98" height="87" src="images/map2.png" alt="Error"></a>
	<a href="missions.php" style="text-decoration: none;"><img width="98" height="87" src="images/Battle_Icon.png" alt="Error"></a>
	<a href="stats.php"><img src="images/stats.png" id="statsmenu" alt="Error"></a>
	<?php

$result = mysql_query("SELECT * FROM reports WHERE player_id='$id' AND is_read='0'") or die(mysql_error());
$number_of_rows = mysql_num_rows($result);
	
	if ($number_of_rows>0){
		$icon="images/reports_unread.png";
	}else{
		$icon="images/reports.png";
	}
	?>
	<a href="reports.php"><img src="<?php echo $icon;?>" id="reportsmenu" alt="Error"></a>
	<a href="messages.php"><img src="images/messages.png" id="messagesmenu" alt="Error"></a>
	<font size=2><a href="mailto:otto.lahepelto@gmail.com?subject=Tetrium%20bug%20report">Report bug</a></font>
	<div style="float:right;"><?php include_once "includes/village_switcher.php";?></div>
	</div><br>
<!-- Print out the new resource values and increase them every 0,1 second but keep them rounded up -->
	Wood: <b id=wood>error</b>
	Clay: <b id=clay>error</b>
	Iron: <b id=iron>error</b>
	Pizzas: <b id=wheat>error</b><br>
		
	</div><!-- #header-->