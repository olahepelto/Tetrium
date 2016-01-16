<?php
include "../includes/databasedetails.php";
//Check if admin
if ($_SESSION['varadmin'] == 0) {
    header("location:../tetrium.php?p=res");
    exit;
}

if (isset($_GET["event_id"])) {
    $event_id = $_GET["event_id"];
    mysql_query("DELETE FROM events WHERE id='$event_id'");
} else {
    echo "ERROR";
}
header("location:../tetrium.php?p=res");
?>