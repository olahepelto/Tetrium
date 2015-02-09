<?
include("../includes/databasedetails.php");

$report_id = $_GET["rep_id"];
$own_report=true;

$result=mysql_query("SELECT * FROM reports WHERE report_id='$report_id' and player_id='$id'");
$own_report=mysql_num_rows($result);
if (isset($report_id) and $report_id>0 and $own_report==1){
	mysql_query("DELETE FROM reports WHERE report_id='$report_id' and player_id='$id'");
}else{
	echo "error";
	exit;
}
header("location: ../reports.php");
?>