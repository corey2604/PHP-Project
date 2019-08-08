<?php
function getStandardCard($movieData) {
  $title = $movieData["title"];
  $tagLine = $movieData["tagline"];
  $posterPath = $movieData["poster_path"];
  $releaseDate = $movieData['release_date'];
  $genres = $movieData["genres"];
  ?>
  <div class="col-md-3 d-flex align-items-stretch">
     <div class="card">
        <img class="card-img-top movie-poster" src="<?php echo "http://image.tmdb.org/t/p/w185$posterPath" ?>" >
        <div class="card-body">
             <h2 class="cardtitle d-flex align-items-center text-center font-weight-bold"><?php echo $title?></h2>
             <div class="card-body flex-column h-100">
               <h6 class="card-subtitle mb-2 text-muted font-italic"><?php echo stripslashes($tagLine); ?></h6>
               <ul class="list-group list-group-flush">
                 <li class="list-group-item">Release Date:<h6 class="card-text"><?php echo $releaseDate; ?></h6></li>
                 <li class="list-group-item">Genre(s): <h6 class="card-text"><?php echo getGenres($movieData); ?></h6></li>
              </ul>
             </div>
        </div>
           <div class="card-footer">
             <a href="" class="btn btn-primary btn-block" onclick="<?php echo "insertMovieIntoDb("."'".addslashes($title)."', '".addslashes($tagLine)."', '".$posterPath."', '".htmlentities(json_encode($genres))."');return false;" ?>">Store as Favourite</a>
             <a href="" class="btn btn-dark btn-block">View Similar Recommendations</a>
           </div>
     </div>
 </div>
<?php
}

function getDeleteCard($id, $title, $tagLine, $posterPath) {
  ?>
  <div class="col-md-3 d-flex align-items-stretch">
     <div class="card h-100 d-flex flex-column justify-content-between">
       <img class="card-img-top movie-poster" src="<?php echo "http://image.tmdb.org/t/p/w185$posterPath" ?>" >
        <div class="card-body">
           <h2 class="cardtitle d-flex align-items-center text-center font-weight-bold"><?php echo $title?></h2>
           <div class="card-body flex-column h-100">
             <h6 class="card-subtitle mb-2 text-muted font-italic"><?php echo stripslashes($tagLine); ?></h6>
           </div>
         </div>
      <?php getDeletionCardFooter($id); ?>
      </div>
   </div>
<?php
}

function getDeletionCardFooter($id) { ?>
  <div class="card-footer">
    <a href="" class="btn btn-danger btn-block" onclick="<?php echo "removeMovieFromDb($id);" ?>">Delete From Favourites</a>
    <a href="" class="btn btn-primary btn-block">View Similar Recommendations</a>
  </div>
<?php
}

function getCardRows($movieChunks) {?>
  <div class="container">
    <?php foreach($movieChunks as $movieRow): ?>
    <div class="row mt-3">
       <?php foreach($movieRow as $movie):
        $id = htmlspecialchars($movie['id']);
        echo getMovieData($id);
       endforeach; ?>
    </div>
    <?php endforeach; ?>
  </div>
<?php } ?>
