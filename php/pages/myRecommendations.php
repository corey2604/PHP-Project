<?php
  require_once(__DIR__.'/../whatShouldIWatchFunctions.php');
  getHeader("My Recommendations");
  doesUserHaveRecommendations($_SESSION['valid_user']);
  ?>
  <div class="container">
  <?php
    echo "Your most popular genre is: ";
    $mostPopularGenreId = getMostPopularGenreIdFromDatabaseForUser($_SESSION['valid_user']);
    echo getMostPopularGenreName($mostPopularGenreId);
    $movieChunks = searchForMoviesInGenre($mostPopularGenreId);?>
    <h1>Recommendations based on your most popular genre</h1>
    <?php getCardRows($movieChunks);?>
  </div>
    <?php
  getFooter();
 ?>
