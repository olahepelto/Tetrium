<?php
//Check if admin
include "../includes/databasedetails.php";
if ($_SESSION['varadmin'] == 0) {
    header("location:../tetrium.php?p=res&message=you are not an admin :(");
    exit;
}

if (isset($_GET["login"])) {
    $login = $_GET["login"];
    $result = mysql_query("SELECT * FROM members WHERE id = '$login';");
    //from here

    while ($row = mysql_fetch_assoc($result)) {
        $varid = $row["id"];
        $varusername = $row["username"];
        $varpassword = $row["password"];
        $varadmin = $row["admin"];
    }

    $_SESSION["varadmin"] = $varadmin;
    $_SESSION["varusername"] = $varusername;
    $_SESSION["varpassword"] = $varpassword;
    $_SESSION["varid"] = $varid;
    header("location:../admin.php");
    exit;
}

$wood = $_GET['wood'];
$clay = $_GET["clay"];
$iron = $_GET["iron"];
$wheat = $_GET["wheat"];
$id = $_GET["edit"];
if (ctype_digit($wood) and ctype_digit($clay) and ctype_digit($iron) and ctype_digit($wheat)) {

    mysql_query("UPDATE map SET wood=$wood WHERE id='$id'");
    mysql_query("UPDATE map SET clay=$clay WHERE id='$id'");
    mysql_query("UPDATE map SET iron=$iron WHERE id='$id'");
    mysql_query("UPDATE map SET wheat=$wheat WHERE id='$id'");
    header("location: ../admin.php");
    exit;
} else {
    echo "Only numbers";

    ?><br><a href=../admin.php>Back</a>><?php }