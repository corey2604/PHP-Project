<?php
  require_once(__DIR__.'/../whatShouldIWatchFunctions.php');
  getHeader("My Recommendations", true);
  if (doesUserHaveRecommendations($_SESSION['valid_user'])) {
    $mostPopularGenreId = getMostPopularGenreIdFromDatabaseForUser($_SESSION['valid_user']);
    $movieChunks = searchForMoviesInGenre($mostPopularGenreId);?>
    <h2 class="pt-3">Recommendations based on your most popular genre: <span class="font-weight-light"><?php echo getGenreNameFromId($mostPopularGenreId); ?></span></h2>
    <?php getCardRows($movieChunks);
  } else {
    getMissingFavouritesDisplay("recommendations");
  }
  getFooter();
 ?>
