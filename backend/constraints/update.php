
<html>
<head> 
<meta charset="utf-8" />  
</head>
<style>
html{
    direction: rtl;
}
</style>
<?php
session_start();

header('Content-Type: text/html; charset=utf-8');
$servername = "localhost";
$username = "sharonsi_admin";
$password = "mikro123456";
$dbname="sharonsi_mikro";

  
// Create connection
 
$conn = new mysqli($servername, $username, $password,$dbname);

 
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
  mysqli_set_charset($conn,"utf8");
  
 $s_id =$_POST['subs'];
$p_name = $_POST['play'];
 
$or =$_SESSION['orNum'];

if($s_id!=null&&$p_name!=null) 
{
$update = "UPDATE constraints\n"

    . "SET subs_id=\"$s_id\",playName=\"$p_name\",isConstraint=0 WHERE num=\"$or\"";
     

if ($conn->query($update) === TRUE) {
    echo " ";
} else {
    echo "העדכון לא בוצע,אנא נסה שנית " . $conn->error;
}


$conn->close();
}
?>

