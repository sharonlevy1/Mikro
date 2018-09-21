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

$actors_play=array();
$index=0;
$p_name = $_SESSION['play_name'];

$sqlp = "SELECT * FROM `actors_in_plays`\n"

    . "WHERE playName=\"$p_name\"";


$resultp = $conn->query($sqlp);

if ($resultp->num_rows > 0) {
    // saving the id of each actor that participates in the specific play

    while($row = $resultp->fetch_assoc()) {
        $actors_play[$index]=$row['id'];
        $index++;
    }

}

$actors_selected=array();
$index2=0;
$no_skip=true;

if(!empty($_POST['check_list'])){
    // Loop to store and display values of individual checked checkbox.
    foreach($_POST['check_list'] as $selected){
        $actors_selected[$index2]=$selected;
        $index2++;

        //this query will insert only what doest exsists
        $insert = "INSERT IGNORE INTO `actors_in_plays` (id,playName) VALUES ('$selected','$p_name')";
        if ($conn->query($insert) === TRUE) {

            echo "  ";
        }
        else {
            echo " ". $conn->error;

        }

    }


}

else
{

    //if all checkboxes are empty delete all
    foreach ($actors_play as $exsists)
    {
        mysqli_query($conn,"DELETE FROM actors_in_plays WHERE id='".$exsists."'");
    }

    $no_skip=false;

}

$counter=0;
//deleting the ones who were at the play but wherent checked

if ($no_skip==true&&count( $actors_play)>0)
{
    foreach ($actors_play as $exsists)
    {
        foreach ($actors_selected as $checked)
        {
            if ($exsists==$checked)
            {
                $counter++;
            }
        }
    }

    if ($counter==0)
    {
        mysqli_query($conn,"DELETE FROM actors_in_plays WHERE id='".$exsists."'");

    }

    else
    {

        $counter=0;
    }
}


//checkeing if there is update for the status play

if ($_POST['isActive']=="yes")
{
    $sql = "SELECT playColor FROM `plays`";
    $result = $conn->query($sql);
    $colors_arr=array();
    $index=0;


    while($row = $result->fetch_assoc()) {
        if ( $row["playColor"]!=null)
        {
            $colors_arr[$index]=$row["playColor"];
            $index++;
        }
    }

    function randomColor() {
        $str = '#';
        for($i = 0 ; $i < 3 ; $i++) {
            $str .= dechex( rand(60 , 200) );
        }

        return strtoupper($str);
    }

    $rand_color=randomColor();
    $not_found=true;
    $counter=0;

    while ($not_found==true)
    {

        foreach ($colors_arr as $color) {
            if ($color==$rand_color)
            {
                $rand_color=randomColor();
                $counter++;
                //exit only from the foreach loop
                break 1;
            }
        }

        if ($counter==0)
        {
            //exit the loop if the color doesnt show up in our array (that's what we need)
            $not_found=false;
        }
        else
        {
            $counter=0;
        }

    }


    $update = "UPDATE plays\n"

        . "SET status=\"פעיל\",playColor=\"$rand_color\" WHERE name=\"$p_name\"";
}

if ($_POST['isActive']=="no")
{
    $update = "UPDATE plays\n"

        . "SET status=\"לא פעיל\",playColor=null WHERE name=\"$p_name\"";
}

if ($conn->query($update) === TRUE) {
    echo '<script language="javascript">';
    echo 'alert( "העדכון בוצע בהצלחה!"  )';
    echo '</script>';

    mysqli_close($conn);

    header("refresh:3; url=http://sharonsilviajle.mtacloud.co.il/yulia/manage_plays.php");
    exit;
}
else {
    echo "העדכון לא בוצע,אנא נסה שנית " . $conn->error;
}




?>
