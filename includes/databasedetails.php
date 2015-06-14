<link rel="shortcut icon" type="image/ico" href="../images/favicon.ico"/>	
<?php
session_start();
if ($_GET["errors"]==1 and $_SESSION["varadmin"]==1){
ini_set('display_errors', 'On');
error_reporting(E_ALL);
}

if (!isset($notloggedin)){
if(empty($_SESSION["myusername"])){
	header("location:main_login.php");
exit;
}
}

$host="localhost"; // Host name
$username= "root"; // Mysql username
$password="***REMOVED***"; // Mysql password
$db_name="tetrium"; // Database name

$id=$_SESSION["varid"]; // Id
$current_village_id=$_SESSION["current_village_id"];



$connection = mysql_connect($host,$username,$password) or die (mysql_error ());
$sqlerror = mysql_error();

mysql_select_db($db_name,$connection) or die (mysql_error());

/*
LIST ALL USER VILLAGES TO VARIABLE $all_user_villages_ids in format [0],[1],[3] etc
*/
$all_user_villages_ids=array();
$x=0;
$result = mysql_query("SELECT village_id FROM map WHERE id='$id'");

$all_user_villages_ammount = mysql_num_rows($result);
while ($row = mysql_fetch_array($result)) 
{
$all_user_villages_ids[$x] = $row["village_id"];
$x=$x+1;
}
$x=NULL;
/*
LIST ALL USER VILLAGES END
*/




if (empty($dontrun) && strpos($_SERVER['PHP_SELF'],'/includes/') == false && strpos($_SERVER['PHP_SELF'],'/executables/') == false && strpos($_SERVER['PHP_SELF'],'/tetrium/') !== false) {
require_once("includes/servertime.php");
$dontrun=true;
}

?>