<?php

include_once("game_engine.php"); //game engine functions

$mysql_data = get_val($current_village_id); //Final values for viewing to player

res_calc($current_village_id); //Calc village id resources

/*
$croplandsh = ceil((pow($mysql_data["cropland1"] + 6, 3 + $mysql_data["cropland1"] / 320) / 4) + (pow($mysql_data["cropland2"] + 6, 3 + $mysql_data["cropland2"] / 320) / 4) + (pow($mysql_data["cropland3"] + 6, 3 + $mysql_data["cropland3"] / 320) / 4) + (pow($mysql_data["cropland4"] + 6, 3 + $mysql_data["cropland4"] / 320) / 4) + (pow($mysql_data["cropland5"] + 6, 3 + $mysql_data["cropland5"] / 320) / 4) + (pow($mysql_data["cropland6"] + 6, 3 + $mysql_data["cropland6"] / 320) / 4));
$woodcuttersh = ceil((pow($mysql_data["woodcutter1"] + 6, 3 + $mysql_data["woodcutter1"] / 320) / 4) + (pow($mysql_data["woodcutter2"] + 6, 3 + $mysql_data["woodcutter2"] / 320) / 4) + (pow($mysql_data["woodcutter3"] + 6, 3 + $mysql_data["woodcutter3"] / 320) / 4) + (pow($mysql_data["woodcutter4"] + 6, 3 + $mysql_data["woodcutter4"] / 320) / 4));
$claypitsh = ceil((pow($mysql_data["claypit1"] + 6, 3 + $mysql_data["claypit1"] / 320) / 4) + (pow($mysql_data["claypit2"] + 6, 3 + $mysql_data["claypit2"] / 320) / 4) + (pow($mysql_data["claypit3"] + 6, 3 + $mysql_data["claypit3"] / 320) / 4) + (pow($mysql_data["claypit4"] + 6, 3 + $mysql_data["claypit4"] / 320) / 4));
$ironminesh = ceil((pow($mysql_data["ironmine1"] + 6, 3 + $mysql_data["ironmine1"] / 320) / 4) + (pow($mysql_data["ironmine2"] + 6, 3 + $mysql_data["ironmine2"] / 320) / 4) + (pow($mysql_data["ironmine3"] + 6, 3 + $mysql_data["ironmine3"] / 320) / 4) + (pow($mysql_data["ironmine4"] + 6, 3 + $mysql_data["ironmine4"] / 320) / 4));
*/
include_once("event_manager.php"); //will be migrated to game_engine.php


//GET NEW VALUES AFTER EVENT MANAGER //DEPRECATED SOON
$mysql_data = get_val($current_village_id); //Final values for viewing to player