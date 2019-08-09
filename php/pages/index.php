<?php
require_once (__DIR__ . '/../whatShouldIWatchFunctions.php');
//Initialise that there is no error message
$errorMessage = "";
//If the user has submitted a keyword search...
if (isset($_POST['submit']))
{
    //..get the keyword if present and if not present then set an error message to be output
    $keyword = getKeyWordIfPresent();
    $errorMessage = (empty($keyword)) ? "Please enter a keyword." : "";
}
getHeader("Search For Movie", false);
getMovieSearchBar($errorMessage);
getMovieResults();
getFooter();
?>
