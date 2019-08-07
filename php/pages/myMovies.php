<?php
  require_once(__DIR__.'/../whatShouldIWatchFunctions.php');
  getHeader("My Movies");
  echo displayMyMovies($_SESSION['valid_user']);
  echo displayMyGenres($_SESSION['valid_user']);
  getFooter();
 ?>
