<?php
  require_once(__DIR__.'/../whatShouldIWatchFunctions.php');
  getHeader("My Recommendations");
  doesUserHaveRecommendations($_SESSION['valid_user']);
  echo "Your most popular genre is: ";
  $mostPopularGenreId = getMostPopularGenreIdFromDatabaseForUser($_SESSION['valid_user']);
  echo getMostPopularGenreName($mostPopularGenreId);
  $movieChunks = searchForMoviesInGenre($mostPopularGenreId);?>
  <h1>Recommendations based on your most popular genre</h1>
  <?php
  foreach($movieChunks as $movieRow): ?>
  <div class="row">
     <?php foreach($movieRow as $movie):
      $id = htmlspecialchars($movie['id']);
      echo getMovieData($id);
     endforeach; ?>
    </div>
  <?php endforeach; ?>
  </div>
    <?php
  getFooter();
 ?>
