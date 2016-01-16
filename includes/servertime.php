<!-- GETS EPOCH OFFSET as seconds in variable epoch_offset -->
<?php
include "epoch_offset.php";
?>

<script>
    function server_clock_up() {
        var epoch_as_date;
        var epoch = new Date();

        epoch = (epoch.getTime() - epoch.getMilliseconds()) / 1000;
        epoch = epoch - epoch_offset;
        epoch_as_date = epochtodate(epoch);
        document.getElementById("serverclock").innerHTML = epoch_as_date;
        setTimeout("server_clock_up()", 1000);
    }

    function epochtodate(epoch) {
        var myDate = new Date(epoch * 1000);
        return myDate.toLocaleString();
    }
</script>
<b id=serverclock>Error: Javascript not running(proboably:D)</b>
<script>
    server_clock_up();
</script>