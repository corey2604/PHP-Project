<?php
//A component class to output associated movie details to movie cards or to output alternatives if details are not provided by the API
require_once(__DIR__.'/../whatShouldIWatchFunctions.php');
function getPoster($posterPath) {
  //Output the movie's poster if provided by the API, otherwise output a standard image from assets
  echo (!empty($posterPath)) ? "http://image.tmdb.org/t/p/w185$posterPath" : "http://scm.ulster.ac.uk/~b00652935/COM549/Project/assets/noPosterAvailable.jpeg";
}

function getGenres($genres) {
    //Output the movie's genres if provided by the API, otherwise output a standard message
  echo (!empty($genres)) ? getGenresFromAPI($genres) : "Genre information for this movie has not been provided";
}?>
