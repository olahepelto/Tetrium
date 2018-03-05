<?php
print("The script is disabled by default, remove exit(); from file to run.");
exit();
include "../includes/databasedetails.php";
if ($_SESSION["varadmin"] != 1) {
    header("location: /tetrium.php");
    exit;
}
if ($_GET["iamcompletelysure"] != "yes") {
    echo("iamcompletelysure has to be 'yes'");
    exit;
}
if ($_GET["admin_pass"] == "") {
    echo("You have to enter ?admin_pass='something'");
    exit;
}

mysql_query("DELETE FROM events");
mysql_query("DELETE FROM map");
mysql_query("DELETE FROM members");
mysql_query("DELETE FROM messages");
mysql_query("DELETE FROM new_users");
mysql_query("DELETE FROM reports");

$hashedpassword = md5(md5($_GET["admin_pass"]."another salt").md5("hello_this_is_my_salt").$_GET["admin_pass"]);
mysql_query("INSERT INTO members (id, username, email, password) VALUES ('-1','nature', 'None', '$hashedpassword')") or die("Mysql Error!");
mysql_query("INSERT INTO members (id, username, email, password, admin) VALUES ('1', 'admin', 'None', '$hashedpassword', '1')") or die("Mysql Error!");

$id = 0;
for($y = 1; $y <= 16; $y++) {
    for ($x = 1; $x <= 16; $x++) {
        mysql_query("INSERT INTO tetrium.map (x, y, village, village_id, player, type, woodcutter1, woodcutter2, woodcutter3, woodcutter4, claypit1, claypit2,
              claypit3, claypit4, ironmine1, ironmine2,ironmine3, ironmine4, cropland1, cropland2, cropland3, cropland4, cropland5, cropland6, mainbuilding, storage,
              barracks, marketplace, stable, wall,wood, clay, iron, wheat, clubswinger, spearman,axeman, id, timestamp, last_attack)
              VALUES ('$x', '$y', 'Oasis', '$id', 'nature', -1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.0000000000, 0.0000000000, 0.0000000000, 0.0000000000, 0, 0, 0, '-1', '0', 0);");
        $id++;
    }
    $x = 1;
}



  /*
  ADD ADMIN VILLAGE
  */  

  $village_id = rand(0,250);
  $player_id = mysql_query("SELECT id FROM members WHERE username='admin' AND email='None' AND password='$hashedpassword'");
  while ($row = mysql_fetch_assoc($player_id)) {
        $player_id = $row["id"];
  }
  mysql_query("UPDATE map SET village = 'Admin village' WHERE village_id='$village_id'") or die(mysql_error());
  mysql_query("UPDATE map SET player = 'admin' WHERE village_id='$village_id'") or die(mysql_error());
  mysql_query("UPDATE map SET type = '1' WHERE village_id='$village_id'") or die(mysql_error());
  mysql_query("UPDATE map SET id = '1' WHERE village_id='$village_id'") or die(mysql_error());





echo("done! ".$x." ".$y." ".$id);
?>