<html>
<head>
    <link rel="stylesheet" href="style/tetriumstyle.css" type="text/css" media="screen, projection"/>
    <title>Tetrium Send Resources</title>
</head>
<body onfocus="onfocus()" onblur="onblur()">
<?php
//include database login and update resources
include "includes/databasedetails.php";
include "executables/start_logic.php";
?>

<!-- CSS GUI BEGINS -->
<center>
    <div id="wrapper">

        <!-- HEADER -->
        <?php include("includes/tetriumheader.php") ?>
        <!-- HEADER -->

        <div id="middle">
            <div id="container">
                <div id="content">


                    <div id="mapbox">
                        <br><br><br>

                        <?
                        /*-----------------------------------------
                        This is the Send resources function
                        -----------------------------------------*/
                        ?>


                        <form name=mail action=executables/sendres.php id=sendres method=GET>
                            Village_name: <input type=text id=village name=village><br>
                            X: <input type=text id=x name=x size=2 value=<?php echo $_GET["x"]; ?>> Y: <input type=text
                                                                                                              id=y
                                                                                                              name=y
                                                                                                              size=2
                                                                                                              value=<?php echo $_GET["y"]; ?>><br>
                            Wood: <input type=text id=wood_box name=wood_box><a style="cursor:pointer;"
                                                                                onclick='document.getElementById("wood_box").value = document.getElementById("wood").innerHTML'>max</a><br>
                            Clay: <input type=text id=clay_box name=clay_box><a style="cursor:pointer;"
                                                                                onclick='document.getElementById("clay_box").value = document.getElementById("clay").innerHTML'>max</a><br>
                            Iron: <input type=text id=iron_box name=iron_box><a style="cursor:pointer;"
                                                                                onclick='document.getElementById("iron_box").value = document.getElementById("iron").innerHTML'>max</a><br>
                            Wheat: <input type=text id=wheat_box name=wheat_box><a style="cursor:pointer;"
                                                                                   onclick='document.getElementById("wheat_box").value = document.getElementById("wheat").innerHTML'>max</a><br>
                            <input type=submit value=Send>
                        </form>

                        <? /*-----------------------------------------
	This is the Send resources function
	-----------------------------------------*/ ?>

                    </div><!-- #mapbox-->


                    <br>
                    <div id="uppgrades"><!-- #uppgrades -->
                        <?
                        include "includes/buildingtimer.php";
                        if ($admin = 1) {
                            ?> <a href="reset.php?resources=1">More resources</a><? } ?>
                    </div><!-- #uppgrades -->


                </div><!-- #content-->
            </div><!-- #container-->

            <!-- SIDEBARS AND FOOTER -->

            <?
            include("includes/tetriumsidebarsandfooter.php");
            ?>
            <!-- SIDEBARS AND FOOTER -->

        </div><!-- #wrapper -->
</center>

<?php include("includes/tetriumjavascript.php"); ?>

</body>
</html>


<script>
    var message = "<?php echo $_GET["message"];?>";
    if (message.length > 0) {
        alert(message);
    }
</script>
	