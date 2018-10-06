
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


 $playN = $_GET['name'];
  mysqli_set_charset($conn,"utf8");
  
$sqlp = "SELECT firstName,lastName FROM actor\n"

    . "INNER JOIN actors_in_plays ON actors_in_plays.id=actor.id\n"

    . "WHERE actors_in_plays.playName=\"$playN\"\n"

    . "ORDER BY firstName";
    
$resultp = $conn->query($sqlp);

if ($resultp->num_rows > 0) {
     // output data of each row in table actors
    
     while($row = $resultp->fetch_assoc()) {
         //if ($row["status"]=='פעיל' ) 
          
               echo "<li>" . $row["firstName"]. " " . $row["lastName"]. "</li>";
     }
     
}

$conn->close();
 
?>



 