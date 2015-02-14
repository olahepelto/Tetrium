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
	
		
		
		


<br><br><br>
<?
	/*-----------------------------------------
	This is the MESSAGE function
	-----------------------------------------*/	

	$data = mysql_query("SELECT * FROM messages where receiver='$id'") or die(mysql_error());
?><table align=center border cellpadding=0>
<th>Topic:</th><th>Message:</th><th>Sender:</th><th>time:</th></tr> <?

while($info = mysql_fetch_array( $data )) {
	
	//Check sender name
	$sender=$info["sender"];
	$bob = mysql_query("SELECT username FROM members where id='$sender'") or die(mysql_error());
	while($infoo = mysql_fetch_array( $bob )) {
	$sender=$infoo["username"];
	}
	
	Print "<tr>"; 
	Print "<td>".$info['topic'] . "</td><td>".$info['message'] . "</td><td>".$sender . "</td><td>".$info['time'] . "</td></tr>"; 
}
?></table>
		<a href=sendmailgui.php><button>Send</button></a>
		<?

	
	
	/*-----------------------------------------
	This is the end of the MESSAGE function
	-----------------------------------------*/	
?><br>

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