<!--start session and manage cookies-->
<?php
     session_start();
     
     $email2 = $_SESSION["actorsEmail"];
     $email = $_COOKIE["email"];
     $role = $_SESSION["role"];
     
     echo "<script>console.log(".$role.");</script>";
     echo "<script>console.log("."'".$email."'".");</script>";
     echo "<script>console.log("."'".$email2."'".");</script>";
    
    setcookie("email", "", time() - 3600);
    // $email = $_COOKIE["email"];
    

    // <!--connection to save sessions-->
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
        $email = $row["email"];
        $_SESSION["actorsEmail"] = $email;
        
        
        $sql = "SELECT is_admin FROM actor WHERE email = '".$email."'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $is_admin = $row["is_admin"];
        $_SESSION["role"] = $is_admin;
        }
       
        json_encode($email);
        json_encode($email2);
    ?>
<!DOCTYPE HTML>
<html>
    <head>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    	<title>התחברות</title>
    	
    	<!-- Bootstrap core CSS -->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom fonts for this template -->
        <link href="https://fonts.googleapis.com/css?family=Arimo" rel="stylesheet">

        <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
    
        <!-- Custom styles for this template -->
        <link href="one-page-wonder.min.css" rel="stylesheet">
    
        <!-- Additional CSS -->
        <link rel="stylesheet" type="text/css" href="css/login.css">
        
        <!--for google account API-->
        <script src="https://apis.google.com/js/platform.js" async defer></script>
        <meta name="google-signin-client_id" content="571211116320-p5sb7md0uc2ch9vkbgam6j2ehrgb0etl.apps.googleusercontent.com">
		
    </head>
	<body>
		<div class="wrapper">
		    <div class="masthead-content">
    			<div class="container">
    				<div class="col-md-12">
    				    <div class="title"> <img src="https://d2qhvajt3imc89.cloudfront.net/customers/Roche+Agiloft/logo.png"></p>
    					    <div class="login col-md-4">
    							<!--button uses google's account API for login-->
    							<span class="g-signin2" data-onsuccess="onSignIn" data-prompt="select_account" style="cursor: pointer;" ></span>
    							
    							<!--reload page to refresh old cookies-->
                                 <script>
                                //       window.onload = function() {
                                //         if (!window.location.hash) {
                                //             window.location = window.location + 'loaded';
                                //             window.location.reload();
                                //         }
                                // }
                                </script>
                                
                                
    			
    							<!--button that leads to our homepage-->
    							<!--<button class="enter" onclick="location.href='index.php#'" type="button">כניסה לאתר</button>-->
    		                    <button class="enter" onclick="myFunction()" type="button">כניסה לאתר</button>
    		                    
    		                    <script>
                                    function myFunction() {
                                        
                                        var var1 = <?php echo json_encode($email) ?>;
                                        var var2 = <?php echo json_encode($email2) ?>;
                                        
                                      if (var1==var2 && var1!=null || var2!=null ){
                                        //   window.location.href = 'index.php#';
                                        window.location.assign("http://sharonsilviajle.mtacloud.co.il/yulia/index.php")
                                      }
                                      
                                      else {
                                        window.alert("אין לך הרשאה להיכנס לאתר, אנא פנה למנהל התיאטרון");
                                      }
                                      
                                    }
                                    

                                </script>

    	
    							<!--the button must to be hidden!!-->
    							<button hidden onclick="signOut();" >התנתק</button>
    							
    							<!--test for console-->
    							<?php 
    								 echo "<script>console.log("."'".$email."'".");</script>";
    							
    							// coonection to DB for permissions
    							if(!empty($email)){
    						
    								$conn = new mysqli("localhost","sharonsi_admin","mikro123456", "sharonsi_mikro");
    							
    								// Check connection
    								if ($conn->connect_error) {
    									die("Connection failed: " . $conn->connect_error);
    								}
    								
    							mysqli_set_charset($conn,"utf8");
    							
    							// select the email address of the connected account
    							$sql = "SELECT email FROM actor WHERE email = '".$email."'";
    							$result = $conn->query($sql);
    							$row = $result->fetch_assoc();
    							$actor_email = $row["email"];
    							$_SESSION["actorsEmail"] = $actor_email;
    							
    							
    							// select the permissions of the connected account
    							$sql = "SELECT is_admin FROM actor WHERE email = '".$email."'";
    							$result = $conn->query($sql);
    							$row = $result->fetch_assoc();
    							$is_admin = $row["is_admin"];
    							$_SESSION["role"] = $is_admin;
    							
    							//select the ID of the connected account
    							$sql = "SELECT id FROM actor WHERE email = '".$email."'";
    							$result = $conn->query($sql);
    							$row = $result->fetch_assoc();
    							$id = $row["id"];
    							$_SESSION["actorsId"] = $id;
    							
    							//select the name of the connected account
    							$sql = "SELECT firstName FROM actor WHERE email = '".$email."'";
    							$result = $conn->query($sql);
    							$row = $result->fetch_assoc();
    							$firstName = $row["firstName"];
    							$_SESSION["actorsName"] = $firstName;
    							
    							}
    									
    							?>
    						</div>
    					</div>
    				</div>
    		    </div>
    	    </div>
    	</div>

		<div class="push"></div>

        <!-- Footer -->
        <footer class="py-5 bg-black">
          <div class="container">
            <p class="m-0 text-center text-white small">Copyright Mikro Theater</p>
          </div>
          <!-- /.container -->
        </footer>
    
        <!-- Bootstrap core JavaScript -->
        <script src="jquery.min.js"></script>
        <script src="bootstrap.bundle.min.js"></script>

	</body>
	</html>

    <!--google's account API scripts-->
    <script>
        var email_google;
             
            //signIn function   
            function onSignIn(googleUser) {
                var profile = googleUser.getBasicProfile();
                console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
                console.log('Name: ' + profile.getName());
                console.log('Image URL: ' + profile.getImageUrl());
                console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
                email_google = profile.getEmail();
                //$email = echo email_google;
              document.cookie = "email="+email_google;
              <?php
              $email = $_COOKIE["email"];
                echo "console.log("."'".$email."'".");";
                echo "console.log('tanya');";
                
              ?>
            }
            
            //signOut function
            function signOut() {
               
                var auth2 = gapi.auth2.getAuthInstance();
                auth2.signOut().then(function () {
                    console.log('User signed out.');
                
                  
                <?php
                setcookie("email", "", time() - 3600);
                ?>
                });
            }
       
    </script>
    
    
    




