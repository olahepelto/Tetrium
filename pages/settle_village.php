<br><br><br>
<form name=mail action=executables/settle.php id=settle method=GET>
    X: <input type=text id=x name=x size=2 value=<?php echo $_GET["x"]; ?>> Y: <input type=text id=y name=y size=2 value=<?php echo $_GET["y"]; ?>><br>
    Village_name: <input type=text id=village name=village value="<?php echo($mysql_data["player"]); ?>'s new village"><br>
    <input type=submit value="Settle Village">
</form>