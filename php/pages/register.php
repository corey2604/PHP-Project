<?php
session_start();
require_once (__DIR__ . '/../whatShouldIWatchFunctions.php');
//Initialise errors to empty strings
$usernameErr = $passwordErr = $passwordConfirmErr = $registerErr = "";

$username = testInput(getPostValueIfPresent("email"));
$password = testInput(getPostValueIfPresent("password"));
$passwordConfirm = testInput(getPostValueIfPresent("confirm_password"));

//If the user has submited a login request...
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  //Set associated error messages based on validation methods
    if (empty($username))
    {
        $usernameErr = "Username is required";
    }
    else if (!validEmail($username))
    {
        $usernameErr = "Email address entered is not valid. Please enter a valid format.";
    }

    if (empty($password))
    {
        $passwordErr = "Password is required";
    }
    else if ((strlen($password) < 6) || (strlen($password) > 16))
    {
        $passwordErr = "Your password must be between 6 and 16 characters.";
    }

    if (empty($passwordConfirm))
    {
        $passwordConfirmErr = "Confirming your password is required";
    }
    else if ($password != $passwordConfirm)
    {
        $passwordConfirmErr = "Passwords do not match";
    }

    //If no errors are present then attempt to register the user
    if (empty($usernameErr) && empty($passwordErr) && empty($passwordConfirmErr))
    {
      //RegisterUser will return an error message if the registration fails
        $registerErr = registerUser($username, $password);
        //If no error is returned then...
        if (empty($registerErr))
        {
          //Set the user id as session var and transfer the user to the index page
            $_SESSION['userId'] = getUserId($username, $password);
            header("Location: index.php");
        }
    }
}

require_once (__DIR__ . '/../whatShouldIWatchFunctions.php');
getHeader("Register", false);
getRegistrationForm($usernameErr, $passwordErr, $passwordConfirmErr, $registerErr);
getFooter();
?>
