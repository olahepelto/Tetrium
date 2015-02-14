From:
<form  action="executables/func_start.php" method="get">
  Wood<input onchange="newprice()" type="text" name="give_wood"><br>
  Clay<input onchange="newprice()" type="text" name="give_clay"><br>
  Iron<input onchange="newprice()" type="text" name="give_iron"><br>
  Wheat<input onchange="newprice()" type="text" name="give_wheat"><br>
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

var wood = document.getElementById("give_wood").value;
var clay = document.getElementById("give_clay").value;	
var iron = document.getElementById("give_iron").value;
var wheat = document.getElementById("give_wheat").value;

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