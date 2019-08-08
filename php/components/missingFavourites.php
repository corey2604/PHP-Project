<?php
  function getMissingFavouritesDisplay($missingElement) {?>
    <div class= "text-center pt-5">
      <h1> You do not have any <?php echo $missingElement; ?></h1>
      <p> <a href="index.php">Search</a> for some movies to add to your favourites in order to receive tailored recommendations.</p>
      <img src="http://scm.ulster.ac.uk/~b00652935/COM549/Project/assets/popcorn.jpeg"></img>
    </div>
  <?php
}
?>
