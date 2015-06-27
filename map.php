<?php
include "includes/databasedetails.php";
?>

<html>
<head>
<link rel="stylesheet" href="style/tetriumstyle.css" type="text/css" media="screen, projection" />
	<title>Tetrium Map</title>
</head>
	<body onfocus="onfocus()" onblur="onblur()">
<?php
//include database login and update resources
include "includes/databasedetails.php";
include "executables/start_logic.php";
?>
	
<!-- CSS GUI BEGINS -->
<center>
<div id="wrapper">
	
	<!-- HEADER -->
	<?php include("includes/tetriumheader.php") ?>
	<!-- HEADER -->
	
	<div id="middle">
	<div id="container">
	<div id="content">	
	
		
		
		

<div style="width: 500px; height: 500px;" id="mapbox">
	<br><br><br>
		
<?php
   $nocords=true;




	/*-----------------------------------------
	This is the mighty map square function
	-----------------------------------------*/	
	$x=0;
	$y=0;
	$vid=0;

	while ($y<10){
	$y++;
	//next line of pictures
	?><br><?php 
	while ($x<10){
	$x++;
	$vid++;
		$result = mysql_query("SELECT * FROM map WHERE x='$x' and y='$y'");
		if($row = mysql_fetch_array($result)){
			$villagename[$vid]=$row['village'];
			$owner[$vid]=$row['player'];
			$type[$vid]=$row['type'];
			$vidx[$vid]=$x;
			$vidy[$vid]=$y;
			
			$result = mysql_query("SELECT * FROM events WHERE target_village='$vid' and type='attack' and returning='0' and completed>NOW()");
			$underattack=mysql_num_rows($result);
			
			/*
			WORKS BY:
			FIRST CHECKING IF VILLAGE UNDER ATTACK (if yes stored in $underattack).
			SECOND it checks village type
			THIRD overwrites if under attack
			*/
			if ($row['type']==-1){ $location="images/mapgreen.png"; }elseif ($row['type']==1){ $location="images/mapvillagev2.png"; }
			if ($row['type']==-1 and $underattack>0){ $location="images/mapred.png"; }elseif ($row['type']==1 and $underattack>0){ $location="images/mapvillage_under_attack.png"; }
	
	?><a style="float: left;" id="village<?php echo $vid;?>" onMouseOut="hideTooltip(t<?php echo $vid;?>)" href="mapvillage.php?x=<?php echo $x; ?>&y=<?php echo $y; ?>" onmouseover="showvillage(<?php echo $vid;?>,t<?php echo $vid;?>,<?php echo $underattack;?>)"><div style="display:none; transform: translate(50px,50px);" id="t<?php echo $vid;?>"></div><img src="<?php echo $location;?>" alt="error"></a>
        <?php
		}
	}if ($x==10) { $x=0; }
	}
		

	/*-----------------------------------------
	This is the end of the mighty map function
	-----------------------------------------*/	
		
	
	
	
	?>
		</div><!-- #mapbox-->

		<br><div id="uppgrades"><!-- #uppgrades -->
			<?php
			include "includes/buildingtimer.php";
                        ?>
		</div><!-- #uppgrades -->
		
		
		</div><!-- #content-->
		</div><!-- #container-->
		
	<!-- SIDEBARS AND FOOTER -->
		
		<?php $map2=true;
			include("includes/tetriumsidebarsandfooter.php");
		?>
	<!-- SIDEBARS AND FOOTER -->
		
</div><!-- #wrapper -->
</center>
	
	<?php include("includes/tetriumjavascript.php"); ?>

	</body>
	</html>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	<!-- JAVASCRPTS -->
	<script>
	function showvillage(villageid,tool,attackamount){
		var villagename = <?php echo json_encode($villagename); ?>;
		var owner = (<?php echo json_encode($owner); ?>);
		var vidx = (<?php echo json_encode($vidx); ?>);
		var vidy = (<?php echo json_encode($vidy); ?>);
		var type = (<?php echo json_encode($type); ?>);
		
		/*document.getElementById('showvillagename').innerHTML = villagename[villageid];
	document.getElementById('showowner').innerHTML = owner[villageid];
	document.getElementById('showx').innerHTML = vidx[villageid];
	document.getElementById('showy').innerHTML = vidy[villageid];*/
		showTooltip(tool, villagename[villageid], owner[villageid], type[villageid], vidx[villageid], vidy[villageid], attackamount);
	}
	</script>
	
	<script language="javascript" type="text/javascript" >
function showTooltip(div, vname, owner, type, x, y, attackamount)
{
 div.style.display = 'flex';
 div.style.position = 'absolute';
 div.style.width = 'auto';
 div.style.backgroundColor = '#EFFCF0';
 div.style.border = 'solid 1px black';
 div.style.padding = '5px';
	
			if (type == -1){type="Oasis";}else{type="Village";}
	div.innerHTML = "(" + x + "|" + y + ")" +'<br>' + "Village name: " + vname +'<br>' + "Owner: " + owner +'<br>' + "Type: " + type +'<br>' + "Incoming Attacks: " + attackamount;
}
 
function hideTooltip(div)
{
	div.style.display = 'none';
}
</script>
