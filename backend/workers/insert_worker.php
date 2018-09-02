    
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
  mysqli_set_charset($conn,"utf8");

//getting details

if ($_POST['isActive']=='yes')
{
    $status="פעיל";
}

else
{
    $ststus="לא פעיל";
}

$id=$_POST['id'];
$firstName=$_POST['firstName'];
$lastName=$_POST['lastName'];
$email=$_POST['email'];
$phone=$_POST['phone'];

  //insert actors details query
  //phone is a choise
 if(!empty($id) && !empty($firstName)&&!empty($lastName)&&!empty($email)&&!empty($status)) 
 {
   $insert = "INSERT INTO `actor` (firstName,lastName,id,email,status,phone) VALUES ( '$firstName', '$lastName','$id', '$email','$status','$phone')";
  
     if ($conn->query($insert) === FALSE) {
     
     echo " " . $conn->error;
       }
       
      else
      {
           echo '<script language="javascript">';
          echo 'alert( "העדכון בוצע בהצלחה!"  )';
         echo '</script>'; 
          
      }
      
 }  
     
   
 mysqli_close($conn);
 
 //the page of manage workers isnt exsist yet
//header("refresh:3; url=http://sharonsilviajle.mtacloud.co.il/yulia/manage_plays.php");
exit;

      
      
         
?>
    
    
    
     
                
                