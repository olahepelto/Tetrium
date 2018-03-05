<?php
  
include_once("configuration/databasecredentials.php");

$connection = mysql_connect($host, $username, $password) or die (mysql_error());

mysql_select_db($db_name, $connection) or die (mysql_error());

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
  
  
$username = stripslashes($username);
$password = stripslashes($password);
$email = stripslashes($email);

$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);
$email = mysql_real_escape_string($email);
  
$hashedpassword = md5(md5($password."another salt").md5("hello_this_is_my_salt").$password);

  
$count = mysql_num_rows("SELECT * FROM members WHERE username = '$username'");
if ($count > 0) {
    echo "User already exists with that name";
    exit;
}
$count = mysql_num_rows("SELECT * FROM members WHERE email = '$email'");
if ($count > 0) {
    echo "User already exists with that email";
    exit;
}
  
  

if($_POST['code'] == "itsjustacode" and $_GET['password'] == $_GET['passwordagain']){
  mysql_query("INSERT INTO members (username, email, password) VALUES ('$username', '$email', '$hashedpassword')") or die("Mysql Error!");
 
  
  $tries = 0;
  $player = "";
  while($player != "nature" && $tries < 20){
    $village_id = rand(0,250);
    $result = mysql_query("SELECT player FROM map WHERE village_id='$village_id'");
    while ($row = mysql_fetch_assoc($result)) {
        $player = $row["player"];
    }
    $tries++;
  }
  if($tries > 15){
    echo "ERROR, Contact support";
    exit;
  }
  
  $player_id = mysql_query("SELECT id FROM members WHERE username='$username' AND email='$email' AND password='$hashedpassword'");
  while ($row = mysql_fetch_assoc($player_id)) {
        $player_id = $row["id"];
    }
  
  mysql_query("UPDATE map SET village = 'New Village' WHERE village_id='$village_id'") or die(mysql_error());
  mysql_query("UPDATE map SET player = '$username' WHERE village_id='$village_id'") or die(mysql_error());
  mysql_query("UPDATE map SET type = '1' WHERE village_id='$village_id'") or die(mysql_error());
  mysql_query("UPDATE map SET id = '$player_id' WHERE village_id='$village_id'") or die(mysql_error());
}

header("location: /main_login.php");
?>