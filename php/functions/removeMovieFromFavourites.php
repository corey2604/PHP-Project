<?php
require_once(__DIR__.'/../whatShouldIWatchFunctions.php');
if (isset($_POST['id'])) {
$id = $_POST['id'];
try{
   deleteMovieFromFavourites($id);
 } catch (Exception $e) {
   echo "Failed $e";
   exit;
 }
 } else {
   echo "DIDN'T REACH HERE";
}
?>
