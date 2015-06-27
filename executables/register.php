<?php
$notloggedin=true;
include "../includes/databasedetails.php";
$notloggedin=NULL;

//Santiation
$myusername = $_POST["myusername"];
$mypassword = $_POST["mypassword"];
$myemail = $_POST["myemail"];

$mypassword = md5($mypassword);


echo "Username: ",$myusername,"<br>";
echo "Password(md5): ",$mypassword,"<br>";
echo "Email: ",$myemail,"<br>";

$mysql_myusername = stripslashes($myusername);
$mysql_mypassword = stripslashes($mypassword);
$mysql_myemail = stripslashes($myemail);

$mysql_myusername = mysql_real_escape_string($mysql_myusername);
$mysql_mypassword = mysql_real_escape_string($mysql_mypassword);
$mysql_myemail = mysql_real_escape_string($mysql_myemail);

$count = mysql_num_rows("SELECT * FROM new_users WHERE username = '$mysql_myusername'");
if($count>0){
    echo "User already exists with that name";
    exit;
}
$count = mysql_num_rows("SELECT * FROM new_users WHERE username = '$mysql_myemail'");
if($count>0){
    echo "User already exists with that email";
    exit;
}

//activation code
$code = sha1(mt_rand(10000,99999).time().$myemail);

//1.New member
mysql_query("INSERT INTO new_users (username,email,password,code) VALUES ('$mysql_myusername','$mysql_myemail','$mysql_mypassword','$code')") or die(mysql_error());

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <noreply@tetrium.tk' . "\r\n";

mail("otto.lahepelto@gmail.com","kokko","57","");

/*
$to = $myemail;
$subject = "Tetrium activation";

$message = "
<html>
<head>
</head>
<body>
<p>Click on the link to confirm registration</p>
<a href='tetrium.tk/tetrium/activation.php?code=".$code."'>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <noreply@tetrium.tk' . "\r\n";

mail($to,$subject,$message,$headers);
*/




//2.Replace nature village on map with user
?>