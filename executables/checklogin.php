<?php
$notloggedin = true;
include "../includes/databasedetails.php";
$notloggedin = NULL;


$myusername = $_POST['myusername'];
$mypassword = $_POST['mypassword'];

//anti mysql injection
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);


//ALL THE DATABASE STUFF DOWN

$result = mysql_query("SELECT * FROM members WHERE username = '$myusername'");

//fetch stuff from database
while ($row = mysql_fetch_assoc($result)) {
    $varid = $row["id"];
    $varusername = $row["username"];
    $varpassword = $row["password"];
    $varadmin = $row["admin"];
}

if ($myusername == $varusername and md5($mypassword) == $varpassword) {

    $result = mysql_query("SELECT * FROM map WHERE id='$varid';");
    while ($row = mysql_fetch_assoc($result)) {
        $village_id = $row["village_id"];
    }

    $_SESSION["varid"] = $varid;
    $_SESSION["mypassword"] = $mypassword;
    $_SESSION["varadmin"] = $varadmin;
    $_SESSION["myusername"] = $myusername;
    $_SESSION["current_village_id"] = $village_id;

    header("location:../tetrium.php?p=res");
    exit;
} else {
    echo "Wrong Username or Password";
}
?>

<a href="../main_login.php">Try Again</a>