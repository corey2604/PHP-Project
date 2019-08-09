<?php
function checkValidUser()
{
    //If the session hasn't already been started then start one
    if (session_status() == PHP_SESSION_NONE)
    {
        session_start();
    }
    // If a user is currently logged in then get their username and return it to be output in the navbar
    if (isset($_SESSION['userId']))
    {
        return getUsernameFromId($_SESSION['userId']);
    }
    // If they are not logged in then automatically re-direct the user to the login screen
    else
    {
        header("Location: login.php");
    }
}

function getPostValueIfPresent($value)
{
    //If a value is present in $_POST superglobal then return it, otherwise return an empty String
    return isset($_POST[$value]) ? $_POST[$value] : '';
}

function getKeyWordIfPresent()
{
    return getPostValueIfPresent("keyword");
}

function testInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function isFilledOut($formVars)
{
    //For each key-value pair in a form ensure it has a value and return false if a signle value is missing
    foreach ($formVars as $key => $value)
    {
        if ((!isset($key)) || ($value == ''))
        {
            return false;
        }
    }
    return true;
}

function validEmail($email)
{
    // return true if the email supplied matches this pattern
    return (preg_match('/^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/', $email));
}
?>
