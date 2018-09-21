<html>
<head>
    <meta charset="utf-8" />
    <style>
        table {
            direction: rtl;
        }
    </style>

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

$sql = "SELECT * FROM `plays`";
$result = $conn->query($sql);

if($_POST['chose_status']=="active") {
    $chosen_status="פעיל";

}

elseif($_POST['chose_status']=="not_active") {
    $chosen_status="לא פעיל";

}

else {
    $chosen_status="all";
}


if ($result->num_rows > 0 ) {
    echo "
                        <table>
                            <tr> 
                                <th> </th>
                                <th>שם</th>
                                <th>תיאור</th>
                                <th>סטטוס</th>
                                <th>שחקנים </th>
                            </tr>";
    // output data of each row in table plays
    while($row = $result->fetch_assoc()) {

        // selecting actors in plays
        $q = $row['name'] ;
        $sqlp = "SELECT firstName,lastName FROM actor\n"

            . "INNER JOIN actors_in_plays ON actors_in_plays.id=actor.id\n"

            . "WHERE actors_in_plays.playName= '.$q.'"

            . "ORDER BY firstName";

        $resultp = $conn->query($sqlp);

        if ($resultp->num_rows > 0) {
            // output data of each row in table actors

            while($row = $resultp->fetch_assoc()) {
                echo "<li>" . $row["firstName"]. " " . $row["lastName"]. "</li>";
            }

        }

        if(!isset($_POST['chose_status'])) {
            echo "<tr>
                                <td>
                                    <a href=\"edit_play.php?name=".$row['name']."\">עדכן</a></td>
                                    <td>" . $row["name"]. "</td>
                                    <td>" .$row["description"]. "</td>
                                    <td>".$row["status"]."</td>
                                    <td>"
                // selecting actors in plays
                .$w = $row[""] ;
            $sqlp = "SELECT firstName,lastName FROM actor\n"

                . "INNER JOIN actors_in_plays ON actors_in_plays.id=actor.id\n"

                . "WHERE actors_in_plays.playName='$q'"

                . "ORDER BY firstName";
            $resultp = $conn->query($sqlp);
            if ($resultp->num_rows > 0) {

                // output data of each row in table actors
                while($row = $resultp->fetch_assoc()) {
                    echo "<li>" . $row["firstName"]. " " . $row["lastName"]. "</li>";
                }
            }
            // end of selecting actors in plays
            "</td>
                            </tr>";
        }
        if ($row["status"]=="פעיל"&&$chosen_status=="פעיל" ) {
            echo "<tr>
                                <td>
                                    <a href=\"edit_play.php?name=".$row['name']."\">עדכן</a></td >
                                    <td>" . $row["name"]. "</td>
                                    <td>" .$row["description"]. "</td>
                                    <td>".$row["status"]."</td>
                                    <td> "
                // selecting actors in plays
                .$w = $row[""] ;
            $sqlp = "SELECT firstName,lastName FROM actor\n"

                . "INNER JOIN actors_in_plays ON actors_in_plays.id=actor.id\n"

                . "WHERE actors_in_plays.playName='$q'"

                . "ORDER BY firstName";
            $resultp = $conn->query($sqlp);
            if ($resultp->num_rows > 0) {

                // output data of each row in table actors
                while($row = $resultp->fetch_assoc()) {
                    echo "<li>" . $row["firstName"]. " " . $row["lastName"]. "</li>";
                }
            }
            // end of selecting actors in plays
            "</td>
                            </tr>";
        }
        if ($row["status"]=="לא פעיל"&&$chosen_status=="לא פעיל" ) {
            echo "<tr>
                                <td><a href=\"edit_play.php?name=".$row['name']."\">עדכן</a></td >
                                <td>" . $row["name"]. "</td>
                                <td>" .$row["description"]. "</td>
                                <td>".$row["status"]."</td>
                                <td>"
                // selecting actors in plays
                .$w = $row[""] ;
            $sqlp = "SELECT firstName,lastName FROM actor\n"

                . "INNER JOIN actors_in_plays ON actors_in_plays.id=actor.id\n"

                . "WHERE actors_in_plays.playName='$q'"

                . "ORDER BY firstName";
            $resultp = $conn->query($sqlp);
            if ($resultp->num_rows > 0) {
                // output data of each row in table actors
                while($row = $resultp->fetch_assoc()) {
                    echo "<li>" . $row["firstName"]. " " . $row["lastName"]. "</li>";
                }
            }
            "</td>
                            </tr>";
        }
        if($_POST['chose_status']=="all") {
            echo "<tr>
            		            <td><a href=\"edit_play.php?name=".$row['name']."\">עדכן</a></td>
            		            <td>" . $row["name"]. "</td>
            		            <td>" .$row["description"]. "</td>
            		            <td>".$row["status"]."</td>
            		            <td>"
                // selecting actors in plays
                .$w = $row[""] ;
            $sqlp = "SELECT firstName,lastName FROM actor\n"

                . "INNER JOIN actors_in_plays ON actors_in_plays.id=actor.id\n"

                . "WHERE actors_in_plays.playName='$q'"

                . "ORDER BY firstName";
            $resultp = $conn->query($sqlp);
            if ($resultp->num_rows > 0) {

                // output data of each row in table actors
                while($row = $resultp->fetch_assoc()) {
                    echo "<li>" . $row["firstName"]. " " . $row["lastName"]. "</li>";
                }
            }
            // end of selecting actors in plays
            "</td>
                            </tr>";
        }
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();

?>

<br>

<script>
    function myFunction() {
        var x = document.getElementById("status");
        if (x.style.display === "none")
        {
            x.style.display = "block";
        }
        else {
            x.style.display = "none";
        }
    }
</script>

</body>
</html>
