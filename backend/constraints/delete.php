<html>
<head> 
<meta charset="utf-8" />  
</head>

<?php
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
  
  $num = (int)$_GET['num']; // $num is now defined
  
  mysqli_query($conn,"DELETE FROM constraints WHERE num='".$num."'");
 mysqli_close($conn);
header("Location: constraints_management.php");

?>