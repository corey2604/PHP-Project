<?php
//This class contains all of the functions used by the application to interact with my databse
require_once (__DIR__ . '/../whatShouldIWatchFunctions.php');

function connectToDatabase()
{
    //Initialise parameters needed to connect to database - also specified which databse to use
    $host = 'localhost';
    $username = 'B00652935';
    $password = 'NuQ3Kngv';
    $database = 'b00652935';
    //Make the connection to the database
    $conn = new mysqli($host, $username, $password, $database);
    //Output an error message if the connection is unsuccessful
    if (mysqli_connect_errno())
    {
        getErrorMessage("Could not connect to database");
    }
    //Otherwise return the connection
    else
    {
        return $conn;
    }
}

function registerUser($username, $password)
{
    //Connect to database
    $conn = connectToDatabase();

    //Hash the password entered by the user using the SHA-1 hash
    $hashedPassword = sha1($password);

    //Establish the query to determine if the username is already taken in the database
    $query = 'SELECT * FROM projectusers WHERE username = ?';
    $stmt = $conn->prepare($query);
    //Bind the associated parameter to prepared statement
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();
    //If the user could not be stored in the database then return a message informing them. This will be output as an error message.
    if ($stmt->error)
    {
        return "Could not register you in database - please try again later.";
    }
    //If the number of rows for this query is greater than 0 then this username already exists in the database and is therefore not unique
    //A message will be returned explaining this. It will be output as an error message.
    else if ($stmt->num_rows > 0)
    {
        return "Username is already taken.";
    }
    $stmt->free_result();

    //If the username isn't already taken then insert the user's details into the database
    $query = 'INSERT INTO projectusers(username, password, reg_date) VALUES (?, ?, now())';
    $stmt = $conn->prepare($query);
    //Bind the associated parameters to prepared statement
    $stmt->bind_param('ss', $username, $hashedPassword);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->error)
    {
        return "Could not register you in database - please try again later.";
    }
    $stmt->free_result();

    //If the user's details are successfully stored then return an empty string
    //This means no error message will be output and the user will be directed to index.php
    return "";
}

function login($username, $password)
{
    $conn = connectToDatabase();

    //Hash the password entered by the user using the SHA-1 hash
    $hashedPassword = sha1($password);

    //Establish the query to return any users with the username and password entered by the user
    $query = 'SELECT * FROM projectusers WHERE username = ? AND password = ?';
    $stmt = $conn->prepare($query);
    //Bind the associated parameters to prepared statement
    $stmt->bind_param('ss', $username, $hashedPassword);
    $stmt->execute();
    $stmt->store_result();
    //Return true if the username and password match with an existing record in the $database
    //This will allow the session variable to be set and the user will be taken to index.php
    return ($stmt->num_rows > 0);
}

function storeMovieAsFavourite($userId, $title, $overview, $posterPath, $genres)
{
    $conn = connectToDatabase();

    //Check that the movie is not already stored as a favourite for this user
    if (checkFavouriteMovieIsNew($conn, $userId, $title, $overview, $posterPath))
    {
        //Establish the query to insert this movie into the movies reference table if it does not already exist
        //Projectmovies acts as a reference table and isn't linked to any single user
        if (movieDoesNotExistInProjectMovies($title, $overview, $posterPath))
        {
            $query = 'INSERT INTO projectmovies (title, overview, poster_path) VALUES (?, ?, ?)';
            $stmt = $conn->prepare($query);
            //Bind the associated parameters to prepared statement
            $stmt->bind_param('sss', $title, $overview, $posterPath);
            $stmt->execute();

            $stmt->free_result();
        }

        //Add the new movie to the link table for this user
        $query = 'INSERT INTO projectusermovies (user_id, movie_id) VALUES (?, ?)';
        $stmt = $conn->prepare($query);
        $movieId = getMovieId($title, $overview, $posterPath);
        //Bind the associated parameters to prepared statement
        $stmt->bind_param('ss', $userId, $movieId);
        $stmt->execute();
        $stmt->free_result();

        //Add any genres associated with this movie into the genres reference table if they don't already exist
        //Due to the structure of the table itself duplicate entried will not be added
        foreach (json_decode($genres, true) as $genre):
            $genreId = $genre["id"];
            $name = $genre["name"];
            $query = 'INSERT INTO projectgenres (id, name) VALUES (?, ?)';
            $stmt = $conn->prepare($query);
            //Bind the associated parameters to prepared statement
            $stmt->bind_param('ds', $genreId, $name);
            $stmt->execute();
            $stmt->free_result();
            //Establish the query to insert this movie and genre into the projectmoviegenres link table if it does not already exist
            if (movieGenreLinkIsNew($movieId, $genreId))
            {
                $query = 'INSERT INTO projectmoviegenres (movie_id, genre_id) VALUES (?, ?)';
                $stmt = $conn->prepare($query);
                //Bind the associated parameters to prepared statement
                $stmt->bind_param('dd', $movieId, $genreId);
                $stmt->execute();
                $stmt->free_result();
            }
        endforeach;
        getSuccessMessage("$title was added as a favourite!");
    }
    else
    {
        getErrorMessage("$title is already listed as a favourite!");
    }
}

function checkFavouriteMovieIsNew($conn, $userId, $title, $overview, $posterPath)
{
    //Establish the query to determine if the movie already exists in the user's favourites/my movies
    //This first retrieves the id of any movie with the associated title, overview and posterPath
    $movieId = getMovieId($title, $overview, $posterPath);
    //Find any movie in the projectusermovies link table where the movie id for the movie selected is associated with the current user's userId
    $query = 'SELECT * FROM projectusermovies WHERE user_id = ? AND movie_id = ?';
    $stmt = $conn->prepare($query);
    //Bind the associated parameters to prepared statement
    $stmt->bind_param('ii', $userId, $movieId);
    $stmt->execute();
    $stmt->store_result();
    //Return true if the movie is not already stored as a favourite for that user - allowing the movie to be stored
    return (!$stmt->num_rows > 0);
}

function displayMyMovies($userId)
{
    //Return all movies that the current user has stored/selected as a favourite
    $stmt = getAllMoviesFromDatabaseForUser($userId);
    //If the user has movies stored as favourites then format the stored data to be output
    if ($stmt->num_rows > 0)
    {
        $stmt->bind_result($id, $title, $overview, $posterPath);
        $count = 0; ?>
      <?php while ($stmt->fetch())
        {
            if ($count == 0)
            {
                //Add the row heading if count is at 0 i.e. the beginning of the row

?><div class="row mt-3">
        <?php
            }
            $count++;
            $movies .= getDeleteCard($id, $title, $overview, $posterPath);
            //If count reaches 4 then close the row div and reset count to 0
            //This ensures that movies are output in rows of 4
            if ($count == 4)
            { ?>
          </div>
          <?php
                $count = 0;
            }
        }
    }
    //If the user hasn't stored any movies then output an appropriate screen
    else
    {
        getMissingFavouritesDisplay("favourites");
    }
    $stmt->free_result();
    return $movies;
}

function getAllMoviesFromDatabaseForUser($userId)
{
    $conn = connectToDatabase();
    //Establish query to return all movie details for movies stored as favourites by the current user
    //It first selects all movieIds assocaited with the current user from the projectusermovies link table
    //It then joins these ids to return all details assocaited with the movie ids from the project movies reference table
    $query = 'SELECT `projectmovies`.id, `projectmovies`.title, `projectmovies`.overview, `projectmovies`.poster_path FROM `projectmovies` INNER JOIN projectusermovies ON `projectmovies`.id = `projectusermovies`.movie_id WHERE `projectusermovies`.user_id = ?';
    $stmt = $conn->prepare($query);
    //Bind the associated parameter to prepared statement
    $stmt->bind_param('d', $userId);
    $stmt->execute();
    $stmt->store_result();
    return $stmt;
}

function getAllGenresFromDatabaseForUser($userId)
{
    $conn = connectToDatabase();
    //Establish query to return all genres linked to movies stored as favourites by the current user
    //It first selects all movieIds assocaited with the current user from the projectusermovies link table
    //It then joins these ids to return all genreIds assocaited with the movie ids from the projectmoviegenres link table
    $query = 'SELECT `projectmoviegenres`.genre_id FROM `projectmoviegenres` INNER JOIN projectusermovies ON `projectmoviegenres`.movie_id = `projectusermovies`.movie_id WHERE `projectusermovies`.user_id = ?';
    $stmt = $conn->prepare($query);
    //Bind the associated parameters to prepared statement
    $stmt->bind_param('d', $userId);
    $stmt->execute();
    $stmt->store_result();
    return $stmt;
}

function getMostPopularGenreIdFromDatabaseForUser($userId)
{
    $conn = connectToDatabase();
    //Establish query to return the id for the most popular genre linked to movies stored as favourites by the current user
    //It first selects all movieIds assocaited with the current user from the projectusermovies link table
    //It then joins these ids to return all genreIds assocaited with the movie ids from the projectmoviegenres link table
    //It then orders these ids by their number of occurrences and returns the top result
    $query = 'SELECT `projectmoviegenres`.genre_id FROM `projectmoviegenres` INNER JOIN projectusermovies ON `projectmoviegenres`.movie_id = `projectusermovies`.movie_id WHERE `projectusermovies`.user_id = ? GROUP BY `projectmoviegenres`.genre_id ORDER BY count(*) desc LIMIT 1;';
    $stmt = $conn->prepare($query);
    //Bind the associated parameter to prepared statement
    $stmt->bind_param('d', $userId);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id);
    $stmt->fetch();
    $stmt->close();
    return $id;
}

function deleteMovieFromFavourites($id)
{
    $conn = connectToDatabase();

    //Delete a movie from the projectusermovies link table where it matches the movieId supplied
    $query = 'DELETE FROM projectusermovies WHERE movie_id = ?';
    $stmt = $conn->prepare($query);
    //Bind the associated parameter to prepared statement
    $stmt->bind_param('d', $id);
    $stmt->execute();

    if ($stmt->error)
    {
        getErrorMessage("Movie was unable to be removed from favourites");
    }
    else
    {
        getSuccessMessage("Movie was successfully removed from favourites");
    }
    $stmt->free_result();
}

function getUserId($username, $password)
{
    $hashedPassword = sha1($password);
    $conn = connectToDatabase();
    //Get all ids from the projectusers reference table where the username and hashed password match
    $query = 'SELECT id FROM `projectusers` WHERE username = ? AND password = ?';
    $stmt = $conn->prepare($query);
    //Bind the associated parameters to the prepared statement
    $stmt->bind_param('ss', $username, $hashedPassword);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id);
    $stmt->fetch();
    $stmt->close();
    return $id;
}

function getUsernameFromId($userId)
{
    $conn = connectToDatabase();
    //Get the username associated with the id supplied to this method
    $query = 'SELECT username FROM `projectusers` WHERE id = ?';
    $stmt = $conn->prepare($query);
    //Bind the associated parameter to the prepared statement
    $stmt->bind_param('d', $userId);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($username);
    $stmt->fetch();
    $stmt->close();
    return $username;
}

function updateUserPassword($userId, $originalPassword, $newPassword)
{
    //Validation on password matching and password strength is carried out on the page itself and a check isn't needed here
    $conn = connectToDatabase();
    //Hash the original and new passwords
    $originalHashedPassword = sha1($originalPassword);
    $newHashedPassword = sha1($newPassword);
    //Update the password field where the id matches the userId supplied to this method and where the password matched the hash of the original password
    $query = 'UPDATE projectusers SET password = ? WHERE id = ? AND password = ?;';
    $stmt = $conn->prepare($query);
    //Bind the associated parameters to the prepared statement
    $stmt->bind_param('sds', $newHashedPassword, $userId, $originalHashedPassword);
    $stmt->execute();

    //Output a message indicating if the password update was able to complete successfully
    if ($stmt->error)
    {
        getErrorMessage("Unable to update your password. Please <a href=\"resetPassword.php\">try again</a>");
    }
    else
    {
        getSuccessMessage("Your Password has been successfully updated.");
    }
    $stmt->free_result();
}

function getMovieId($title, $overview, $posterPath)
{
    $conn = connectToDatabase();
    //Get the id associated with the movie details passed into this method
    $query = 'SELECT id FROM `projectmovies` WHERE title = ? AND overview = ? AND poster_path = ?';
    $stmt = $conn->prepare($query);
    //Bind the associated parameters to the prepared statement
    $stmt->bind_param('sss', $title, $overview, $posterPath);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id);
    $stmt->fetch();
    $stmt->close();
    return $id;
}

function movieDoesNotExistInProjectMovies($title, $overview, $posterPath)
{
    //Ensures the movie does not already exist in projectmovies to prevent duplicate entries
    $movieId = getMovieId($title, $overview, $posterPath);
    $conn = connectToDatabase();
    $query = 'SELECT id FROM `projectmovies` WHERE id = ?';
    $stmt = $conn->prepare($query);
    //Bind the associated parameters to the prepared statement
    $stmt->bind_param('i', $movieId);
    $stmt->execute();
    $stmt->store_result();
    return (!$stmt->num_rows > 0);
}

function movieGenreLinkIsNew($movieId, $genreId)
{
    //Ensures the genre when associated with a particular movie doesn't already exist
    $conn = connectToDatabase();
    $query = 'SELECT id FROM `projectmoviegenres` WHERE movie_id = ? AND genre_id = ?';
    $stmt = $conn->prepare($query);
    //Bind the associated parameters to the prepared statement
    $stmt->bind_param('ii', $movieId, $genreId);
    $stmt->execute();
    $stmt->store_result();
    //If the number of rows returned isn't greater than zero then this genre can be added and associated with the specified movie in the projectmoviegenres link table
    return (!$stmt->num_rows > 0);
}

function doesUserHaveRecommendations($userId)
{
    $stmt = getAllMoviesFromDatabaseForUser($userId);
    //Return true if the user does have recommendations, otherwise return false
    return ($stmt->num_rows > 0);
}

function getGenreNameFromId($genreId)
{
    $conn = connectToDatabase();
    //Gets the name of the genre associated with the supplied id
    $query = 'SELECT name FROM `projectgenres` WHERE id = ?';
    $stmt = $conn->prepare($query);
    //Bind the associated parameter to the prepared statement
    $stmt->bind_param('d', $genreId);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($name);
    $stmt->fetch();
    $stmt->close();
    return $name;
}
?>
