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


        <!-- modal box -->

    </head>
    <body>
      <header>
        <div class="formWrapper">
                <form id="create" name="create" method="post">
                    <input name="actor" type="search" placeholder="ex.Bill Murray" required>            
                    <input name="buscar" type="submit" value="Search" >
                </form>
        </div>
        <h1>Search Actor</h1> 
    </header>
        
            
            
        

        <div id="actor_info">


        </div>

        <div id="openModal" class="modalDialog">

          <div>
            <a href="#close" title="Close" onclick="clean()" class="close">X</a>
            <div id="trailer">

            </div>
          </div>
  
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
                            $("#actor_info").html(msg);

                                                   
                         }else{
                            $("#trailer").html("<p>Sorry we do not have information to "+actor+" please verify.</p><p><img src='img/sorry.png'</p>");
                        }
                  });
                  
               });
            });


            function movie_info (id) {



              $.ajax({
                  type: 'GET',
                  url: "https://api.themoviedb.org/3/movie/"+id+"?api_key=8e6b3ea147a291f833ea1ead9195b3f2",
                  async: false,
                  jsonpCallback: 'testing',
                  contentType: 'application/json',
                  dataType: 'jsonp',
                  success: function(json) {


                      if (json["overview"]!= null) {
                        
                        $("#overview_"+id).html("<img itemprop='image' src='https://image.tmdb.org/t/p/w185/"+json["poster_path"]+"' width='185' height='278'><p>"+json["overview"]+"</p><p>Web page: <a href='"+json["homepage"]+"'>"+json["original_title"]+"</a></p><p><a href='#openModal' onclick='movie_trailer("+json["id"]+")'><b><h3>Movie Trailer</h3></b></a></p>");
                      }else{

                        $("#overview_"+id).html("Sorry we dont have overview for this movie.")

                      }         



                  },
                  error: function(e) {
                      console.log(e.message);
                  }
                });

                $("#overview_"+id).toggle( "slow" );
            }

            function movie_trailer(id){

              $.ajax({
                     type: "POST",
                     url: "search_trailer.php",
                     data: {id: id}
                  }).done(function(msg){
                      if(msg != 0){

                          if (msg.indexOf('Notice') >= 0) {

                            $("#trailer").html("<h2>Sorry no videos found.</h2><p>We cant find this trailer on youtube.</p><p><img src='img/sorry.png'</p>");

                          }else{

                              
                              $("#trailer").html(msg);

                          }
                          
                         }else{

                            $("#trailer").html("<h2>Sorry no videos found.</h2><p>We cant find this trailer on youtube.</p><p><img src='img/sorry.png'</p>");
                        }
                  });



            }
            function clean(){

              $("#trailer").html("");


            }

              


            
        </script>
    </body>
</html>



