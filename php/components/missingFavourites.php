<?php
//A component class for displaying the main page contents when the user has not saved any movies
//As the user has no movies stored as favourites they will be unable to receive tailored recommendations
  function getMissingFavouritesDisplay($missingElement) {?>
    <!--$missingElement specified if this is being loaded to the 'My Movies' or 'My Recommendations' page and so will load the approriate text-->
    <div class= "text-center pt-5">
      <h1> You do not have any <?php echo $missingElement; ?></h1>
      <p> <a href="index.php">Search</a> for some movies to add to your favourites in order to receive tailored recommendations.</p>
      <img src="http://scm.ulster.ac.uk/~b00652935/COM549/Project/assets/popcorn.jpeg"></img>
    </div>
  <?php
}
?>
