<?php
require_once(__DIR__.'/../whatShouldIWatchFunctions.php');

$keyword = getKeyWordIfPresent();
$movieChunks = getCurrentlyShowingMovies();
?>
  <?php getHeader("Currently Showing"); ?>
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
</body>
</html>
