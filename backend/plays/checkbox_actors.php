<meta charset="utf-8" />  
</head>

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
 $pn = $_SESSION['play_name'];
 "<br>";
  
    $sql2 = "SELECT * FROM actor\n"

    . "INNER JOIN actors_in_plays ON actors_in_plays.id = actor.id\n"

    . "where actors_in_plays.playName=\"$pn\"";
    $result2 = $conn->query($sql2);
    $actors=array();
    //only active one;
    $all_actors=array();
    $index2=0; 
    $index=0;
    
  

//i put in an array all the id's of the actors that participate in an active play
    while($row = $result2->fetch_assoc()) {
     
               $actors[$index2]=$row["id"];
               // echo $actors[$index2], " "; 
                           $index2++; 
                           
                          
     }
  
$qsql = "SELECT id,firstName,lastName FROM actor\n"

    . "WHERE actor.status=\"פעיל\"";
    
    $result10 = $conn->query($qsql);
 
     while($row = $result10->fetch_assoc()) {
         
         if($actors[$index]==$row["id"]&&count($actors)>$index)  
         {
        echo '<input type="checkbox" name="check_list[]" value="'.$row['id'].'" checked ><label>' .$row['firstName']." ". $row['lastName'] ." ". '  </label>'; 
         $index++;
         }
         
         else
         {
             echo '<input type="checkbox" name="check_list[]" value="'.$row['id'].'"><label>' .$row['firstName']." ". $row['lastName'] ." ". '  </label>';  
             
         }
        echo "<br>";
     }
     
     foreach ($all_actors as $find)
     {
       foreach ($actors as $checked)
         if ($find==$checked)
         echo "checked";
         
     }
     
     
     
    



   
 mysqli_close($conn);
 

?>