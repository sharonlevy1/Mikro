<?php
  session_start();
print "hello!!!";
require '/home/sharonsilviajle/public_html/vendor/autoload.php';

// if (php_sapi_name() != 'cli') {
//     throw new Exception('This application must be run on the command line.');
// }

/**
 * Returns an authorized API client.
 * @return Google_Client the authorized client object
 */
function getClient()
{
    $client = new Google_Client();
    $client->setApplicationName('Google Calendar API PHP Quickstart');
    $client->setScopes(Google_Service_Calendar::CALENDAR);
    $client->setAuthConfig('credentials.json');
    $client->setAccessType('offline');
    $client->setPrompt('select_account consent');

    // Load previously authorized token from a file, if it exists.
    $tokenPath = 'token.json';
    if (file_exists($tokenPath)) {
        $accessToken = json_decode(file_get_contents($tokenPath), true);
        $client->setAccessToken($accessToken);
    }

    // If there is no previous token or it's expired.
    if ($client->isAccessTokenExpired()) {
        // Refresh the token if possible, else fetch a new one.
        if ($client->getRefreshToken()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        } else {
            // Request authorization from the user.
            $authUrl = $client->createAuthUrl();
            printf("Open the following link in your browser:\n%s\n", $authUrl);
            print 'Enter verification code: ';
            $authCode = trim(fgets(STDIN));

            // Exchange authorization code for an access token.
            $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
            $client->setAccessToken($accessToken);

            // Check to see if there was an error.
            if (array_key_exists('error', $accessToken)) {
                throw new Exception(join(', ', $accessToken));
            }
        }
        // Save the token to a file.
        if (!file_exists(dirname($tokenPath))) {
            mkdir(dirname($tokenPath), 0700, true);
        }
        file_put_contents($tokenPath, json_encode($client->getAccessToken()));
    }
    return $client;
}


// Get the API client and construct the service object.
$client = getClient();
$service = new Google_Service_Calendar($client);

// // Print the next 10 events on the user's calendar.
// $calendarId = 'primary';
// $optParams = array(
//   'maxResults' => 10,
//   'orderBy' => 'startTime',
//   'singleEvents' => true,
//   'timeMin' => date('c'),
// );
// $results = $service->events->listEvents($calendarId, $optParams);
// $events = $results->getItems();

            //google api for quickAdd event
           // $createdEvent = $service->events->quickAdd('yulkinsher21@gmail.com','Appointment at Somewhere on June 5rd 2018 10am-10:25am');
             
             $month=$_SESSION['month'];
              $year=$_SESSION['year'];
            //   $month='03';
            //   $year='2018';
              
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
            
             $sql2 = "SELECT * FROM `actor`\n"

                   . "WHERE status=\"פעיל\"";
                
            $emails=array();
           
            $i=0;
                   
               $result2 = $conn->query($sql2);
                if ($result2->num_rows > 0) {
            
                 while($row = $result2->fetch_assoc()) {
                       $emails[$i]=$row["email"];
                       $i++;
                 }
                }
                   
             //gives me all the shows at this chosen month
              $sql = "SELECT * FROM `saved_shows` WHERE year=\"$year\" AND month=\"$month\"";
              
               $result = $conn->query($sql);
               $index=0;
                if ($result->num_rows > 0) {
            
                 while($row = $result->fetch_assoc()) {
                        $name =$row["name"];
                        $day=$row["day"];
                        $range=$row["range"];
                    
                    if ($range=='1')
                    {
                        $time1='10:00:00';
                        $time2='14:00:00';
                    }
                    else if ($range=='2')
                    {
                        $time1='16:00:00';
                        $time2='19:00:00';
                    }
                    
                    else{
                        $time1='20:00:00';
                        $time2='22:30:00';
                    }
                    
                    
                     while ($index<count($emails))
                   {
                       
               //google api for insert event
             $event = new Google_Service_Calendar_Event(array(
              'summary' => "$name",
              'location' => 'תיאטרון מיקרו',
              'description' => '.',
              'start' => array(
             // 'dateTime' => '2018-07-05T09:00:00-07:00',
                 'dateTime'=>"$year-$month-{$day}T{$time1}+03:00",
                'timeZone' => 'Israel',
              ),
              'end' => array(
                'dateTime'=>"$year-$month-{$day}T{$time2}+03:00",
                'timeZone' => 'Israel',
              ),
              'recurrence' => array(
                'RRULE:FREQ=DAILY;COUNT=1'
              ),
              
              
              'attendees' => array(
    
                  // while ($i<count($emails))
                  // {
                array('email' => "$emails[$index]"),
                  // $i++;
                 //  }
               // array('email' => 'tanya19922@gmail.com'),
              ),
              'reminders' => array(
                'useDefault' => FALSE,
                'overrides' => array(
                  array('method' => 'email', 'minutes' => 24 * 60),
                  array('method' => 'popup', 'minutes' => 10),
                ),
              ),
            ));
            
            $calendarId = 'primary';
            $event = $service->events->insert($calendarId, $event);
            printf('Event created: %s\n', $event->htmlLink);
          
            $index++;
         }
        $index=0;  
    }
             
 }
        
                   
            
          
             

// if (empty($events)) {
//     print "No upcoming events found.\n";
// } else {
//     print "Upcoming events:\n";
//     foreach ($events as $event) {
//         $start = $event->start->dateTime;
//         if (empty($start)) {
//             $start = $event->start->date;
//         }
//         printf("%s (%s)\n", $event->getSummary(), $start);
//     }
// }
?>
</html>          