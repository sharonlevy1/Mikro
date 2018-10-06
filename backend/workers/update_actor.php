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
  
   
 $a_id = $_SESSION['id'];
 
   
//checkeing if there is update for the status play

if ($_POST['isActive']=="yes")
{
    $update = "UPDATE actor\n"

    . "SET status=\"פעיל\" WHERE id=\"$a_id\"";
     

if ($conn->query($update) === TRUE) {
    echo " ";
} else {
    echo "העדכון לא בוצע,אנא נסה שנית " . $conn->error;
}


}

if ($_POST['isActive']=="no")
{
   $update = "UPDATE actor\n"

    . "SET status=\"לא פעיל\" WHERE id=\"$a_id\"";
     

if ($conn->query($update) === TRUE) {
    echo " ";
} else {
    echo "העדכון לא בוצע,אנא נסה שנית " . $conn->error;
}  
    
}

  
$a_email =$_POST['emailaddress'];
$a_phone= $_POST['phone'];
 
$actor_id =$_SESSION['id'];

$update = "UPDATE actor\n"

    . "SET email=\"$a_email\",phone=\"$a_phone\" WHERE id=\"$actor_id\"";
     

if ($conn->query($update) === TRUE) {
    echo " ";
} else {
    echo "העדכון לא בוצע,אנא נסה שנית " . $conn->error;
}

     echo '<script language="javascript">';
      echo 'alert( "העדכון בוצע בהצלחה!"  )';
     echo '</script>'; 
   
 mysqli_close($conn);
 
header("refresh:3; url=http://sharonsilviajle.mtacloud.co.il/yulia/workers_management.php");
exit;
?>
