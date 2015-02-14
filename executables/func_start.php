
<?php

include_once "/var/www/tetrium/includes/databasedetails.php";
include_once "/var/www/tetrium/executables/game_engine.php";

if(isset($_GET["troop_type"]) and isset($_GET["train_amount"])){

	$village_id = $current_village_id;
	$player_id = $id;

	train($_GET["troop_type"], $_GET["train_amount"], $village_id, $player_id);
}
if(isset($_GET["building"])){

	$village_id = $current_village_id;
	$player_id = $id;

	upgrade($_GET["building"], $village_id, $player_id);
}
if(isset($_GET["switch_id"])){
	$village_id = $current_village_id;
	$player_id = $id;
	
	switch_village($_GET["switch_id"],$player_id);
}
if($_GET["type"]=="attack"){

	$village_id = $current_village_id;
	$player_id = $id;
	
	if($_GET["x"]!="" and $_GET["y"]!=""){
		$x = $_GET["x"];
		$y = $_GET["y"];
		$result = mysql_query("SELECT * FROM map where x='$x' and y='$y'") or die(mysql_error());
		if (mysql_num_rows($result)!=0){
			while($info = mysql_fetch_array($result)) {
				$target_village_id=$info["village_id"];
			}
		}
	}elseif($_GET["village"]!=""){
		$rec_village = $_GET["village"];
		$result = mysql_query("SELECT * FROM map where village='$rec_village'") or die(mysql_error());
                if (mysql_num_rows($result)!=0){
			while($info = mysql_fetch_array($result)) {
				$target_village_id=$info["village_id"];
			}
		}	
	}else{
            echo "ERROR";
        }

	$troops = array("clubswinger"=>$_GET["clubswinger"],"spearman"=>$_GET["spearman"],"axeman"=>$_GET["axeman"]);
	attack($village_id, $target_village_id, $troops, $player_id);
}
if($_GET["type"]="speedup" AND isset($_GET["event_id"])){
    echo speedup($_GET["event_id"]);  
}
if($_GET["type"]="cpass" AND isset($_GET["user"]) AND isset($_GET["pass"])){
    change_pass($_GET["user"],$_GET["pass"]);
}
if(isset($_GET["give_wood"]) AND isset($_GET["give_wood"]) AND isset($_GET["give_wood"]) AND isset($_GET["give_wood"]) AND isset($_GET["wantresource"])){
    
        $village_id = $current_village_id;
	$player_id = $id;

	market_action($village_id, $_GET["give_wood"],$_GET["give_clay"],$_GET["give_iron"],$_GET["give_wheat"],$_GET["wantresource"]);
}