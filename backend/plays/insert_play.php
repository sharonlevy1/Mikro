 
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
  
      

if(isset($_POST['submit'])){

    if(!empty($_POST['check_list'])&&!empty($_POST['playName'])){
        if ($_POST['isActive']=="yes")
        {
            $status="פעיל";
        }
        else{
            $status="לא פעיל";
        }
         $playName=$_POST['playName'];
          $description=$_POST['description'];
         
        //creating the play
        $insert = "INSERT IGNORE INTO `plays` (name,description,status) VALUES ('$playName','$description','$status')";
     if ($conn->query($insert) === FALSE) {
       
     echo " ". $conn->error;
      
       }
        
        
        //putting actors in the play
        
         foreach($_POST['check_list'] as $selected){
           
      $insert2 = "INSERT IGNORE INTO `actors_in_plays` (id,playName) VALUES ('$selected','$playName')";
         
       if ($conn->query($insert2) === FALSE) {
       
      echo " ". $conn->error;
      
          }
         
       }
      
         
      
   
 }
         
      mysqli_close($conn);  
      
     echo '<script language="javascript">';
      echo 'alert( "ההצגה נוצרה בהצלחה!"  )';
     echo '</script>'; 
    
     header("refresh:3; url=http://sharonsilviajle.mtacloud.co.il/yulia/manage_plays.php");
exit;
}
     
     
 
     
    
 ?>    
