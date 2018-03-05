<style type="text/css">
    .tg {
        border-collapse: collapse;
        border-spacing: 0;
        margin: 0px auto;
    }

    .tg td {
        font-family: Arial, sans-serif;
        font-size: 14px;
        padding: 0px 0px;
        border-style: solid;
        border-width: 1px;
        overflow: hidden;
        word-break: normal;
    }

    .tg th {
        font-family: Arial, sans-serif;
        font-size: 14px;
        font-weight: normal;
        padding: 0px 14px;
        border-style: solid;
        border-width: 1px;
        overflow: hidden;
        word-break: normal;
    }

    .tg .tg-w6cq {
        font-family: Tahoma, Geneva, sans-serif !important;;
        background-color: #fd6868
    }

    .tg .tg-mfgs {
        font-family: Tahoma, Geneva, sans-serif !important;;
        background-color: #94d180
    }

    .tg .tg-w6cu {
        font-family: Tahoma, Geneva, sans-serif !important;;
        background-color: #BEBEB6
    }

    .tg .tg-w6cr {
        font-family: Tahoma, Geneva, sans-serif !important;;
        background-color: #8585E0
    }
    .tg .tg-reinf {
        font-family: Tahoma, Geneva, sans-serif !important;;
        background-color: #ad79ff
    }

    .tg .tg-gmhj {
        font-family: Tahoma, Geneva, sans-serif !important;;
        min-width: 70px
    }

    table, th, td {
        border: 1px solid black;
    }
</style>


<br><br>
<?php
if ($_SESSION['varadmin'] == 0) {
    header("location:tetrium.php?p=res");
    exit;
}

$data = mysql_query("SELECT * FROM members") or die("DIED");
$data2 = mysql_query("SELECT * FROM map") or die("DIED");

Print "<table class='tg' align=center border cellpadding=0>";
Print "<th>Id:</th><th>Username</th><th>Wood</th><th>Clay</th><th>Iron</th><th>Wheat</th><th>Edit</th><th></th></tr>";

while($info = mysql_fetch_array($data) and $info2 = mysql_fetch_array($data2)) {// &&
    Print "<tr>";
    Print "<td>".$info['id'] . "</td><td>".$info['username'] . "</td><td>".round($info['wood']) . "</td></td><td>".round($info['clay']) . "</td><td>".round($info['iron']) . "</td><td>".round($info['wheat']) . "</td><td><input type='radio' name='edit' form='admin' value=".$info['id'] . "></td><td><a href='/executables/adminaction.php?login=".$info['id']."'>login</a></td></tr>";
}
Print "</table>";
?>
<form action="executables/adminaction.php" id="admin" method="get">			
Wood: <input type="text" name="wood"><br>
Clay: <input type="text" name="clay"><br>
Iron: <input type="text" name="iron"><br>
Wheat: <input type="text" name="wheat"><br>
<input type="submit" value="Submit">
</form>