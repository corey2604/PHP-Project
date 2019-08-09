<?php
  // include function files for this application
  require_once(__DIR__.'/../whatShouldIWatchFunctions.php');
  getHeader("Reset Status", false);

  //create short variable names
  $username=getPostValueIfPresent('username');
  $originalPassword=getPostValueIfPresent('original_password');
  $newPassword=getPostValueIfPresent('new_password');
  $confirmNewPassword=getPostValueIfPresent('new_password_confirm');
  // start session which may be needed later
  // start it now because it must go before headers
  try   {
    // check forms filled in

    if (!filled_out($_POST)) {
      throw new Exception('Your password could not be reset as the reset form was not filled out out correctly - please <a href="resetPassword.php">go back</a> and try again.');
    }

    // email address not valid
    if (!valid_email($username)) {
      throw new Exception('An invalid email address was entered.  Please <a href="resetPassword.php">go back</a> and try again.');
    }

    // passwords not the same
    if ($newPassword != $confirmNewPassword) {
      throw new Exception('The passwords you entered do not match. Please <a href="resetPassword.php">go back</a> and try again.');
    }

    // check password length is ok
    // ok if username truncates, but passwords will get
    // munged if they are too long.
    if ((strlen($newPassword) < 6) || (strlen($newPassword) > 16)) {
      throw new Exception('Your password must be between 6 and 16 characters. Please go back and try again.');
    }

    // attempt to register
    // this function can also throw an exception
    try{
      updateUserPassword($_SESSION["userId"], $originalPassword, $newPassword);
    } catch (Exception $e) {
      getErrorMessage($e);
    }
    // register session variable

  }
  catch (Exception $e) {
     return getErrorMessage($e -> getMessage());
     exit;
  }
  getFooter();
  ?>
