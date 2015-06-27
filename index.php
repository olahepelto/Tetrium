<?
session_start();

if(isset($_SESSION["userid"])){
header("location: /main_login.php");
}else{
header("location: /tetrium.php");
}
?>