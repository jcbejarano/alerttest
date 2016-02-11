<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>ALERT TEST</title>
        <link rel="stylesheet" href="css/stylesheet.css">
        <link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
        <link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
        <script src="js/jquery-1.11.0.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="js/main.js"></script> <!-- Resource jQuery -->
        <script src="js/modernizr.js"></script> <!-- Modernizr -->
    </head>
    <body>
        <div id="formWrapper">
            
            <div class="formWrapper">
                <div class="formTitle">Search Actor</div>
                <form id="create" name="create" method="post">
                    <input name="actor" type="search" placeholder="ex.Bill Murray" required>            
                    <input name="buscar" type="submit" value="Search" >
                </form>
            </div>
            
        </div>

        <div id="actor_info">



        </div>

      <script>
            $(function(){
               $("#create").submit(function(evt){
                  evt.preventDefault();
                  var actor = $("input[name=actor]").val();
                  
                  $.ajax({
                     type: "POST",
                     url: "search_actor.php",
                     data: {actor: actor}
                  }).done(function(msg){
                      if(msg != 0){
                            
                            //var rol = JSON.parse(msg)["rol"];
                            $("#actor_info").append(msg);

                                                   
                         }else{
                            alert("Sorry we do not have information to "+actor+" please verify.");
                        }
                  });
                  
               });
            });
        </script>
    </body>
</html>



