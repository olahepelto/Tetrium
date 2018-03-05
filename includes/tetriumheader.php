<div id="header">
    <div id=menubar>
        <a href="/help.xlsx">HELP</a>
        <a href="tetrium.php?p=res"><img src="images/resourcefield.png" id="resourcefieldmenu" alt="Error"></a>

        <a href="tetrium.php?p=vlg" style="text-decoration: none;"><img src="/images/village.png" id="villagemenu" alt="Error"></a>

        <a href="tetrium.php?p=map" style="text-decoration: none;"><img width="98" height="87" src="images/map2.png" alt="Error"></a>
        <a href="tetrium.php?p=mis" style="text-decoration: none;"><img width="98" height="87" src="images/Battle_Icon.png" alt="Error"></a>
        <a href="tetrium.php?p=sts"><img src="images/stats.png" id="statsmenu" alt="Error"></a>
        
        <?php
        $result = mysql_query("SELECT * FROM reports WHERE player_id='$id' AND is_read='0'") or die(mysql_error());
        $number_of_rows = mysql_num_rows($result);

        if ($number_of_rows > 0) {
            $icon = "images/reports_unread.png";
        } else {
            $icon = "images/reports.png";
        }
        ?>
        <a href="tetrium.php?p=rep"><img src="<?php echo $icon; ?>" id="reportsmenu" alt="Error"></a>
        <a href="tetrium.php?p=msg"><img src="images/messages.png" id="messagesmenu" alt="Error"></a>
        <font size=2><a href="mailto:admin@tetrium.fi?subject=Tetrium%20bug%20report">Report bug</a></font>
        <div style="float:right;"><?php include_once "includes/village_switcher.php"; ?></div>
    </div>
    <br>
        <img src="/images/wood.png" height="15" width="15"><font style="font-weight: bold;" id=wood>error</font><b>/<?php echo $mysql_data["storage"] * 3200 + 800;?></b>
        <img src="/images/clay.png" height="15" width="15"><font style="font-weight: bold;" id=clay>error</font><b>/<?php echo $mysql_data["storage"] * 3200 + 800;?></b>
        <img src="/images/iron.png" height="15" width="15"><font style="font-weight: bold;" id=iron>error</font><b>/<?php echo $mysql_data["storage"] * 3200 + 800;?></b>
        <img src="/images/wheat.png" height="15" width="15"><font style="font-weight: bold;" id=wheat>error</font><b>/<?php echo $mysql_data["storage"] * 3200 + 800;?></b>
</div><!-- #header-->