<html>
<head>
    <meta charset="utf-8" />
</head>
<body>
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

//Getting details
if ($_POST['isActive']=='yes') {
    $status="פעיל";
}

else {
    $ststus="לא פעיל";
}

$id=$_POST['id'];
$firstName=$_POST['firstName'];
$lastName=$_POST['lastName'];
$email=$_POST['email'];
$phone=$_POST['phone'];

//checking if the "isManager" checkbox was checked
if (isset($_POST['manager'])) {

    $is_admin=1;

}        else {

    $is_admin=0;
}


//insert actors details query
//phone is a choise
if(!empty($id) && !empty($firstName)&&!empty($lastName)&&!empty($email)&&!empty($status))
{
    $insert = "INSERT INTO `actor` (firstName,lastName,id,email,status,phone,is_admin) VALUES ( '$firstName', '$lastName','$id', '$email','$status','$phone','$is_admin')";

    if ($conn->query($insert) === FALSE) {

        echo " " . $conn->error;
    }

    else
    {
        echo '<script language="javascript">';
        echo 'alert( "העדכון בוצע בהצלחה!"  )';
        echo '</script>';
        header("refresh:3; url=http://sharonsilviajle.mtacloud.co.il/yulia/workers_management.php");
        exit;

    }
}
mysqli_close($conn);



?>
</body>
</html>
    
    
    
     
                
                