<?php
require 'vendor/autoload.php';
$maxResults = 5;

function getKeyWordIfPresent() {
  return isset($_POST["keyword"]) ? $_POST["keyword"] : '';
}

function testInput($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$keyword = getKeyWordIfPresent();
         $API_KEY = "1fd53134883fb4e950c4500c87738789";
         $client = new \GuzzleHttp\Client();
         $response = $client->get("https://api.themoviedb.org/3/search/movie", [
           'query' => [
             'api_key' => $API_KEY,
             'query' => $keyword
           ]
         ]);
         $value = json_decode($response->getBody(), true);
         $movies = $value["results"];
         $movieChunks = array_chunk($movies, 4);

         var_dump($value);
  ?>
  <!doctype html>
  <html>

  <head>
      <title>Search For Movie</title>

      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  </head>
  <body>
    <div class="container">
      <?php foreach($movieChunks as $movieRow): ?>
      <div class="row">
         <?php foreach($movieRow as $movie):
          $title = $movie['title'];
          $overview = $movie['overview'];
          $posterPath = $movie['poster_path'];
          ?>

          <div class="col-md-3 d-flex align-items-stretch">
             <div class="card h-100 d-flex flex-column justify-content-between">
                <div class="card-block">
                   <div class="card flex-fill">
                     <h4 class="cardtitle flex-column h-100 align-items-center justify-content-center" style="min-height: 9rem;"><?php echo $title?></h4>
                     <img class="card-img-top" src="<?php echo "http://image.tmdb.org/t/p/w185$posterPath" ?>" >
                     <div class="card-body flex-column h-100">
                       <h6 class="card-text textmuted"><?php echo $overview; ?></h6>
                     </div>
                   </div>
                </div>
                   <div class="card-footer">
                     <a href="" class="btn btn-primary">Store as Favourite</a>
                   </div>
             </div>
         </div>
         <?php endforeach; ?>
        </div>
        <?php endforeach; ?>
        </div>
</body>
</html>
