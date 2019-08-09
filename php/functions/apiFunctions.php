<?php
//This class contains all of the functions used by the application to interact with theMovieDb API
require_once(__DIR__.'/../../vendor/autoload.php');
//Guzzle is used for API interaction
use GuzzleHttp\Client;
//Carbon is used for date formatting
use Carbon\Carbon;
//Initialise my API key and Guzzle client which will be used in all API interactions
$API_KEY = "1fd53134883fb4e950c4500c87738789";
$client = new GuzzleHttp\Client();

function getCurrentlyShowingMovies() {
  //Make an API request to return all movies with a release date within the past week
  global $API_KEY;
  global $client;
  $response = $client->get("https://api.themoviedb.org/3/discover/movie", [
    'query' => [
      'api_key' => $API_KEY,
      //Carbon is used to get today's date and today's date - 7 days
      'primary_release_date.gte' => Carbon::now()->subDay(7)->format('Y-m-d'),
      'primary_release_date.lte' => Carbon::now()->format('Y-m-d'),
      'page' => 1,
    ]
  ]);
  //Decode the API response
  $value = json_decode($response->getBody(), true);
  $movies = $value["results"];
  //Divide the results returned from the API into chunks of 4 for easier formatting and displaying on the browser
  return $movieChunks = array_chunk($movies, 4);
}

function getMovieData($movieId) {
  //Make an API request to return all data on a particular movie using it's unique id
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
  //Make an API request to return all data on movies that contain a specified keyword in their title
  global $API_KEY;
  global $client;
  $response = $client->get("https://api.themoviedb.org/3/search/movie", [
    'query' => [
      'api_key' => $API_KEY,
      'query' => $keyword,
      'page' => 1,
    ]
  ]);
  //Decode the API response
  $value = json_decode($response->getBody(), true);
  $movies = $value["results"];
  //Divide the results returned from the API into chunks of 4 for easier formatting and displaying on the browser
  return $movieChunks = array_chunk($movies, 4);
}

function searchForMoviesInGenre($genreId) {
  //Make an API request to return a list of all movies in a particular genre sorted by popularity in descending order
  global $API_KEY;
  global $client;
  $response = $client->get("https://api.themoviedb.org/3/discover/movie", [
    'query' => [
      'api_key' => $API_KEY,
      'with_genres' => $genreId,
      'sort_by' => 'popularity.desc',
      'page' => 1,
    ]
  ]);
  //Decode the API response
  $value = json_decode($response->getBody(), true);
  $movies = $value["results"];
  //Divide the results returned from the API into chunks of 4 for easier formatting and displaying on the browser
  return $movieChunks = array_chunk($movies, 4);
}
?>
