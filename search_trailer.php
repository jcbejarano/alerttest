<?php


    include('tmdb-api.php');

    // Insert your api key of TMDB
    $apikey = '8e6b3ea147a291f833ea1ead9195b3f2';
    $language = 'es';
    $tmdb = new TMDB($apikey, $language); // by simply giving $apikey it sets the default lang to 'en'


    $movie_id=$_POST["id"];
	$movie = $tmdb->getMovie($movie_id);

	echo '<h2>'. $movie->getTitle() .'</h2>';
	echo "<p></p>";
	echo "<p><iframe  width='560' height='315' src='https://www.youtube.com/v/". $movie->getTrailer() ."' style='border:none'></iframe></p>";

	            


?>