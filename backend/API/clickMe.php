<?php
 session_start();

echo $_SERVER['DOCUMENT_ROOT'].'/quickstart.php';
 ?>
 
<!DOCTYPE html>
<html>
    <head>
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    </head>
    <body>
        <button onclick="myFunction()">Alla</button>
        <div class="recieveAjax">
            
        </div>
        <script>
        
            function myFunction() {
            $.ajax({
                url:'../quickstart.php',
                beforeSend:function(){
                    $('.recieveAjax').html('loading..');
                },
                // success:function(){
                //     if(results!=''){
                //         $('.recieveAjax').html(results);
                //         console.log('success');
                //     }
                // }
                
                success:function(results){
                    if(results!=''){
                        //$('.recieveAjax').html(results);
                        console.log('success');
                    }
                }
                
            });
               
            }
        </script>
    </body>
</html>
