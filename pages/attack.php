<br><br>
<form name=mail action=executables/func_start.php id=sendres method=GET>
    Village_name: <input type=text id=village name=village><br>
    X: <input type=text id=x name=x size=2 value=<?php echo $_GET["x"]; ?>>
    Y: <input type=text id=y name=y size=2 value=<?php echo $_GET["y"]; ?>><br>
    Clubswinger: <input type=text id=clubswinger name=clubswinger><br>
    Spearman: <input type=text id=spearman name=spearman><br>
    Axeman: <input type=text id=axeman name=axeman><br>
    <input type="hidden" name="type" value="attack">
    <input type=submit value=Send>
</form>