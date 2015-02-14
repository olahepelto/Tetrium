






<html>
<head>
<link rel="stylesheet" href="style/tetriumstyle.css" type="text/css" media="screen, projection" />
<title>Todo list</title>
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
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
		<?
		//the first query
$data = mysql_query("SELECT * FROM todo") or die(mysql_error());
Print "<table align=left border cellpadding=0>";
Print "<th>Type:</th><th>Task</th><th>Status</th><th>Delete</th><th>Swap</th></tr>"; 
while($info = mysql_fetch_array( $data )) {
	Print "<tr>"; 
	Print "<td>".$info['type'] . "</td><td>".$info['task'] . "</td><td>".$info['status'] . "</td><td><a href=executables/todoaction.php?delete=".$info["id"].">Delete</a></td></td><td><a href=executables/todoaction.php?swap=".$info["id"].">Swap</a></td></tr>"; 
}
Print "</table>";
?>
	
		
		<br><br><br><br><br><br>
		<form action="executables/todoaction.php" id="addtodo" method="get">
			
<br>Task: <input type="text" name="task"><br>
  <select form="addtodo" name="addtodoselector">
  <option value="gui">Gui</option>
  <option value="bug">Bug</option>
  <option value="feature">Feature</option>
  <option value="design">Design</option>
<option value="other">Other</option>
</select><br> 
	In progress: <input type="checkbox" name="inprogress" value="In progress"><br>
  <input type="submit" value="Submit">
</form>
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