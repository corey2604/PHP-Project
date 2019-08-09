<?php
//A component class to output the results of a movie search to the index page
require_once(__DIR__ . '/../whatShouldIWatchFunctions.php');
function getMovieResults()
{
    $keyword = getKeyWordIfPresent();
    //If the user has specified a movie title/keyword to search for then query the API and divide the results into chunks for formatting to the browser
    if (isset($_POST['submit']) && !empty($keyword))
    {
        $movieChunks = searchForMovies($keyword);
        getCardRows($movieChunks);
    }
}
?>
