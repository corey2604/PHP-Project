<?php
  // include function files for this application
  require_once(__DIR__.'/../whatShouldIWatchFunctions.php');

  //create short variable names
  $email=$_POST['email'];
  $password=$_POST['password'];
  $confirmPassword=$_POST['confirm_password'];
  // start session which may be needed later
  // start it now because it must go before headers
  session_start();
  try   {
    // check forms filled in

    if (!filled_out($_POST)) {
      throw new Exception('You have not filled the form out correctly - please go back and try again.');
    }

    // email address not valid
    if (!valid_email($email)) {
      throw new Exception('That is not a valid email address.  Please go back and try again.');
    }

    // passwords not the same
    if ($password != $confirmPassword) {
      throw new Exception('The passwords you entered do not match - please go back and try again.');
    }

    // check password length is ok
    // ok if username truncates, but passwords will get
    // munged if they are too long.
    if ((strlen($password) < 6) || (strlen($password) > 16)) {
      throw new Exception('Your password must be between 6 and 16 characters. Please go back and try again.');
    }

    // attempt to register
    // this function can also throw an exception
    try{
      register_user($email, $password);
    } catch (Exception $e) {
      echo "$e";
    }
    // register session variable
    $_SESSION['valid_user'] = $email;

    // provide link to members page
    echo 'Registration successful';
    echo 'Your registration was successful.  Go to the members page to start setting up your bookmarks!';
    echo 'Go to members page';

  }
  catch (Exception $e) {
     echo 'Problem:';
     echo $e->getMessage();
     exit;
  }
