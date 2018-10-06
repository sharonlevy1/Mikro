<!--start session and manage cookies-->
<?php
     session_start();
     
     $email = $_SESSION["actorsEmail"];
     $role = $_SESSION["role"];
     echo "<script>console.log(".$role.");</script>";
    
    //setcookie("email", "", time() - 3600);
    $email = $_COOKIE["email"];
    echo "<script>console.log("."'".$email."'".");</script>";
 ?>
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
 
<html>
    <head>
        <title>Manage Schedule</title>
    
         <!--google account API-->
        <script src="https://apis.google.com/js/platform.js" async defer></script>
        <meta name="google-signin-client_id" content="571211116320-p5sb7md0uc2ch9vkbgam6j2ehrgb0etl.apps.googleusercontent.com">
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
        <!-- Bootstrap core CSS -->
        <link href="bootstrap.min.css" rel="stylesheet">
    
        <!-- Custom fonts for this template -->
        <link href="https://fonts.googleapis.com/css?family=Arimo" rel="stylesheet">
    
        <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
    
        <!-- Custom styles for this template -->
        <link href="one-page-wonder.min.css" rel="stylesheet">
    
        <!-- Additional CSS -->
        <link rel="stylesheet" type="text/css" href="css/scheduleCSS.css">

        <style>
            header.masthead {
                padding-bottom: 5%;
            }
            
            h2 {
                padding-bottom: 3%;
            }
        </style>
    </head>
     
    <body>
        
        <div class="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
          <div class="container">
            <a class="navbar-brand" href="http://sharonsilviajle.mtacloud.co.il/yulia/index.php#"><img src="https://d2qhvajt3imc89.cloudfront.net/customers/Roche+Agiloft/logo.png"></a>
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
                    <h2 class="masthead-subheading mb-0">ניהול שיבוצים</h2>
                    
                    <?php include "choosePerformance.php"?>
                </div>
            </div>
        </header>
        </div>
    
        <div class="push"></div>
    
        <!-- Footer -->
        <footer class="py-5 bg-black">
          <div class="container">
            <p class="m-0 text-center text-white small">Copyright &copy; Mikro Theater 2018</p>
          </div>
          <!-- /.container -->
        </footer>
        
        <!-- Bootstrap core JavaScript -->
        <script src="jquery.min.js"></script>
        <script src="bootstrap.bundle.min.js"></script>
        
        <!--google account's buttons - they have to be on this page otherwise the logout won't work -->
        <div hidden class="g-signin2" data-onsuccess="onSignIn" data-prompt="select_account" style="cursor: pointer;" onclick="myFunction();"></div>
        <a hidden onclick="signOut();" href="login_with_google_account.php#" >Sign out</a>
    
              
    <!--connection to save sessions-->
    <?php 
        // echo "<script>console.log("."'".$email."'".");</script>";
        
        // if(!empty($email)){
        
            // $conn = new mysqli("localhost","sharonsi_admin","mikro123456", "sharonsi_mikro");
        
        // // Check connection
        // if ($conn->connect_error) {
        //     die("Connection failed: " . $conn->connect_error);
        // }
        // mysqli_set_charset($conn,"utf8");
        // $sql = "SELECT email FROM actor WHERE email = '".$email."'";
        
        // $result = $conn->query($sql);
        // $row = $result->fetch_assoc();
        // $actor_email = $row["email"];
        // $_SESSION["actorsEmail"] = $actor_email;
        
        // $sql = "SELECT is_admin FROM actor WHERE email = '".$email."'";
        
        // $result = $conn->query($sql);
        // $row = $result->fetch_assoc();
        // $is_admin = $row["is_admin"];
        // $_SESSION["role"] = $is_admin;
        // }
    ?>
    
    </body>
</html>

