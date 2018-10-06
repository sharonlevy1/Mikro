 


<!--start session and manage cookies-->
<?php
     session_start();
     
     $email = $_SESSION["actorsEmail"];
     $role = $_SESSION["role"];
     echo "<script>console.log(".$role.");</script>";
    
    setcookie("email", "", time() - 3600);
    $email = $_COOKIE["email"];
    echo "<script>console.log("."'".$email."'".");</script>";

    // <!--connection to save sessions-->
    
        echo "<script>console.log("."'".$email."'".");</script>";
        
        if(!empty($email)){
        
        $conn = new mysqli("localhost","sharonsi_admin","mikro123456", "sharonsi_mikro");
        
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        mysqli_set_charset($conn,"utf8");
        
        $sql = "SELECT email FROM actor WHERE email = '".$email."'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $actor_email = $row["email"];
        $_SESSION["actorsEmail"] = $actor_email;
        
        
        $sql = "SELECT is_admin FROM actor WHERE email = '".$email."'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $is_admin = $row["is_admin"];
        $_SESSION["role"] = $is_admin;
        }
       
    ?>
    
 <html>   
 <!--google's account API scripts-->
 <script>
    var email_google;
    
        // function for signIn
        function onSignIn(googleUser) {
            var profile = googleUser.getBasicProfile();
            console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
            console.log('Name: ' + profile.getName());
            console.log('Image URL: ' + profile.getImageUrl());
            console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
            email_google = profile.getEmail();
            document.cookie = "email="+email_google;
          
          // create the cookie when signIn  
          <?php
          $email = $_COOKIE["email"];
           // echo "console.log("."'".$actorsEmail."'".");";
            //echo "console.log('tanya');";
          ?>
        }
        
        // function for signOut
        function signOut() {
            var auth2 = gapi.auth2.getAuthInstance();
            auth2.signOut().then(function () {
                console.log('User signed out.');
            
            // delete the cookie when signOut  
            <?php
            setcookie("email", "", time() - 3600);
            ?>
            });
        }
    </script>
    
    
    <!--reload page to refresh old cookies-->
    <script>
    
          
       window.onload = function() {
            if (!window.location.hash) {
                window.location = window.location + '#loaded';
                window.location.reload();
            }
    }
    </script>


    <head>
        <title>Mikro Theater</title>
        
        <!--google account API-->
        <script src="https://apis.google.com/js/platform.js" async defer></script>
        <meta name="google-signin-client_id" content="571211116320-p5sb7md0uc2ch9vkbgam6j2ehrgb0etl.apps.googleusercontent.com">
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
        <!-- Bootstrap core CSS -->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    
        <!-- Custom fonts for this template -->
        <link href="https://fonts.googleapis.com/css?family=Arimo" rel="stylesheet">
    
        <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
    
        <!-- Custom styles for this template -->
        <link href="one-page-wonder.min.css" rel="stylesheet">
    
        <!-- Additional CSS -->
        <link rel="stylesheet" type="text/css" href="css/index.css">
        <link rel="stylesheet" type="text/css" href="css/homePage.css">
        
         <!-- Call to login Page for logout function -->
         <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
        <script src="login_with_google_account.php"></script> 
    </head>

    <body>
        <?php
               $email = $_COOKIE["email"];
            //   echo "<script>console.log("."'".$actorsEmail."'".");</script>";
            //echo $actorsEmail;
            ?>
            
        <!--permission: only workers that saved in DB allowed to enter -->
        <?php
            //  if($actorsEmail != $email){
         ?>
      
        <div class="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
          <div class="container">
            <a class="navbar-brand" href="http://sharonsilviajle.mtacloud.co.il/yulia/index.php#loaded"><img src="https://d2qhvajt3imc89.cloudfront.net/customers/Roche+Agiloft/logo.png"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
              <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                   <a   class="nav-link" onclick="signOut();" href="login_with_google_account.php#" >התנתק</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="constraints_management.php">אילוצים</a>
                </li>
                
                <!--permission: only the admin can see the שיבוצים option-->
                <?php
                    if($role == 1){
                ?>
                    <li class="nav-item">
                        <a class="nav-link" href="Schedule.php">שיבוצים</a>
                    </li>   
                <?php
                     }
                ?>
                
                <!--permission: only the admin can see the "ניהול" dropdown-->
                <?php
                    if($role == 1){
                ?>
                        <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ניהול
                          </a>
                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="manage_plays.php">ניהול הצגות</a>
                            <a class="dropdown-item" href="workers_management.php">ניהול עובדים</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="open_timeframe.php">פתח חלון זמנים</a>
                          </div>
                        </li>
                <?php
                     }
                ?>
              </ul>
            </div>
          </div>
        </nav>
    
        <div class="clear"></div>
    
        <header class="masthead text-center text-white">
            <div class="masthead-content">
                <div class="container">
                    <h1>!ברוכ/ה הבא/ה</h1>
                    <br>
                    
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
                  $sql0 = "select * from time_frame order by num desc limit 1";
                       
                   $result0 = $conn->query($sql0);
                
                     while($row = $result0->fetch_assoc()) {
                         $start_date=$row['start_date'];
                         $end_date=$row['end_date'];
                     }
                     
                      $cur_date= date("Y-m-d");
                     
                    if($start_date<=$cur_date&&$end_date>=$cur_date)
                     {
                       
                        echo "שים לב : חלון זמנים להגשת אילוצים פתוח כעת בין התאריכים ";
                        echo $start_date, " - ",$end_date;
                        echo "<br>";
                        
                     } 
                     
                     else
                     {
                        
                        echo "שים לב : חלון זמנים להגשת אילוצים בתאריכים   ";
                        echo $start_date, " - ",$end_date; 
                        echo " סגור כעת";
                        echo "<p>";
                        echo "ויפתח כאשר המנהל יקבע תאריכים חדשים להגשת אילוצים";
                        echo "</p>";
                     }
                     
                     
                     echo "<br>";
                     
                     ?>


    
                <?php
                   $email = $_COOKIE["email"];
                //   echo "<script>console.log("."'".$actorsEmail."'".");</script>";
                //echo $actorsEmail;
                ?>
                
                    <div class="row">
    					<div class="col-md-12">
                            <!--google calendar-->
                            <div class="googleCalendar">
                                <!--<iframe src="http://sharonsilviajle.mtacloud.co.il/yulia/calendar.html" style="border: 0" frameborder="0" scrolling="no"></iframe>-->
                                
                                <iframe src="https://calendar.google.com/calendar/embed?src=<?php echo $email; ?>" style="border: 0" frameborder="0" scrolling="no"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    
        <div class="push"></div>
    </div>
        <!-- Footer -->
        <footer class="py-5 bg-black">
          <div class="container">
            <p class="m-0 text-center text-white small">Copyright &copy; Mikro Theater 2018</p>
          </div>
          <!-- /.container -->
        
        </footer>
    
        <!-- Bootstrap core JavaScript -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
   
        <!--google account's buttons - they have to be on this page otherwise the loguat won't work -->
        <div hidden class="g-signin2" data-onsuccess="onSignIn" data-prompt="select_account" style="cursor: pointer;" onclick="myFunction();"></div>
        <a hidden onclick="signOut();" href="login_with_google_account.php" >Sign out</a>


    <?php
    //   }
    //  else{
    //     session_destroy();
    //     header("Location:noPermission.php");
    //  }
    ?>
    </body>
</html>



        
        
        
        
        
        
        
        
 