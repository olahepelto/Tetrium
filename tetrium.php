<?php
date_default_timezone_set("UTC");

include "includes/databasedetails.php";
include "executables/start_logic.php";
?>
<html>
<head>
    <title>Tetrium</title>
    <link rel="stylesheet" href="style/tetriumstyle.css" type="text/css" media="screen, projection"/>
</head>
<body>
<center>
    <div id="wrapper">
        <?php include("includes/tetriumheader.php") ?>

        <div id="middle">
            <div id="container">
                <div id="content" style="padding-top: 20px;">

                    <?php
                    switch ($_GET["p"]) {
                        case "adm":
                            $page = "admin";
                            break;
                        case "att":
                            $page = "attack";
                            break;
                        case "map":
                            $page = "map";
                            break;
                        case "mpv":
                            $page = "mapvillage";
                            break;
                        case "msg":
                            $page = "messages";
                            break;
                        case "mis":
                            $page = "missions";
                            break;
                        case "rep":
                            $page = "reports";
                            break;
                        case "res":
                            $page = "resourcefields";
                            break;
                        case "srs":
                            $page = "send_resources";
                            break;
                        case "smg":
                            $page = "sendmailgui";
                            break;
                        case "sts":
                            $page = "stats";
                            break;
                        case "ugg":
                            $page = "upgradegui";
                            break;

                        case "vre":
                            $page = "viewreport";
                            break;

                        default:
                            $page = "page_error";
                            break;
                    }

                    include "pages/" . $page . ".php"; ?>
                    <br><br><br><br><br>
                    <?php include "includes/buildingtimer.php"; ?>

                </div><!-- #content-->
            </div><!-- #container-->
            <?php include("includes/tetriumsidebarsandfooter.php"); ?>

        </div>
</center>
<?php if (isset($_GET["newvillagename"]) and !$_GET["newvillagename"] == "") {
    $newvillagename = $_GET["newvillagename"];
    mysql_query("UPDATE map SET village='$newvillagename' WHERE village_id='$current_village_id'");
    $url = $_SERVER['REQUEST_URI'];
    $url = strtok($url, '?');
    header("Location: " . $url);
}
include("includes/tetriumjavascript.php"); ?>
</body>
</html>
