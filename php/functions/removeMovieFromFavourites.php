<?php
require_once(__DIR__.'/../whatShouldIWatchFunctions.php');
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  try{
     deleteMovieFromFavourites($id);
   } catch (Exception $e) {
     getErrorMessage($e->getMessage());
   }
 } else {
   getErrorMessage("An unexpected error occurred. Movie was unable to be removed from favourites.");
 }
?>
