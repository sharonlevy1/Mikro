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

//we want to use only the active plays
$sql = "SELECT * FROM `plays` \n"

    . "WHERE status=\"פעיל\"";

$result = $conn->query($sql);

$plays=array();
$index=0;


while($row = $result->fetch_assoc()) {

    $plays[$index]=$row["name"];
    $index++;
}

//the algorithm is specific for 1 day. we need to wrapp it for function that counts the days in the chosen month.
//the demo of the function in algorithm3.


$sumPlays=count($plays);

//this gives me the current year
$currYear=date("Y");
//we are saying the current month is chosen by the user

$d=cal_days_in_month(CAL_GREGORIAN,8,$currYear);
for($k=0;$k<$d;$k++)
{   //for each play
    for($i=0;$i<$sumPlays;$i++)
    {
        // echo $plays[$i], "<br>";

        //now i need to see for each play actors_in play list
        $sql2 = "SELECT * FROM actor\n"

            . "INNER JOIN actors_in_plays ON actors_in_plays.id = actor.id\n"

            . "where actors_in_plays.playName=\"$plays[$i]\"";
        $result2 = $conn->query($sql2);
        $actors=array();
        $index2=0;

        //  echo $plays[$i];

//i put in an array all the id's of the actors that participate in an active play
        while($row = $result2->fetch_assoc()) {

            $actors[$index2]=$row["id"];
            // echo $actors[$index2], " ";
            $index2++;


        }

        $sumActors=count($actors);

        $isAppear1='true';
        $isAppear2='true';
        $isAppear3='true';


        for($j=0;$j<$sumActors;$j++&&($isAppear1||$isAppear2||$isAppear3))
        {
            $mk=$k+1;

            $sql3 = "SELECT * FROM constraints\n"

                . "WHERE user_id=\"$actors[$j]\"\n"

                . "AND date=\"2018-08-$mk\" AND isConstraint=1 AND constraints.range_1=1";

            $sql4 = "SELECT * FROM constraints\n"

                . "WHERE user_id=\"$actors[$j]\"\n"

                . "AND date=\"2018-08-$mk\" AND isConstraint=1 AND constraints.range_2=1";

            $sql5 = "SELECT * FROM constraints\n"

                . "WHERE user_id=\"$actors[$j]\"\n"

                . "AND date=\"2018-08-$mk\" AND isConstraint=1 AND constraints.range_3=1";



            $result3 = $conn->query($sql3);

            if ($result3->num_rows > 0) //that means i have the constraint of an actor on this day at first range
            {
                $isAppear1='false';
            }

            $result4 = $conn->query($sql4);
            if ($result4->num_rows > 0) //that means i have the constraint of an actor on this day at second range
            {
                $isAppear2='false';
            }

            $result5 = $conn->query($sql5);
            if ($result5->num_rows > 0) //that means i have the constraint of an actor on this day at third range
            {
                $isAppear3='false';
            }

        }

        // i want to print all the plays and their ranges in the calendar

        $num=$k+1;
        echo " יום בחודש: ","$num ";
        if ($isAppear1=='true')
        {

            echo " ". $plays[$i]." בטווח 1",", ";


        }

        if ($isAppear2=='true')
        {
            echo "". $plays[$i]." בטווח 2",", ";


        }

        if ($isAppear3=='true')
        {
            echo "". $plays[$i]." בטווח 3",", ";


        }

        echo "<br>";

    }
}
$conn->close();

?>