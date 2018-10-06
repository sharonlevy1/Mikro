#!/usr/bin/php
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
            //autoloader/
            //require_once '/home/sharonsilviajle/public_html/yulia/TanyaGoogleCalendar/vendor/autoload.php';
            //require_once '/home/sharonsilviajle/public_html/vendor/autoload.php';
           // require_once '/home/sharonsilviajle/public_html/quickstart.php';
            // require_once ('/home/sharonsilviajle/public_html/vendor/autoload.php');
            // require_once ('/home/sharonsilviajle/public_html/quickstart.php');
            
            
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
              
              
            /**   $createdEvent = new HttpRequest('https://www.googleapis.com/calendar/v3/calendars/calendarId/events/quickAdd', HttpRequest::METH_POST);
               try {
                    echo $r->send()->getBody();
                        } catch (HttpException $ex) {
                        echo $ex;
                   }
             **/
             
                // $url = 'https://www.googleapis.com/calendar/v3/calendars/calendarId/events/quickAdd';
                // $data = array('key1' => 'value1', 'key2' => 'value2');
                
                // // use key 'http' even if you send the request to https://...
                // $options = array(
                //     'http' => array(
                //         'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                //         'method'  => 'POST',
                //         'content' => http_build_query($data)
                //     )
                // );
                // $context  = stream_context_create($options);
                // $result = file_get_contents($url, false, $context);
                // if ($result === FALSE) { /* Handle error */ }
                
                // var_dump($result);  
            
                
                // Refer to the PHP quickstart on how to setup the environment: // https://developers.google.com/google-apps/calendar/quickstart/php // Change the scope to Google_Service_Calendar::CALENDAR and delete any stored // credentials.
                //google api for insert event
            // $event = new Google_Service_Calendar_Event(array(   'summary' => 'Google I/O 2015',   'location' => '800 Howard St., San Francisco, CA 94103',   'description' => 'A chance to hear more about Google\'s developer products.',   'start' => array(
            //     'dateTime' => '2015-05-28T09:00:00-07:00',
            //     'timeZone' => 'America/Los_Angeles',   ),   'end' => array(
            //     'dateTime' => '2015-05-28T17:00:00-07:00',
            //     'timeZone' => 'America/Los_Angeles',   ),   'recurrence' => array(
            //     'RRULE:FREQ=DAILY;COUNT=2'   ),   'attendees' => array(
            //     array('email' => 'lpage@example.com'),
            //     array('email' => 'sbrin@example.com'),   ),   'reminders' => array(
            //     'useDefault' => FALSE,
            //     'overrides' => array(
            //       array('method' => 'email', 'minutes' => 24 * 60),
            //       array('method' => 'popup', 'minutes' => 10),
            //     ),   ), ));
            
            // $calendarId = 'primary'; $event = $service->events->insert($calendarId, $event); printf('Event created: %s\n', $event->htmlLink);
           
            // //google api for quickAdd event
            //   $createdEvent = $service->events->quickAdd(
            //      'tanya19922@gmail.com',
            //      'Appointment at Somewhere on June 4rd 10am-10:25am 2018');
        
            //   echo $createdEvent->getId();
               
              
          ?>   
          
         <!--<script src= https://www.googleapis.com/calendar/v3/calendars/tanya19922@gmail.com/events/quickAdd ></script>-->
          
          <?php 
          
          $client_id = '571211116320-4s7fte0upq8rfvkkrs2hemi2800qrlmc.apps.googleusercontent.com';
        	$Email_address = 'tanya19922@gmail.com';	 
        	$key_file_location = 'AIzaSyD_9lJoCi9XzlXJxP4dgnG87hiyEJbAoCE';	 	
        	
        	$client = new Google_Client();	 	
        	$client->setApplicationName("testAPI");
        	$key = file_get_contents($key_file_location);	 

// separate additional scopes with a comma	 

	
$service = new Google_Service_Calendar($client);  
        //   $client=new Google_Client();
        // //   $client->setApplicationName("testAPI");
        // //   $client->setDeveloperKey("AIzaSyDwYV-ZnuceOp-IuJHlzkFr3TJN7xVn42w");
        //     $client->useApplicationDefaultCredentials();
        //     $service=new Google_Service_Calendar($client); 
          
           //google api for quickAdd event
              $createdEvent = $service->events->quickAdd('tanya19922@gmail.com','Appointment at Somewhere on June 4rd 10am-10:25am 2018');
        
              echo $createdEvent->getId();
              
            
          ?>
          
    </body> 
</html>    