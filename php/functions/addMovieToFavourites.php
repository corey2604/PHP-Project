<?php
//This class retrieves the variables sent via ajax and stores the specified movie as a favourite via a db function
require_once(__DIR__ . '/dbFunctions.php');
//Start the session in order to access the user's id
session_start();
//Get the values sent via ajax
$title = $_GET['title'];
$overview = $_GET['overview'];
$posterPath = $_GET['posterPath'];
$genres = $_GET['genres'];
storeMovieAsFavourite($_SESSION['userId'], $title, $overview, $posterPath, $genres);
?>
