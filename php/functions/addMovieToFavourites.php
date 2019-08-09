<?php
session_start();
require_once(__DIR__.'/../whatShouldIWatchFunctions.php');
if (isset($_GET['title'])) {
  $title = $_GET['title'];
  $overview = $_GET['overview'];
  $posterPath = $_GET['posterPath'];
  $genres= $_GET['genres'];
  storeMovieAsFavourite($_SESSION['userId'], $title, $overview, $posterPath, $genres);
} else {
  getErrorMessage("An unexpected error occurred. $title was unable to be stored as a favourite");
}
?>
