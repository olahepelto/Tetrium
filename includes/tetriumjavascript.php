<!-- Start the timed functions -->
<script>
    var pageload_epoch = new Date();
    pageload_epoch = (pageload_epoch.getTime() - pageload_epoch.getMilliseconds()) / 1000;
    resup();

    //Send variables to javascript
    var wood = '<?php echo $mysql_data["wood"];?>';
    var clay = '<?php echo $mysql_data["clay"];?>';
    var iron = '<?php echo $mysql_data["iron"];?>';
    var wheat = '<?php echo $mysql_data["wheat"];?>';
    var storagespace = '<?php echo $mysql_data["storage"] * 3200 + 800;?>';

    var woodcutterup = '<?php echo $croplandsh / 36000;?>';
    var claypitup = '<?php echo $claypitsh / 36000;?>';
    var ironmineup = '<?php echo $ironminesh / 36000;?>';
    var croplandup = '<?php echo $croplandsh / 36000;?>';


    var pluswood_epoch = 0;


    function resup() {
        //GET EPOCH AND COMPARE TO PAGELOAD
        var newepoch = new Date();
        newepoch = (newepoch.getTime() - newepoch.getMilliseconds()) / 1000;
        newepoch = newepoch;
        var epoch_diff = newepoch - pageload_epoch;

        //WOODUP
        if (parseFloat(wood) < storagespace) {
            pluswood_epoch = parseFloat(woodcutterup) * parseFloat(epoch_diff) * parseFloat(10);
            var epoch_wood = parseFloat(wood) + parseFloat(pluswood_epoch);
        } else {
            epoch_wood = storagespace;
        }
        document.getElementById('wood').innerHTML = Math.floor(epoch_wood);

        if (parseFloat(clay) < storagespace) {
            plusclay_epoch = parseFloat(claypitup) * parseFloat(epoch_diff) * parseFloat(10);
            var epoch_clay = parseFloat(clay) + parseFloat(plusclay_epoch);
        } else {
            epoch_clay = storagespace;
        }
        document.getElementById('clay').innerHTML = Math.floor(epoch_clay);

        if (parseFloat(iron) < storagespace) {
            plusiron_epoch = parseFloat(ironmineup) * parseFloat(epoch_diff) * parseFloat(10);
            var epoch_iron = parseFloat(iron) + parseFloat(plusiron_epoch);
        } else {
            epoch_iron = storagespace;
        }
        document.getElementById('iron').innerHTML = Math.floor(epoch_iron);

        if (parseFloat(wheat) < storagespace) {
            pluswheat_epoch = parseFloat(croplandup) * parseFloat(epoch_diff) * parseFloat(10);
            var epoch_wheat = parseFloat(wheat) + parseFloat(pluswheat_epoch);
        } else {
            epoch_wheat = storagespace;
        }
        document.getElementById('wheat').innerHTML = Math.floor(epoch_wheat);

        //Notify player if wheat is depleted
        if (epoch_wheat <= 0) {
            alert("No wheat left, soldiers will start dying");
            return;
        }

        setTimeout("resup()", 100)
    }
</script>