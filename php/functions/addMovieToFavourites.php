<?php
session_start();
require_once(__DIR__.'/../whatShouldIWatchFunctions.php');
echo "GOT HERE";
if (isset($_POST['title'])) {
$title = $_POST['title'];
$overview = $_POST['overview'];
$posterPath = $_POST['posterPath'];
$genres= $_POST['genres'];
try{
   storeMovieAsFavourite($_SESSION['valid_user'], $title, $overview, $posterPath, $genres);
 } catch (Exception $e) {
   echo "Failed $e";
   exit;
 }
 } else {
   echo "DIDN'T REACH HERE";
}
?>
