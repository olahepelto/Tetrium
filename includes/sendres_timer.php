<!-- GETS EPOCH OFFSET as seconds in variable epoch_offset -->
<?php
include "epoch_offset.php";
?>

<script>	
function sendres_secondsdate_timer_editon(seconds){

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
	if (numdays==0){ return" " + numhours + ":" + numminutes + ":" + numseconds + " hrs."; }
	else{return numdays + " days " + numhours + ":" + numminutes + ":" + numseconds + " hrs.";}
}
</script>




<?php


/*
OUTGOING IDS
*/
foreach ($sendres_event_ids_out as $timer_event_id){
if ($sendres_timer_ready_status[$timer_event_id]==false){
if ($_SESSION["varadmin"]==1){
echo "Wood:",$sendres_timer_send_wood[$timer_event_id]," Clay:",$sendres_timer_send_clay[$timer_event_id]," Iron:",$sendres_timer_send_iron[$timer_event_id]," Wheat:",$sendres_timer_send_wheat[$timer_event_id]," (To: ", $sendres_timer_village_name[$timer_event_id],")&nbsp;&nbsp;&nbsp;&nbsp;<b id=timer_id_".$timer_event_id." name=timer_id_".$timer_event_id.">Javascript Error</b>&nbsp;&nbsp;&nbsp;&nbsp;"," Done at: ",$sendres_timer_completed[$timer_event_id] ," <a href=executables/func_start.php?type=speedup&event_id=",$timer_event_id,">Speed up</a>","<br>";
}else{
echo "(Amount ", $sendres_timer_amount[$timer_event_id],") ","&nbsp;&nbsp;&nbsp;&nbsp;<b id=timer_id_".$timer_event_id." name=timer_id_".$timer_event_id.">Javascript Error</b>&nbsp;&nbsp;&nbsp;&nbsp;"," Done at: ",$sendres_timer_completed[$timer_event_id] ,"<br>";
}
}
}



/*
INCOMING IDS
*/
foreach ($sendres_event_ids_in as $timer_event_id){
if ($sendres_timer_ready_status[$timer_event_id]==false){
if ($_SESSION["varadmin"]==1){
echo "Wood:",$sendres_timer_send_wood[$timer_event_id]," Clay:",$sendres_timer_send_clay[$timer_event_id]," Iron:",$sendres_timer_send_iron[$timer_event_id]," Wheat:",$sendres_timer_send_wheat[$timer_event_id]," (From: ",$sendres_timer_village_name[$timer_event_id],")&nbsp;&nbsp;&nbsp;&nbsp;<b id=timer_id_".$timer_event_id." name=timer_id_".$timer_event_id.">Javascript Error</b>&nbsp;&nbsp;&nbsp;&nbsp;"," Done at: ",$sendres_timer_completed[$timer_event_id] ," <a href=executables/func_start.php?type=speedup&event_id=",$timer_event_id,">Speed up</a>","<br>";
}else{
echo "(Amount ", $sendres_timer_amount[$timer_event_id],") ","&nbsp;&nbsp;&nbsp;&nbsp;<b id=timer_id_".$timer_event_id." name=timer_id_".$timer_event_id.">Javascript Error</b>&nbsp;&nbsp;&nbsp;&nbsp;"," Done at: ",$sendres_timer_completed[$timer_event_id] ,"<br>";
}
}
}

/*
RETURNING IDS
*/
foreach ($sendres_event_ids_return as $timer_event_id){
if ($sendres_timer_ready_status[$timer_event_id]==false){
if ($_SESSION["varadmin"]==1){
echo "(Returning from: ",$sendres_timer_village_name[$timer_event_id],")&nbsp;&nbsp;&nbsp;&nbsp;<b id=timer_id_".$timer_event_id." name=timer_id_".$timer_event_id.">Javascript Error</b>&nbsp;&nbsp;&nbsp;&nbsp;"," Done at: ",$sendres_timer_return_completed[$timer_event_id] ," <a href=executables/func_start.php?type=speedup&event_id=",$timer_event_id,">Speed up</a>","<br>";}else{
echo "(Amount ", $sendres_timer_amount[$timer_event_id],") ","&nbsp;&nbsp;&nbsp;&nbsp;<b id=timer_id_".$timer_event_id." name=timer_id_".$timer_event_id.">Javascript Error</b>&nbsp;&nbsp;&nbsp;&nbsp;"," Done at: ",$sendres_timer_completed[$timer_event_id] ,"<br>";
}
}
}

/*
OUTGOING IDS
*/
foreach ($sendres_event_ids_out as $timer_event_id){
if ($sendres_timer_ready_status[$timer_event_id]==false){
?>
<script>
	var epoch=new Date();
	epoch=((epoch.getTime()-epoch.getMilliseconds())/1000)-epoch_offset;
	stro_completed="<?php echo $sendres_timer_stro_completed_out[$timer_event_id]; ?>";
	timedown<?php echo $timer_event_id; ?>(stro_completed);

function timedown<?php echo $timer_event_id; ?> (stro_completed) {
var epoch=new Date();
var epoch=((epoch.getTime()-epoch.getMilliseconds())/1000)-epoch_offset;
//console.log(epoch+"---"+epoch_offset);	
var element_id="timer_id_"+<?php echo $timer_event_id; ?>;
stro_completed="<?php echo $sendres_timer_stro_completed_out[$timer_event_id]; ?>";
var timediff_epoch_stro_completed = stro_completed-epoch;
var value_output = sendres_secondsdate_timer_editon(timediff_epoch_stro_completed);	
document.getElementById(element_id).innerHTML = value_output;


if(timediff_epoch_stro_completed<=0){
setTimeout("location.reload();",2000);
document.getElementById(element_id).innerHTML = "Done";
}else{setTimeout("timedown<?php echo $timer_event_id; ?>(stro_completed)",1000)}
}	
</script>
<?php }}









/*
RETURNING IDS
*/

foreach ($sendres_event_ids_return as $timer_event_id){
if ($sendres_timer_ready_status[$timer_event_id]==false){
?>
<script>
	var epoch=new Date();
	epoch=((epoch.getTime()-epoch.getMilliseconds())/1000)-epoch_offset;
	stro_completed="<?php echo $sendres_timer_stro_completed_return[$timer_event_id]; ?>";
	timedown<?php echo $timer_event_id; ?>(stro_completed);

function timedown<?php echo $timer_event_id; ?> (stro_completed) {
var epoch=new Date();
var epoch=((epoch.getTime()-epoch.getMilliseconds())/1000)-epoch_offset;
//console.log(epoch+"---"+epoch_offset);	
var element_id="timer_id_"+<?php echo $timer_event_id; ?>;
stro_completed="<?php echo $sendres_timer_stro_completed_return[$timer_event_id]; ?>";
var timediff_epoch_stro_completed = stro_completed-epoch;
var value_output = sendres_secondsdate_timer_editon(timediff_epoch_stro_completed);	
document.getElementById(element_id).innerHTML = value_output;


if(timediff_epoch_stro_completed<=0){
setTimeout("location.reload();",2000);
document.getElementById(element_id).innerHTML = "Done";
}else{setTimeout("timedown<?php echo $timer_event_id; ?>(stro_completed)",1000)}
}	
</script>
<?php }}

/*
INCOMING IDS
*/

foreach ($sendres_event_ids_in as $timer_event_id){
if ($sendres_timer_ready_status[$timer_event_id]==false){
?>
<script>
	var epoch=new Date();
	epoch=((epoch.getTime()-epoch.getMilliseconds())/1000)-epoch_offset;
	stro_completed="<?php echo $sendres_timer_stro_completed_in[$timer_event_id]; ?>";
	timedown<?php echo $timer_event_id; ?>(stro_completed);

function timedown<?php echo $timer_event_id; ?> (stro_completed) {
var epoch=new Date();
var epoch=((epoch.getTime()-epoch.getMilliseconds())/1000)-epoch_offset;
//console.log(epoch+"---"+epoch_offset);	
var element_id="timer_id_"+<?php echo $timer_event_id; ?>;
stro_completed="<?php echo $sendres_timer_stro_completed_in[$timer_event_id]; ?>";
var timediff_epoch_stro_completed = stro_completed-epoch;
var value_output = sendres_secondsdate_timer_editon(timediff_epoch_stro_completed);	
document.getElementById(element_id).innerHTML = value_output;


if(timediff_epoch_stro_completed<=0){
setTimeout("location.reload();",2000);
document.getElementById(element_id).innerHTML = "Done";
}else{setTimeout("timedown<?php echo $timer_event_id; ?>(stro_completed)",1000)}
}	
</script>
<?php }}?>
