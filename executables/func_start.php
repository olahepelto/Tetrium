<?php

include_once "../includes/databasedetails.php";
include_once "game_engine.php";

if ($_GET["type"] == "train") {

    $village_id = $current_village_id;
    $player_id = $id;

    train($_GET["troop_type"], $_GET["train_amount"], $village_id, $player_id);
}
if (isset($_GET["building"])) {
    upgrade($_GET["building"], $current_village_id, $id);
}
if (isset($_GET["switch_id"])) {
    $village_id = $current_village_id;
    $player_id = $id;

    switch_village($_GET["switch_id"], $player_id);
}
if ($_GET["type"] == "attack") {

    $village_id = $current_village_id;
    $player_id = $id;

    if ($_GET["x"] != "" and $_GET["y"] != "") {
        $x = $_GET["x"];
        $y = $_GET["y"];
        $result = mysql_query("SELECT * FROM map where x='$x' and y='$y'") or die(mysql_error());
        if (mysql_num_rows($result) != 0) {
            while ($info = mysql_fetch_array($result)) {
                $target_village_id = $info["village_id"];
            }
        }
    } elseif ($_GET["village"] != "") {
        $rec_village = $_GET["village"];
        $result = mysql_query("SELECT * FROM map where village='$rec_village'") or die(mysql_error());
        if (mysql_num_rows($result) != 0) {
            while ($info = mysql_fetch_array($result)) {
                $target_village_id = $info["village_id"];
            }
        }
    } else {
        echo "ERROR";
    }

    $troops = array("clubswinger" => $_GET["clubswinger"], "spearman" => $_GET["spearman"], "axeman" => $_GET["axeman"]);
    attack($village_id, $target_village_id, $troops, $player_id);
}
if ($_GET["type"] == "speedup" AND isset($_GET["event_id"])) {
    echo speedup($_GET["event_id"]);
}
if ($_GET["type"] == "cpass" AND isset($_GET["user"]) AND isset($_GET["pass"])) {
    change_pass($_GET["user"], $_GET["pass"]);
}
if (isset($_GET["give_wood"]) AND isset($_GET["give_wood"]) AND isset($_GET["give_wood"]) AND isset($_GET["give_wood"]) AND isset($_GET["wantresource"])) {

    $village_id = $current_village_id;
    $player_id = $id;

    market_action($village_id, $_GET["give_wood"], $_GET["give_clay"], $_GET["give_iron"], $_GET["give_wheat"], $_GET["wantresource"]);
}
if ($_GET["type"] == "logout") {
    logout();
}
if ($_GET["type"] == "del_rep") {
    if (!isset($_GET["rep_id"])) {
        echo 'ERROR: rep id not set or invalid';
    }
    $result = mysql_query("SELECT * FROM reports WHERE report_id='$report_id' AND id='$id'");
    if (mysql_num_rows($result) == 1) {
        del_report($_GET["rep_id"]);
    } else {
        echo "ERROR: rep id not found or multiple exist";
    }
}
if ($_GET["type"] == "send_mail") {
    if (isset($_POST["receiver"]) AND $_POST["topic"])
        $sender = $id;
    $receiver = $_POST["receiver"];
    $topic = $_POST["subject"];
    $mail = $_POST["message"];

    $result = mysql_query("SELECT * FROM members WHERE username='$receiver'");
    while ($row = mysql_fetch_assoc($result)) {
        $receiver = $row["id"];
    }

    if (strlen($mail) > 255 or strlen($topic) > 255) {
        echo "ERROR: message or topic too long";
    }

    send_mail($sender, $receiver, $topic, $mail);
}
if ($_GET["type"] == "nature_reproduce") {
    if (!isset($_GET["village_id"])) {
        echo 'ERROR: village_id not set or invalid';
    }

    $nature_village = mysql_query("SELECT * FROM map WHERE id='$village_id'");

    if (mysql_num_rows($nature_village) == 1) {
        make_nature($_GET["village_id"]);
    } else {
        echo "ERROR: village_id not found or multiple exist";
    }
}
if ($_GET["type"] == "debug_data") {
    if ((empty($_GET["x"]) or empty($_GET["y"])) and empty($_GET["vname"])) {
        echo 'ERROR: WHAT ARE YOU DOING MATE!!!!';
        exit;
    }
    if (!empty($_GET["x"]) AND !empty($_GET["y"])) {
        $_GET["vname"] = NULL;
    }
    $vid = get_village_id($_GET["x"], $_GET["y"], $_GET["vname"]);
    $str = "location: ../tetrium.php?p=res&show_debug=1&debug_vid=" . $vid;
    header($str);
    exit;
}
if ($_GET["type"] == "debug_popup") {
    if ((empty($_GET["x"]) or empty($_GET["y"])) and empty($_GET["vname"])) {
        echo 'ERROR: WHAT ARE YOU DOING MATE!!!!';
        exit;
    }
    if (!empty($_GET["x"]) AND !empty($_GET["y"])) {
        $_GET["vname"] = NULL;
    }
    $vid = get_village_id($_GET["x"], $_GET["y"], $_GET["vname"]);
    $str = "location: ../Debug_popup.php?debug_vid=" . $vid;
    header($str);
    exit;
}
if ($_GET["type"] == "rename_village") {
    if ((empty($_GET["village_id"]) or empty($_GET["new_name"]))) {
        echo 'ERROR: WHAT ARE YOU DOING MATE!!!!';
        exit;
    }
    set_village_name($GET["village_id"], $GET["new_name"]);
}