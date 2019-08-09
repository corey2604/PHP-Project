<?php
require_once (__DIR__ . '/../whatShouldIWatchFunctions.php');
getHeader("My Recommendations", true);
//If the user is eligible for recommendations then retrieve their most popular genre and call the API to get recommended movies
if (doesUserHaveRecommendations($_SESSION['userId']))
{
    $mostPopularGenreId = getMostPopularGenreIdFromDatabaseForUser($_SESSION['userId']);
    $movieChunks = searchForMoviesInGenre($mostPopularGenreId); ?>
    <h2 class="pt-3">Recommendations based on your most popular genre: <span class="font-weight-light"><?php echo getGenreNameFromId($mostPopularGenreId); ?></span></h2>
    <?php getCardRows($movieChunks);
}
//Otherwise output a screen informing the user that they aren't eligible to receive recommendations
else
{
    getMissingFavouritesDisplay("recommendations");
}
getFooter();
?>
