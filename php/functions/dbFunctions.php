<?php
require_once(__DIR__.'/../whatShouldIWatchFunctions.php');
function connectToDatabase() {
  $host = 'localhost';
  $username = 'B00652935';
  $password = 'NuQ3Kngv';
  $database = 'b00652935';
  $db = new mysqli($host, $username, $password, $database);
  if (mysqli_connect_errno())
  {
    getErrorMessage("Could not connect to database");
  } else {
    return $db;
  }
}


function registerUser($email, $password){
  // connect to db
 $conn = connectToDatabase();

 $hashedPassword = sha1($password);
 $query = 'SELECT * FROM projectusers WHERE username = ?';
 $stmt = $conn->prepare($query);
 $stmt->bind_param('s', $email);
 $stmt->execute();
 $stmt->store_result();
 if ($stmt->error) {
   return "Could not register you in database - please try again later.";
 } else if ($stmt->num_rows>0) {
   return "Username is already taken.";
 }
 $stmt->free_result();

 $query = 'INSERT INTO projectusers(username, password, reg_date) VALUES (?, ?, now())';
 $stmt = $conn->prepare($query);
 $stmt->bind_param('ss', $email, $hashedPassword);
 $stmt->execute();
 $stmt->store_result();
 if ($stmt->error) {
   return "Could not register you in database - please try again later.";
 }
 $stmt->free_result();

 return "";
}


function login($username, $password) {
// check username and password with db
// if yes, return true
// else throw exception

  // connect to db
  $conn = connectToDatabase();
  $hashedPassword = sha1($password);
  $query = 'SELECT * FROM projectusers WHERE username = ? AND password = ?';
  $stmt = $conn->prepare($query);
  $stmt->bind_param('ss', $username, $hashedPassword);
  $stmt->execute();
  $stmt->store_result();
  if ($stmt->num_rows>0) {
     return true;
  } else {
     return false;
  }
}


function storeMovieAsFavourite($userId, $title, $overview, $posterPath, $genres) {
// check username and password with db
// if yes, return true
// else throw exception

  // connect to db
  $conn = connectToDatabase();

    if(checkFavouriteMovieIsNew($conn, $title, $overview, $posterPath)){

    $query = 'INSERT INTO projectmovies (title, overview, poster_path) VALUES (?, ?, ?)';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sss', $title, $overview, $posterPath);
    $stmt->execute();

    $stmt->free_result();

    $query = 'INSERT INTO projectusermovies (user_id, movie_id) VALUES (?, ?)';
    $stmt = $conn->prepare($query);
    $movie_id = getMovieId($title, $overview, $posterPath);
    $stmt->bind_param('ss', $userId, $movie_id);
    $stmt->execute();
    $stmt->free_result();

    foreach(json_decode($genres, true) as $genre):
      $genre_id = $genre["id"];
      $name = $genre["name"];
      $query = 'INSERT INTO projectgenres (id, name) VALUES (?, ?)';
      $stmt = $conn->prepare($query);
      $stmt->bind_param('ds', $genre_id, $name);
      $stmt->execute();
      $stmt->free_result();
      $query = 'INSERT INTO projectmoviegenres (movie_id, genre_id) VALUES (?, ?)';
      $stmt = $conn->prepare($query);
      $stmt->bind_param('dd', $movie_id, $genre_id);
      $stmt->execute();
      $stmt->free_result();
    endforeach;
    getSuccessMessage("$title was added as a favourite!");
  } else {
    getErrorMessage("$title is already listed as a favourite!");
  }
}

function checkFavouriteMovieIsNew($conn, $title, $overview, $posterPath) {
  $query = 'SELECT `projectusermovies`.movie_id FROM `projectusermovies` INNER JOIN `projectmovies` ON `projectusermovies`.movie_id = `projectmovies`.id WHERE title = ? AND overview = ? AND poster_path = ?';
  $stmt = $conn->prepare($query);
  $stmt->bind_param('sss', $title, $overview, $posterPath);
  $stmt->execute();
  $stmt->store_result();
  return (!$stmt->num_rows > 0);
}

function displayMyMovies($userId) {
  global $movies;
    $stmt = getAllMoviesFromDatabaseForUser($userId);
    if ($stmt->num_rows > 0) {
      $stmt->bind_result($id, $title, $overview, $posterPath);
      $count = 0;?>
      <?php while($stmt->fetch()) {
        if ($count == 0) {
          ?><div class="row mt-3">
        <?php }
        $count++;
        $movies .= getDeleteCard($id, $title, $overview, $posterPath);
       if ($count == 4) {?>
          </div>
          <?php $count = 0;
      }
    }
  } else {
    getMissingFavouritesDisplay("favourites");
  }
    $stmt->free_result();
    return $movies;
}

function getAllMoviesFromDatabaseForUser($userId) {
  $conn = connectToDatabase();
  $query = 'SELECT `projectmovies`.id, `projectmovies`.title, `projectmovies`.overview, `projectmovies`.poster_path FROM `projectmovies` INNER JOIN projectusermovies ON `projectmovies`.id = `projectusermovies`.movie_id WHERE `projectusermovies`.user_id = ?';
  $stmt = $conn->prepare($query);
  $stmt->bind_param('d', $userId);
  $stmt->execute();
  $stmt->store_result();
  return $stmt;
}

function getAllGenresFromDatabaseForUser($userId) {
    $conn = connectToDatabase();
    $query = 'SELECT `projectmoviegenres`.genre_id FROM `projectmoviegenres` INNER JOIN projectusermovies ON `projectmoviegenres`.movie_id = `projectusermovies`.movie_id WHERE `projectusermovies`.user_id = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('d', $userId);
    $stmt->execute();
    $stmt->store_result();
    return $stmt;
}

function getMostPopularGenreIdFromDatabaseForUser($userId) {
    $conn = connectToDatabase();
    $query = 'SELECT `projectmoviegenres`.genre_id FROM `projectmoviegenres` INNER JOIN projectusermovies ON `projectmoviegenres`.movie_id = `projectusermovies`.movie_id WHERE `projectusermovies`.user_id = ? GROUP BY `projectmoviegenres`.genre_id ORDER BY count(*) desc LIMIT 1;';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('d', $userId);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id);
    $stmt->fetch();
    $stmt->close();
    return $id;
}

function deleteMovieFromFavourites($id) {
// check username and password with db
// if yes, return true
// else throw exception

  // connect to db
  $conn = connectToDatabase();

  $query = 'DELETE FROM projectusermovies WHERE movie_id = ?';
  $stmt = $conn->prepare($query);
  $stmt->bind_param('d', $id);
  $stmt->execute();

  if ($stmt->error) {
    getErrorMessage("Movie was unable to be removed from favourites");
  } else {
    getSuccessMessage("Movie was successfully removed from favourites");
  }
  $stmt->free_result();
}

function getUserId($username, $password) {
// check username and password with db
// if yes, return true
// else throw exception

  // connect to db
  $hashedPassword = sha1($password);
  $conn = connectToDatabase();
  $query = 'SELECT id FROM `projectusers` WHERE username = ? AND password = ?';
  $stmt = $conn->prepare($query);
  $stmt->bind_param('ss', $username, $hashedPassword);
  $stmt->execute();
  $stmt->store_result();
  $stmt->bind_result($id);
  $stmt->fetch();
  $stmt->close();
  return $id;
}

function getUsernameFromId($userId) {
// check username and password with db
// if yes, return true
// else throw exception

  // connect to db
  $conn = connectToDatabase();
  $query = 'SELECT username FROM `projectusers` WHERE id = ?';
  $stmt = $conn->prepare($query);
  $stmt->bind_param('d', $userId);
  $stmt->execute();
  $stmt->store_result();
  $stmt->bind_result($username);
  $stmt->fetch();
  $stmt->close();
  return $username;
}

function updateUserPassword($userId, $originalPassword, $newPassword) {
// check username and password with db
// if yes, return true
// else throw exception

  // connect to db
  $conn = connectToDatabase();
  $originalHashedPassword = sha1($originalPassword);
  $newHashedPassword = sha1($newPassword);
  $query = 'UPDATE projectusers SET password = ? WHERE id = ? AND password = ?;';
  $stmt = $conn->prepare($query);
  $stmt->bind_param('sds', $newHashedPassword, $userId, $originalHashedPassword);
  $stmt->execute();
  if ($stmt->error) {
    getErrorMessage("Unable to update your password. Please <a href=\"resetPassword.php\">try again</a>");
  } else {
    getSuccessMessage("Your Password has been successfully updated.");
  }
  $stmt->free_result();
}

function getMovieId($title, $overview, $posterPath) {
// check username and password with db
// if yes, return true
// else throw exception

  // connect to db
  $conn = connectToDatabase();
  $query = 'SELECT id FROM `projectmovies` WHERE title = ? AND overview = ? AND poster_path = ?';
  $stmt = $conn->prepare($query);
  $stmt->bind_param('sss', $title, $overview, $posterPath);
  $stmt->execute();
  $stmt->store_result();
  $stmt->bind_result($id);
  $stmt->fetch();
  $stmt->close();
  return $id;
}

function doesUserHaveRecommendations($userId) {
  $stmt = getAllMoviesFromDatabaseForUser($userId);
  //Return true if the user does have recommendations, otherwise return false
  return ($stmt->num_rows > 0);
}

function getGenreIdsForMovie($movieId) {
  $conn = connectToDatabase();
  $query = 'SELECT genre_id FROM `projectmoviegenres` WHERE movie_id = ?';
  $stmt = $conn->prepare($query);
  $stmt->bind_param('d', $movieId);
  $stmt->execute();
  $stmt->store_result();
  $stmt->bind_result($genreId);
  $stmt->fetch();
  $stmt->close();
  return $name;
}

function getGenreNameFromId($genreId) {
  $conn = connectToDatabase();
  $query = 'SELECT name FROM `projectgenres` WHERE id = ?';
  $stmt = $conn->prepare($query);
  $stmt->bind_param('d', $genreId);
  $stmt->execute();
  $stmt->store_result();
  $stmt->bind_result($name);
  $stmt->fetch();
  $stmt->close();
  return $name;
}
?>
