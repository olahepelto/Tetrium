<form action="../executables/func_start.php" method=GET>
<select id=switch_id name=switch_id>
<?php
foreach($all_user_villages_ids as $user_village_id){

$result = mysql_query("SELECT village FROM map WHERE village_id='$user_village_id'");
while ($row = mysql_fetch_array($result)){$user_village_name = $row["village"];}
?>
    <option value=<?php echo $user_village_id; ?>><?php echo $user_village_name;?></option>
<?php
}
?>

</select>
<br>
<input type="submit">
</form>	