 <html>
<head> 
<meta charset="utf-8" />

 <link rel="stylesheet" href="index.css">
</head>

<style> <?php include 'index.css'; ?> </style>
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

  mysqli_set_charset($conn,"utf8");
  

$sql = "SELECT num,user_id,subs_id,date,playName,description, range_1,range_2,range_3 FROM`constraints`";

//users query
$sql2 = "SELECT firstName,lastName FROM actor\n"

   . "INNER JOIN constraints ON constraints.user_id=actor.id";
   
 //going to put all the names of the requesting for constraint users on array an, later print it on the suitable column
$actors_name=array();
$index=0;
    
$result2 = $conn->query($sql2);

     while($row = $result2->fetch_assoc()) {
     
               $actors_name[$index]=$row["firstName"]." ".$row["lastName"];
               $index++;    
     }
     
 //going to put all the names of the substitude for constraint users on array an ,later print it on the suitable column     
$sql3 = "SELECT firstName,lastName FROM actor\n"

    . "INNER JOIN constraints ON constraints.subs_id=actor.id";
     

 $result3 = $conn->query($sql3);
 $subs_name=array();
$index3=0;
 
  while($row = $result3->fetch_assoc()) {
     
               $subs_name[$index3]=$row["firstName"]." ".$row["lastName"];
               $index3++;    
     }
     
    //need this to search the unique number in order to find where to print the substitude actor name in the table
     
$sql4 = "SELECT num,subs_id FROM `constraints`\n"

    . "WHERE isConstraint=0";
    
     $result4 = $conn->query($sql4);
 $subs_num=array();
$index5=0;


 while($row = $result4->fetch_assoc()) {
     
               $subs_num[$index5]=$row["num"];
               $index5++;    
     }
    
    
    
$result = $conn->query($sql);

 $index2=0;
 $index4=0;
 $index6=0;

if ($result->num_rows ) {
     echo "<style>table{ color: black; text-align:center; border: 2px black solid;width:850;margin:auto} tr{ color:black; border: 2px black solid;} td{ color: black; border: 2px black solid;width:200;height:150}</style><table><tr><th></th><th></th><th>מבקש האילוץ</th><th> מחליף</th><th >תאריך</th>
     <th>שם ההצגה</th> <th>סיבת האילוץ</th> <th>טווח 1 </th> <th>טווח 2 </th> <th>טווח 3 </th></tr>";
     // output data of each row in table plays
     while($row = $result->fetch_assoc()) {
         
        if($subs_num[$index6]==$row["num"]){
         echo "<tr><td><a href=\"edit.php?num=".$row['num']."\">עדכן</a></td><td><a href=\"delete.php?num=".$row['num']."\">מחק</a></td><td>".$actors_name[$index2]. "</td><td> " .$subs_name[$index4]. "</td><td>".$row["date"]."</td><td>".$row["playName"]."</td>
         <td>".$row["description"]."</td><td>".$row["range_1"]."</td><td>".$row["range_2"]."</td><td>".$row["range_3"]."</td></tr>";
         
           $index4++;
           $index6++;
        }
        else{
             echo "<tr><td><a href=\"edit.php?num=".$row['num']."\">עדכן</a></td><td><a href=\"delete.php?num=".$row['num']."\">מחק</a></td><td>".$actors_name[$index2]. "</td><td>"."</td><td>".$row["date"]."</td><td>".$row["playName"]."</td>
         <td>".$row["description"]."</td><td>".$row["range_1"]."</td><td>".$row["range_2"]."</td><td>".$row["range_3"]."</td></tr>";
            
        }
        
         $index2++;
        
         
     }
    
     echo "</table>";
} else {
     echo "אין אילוצים";
}



$conn->close();

?>