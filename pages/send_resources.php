<br><br><br>
<form name=mail action=executables/sendres.php id=sendres method=GET>
    Village_name: <input type=text id=village name=village><br>
    X: <input type=text id=x name=x size=2 value=<?php echo $_GET["x"]; ?>> Y: <input type=text id=y name=y size=2 value=<?php echo $_GET["y"]; ?>><br>
    Wood: <input type=text id=wood_box name=wood_box><a style="cursor:pointer;" onclick='document.getElementById("wood_box").value = document.getElementById("wood").innerHTML'>max</a><br>
    Clay: <input type=text id=clay_box name=clay_box><a style="cursor:pointer;" onclick='document.getElementById("clay_box").value = document.getElementById("clay").innerHTML'>max</a><br>
    Iron: <input type=text id=iron_box name=iron_box><a style="cursor:pointer;" onclick='document.getElementById("iron_box").value = document.getElementById("iron").innerHTML'>max</a><br>
    Wheat: <input type=text id=wheat_box name=wheat_box><a style="cursor:pointer;" onclick='document.getElementById("wheat_box").value = document.getElementById("wheat").innerHTML'>max</a><br>
    <input type=submit value=Send>
</form>