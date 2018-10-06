
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

$sql = "SELECT num FROM `constraints` \n"

    . "ORDER BY num DESC\n"

    . "LIMIT 1";

$result = $conn->query($sql);

function setOrdinalCons ($result)
{
#that gives me the last constraint ordinal num in the table


    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {

            $newOrdinal= $row['num']+1;

        }

    } else {
        #constraints ordinal numbers will start in 2000 by default
        $newOrdinal=2000;
    }

    return $newOrdinal;

}


//getting the new ordinal number that we will insert to the insert constraint query
$setOrdinal=setOrdinalCons($result);


//just creating constraint

//insert values for the ranges


if (isset($_POST['range1']))
{
    $r1=1;

}

else{
    $r1=0;

}

if (isset($_POST['range2']))
{
    $r2=1;

}

else{
    $r2=0;

}

if (isset($_POST['range3']))
{
    $r3=1;

}

else{
    $r3=0;

}

//values that we got from the form

$owner=$_POST['owner'];
$fDate=$_POST['fDate'];
$des=$_POST['description'];
$subs=$_POST['replace'];
$playN=$_POST['show'];

//need boolean for check success messege
$notSuccess=true;

if ($_POST['fDate']==$_POST['lDate']||isset($_POST['sameDay'])) // if the same day
{
    if($_POST['replace']==null&&$_POST['show']==null)  //dont have details for replacement
    {
        $isCons=1;


        $insert = "INSERT INTO `constraints` (num,user_id,isConstraint,date,description,range_1,range_2,range_3) VALUES ('$setOrdinal', '$owner', '$isCons', '$fDate','$des','$r1','$r2','$r3')";
        if ($conn->query($insert) === TRUE) {

            echo " ";
        }
        else {
            echo "   " . $conn->error;
        }



    }

    //we have details for the replacement request
    else {

        $isCons=0;



        $insert2 = "INSERT INTO `constraints` (num,user_id,isConstraint,subs_id,date,playName,description,range_1,range_2,range_3) VALUES('$setOrdinal','$owner','$isCons','$subs','$fDate','$playN','$des','$r1','$r2','$r3')";


        if ($conn->query($insert2) === TRUE) {
            echo " ";
        }
        else {
            echo "   " . $conn->error;
        }



    }


}


//all the checking of not same dates function

else {


    $val1=$_POST['fDate'];
    $val2=$_POST['lDate'];


    $date_split1 = explode('-', $val1);
    $year1 = $date_split1[0];
    $month1 =$date_split1[1];
    $day1  =$date_split1[2];

    $date_split2 = explode('-', $val2);
    $year2 = $date_split2[0];
    $month2 =$date_split2[1];
    $day2=$date_split2[2];

//this will be our function later to check things
    if ($day2-$day1<=21&&$month1==$month2&&$year1==$year2) //no nore than 3 weeks of vacation
    {


        $diffD=$day2-$day1+1;

        $dTemp=$day1;
        $isCons=1;
        for ($i=0;$i<$diffD;$i++)
        {


#that gives me the last constraint ordinal num in the table

            $sql = "SELECT num FROM `constraints` \n"

                . "ORDER BY num DESC\n"

                . "LIMIT 1";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {

                while($row = $result->fetch_assoc()) {

                    $setOrdinal= $row['num']+1;

                }

            } else {
                #constraints ordinal numbers will start in 2000 by default if we dont have constraints at all
                $setOrdinal=2000;
            }


            $date=date_create("$year1-$month1-$dTemp");
            $fDate= date_format($date,"Y-m-d");




            $insert = "INSERT INTO `constraints` (num,user_id,isConstraint,date,description,range_1,range_2,range_3) VALUES ('$setOrdinal', '$owner', '$isCons', '$fDate','$des','$r1','$r2','$r3')";

            if ($conn->query($insert) === TRUE) {
                echo " ";
            }
            else {
                echo "   " . $conn->error;
            }
            $dTemp++;
        }




    }

//only one month diff,same year or december and january new year with no more than 3 weeks!!

    elseif ($month2-$month1==1&&$year1==$year2||$year2-$year1==1&&$month1-$month2=11) {
        $day_in_month=cal_days_in_month(CAL_GREGORIAN,$month1,$year1);
        $isCons=1;
        $daysFrom=$day_in_month-$day1+1;
        $daysTill=$day2+1;
        $sumDays=$daysFrom+$day2;
        if($sumDays>22)
        {

            echo '<script language="javascript">';
            echo 'alert("האילוץ לא נוצר,קיימת חריגה מעל ל3 שבועות")';
            echo '</script>';
        }

        else {

            $dTemp=$day1;

            for ($i=0;$i<$daysFrom;$i++)
            {


#that gives me the last constraint ordinal num in the table

                $sql = "SELECT num FROM `constraints` \n"

                    . "ORDER BY num DESC\n"

                    . "LIMIT 1";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {

                    while($row = $result->fetch_assoc()) {

                        $setOrdinal= $row['num']+1;

                    }

                } else {
                    #constraints ordinal numbers will start in 2000 by default if we dont have constraints at all
                    $setOrdinal=2000;
                }


                $date=date_create("$year1-$month1-$dTemp");
                $fDate= date_format($date,"Y-m-d");


                $insert = "INSERT INTO `constraints` (num,user_id,isConstraint,date,description,range_1,range_2,range_3) VALUES ('$setOrdinal', '$owner', '$isCons', '$fDate','$des','$r1','$r2','$r3')";

                if ($conn->query($insert) === TRUE) {
                    echo " ";
                }
                else {
                    echo " " . $conn->error;
                }
                $dTemp++;
            }


            $dTemp=1;
            for ($i=0;$i<$daysTill;$i++)
            {


#that gives me the last constraint ordinal num in the table

                $sql = "SELECT num FROM `constraints` \n"

                    . "ORDER BY num DESC\n"

                    . "LIMIT 1";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {

                    while($row = $result->fetch_assoc()) {

                        $setOrdinal= $row['num']+1;

                    }

                } else {
                    #constraints ordinal numbers will start in 2000 by default if we dont have constraints at all
                    $setOrdinal=2000;
                }


                $date=date_create("$year2-$month2-$dTemp");
                $fDate= date_format($date,"Y-m-d");


                $insert = "INSERT INTO `constraints` (num,user_id,isConstraint,date,description,range_1,range_2,range_3) VALUES ('$setOrdinal', '$owner', '$isCons', '$fDate','$des','$r1','$r2','$r3')";

                if ($conn->query($insert) === TRUE) {
                    echo " ";
                }
                else {
                    echo " " . $conn->error;
                }
                $dTemp++;
            }



        }


    }



    else
    {

        echo '<script language="javascript">';
        echo 'alert("האילוץ לא נוצר,הזנת תאריכים לא חוקיים או מעל ל3 שבועות")';
        echo '</script>';
        $notSuccess=false;

    }

}

if ( $notSuccess)
{

    echo '<script language="javascript">';
    echo 'alert("האילוץ נוצר בהצלחה")';
    echo '</script>';
}


$conn->close();



header("refresh:3; url=http://sharonsilviajle.mtacloud.co.il/yulia/constraints_management.php");
exit;

?>
