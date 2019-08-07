<?php
require_once(__DIR__.'/../whatShouldIWatchFunctions.php');

$keyword = getKeyWordIfPresent();
$movieChunks = searchForMovies($keyword);
  ?>
  <?php getHeader("Movie Results"); echo $_SESSION['valid_user'];?>
    <div class="container">
      <?php foreach($movieChunks as $movieRow): ?>
      <div class="row">
         <?php foreach($movieRow as $movie):
          $id = htmlspecialchars($movie['id']);
          echo getMovieData($id);
         endforeach; ?>
        </div>
        <?php endforeach; ?>
        </div>
<?php getFooter() ?>
