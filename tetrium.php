<?php
    include "includes/databasedetails.php";
    include "executables/start_logic.php";
?>
<html>
    <head>
	<title>Tetrium</title>
        <link rel="stylesheet" href="style/tetriumstyle.css" type="text/css" media="screen, projection" />
    </head>
    <body>
        <center>
            <div id="wrapper">
                <?php include("includes/tetriumheader.php") ?>
	
                <div id="middle">
                    <div id="container">
                        <div id="content" style="padding-top: 20px;">
                            <?php include "resourcefields.php";?>
                
                        </div><!-- #content-->
                    </div><!-- #container-->
                <?php include("includes/tetriumsidebarsandfooter.php"); ?>
		
            </div>
        </center>
	<?php if (isset($_GET["newvillagename"])and !$_GET["newvillagename"]==""){
	$newvillagename=$_GET["newvillagename"];
	mysql_query("UPDATE map SET village='$newvillagename' WHERE village_id='$current_village_id'");
	$url=$_SERVER['REQUEST_URI'];
	$url = strtok($url, '?');
	header("Location: ".$url);
	}
	include("includes/tetriumjavascript.php");?>
    </body>
</html>
