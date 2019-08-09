<?php
  require_once(__DIR__.'/../whatShouldIWatchFunctions.php');
  session_start();

  //Initialise error messages to empty strings
  $usernameErr = $passwordErr = $loginErr = "";
  $username = testInput(getPostValueIfPresent("email"));
  $password = testInput(getPostValueIfPresent("password"));

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($username)) {
      $usernameErr = "Username is required";
    }

    if (empty($password)) {
      $passwordErr = "Password is required";
    }

    if ((empty($usernameErr) && empty($passwordErr))) {
    // they have just tried logging in
        if (login($username, $password)) {
          // if they are in the database register the user id
          $_SESSION['userId'] = getUserId($username, $password);
          // Transfer the user to the index page on a successful login
          header("Location: index.php");
        } else {
          $loginErr = 'You could not be logged in. Please check that your username and password combination are correct.';
        }
      }
    }
  getHeader("Log In", false);
  getLogInForm($usernameErr, $passwordErr, $loginErr);
  getFooter();
?>
