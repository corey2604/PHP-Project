<?php

// include function files for this application
require_once(__DIR__.'/../whatShouldIWatchFunctions.php');
session_start();
  $old_user = $_SESSION['userId'];

  // store  to test if they *were* logged in
  unset($_SESSION['userId']);
  $result_dest = session_destroy();

if (!empty($old_user)) {
  if ($result_dest)  {
    getHeader("Logged Out", true);?>
      <p>You have successfully been logged out of your account. You will need to log in again in order to access the site.</p>
      <a onclick="window.location.href = 'login.php';" class="btn btn-secondary text-white btn-block">Log In</a>
    <?php
    getFooter();
    // if they were logged in and are now logged out
  } else {
    getHeader("Log Out Unsuccessful");?>
   // they were logged in and could not be logged out
    <p>Could not log you out</p>
<?php
  }
} else {
  getHeader("You were not logged in", true);?>
  <p>You were not logged in and therefore could not be logged out.</p>
  <a onclick="window.location.href = 'login.php';" class="btn btn-secondary text-white btn-block">Log In</a>
<?php }
getFooter();


?>
