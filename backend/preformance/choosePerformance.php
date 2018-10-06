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
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
        
        <meta http-equiv="Content-Type" content="text/html; charset=ansi_x3.110-1983">
    
        <style>
            /* calendar */
            table.calendar { 
                border-left:1px solid #999; 
            }
            
            tr.calendar-row	{ 
            }
            
            td.calendar-day	{ 
                min-height:80px; 
                font-size:11px; 
                position:relative; 
            } 
            
            * html div.calendar-day { 
                height:80px;
            }
            
            td.calendar-day:hover { 
                background:#eceff5;
            }
            
            td.calendar-day-np { 
                background:#eee; 
                min-height:80px;
            } 
            
            * html div.calendar-day-np { 
                height:80px;
            }
            
            td.calendar-day-head { 
                background:#ccc; 
                font-weight:bold; 
                text-align:center; 
                width:120px; 
                padding:5px; 
                border-bottom:1px 
                solid #999; 
                border-top:1px 
                solid #999; 
                border-right:1px solid #999;
            }
            
            div.day-number	{ 
                background:#999; 
                padding:5px; 
                color:#000; 
                font-weight:bold; 
                float:right;
                margin:-5px -5px 0 0; 
                width:20px; 
                text-align:center;
            }
            
            /* shared */
            td.calendar-day, td.calendar-day-np {
                height:150px;  
                width:200px; 
                padding:5px; 
                border-bottom:1px solid #999; 
                border-right:1px solid #999; 
            }
        </style>
        
        <script type="text/javascript">
            document.getElementById('month').value = "<?php echo $_POST['month'];?>";
            document.getElementById('year').value = "<?php echo $_POST['year'];?>";
        </script>
    </head>

    <body>
        <table>
            <thead>
                <tr class="plays">
                    <td >
                        <table>
                            <?php 
                                $myPlays = getAllPlaysNamesAndThierColor();
                                $playsTable = '';
                                
                                echo "<strong>:מקרא צבעי ההצגות</strong>";
                                
                                for($i = 0; $i < count($myPlays); $i++) {
                                    $playsTable .='<td style="border:1px solid;
                                                        width: calc(100%/10); 
                                                        background-color:'.$myPlays[$i][1].'; 
                                                        text-align: center;">
                                                        <label>'.$myPlays[$i][0].'</label>
                                                    </td>';
                                }
                                 echo $playsTable;
                            ?>
                        </table>
                    </td>
                    </tr>
                    </thead>
                <td>
                    <form id="form1"  method="post">
                        <?php
                            session_start();
                            header('Content-Type: application/json'); 
                            include_once 'algorithm.php';
                            
                            /* draws a calendar */
                            function draw_calendar($month,$year) {
                                $myShow = new Shows();
                                $myShowCal =  array();
                                $myShowCal = $myShow->CreateDetailsFromDbToCal($month, $year);
                                
                               
                                /* draw table */
                                $calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';
                                
                                /* table headings */
                                $headings = array('ראשון','שני','שלישי','רביעי','חמישי','שישי','שבת');
                                $calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';
                                
                                /* days and weeks vars now ... */
                                $running_day = date('w',mktime(0,0,0,$month,1,$year));
                                $days_in_month = date('t',mktime(0,0,0,$month,1,$year));
                                $days_in_this_week = 1;
                                $day_counter = 0;
                                $dates_array = array();
                                $testcolor = "red";
                                
                                /* row for week one */
                                $calendar.= '<tr class="calendar-row">';
                                /* print "blank" days until the first of the current week */
                                for($x = 0; $x < $running_day; $x++):
                                $calendar.= '<td class="calendar-day-np"> </td>';
                                $days_in_this_week++;
                                endfor;
                                /* keep going with days.... */
                                
                                if(isset($_POST['delete'])) {
                                    freshDB($month, $year);
                                }
                                
                                $dayNumber = 1; //to show the they number in the calendar 
                                
                                for($list_day = 1; $list_day <= $days_in_month; $list_day++):
                                $calendar.= '<td  class="calendar-day">';
                                $calendar.= '<table border="1" style="width: 100%;" ><label>'.$dayNumber.'</label><tr><td>';
                                $dayNumber++;
  
                                 if(isset($_POST['save'])) {
                                   
                                     if($list_day == 1){
                                        freshDB($month, $year);
                                     }
                                
                                   for($rangeOne = 0; $rangeOne < count($myShowCal[$list_day-1]); $rangeOne++):
                                       if(in_array(1, $myShowCal[$list_day-1][$rangeOne]->showTime)):
                                       if(isset($_POST[$list_day."1"]) && $_POST[$list_day."1"] == $myShowCal[$list_day-1][$rangeOne]->showName){
                                                   $calendar.= '<label for="'.$list_day.'1" style="background-color:'.$myShowCal[$list_day-1][$rangeOne]->showColor.';"><input id="'.$myShowCal[$list_day-1][$rangeOne]->showName.'" value="'.$myShowCal[$list_day-1][$rangeOne]->showName.'" form="form1" maxlength="'.$list_day.'" type="radio" checked="checked" class="1"  name="'.$list_day.'1"></label>';
                                                   
                                                   save($month, $year, $list_day, 1, $myShowCal[$list_day-1][$rangeOne]->showName);
                                           }
                                           else {
                                               $calendar.= '<label for="'.$list_day.'1" style="background-color:'.$myShowCal[$list_day-1][$rangeOne]->showColor.';"><input id="'.$myShowCal[$list_day-1][$rangeOne]->showName.'" value="'.$myShowCal[$list_day-1][$rangeOne]->showName.'" form="form1" maxlength="'.$list_day.'" type="radio"  class="1"  name="'.$list_day.'1"></label>';
                                           }
                                       endif;
                                    
                                    endfor;
                                    $calendar.= '</td></tr><tr><td>';
                                    for($rangeTwo = 0; $rangeTwo < count($myShowCal[$list_day-1]); $rangeTwo++):
                                    if(in_array(2, $myShowCal[$list_day-1][$rangeTwo]->showTime)):
                                    
                                            if(isset($_POST[$list_day."2"]) && $_POST[$list_day."2"] == $myShowCal[$list_day-1][$rangeTwo]->showName){
                                                $calendar.= '<label for="'.$list_day.'2" style="background-color:'.$myShowCal[$list_day-1][$rangeTwo]->showColor.';"><input id="'.$myShowCal[$list_day-1][$rangeTwo]->showName.'" value="'.$myShowCal[$list_day-1][$rangeTwo]->showName.'" form="form1" maxlength="'.$list_day.'" type="radio" checked="checked" class="2"  name="'.$list_day.'2"></label>';
                                                
                                                save($month, $year, $list_day, 2, $myShowCal[$list_day-1][$rangeTwo]->showName);
                                            }
                                            else {
                                                $calendar.= '<label for="'.$list_day.'2" style="background-color:'.$myShowCal[$list_day-1][$rangeTwo]->showColor.';"><input id="'.$myShowCal[$list_day-1][$rangeTwo]->showName.'" value="'.$myShowCal[$list_day-1][$rangeTwo]->showName.'" form="form1" maxlength="'.$list_day.'" type="radio"  class="2"  name="'.$list_day.'2"></label>';
                                            }
                                        endif;
                                    
                                    endfor;
                                    
                                    $calendar.= '</td></tr><tr><td>';
                                    for($rangeThree = 0; $rangeThree < count($myShowCal[$list_day-1]); $rangeThree++):
                                    if(in_array(3, $myShowCal[$list_day-1][$rangeThree]->showTime)):
                                            if(isset($_POST[$list_day."3"]) && $_POST[$list_day."3"] == $myShowCal[$list_day-1][$rangeThree]->showName){
                                                $calendar.= '<label for="'.$list_day.'3" style="background-color:'.$myShowCal[$list_day-1][$rangeThree]->showColor.';"><input id="'.$myShowCal[$list_day-1][$rangeThree]->showName.'" value="'.$myShowCal[$list_day-1][$rangeThree]->showName.'" form="form1" maxlength="'.$list_day.'" type="radio" checked="checked" class="3"  name="'.$list_day.'3"></label>';
                                                
                                                save($month, $year, $list_day, 3, $myShowCal[$list_day-1][$rangeThree]->showName);
                                            }
                                            else {
                                                $calendar.= '<label for="'.$list_day.'3" style="background-color:'.$myShowCal[$list_day-1][$rangeThree]->showColor.';"><input id="'.$myShowCal[$list_day-1][$rangeThree]->showName.'" value="'.$myShowCal[$list_day-1][$rangeThree]->showName.'" form="form1" maxlength="'.$list_day.'" type="radio"  class="3"  name="'.$list_day.'3"></label>';
                                            }
                                    endif;
                                    
                                    endfor;
                                }
                                else if(!isset($_POST['display']))  {
                                    
                                    
                                    for($rangeOne = 0; $rangeOne < count($myShowCal[$list_day-1]); $rangeOne++):
                                    if(in_array(1, $myShowCal[$list_day-1][$rangeOne]->showTime)):
                                    $calendar.= '<label for="'.$list_day.'1" style="background-color:'.$myShowCal[$list_day-1][$rangeOne]->showColor.';"><input id="'.$list_day.'1" value="'.$myShowCal[$list_day-1][$rangeOne]->showName.'" form="form1" maxlength="'.$list_day.'" type="radio"  name="'.$list_day.'1" class="1"></label>';
                                    //$calendar .='<input type="radio"  name="r1" /><label for="">r1</label>';
                                    //$calendar.= '<label for="r1" style="background-color:'.$myShowCal[$list_day-1][$rangeOne]->showColor.';"><input  type="radio" id="r1"/></label>';
                                    endif;
                                    
                                    endfor;
                                    $calendar.= '</td></tr><tr><td>';
                                    for($rangeTwo = 0; $rangeTwo < count($myShowCal[$list_day-1]); $rangeTwo++):
                                    if(in_array(2, $myShowCal[$list_day-1][$rangeTwo]->showTime)):
                                    $calendar.= '<label for="'.$list_day.'2" style="background-color:'.$myShowCal[$list_day-1][$rangeTwo]->showColor.';"><input id="'.$list_day.'2" type="radio" form="form1" maxlength="'.$list_day.'" value="'.$myShowCal[$list_day-1][$rangeTwo]->showName.'"  name="'.$list_day.'2" class="2"></label>';
                                    endif;
                                    
                                    endfor;
                                    
                                    $calendar.= '</td></tr><tr><td>';
                                    for($rangeThree = 0; $rangeThree < count($myShowCal[$list_day-1]); $rangeThree++):
                                    if(in_array(3, $myShowCal[$list_day-1][$rangeThree]->showTime)):
                                    $calendar.= '<label for="'.$list_day.'3" style="background-color:'.$myShowCal[$list_day-1][$rangeThree]->showColor.';"><input id="'.$list_day.'3" type="radio" form="form1" maxlength="'.$list_day.'" value="'.$myShowCal[$list_day-1][$rangeThree]->showName.'"  name="'.$list_day.'3" class="3"></label>';
                                    endif;
                                    
                                    endfor;
                                }
                                
                                    if(isset($_POST['display'])) {
                                        
                                        $myShowToDisplay = selectMyChoices($month, $year);
                                        $flag = false;
                                        for($rangeOne = 0; $rangeOne < count($myShowCal[$list_day-1]); $rangeOne++):
                                          
                                        
                                     
                                        if(in_array(1, $myShowCal[$list_day-1][$rangeOne]->showTime)):
                                        
                                            for($i = 0 ; $i < count($myShowToDisplay); $i++){
                                                if($myShowToDisplay[$i][1] == $list_day && 
                                                    $myShowToDisplay[$i][0] == $myShowCal[$list_day-1][$rangeOne]->showName &&
                                                    $myShowToDisplay[$i][2] == 1) {
                                                        $calendar.= '<label for="'.$list_day.'1" style="background-color:'.$myShowCal[$list_day-1][$rangeOne]->showColor.';"><input id="'.$myShowCal[$list_day-1][$rangeOne]->showName.'" value="'.$myShowCal[$list_day-1][$rangeOne]->showName.'" form="form1" maxlength="'.$list_day.'" type="radio" checked="checked" class="1"  name="'.$list_day.'1"></label>';
                                                    $flag = true;
                                                    }
                                            }
                                            if(!$flag){
                                            
                                                $calendar.= '<label for="'.$list_day.'1" style="background-color:'.$myShowCal[$list_day-1][$rangeOne]->showColor.';"><input id="'.$myShowCal[$list_day-1][$rangeOne]->showName.'" value="'.$myShowCal[$list_day-1][$rangeOne]->showName.'" form="form1" maxlength="'.$list_day.'" type="radio"  class="1"  name="'.$list_day.'1"></label>';
                                            }
                                        endif;
                                            $flag = false;
                                        endfor;
                                        $calendar.= '</td></tr><tr><td>';
                                        for($rangeTwo = 0; $rangeTwo < count($myShowCal[$list_day-1]); $rangeTwo++):
                                        if(in_array(2, $myShowCal[$list_day-1][$rangeTwo]->showTime)):
                                            for($i = 0 ; $i < count($myShowToDisplay); $i++){
                                                if($myShowToDisplay[$i][1] == $list_day &&
                                                    $myShowToDisplay[$i][0] == $myShowCal[$list_day-1][$rangeTwo]->showName &&
                                                    $myShowToDisplay[$i][2] == 2) {
                                                        $calendar.= '<label for="'.$list_day.'2" style="background-color:'.$myShowCal[$list_day-1][$rangeTwo]->showColor.';"><input id="'.$myShowCal[$list_day-1][$rangeTwo]->showName.'" value="'.$myShowCal[$list_day-1][$rangeTwo]->showName.'" form="form1" maxlength="'.$list_day.'" type="radio" checked="checked" class="2"  name="'.$list_day.'2"></label>';
                                                        $flag = true;
                                                    }
                                            }
                                            if(!$flag){
                                                $calendar.= '<label for="'.$list_day.'2" style="background-color:'.$myShowCal[$list_day-1][$rangeTwo]->showColor.';"><input id="'.$myShowCal[$list_day-1][$rangeTwo]->showName.'" value="'.$myShowCal[$list_day-1][$rangeTwo]->showName.'" form="form1" maxlength="'.$list_day.'" type="radio"  class="2"  name="'.$list_day.'2"></label>';
                                            }
                                                
                                       
                                        endif;
                                            $flag = false;
                                        endfor;
                                        
                                        $calendar.= '</td></tr><tr><td>';
                                        for($rangeThree = 0; $rangeThree < count($myShowCal[$list_day-1]); $rangeThree++):
                                        if(in_array(3, $myShowCal[$list_day-1][$rangeThree]->showTime)):
                                        
                                        for($i = 0 ; $i < count($myShowToDisplay); $i++){
                                            if($myShowToDisplay[$i][1] == $list_day &&
                                                $myShowToDisplay[$i][0] == $myShowCal[$list_day-1][$rangeThree]->showName &&
                                                $myShowToDisplay[$i][2] == 3) {
                                                    $calendar.= '<label for="'.$list_day.'3" style="background-color:'.$myShowCal[$list_day-1][$rangeThree]->showColor.';"><input id="'.$myShowCal[$list_day-1][$rangeThree]->showName.'" value="'.$myShowCal[$list_day-1][$rangeThree]->showName.'" form="form1" maxlength="'.$list_day.'" type="radio" checked="checked" class="3"  name="'.$list_day.'3"></label>';
                                                    $flag = true;
                                                }
                                        
                                           
                                        }
                                        
                                        if(!$flag){
                                            $calendar.= '<label for="'.$list_day.'3" style="background-color:'.$myShowCal[$list_day-1][$rangeThree]->showColor.';"><input id="'.$myShowCal[$list_day-1][$rangeThree]->showName.'" value="'.$myShowCal[$list_day-1][$rangeThree]->showName.'" form="form1" maxlength="'.$list_day.'" type="radio"  class="3"  name="'.$list_day.'3"></label>';
                                        }
                                        endif;
                                            $flag = false;
                                        endfor;
                                        
                                    }
                                
                                    $calendar.= '</td></tr></table>';
                                    $calendar.= '</td>';
                                   
                                if($running_day == 6):
                                $calendar.= '</tr>';
                            if(($day_counter+1) != $days_in_month):
                            $calendar.= '<tr class="calendar-row">';
                                endif;
                                $running_day = -1;
                                $days_in_this_week = 0;
                                endif;
                                $days_in_this_week++; $running_day++; $day_counter++;
                                endfor;
                                /* finish the rest of the days in the week */
                                if($days_in_this_week < 8):
                                for($x = 1; $x <= (8 - $days_in_this_week); $x++):
                                $calendar.= '<td class="calendar-day-np"> </td>';
                                endfor;
                                endif;
                                /* final row */
                                $calendar.= '</tr>';
                            /* end the table */
                            $calendar.= '</table>';
                        /* all done, return result */
                        return $calendar;
                        }
                        /* sample usages */
                        
                        
                        $title = '<h2>';
                        $currMonth = 1;
                        $currYear = 1900;
                        if(isset($_POST['month'])){
                            $title .= $_POST['month'];
                            $currMonth = $_POST['month'];
                            
                        }
                        else {
                            $title .= date("m");
                            $currMonth = date("m");
                        }
                        
                        if(isset($_POST['year'])){
                            $title .= '-'.$_POST['year'];
                            $currYear = $_POST['year'];
                        }
                        else {
                            $title .= '-'.date("Y");
                            $currYear = date("Y");
                        }
                        
                        $title.='</h2>';
                        
                        echo $title;
                        
                        ?>
                         <label>בחר חודש</label>
                         <select name="month" id="month">
                            
                          <?php 
                          for( $i = 1; $i <= 12; $i++){
                           
                              ?>
                              
                              <option <?php if($currMonth == $i) {?> selected="selected" <?php }?> value="<?php echo $i?>"><?php echo $i?></option>
                              
                              <?php 
                          }
                             ?>
                        </select>
                        &nbsp;
                          
                        <label>בחר שנה</label>
                        <select name="year" id="year">
                            <?php 
                            for( $i = 2015; $i <= date(2030); $i++) {
                              ?>
                              
                              <option <?php if($currYear == $i) {?> selected="selected" <?php }?> value="<?php echo $i?>"><?php echo $i?></option>
                              <?php 
                          }
                          ?>
                        </select>
                        &nbsp;
                        <input class="present" type="submit" name="datePicker" value="הצג לוח שנה"  />
                        
                        <div>
                            <input class="submit" type="submit" name="save" value="שמור שינויים במערכת"  />
                            <input class="submit" type="submit" name="send" onclick="myFunction()" value="שלח זימונים לעובדים"  />
                            <div class="recieveAjax" style="display: inline-block;"></div><br><br>
                            <input class="display" type="submit" name="display" value="הצג רק מה ששמור כבר במערכת"  />
                            <input class="delete" type="submit" name="delete" value="מחק את כל הבחירות שלי עבור חודש זה" onclick="return confirm('This will delete all the data from the DB too!\nAre you sure?')"  />
                            <input class="reset" type="submit" name="clear" value="מחק סימונים" onclick="return confirm('This action will not affect on the DB unless you will press the save button after it\nAre you sure?')"  />
                        </div>
                        
        
                        
                        <?php 
                       session_start();
        
                        echo draw_calendar($currMonth,$currYear);
                        
                        function freshDB($month, $year) {
                            $conn = new mysqli("localhost","sharonsi_admin","mikro123456", "sharonsi_mikro");
                            
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
                            
                            
                            mysqli_set_charset($conn,"utf8");
                            
                            $sqlRemove = "DELETE FROM `saved_shows` WHERE `month`=".$month." AND `year`=".$year;
                            
                            if($conn->query($sqlRemove) == FALSE){
                                echo "Error: " . $sqlRemove . "<br>" . $conn->error;
                            }
                            
                            $conn->close();
                        }
                        
                        function selectMyChoices($month, $year) {
                            $conn = new mysqli("localhost","sharonsi_admin","mikro123456", "sharonsi_mikro");
                            
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
                            
                            
                            mysqli_set_charset($conn,"utf8");
                            
                            $sqlSelect = "SELECT DISTINCT `day`, `name`, `range` FROM `saved_shows` WHERE `month`=".$month." AND `year`=".$year;
                            
                            $result = $conn->query($sqlSelect);
                            
                            $conn->close();
                            
                            $myShowsToDisplay=array();
                            
                            $index=0;
                            
                            while($row = $result->fetch_assoc()) {
                                
                                $myShowsToDisplay[$index][0]=$row["name"];
                                $myShowsToDisplay[$index][1] = $row["day"];
                                $myShowsToDisplay[$index][2] = $row["range"];
                                $index++;
                            }
                            
                            return $myShowsToDisplay;
                        }
                        
                        function save($month, $year, $day,$range , $showName) {
                            
                            $conn = new mysqli("localhost","sharonsi_admin","mikro123456", "sharonsi_mikro");
                            
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
                            
                            
                            mysqli_set_charset($conn,"utf8");
                            
                            //$_SESSION['month'] = $month;
                           // $_SESSION['year'] = $year;
                           
                            
                          // $sqlSelect = "SELECT `name`, `day`, `month`, `year`, `range` FROM `saved_shows` WHERE `name`='".$showName."' AND `day`=".$day." AND `year`=".$year." AND `month`=".$month." AND `range`=".$range;
                           
                           //if( == FALSE){
                          // $result = $conn->query($sqlSelect);
                               //echo "Error: " . $sqlSelect . "<br>" . $conn->error;
                           //}
                           
                           //if(mysql_num_rows($result) < 0) {
                            
                            $sqlInsert = "INSERT INTO `saved_shows`(`guid`, `name`, `day`, `month`, `year`, `range`) VALUES (uuid(),'".$showName."' ,".$day.",".$month.",".$year.",".$range.")";
                            
                           
                            if($conn->query($sqlInsert) == FALSE){
                                echo "Error: " . $sqlInsert . "<br>" . $conn->error;
                            }
                           //}
                            
                           
                            $conn->close();
                        }
                        
                        
                        /*$servername = "localhost";
                        $username = "sharonsi_admin";
                        $password = "mikro123456";
                        $dbname="sharonsi_mikro";*/
                        
                        function getAllPlaysNamesAndThierColor() {
                            
                            $conn = new mysqli("localhost","sharonsi_admin","mikro123456", "sharonsi_mikro");
                            
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
                            
                            
                            mysqli_set_charset($conn,"utf8");
                            
                            // $sqlSelect = "SELECT `name`, `day`, `month`, `year`, `range` FROM `saved_shows` WHERE `name`='".$showName."' AND `day`=".$day." AND `year`=".$year." AND `month`=".$month." AND `range`=".$range;
                            
                            //if( == FALSE){
                            // $result = $conn->query($sqlSelect);
                            //echo "Error: " . $sqlSelect . "<br>" . $conn->error;
                            //}
                            
                            //if(mysql_num_rows($result) < 0) {
                            
                            $query = "SELECT `name`, `playColor` FROM `plays`";
                            
                            
                            $result = $conn->query($query);
                            
                            $conn->close();
                            
                            $myPlays=array();
                            
                            $index=0;
                            
                            while($row = $result->fetch_assoc()) {
                                
                                $myPlays[$index][0]=$row["name"];
                                $myPlays[$index][1] = $row["playColor"];
                                $index++;
                            }
                            
                            return $myPlays;
                        }
                        
                        
                        $_SESSION['year']= $_POST["year"];
                        $_SESSION['month']=$_POST["month"];
                        
                        ?>
            </div>
                <script>
        
                function myFunction() {
                    $.ajax({
                        url:'../quickstart.php',
                        beforeSend:function(){
                            $('.recieveAjax').html('');
                        },
                        success:function(){
                            if(results!=''){
                                $('.recieveAjax').html(results);
                                console.log('success');
                            }
                        }
                    });
                }
                </script>
                        
                         <input class="submit" type="submit" name="save" value="שמור שינויים"  />
                         <input class="display" type="submit" name="display" value="הצג רק מה ששמור כבר במערכת"  />
                         <input class="delete" type="submit" name="delete" value="מחק את כל הבחירות שלי עבור חודש זה" onclick="return confirm('This will delete all the data from the DB too!\nAre you sure?')"  />
                         <input class="reset" type="submit" name="clear" value="מחק סימונים" onclick="return confirm('This action will not affect on the DB unless you will press the save button after it\nAre you sure?')"  />
                    </form>
                </td>
            </tr>
        </table>
                        
    </body>
</html>