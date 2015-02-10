<?
include ("../includes/databasedetails.php");
$type=$_GET['addtodoselector'];
$task=$_GET["task"];
$status=$_GET["inprogress"];
$delete=$_GET["delete"];
$swap=$_GET["swap"];
if (empty($task) and empty($status)){
	if (isset($_GET["delete"])){
	mysql_query("DELETE FROM todo WHERE id='$delete'");
	}
	
	if (isset($_GET["swap"])){
	$status = mysql_query("SELECT status FROM todo WHERE id='$swap'");
		$status = mysql_fetch_array($status);
		if ($status["status"]=="In progress"){
		$newstatus="Not in progress";
		}else{ $newstatus="In progress"; }
	mysql_query("UPDATE todo SET status='$newstatus' WHERE id='$swap'");
	}
	
	header("location: ../todogui.php");
exit;
}else{
	if ($status==NULL){ $status="Not in progress"; }
mysql_query("INSERT INTO todo (type,task,status) VALUES ('$type','$task','$status')");
	header("location: ../todogui.php");
exit;
}




?>