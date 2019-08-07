<?php
function getStandardCard($movieData) {
  $title = $movieData["title"];
  $tagLine = $movieData["tagline"];
  $posterPath = $movieData["poster_path"];
  $releaseDate = $movieData['release_date'];
  $genres = $movieData["genres"];
  ?>
  <div class="col-md-3 d-flex align-items-stretch">
     <div class="card h-100 d-flex flex-column justify-content-between">
        <div class="card-block">
           <div class="card flex-fill">
             <h4 class="cardtitle flex-column h-100 align-items-center justify-content-center" style="min-height: 9rem;"><?php echo $title?></h4>
             <img class="card-img-top" src="<?php echo "http://image.tmdb.org/t/p/w185$posterPath" ?>" >
             <div class="card-body flex-column h-100">
               <h6 class="card-text textmuted"><?php echo stripslashes($tagLine); ?></h6>
               Release Date:<h6 class="card-text textmuted"><?php echo $releaseDate; ?></h6>
               Genre(s): <h6 class="card-text textmuted"><?php echo getGenres($movieData); ?></h6>
             </div>
           </div>
        </div>
           <div class="card-footer">
             <a href="" class="btn btn-primary" onclick="<?php echo "insertMovieIntoDb("."'".addslashes($title)."', '".addslashes($tagLine)."', '".$posterPath."', '".htmlentities(json_encode($genres))."');return false;" ?>">Store as Favourite</a>
             <a href="" class="btn btn-primary">View Similar Recommendations</a>
           </div>
     </div>
 </div>
<?php
}

function getDeleteCard($id, $title, $overview, $posterPath) {
  ?>
  <div class="col-md-3 d-flex align-items-stretch">
     <div class="card h-100 d-flex flex-column justify-content-between">
        <div class="card-block">
           <div class="card flex-fill">
             <h4 class="cardtitle flex-column h-100 align-items-center justify-content-center" style="min-height: 9rem;"><?php echo $title?></h4>
             <img class="card-img-top" src="<?php echo "http://image.tmdb.org/t/p/w185$posterPath" ?>" >
             <div class="card-body flex-column h-100">
               <h6 class="card-text textmuted"><?php echo stripslashes($overview); ?></h6>
             </div>
           </div>
        </div>
        <?php getDeletionCardFooter($id); ?>
     </div>
 </div>
<?php
}

function getDeletionCardFooter($id) { ?>
  <div class="card-footer">
    <a href="" class="btn btn-primary" onclick="<?php echo "removeMovieFromDb($id);" ?>">Delete From Favourites</a>
    <a href="" class="btn btn-primary">View Similar Recommendations</a>
  </div>
<?php
}
?>
