<?php
include "includes/databasedetails.php";
if(!$_SESSION['varadmin']==1){
	header("location:tetrium.php");
exit;
}
?>
<head>
	<title>Change infobox</title>
	<link rel="shortcut icon" type="image/ico" href="http://www.tetrium.tk/tetrium/images/favicon.ico"/>
<link rel="stylesheet" href="style/login-form.css" type="text/css" media="screen, projection" />
</head>
<center>
<?php if (isset($_POST["text"])){
$text=str_replace("\'","'",$_POST["text"]);
if(!file_put_contents("includes/infocolumn.html",$text)){echo "Error:can't change 'includes/infocolumn.html'";exit;}
header("location: changeinfo.php?ready=true");
}elseif($_GET["ready"]==true){
$newbox=file_get_contents('includes/infocolumn.html');
echo $newbox;
?> <a href="changeinfo.php">BACK</a> <?php
}else{
$newbox=file_get_contents('includes/infocolumn.html');?>
<form id="changeinfo" action="changeinfo.php" method="POST">
	<textarea rows="40" cols="50" type="textarea" name="text" id="text"><?php echo $newbox; ?></textarea>
	<input type="submit"></form>
<?php } ?></center>