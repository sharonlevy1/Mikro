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

$sql = "SELECT * FROM `actor`";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
     echo "<style>table{ color: black; text-align:center; border: 2px black solid;} tr{ color:black; border: 2px black solid;} td{ color: black; border: 2px black solid;}</style><table><tr><th>שם מלא</th><th>ת.ז</th><th>אימייל</th><th>סטטוס </th><th>טלפון </th>    </tr>";
     // output data of each row in table actors
     while($row = $result->fetch_assoc()) {
        // if ($row["status"]==תשובה שמתקבלת בפוסט בפורום ) 
        //בנתיים זה ידפיס את הכל אבל לפי שיטת פוסט כשנחבר זה ידפיס פעיל/לא פעיל/כולם
         echo "<tr><td>" . $row["firstName"]. " " . $row["lastName"]. "</td><td>" . $row["id"]. "</td><td>" .$row["email"]. "</td><td>".$row["status"]."</td><td>".$row["phone"]."</td></tr>";
     }
     echo "</table>";
} else {
     echo "0 results";
}

$conn->close();

?>