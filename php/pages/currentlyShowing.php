<?php
require_once(__DIR__.'/../whatShouldIWatchFunctions.php');

$keyword = getKeyWordIfPresent();
$movieChunks = getCurrentlyShowingMovies();
getHeader("Currently Showing Movies", true);
getCardRows($movieChunks);
getFooter();
?>
