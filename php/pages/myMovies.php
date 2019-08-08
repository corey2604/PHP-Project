<?php
  require_once(__DIR__.'/../whatShouldIWatchFunctions.php');
  getHeader("My Movies", true);
  echo displayMyMovies($_SESSION['valid_user']);
  getFooter();
 ?>
