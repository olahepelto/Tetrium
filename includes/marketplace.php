<?php
$market_level_multiplier=($marketplace/50);
$market_multiplier=0.80+$market_level_multiplier;
//MAX MARKET MULTIPLIER
if ($market_multiplier>1){
$market_multiplier=1;
}
?>

From:
<form  action="executables/marketaction.php" method="post">
  Wood<input onchange="newprice()" type="text" name="tradewood" id="tradewood"><br>
  Clay<input onchange="newprice()" type="text" name="tradeclay" id="tradeclay"><br>
  Iron<input onchange="newprice()" type="text" name="tradeiron" id="tradeiron"><br>
  Wheat<input onchange="newprice()" type="text" name="tradewheat" id="tradewheat"><br>
<br>
To:<select name=wantresource>
  <option value="1" id=wood_selector>Wood:0</option>
  <option value="2" id=clay_selector>Clay: 0</option>
  <option value="3" id=iron_selector>Iron: 0</option>
  <option value="4" id=wheat_selector>Wheat: 0</option>
</select><br>
  <input type="submit" value="Submit">
</form>
<br>
<?php
include "includes/sendres_timer.php";
?>
<script>
function newprice(){

var wood = document.getElementById("tradewood").value;
var clay = document.getElementById("tradeclay").value;	
var iron = document.getElementById("tradeiron").value;
var wheat = document.getElementById("tradewheat").value;

if (wood.length==0){wood=0;}
if (clay.length==0){clay=0;}
if (iron.length==0){iron=0;}
if (wheat.length==0){wheat=0;}
	
var res = parseFloat(wood)+parseFloat(clay)+parseFloat(iron)+parseFloat(wheat);

res=res*<?php echo $market_multiplier;?>;
	
	document.getElementById("wood_selector").innerHTML="Wood: "+res;
document.getElementById("clay_selector").innerHTML="Clay: "+res;
document.getElementById("iron_selector").innerHTML="Iron: "+res;
document.getElementById("wheat_selector").innerHTML="Wheat: "+res;
}
</script>