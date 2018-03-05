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
    function sidebar_secondsdate_timer_editon(seconds) {

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
/*
  OUTGOING ID
 */
?>

<script>
    var epoch = new Date();
    epoch = ((epoch.getTime() - epoch.getMilliseconds()) / 1000) - epoch_offset;
    stro_completed = "<?php echo $sendres_timer_stro_completed_out[$sendres_timer_event_min_time_id_out]; ?>";
    sidebar_timedown<?php echo $sendres_timer_event_min_time_id_out; ?>(stro_completed);

    function sidebar_timedown<?php echo $sendres_timer_event_min_time_id_out; ?>(stro_completed) {
        var epoch = new Date();
        var epoch = ((epoch.getTime() - epoch.getMilliseconds()) / 1000) - epoch_offset;
        var element_id = "sidebar_timer_id_" +<?php echo $sendres_timer_event_min_time_id_out; ?>;
        stro_completed = "<?php echo $sendres_timer_stro_completed_out[$sendres_timer_event_min_time_id_out]; ?>";
        var timediff_epoch_stro_completed = stro_completed - epoch;
        var value_output = sidebar_secondsdate_timer_editon(timediff_epoch_stro_completed);
        document.getElementById(element_id).innerHTML = value_output;


        if (timediff_epoch_stro_completed <= 0) {
            setTimeout("location.reload();", 2000);
            document.getElementById(element_id).innerHTML = "Done";
        } else {
            setTimeout("sidebar_timedown<?php echo $sendres_timer_event_min_time_id_out; ?>(stro_completed)", 1000)
        }
    }
</script>


<?php
/*
  INCOMING IDS
 */
?>
<script>
    var epoch = new Date();
    epoch = ((epoch.getTime() - epoch.getMilliseconds()) / 1000) - epoch_offset;
    stro_completed = "<?php echo $sendres_timer_stro_completed_in[$sendres_timer_event_min_time_id_in]; ?>";
    sidebar_timedown<?php echo $sendres_timer_event_min_time_id_in; ?>(stro_completed);

    function sidebar_timedown<?php echo $sendres_timer_event_min_time_id_in; ?>(stro_completed) {
        var epoch = new Date();
        var epoch = ((epoch.getTime() - epoch.getMilliseconds()) / 1000) - epoch_offset;
//console.log(epoch+"---"+epoch_offset);	
        var element_id = "sidebar_timer_id_" +<?php echo $sendres_timer_event_min_time_id_in; ?>;
        stro_completed = "<?php echo $sendres_timer_stro_completed_in[$sendres_timer_event_min_time_id_in]; ?>";
        var timediff_epoch_stro_completed = stro_completed - epoch;
        var value_output = sidebar_secondsdate_timer_editon(timediff_epoch_stro_completed);
        document.getElementById(element_id).innerHTML = value_output;


        if (timediff_epoch_stro_completed <= 0) {
            setTimeout("location.reload();", 2000);
            document.getElementById(element_id).innerHTML = "Done";
        } else {
            setTimeout("sidebar_timedown<?php echo $sendres_timer_event_min_time_id_in; ?>(stro_completed)", 1000)
        }
    }
</script>

<?php
/*
  RETURNING IDS
 */
?>
<script>
    var epoch = new Date();
    epoch = ((epoch.getTime() - epoch.getMilliseconds()) / 1000) - epoch_offset;
    stro_completed = "<?php echo $sendres_timer_stro_completed_return[$returning_sendres_timer_event_min_time_id]; ?>";
    sidebar_timedown<?php echo $returning_sendres_timer_event_min_time_id; ?>(stro_completed);

    function sidebar_timedown<?php echo $returning_sendres_timer_event_min_time_id; ?>(stro_completed) {
        var epoch = new Date();
        var epoch = ((epoch.getTime() - epoch.getMilliseconds()) / 1000) - epoch_offset;
//console.log(epoch+"---"+epoch_offset);	
        var element_id = "sidebar_timer_id_" +<?php echo $returning_sendres_timer_event_min_time_id; ?>;
        stro_completed = "<?php echo $sendres_timer_stro_completed_return[$returning_sendres_timer_event_min_time_id]; ?>";
        var timediff_epoch_stro_completed = stro_completed - epoch;
        var value_output = sidebar_secondsdate_timer_editon(timediff_epoch_stro_completed);
        document.getElementById(element_id).innerHTML = value_output;


        if (timediff_epoch_stro_completed <= 0) {
            setTimeout("location.reload();", 2000);
            document.getElementById(element_id).innerHTML = "Done";
        } else {
            setTimeout("sidebar_timedown<?php echo $returning_sendres_timer_event_min_time_id; ?>(stro_completed)", 1000)
        }
    }
</script>


<?php
/*
  OUTGOING ATTACK ID
 */
?>

<script>
    var epoch = new Date();
    epoch = ((epoch.getTime() - epoch.getMilliseconds()) / 1000) - epoch_offset;
    stro_completed = "<?php echo $attack_timer_stro_completed_out[$attack_timer_event_min_time_id_out]; ?>";
    sidebar_timedown<?php echo $attack_timer_event_min_time_id_out; ?>(stro_completed);

    function sidebar_timedown<?php echo $attack_timer_event_min_time_id_out; ?>(stro_completed) {
        var epoch = new Date();
        var epoch = ((epoch.getTime() - epoch.getMilliseconds()) / 1000) - epoch_offset;
//console.log(epoch+"---"+epoch_offset);	
        var element_id = "sidebar_timer_id_" +<?php echo $attack_timer_event_min_time_id_out; ?>;
        stro_completed = "<?php echo $attack_timer_stro_completed_out[$attack_timer_event_min_time_id_out]; ?>";
        var timediff_epoch_stro_completed = stro_completed - epoch;
        var value_output = sidebar_secondsdate_timer_editon(timediff_epoch_stro_completed);
        document.getElementById(element_id).innerHTML = value_output;


        if (timediff_epoch_stro_completed <= 0) {
            setTimeout("location.reload();", 2000);
            document.getElementById(element_id).innerHTML = "Done";
        } else {
            setTimeout("sidebar_timedown<?php echo $attack_timer_event_min_time_id_out; ?>(stro_completed)", 1000)
        }
    }
</script>


<?php
/*
  INCOMING ATTACK IDS
 */
?>
<script>
    var epoch = new Date();
    epoch = ((epoch.getTime() - epoch.getMilliseconds()) / 1000) - epoch_offset;
    stro_completed = "<?php echo $attack_timer_stro_completed_in[$attack_timer_event_min_time_id_in]; ?>";
    sidebar_timedown<?php echo $attack_timer_event_min_time_id_in; ?>(stro_completed);

    function sidebar_timedown<?php echo $attack_timer_event_min_time_id_in; ?>(stro_completed) {
        var epoch = new Date();
        var epoch = ((epoch.getTime() - epoch.getMilliseconds()) / 1000) - epoch_offset;
//console.log(epoch+"---"+epoch_offset);	
        var element_id = "sidebar_timer_id_" +<?php echo $attack_timer_event_min_time_id_in; ?>;
        stro_completed = "<?php echo $attack_timer_stro_completed_in[$attack_timer_event_min_time_id_in]; ?>";
        var timediff_epoch_stro_completed = stro_completed - epoch;
        var value_output = sidebar_secondsdate_timer_editon(timediff_epoch_stro_completed);
        document.getElementById(element_id).innerHTML = value_output;


        if (timediff_epoch_stro_completed <= 0) {
            setTimeout("location.reload();", 2000);
            document.getElementById(element_id).innerHTML = "Done";
        } else {
            setTimeout("sidebar_timedown<?php echo $attack_timer_event_min_time_id_in; ?>(stro_completed)", 1000)
        }
    }
</script>
<?php
/*
  RETURNING ATTACK IDS
 */
?>
<script>
    var epoch = new Date();
    epoch = ((epoch.getTime() - epoch.getMilliseconds()) / 1000) - epoch_offset;
    stro_completed = "<?php echo $attack_timer_stro_completed_return[$returning_attack_timer_event_min_time_id]; ?>";
    sidebar_timedown<?php echo $returning_attack_timer_event_min_time_id; ?>(stro_completed);

    function sidebar_timedown<?php echo $returning_attack_timer_event_min_time_id; ?>(stro_completed) {
        var epoch = new Date();
        var epoch = ((epoch.getTime() - epoch.getMilliseconds()) / 1000) - epoch_offset;
//console.log(epoch+"---"+epoch_offset);	
        var element_id = "sidebar_timer_id_" +<?php echo $returning_attack_timer_event_min_time_id; ?>;
        stro_completed = "<?php echo $attack_timer_stro_completed_return[$returning_attack_timer_event_min_time_id]; ?>";
        var timediff_epoch_stro_completed = stro_completed - epoch;
        var value_output = sidebar_secondsdate_timer_editon(timediff_epoch_stro_completed);
        document.getElementById(element_id).innerHTML = value_output;


        if (timediff_epoch_stro_completed <= 0) {
            setTimeout("location.reload();", 2000);
            document.getElementById(element_id).innerHTML = "Done";
        } else {
            setTimeout("sidebar_timedown<?php echo $returning_attack_timer_event_min_time_id; ?>(stro_completed)", 1000)
        }
    }
</script>


<?php
/*
  INCOMING REINFORCEMENT IDS
 */
?>
<script>
    var epoch = new Date();
    epoch = ((epoch.getTime() - epoch.getMilliseconds()) / 1000) - epoch_offset;
    stro_completed = "<?php echo $reinforce_timer_stro_completed_in[$reinforce_timer_event_min_time_id_in]; ?>";
    sidebar_timedown<?php echo $reinforce_timer_event_min_time_id_in; ?>(stro_completed);

    function sidebar_timedown<?php echo $reinforce_timer_event_min_time_id_in; ?>(stro_completed) {
        var epoch = new Date();
        var epoch = ((epoch.getTime() - epoch.getMilliseconds()) / 1000) - epoch_offset;
//console.log(epoch+"---"+epoch_offset);
        var element_id = "sidebar_timer_id_" +<?php echo $reinforce_timer_event_min_time_id_in; ?>;
        stro_completed = "<?php echo $reinforce_timer_stro_completed_in[$reinforce_timer_event_min_time_id_in]; ?>";
        var timediff_epoch_stro_completed = stro_completed - epoch;
        var value_output = sidebar_secondsdate_timer_editon(timediff_epoch_stro_completed);
        document.getElementById(element_id).innerHTML = value_output;


        if (timediff_epoch_stro_completed <= 0) {
            setTimeout("location.reload();", 2000);
            document.getElementById(element_id).innerHTML = "Done";
        } else {
            setTimeout("sidebar_timedown<?php echo $reinforce_timer_event_min_time_id_in; ?>(stro_completed)", 1000)
        }
    }
</script>

<?php
/*
  OUTGOING REINFORCEMENT ID
 */
?>

<script>
    var epoch = new Date();
    epoch = ((epoch.getTime() - epoch.getMilliseconds()) / 1000) - epoch_offset;
    stro_completed = "<?php echo $reinforce_timer_stro_completed_out[$reinforce_timer_event_min_time_id_out]; ?>";
    sidebar_timedown<?php echo $reinforce_timer_event_min_time_id_out; ?>(stro_completed);

    function sidebar_timedown<?php echo $reinforce_timer_event_min_time_id_out; ?>(stro_completed) {
        var epoch = new Date();
        var epoch = ((epoch.getTime() - epoch.getMilliseconds()) / 1000) - epoch_offset;
        var element_id = "sidebar_timer_id_" +<?php echo $reinforce_timer_event_min_time_id_out; ?>;
        stro_completed = "<?php echo $reinforce_timer_stro_completed_out[$reinforce_timer_event_min_time_id_out]; ?>";
        var timediff_epoch_stro_completed = stro_completed - epoch;
        var value_output = sidebar_secondsdate_timer_editon(timediff_epoch_stro_completed);
        document.getElementById(element_id).innerHTML = value_output;


        if (timediff_epoch_stro_completed <= 0) {
            setTimeout("location.reload();", 2000);
            document.getElementById(element_id).innerHTML = "Done";
        } else {
            setTimeout("sidebar_timedown<?php echo $reinforce_timer_event_min_time_id_out; ?>(stro_completed)", 1000)
        }
    }
</script>

<?php
/*
  OUTGOING SETTLE ID
 */
?>

<script>
    var epoch = new Date();
    epoch = ((epoch.getTime() - epoch.getMilliseconds()) / 1000) - epoch_offset;
    stro_completed = "<?php echo $settle_timer_stro_completed_out[$settle_timer_event_min_time_id_out]; ?>";
    sidebar_timedown<?php echo $settle_timer_event_min_time_id_out; ?>(stro_completed);

    function sidebar_timedown<?php echo $settle_timer_event_min_time_id_out; ?>(stro_completed) {
        var epoch = new Date();
        var epoch = ((epoch.getTime() - epoch.getMilliseconds()) / 1000) - epoch_offset;
        var element_id = "sidebar_timer_id_" +<?php echo $settle_timer_event_min_time_id_out; ?>;
        stro_completed = "<?php echo $settle_timer_stro_completed_out[$settle_timer_event_min_time_id_out]; ?>";
        var timediff_epoch_stro_completed = stro_completed - epoch;
        var value_output = sidebar_secondsdate_timer_editon(timediff_epoch_stro_completed);
        document.getElementById(element_id).innerHTML = value_output;


        if (timediff_epoch_stro_completed <= 0) {
            setTimeout("location.reload();", 2000);
            document.getElementById(element_id).innerHTML = "Done";
        } else {
            setTimeout("sidebar_timedown<?php echo $settle_timer_event_min_time_id_out; ?>(stro_completed)", 1000)
        }
    }
</script>

<?php
/*
  TROOP TRAINING IDS
 */
?>
<script>
    var epoch = new Date();
    epoch = ((epoch.getTime() - epoch.getMilliseconds()) / 1000) - epoch_offset;
    stro_completed = "<?php echo $troop_timer_stro_completed[$troop_timer_event_min_time_id]; ?>";
    sidebar_timedown<?php echo $troop_timer_event_min_time_id; ?>(stro_completed);

    function sidebar_timedown<?php echo $troop_timer_event_min_time_id; ?>(stro_completed) {
        var epoch = new Date();
        var epoch = ((epoch.getTime() - epoch.getMilliseconds()) / 1000) - epoch_offset;
//console.log(epoch+"---"+epoch_offset);	
        var element_id = "sidebar_timer_id_" +<?php echo $troop_timer_event_min_time_id; ?>;
        stro_completed = "<?php echo $troop_timer_stro_completed[$troop_timer_event_min_time_id]; ?>";
        var timediff_epoch_stro_completed = stro_completed - epoch;
        var value_output = sidebar_secondsdate_timer_editon(timediff_epoch_stro_completed);
        document.getElementById(element_id).innerHTML = value_output;


        if (timediff_epoch_stro_completed <= 0) {
            setTimeout("location.reload();", 2000);
            document.getElementById(element_id).innerHTML = "Done";
        } else {
            setTimeout("sidebar_timedown<?php echo $troop_timer_event_min_time_id; ?>(stro_completed)", 1000)
        }
    }
</script>
