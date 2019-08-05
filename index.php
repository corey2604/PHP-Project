<?php
require 'vendor/autoload.php';

$API_KEY = "1fd53134883fb4e950c4500c87738789";
$client = new \GuzzleHttp\Client();
$response = $client->get("https://api.themoviedb.org/3/movie/550", [
  'query' => [
    'api_key' => $API_KEY,
  ]
]);
$value = json_decode($response->getBody(), true);
$adult = $value['budget'];
echo "BUDGET : $adult";
?>
