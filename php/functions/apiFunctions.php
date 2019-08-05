<?php
require __DIR__.'/../../vendor/autoload.php';
$API_KEY = "1fd53134883fb4e950c4500c87738789";
use GuzzleHttp\Client;
use Carbon\Carbon;
$client = new GuzzleHttp\Client();

function getCurrentlyShowingMovies() {
  $API_KEY = "1fd53134883fb4e950c4500c87738789";
  $client = new GuzzleHttp\Client();
  $response = $client->get("https://api.themoviedb.org/3/discover/movie", [
    'query' => [
      'api_key' => $API_KEY,
      'primary_release_date.gte' => Carbon::now()->subDay(7)->format('Y-m-d')
    ]
  ]);
  $value = json_decode($response->getBody(), true);
  $movies = $value["results"];
  return $movieChunks = array_chunk($movies, 4);
}

function searchForMovies($keyword) {
  $API_KEY = "1fd53134883fb4e950c4500c87738789";
  $client = new GuzzleHttp\Client();
  $response = $client->get("https://api.themoviedb.org/3/search/movie", [
    'query' => [
      'api_key' => $API_KEY,
      'query' => $keyword
    ]
  ]);
  $value = json_decode($response->getBody(), true);
  $movies = $value["results"];
  return $movieChunks = array_chunk($movies, 4);
}
?>
