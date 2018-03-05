<!-- GETS EPOCH OFFSET as seconds in variable epoch_offset -->
<?php
$date = date_create();
?>
<script>
    var real_load_server_epoch = <?php echo date_timestamp_get($date).";";?>
    var fake_epoch = new Date();
    fake_epoch = ((fake_epoch.getTime() - fake_epoch.getMilliseconds()) / 1000);
    var epoch_offset = fake_epoch - real_load_server_epoch;
</script>

<script>
    function epochtodate(epoch) {
        var myDate = new Date(epoch * 1000);
        return myDate.toLocaleString();
    }

    function secondsdate_timer_editon(seconds) {

        var numdays = Math.floor(seconds / 86400);
        var numhours = Math.floor((seconds % 86400) / 3600);
        var numminutes = Math.floor(((seconds % 86400) % 3600) / 60);
        var numseconds = ((seconds % 86400) % 3600) % 60;

        var lenght_s = numseconds.toString().length;
        var lenght_m = numminutes.toString().length;
        var lenght_h = numhours.toString().length;

        if (lenght_s == 1) {
            numseconds = "0" + numseconds;
        }
        if (lenght_m == 1) {
            numminutes = "0" + numminutes;
        }
        if (lenght_h == 1) {
            numhours = "0" + numhours;
        }

        if (numdays == 0 && numhours == 0 && numminutes == 0) {
            return " 00:00:" + numseconds + " hrs.";
        }
        if (numdays == 0 && numhours == 0) {
            return " 00:" + numminutes + ":" + numseconds + " hrs.";
        }
        if (numdays == 0) {
            return " " + numhours + ":" + numminutes + ":" + numseconds + " hrs.";
        }
        else {
            return numdays + " days " + numhours + ":" + numminutes + ":" + numseconds + " hrs.";
        }
    }
</script>


<?php
foreach ($event_ids as $timer_event_id) {
    if ($_SESSION["varadmin"] == 1) {
        echo "<a href=upgradegui.php?building=", $timer_building[$timer_event_id], ">", $timer_building[$timer_event_id], "</a> (Level ", $timer_level[$timer_event_id], ") ", "&nbsp;&nbsp;&nbsp;&nbsp;<b id=timer_id_" . $timer_event_id . " name=timer_id_" . $timer_event_id . ">Javascript Error</b>&nbsp;&nbsp;&nbsp;&nbsp;", " Done at: ", $timer_completed[$timer_event_id], "<a href=executables/func_start.php?type=speedup&event_id=", $timer_event_id, ">Speed up</a><br>";
    } else {
        echo "<a href=upgradegui.php?building=", $timer_building[$timer_event_id], ">", $timer_building[$timer_event_id], "</a> (Level ", $timer_level[$timer_event_id], ") ", "&nbsp;&nbsp;&nbsp;&nbsp;<b id=timer_id_" . $timer_event_id . " name=timer_id_" . $timer_event_id . ">Javascript Error</b>&nbsp;&nbsp;&nbsp;&nbsp;", " Done at: ", $timer_completed[$timer_event_id], "<br>";
    }
}

foreach ($event_ids as $timer_event_id) {
    ?>
    <script>
        var epoch = new Date();
        epoch = ((epoch.getTime() - epoch.getMilliseconds()) / 1000) - epoch_offset;
        var ordningsnummer = "<?php echo $timer_event_id; ?>";
        stro_completed = "<?php echo $timer_stro_completed[$timer_event_id]; ?>";
        timedown<?php echo $timer_event_id; ?>(stro_completed);


        function timedown<?php echo $timer_event_id; ?> (stro_completed) {
            var epoch = new Date();
            var epoch = ((epoch.getTime() - epoch.getMilliseconds()) / 1000) - epoch_offset;
            var element_id = "timer_id_" +<?php echo $timer_event_id; ?>;
            stro_completed = "<?php echo $timer_stro_completed[$timer_event_id]; ?>";
            var timediff_epoch_stro_completed = stro_completed - epoch;
            var value_output = secondsdate_timer_editon(timediff_epoch_stro_completed);
            document.getElementById(element_id).innerHTML = value_output;


            if (timediff_epoch_stro_completed <= 0) {
                setTimeout("location.reload();", 2000);
                document.getElementById(element_id).innerHTML = "Done";
            } else {
                setTimeout("timedown<?php echo $timer_event_id; ?>(stro_completed)", 1000)
            }
        }
    </script>
    <?php
}
