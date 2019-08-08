<?php
require __DIR__.'/../../vendor/autoload.php';
use GuzzleHttp\Client;
use Carbon\Carbon;
$API_KEY = "1fd53134883fb4e950c4500c87738789";
$client = new GuzzleHttp\Client();

function getCurrentlyShowingMovies() {
  global $API_KEY;
  global $client;
  $response = $client->get("https://api.themoviedb.org/3/discover/movie", [
    'query' => [
      'api_key' => $API_KEY,
      'primary_release_date.gte' => Carbon::now()->subDay(7)->format('Y-m-d'),
      'primary_release_date.lte' => Carbon::now()->format('Y-m-d'),
      'page' => 1,
    ]
  ]);
  $value = json_decode($response->getBody(), true);
  $movies = $value["results"];
  return $movieChunks = array_chunk($movies, 4);
}

function getGenresFromAPI($genres) {
  foreach($genres as $genre): ?>
     <h6 class="card-text textmuted"><?php echo $genre["name"]; ?></h6>
  <?php endforeach;
}

function getMovieData($movieId) {
  global $API_KEY;
  global $client;
  $response = $client->get("https://api.themoviedb.org/3/movie/$movieId", [
    'query' => [
      'api_key' => $API_KEY,
    ]
  ]);
  return $response;
}

function searchForMovies($keyword) {
  global $API_KEY;
  global $client;
  $response = $client->get("https://api.themoviedb.org/3/search/movie", [
    'query' => [
      'api_key' => $API_KEY,
      'query' => $keyword,
      'page' => 1,
    ]
  ]);
  $value = json_decode($response->getBody(), true);
  $movies = $value["results"];
  return $movieChunks = array_chunk($movies, 4);
}

function searchForMoviesInGenre($genreId) {
  $API_KEY = "1fd53134883fb4e950c4500c87738789";
  $client = new GuzzleHttp\Client();
  $response = $client->get("https://api.themoviedb.org/3/discover/movie", [
    'query' => [
      'api_key' => $API_KEY,
      'with_genres' => $genreId,
      'sort_by' => 'popularity.desc',
      'page' => 1,
    ]
  ]);
  $value = json_decode($response->getBody(), true);
  $movies = $value["results"];
  return $movieChunks = array_chunk($movies, 4);
}
?>
