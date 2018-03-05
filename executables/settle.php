<?php

include "../includes/databasedetails.php";


//GET variables
$x = $_GET["x"];
$y = $_GET["y"];
$from_village_id = $current_village_id;
$village = $_GET["village"];
$sender_id = $id;


if (empty($x) and empty($y) and empty($village)) {
    header("location: /tetrium.php?p=srs&message=send resources: please fill out the destination x and y cordinates or village");
    exit;
}

$result = mysql_query("SELECT * FROM map WHERE id='$id'") or die(mysql_error());

if(mysql_num_rows($result) == 1){
  $resource_cost = 5000;
}elseif(mysql_num_rows($result) == 2){
  $resource_cost = 10000;
}elseif(mysql_num_rows($result) == 3){
  $resource_cost = 20000;
}elseif(mysql_num_rows($result) == 4){
  $resource_cost = 40000;
}elseif(mysql_num_rows($result) == 5){
  $resource_cost = 80000;
}elseif(mysql_num_rows($result) == 6){
  $resource_cost = 160000;
}else{
  $resource_cost = 200000;
}

//GET sender village details from db
$result = mysql_query("SELECT * FROM map WHERE village_id='$from_village_id' and id='$id'") or die(mysql_error());
if (mysql_num_rows($result) > 0) {
    while ($row = mysql_fetch_assoc($result)) {
        $wood = $row["wood"];
        $clay = $row["clay"];
        $iron = $row["iron"];
        $wheat = $row["wheat"];
      
        $from_village_x = $row["x"];
        $from_village_y = $row["y"];
    }
} else {
    /*
    WILL NEVER HAPPEN
    */
    header("location: /tetrium.php?p=srs&message=send resources: you can't settle from another players village XD");
    exit;
}

if($resource_cost > $wood or $resource_cost > $clay or $resource_cost > $iron or $resource_cost > $wheat){
  header("location: /tetrium.php?p=srs&message=send resources: You don't have enough resources to settle a new village");
  exit;
}


/*
GET RECEIVING VILLAGE DETAILS $X,$Y,$VILLAGE ID USING MAINLY CORDINATES
*/
if (isset($x) and isset($y)) {
    $result = mysql_query("SELECT * FROM map where x='$x' and y='$y'") or die(mysql_error());
    if (mysql_num_rows($result) > 0) {
        while ($info = mysql_fetch_array($result)) {
            $village_id = $info["village_id"];
            $receiver_id = $info["id"];
        }
    } else {
        header("location: /tetrium.php?p=srs&message=send resources: no village exists in theise cordinates");
        exit;
    }
} elseif (isset($village)) {
    $result = mysql_query("SELECT * FROM map where village='$village'") or die(mysql_error());
    if (mysql_num_rows($result) > 0) {
        while ($info = mysql_fetch_array($result)) {
            $village_id = $info["village_id"];
            $x = $info["x"];
            $y = $info["y"];
            $receiver_id = $info["id"];
        }
    } else {
        header("location: /tetrium.php?p=srs&message=send resources: no such village exists");
        exit;
    }
}
/*
END GET RECEIVING VILLAGE DETAILS
*/


if ($village_id == $from_village_id) {
    header("location: /tetrium.php?p=srs&message=you cant send resources to the same village you are sending them from -_-");
    exit;
}

$x_distance = abs($from_village_x - $x); //absolute value
$y_distance = abs($from_village_y - $y); //absolute value


$speed = 3;//speed of transportation
$time = round((sqrt(pow($x_distance, 2) + pow($y_distance, 2)) / $speed) * 60);//Time in minutes
$time_return = $time * 2;//Time in minutes

$completed = date("Y-m-d H:i:s", strtotime("$time minutes"));
$return_completed = date("Y-m-d H:i:s", strtotime("$time_return minutes"));


//SEND EVENT TO DATABASE
mysql_query("INSERT INTO events (userid, target,target_village,village_id, wood, clay, iron, wheat, completed, type, returning,return_completed) VALUES ('$sender_id', '$receiver_id','$village_id','$from_village_id', 600, 600, 600, 600, '$completed', 'settle','false','$return_completed')") or die(mysql_error());

$new_wood = $wood - $resource_cost;
$new_clay = $clay - $resource_cost;
$new_iron = $iron - $resource_cost;
$new_wheat = $wheat - $resource_cost;

//$from_village_id
mysql_query("UPDATE map SET wood='$new_wood' WHERE village_id='$from_village_id'") or die(mysql_error());
mysql_query("UPDATE map SET clay='$new_clay' WHERE village_id='$from_village_id'") or die(mysql_error());
mysql_query("UPDATE map SET iron='$new_iron' WHERE village_id='$from_village_id'") or die(mysql_error());
mysql_query("UPDATE map SET wheat='$new_wheat' WHERE village_id='$from_village_id'") or die(mysql_error());

header("location: /tetrium.php?p=srs");
exit;
?>