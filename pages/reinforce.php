<br><br>
<form name=mail action=executables/func_start.php id=reinforce method=GET>
    Village_name: <input type=text id=village name=village><br>
    X: <input type=text id=x name=x size=2 value=<?php echo $_GET["x"]; ?>>
    Y: <input type=text id=y name=y size=2 value=<?php echo $_GET["y"]; ?>><br>
    Clubswinger: <input type=text id=clubswinger name=clubswinger><br>
    Spearman: <input type=text id=spearman name=spearman><br>
    Axeman: <input type=text id=axeman name=axeman><br>
    Scouthorse: <input type=text id=scouthorse name=scouthorse><br>
    Knighthorse: <input type=text id=knighthorse name=knighthorse><br>
    Warhorse: <input type=text id=warhorse name=warhorse><br>
    <input type="hidden" name="type" value="reinforce">
    <input type=submit value=Send>
</form>