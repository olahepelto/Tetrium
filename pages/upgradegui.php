<?php
$building = $_GET["building"];

if (empty($building)) {
    header("location:tetrium.php?p=res");
    exit;
}



$message_array = array("Woodcutter" => "The woodcutter is an essential part of the village.<br>Upgrade your woodcutters to increase your wood production.",
    "Claypit" => "The claypit produces clay that is needed for many buildings.<br>Upgrade your clay pits to increase your clay production.",
    "Ironmine" => "The iron miners who work in dark caves produce iron.<br>Upgrade your iron mines to increase your iron production.",
    "Cropfield" => "This is where the farmers work in the sunlight all day.<br>Upgrade your croplands to increase your wheat production.",
    "Main Building" => "The main building is the heart of the village.<br>For every level upgraded building is 1% faster up to 20%.",
    "Storage" => "The warehouse/storage stores resources.<br>For every level upgraded it can store more resources.",
    "Barracks" => "You can train troops in the barracks.<br>For each level upgraded the barracks can train troops 1% faster up to 20%.<br>Upgrading the barracks also unlocks new troops.",
    "Marketplace" => "You can trade resources in the marketplace.<br>The effidency of trading depends on the level your marketplace.<br>It increases by 2% starting from 80%.",
    "Stable" => "Breed horses here!.",
    "Wall" => "It's a wall, not rocket science. A wall around your village! (or wherever you imagine it is)<br>It doesn't really do anything, but I'm sure it would look cool if we had a texture for it!<br>Also, you will probably feel safer even though you aren't.",
);

switch ($building) {
    case "woodcutter1":
        $level = $mysql_data["woodcutter1"];
        $name = "Woodcutter";
        break;
    case "woodcutter2":
        $level = $mysql_data["woodcutter2"];
        $name = "Woodcutter";
        break;
    case "woodcutter3":
        $level = $mysql_data["woodcutter3"];
        $name = "Woodcutter";
        break;
    case "woodcutter4":
        $level = $mysql_data["woodcutter4"];
        $name = "Woodcutter";
        break;
    case "claypit1":
        $level = $mysql_data["claypit1"];
        $name = "Claypit";
        break;
    case "claypit2":
        $level = $mysql_data["claypit2"];
        $name = "Claypit";
        break;
    case "claypit3":
        $level = $mysql_data["claypit3"];
        $name = "Claypit";
        break;
    case "claypit4":
        $level = $mysql_data["claypit4"];
        $name = "Claypit";
        break;
    case "ironmine1":
        $level = $mysql_data["ironmine1"];
        $name = "Ironmine";
        break;
    case "ironmine2":
        $level = $mysql_data["ironmine2"];
        $name = "Ironmine";
        break;
    case "ironmine3":
        $level = $mysql_data["ironmine3"];
        $name = "Ironmine";
        break;
    case "ironmine4":
        $level = $mysql_data["ironmine4"];
        $name = "Ironmine";
        break;
    case "cropland1":
        $level = $mysql_data["cropland1"];
        $name = "Cropland";
        break;
    case "cropland2":
        $level = $mysql_data["cropland2"];
        $name = "Cropland";
        break;
    case "cropland3":
        $level = $mysql_data["cropland3"];
        $name = "Cropland";
        break;
    case "cropland4":
        $level = $mysql_data["cropland4"];
        $name = "Cropland";
        break;
    case "cropland5":
        $level = $mysql_data["cropland5"];
        $name = "Cropland";
        break;
    case "cropland6":
        $level = $mysql_data["cropland6"];
        $name = "Cropland";
        break;
    case "mainbuilding":
        $level = $mysql_data["mainbuilding"];
        $name = "Main Building";
        break;
    case "storage":
        $level = $mysql_data["storage"];
        $name = "Storage";
        break;
    case "barracks":
        $level = $mysql_data["barracks"];
        $name = "Barracks";
        if ($mysql_data["mainbuilding"] >= 5) {
            $buildingreq = 1;
        } else {
            $buildingreq = 2;
            $buildingreqtext = "Build your main building to level 5 to build a barracks";
        }
        break;
    case "marketplace":
        $level = $mysql_data["marketplace"];
        $name = "Marketplace";
        if ($mysql_data["mainbuilding"] >= 7 and $mysql_data['storage'] >= 5) {
            $buildingreq = 1;
        } else {
            $buildingreq = 2;
            $buildingreqtext = "Build your main building to level 7 and your storage to level 5 to build a marketplace";
        }
        break;
    case "stable":
        $level = $mysql_data["stable"];
        $name = "Stable";
        if ($mysql_data["mainbuilding"] >= 7 and $mysql_data["barracks"] >= 5) {
            $buildingreq = 1;
        } else {
            $buildingreq = 2;
            $buildingreqtext = "Build your main building to level 7 and your barracks to level 5 to build a stable";
        }
        break;
    case "wall":
        $level = $mysql_data["wall"];
        $name = "Wall";
        if ($mysql_data["mainbuilding"] >= 3) {
            $buildingreq = 1;
        } else {
            $buildingreq = 2;
            $buildingreqtext = "Build your main building to level 3 to build a wall";
        }
        break;
    default:
        echo "error";
        exit;
        break;
}

$upgrade_count = mysql_query("SELECT * FROM events WHERE userid='$id' AND building='$building' AND village_id='$current_village_id'");
$upgrade_count = mysql_num_rows($upgrade_count);
if ($upgrade_count >= 1) {
    $upgrade_events_mysql_level = mysql_query("SELECT nextlevel FROM events WHERE userid='$id' AND building='$building' AND village_id='$current_village_id' ORDER BY nextlevel");
    while ($row = mysql_fetch_array($upgrade_events_mysql_level)) {
        $newlevel = $row['nextlevel'];
    }
    $newlevel = $newlevel + 1;
} else {
//ELSE CHECK VILLAGE LEVEL
    $newlevel = $level + 1;
}

$upgrade_changeling_var = 0;
$upgrade_count = mysql_query("SELECT * FROM events WHERE userid='$id' AND type='building' AND village_id='$current_village_id'");
$upgrade_many = mysql_num_rows($upgrade_count);

if ($upgrade_many > 0) {
    while ($row = mysql_fetch_array($upgrade_count)) {
        $upgrade_changeling_var = $upgrade_changeling_var + 1;
        $now = strtotime("now");
        $completed = $row['completed'];
        $completed_stamp = strtotime($completed);
        $seconds_left = $completed_stamp - $now;
        $upgrade_all_seconds_left[$upgrade_changeling_var] = $seconds_left;
    }
    $upgrade_all_seconds_left = array_slice($upgrade_all_seconds_left, -1, 1);
} else {
    $upgrade_all_seconds_left = 0;
}

//Production building upgrade cost
if ($name == "Woodcutter" or $name == "Claypit" or $name == "Ironmine" or $name == "Cropland") {
    $woodreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40));
    $clayreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40));
    $ironreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40));
    $wheatreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40));
    $timereq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 0.95);
    if ($name == "Woodcutter") {
        $woodreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 0.8);
    }
    if ($name == "Claypit") {
        $clayreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 0.8);
    }
    if ($name == "Ironmine") {
        $ironreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 0.8);
    }
    if ($name == "Cropland") {
        $wheatreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 0.8);
    }
}

if ($name == "Main Building") {
    $woodreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 0.7);
    $clayreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 0.8);
    $ironreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 0.5);
    $wheatreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 0.7);
    $timereq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 4.2);
}
if ($name == "Barracks") {
    $woodreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 1.1);
    $clayreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 1.1);
    $ironreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 0.8);
    $wheatreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 0.6);
    $timereq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 3.1);
}
if ($name == "Storage") {
    $woodreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 0.8);
    $clayreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 0.8);
    $ironreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 0.7);
    $wheatreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 0.4);
    $timereq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 2.6);
}
if ($name == "Marketplace") {
    $woodreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 0.9);
    $clayreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 0.9);
    $ironreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 1.15);
    $wheatreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 0.65);
    $timereq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 3.1);
}
if ($name == "Stable") {
    $woodreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 2);
    $clayreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 1.6);
    $ironreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 1.45);
    $wheatreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 2);
    $timereq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 2.8);
}
if ($name == "Wall") {
    $woodreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 1.55);
    $clayreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 2);
    $ironreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 2);
    $wheatreq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 1.2);
    $timereq = ceil(pow($newlevel + 5, 3 + $newlevel / 40) * 3.2);
}


$timereq_gui = $timereq;

$timereq = $timereq + $upgrade_all_seconds_left[0];
$completed = date("Y-m-d H:i:s", strtotime("$timereq_gui seconds"));

    $checky_checky_dwarf = mysql_query("SELECT * FROM events WHERE userid='$id' AND building='$building' AND village_id='$current_village_id'");
    while ($row = mysql_fetch_array($checky_checky_dwarf)) {
        $checky_checky_dwarf_2 = $row['nextlevel'];
        $checky_checky_dwarf_2_building = $row['building'];
    }

?><br><br><font size="5"><?php
    if ($checky_checky_dwarf_2_building == $building) {
        echo $name, " ", "level", " ", $level, " <img style='height: 30px; transform: rotate(90deg);' src=images/pil_upp.png> ", $checky_checky_dwarf_2; ?>
        <br><br><?php
    } else {
        echo $name, " ", "level", " ", $level; ?><br><br><?php
    } ?>
</font>
<font size="2">
    <img src="images/<?php echo $name; ?>.png"><br>
    <?php


    //Train Troops in Barracks
    if ($building == "barracks" and $barracks >= 1) {
        include("includes/barracks.php");
    } else {
        if ($building == "barracks") {
            echo "<br>Build your barracks to level 1 to train troops<br>";
        }
    }

    //Marketplace Trading
    if ($building == "marketplace" and $marketplace >= 1) {
        include("includes/marketplace.php");
    } else {
        if ($building == "marketplace") {
            echo "<br>Build your marketplace to level 1 to trade<br>";
        }
    }


    if ($level >= 1 or $buildingreq == 1 or empty($buildingreq)) {
        if($woodreq>$mysql_data["wood"]){echo "Wood: <font style='font-weight:bold;' color='red'>", $woodreq, "</font> ";}else{echo "Wood: <font style='font-weight:bold;' color='green'>", $woodreq, "</font> ";}
        if($clayreq>$mysql_data["clay"]){echo "Clay: <font style='font-weight:bold;' color='red'>", $clayreq, "</font> ";}else{echo "Clay: <font style='font-weight:bold;' color='green'>", $clayreq, "</font> ";}
        if($ironreq>$mysql_data["iron"]){echo "Iron: <font style='font-weight:bold;' color='red'>", $ironreq, "</font> ";}else{echo "Iron: <font style='font-weight:bold;' color='green'>", $ironreq, "</font> ";}
        if($wheatreq>$mysql_data["wheat"]){echo "Wheat: <font style='font-weight:bold;' color='red'>", $wheatreq, "</font> ";}else{echo "Wheat: <font style='font-weight:bold;' color='green'>", $wheatreq, "</font> ";}
        echo "Time:", gmdate("H:i:s", $timereq_gui), " ";
        echo "<br>Completed:",$completed;

        $all_upgrades_amount = mysql_query("SELECT * FROM events WHERE type='building' AND village_id='$current_village_id'");
        $all_upgrades_amount = mysql_num_rows($upgrade_count);
        if($all_upgrades_amount > 0){
            echo(" (Queue)");
        }



        if ($mysql_data["wood"] > $woodreq and $mysql_data["clay"] > $clayreq and $mysql_data["iron"] > $ironreq and $mysql_data["wheat"] > $wheatreq) {
            ?>
            <br>
        <a href="executables/func_start.php?building=<?php echo $building; ?>"><img width="65" height="22" src="images/upgradebtn.png"></a><?php
        } else {
            echo "<br>Can't upgrade right now, not enough resources.<br>";
        }
    } else {
        echo "<br>".$buildingreqtext;
    }
    ?>