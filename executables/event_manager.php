<!--
THIS THING UPDATES EVERY EVENT THAT IS NOT UPDATED, NOT ONLY THE CURRENT PLAYERS
-->
<?php
/*
EVERY READY EVENT IS CALCULATED HERE WHEN A PLAYER UPDATES THE PAGE
*/
$time_now = date("Y-m-d H:i:s");
$result = mysql_query("SELECT * FROM events WHERE (completed < '$time_now' AND returning=0) or (return_completed < '$time_now' AND returning=1)") or die(mysql_error());
$number_of_rows = mysql_num_rows($result);
$x = $number_of_rows;

while ($x > 0) {
    $xminus = $x - 1;
    $time_now = date("Y-m-d H:i:s");
    $result = mysql_query("SELECT * FROM events WHERE (completed < '$time_now' AND returning=0) or (return_completed < '$time_now' AND returning=1) LIMIT $xminus,1") or die(mysql_error());

    /*
    GET EVENT DETAILS
    */
    while ($row = mysql_fetch_assoc($result)) {
        $type = $row["type"];
        $completed = $row["completed"];
        $building = $row["building"];
        $nextlevel = $row["nextlevel"];
        $event_id = $row["id"];
        $amount = $row["amount"];
        $troop_type = $row["troop_type"];
        $send_wood = $row["wood"];
        $send_clay = $row["clay"];
        $send_iron = $row["iron"];
        $send_wheat = $row["wheat"];
        $send_clubswinger = $row["clubswinger"];
        $send_spearman = $row["spearman"];
        $send_axeman = $row["axeman"];
        $send_scouthorse = $row["scouthorse"];
        $send_knighthorse = $row["knighthorse"];
        $send_warhorse = $row["warhorse"];
        $target = $row["target"];
        $sender_id = $row["userid"];
        $target_village = $row["target_village"];
        $from_village_id = $row["village_id"];
        $return_completed = $row["return_completed"];
        $returning = $row["returning"];

    }

    $result = mysql_query("SELECT * FROM members WHERE id='$target'") or die(mysql_error());
    while ($row = mysql_fetch_assoc($result)) {
        $target_name = $row["username"];
    }
    $result = mysql_query("SELECT * FROM map WHERE village_id='$target_village'") or die(mysql_error());
    while ($row = mysql_fetch_assoc($result)) {
        $target_village_name = $row["village"];
    }
    $result = mysql_query("SELECT * FROM map WHERE village_id='$from_village_id'") or die(mysql_error());
    while ($row = mysql_fetch_assoc($result)) {
        $from_village_name = $row["village"];
    }
    $result = mysql_query("SELECT * FROM members WHERE id='$sender_id'") or die(mysql_error());
    while ($row = mysql_fetch_assoc($result)) {
        $sender_name = $row["username"];
    }
    /*
    CONSTRUCTING A BUILDING
    */
    if ($type == "building") {
        mysql_query("UPDATE map SET $building='$nextlevel' WHERE village_id='$from_village_id'") or die(mysql_error());
        mysql_query("DELETE FROM events WHERE id='$event_id'") or die(mysql_error());
    }
    /*
    BUILDING TROOPS
    */
    if ($type == "troops") {
        $result = mysql_query("SELECT * FROM map WHERE village_id='$from_village_id'");
        while ($row = mysql_fetch_assoc($result)) {
            $clubswinger = $row["clubswinger"];
            $spearman = $row["spearman"];
            $axeman = $row["axeman"];
            $scouthorse = $row["scouthorse"];
            $knighthorse = $row["knighthorse"];
            $warhorse = $row["warhorse"];
        }

        if ($troop_type == "clubswinger") {
            $oldamount = $clubswinger;
        } elseif ($troop_type == "spearman") {
            $oldamount = $spearman;
        } elseif ($troop_type == "axeman") {
            $oldamount = $axeman;
        }elseif ($troop_type == "scouthorse") {
            $oldamount = $scouthorse;
        } elseif ($troop_type == "knighthorse") {
            $oldamount = $knighthorse;
        } elseif ($troop_type == "warhorse") {
            $oldamount = $warhorse;
        }

        $newamount = $oldamount + $amount;
        mysql_query("UPDATE map SET $troop_type='$newamount' WHERE village_id='$from_village_id'") or die(mysql_error());
        mysql_query("DELETE FROM events WHERE id='$event_id'") or die(mysql_error());
    }
    /*
    RESOURCES (NOT RETURNING)
    */
    if ($type == "sendres" and $returning != 1) {

        $result = mysql_query("SELECT * FROM map WHERE village_id='$target_village'");
        while ($row = mysql_fetch_assoc($result)) {
            $event_old_wood = $row["wood"];
            $event_old_clay = $row["clay"];
            $event_old_iron = $row["iron"];
            $event_old_wheat = $row["wheat"];
        }

        $event_newwood = $event_old_wood + $send_wood;
        $event_newclay = $event_old_clay + $send_clay;
        $event_newiron = $event_old_iron + $send_iron;
        $event_newwheat = $event_old_wheat + $send_wheat;

        mysql_query("UPDATE map SET wood='$event_newwood' WHERE village_id='$target_village'") or die(mysql_error());
        mysql_query("UPDATE map SET clay='$event_newclay' WHERE village_id='$target_village'") or die(mysql_error());
        mysql_query("UPDATE map SET iron='$event_newiron' WHERE village_id='$target_village'") or die(mysql_error());
        mysql_query("UPDATE map SET wheat='$event_newwheat' WHERE village_id='$target_village'") or die(mysql_error());
        mysql_query("UPDATE events SET returning=1 WHERE id='$event_id'") or die(mysql_error());

        $topic = $sender_name . " sends resources to " . $target_village_name;

        $defender_and_city = $target_name . " from the village " . $target_village_name;
        $attacker_and_city = $sender_name . " from the village " . $from_village_name;

        $time_now = date("Y-m-d H:i:s");
        mysql_query("INSERT INTO reports (player_id,topic,Attacker,Defender,loot_wood,loot_clay,loot_iron,loot_wheat,time,is_read,type) VALUES ('$sender_id','$topic','$attacker_and_city','$defender_and_city','$send_wood','$send_clay','$send_iron','$send_wheat','$time_now',0,'$type')") or die(mysql_error());
        mysql_query("INSERT INTO reports (player_id,topic,Attacker,Defender,loot_wood,loot_clay,loot_iron,loot_wheat,time,is_read,type) VALUES ('$target','$topic','$attacker_and_city','$defender_and_city','$send_wood','$send_clay','$send_iron','$send_wheat','$time_now',0,'$type')") or die(mysql_error());
    }

    /*
    RESOURCES (RETURNING)
    */

    if ($type == "sendres" and $returning == 1) {
        mysql_query("DELETE FROM events WHERE id='$event_id'") or die(mysql_error());
    }

    /*
    SETTLERS(THEY DON'T RETURN TO ORIGIN VILLAGE)
    */
    if ($type == "settle") {
        mysql_query("UPDATE map SET village = 'New Village', player = '$sender_name', type = '1', id = '$sender_id' WHERE village_id='$target_village'") or die(mysql_error());
        mysql_query("UPDATE events SET returning=1 WHERE id='$event_id'") or die(mysql_error());

        $topic = $sender_name . " settles a new village in " . $target_village_name;

        $defender_and_city = $target_name . " from the village " . $target_village_name;
        $attacker_and_city = $sender_name . " from the village " . $from_village_name;

        $time_now = date("Y-m-d H:i:s");
        mysql_query("INSERT INTO reports (player_id,topic,Attacker,Defender,loot_wood,loot_clay,loot_iron,loot_wheat,time,is_read,type) VALUES ('$sender_id','$topic','$attacker_and_city','$defender_and_city','$send_wood','$send_clay','$send_iron','$send_wheat','$time_now',0,'$type')") or die(mysql_error());
        mysql_query("DELETE FROM events WHERE id='$event_id'") or die(mysql_error());
    }

    /*
    ATTACKS (NOT RETURNING)
    */
    if ($type == "attack" and $returning != 1) {

        res_calc($target_village);

        //GET DEFENDER TROOPS
        $result = mysql_query("SELECT * FROM map WHERE village_id='$target_village'");
        while ($row = mysql_fetch_assoc($result)) {
            $defender_old_clubswinger = $row["clubswinger"];
            $defender_old_spearman = $row["spearman"];
            $defender_old_axeman = $row["axeman"];
            $defender_old_scouthorse = $row["scouthorse"];
            $defender_old_knighthorse = $row["knighthorse"];
            $defender_old_warhorse = $row["warhorse"];
        }
        //GET DEFENDER RESOURCES
        $result = mysql_query("SELECT * FROM map WHERE village_id='$target_village'");
        while ($row = mysql_fetch_assoc($result)) {
            $defender_old_wood = $row["wood"];
            $defender_old_clay = $row["clay"];
            $defender_old_iron = $row["iron"];
            $defender_old_wheat = $row["wheat"];

            $defender_city_wall = $row["wall"];
        }

        $DP = ($defender_old_clubswinger * 10 + $defender_old_spearman * 25 + $defender_old_axeman * 10 + $defender_old_scouthorse * 10 + $defender_old_knighthorse * 60 + $defender_old_warhorse * 80) * (1+$defender_city_wall*3/100);//CITY WALL ADDS 3% def bonus per level
        $AP = $send_clubswinger * 10 + $send_spearman * 10 + $send_axeman * 30 + $send_scouthorse * 10 + $send_knighthorse * 80 + $send_warhorse * 60;


        /*
        ATTACK FORMULA
        */
        if ($AP > $DP) {
            //ATTACKER WON
            $win_constant = pow($DP, 2) / pow($AP, 2);
            $winner = "Attacker";

            $attacker_new_clubswinger = $send_clubswinger - ($send_clubswinger * $win_constant);
            $attacker_new_spearman = $send_spearman - ($send_spearman * $win_constant);
            $attacker_new_axeman = $send_axeman - ($send_axeman * $win_constant);
            $attacker_new_scouthorse = $send_scouthorse - ($send_scouthorse * $win_constant);
            $attacker_new_knighthorse = $send_knighthorse - ($send_knighthorse * $win_constant);
            $attacker_new_warhorse = $send_warhorse - ($send_warhorse * $win_constant);

            $defender_totalresources = $defender_old_wood + $defender_old_clay + $defender_old_iron + $defender_old_wheat;
            $attacker_carryamount = ($attacker_new_clubswinger * 20) + ($attacker_new_spearman * 40) + ($attacker_new_axeman * 30) +
                ($attacker_new_scouthorse * 50) + ($attacker_new_knighthorse * 120) + ($attacker_new_warhorse * 100);
            $loot_multiplier = $attacker_carryamount / $defender_totalresources;


            if ($attacker_carryamount < $defender_totalresources) {
                $attacker_loot_wood = round($loot_multiplier * $defender_old_wood);
                $attacker_loot_clay = round($loot_multiplier * $defender_old_clay);
                $attacker_loot_iron = round($loot_multiplier * $defender_old_iron);
                $attacker_loot_wheat = round($loot_multiplier * $defender_old_wheat);
            } else {
                $attacker_loot_wood = $defender_old_wood;
                $attacker_loot_clay = $defender_old_clay;
                $attacker_loot_iron = $defender_old_iron;
                $attacker_loot_wheat = $defender_old_wheat;
            }


            $defender_new_wood = $defender_old_wood - $attacker_loot_wood;
            $defender_new_clay = $defender_old_clay - $attacker_loot_clay;
            $defender_new_iron = $defender_old_iron - $attacker_loot_iron;
            $defender_new_wheat = $defender_old_wheat - $attacker_loot_wheat;

            $defender_new_clubswinger = 0;
            $defender_new_spearman = 0;
            $defender_new_axeman = 0;
            //$defender_new_scouthorse = 0; //SCOUTS DON'T DIE
            $defender_new_knighthorse = 0;
            $defender_new_warhorse = 0;

        } elseif ($AP < $DP) {
            //DEFENDER WON
            $win_constant = pow($AP, 2) / pow($DP, 2);
            $winner = "Defender";

            $attacker_new_clubswinger = 0;
            $attacker_new_spearman = 0;
            $attacker_new_axeman = 0;
            $attacker_new_scouthorse = 0;
            $attacker_new_knighthorse = 0;
            $attacker_new_warhorse = 0;

            $defender_new_clubswinger = $defender_old_clubswinger - ($defender_old_clubswinger * $win_constant);
            $defender_new_spearman = $defender_old_spearman - ($defender_old_spearman * $win_constant);
            $defender_new_axeman = $defender_old_axeman - ($defender_old_axeman * $win_constant);
            mysql_query("DELETE FROM events WHERE id='$event_id'") or die(mysql_error());
        } else {
            //DEFENDER WON ADVANTAGE
            $win_constant = pow($AP, 2) / pow($DP, 2);
            $winner = "Defender Advantage";

            $attacker_new_clubswinger = 0;
            $attacker_new_spearman = 0;
            $attacker_new_axeman = 0;
            $attacker_new_scouthorse = 0;
            $attacker_new_knighthorse = 0;
            $attacker_new_warhorse = 0;

            $defender_new_clubswinger = $defender_old_clubswinger - ($defender_old_clubswinger * $win_constant);
            $defender_new_spearman = $defender_old_spearman - ($defender_old_spearman * $win_constant);
            $defender_new_axeman = $defender_old_axeman - ($defender_old_axeman * $win_constant);
            $defender_new_scouthorse = $defender_old_scouthorse - ($defender_old_scouthorse * $win_constant);
            $defender_new_knighthorse = $defender_old_knighthorse - ($defender_old_knighthorse * $win_constant);
            $defender_new_warhorse = $defender_old_warhorse - ($defender_old_warhorse * $win_constant);


            mysql_query("DELETE FROM events WHERE id='$event_id'") or die(mysql_error());
        }


        /*
        UPDATE DEFENDER STUFF
        */
        mysql_query("UPDATE map SET clubswinger='$defender_new_clubswinger' WHERE village_id='$target_village'") or die(mysql_error());
        mysql_query("UPDATE map SET spearman='$defender_new_spearman' WHERE village_id='$target_village'") or die(mysql_error());
        mysql_query("UPDATE map SET axeman='$defender_new_axeman' WHERE village_id='$target_village'") or die(mysql_error());
        mysql_query("UPDATE map SET scouthorse='$defender_new_scouthorse' WHERE village_id='$target_village'") or die(mysql_error());
        mysql_query("UPDATE map SET knighthorse='$defender_new_knighthorse' WHERE village_id='$target_village'") or die(mysql_error());
        mysql_query("UPDATE map SET warhorse='$defender_new_warhorse' WHERE village_id='$target_village'") or die(mysql_error());


        mysql_query("UPDATE map SET wood='$defender_new_wood' WHERE village_id='$target_village'") or die(mysql_error());
        mysql_query("UPDATE map SET clay='$defender_new_clay' WHERE village_id='$target_village'") or die(mysql_error());
        mysql_query("UPDATE map SET iron='$defender_new_iron' WHERE village_id='$target_village'") or die(mysql_error());
        mysql_query("UPDATE map SET wheat='$defender_new_wheat' WHERE village_id='$target_village'") or die(mysql_error());


        /*
        UPDATE EVENT ONLY IF ATTACKER WON //BUG?
        */
        if ($winner == "Attacker") {
            mysql_query("UPDATE events SET clubswinger='$attacker_new_clubswinger' WHERE id='$event_id'") or die(mysql_error());
            mysql_query("UPDATE events SET spearman='$attacker_new_spearman' WHERE id='$event_id'") or die(mysql_error());
            mysql_query("UPDATE events SET axeman='$attacker_new_axeman' WHERE id='$event_id'") or die(mysql_error());
            mysql_query("UPDATE events SET scouthorse='$attacker_new_scouthorse' WHERE id='$event_id'") or die(mysql_error());
            mysql_query("UPDATE events SET knighthorse='$attacker_new_knighthorse' WHERE id='$event_id'") or die(mysql_error());
            mysql_query("UPDATE events SET warhorse='$attacker_new_warhorse' WHERE id='$event_id'") or die(mysql_error());

            mysql_query("UPDATE events SET wood='$attacker_loot_wood' WHERE id='$event_id'") or die(mysql_error());
            mysql_query("UPDATE events SET clay='$attacker_loot_clay' WHERE id='$event_id'") or die(mysql_error());
            mysql_query("UPDATE events SET iron='$attacker_loot_iron' WHERE id='$event_id'") or die(mysql_error());
            mysql_query("UPDATE events SET wheat='$attacker_loot_wheat' WHERE id='$event_id'") or die(mysql_error());
            mysql_query("UPDATE events SET returning=1 WHERE id='$event_id'") or die(mysql_error());
        }else{

            //BUG? DELETE EVENT?
        }


        $topic = $sender_name . " attacks " . $target_village_name;

        if ($winner == "Attacker") {
            $winner_player = $sender_name;
        } else {
            $winner_player = $target_name;
        }

        $defender_die_clubswinger = $defender_old_clubswinger - $defender_new_clubswinger;
        $defender_die_spearman = $defender_old_spearman - $defender_new_spearman;
        $defender_die_axeman = $defender_old_axeman - $defender_new_axeman;
        $defender_die_scouthorse = $defender_old_scouthorse - $defender_new_scouthorse;
        $defender_die_knighthorse = $defender_old_knighthorse - $defender_new_knighthorse;
        $defender_die_warhorse = $defender_old_warhorse - $defender_new_warhorse;


        $attacker_die_clubswinger = $send_clubswinger - $attacker_new_clubswinger;
        $attacker_die_spearman = $send_spearman - $attacker_new_spearman;
        $attacker_die_axeman = $send_axeman - $attacker_new_axeman;
        $attacker_die_scouthorse = $send_scouthorse - $attacker_new_scouthorse;
        $attacker_die_knighthorse = $send_knighthorse - $attacker_new_knighthorse;
        $attacker_die_warhorse = $send_warhorse - $attacker_new_warhorse;


        $defender_and_city = $target_name . " from the village " . $target_village_name;
        $attacker_and_city = $sender_name . " from the village " . $from_village_name;

        $time_now = date("Y-m-d H:i:s");

        mysql_query("INSERT INTO reports (player_id,topic,winner,Attacker,Defender,clubswinger_att,spearman_att,axeman_att,clubswinger_def,spearman_def,axeman_def,clubswinger_att_die,spearman_att_die,axeman_att_die,clubswinger_def_die,spearman_def_die,axeman_def_die,
                                                scouthorse_att,knighthorse_att,warhorse_att,scouthorse_def,knighthorse_def,warhorse_def,scouthorse_att_die,knighthorse_att_die,warhorse_att_die,scouthorse_def_die,knighthorse_def_die,warhorse_def_die,loot_wood,loot_clay,loot_iron,loot_wheat,time,is_read,type)
                            VALUES ('$sender_id','$topic','$winner_player','$attacker_and_city','$defender_and_city','$send_clubswinger','$send_spearman','$send_axeman','$defender_old_clubswinger','$defender_old_spearman','$defender_old_axeman','$attacker_die_clubswinger','$attacker_die_spearman','$attacker_die_axeman','$defender_die_clubswinger','$defender_die_spearman','$defender_die_axeman',
                            '$send_scouthorse','$send_knighthorse','$send_warhorse','$defender_old_scouthorse','$defender_old_knighthorse','$defender_old_warhorse','$attacker_die_scouthorse','$attacker_die_knighthorse','$attacker_die_warhorse','$defender_die_scouthorse','$defender_die_knighthorse','$defender_die_warhorse','$attacker_loot_wood','$attacker_loot_clay','$attacker_loot_iron','$attacker_loot_wheat','$time_now',0,'$type')") or die(mysql_error());

        mysql_query("INSERT INTO reports (player_id,topic,winner,Attacker,Defender,clubswinger_att,spearman_att,axeman_att,clubswinger_def,spearman_def,axeman_def,clubswinger_att_die,spearman_att_die,axeman_att_die,clubswinger_def_die,spearman_def_die,axeman_def_die,
                                                scouthorse_att,knighthorse_att,warhorse_att,scouthorse_def,knighthorse_def,warhorse_def,scouthorse_att_die,knighthorse_att_die,warhorse_att_die,scouthorse_def_die,knighthorse_def_die,warhorse_def_die,loot_wood,loot_clay,loot_iron,loot_wheat,time,is_read,type)
                            VALUES ('$target','$topic','$winner_player','$attacker_and_city','$defender_and_city','$send_clubswinger','$send_spearman','$send_axeman','$defender_old_clubswinger','$defender_old_spearman','$defender_old_axeman','$attacker_die_clubswinger','$attacker_die_spearman','$attacker_die_axeman','$defender_die_clubswinger','$defender_die_spearman','$defender_die_axeman',
                            '$send_scouthorse','$send_knighthorse','$send_warhorse','$defender_old_scouthorse','$defender_old_knighthorse','$defender_old_warhorse','$attacker_die_scouthorse','$attacker_die_knighthorse','$attacker_die_warhorse','$defender_die_scouthorse','$defender_die_knighthorse','$defender_die_warhorse','$attacker_loot_wood','$attacker_loot_clay','$attacker_loot_iron','$attacker_loot_wheat','$time_now',0,'$type')") or die(mysql_error());
    }
    /*
    RETURNING ATTACKS
    CHECKS FOR FALSE POSITIVE; IF AN EVENT CHANGED STATUS
    ONLY JUST TO RETURNING
    */
    if ($type == "attack" and $returning == 1 and strtotime($return_completed) < strtotime(date("Y-m-d H:i:s"))) {

        $result = mysql_query("SELECT * FROM map WHERE village_id='$from_village_id'");
        while ($row = mysql_fetch_assoc($result)) {
            $village_clubswinger = $row["clubswinger"];
            $village_spearman = $row["spearman"];
            $village_axeman = $row["axeman"];
            $village_scouthorse = $row["scouthorse"];
            $village_knighthorse = $row["knighthorse"];
            $village_warhorse = $row["warhorse"];
        }
        $result = mysql_query("SELECT * FROM events WHERE id='$event_id'");
        while ($row = mysql_fetch_assoc($result)) {
            $returning_clubswinger = $row["clubswinger"];
            $returning_spearman = $row["spearman"];
            $returning_axeman = $row["axeman"];
            $returning_scouthorse = $row["scouthorse"];
            $returning_knighthorse = $row["knighthorse"];
            $returning_warhorse = $row["warhorse"];
            $loot_wood = $row["wood"];
            $loot_clay = $row["wood"];
            $loot_iron = $row["wood"];
            $loot_wheat = $row["wood"];

        }
        $result = mysql_query("SELECT * FROM map WHERE village_id='$from_village_id'");
        while ($row = mysql_fetch_assoc($result)) {
            $village_wood = $row["wood"];
            $village_clay = $row["clay"];
            $village_iron = $row["iron"];
            $village_wheat = $row["wheat"];
        }


        $new_wood = $village_wood + $loot_wood;
        $new_clay = $village_clay + $loot_clay;
        $new_iron = $village_iron + $loot_iron;
        $new_wheat = $village_wheat + $loot_wheat;

        $new_clubswinger = $returning_clubswinger + $village_clubswinger;
        $new_spearman = $returning_spearman + $village_spearman;
        $new_axeman = $village_axeman + $returning_axeman;
        $new_scouthorse = $returning_scouthorse + $village_scouthorse;
        $new_knighthorse = $returning_knighthorse + $village_knighthorse;
        $new_warhorse = $village_warhorse + $returning_warhorse;

        mysql_query("UPDATE map SET wood='$new_wood' WHERE village_id='$from_village_id'") or die(mysql_error());
        mysql_query("UPDATE map SET clay='$new_clay' WHERE village_id='$from_village_id'") or die(mysql_error());
        mysql_query("UPDATE map SET iron='$new_iron' WHERE village_id='$from_village_id'") or die(mysql_error());
        mysql_query("UPDATE map SET wheat='$new_wheat' WHERE village_id='$from_village_id'") or die(mysql_error());

        mysql_query("UPDATE map SET clubswinger='$new_clubswinger' WHERE village_id='$from_village_id'") or die(mysql_error());
        mysql_query("UPDATE map SET spearman='$new_spearman' WHERE village_id='$from_village_id'") or die(mysql_error());
        mysql_query("UPDATE map SET axeman='$new_axeman' WHERE village_id='$from_village_id'") or die(mysql_error());
        mysql_query("UPDATE map SET scouthorse='$new_scouthorse' WHERE village_id='$from_village_id'") or die(mysql_error());
        mysql_query("UPDATE map SET knighthorse='$new_knighthorse' WHERE village_id='$from_village_id'") or die(mysql_error());
        mysql_query("UPDATE map SET warhorse='$new_warhorse' WHERE village_id='$from_village_id'") or die(mysql_error());
        mysql_query("DELETE FROM events WHERE id='$event_id'") or die(mysql_error());
    }


    if($type == "reinforce"){

        $result = mysql_query("SELECT * FROM map WHERE village_id='$target_village'");
        while ($row = mysql_fetch_assoc($result)) {
            $village_clubswinger = $row["clubswinger"];
            $village_spearman = $row["spearman"];
            $village_axeman = $row["axeman"];
            $village_scouthorse = $row["scouthorse"];
            $village_knighthorse = $row["knighthorse"];
            $village_warhorse = $row["warhorse"];
        }

        $result = mysql_query("SELECT * FROM events WHERE id='$event_id'");
        while ($row = mysql_fetch_assoc($result)) {
            $reinforcement_clubswinger = $row["clubswinger"];
            $reinforcement_spearman = $row["spearman"];
            $reinforcement_axeman = $row["axeman"];
            $reinforcement_scouthorse = $row["scouthorse"];
            $reinforcement_knighthorse = $row["knighthorse"];
            $reinforcement_warhorse = $row["warhorse"];
        }

        $new_clubswinger = $reinforcement_clubswinger + $village_clubswinger;
        $new_spearman = $reinforcement_spearman + $village_spearman;
        $new_axeman = $village_axeman + $reinforcement_axeman;
        $new_scouthorse = $reinforcement_scouthorse + $village_scouthorse;
        $new_knighthorse = $reinforcement_knighthorse + $village_knighthorse;
        $new_warhorse = $village_warhorse + $reinforcement_warhorse;

        mysql_query("UPDATE map SET clubswinger='$new_clubswinger' WHERE village_id='$target_village'") or die(mysql_error());
        mysql_query("UPDATE map SET spearman='$new_spearman' WHERE village_id='$target_village'") or die(mysql_error());
        mysql_query("UPDATE map SET axeman='$new_axeman' WHERE village_id='$target_village'") or die(mysql_error());
        mysql_query("UPDATE map SET scouthorse='$new_scouthorse' WHERE village_id='$target_village'") or die(mysql_error());
        mysql_query("UPDATE map SET knighthorse='$new_knighthorse' WHERE village_id='$target_village'") or die(mysql_error());
        mysql_query("UPDATE map SET warhorse='$new_warhorse' WHERE village_id='$target_village'") or die(mysql_error());

        mysql_query("DELETE FROM events WHERE id='$event_id'") or die(mysql_error());
    }

    $x = $x - 1;
}
?>


<!--
THIS THING INDEXES EVENTS FOR THE PLAYER
TODO: ADD SETTLERS TO THIS PLACE
-->
<?php
//COUNTS THE AMOUNT OF EVENTS AND WHILES IT AS MANY TIMES AS THERE ARE EVENTS
$result = mysql_query("SELECT * FROM events WHERE village_id='$current_village_id' OR target_village='$current_village_id'");
$number_of_rows = mysql_num_rows($result);
$x = $number_of_rows;

while ($x > 0) {
    $xminus = $x - 1;
    $result = mysql_query("SELECT * FROM events WHERE village_id='$current_village_id' OR target_village='$current_village_id' LIMIT $xminus,1") or die(mysql_error());
    /*
    EVENT MYSQL STUFF
    */
    {
        while ($row = mysql_fetch_assoc($result)) {
            $type = $row["type"];
            $completed = $row["completed"];
            $building = $row["building"];
            $nextlevel = $row["nextlevel"];
            $event_id = $row["id"];
            $amount = $row["amount"];
            $troop_type = $row["troop_type"];
            $send_wood = $row["wood"];
            $send_clay = $row["clay"];
            $send_iron = $row["iron"];
            $send_wheat = $row["wheat"];
            $send_clubswinger = $row["clubswinger"];
            $send_spearman = $row["spearman"];
            $send_axeman = $row["axeman"];
            $target = $row["target"];
            $sender_id = $row["userid"];
            $target_village = $row["target_village"];
            $from_village_id = $row["village_id"];
            $return_completed = $row["return_completed"];
            $returning = $row["returning"];
        }
        $result = mysql_query("SELECT * FROM members WHERE id='$target'") or die(mysql_error());
        while ($row = mysql_fetch_assoc($result)) {
            $target_name = $row["username"];
        }
        $result = mysql_query("SELECT * FROM map WHERE village_id='$target_village'") or die(mysql_error());
        while ($row = mysql_fetch_assoc($result)) {
            $target_village_name = $row["village"];
        }
        $result = mysql_query("SELECT * FROM map WHERE village_id='$from_village_id'") or die(mysql_error());
        while ($row = mysql_fetch_assoc($result)) {
            $from_village_name = $row["village"];
        }
        $result = mysql_query("SELECT * FROM members WHERE id='$sender_id'") or die(mysql_error());
        while ($row = mysql_fetch_assoc($result)) {
            $sender_name = $row["username"];
        }
    }

    $strodate = strtotime(date("Y-m-d H:i:s"));
    $strocompleted = strtotime($completed);
    $stro_return_completed = strtotime($return_completed);


    if (($strodate < $strocompleted and $returning == 0) or ($returning == 1 and $strodate < $stro_return_completed)) {
        /*
        CONSTRUCTING A BUILDING
        */
        if ($type == "building") {
            $event_ids[$event_id] = $event_id;
            $timer_building[$event_id] = $building;
            $timer_level[$event_id] = $nextlevel;
            $timer_stro_completed[$event_id] = $strocompleted;
            $timer_completed[$event_id] = $completed;
            $timer_village_id[$event_id] = $current_village_id;
        }
        /*
        TROOPS
        */
        if ($type == "troops") {
            $troop_event_ids[$event_id] = $event_id;
            $troop_timer_unit[$event_id] = $troop_type;
            $troop_timer_amount[$event_id] = $amount;
            $troop_timer_stro_completed[$event_id] = $strocompleted;
            $troop_timer_completed[$event_id] = $completed;
            $troop_timer_village_id[$event_id] = $current_village_id;
        }
        /*
        INCOMING RESOURCES
        */
        if ($type == "sendres" and $target_village == $current_village_id and $from_village_id != $current_village_id and $returning != 1) {
            $sendres_event_ids_in[$event_id] = $event_id;
            $sendres_target[$event_id] = $target;
            $sendres_timer_target_name[$event_id] = $target_name;
            $sendres_timer_stro_completed_in[$event_id] = $strocompleted;
            $sendres_timer_send_wood[$event_id] = $send_wood;
            $sendres_timer_send_clay[$event_id] = $send_clay;
            $sendres_timer_send_iron[$event_id] = $send_iron;
            $sendres_timer_send_wheat[$event_id] = $send_wheat;
            $sendres_timer_village_name[$event_id] = $from_village_name;
            $sendres_timer_justshow[$event_id] = false;
            $sendres_timer_completed[$event_id] = $completed;
            $sendres_timer_sender_id[$event_id] = $sender_id;
            $sendres_timer_sender_name[$event_id] = $sender_name;
            $sendres_timer_village_id[$event_id] = $current_village_id;
        }
        /*
        OUTGOING RESOURCES
        */
        if ($type == "sendres" and $target_village != $current_village_id and $from_village_id == $current_village_id and $returning != 1) {
            $sendres_event_ids_out[$event_id] = $event_id;
            $sendres_timer_target[$event_id] = $target;
            $sendres_timer_target_name[$event_id] = $target_name;
            $sendres_timer_village_name[$event_id] = $target_village_name;
            $sendres_timer_stro_completed_out[$event_id] = $strocompleted;
            $sendres_timer_send_wood[$event_id] = $send_wood;
            $sendres_timer_send_clay[$event_id] = $send_clay;
            $sendres_timer_send_iron[$event_id] = $send_iron;
            $sendres_timer_send_wheat[$event_id] = $send_wheat;
            $sendres_timer_justshow[$event_id] = true;
            $sendres_timer_ready_status[$event_id] = $out_ready;
            $sendres_timer_completed[$event_id] = $completed;
        }
        /*
        IF RETURNING SHIPMENT
        */
        if ($type == "sendres" and $target_village != $current_village_id and $from_village_id == $current_village_id and $returning == 1) {

            $sendres_event_ids_return[$event_id] = $event_id;
            $sendres_timer_target[$event_id] = $target;
            $sendres_timer_ready_status[$event_id] = $ready;
            $sendres_timer_stro_completed_return[$event_id] = $stro_return_completed;
            $sendres_timer_return_completed[$event_id] = $return_completed;
            $sendres_timer_target_village[$event_id] = $target_village;
            $sendres_timer_village_name[$event_id] = $target_village_name;
        }
        /*
        INCOMING ATTACKS
        */
        if ($type == "attack" and $target_village == $current_village_id and $from_village_id != $current_village_id and $returning != 1) {
            $attack_event_ids_in[$event_id] = $event_id;
            $attack_target[$event_id] = $target;
            $attack_timer_target_name[$event_id] = $target_name;
            $attack_timer_stro_completed_in[$event_id] = $strocompleted;
            $attack_timer_send_clubswinger[$event_id] = $send_clubswinger;
            $attack_timer_send_spearman[$event_id] = $send_spearman;
            $attack_timer_send_axeman[$event_id] = $send_axeman;
            $attack_timer_village_name[$event_id] = $from_village_name;
            $attack_timer_justshow[$event_id] = false;
            $attack_timer_completed[$event_id] = $completed;
            $attack_timer_sender_id[$event_id] = $sender_id;
            $attack_timer_sender_name[$event_id] = $sender_name;
            $attack_timer_village_id[$event_id] = $current_village_id;
        }
        /*
        OUTGOING ATTACKS
        */
        if ($type == "attack" and $target_village != $current_village_id and $from_village_id == $current_village_id and $returning != 1) {
            $attack_event_ids_out[$event_id] = $event_id;
            $attack_timer_target[$event_id] = $target;
            $attack_timer_target_name[$event_id] = $target_name;
            $attack_timer_village_name[$event_id] = $target_village_name;
            $attack_timer_stro_completed_out[$event_id] = $strocompleted;
            $attack_timer_send_wood[$event_id] = $send_wood;
            $attack_timer_send_clay[$event_id] = $send_clay;
            $attack_timer_send_iron[$event_id] = $send_iron;
            $attack_timer_send_wheat[$event_id] = $send_wheat;
            $attack_timer_justshow[$event_id] = true;
            $attack_timer_ready_status[$event_id] = $out_ready;
            $attack_timer_completed[$event_id] = $completed;
        }
        /*
        RETURNING ATTACKS
        */
        if ($type == "attack" and $target_village != $current_village_id and $from_village_id == $current_village_id and $returning == 1) {
            $attack_event_ids_return[$event_id] = $event_id;
            $attack_timer_target[$event_id] = $target;
            $attack_timer_ready_status[$event_id] = $ready;
            $attack_timer_stro_completed_return[$event_id] = $stro_return_completed;
            $attack_timer_return_completed[$event_id] = $return_completed;
            $attack_timer_target_village[$event_id] = $target_village;
            $attack_timer_village_name[$event_id] = $target_village_name;
        }

        /*
        INCOMING REINFORCEMENT
        */
        if ($type == "reinforce" and $target_village == $current_village_id and $returning != 1) {
            $reinforce_event_ids_in[$event_id] = $event_id;
            $reinforce_target[$event_id] = $target;
            $reinforce_timer_target_name[$event_id] = $target_name;
            $reinforce_timer_stro_completed_in[$event_id] = $strocompleted;
            $reinforce_timer_send_clubswinger[$event_id] = $send_clubswinger;
            $reinforce_timer_send_spearman[$event_id] = $send_spearman;
            $reinforce_timer_send_axeman[$event_id] = $send_axeman;
            $reinforce_timer_village_name[$event_id] = $from_village_name;
            $reinforce_timer_justshow[$event_id] = false;
            $reinforce_timer_completed[$event_id] = $completed;
            $reinforce_timer_sender_id[$event_id] = $sender_id;
            $reinforce_timer_sender_name[$event_id] = $sender_name;
            $reinforce_timer_village_id[$event_id] = $current_village_id;
        }
        /*
        OUTGOING REINFORCEMENT
        */
        if ($type == "reinforce" and $from_village_id == $current_village_id and $returning != 1) {
            $reinforce_event_ids_out[$event_id] = $event_id;
            $reinforce_timer_target[$event_id] = $target;
            $reinforce_timer_target_name[$event_id] = $target_name;
            $reinforce_timer_village_name[$event_id] = $target_village_name;
            $reinforce_timer_stro_completed_out[$event_id] = $strocompleted;
            $reinforce_timer_send_wood[$event_id] = $send_wood;
            $reinforce_timer_send_clay[$event_id] = $send_clay;
            $reinforce_timer_send_iron[$event_id] = $send_iron;
            $reinforce_timer_send_wheat[$event_id] = $send_wheat;
            $reinforce_timer_justshow[$event_id] = true;
            $reinforce_timer_ready_status[$event_id] = $out_ready;
            $reinforce_timer_completed[$event_id] = $completed;
        }
        /*
        SETTLERS
        */
        if ($type == "settle" and $from_village_id == $current_village_id) {
            $settle_event_ids_out[$event_id] = $event_id;
            $settle_timer_target[$event_id] = $target;
            $settle_timer_target_name[$event_id] = $target_name;
            $settle_timer_village_name[$event_id] = $target_village_name;
            $settle_timer_stro_completed_out[$event_id] = $strocompleted;
            $settle_timer_send_wood[$event_id] = $send_wood;
            $settle_timer_send_clay[$event_id] = $send_clay;
            $settle_timer_send_iron[$event_id] = $send_iron;
            $settle_timer_send_wheat[$event_id] = $send_wheat;
            $settle_timer_justshow[$event_id] = true;
            $settle_timer_ready_status[$event_id] = $out_ready;
            $settle_timer_completed[$event_id] = $completed;
        }
    }
    $x = $x - 1;
}//ONE EVENT LOOP END


/*
VARIABLES FOR SIDEBARSANDFOOTER.php & TIMERS IN BUILDINGS (TIMERS)
*/
{
    //SENDRES
    $sendres_timer_event_amount_in = count($sendres_event_ids_in);
    $sendres_timer_event_amount_out = count($sendres_event_ids_out);
    $sendres_timer_event_min_time_id_in = array_search(min($sendres_timer_stro_completed_in), $sendres_timer_stro_completed_in);
    $sendres_timer_event_min_time_id_out = array_search(min($sendres_timer_stro_completed_out), $sendres_timer_stro_completed_out);

    //ATTACK
    $attack_timer_event_amount_in = count($attack_event_ids_in);
    $attack_timer_event_amount_out = count($attack_event_ids_out);
    $attack_timer_event_min_time_id_in = array_search(min($attack_timer_stro_completed_in), $attack_timer_stro_completed_in);
    $attack_timer_event_min_time_id_out = array_search(min($attack_timer_stro_completed_out), $attack_timer_stro_completed_out);

    //SETTLE
    $settle_timer_event_amount_out = count($settle_event_ids_out);
    $settle_timer_event_min_time_id_out = array_search(min($settle_timer_stro_completed_out), $settle_timer_stro_completed_out);

    //REINFORCE
    $reinforce_timer_event_amount_in = count($reinforce_event_ids_in);
    $reinforce_timer_event_amount_out = count($reinforce_event_ids_out);
    $reinforce_timer_event_min_time_id_in = array_search(min($reinforce_timer_stro_completed_in), $reinforce_timer_stro_completed_in);
    $reinforce_timer_event_min_time_id_out = array_search(min($reinforce_timer_stro_completed_out), $reinforce_timer_stro_completed_out);

    //TROOP TRAIN
    $troop_timer_event_amount = count($troop_event_ids);
    $troop_timer_event_min_time_id = array_search(min($troop_timer_stro_completed), $troop_timer_stro_completed);

    //RETURNING SENDRES
    $returning_sendres_timer_event_amount = count($sendres_event_ids_return);
    $returning_sendres_timer_event_min_time_id = array_search(min($sendres_timer_stro_completed_return), $sendres_timer_stro_completed_return);

    //RETURNING ATTACK
    $returning_attack_timer_event_amount = count($attack_event_ids_return);
    $returning_attack_timer_event_min_time_id = array_search(min($attack_timer_stro_completed_return), $attack_timer_stro_completed_return);
}

/*
SEND EVERYTHING TO MYSQL
*/
{
    $result = mysql_query("SELECT * FROM map WHERE player_id='$id' and village_id='$current_village_id'");
    while ($row = mysql_fetch_assoc($result)) {
        $clubswinger = $row["clubswinger"];
        $spearman = $row["spearman"];
        $axeman = $row["axeman"];
    }
    $result = mysql_query("SELECT * FROM map WHERE id='$id' and village_id='$current_village_id'");
    while ($row = mysql_fetch_assoc($result)) {
        $woodcutter1 = $row["woodcutter1"];
        $woodcutter2 = $row["woodcutter2"];
        $woodcutter3 = $row["woodcutter3"];
        $woodcutter4 = $row["woodcutter4"];

        $claypit1 = $row["claypit1"];
        $claypit2 = $row["claypit2"];
        $claypit3 = $row["claypit3"];
        $claypit4 = $row["claypit4"];

        $ironmine1 = $row["ironmine1"];
        $ironmine2 = $row["ironmine2"];
        $ironmine3 = $row["ironmine3"];
        $ironmine4 = $row["ironmine4"];

        $cropland1 = $row["cropland1"];
        $cropland2 = $row["cropland2"];
        $cropland3 = $row["cropland3"];
        $cropland4 = $row["cropland4"];
        $cropland5 = $row["cropland5"];
        $cropland6 = $row["cropland6"];

        $mainbuilding = $row["mainbuilding"];
        $storage = $row["storage"];
        $barracks = $row["barracks"];
        $marketplace = $row["marketplace"];
        $wall = $row["wall"];

        $wood = $row["wood"];
        $clay = $row["clay"];
        $iron = $row["iron"];
        $wheat = $row["wheat"];
    }
}

?>