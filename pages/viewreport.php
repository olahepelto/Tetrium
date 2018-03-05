<div id="content">
    <br><br><br>

    <?php
    /*-----------------------------------------
    REPORTS FUNCTION
    -----------------------------------------*/
    $report_id = $_GET["rep_id"];
    $data = mysql_query("SELECT * FROM reports WHERE report_id='$report_id'");

    while ($info = mysql_fetch_array($data)) {
        if ($info['player_id'] != $id) {
            echo "you don't have permission to view this report :P";
            $perm = 0;
        } elseif ($info['player_id'] == $id) {
            $perm = 1;
        }
//THE REPORT PART
        if ($perm = 1) {
            mysql_query("UPDATE reports SET is_read=1 WHERE report_id='$report_id'") or die(mysql_error());
            ?>
            <style type="text/css">
                .tg {
                    border-collapse: collapse;
                    border-spacing: 0;
                }

                .tg td {
                    font-family: Arial, sans-serif;
                    font-size: 14px;
                    padding: 2px 8px;
                    border-style: solid;
                    border-width: 1px;
                    overflow: hidden;
                    word-break: normal;
                }

                .tg th {
                    font-family: Arial, sans-serif;
                    font-size: 14px;
                    font-weight: normal;
                    padding: 2px 8px;
                    border-style: solid;
                    border-width: 1px;
                    overflow: hidden;
                    word-break: normal;
                }

                .tg .tg-6eq8 {
                    color: #333333
                }

                .tg .tg-rujl {
                    font-weight: bold;
                    font-size: 14px;
                    background-color: #9b9b9b;
                    color: #333333
                }

                .tg .tg-gn9g {
                    font-size: 14px;
                    color: #333333
                }

                .tg .tg-9sz5 {
                    font-weight: bold;
                    background-color: #9b9b9b;
                    color: #333333
                }

                .tg .tg-ygl1 {
                    font-weight: bold;
                    background-color: #9b9b9b
                }
            </style>

            <?php if ($info['type'] == "attack") {?>
<table class="tg">
  <tr>
    <th class="tg-rujl">Topic</th>
    <th class="tg-gn9g"><?php echo $info['topic']; ?></th>
  </tr>
  <tr>
    <td class="tg-9sz5">Date</td>
    <td class="tg-6eq8"><?php echo $info['time']; ?></td>
  </tr>
  <tr>
    <td class="tg-9sz5">Winner</td>
    <td class="tg-6eq8"><?php echo $info['winner']; ?></td>
  </tr>
</table>
<br><br>
<table class="tg">
  <tr>
    <th class="tg-rujl">Attacker</th>
    <th class="tg-gn9g" colspan="6"><?php echo $info['Attacker']; ?></th>
  </tr>
  <tr>
    <td class="tg-9sz5">Troops</td>
    <td class="tg-6eq8">Clubs</td>
    <td class="tg-031e">Spears</td>
    <td class="tg-031e">Axes</td>
    <td class="tg-6eq8">Scouts</td>
    <td class="tg-031e">Knights</td>
    <td class="tg-031e">Warhorses</td>
  </tr>
  <tr>
    <td class="tg-9sz5">Amount</td>
    <td class="tg-6eq8"><?php echo $info['clubswinger_att']; ?></td>
    <td class="tg-031e"><?php echo $info['spearman_att']; ?></td>
    <td class="tg-031e"><?php echo $info['axeman_att']; ?></td>
    <td class="tg-6eq8"><?php echo $info['scouthorse_att']; ?></td>
    <td class="tg-031e"><?php echo $info['knighthorse_att']; ?></td>
    <td class="tg-031e"><?php echo $info['warhorse_att']; ?></td>
  </tr>
  <tr>
    <td class="tg-ygl1">Deaths</td>
    <td class="tg-031e"><?php echo $info['clubswinger_att_die']; ?></td>
    <td class="tg-031e"><?php echo $info['spearman_att_die']; ?></td>
    <td class="tg-031e"><?php echo $info['axeman_att_die']; ?></td>
    <td class="tg-031e"><?php echo $info['scouthorse_att_die']; ?></td>
    <td class="tg-031e"><?php echo $info['knighthorse_att_die']; ?></td>
    <td class="tg-031e"><?php echo $info['warhorse_att_die']; ?></td>
  </tr>
  <tr>
    <td class="tg-ygl1">Loot</td>
    <td class="tg-031e" colspan="6">Wood:<?php echo $info['loot_wood']; ?> Clay:<?php echo $info['loot_clay']; ?> Iron:<?php echo $info['loot_iron']; ?> Wheat:<?php echo $info['loot_wheat']; ?></td>
  </tr>
</table>
<br><br>
</style>

<table class="tg">
  <tr>
    <th class="tg-rujl">Defender</th>
    <th class="tg-gn9g" colspan="6"><?php echo $info['Defender']; ?></th>
  </tr>
  <tr>
    <td class="tg-9sz5">Troops</td>
    <td class="tg-6eq8">Clubs</td>
    <td class="tg-031e">Spears</td>
    <td class="tg-031e">Axes</td>
    <td class="tg-6eq8">Scouts</td>
    <td class="tg-031e">Knights</td>
    <td class="tg-031e">Warhorses</td>
  </tr>
  <tr>
    <td class="tg-9sz5">Amount</td>
    <td class="tg-6eq8"><?php echo $info['clubswinger_def']; ?></td>
    <td class="tg-031e"><?php echo $info['spearman_def']; ?></td>
    <td class="tg-031e"><?php echo $info['axeman_def']; ?></td>
    <td class="tg-6eq8"><?php echo $info['scouthorse_def']; ?></td>
    <td class="tg-031e"><?php echo $info['knighthorse_def']; ?></td>
    <td class="tg-031e"><?php echo $info['warhorse_def']; ?></td>
  </tr>
  <tr>
    <td class="tg-ygl1">Deaths</td>
    <td class="tg-031e"><?php echo $info['clubswinger_def_die']; ?></td>
    <td class="tg-031e"><?php echo $info['spearman_def_die']; ?></td>
    <td class="tg-031e"><?php echo $info['axeman_def_die']; ?></td>
    <td class="tg-031e"><?php echo $info['scouthorse_def_die']; ?></td>
    <td class="tg-031e"><?php echo $info['knighthorse_def_die']; ?></td>
    <td class="tg-031e"><?php echo $info['warhorse_def_die']; ?></td>
  </tr>
</table>
	
<?php
} elseif($info['type']=="sendres"){
?>
<table class="tg">
  <tr>
    <th class="tg-rujl">Topic</th>
    <th class="tg-gn9g"><?php echo $info['topic']; ?></th>
  </tr>
	
  <tr>
    <td class="tg-9sz5">Date</td>
    <td class="tg-6eq8"><?php echo $info['time']; ?></td>
  </tr>
</table>
		
		
		
		
<br><br>
<table class="tg">
  <tr>
    <th class="tg-rujl">Orgin</th>
    <th class="tg-gn9g" colspan="6"><?php echo $info['Attacker']; ?></th>
  </tr>
  <tr>
    <td class="tg-ygl1">Amount</td>
    <td class="tg-031e" colspan="6">Wood:<?php echo $info['loot_wood']; ?> Clay:<?php echo $info['loot_clay']; ?> Iron:<?php echo $info['loot_iron']; ?> Wheat:<?php echo $info['loot_wheat']; ?></td>
  </tr>
</table>
<br><br>
</style>

<?php	
}
}
}
?>
</div><!-- #mapbox-->