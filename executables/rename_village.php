
<?php
include "../includes/databasedetails.php";

$new_name = $_GET['newname'];
if (isset($current_village_id) && isset($new_name)) {
  mysql_query("UPDATE map SET village='$new_name' WHERE village_id='$current_village_id'");
}
header("location:../tetrium.php?p=res")
?>