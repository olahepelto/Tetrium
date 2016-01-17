<script>
    var pageload_ms = new Date().getTime();

    var refresh_frequency = 50; //ms


    var storagespace = <?php echo $mysql_data["storage"] * 3200 + 800;?>;
    var decimals = <?php if($_SESSION["varadmin"]){echo 2;}else{echo 0;}?>;
    var pageload_res = {wood : <?php echo $mysql_data["wood"];?>,
                        clay : <?php echo $mysql_data["clay"];?>,
                        iron : <?php echo $mysql_data["iron"];?>,
                        wheat: <?php echo $mysql_data["wheat"];?>};

    var res_p_ms = {wood : <?php echo $res_p_h["wood"] / 3600000;?>,
                    clay : <?php echo $res_p_h["clay"] / 3600000;?>,
                    iron : <?php echo $res_p_h["iron"] / 3600000;?>,
                    wheat: <?php echo $res_p_h["wheat"] / 3600000;?>};
<?php echo $res_ph["wheat_ph"]; ?>
    var res = { wood : <?php echo $mysql_data["wood"];?>,
                clay : <?php echo $mysql_data["clay"];?>,
                iron : <?php echo $mysql_data["iron"];?>,
                wheat: <?php echo $mysql_data["wheat"];?>};
    var log_once_a_second = 0;
    resup();
    function resup() {
        var ms_since_pageload = new Date().getTime() - pageload_ms;

        if (parseFloat(res.wood) < storagespace) {
            res.wood = parseFloat(res_p_ms.wood) * parseFloat(ms_since_pageload) + parseFloat(pageload_res.wood);
            $(document).ready(function(){
                $("#wood").css("color", "green");
            });
        } else {
            res.wood = storagespace;
            $(document).ready(function(){
                $("#wood").css("color", "red");
            });
        }
        document.getElementById('wood').innerHTML = res.wood.toFixed(decimals);

        if (parseFloat(res.clay) < storagespace) {
            res.clay = parseFloat(res_p_ms.clay) * parseFloat(ms_since_pageload) + parseFloat(pageload_res.clay);
            $(document).ready(function(){
                $("#clay").css("color", "green");
            });
        } else {
            res.clay = storagespace;
            $(document).ready(function(){
                $("#clay").css("color", "red");
            });
        }
        document.getElementById('clay').innerHTML = res.clay.toFixed(decimals);

        if (parseFloat(res.iron) < storagespace) {
            res.iron = parseFloat(res_p_ms.iron) * parseFloat(ms_since_pageload) + parseFloat(pageload_res.iron);
            $(document).ready(function(){
                $("#iron").css("color", "green");
            });
        } else {
            res.iron = storagespace;
            $(document).ready(function(){
                $("#iron").css("color", "red");
            });
        }
        document.getElementById('iron').innerHTML = res.iron.toFixed(decimals);

        if (parseFloat(res.wheat) < storagespace) {
            res.wheat = parseFloat(res_p_ms.wheat) * parseFloat(ms_since_pageload) + parseFloat(pageload_res.wheat);
            $(document).ready(function(){
                $("#wheat").css("color", "green");
            });
        } else {
            res.wheat = storagespace;
            $(document).ready(function(){
                $("#wheat").css("color", "red");
            });
        }
        document.getElementById('wheat').innerHTML = res.wheat.toFixed(decimals);

        <?php if($_SESSION["varadmin"] == 1){?>
        //Notify player if wheat is depleted once a second
        if (res.wheat <= 0 && log_once_a_second > 1000 / refresh_frequency) {
            var troop_death_amount = Math.ceil(res.wheat / 10);
            console.log("Warning: No wheat left, " + troop_death_amount + " Troops will die at next reload");
            log_once_a_second = 0;
        }
        log_once_a_second++;
        <?php }?>

        setTimeout("resup()", refresh_frequency);
    }

    var message = "<?php echo $_GET["message"];?>";
    if (message.length > 0) {
        alert(message);
    }
</script>