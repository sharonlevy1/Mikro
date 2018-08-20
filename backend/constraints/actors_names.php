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
  
$qsql = "SELECT id,firstName,lastName FROM actor\n"

    . "WHERE actor.status=\"פעיל\"";
    
    $result10 = $conn->query($qsql);

     echo'<option disabled selected value="">בחר</option>'; 
     while($row = $result10->fetch_assoc()) {
    
        echo '<option value="'.$row['id'].'">' .$row['firstName']." ". $row['lastName'] ." ". '</option>';   
  
     }
    



   
 mysqli_close($conn);
 

?>