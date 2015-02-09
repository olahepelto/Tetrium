
<br><font size=4>Train troops</font><br><br>


<form action="executables/func_start.php" method="get">
<br>
Type:<select onchange="newprice()" name=troop_type id=troop_type>
  <option value="clubswinger">Clubswinger level 1</option>
  <option value="spearman">Spearman level 5</option>
  <option value="axeman">Axeman level 10</option>
</select><br>
  Amount:<input onchange="newprice()" id="train_amount" type="text" name="train_amount"><br>
	Wood:<class id=pricewood>0</class> Clay:<class id=priceclay>0</class> Iron:<class id=priceiron>0</class> Wheat:<class id=pricewheat>0</class> Time:<class id=pricetime>0</class><br>
  <input type="submit" value="Submit">
</form>

<?php
include "includes/troop_build_timer.php";
?>
<!--ERROR IF NOT ENOUGH RESOURCES-->
<?php echo"<h3>",$_GET["message"],"</h3>";$_GET["message"]=NULL;?>


<script>
	
	
function secondsdate_barracks_editon(seconds){

var numdays = Math.floor(seconds / 86400);
var numhours = Math.floor((seconds % 86400) / 3600);
var numminutes = Math.floor(((seconds % 86400) % 3600) / 60);
var numseconds = ((seconds % 86400) % 3600) % 60;

var lenght_s = numseconds.toString().length;
var lenght_m = numminutes.toString().length;
var lenght_h = numhours.toString().length;

if (lenght_s==1){numseconds="0"+numseconds;}
if (lenght_m==1){numminutes="0"+numminutes;}
if (lenght_h==1){numhours="0"+numhours;}
	
	if (numdays==0 && numhours==0 && numminutes==0){ return " 00:00:"+numseconds +" hrs."; }
	if (numdays==0 && numhours==0){ return " 00:"+numminutes + ":" + numseconds + " hrs."; }
	if (numdays==0){ return" " + numhours + ":" + numminutes + ":" + numseconds + "hrs."; }
	else{return numdays + " days " + numhours + ":" + numminutes + ":" + numseconds + " hrs.";}
}	
window.onload=newprice();
function newprice(){
var amount = document.getElementById("train_amount").value;
var troop_type = document.getElementById("troop_type").value;

if(troop_type=="clubswinger"){
var wood_troop_price=20*amount;
var clay_troop_price=0*amount;
var iron_troop_price=10*amount;
var wheat_troop_price=10*amount;
var time_troop_price=10*amount;
}
if(troop_type=="spearman"){
var wood_troop_price=10*amount;
var clay_troop_price=10*amount;
var iron_troop_price=30*amount;
var wheat_troop_price=10*amount;
var time_troop_price=15*amount;
}
if(troop_type=="axeman"){
var wood_troop_price=10*amount;
var clay_troop_price=10*amount;
var iron_troop_price=20*amount;
var wheat_troop_price=10*amount;
var time_troop_price=20*amount;
}	
time_troop_price=secondsdate_barracks_editon(time_troop_price);
document.getElementById("pricewood").innerHTML=wood_troop_price;
document.getElementById("priceclay").innerHTML=clay_troop_price;
document.getElementById("priceiron").innerHTML=iron_troop_price;
document.getElementById("pricewheat").innerHTML=wheat_troop_price;
document.getElementById("pricetime").innerHTML=time_troop_price;
}
	
</script>