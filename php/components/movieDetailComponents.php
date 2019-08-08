<?php
require_once(__DIR__.'/../whatShouldIWatchFunctions.php');
function getPoster($posterPath) {
  if (!empty($posterPath)) {
    echo "http://image.tmdb.org/t/p/w185$posterPath";
  } else {
    echo "http://scm.ulster.ac.uk/~b00652935/COM549/Project/assets/noPosterAvailable.jpeg";
  }
}

function getGenres($genres) {
  if (!empty($genres)) {
    echo getGenresFromAPI($genres);
  } else {
    echo "Genre information for this movie has not been provided";
  }
}?>
