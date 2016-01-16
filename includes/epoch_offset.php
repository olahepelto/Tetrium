<?php
$date = date_create();
?>
<script>
    var real_load_server_epoch =<?php echo date_timestamp_get($date);?>;
    var fake_epoch = new Date();
    fake_epoch = ((fake_epoch.getTime() - fake_epoch.getMilliseconds()) / 1000);
    var epoch_offset = fake_epoch - real_load_server_epoch;
</script>

<!-- GETS EPOCH OFFSET as seconds in variable epoch_offset -->