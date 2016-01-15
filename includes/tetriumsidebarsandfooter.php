<?php      
if($_SESSION["varadmin"]==1){ ?>
<div  style='transform: translate(-300px,-100px)' class="sidebar" id="sideLeft">	
		<b><strong>DEBUG:</strong></b><br>
                <form action="executables/func_start.php?">
                    <input type="hidden" value="debug_data" name="type" id="type">
                    X:<input id="x" name="x" style="width:20px;">
                    Y:<input id="y" name="y" style="width:20px;">
                    <br>OR<br>
                    Name:<input id="vname" name="vname" style="width:100px;">
                    <br>
                    <input type="submit" value="Get data">
                </form>
                <a onclick="window.open('Debug_popup.php', Math.random()*100*Math.random()*100*Math.random()*100, 'width=250, height=1000');">Popup</a><br>
                    <?php
                if(empty($_GET["debug_vid"])){$_GET["debug_vid"]=$current_village_id;}
                print_debug($_GET["debug_vid"]);?>
		</div><!-- .sidebar#sideLeft -->
<?php }?>
<div <?php if($_SESSION["varadmin"]==1){echo "style='transform: translate(-300px,0px)'";}?> class="sidebar2" id="sideLeft2">	
		<b><strong>MENU:</strong></b><br>
		<a href="https://bitbucket.org/tetrium/tetrium/" style="text-decoration: none;">
		<div id="button">
		Bitbucket
		</div>
		</a>
		<a href="cpassgui.php" style="text-decoration: none;">
			<div id="button">
		Change Password
		</div>
			</a>

		<div id="button" onclick="var newname=window.prompt('Please enter new village name');if(newname===null){}else{window.location.href = '../tetrium.php?newvillagename=' + newname;}">
		Change village name
		</div>
			<?php if($_SESSION['varadmin'] == 1){ ?>
		<a href="admin.php" style="text-decoration: none;">
		<div id="button">
		Admin panel<br>
				</div></a>
		<a href="../phpmyadmin" style="text-decoration: none;">
					<div id="button">
			Database
</div>
			</a>
		<a href="changeinfo.php" style="text-decoration: none;">
		<div id="button">
			Change infsss<br>
				</div></a>
		<?php } ?>
		<a href="executables/func_start.php?type=logout" style="text-decoration: none;">
<div id="button">
		Logout<br>
		</div>
		</a>
</div><!-- .sidebar#sideLeft -->

<?php if ($sendres_timer_event_ammount_in>0 or $sendres_timer_event_ammount_out>0 or $troop_timer_event_ammount>0 or $returning_sendres_timer_event_ammount>0 or $attack_timer_event_ammount_in>0 or $attack_timer_event_ammount_out>0  or $returning_attack_timer_event_ammount>0){?>
<div style="width: 200px; float: right;">
		<div class="sidebar" id="sideRight" style="background:cadetblue;">
			<?php if ($troop_timer_event_ammount>0){?><strong>Troop Training:</strong><br><?php }?>
			<?php if ($troop_timer_event_ammount>0){echo $troop_timer_event_ammount;?> troop(s) in<?php }?>
			<?php if ($troop_timer_event_ammount>0){echo "<b id=sidebar_timer_id_".$troop_timer_event_min_time_id." name=sidebar_timer_id_".$troop_timer_event_min_time_id.">Javascript Error</b><br>"; }?>
			
			<?php if ($returning_sendres_timer_event_ammount>0 or $returning_attack_timer_event_ammount>0){?><strong>Returning:</strong><br><?php }?>
			<?php if ($returning_sendres_timer_event_ammount>0){echo $returning_sendres_timer_event_ammount;?> shipments(s) in<?php }?>
			<?php if ($returning_sendres_timer_event_ammount>0){echo "<b id=sidebar_timer_id_".$returning_sendres_timer_event_min_time_id." name=sidebar_timer_id_".$returning_sendres_timer_event_min_time_id.">Javascript Error</b><br>"; }?>
			
			<?php if ($returning_attack_timer_event_ammount>0){echo $returning_attack_timer_event_ammount;?> attack(s) in<?php }?>
			<?php if ($returning_attack_timer_event_ammount>0){echo "<b id=sidebar_timer_id_".$returning_attack_timer_event_min_time_id." name=sidebar_timer_id_".$returning_attack_timer_event_min_time_id.">Javascript Error</b><br>"; }?>
			
			<?php if ($sendres_timer_event_ammount_in>0 or $attack_timer_event_ammount_in){?><strong>Incoming:</strong><br><?php }?>
			<?php if ($sendres_timer_event_ammount_in>0){ echo $sendres_timer_event_ammount_in;?> shipment(s) in<?php }

//INCOMING IDS Javascript for this is in sidebar_javascript.php
if ($sendres_timer_event_ammount_in>0){echo "<b id=sidebar_timer_id_".$sendres_timer_event_min_time_id_in." name=sidebar_timer_id_".$sendres_timer_event_min_time_id_in.">Javascript Error</b><br>"; }?>

			<?php if ($attack_timer_event_ammount_in>0){ echo $attack_timer_event_ammount_in;
				if($attack_timer_event_ammount_in==1){
					echo " attack in";
				}else{
					echo " attacks in";
				}
				}
				//attack(s) in<?
			//}
			 if ($attack_timer_event_ammount_in>0){echo "<b id=sidebar_timer_id_".$attack_timer_event_min_time_id_in." name=sidebar_timer_id_".$attack_timer_event_min_time_id_in.">Javascript Error</b><br>";}
			if ($sendres_timer_event_ammount_out>0 or $attack_timer_event_ammount_out){?><strong>Outgoing:</strong><br><?php }?>
			<?php if ($sendres_timer_event_ammount_out>0){echo $sendres_timer_event_ammount_out; ?> shipment(s) in<?php }
			if ($sendres_timer_event_ammount_out>0){echo "<b id=sidebar_timer_id_".$sendres_timer_event_min_time_id_out." name=sidebar_timer_id_".$sendres_timer_event_min_time_id_out.">Javascript Error</b><br>";}?>
			<?php if ($attack_timer_event_ammount_out>0){echo $attack_timer_event_ammount_out; ?> attack(s) in<?php }
			if ($attack_timer_event_ammount_out>0){echo "<b id=sidebar_timer_id_".$attack_timer_event_min_time_id_out." name=sidebar_timer_id_".$attack_timer_event_min_time_id_out.">Javascript Error</b><br>";}
			
//OUTGOING IDS Javascript for this is in sidebar_javascript.php
?>
		</div><!-- .sidebar#sideoverRight -->
	<?php }?>
<?php
include "sidebar_javascript.php";
?>
	

<div style="width: 200px; float: right;">

	<div class="sidebar" id="sideRight">
			
			<strong><?php echo "Resource production";?></strong><br>
			<?php echo "Wood: ", $woodcuttersh, " per hour";?><br>
			<?php echo "Clay: ", $claypitsh, " per hour";?><br>
			<?php echo "Iron: ", $ironminesh, " per hour";?><br>
			<?php echo "Potatoes: ", $croplandsh, " per hour";?><br>
			
			
		</div><!-- .sidebar#sideRight -->
	
		<div class="sidebar" id="sideUnderRight">
			
			
			<strong>Buildings:</strong><br>
			<a href="tetrium.php?p=ugg&building=mainbuilding">Main Building Level: <?php echo $mainbuilding;?></a><br>
			<a href="tetrium.php?p=ugg&building=storage">Storage Level: <?php echo $storage;?></a><br>
			<a href="tetrium.php?p=ugg&building=barracks">Barracks Level: <?php echo $barracks;?></a><br>
			<a href="tetrium.php?p=ugg&building=marketplace">Marketplace Level: <?php echo $marketplace;?></a><br>
			<a href="tetrium.php?p=ugg&building=stable">Stable Level: <?php echo $stable;?></a><br>
			<a href="tetrium.php?p=ugg&building=wall">Wall Level: <?php echo $wall;?></a><br>
			More Coming soon<br>
			
			
		</div><!-- .sidebar#UndersideRight -->

	
	<?php if ($mysql_data["clubswinger"]>0 or $mysql_data["spearman"]>0 or $mysql_data["axeman"]>0){?>
		<div class="sidebar" id="sideUnderUnderRight">	
			
			<strong>Troops:</strong><br>
			<?php
			if ($mysql_data["clubswinger"]==1){echo "1 Clubswinger<br>";}
			if ($mysql_data["spearman"]==1){echo "1 Spearman<br>";}
			if ($mysql_data["axeman"]==1){echo "1 Axeman<br>";}
			
			if ($mysql_data["clubswinger"]>1){echo $mysql_data["clubswinger"]," Clubswingers<br>";}
			if ($mysql_data["spearman"]>1){echo $mysql_data["spearman"]," Spearmen<br>";}
			if ($mysql_data["axeman"]>1){echo $mysql_data["axeman"]," Axemen<br>";}
			echo "<br>Upkeep: ",$mysql_data["clubswinger"]+$mysql_data["spearman"]+$mysql_data["axeman"]," Pizzas per hour","<br>";
			?>
			
			</div><!-- .sidebar#UndersideRight -->
	
		<?php}?>
	
	
	
	<?php if ($map==true){ ?>
	<!--MAP-->
	<div class="sidebar" id="sideUnderRight" style="background: #2E64FE;">
	<strong>Actions:<br>
		<a style="color:#FE2E2E;" href="tetrium.php?p=att&x=<?php echo $_GET["x"];?>&y=<?php echo $_GET["y"]; ?>">Attack</a><br>
		<a style="color:#40FF00;" href="reinforce.php?y=<?php echo $_GET["x"];?>&y=<?php echo $_GET["y"]; ?>">Reinforce</a><br>
		<a style="color:#40FF00;" href="tetrium.php?p=srs&x=<?php echo $_GET["x"];?>&y=<?php echo $_GET["y"]; ?>">Send resources</a>
		
	</strong>
	</div><!-- /MAP -->	
	<?php }elseif($nocords==true){?>
	
	<!--MAP-->
	<div class="sidebar" id="sideUnderRight" style="background: #2E64FE;">
	<strong>Actions:<br>
		<a style="color:#FE2E2E;" href="tetrium.php?p=att&nocords=true">Attack</a><br>
		<a style="color:#40FF00;" href="reinforce.php?nocords=true">Reinforce</a><br>
		<a style="color:#40FF00;" href="tetrium.php?p=srs&nocords=true">Send resources</a>
		
	</strong>
        </div>
        <!-- /MAP -->	

<?php } ?>
	</div>
	</div><!-- #middle-->
	<div id="footer">
</div><!-- #footer -->