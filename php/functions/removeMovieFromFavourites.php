<?php
require_once (__DIR__ . '/../whatShouldIWatchFunctions.php');
//This class retrieves the variable sent via ajax and removed the specified movie as a favourite via a db function
$id = $_GET['id'];
try
{
    deleteMovieFromFavourites($id);
}
//Output an error message if the deletion fails
catch(Exception $e)
{
    getErrorMessage($e->getMessage());
}
?>
