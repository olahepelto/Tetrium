<?php
session_start();
include_once("configuration/databasecredentials.php");

$id = $_SESSION["varid"]; // Id
$current_village_id = $_SESSION["current_village_id"];


$connection = mysql_connect($host, $username, $password) or die (mysql_error());
$sqlerror = mysql_error();

mysql_select_db($db_name, $connection) or die (mysql_error());


include "executables/game_engine.php";
print_debug(1); ?>
<script>document.getElementById('spoiler_id').style.display = '';
    document.getElementById('show_id').style.display = 'none';</script>