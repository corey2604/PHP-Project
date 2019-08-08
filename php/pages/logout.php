<?php

// include function files for this application
require_once(__DIR__.'/../whatShouldIWatchFunctions.php');
session_start();
$old_user = $_SESSION['valid_user'];

// store  to test if they *were* logged in
unset($_SESSION['valid_user']);
$result_dest = session_destroy();
getHeader("Log Out", false);

if (!empty($old_user)) {
  if ($result_dest)  {?>
    <div class="sidenav">
             <div class="login-main-text">
                <h2>Logged Out<br></h2>
                <p>You have successfully been logged out of your account. You will need to log in again in order to access the site.</p>
             </div>
          </div>
          <div class="main">
            <div class="login-form">
             <div class="col-md-6 col-sm-6">
                   <a onclick="window.location.href = 'login.php';" class="btn btn-secondary text-white btn-block">Log In</a>
              </div>
            </div>
          </div>
          <?php
    // if they were logged in and are now logged out
  } else {
   // they were logged in and could not be logged out
    echo 'Could not log you out.<br>';
  }
} else {
  // if they weren't logged in but came to this page somehow
  echo 'You were not logged in, and so have not been logged out.<br>';
}
getFooter();


?>
