<?php
require_once(__DIR__.'/../whatShouldIWatchFunctions.php');
$response = "";
if (isset($_POST['submit']) )
{
   $keyword = getKeyWordIfPresent();

   if (empty($keyword)) {
       $response = array(
             "type" => "error",
             "message" => "Please enter a keyword."
       );
   }
}
getHeader("Search For Movie", false);
getMovieSearchBar($response);
getMovieResults();
getFooter();
?>
