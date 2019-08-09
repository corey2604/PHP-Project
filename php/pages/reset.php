<?php
require_once (__DIR__ . '/../whatShouldIWatchFunctions.php');
getHeader("Reset Status", false);

//Store post values
$username = getPostValueIfPresent('username');
$originalPassword = getPostValueIfPresent('original_password');
$newPassword = getPostValueIfPresent('new_password');
$confirmNewPassword = getPostValueIfPresent('new_password_confirm');
try
{
    // Throw an exception if all form values aren't filled out
    if (!isFilledOut($_POST))
    {
        throw new Exception('Your password could not be reset as the reset form was not filled out out correctly - please <a href="resetPassword.php">go back</a> and try again.');
    }

    // Throw an exception if the username/email doesn't match a valid format
    if (!validEmail($username))
    {
        throw new Exception('An invalid email address was entered.  Please <a href="resetPassword.php">go back</a> and try again.');
    }

    // Throw an exception if passwords don't match
    if ($newPassword != $confirmNewPassword)
    {
        throw new Exception('The passwords you entered do not match. Please <a href="resetPassword.php">go back</a> and try again.');
    }

    // Ensure password meets length validation standards, otherwise throw an exception
    if ((strlen($newPassword) < 6) || (strlen($newPassword) > 16))
    {
        throw new Exception('Your password must be between 6 and 16 characters. Please go back and try again.');
    }

    //If no exceptions have been thrown so far then attempt to update the user's password in the database
    try
    {
        updateUserPassword($_SESSION["userId"], $originalPassword, $newPassword);
    }
    catch(Exception $e)
    {
      //Output an error message if this fails
        getErrorMessage($e);
    }

}
catch(Exception $e)
{
  //Catch any of the exceptions thrown from above and output them as an error message
    return getErrorMessage($e->getMessage());
    exit;
}
getFooter();
?>
