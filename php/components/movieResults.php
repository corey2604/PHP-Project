<?php
require_once(__DIR__.'/../whatShouldIWatchFunctions.php');
function getMovieResults(){

$keyword = getKeyWordIfPresent();
if (isset($_POST['submit']) )
{
  if (!empty($keyword))
  {
    $movieChunks = searchForMovies($keyword);
    getCardRows($movieChunks);
  }
}?>
</div>
<?php
}
getFooter(); ?>
