<?php

// include function files for this application
require_once(__DIR__.'/../whatShouldIWatchFunctions.php');
session_start();

//create short variable names
if (!isset($_POST['email']))  {
  //if not isset -> set with dummy value
  $_POST['email'] = " ";
}
$username = $_POST['email'];
if (!isset($_POST['password']))  {
  //if not isset -> set with dummy value
  $_POST['password'] = " ";
}
$password = $_POST['password'];

if ($username && $password) {
// they have just tried logging in
  try  {
    echo"id:";
    login($username, $password);
    // if they are in the database register the user id
    $_SESSION['valid_user'] = getUserId($username, $password);
    echo '<a href="index.php">HOME</a>';
  }
  catch(Exception $e)  {
    // unsuccessful login
    echo 'You could not be logged in.<br>
          You must be logged in to view this page.';
    exit;
  }
}
?>
