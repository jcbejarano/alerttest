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
            echo '<div id="header"><br><br><a id="personInfo"><h3>Actor Information</h3></a><ul>';
            $person = $tmdb->getPerson($int);
            echo '<b>'. $person->getName() .'</b><ul>';
            echo '  <li>ID: '. $person->getID() .'</li>';
            echo '  <li>Birthday: '. $person->getBirthday() .'</li>';
            echo '  <li>Popularity: '. $person->getPopularity() .'</li>';
            echo '</ul>...';
            echo '<img src="'. $tmdb->getImageURL('w185') . $person->getProfile() .'"/>';
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
               echo '<div class="cd-timeline-block"><div class="cd-timeline-img cd-movie"><img src="img/cd-icon-movie.svg" alt="Movie"></div><div class="cd-timeline-content"><h2><a href="https://www.themoviedb.org/movie/'. $rol["id"] .'">'.$rol["pelicula"].'</a></h2><p> As: '. $rol["personaje"] .'</P><a href="https://www.themoviedb.org/movie/'. $rol["id"] .'" class="cd-read-more">Read more</a><span class="cd-date"><b>'.$rol["fecha"].'</b></span></div>';
           
            }
            echo '</section></ul><br><br>';
    }


           



?>