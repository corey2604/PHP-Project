<?php
require_once(__DIR__.'/../whatShouldIWatchFunctions.php');

$keyword = getKeyWordIfPresent();
$movieChunks = searchForMovies($keyword);
getHeader("Movie Results");
getCardRows($movieChunks);
getFooter() ?>
