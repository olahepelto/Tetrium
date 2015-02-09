<?
include "../includes/databasedetails.php";
include "updateresources.php";


$mailreceiver=$_POST["receiver"];
$mailsender=$id;
$mailsubject=$_POST["subject"];
$mailmessage=$_POST["message"];

$data = mysql_query("SELECT id FROM members where username='$receiver'") or die(mysql_error());
while($info = mysql_fetch_array( $data )) {
	$receiver=$info["id"];
	}

if (isset($sender) and isset($receiver) and isset($subject) and isset($message)){
$now=date('Y-m-d H:i:s');
mysql_query("INSERT INTO messages (sender, receiver, topic, message, time) VALUES ('$sender', '$receiver', '$subject', '$message', '$now')") or die(mysql_error());
}
header("location: ../messages.php");
?>