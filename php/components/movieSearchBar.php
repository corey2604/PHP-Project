<?php
//A component class to return the main search bar used in index.php
require_once (__DIR__ . '/alertMessages.php');
function getMovieSearchBar($errorMessage)
{
?>
<h1 class="text-center pt-5">Search for your favourite movies</h1>
<div class="row justify-content-center">
    <div class="col-12 col-md-10 col-lg-8">
        <form class="card card-sm" method="post" action="">
            <div class="card-body row no-gutters align-items-center">
                <div class="col-auto">
                    <i class="fas fa-search h4 text-body"></i>
                </div>
                <div class="col">
                    <input class="form-control form-control-lg form-control-borderless" type="search" id="keyword" name="keyword" placeholder="Search titles or keywords">
                </div>
                <div class="col-auto">
                    <button class="btn btn-lg btn-primary" type="submit" name="submit">Search</button>
                </div>
            </div>
        </form>
  <?php
  //If an error message is present from a search attempt then output it below the search bar
    if (!empty($errorMessage))
    {
        getErrorMessage($errorMessage);
    }
?>
  </div>
</div>
<?php
}
?>
