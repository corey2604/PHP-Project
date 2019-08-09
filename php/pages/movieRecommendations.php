<?php
require_once(__DIR__.'/../whatShouldIWatchFunctions.php');
$title= "";
$genres= "";
session_start();
echo $_SESSION['movieTitle'];
  if (isset($_SESSION['movieTitle'])) {
      $title= $_SESSION['movieTitle'];
      $genres= $_SESSION['moiveGenres'];
      unset($_SESSION['movieTitle']);
      unset($_SESSION['genres']);
  }
  getHeader($title, true);
  getSuccessMessage("GOT HERE");
  var_dump($genres);
  getFooter();
?>
