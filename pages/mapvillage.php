<?php
$map=true;
$x=$_GET["x"];
$y=$_GET["y"];
//show village

$result = mysql_query("SELECT * FROM map WHERE x='$x' and y='$y'");

//fetch everything from the first query
while ($row = mysql_fetch_assoc($result)){
$villagename = $row["village"];
$villagex = $row["x"];
$villagey = $row["y"];
$village_id = $row["village_id"];
$id2 = $row["id"];
}

//check if own village then redirect to tetrium.php
if ($id2==$id){
$_SESSION["current_village_id"]=$village_id;
header("location: tetrium.php");
exit;	
}
?>
	
<!-- CSS GUI BEGINS -->
<center>
    <br>
    <font size=6><?php echo $villagename, " (", $villagex, "|", $villagey, ")"; ?></font><br><br>
    <div id=resourcefields>
        <img src="images/bettervillage.png" alt="Error">
        <?php if (isset($_GET["message"])){ ?>
        <script type="text/javascript">
            alert("<?php echo $_GET["message"]; ?>");
            window.location = "../tetrium.php";
        </script>
        <?php }?>
        <a><div id=woodcutter1level2><img src="images/boll.png" alt="Error"></div></a>
        <a><div id=woodcutter2level2><img src="images/boll.png" alt="Error"></div></a>
        <a><div id=woodcutter3level2><img src="images/boll.png" alt="Error"></div></a>
        <a><div id=woodcutter4level2><img src="images/boll.png" alt="Error"></div></a>
	
        <a><div id=claypit1level2><img src="images/boll.png" alt="Error"></div></a>
        <a><div id=claypit2level2><img src="images/boll.png" alt="Error"></div></a>
        <a><div id=claypit3level2><img src="images/boll.png" alt="Error"></div></a>
        <a><div id=claypit4level2><img src="images/boll.png" alt="Error"></div></a>
	
        <a><div id=ironmine1level2><img src="images/boll.png" alt="Error"></div></a>
        <a><div id=ironmine2level2><img src="images/boll.png" alt="Error"></div></a>
        <a><div id=ironmine3level2><img src="images/boll.png" alt="Error"></div></a>
        <a><div id=ironmine4level2><img src="images/boll.png" alt="Error"></div></a>
	
        <a><div id=cropland1level2><img src="images/boll.png" alt="Error"></div></a>
        <a><div id=cropland2level2><img src="images/boll.png" alt="Error"></div></a>
        <a><div id=cropland3level2><img src="images/boll.png" alt="Error"></div></a>
        <a><div id=cropland4level2><img src="images/boll.png" alt="Error"></div></a>
        <a><div id=cropland5level2><img src="images/boll.png" alt="Error"></div></a>
        <a><div id=cropland6level2><img src="images/boll.png" alt="Error"></div></a>
    </div><!-- #resourcefields -->
</center>