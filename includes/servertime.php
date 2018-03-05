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

    xmlHttp = new XMLHttpRequest();
    xmlHttp.open('HEAD',window.location.href.toString(),false);
    xmlHttp.setRequestHeader("Content-Type", "text/html");
    xmlHttp.send('');
    var initDate = xmlHttp.getResponseHeader("Date");


    function server_clock_up() {
        var epoch_as_date;
        var epoch = new Date();

        epoch = (epoch.getTime() - epoch.getMilliseconds()) / 1000;
        epoch = epoch - epoch_offset;
        epoch_as_date = epochtodate(epoch);
        document.getElementById("serverclock").innerHTML = initDate;//epoch_as_date
        setTimeout("server_clock_up()", 1000);
    }

    function epochtodate(epoch) {
        var myDate = new Date(epoch * 1000);
        return myDate.toLocaleString();
    }
</script>
<b id=serverclock>Error: Javascript not running(probably:D)</b>
<script>
    server_clock_up();
</script>