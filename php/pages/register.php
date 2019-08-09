<?php
session_start();
require_once(__DIR__.'/../whatShouldIWatchFunctions.php');
$usernameErr = $passwordErr = $passwordConfirmErr = $registerErr = "";

$username = testInput(getPostValueIfPresent("email"));
$password = testInput(getPostValueIfPresent("password"));
$passwordConfirm = testInput(getPostValueIfPresent("confirm_password"));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($username)) {
    $usernameErr = "Username is required";
  } else if (!valid_email($username)) {
    $usernameErr = "Email address entered is not valid. Please enter a valid format.";
  }

  if (empty($password)) {
    $passwordErr = "Password is required";
  } else if ((strlen($password) < 6) || (strlen($password) > 16)) {
    $passwordErr = "Your password must be between 6 and 16 characters.";
  }

  if (empty($passwordConfirm)) {
    $passwordConfirmErr = "Confirming your password is required";
  } else if ($password != $passwordConfirm) {
      $passwordConfirmErr = "Passwords do not match";
  }

  if (empty($usernameErr) && empty($passwordErr) && empty($passwordConfirmErr)){
    $registerErr = registerUser($username, $password);
    if (empty($registerErr)) {
      // register session variable
      $_SESSION['userId'] = getUserId($username, $password);

      header("Location: index.php");
    }
  }
}

require_once(__DIR__.'/../whatShouldIWatchFunctions.php');
getHeader("Register", false);
getRegistrationForm($usernameErr, $passwordErr, $passwordConfirmErr, $registerErr);
getFooter();
?>
