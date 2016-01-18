<div style="width: 500px; height: 500px;" id="mapbox">

    <?php
    $nocords = true;
    /*-----------------------------------------
    This is the mighty map square function
    -----------------------------------------*/


    $result = mysql_query("SELECT * FROM map");
    $storeArray = Array();

    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $villagename[] = $row['village'];
        $owner[] = $row['player'];
        $type[] = $row['type'];
        $vidx[] = $row['x'];
        $vidy[] = $row['y'];
    }


    $x = 0;
    $y = 0;
    $vid = 0;
    while ($y < 16) {
        $y++;
        //next line of pictures
        ?><br><?php
        while ($x < 16) {
            $x++;
            $vid++;


            $time_now = date("Y-m-d H:i:s");
            $result = mysql_query("SELECT * FROM events WHERE target_village='$vid' and type='attack' and returning='0' and completed > '$time_now'");
            $underattack = mysql_num_rows($result);

            if ($row['type'] == -1) {
                $location = "images/mapgreen.png";
            } elseif ($row['type'] == 1) {
                $location = "images/mapvillagev2.png";
            }
            if ($row['type'] == -1 and $underattack > 0) {
                $location = "images/mapred.png";
            } elseif ($row['type'] == 1 and $underattack > 0) {
                $location = "images/mapvillage_under_attack.png";
            }
            if($x>=13){
                $translateX = -100;
            }else {
                $translateX = 25;
            }
            ?><a style="float: left;" id="village<?php echo $vid; ?>" onMouseOut="hideTooltip(t<?php echo $vid; ?>)"
                 href="tetrium.php?p=mpv&x=<?php echo $x; ?>&y=<?php echo $y; ?>"
                 onmouseover="showvillage(<?php echo $vid; ?>,t<?php echo $vid; ?>,<?php echo $underattack; ?>)">
            <div style="display:none; transform: translate(<?php echo $translateX;?>px,25px);" id="t<?php echo $vid; ?>"></div>
            <img src="<?php echo $location; ?>" alt="error" height="31" width="31"></a>
            <?php
        }
        if ($x == 16) {
            $x = 0;
        }
    }


    /*-----------------------------------------
    This is the end of the mighty map function
    -----------------------------------------*/


    ?>
</div><!-- #mapbox-->


<script>
    function showvillage(villageid, tool, attackamount) {
        var villagename = <?php echo json_encode($villagename); ?>;
        var owner = (<?php echo json_encode($owner); ?>);
        var vidx = (<?php echo json_encode($vidx); ?>);
        var vidy = (<?php echo json_encode($vidy); ?>);
        var type = (<?php echo json_encode($type); ?>);

        showTooltip(tool, villagename[villageid], owner[villageid], type[villageid], vidx[villageid], vidy[villageid], attackamount);
    }

    function showTooltip(div, vname, owner, type, x, y, attackamount) {
        div.style.display = 'flex';
        div.style.position = 'absolute';
        div.style.width = 'auto';
        div.style.backgroundColor = '#EFFCF0';
        div.style.border = 'solid 1px black';
        div.style.padding = '5px';

        if (type == -1) {
            type = "Oasis";
        } else {
            type = "Village";
        }
        div.innerHTML = "(" + x + "|" + y + ")" + '<br>' + "Village name: " + vname + '<br>' + "Owner: " + owner + '<br>' + "Type: " + type + '<br>' + "Incoming Attacks: " + attackamount;
    }

    function hideTooltip(div) {
        div.style.display = 'none';
    }
</script>