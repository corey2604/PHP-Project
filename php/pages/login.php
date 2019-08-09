<?php
require_once (__DIR__ . '/../whatShouldIWatchFunctions.php');
session_start();

//Initialise error messages to empty strings
$usernameErr = $passwordErr = $loginErr = "";
$username = testInput(getPostValueIfPresent("email"));
$password = testInput(getPostValueIfPresent("password"));

//If the user has submited a login request...
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  //Set error messages if the username or password fields are empty
    if (empty($username))
    {
        $usernameErr = "Username is required";
    }

    if (empty($password))
    {
        $passwordErr = "Password is required";
    }

    //If no errors are present then attempt to log in
    if ((empty($usernameErr) && empty($passwordErr)))
    {
        if (login($username, $password))
        {
            //If log in is successful and the user is found in the database then set the user id as session var
            $_SESSION['userId'] = getUserId($username, $password);
            //Transfer the user to the index page on a successful login
            header("Location: index.php");
        }
        //If login fails then set a login error message which will be output
        else
        {
            $loginErr = 'You could not be logged in. Please check that your username and password combination are correct.';
        }
    }
}
getHeader("Log In", false);
getLogInForm($usernameErr, $passwordErr, $loginErr);
getFooter();
?>
