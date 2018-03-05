<?php
date_default_timezone_set("UTC");

include_once("configuration/databasecredentials.php");

$connection = mysql_connect($host, $username, $password) or die (mysql_error());
mysql_select_db($db_name, $connection) or die (mysql_error());

/*
 * REPLENISH NATURE IN ALL VILLAGES
 * */
$MAX_TROOP_POINTS = 35;
$REPLENISH_SPEED = 8;

$result = mysql_query("SELECT * FROM map");
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
    $vtype[] = $row['type'];
    $vidx[] = $row['x'];
    $vidy[] = $row['y'];
    $clubswinger[] = $row['clubswinger'];
    $spearman[] = $row['spearman'];
    $axeman[] = $row['axeman'];
}
$vid = 0;
for ($y = 1; $y <= 16; $y++) {
    for ($x = 1; $x <= 16; $x++) {
        $new_clubswinger = $clubswinger[$vid];
        $new_spearman = $spearman[$vid];
        $new_axeman = $axeman[$vid];

        if($vtype[$vid] != 1){

            $curr_points = $clubswinger[$vid] + $spearman[$vid] * 2 + $axeman[$vid] * 2;
            if($curr_points <= $MAX_TROOP_POINTS) {
                $points_to_add = $MAX_TROOP_POINTS - $curr_points;

                if($points_to_add > $REPLENISH_SPEED + rand(0, 5) - rand(0, 6)){
                    $points_to_add = $REPLENISH_SPEED;
                }

                while($points_to_add >= 0) {
                    $rand = rand(1, 3);

                    if ($rand == 1) {//CS
                        $points_to_add--;
                        $new_clubswinger++;
                    }elseif ($rand == 2) {//AM
                        $points_to_add--;
                        $new_axeman++;
                    }elseif ($rand == 3) {//SM
                        $points_to_add -= 2;
                        $new_spearman++;
                    }
                }
                mysql_query("UPDATE map SET clubswinger='$new_clubswinger' WHERE village_id='$vid'");
                mysql_query("UPDATE map SET spearman='$new_spearman' WHERE village_id='$vid'");
                mysql_query("UPDATE map SET axeman='$new_axeman' WHERE village_id='$vid'");
            }
        }
        $vid++;
    }
}


?>