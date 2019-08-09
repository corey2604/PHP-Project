<?php
require_once (__DIR__ . '/../whatShouldIWatchFunctions.php');
session_start();
//Store the past user's userId in order to ensure they were initially logged in and didn't naviagte to this page by mistake
$old_user = $_SESSION['userId'];

//Unset the userId session variable
unset($_SESSION['userId']);
//Destroy the session
$result_dest = session_destroy();

//If the user did initially have a userId...
if (!empty($old_user))
{
    //...and the session has been successfully destroyed
    if ($result_dest)
    {
        //Output a message to the user informing them of a successful log out
        getHeader("Logged Out", true); ?>
      <p>You have successfully been logged out of your account. You will need to log in again in order to access the site.</p>
      <a onclick="window.location.href = 'login.php';" class="btn btn-secondary text-white btn-block">Log In</a>
    <?php
        getFooter();
    }
    else
    {
        //Otherwise they were unable to be logged out - output a message informing the user of this
        getHeader("Log Out Unsuccessful"); ?>
    <p>Could not log you out</p>
<?php
    }
}
else
{
    //If the user did not have an initial userId then they were never originally logged in - output a message informing the user of this
    getHeader("You were not logged in", true); ?>
  <p>You were not logged in and therefore could not be logged out.</p>
  <a onclick="window.location.href = 'login.php';" class="btn btn-secondary text-white btn-block">Log In</a>
<?php
}
getFooter();
