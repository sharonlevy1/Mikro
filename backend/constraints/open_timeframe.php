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
 
<html>
    <head>
        <!--google account API-->
        <script src="https://apis.google.com/js/platform.js" async defer></script>
        <meta name="google-signin-client_id" content="571211116320-p5sb7md0uc2ch9vkbgam6j2ehrgb0etl.apps.googleusercontent.com">
        
        <!-- Bootstrap core JavaScript -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Open Timeframe</title>
        <link rel="stylesheet" href="jquery-ui/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    
        <!-- Include Date Range Picker -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
    
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
        <link rel="stylesheet" type="text/css" href="css/open.css">
    
        <!-- jQuery UI -->
        <link rel="stylesheet" href="jquery-ui/jquery-ui.min.css">
        <script src="jquery-ui/external/jquery/jquery.js"></script>
        <script src="jquery-ui/jquery-ui.min.js"></script>
    
        <script>
          $(document).ready(function() {
            $( ".datepicker" ).datepicker({
              duration: 'normal'
            });
    
              $.datepicker.regional['he'] = {
                closeText: 'סגור',
                prevText: 'קודם',
                nextText: 'הבא',
                currentText: 'נוכחי',
                monthNames: ['ינואר', 'פברואר', 'מרץ', 'אפריל', 'מאי', 'יוני', 'יולי', 'אוגוסט',
                  'ספטמבר', 'אוקטובר', 'נובמבר', 'דצמבר'
                ],
                monthNamesShort: ['ינו', 'פבר', 'מרץ', 'אפר', 'מאיי', 'יונ', 'יול', 'אוג','ספט', 'אוק', 'נוב', 'דצמ'],
                dayNames: ['neděle', 'pondělí', 'úterý', 'středa', 'čtvrtek', 'pátek', 'sobota'],
                dayNamesShort: ['רא', 'שנ', 'של', 'רב', 'חמ', 'שי', 'שב'],
                dayNamesMin: ['א', 'ב', 'ג', 'ד', 'ה', 'ו', 'ש'],
                weekHeader: 'שבוע',
                dateFormat: 'dd/mm/yy',
                firstDay: 1,
                isRTL: false,
                showMonthAfterYear: false,
                yearSuffix: ''
              };
    
              $.datepicker.setDefaults($.datepicker.regional['he']);
            });
        </script>
    
        <script type="text/javascript">
           $(document).ready(function() {
             console.log("datepicker");
             $(".datepicker").datepicker({
               dateFormat: "dd.m.yy",
               minDate: 0,
               showOtherMonths: true,
               firstDay: 1
             });
           });
        </script>
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
                <div class="bootstrap-iso">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <h2 class="masthead-subheading mb-0">פתח חלון זמנים</h2>
                               <form name="timeframe" action="open_timeframe.php" method="POST">
                                     <p><label class="start">תאריך פתיחת חלון זמנים: <input type="date" name="fDate" id="start" data-date-format="YYYY-MM-DD"></label></p>
                                     <p><label class="end">תאריך סגירת חלון זמנים: <input type="date" name="lDate" id="end" data-date-format="YYYY-MM-DD"></label></p>
                                    <div class="formButtons form-group">
                                        <button id="submit" name="submit" type="submit" onclick="open_timeframe.php">פתח חלון זמנים</button>
                                        <button id="reset" type="reset" value="Reset">איפוס</button>
                                    </div>
                                </form>
                                
                                <?php 
                                $start_date=$_POST['fDate'];
                                $end_date=$_POST['lDate'];
                               $cur_date= date("Y-m-d");
                               //to do
                               //i have a range of dates 23-27.9.18 for example. if the curent date is is bigger than the fDate but smaller/same 
                               //as lDate than click on "create constraint button" else you have messege that not bettween the time frame/cant 
                               //create constraints.
                               
                               //select * from actor order by id desc limit 1
                               
                               
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
                                
                            $sql = "SELECT * FROM `time_frame` \n"

                                  . "ORDER BY num DESC\n"

                                  . "LIMIT 1";
                                  
                            
                            $result = $conn->query($sql);

                            function setOrdinalNum($result)
                            {
                              #that gives me the last constraint ordinal num in the table


                            if ($result->num_rows > 0) {
 
                           while($row = $result->fetch_assoc()) {
              
                           $newOrdinal= $row['num']+1;
         
                            }
      
                         } else {
                             #constraints ordinal numbers will start in 2000 by default
                           $newOrdinal=1; 
                         }
 
                        return $newOrdinal;

                        }
                        
                        
                      //getting the new ordinal number  
                        $setOrdinal=setOrdinalNum($result); 
                             if ($start_date!=null||$end_date!=null)
                             {
                             $insert = "INSERT INTO `time_frame` (num,start_date,end_date) VALUES ('$setOrdinal','$start_date','$end_date')";
                              if ($conn->query($insert) === FALSE) {
      
                               echo "   " . $conn->error;
      
                               }
                               else
                               {
                                   echo '<script language="javascript">';
                                   echo 'alert( "העדכון בוצע בהצלחה!"  )';
                                   echo '</script>'; 
   
                                   mysqli_close($conn);
  
                                header("refresh:3; url=http://sharonsilviajle.mtacloud.co.il/yulia/index.php#");
                                exit;
                               }
                             }
     
                       
                                $conn->close();
                                
                                ?>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
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
        </footer>
        
        <!--google account's buttons - they have to be on this page otherwise the logout won't work -->
        <div hidden class="g-signin2" data-onsuccess="onSignIn" data-prompt="select_account" style="cursor: pointer;" onclick="myFunction();"></div>
        <a hidden onclick="signOut();" href="login_with_google_account.php" >Sign out</a>
        
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