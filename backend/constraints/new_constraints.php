<!DOCTYPE html>
<head>

    <!-- Bootstrap core JavaScript -->
    <script src="jquery.min.js"></script>
    <script src="bootstrap.bundle.min.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Constraint</title>
    <link rel="stylesheet" href="jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- Include Date Range Picker -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Arimo" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="one-page-wonder.min.css" rel="stylesheet">

    <!-- Additional CSS -->
    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="stylesheet" type="text/css" href="constraints.css">

    <!-- jQuery UI -->
    <link rel="stylesheet" href="jquery-ui/jquery-ui.min.css">
    <script src="jquery-ui/external/jquery/jquery.js"></script>
    <script src="jquery-ui/jquery-ui.min.js"></script>

    <!-- <script src="jquery-ui/datepicker-he.js"></script> -->

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

    <script>
        $(document).ready(function() {
            $(this).scrollTop(0);
        });
    </script>

    <script type="text/javascript" >
        function enableDisable(){
            if(document.getElementById("sameDay").checked == true) {
                document.getElementById("end").disabled = true;
            
            }
            else {
                document.getElementById("end").disabled = false;
                
            }
        }
     
 function ifSameDay(){       
           
   if( document.getElementById("start").value!=document.getElementById("end").value)
   {
        document.getElementById("replace").disabled = false;
        document.getElementById("show").disabled = false;
        document.getElementById("messege").innerHTML="שים לב: עבור בקשת החלפה הכנס תאריך יחיד";
       
       
   }
   
   else
   {
         document.getElementById("replace").disabled = true;
        document.getElementById("show").disabled = true;
       document.getElementById("messege").innerHTML=" ";
   }
 }
 
    </script>

</head>

<body>
<div class="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.html"><img src="img/logo.png"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="Constraints.html">אילוצים</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Schedule.html">שיבוצים</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ניהול
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">ניהול הצגות</a>
                            <a class="dropdown-item" href="#">ניהול עובדים</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">פתח חלון זמנים</a>
                        </div>
                    </li>
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
                            <h2 class="masthead-subheading mb-0">יצירת אילוץ</h2>

                            <form name="constraints" action="insert_constraint.php" method="POST">
                                <p>שם:
                                    <select name="owner">
                                        <?php include "actors_names.php";
                                        ?>
                                    </select>
                                </p>
                                <p>תאריך תחילת אילוץ<input type="date" name="fDate"id="start" data-date-format="YYYY-MM-DD"></p>
                                <p>תאריך סיום אילוץ<input type="date" name="lDate"id="end" data-date-format="YYYY-MM-DD"onclick="ifSameDay()">    <input type="checkbox" id="sameDay" name="sameDay" onclick="enableDisable()"> יום אחד בלבד</p>
                                <div id="epoque">
                                    <p>בחר חלונות זמנים ביום זה בהם אינך פנוי:
                                        <input type="checkbox" id="morning" name="range1" value="morning" checked>
                                        <label for="morning">בוקר</label>
                                        <input type="checkbox" id="noon" name="range2" value="noon" checked>
                                        <label for="noon">צהריים</label>
                                        <input type="checkbox" id="evening" name="range3" value="evening" checked>
                                        <label for="evening">ערב</label>
                                    </p>
                                </div>
                                <p><label>תיאור האילוץ:     <textarea name="description" cols="30 rows="3"></textarea></label></p>
                                <p>__________________הזן מטה באם מדובר בהחלפה__________________</p>
                                <p>שם שחקן מחליף (במידה ויש):
                                    <select name="replace" id="replace">
                                    
                                     <?php include "actors_names.php";
                                        ?>
                                    </select>
                                </p>
                                <p>שם הצגה:
                                    <select name="show" id="show">
                                   <?php include "active_plays.php";
                                        ?>
                                    </select>
                                </p>
                             
                                 <p id="messege"> </p>
                                <div class="formButtons form-group">
                                    <button name="submit" type="submit" onclick="#">שמור</button>
                                    <button type="reset" value="Reset">איפוס</button>
                                    <button name="cancel" onclick="cancel">ביטול</button>

                                </div>
                            </form>
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
        <p class="m-0 text-center text-white small">Copyright Mikro Theater</p>
    </div>
    <!-- /.container -->
</footer>

<!--
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
 -->
</body>

</html>