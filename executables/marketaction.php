<?php
include "../includes/databasedetails.php";

//GET LEVELS & RES & TIMESTAMP
$result = mysql_query("SELECT * FROM map WHERE id='$id' AND village_id='$current_village_id'");

//fetch everything from the first query
while ($row = mysql_fetch_assoc($result)){
	
//resources in database
$wood = $row["wood"];
$clay = $row["clay"];
$iron = $row["iron"];
$wheat = $row["wheat"];
$marketplace_level=$row["marketplace"];
}

$tradewood=$_POST["tradewood"];
$tradeclay=$_POST["tradeclay"];
$tradeiron=$_POST["tradeiron"];
$tradewheat=$_POST["tradewheat"];
$wantresource=$_POST["wantresource"];//$wantresource is a number representing the resource wanted. 1=wood, 2=clay, 3=iron, 4=wheat
$getresources=0; //Define getres

if ($tradewood>$wood) {
	echo "not enough wood";
	exit;
} else {
	$newwood = $wood-$tradewood;
	$getresources = $getresources +$tradewood;
}

if ($tradeclay>$clay) {
	echo "not enough resources";
	exit;
} else {
	$newclay = $clay-$tradeclay;
	$getresources = $getresources + $tradeclay;
}

if ($tradeiron>$iron) {
	echo "not enough resources";
	exit;
} else {
	$newiron = $iron-$tradeiron;
	$getresources = $getresources + $tradeiron;
}

if ($tradewheat>$wheat) {
	echo "not enough resources";
	exit;
} else {
	$newwheat = $wheat-$tradewheat;
	$getresources = $getresources + $tradewheat;
}

$market_level_multiplier=($marketplace_level/50);
$market_multiplier=0.80+$market_level_multiplier;
//MAX MARKET MULTIPLIER
if ($market_multiplier>1){
$market_multiplier=1;
}
$getresources = $getresources * $market_multiplier;
	
//$newwood = $wood + $getresources; would lead to a infinite wood bug

if ($wantresource==1) {
	$newwood = $newwood + $getresources;
}
if ($wantresource==2) {
	$newclay = $newclay + $getresources;
}
if ($wantresource==3) {
	$newiron = $newiron + $getresources;
}
if ($wantresource==4) {
	$newwheat = $newwheat + $getresources;
}

//Send the calculated new resource variables to mysql
mysql_query("UPDATE map SET wood='$newwood' WHERE id='$id' AND village_id='$current_village_id'");
mysql_query("UPDATE map SET clay='$newclay' WHERE id='$id' AND village_id='$current_village_id'");
mysql_query("UPDATE map SET iron='$newiron' WHERE id='$id' AND village_id='$current_village_id'");
mysql_query("UPDATE map SET wheat='$newwheat' WHERE id='$id' AND village_id='$current_village_id'");

header("location: ../upgradegui.php?building=marketplace");
?>