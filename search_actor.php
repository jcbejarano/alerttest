<?php


    include('tmdb-api.php');

    // Insert your api key of TMDB
    $apikey = '8e6b3ea147a291f833ea1ead9195b3f2';
    $language = 'es';
    $tmdb = new TMDB($apikey, $language); // by simply giving $apikey it sets the default lang to 'en'



	// BUSCRA ACTOR
    $name = $_POST["actor"];
    $persons = $tmdb->searchPerson($name);
    foreach($persons as $person){
         $int =(int)$person->getID();



          // 2. Full Person Info
            echo '<div id="header"><br><br><a id="personInfo"><h3>Actor Information</h3></a>';
            echo '<img src="'. $tmdb->getImageURL('w185') . $person->getProfile() .'"/>';
            $person = $tmdb->getPerson($int);
            echo '<ul><h4><b>'. $person->getName() .'</b><ul>';
            echo '  <li>ID: '. $person->getID() .'</li>';
            echo '  <li>Birthday: '. $person->getBirthday() .'</li>';
            echo '  <li>Popularity: '. $person->getPopularity() .'</h4></li>';
            echo '</ul>...';
            echo '</ul></li><br><hr>';
            // 3. Get the roles
            echo '<a id="personRoles">Movies In Chronological Order</a><br>';
            $movieRoles = $person->getMovieRoles();
            echo '<b>'. $person->getName() .'</b> - <b>Movies</b>: <ul></div>';
            $roles = [];
            foreach($movieRoles as $key => $movieRole){
               $roles[$key]["personaje"] = $movieRole->getCharacter();
               $roles[$key]["pelicula"] = $movieRole->getMovieTitle();
               $roles[$key]["fecha"] = $movieRole->getMovieReleaseDate();
               $roles[$key]["time"] = strtotime($movieRole->getMovieReleaseDate());
               $roles[$key]["id"]=$movieRole->getMovieID();
               // echo '<li>'. $movieRole->getCharacter() .' in <a href="https://www.themoviedb.org/movie/'. $movieRole->getMovieID() .'">'. $movieRole->getMovieTitle() .'</a> - Date:'. $movieRole->getMovieReleaseDate() .'</li>';
            }
            usort($roles, function (array $a, array $b) { return $a["time"] - $b["time"]; });

            echo "<section id='cd-timeline'>";
            
            foreach ($roles as $rol) {
               echo '<div class="cd-timeline-block"><div class="cd-timeline-img cd-movie"><img src="img/cd-icon-movie.svg" alt="Movie"></div><div class="cd-timeline-content"><h2><a href="https://api.themoviedb.org/3/movie/'. $rol["id"] .'?api_key=8e6b3ea147a291f833ea1ead9195b3f2">'.$rol["pelicula"].'</a></h2><p> As: '. $rol["personaje"] .'<div id="overview_'. $rol["id"] .'" style="display: none"></div></P><button onclick="movie_info('.$rol["id"].')">Read more</button><span class="cd-date"><b>'.$rol["fecha"].'</b></span></div></div>';
           
            }
            echo '</section></ul><br><br>';
    }


           



?>