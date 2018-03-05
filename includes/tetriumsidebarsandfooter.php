<?php
// <editor-fold defaultstate="collapsed" desc="The menu for ADMINS">
if ($_SESSION["varadmin"] == 1) {
    ?>

    <div  style='transform: translate(-300px,-100px)' class="sidebar" id="sideLeft">	
        <b><strong>DEBUG:</strong></b><br>
        <form action="executables/func_start.php?">
            <input type="hidden" value="debug_data" name="type" id="type">
            X:<input id="x" name="x" style="width:20px;">
            Y:<input id="y" name="y" style="width:20px;">
            <br>OR<br>
            Name:<input id="vname" name="vname" style="width:100px;"><br>
            <input type="submit" value="Get data">
        </form>
        <a onclick="window.open('Debug_popup.php', Math.random() * 100 * Math.random() * 100 * Math.random() * 100, 'width=250, height=1000');">Popup</a><br>
        <?php
        if (empty($_GET["debug_vid"])) {
            $_GET["debug_vid"] = $current_village_id;
        }
        print_debug($_GET["debug_vid"]);
        ?>
    </div><!-- .sidebar#sideLeft -->
    <?php
}
// </editor-fold>

//<editor-fold defaultstate="collapsed" desc="The menu for basic users">
?>
<div <?php
if ($_SESSION["varadmin"] == 1) {
    echo "style='transform: translate(-300px,0px);'";
}
?> class="sidebar2" id="sideLeft2">	
    <b><strong>MENU:</strong></b><br>
    <a href="https://bitbucket.org/tetrium/tetrium/" style="text-decoration: none;"><div id="button">Bitbucket</div></a>
    <a href="cpassgui.php" style="text-decoration: none;"><div id="button">Change Password</div></a>
    <div id="button" onclick="var newname = window.prompt('Please enter new village name');
            if (newname === null) {
            } else {
                window.location.href = '../executables/rename_village.php?newname=' + newname;
            }">Change village name</div>
         <?php if ($_SESSION['varadmin'] == 1) { ?>
        <a href="tetrium.php?p=admin" style="text-decoration: none;">
            <div id="button">Admin panel<br></div></a>
        <a href="../phpmyadmin" style="text-decoration: none;"><div id="button">Database</div></a>
        <a href="changeinfo.php" style="text-decoration: none;"><div id="button">Change infsss<br></div></a>
    <?php } ?>
    <a href="executables/func_start.php?type=logout" style="text-decoration: none;"><div id="button">Logout<br></div></a>
</div><!-- .sidebar#sideLeft -->
<?php
//</editor-fold>

// <editor-fold defaultstate="collapsed" desc="Sidebar Timers">
if ($sendres_timer_event_amount_in > 0 or $sendres_timer_event_amount_out > 0 or $troop_timer_event_amount > 0 or $returning_sendres_timer_event_amount > 0 or $attack_timer_event_amount_in > 0 or $attack_timer_event_amount_out > 0 or $returning_attack_timer_event_amount > 0) {
    ?>
    <div style="width: 200px; float: right;">
        <div class="sidebar" id="sideRight" style="background:cadetblue;">
            <?php if ($troop_timer_event_amount > 0) { ?><strong>Troop Training:</strong><br><?php } ?>
            <?php
            if ($troop_timer_event_amount > 0) {
                echo $troop_timer_event_amount;
                ?> troop(s) in<?php
                echo "<b id=sidebar_timer_id_" . $troop_timer_event_min_time_id . " name=sidebar_timer_id_" . $troop_timer_event_min_time_id . ">Javascript Error</b><br>";
            }
            ?>


            <?php if ($returning_sendres_timer_event_amount > 0 or $returning_attack_timer_event_amount > 0) { ?><strong>Returning:</strong><br><?php }
            if ($returning_sendres_timer_event_amount > 0) {
                echo $returning_sendres_timer_event_amount;
                ?> shipments(s) in<?php
                echo "<b id=sidebar_timer_id_" . $returning_sendres_timer_event_min_time_id . " name=sidebar_timer_id_" . $returning_sendres_timer_event_min_time_id . ">Javascript Error</b><br>";
            }

            if ($returning_attack_timer_event_amount > 0) {
                echo $returning_attack_timer_event_amount;
                ?> attack(s) in<?php
                echo "<b id=sidebar_timer_id_" . $returning_attack_timer_event_min_time_id . " name=sidebar_timer_id_" . $returning_attack_timer_event_min_time_id . ">Javascript Error</b><br>";
            }


            if ($sendres_timer_event_amount_in > 0 or $attack_timer_event_amount_in > 0) { ?><strong>Incoming:</strong><br><?php }
            if ($sendres_timer_event_amount_in > 0) {
                echo $sendres_timer_event_amount_in;
                ?> shipment(s) in<?php
                echo "<b id=sidebar_timer_id_" . $sendres_timer_event_min_time_id_in . " name=sidebar_timer_id_" . $sendres_timer_event_min_time_id_in . ">Javascript Error</b><br>";
            }

            if ($attack_timer_event_amount_in > 0) {
                echo " attack(s) in";
                echo "<b id=sidebar_timer_id_" . $attack_timer_event_min_time_id_in . " name=sidebar_timer_id_" . $attack_timer_event_min_time_id_in . ">Javascript Error</b><br>";
            }
            if ($reinforce_timer_event_amount_in > 0) {
                echo " reinforcements(s) in";
                echo "<b id=sidebar_timer_id_" . $reinforce_timer_event_min_time_id_in . " name=sidebar_timer_id_" . $reinforce_timer_event_min_time_id_in . ">Javascript Error</b><br>";
            }


            if ($sendres_timer_event_amount_out > 0 or $attack_timer_event_amount_out > 0 or $reinforce_timer_event_amount_out > 0) {
                ?><strong>Outgoing:</strong><br><?php
            }
            if ($sendres_timer_event_amount_out > 0) {
                echo $sendres_timer_event_amount_out;
                ?> shipment(s) in<?php
                echo "<b id=sidebar_timer_id_" . $sendres_timer_event_min_time_id_out . " name=sidebar_timer_id_" . $sendres_timer_event_min_time_id_out . ">Javascript Error</b><br>";
            }

            if ($attack_timer_event_amount_out > 0) {
                echo $attack_timer_event_amount_out;
                ?> attack(s) in<?php
                echo "<b id=sidebar_timer_id_" . $attack_timer_event_min_time_id_out . " name=sidebar_timer_id_" . $attack_timer_event_min_time_id_out . ">Javascript Error</b><br>";
            }

            if ($reinforce_timer_event_amount_out > 0) {
                echo $reinforce_timer_event_amount_out;
                ?> reinforcements(s) in<?php
                echo "<b id=sidebar_timer_id_" . $reinforce_timer_event_min_time_id_out . " name=sidebar_timer_id_" . $reinforce_timer_event_min_time_id_out . ">Javascript Error</b><br>";
            }

            if ($settle_timer_event_amount_out > 0) {
                echo $settle_timer_event_amount_out;
                ?> settle(s) in<?php
                echo "<b id=sidebar_timer_id_" . $settle_timer_event_min_time_id_out . " name=sidebar_timer_id_" . $settle_timer_event_min_time_id_out . ">Javascript Error</b><br>";
            }
            ?>
        </div><!-- .sidebar#sideoverRight -->
        <?php
    }
    include "sidebar_javascript.php";
// </editor-fold>

//<editor-fold defaultstate="collapsed" desc="Resource Production view">
    ?>
    <div style="width: 200px; float: right;">
        <div class="sidebar" id="sideRight">
            <strong><?php echo "Resource production"; ?></strong><br>
            <?php echo "<img src='/images/wood.png' height='15' width='15'>"," Wood: <b>", $res_p_h["wood"], "</b> per hour"; ?><br>
            <?php echo "<img src='/images/clay.png' height='15' width='15'>"," Iron: <b>", $res_p_h["iron"], "</b> per hour"; ?><br>
            <?php echo "<img src='/images/iron.png' height='15' width='15'>"," Clay: <b>", $res_p_h["clay"], "</b> per hour"; ?><br>
            <?php echo "<img src='/images/wheat.png' height='15' width='15'>"," Wheat: <b>", $res_p_h["wheat"], "</b> per hour"; ?><br>
        </div><!-- .sidebar#sideRight -->
        <?php
//</editor-fold>

// <editor-fold defaultstate="collapsed" desc="Troop Amount view">
        if ($mysql_data["clubswinger"] > 0 or $mysql_data["spearman"] > 0 or $mysql_data["axeman"] > 0) {
            ?>
            <div class="sidebar" id="sideUnderUnderRight">	
                <strong>Troops:</strong><br>
                <?php
                if ($mysql_data["clubswinger"] == 1) {
                    echo "1 Clubswinger<br>";
                }
                if ($mysql_data["spearman"] == 1) {
                    echo "1 Spearman<br>";
                }
                if ($mysql_data["axeman"] == 1) {
                    echo "1 Axeman<br>";
                }
                if ($mysql_data["scouthorse"] == 1) {
                    echo "1 Scouthorse<br>";
                }
                if ($mysql_data["knighthorse"] == 1) {
                    echo "1 Knighthorse<br>";
                }
                if ($mysql_data["warhorse"] == 1) {
                    echo "1 Warhorse<br>";
                }
                if ($mysql_data["clubswinger"] > 1) {
                    echo $mysql_data["clubswinger"], " Clubswingers<br>";
                }
                if ($mysql_data["spearman"] > 1) {
                    echo $mysql_data["spearman"], " Spearmen<br>";
                }
                if ($mysql_data["axeman"] > 1) {
                    echo $mysql_data["axeman"], " Axemen<br>";
                }
                if ($mysql_data["scouthorse"] > 1) {
                    echo $mysql_data["scouthorse"], " Scouthorses<br>";
                }
                if ($mysql_data["knighthorse"] > 1) {
                    echo $mysql_data["knighthorse"], " Knighthorses<br>";
                }
                if ($mysql_data["warhorse"] > 1) {
                    echo $mysql_data["warhorse"], " Warhorses<br>";
                }
                echo "<br>Upkeep: ", $mysql_data["clubswinger"] + $mysql_data["spearman"] + $mysql_data["axeman"] + $mysql_data["scouthorse"] + $mysql_data["knighthorse"] + $mysql_data["warhorse"], " Wheat per hour", "<br>";
                ?>
            </div><!-- .sidebar#UndersideRight -->
            <?php
        }
// </editor-fold>
    
// <editor-fold defaultstate="collapsed" desc="Tetrium Map Action menu">
        if ($map == true) {
            ?>
      <?php
          $result = mysql_query("SELECT * FROM map WHERE id='$id'") or die(mysql_error());
          if(mysql_num_rows($result) == 1){
            $resource_cost = 5000;
          }elseif(mysql_num_rows($result) == 2){
            $resource_cost = 10000;
          }elseif(mysql_num_rows($result) == 3){
            $resource_cost = 20000;
          }elseif(mysql_num_rows($result) == 4){
            $resource_cost = 40000;
          }elseif(mysql_num_rows($result) == 5){
            $resource_cost = 80000;
          }elseif(mysql_num_rows($result) == 6){
            $resource_cost = 160000;
          }else{
            $resource_cost = 200000;
          }
      ?>
      
                <div class="sidebar" id="sideUnderRight" style="background: #2E64FE;">
                    <strong>Actions:<br>
                        <a style="color:#FE2E2E;" href="tetrium.php?p=att&x=<?php echo $_GET["x"]; ?>&y=<?php echo $_GET["y"]; ?>">Attack</a><br>
                        <a style="color:#40FF00;" href="tetrium.php?p=refrs&x=<?php echo $_GET["x"]; ?>&y=<?php echo $_GET["y"]; ?>">Reinforce</a><br>
                        <a style="color:#40FF00;" href="tetrium.php?p=srs&x=<?php echo $_GET["x"]; ?>&y=<?php echo $_GET["y"]; ?>">Send resources</a><br>
                        <a style="color:#40FF00;" href="tetrium.php?p=stlvlg&x=<?php echo $_GET["x"]; ?>&y=<?php echo $_GET["y"]; ?>">Settle Village(<?php echo $resource_cost;?>)</a>
                    </strong>
                </div>
<?php } elseif ($nocords == true) { ?>
                <div class="sidebar" id="sideUnderRight" style="background: #2E64FE;">
                    <strong>Actions:<br>
                        <a style="color:#FE2E2E;" href="tetrium.php?p=att&nocords=true">Attack</a><br>
                        <a style="color:#40FF00;" href="tetrium.php?p=refrs&nocords=true">Reinforce</a><br>
                        <a style="color:#40FF00;" href="tetrium.php?p=srs&nocords=true">Send resources</a>
                    </strong>
                </div>
    <?php
        }
// </editor-fold>
?>