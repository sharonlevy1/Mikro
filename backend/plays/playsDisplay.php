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

$sql = "SELECT * FROM `plays`";
$result = $conn->query($sql);

 

if ($result->num_rows > 0) {
     echo "<style>table{ color: black; text-align:center; border: 2px black solid;} tr{ color:black; border: 2px black solid;} td{ color: black; border: 2px black solid;width:350;height:150}</style><table><tr><th>שם</th><th>       תיאור</th><th>סטטוס</th>  </tr>";
     // output data of each row in table plays
     while($row = $result->fetch_assoc()) {
         
         // if ($row["status"]==תשובה שמתקבלת בפוסט בפורום ) 
        //בנתיים זה ידפיס את הכל אבל לפי שיטת פוסט כשנחבר זה ידפיס פעיל/לא פעיל/כולם
        
         echo "<tr><td>" . $row["name"]. "</td><td>" .$row["description"]. "</td><td>".$row["status"]."</td>  </tr>";
     }
     echo "</table>";
} else {
     echo "0 results";
}



$conn->close();

?>