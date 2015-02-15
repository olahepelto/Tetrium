<?php

include "../includes/databasedetails.php";


//GET variables
$x=$_GET["x"];
$y=$_GET["y"];
$from_village_id=$current_village_id;
$village=$_GET["village"];
$sender_id=$id;
$send_wood=$_GET["wood_box"];
$send_clay=$_GET["clay_box"];
$send_iron=$_GET["iron_box"];
$send_wheat=$_GET["wheat_box"];

if(empty($send_wood)){$send_wood=0;}
if(empty($send_clay)){$send_clay=0;}
if(empty($send_iron)){$send_iron=0;}
if(empty($send_wheat)){$send_wheat=0;}

/*
CHECK IF ERROR
*/
if(($send_wood<0 or $send_clay<0 or $send_iron<0 or $send_wheat<0) or ($send_wood+$send_clay+$send_iron+$send_wheat<0) or (!is_numeric($send_wood) or !is_numeric($send_clay) or !is_numeric($send_iron) or !is_numeric($send_wheat))){
header("location: ../send_resources.php?message=Your engineers don't know how to send that amount of resources");
exit;	
}
if (empty($x) and empty($y) and empty($village)){
	header("location: ../send_resources.php?message=send resources: please fill out the destination x and y cordinates or village");
	exit;
}
/*
CHECK IF ERROR END
*/



//GET sender village details from db
$result = mysql_query("SELECT * FROM map WHERE village_id='$from_village_id' and id='$id'") or die(mysql_error());
if (mysql_num_rows($result)>0){
while ($row = mysql_fetch_assoc($result)){
	$wood = $row["wood"];
	$clay = $row["clay"];
	$iron = $row["iron"];
	$wheat = $row["wheat"];
	$from_village_x = $row["x"];
	$from_village_y = $row["y"];
}
}else{
	/*
	WILL NEVER HAPPEN
	*/
header("location: ../send_resources.php?message=send resources: you can't send resources from another players village XD");
exit;
}

//ERROR CHECK
if ($wood<$send_wood or $clay<$send_clay or $iron<$send_iron or $wheat<$send_wheat){
header("location: ../send_resources.php?message=send resources: not enough resources");
exit;
}



/*
GET RECEIVING VILLAGE DETAILS $X,$Y,$VILLAGE ID USING MAINLY CORDINATES
*/
if (isset($x) and isset($y)){
$result = mysql_query("SELECT * FROM map where x='$x' and y='$y'") or die(mysql_error());
if (mysql_num_rows($result)>0){
while($info = mysql_fetch_array($result)) {
	$village_id=$info["village_id"];
	$receiver_id=$info["id"];
	}
}else{
header("location: ../send_resources.php?message=send resources: no village exists in theise cordinates");
exit;
}
}elseif (isset($village)){
$result = mysql_query("SELECT * FROM map where village='$village'") or die(mysql_error());
if (mysql_num_rows($result)>0){
while($info = mysql_fetch_array($result)) {
	$village_id=$info["village_id"];
	$x=$info["x"];
	$y=$info["y"];
	$receiver_id=$info["id"];
	}
}else{
header("location: ../send_resources.php?message=send resources: no such village exists");
exit;
}
}
/*
END GET RECEIVING VILLAGE DETAILS
*/



if($village_id==$from_village_id){
header("location: ../send_resources.php?message=you cant send resources to the same village you are sending them from -_-");
exit;	
}

$x_distance=abs($from_village_x-$x); //absolute value
$y_distance=abs($from_village_y-$y); //absolute value



$speed=3;//speed of transportation
$time=round((sqrt(pow($x_distance,2)+pow($y_distance,2))/$speed)*60);//Time in minutes
$time_return=$time*2;//Time in minutes

$completed=date("Y-m-d H:i:s", strtotime("$time minutes"));
$return_completed=date("Y-m-d H:i:s", strtotime("$time_return minutes"));


//SEND EVENT TO DATABASE
mysql_query("INSERT INTO events (userid, target,target_village,village_id, wood, clay, iron, wheat, completed, type, returning,return_completed) VALUES ('$sender_id', '$receiver_id','$village_id','$from_village_id', '$send_wood', '$send_clay', '$send_iron', '$send_wheat', '$completed', 'sendres','false','$return_completed')") or die(mysql_error());
$newwood=$wood-$send_wood;
$newclay=$clay-$send_clay;
$newiron=$iron-$send_iron;
$newwheat=$wheat-$send_wheat;
	
mysql_query("UPDATE map SET wood='$newwood', clay='$newclay', iron='$newiron', wheat='$newwheat' WHERE village_id='$from_village_id'") or die(mysql_error());

header("location: ../send_resources.php");
?>