 <!DOCTYPE html>
  <head>
    
    <!-- Bootstrap core JavaScript -->
    <script src="jquery.min.js"></script>
    <script src="bootstrap.bundle.min.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Show</title>
    <link rel="stylesheet" href="jquery-ui.css">
    <link rel="stylesheet" href="style.css">
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
    <link rel="stylesheet" type="text/css" href="newShow.css">

    <!-- jQuery UI -->
    <link rel="stylesheet" href="jquery-ui.min.css">
    <script src="jquery.js"></script>
    <script src="jquery-ui.min.js"></script>

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
            document.getElementById("morning").disabled = false;
            document.getElementById("noon").disabled = false;
            document.getElementById("evening").disabled = false;
          } 
          else {
            document.getElementById("end").disabled = false;
            document.getElementById("morning").disabled = true;
            document.getElementById("noon").disabled = true;
            document.getElementById("evening").disabled = true;
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
              <a class="nav-link" href="constraint_management.php">אילוצים</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Schedule.html">שיבוצים</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ניהול
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">ניהול הצגות</a>
                <a class="dropdown-item" href="workers_management.html">ניהול עובדים</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="open_timeframe.html">פתח חלון זמנים</a>
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
                <h2 class="masthead-subheading mb-0">יצירת הצגה</h2>

                <form name="shows" action="insert_play.php" method="POST">
                  <p><label>שם ההצגה: <input type="text" name="playName" ></label></p>
                  <p><label>תיאור ההצגה: <textarea name="description" cols="30 rows="3"></textarea></label></p>
                  <p>רשימת השחקנים המשתתפים בהצגה: </p>
                  <?php include "chose_actors.php" ?>
                    
                   
                  <p>סטטוס: 
                  <select name="isActive">
                     <option value="yes">פעיל</option>
                     <option value="no">לא פעיל</option>
                     </select> 
                  </p>   

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
  </body>

</html>