<?php
require_once(__DIR__.'/../whatShouldIWatchFunctions.php');
getHeader("Search For Movie");?>
    <div class="container">
    <h2>Search For Movie</h2>
    <div class="search-form-container">
        <form id="keywordForm" method="post" action="movieResults.php">
            <div class="form-group">
                Search Keyword : <input class="form-control" type="search" id="keyword" name="keyword" placeholder="Enter Search Keyword">
            </div>
            <div class="form-group">
              Maximum number of results : <input class="form-control" type="number" id="max_results" name="max_results" placeholder="If left unspecified the maximum number of results will be 15">
            </div>

            <input class="btn btn-primary btn-block" type="submit" name="submit" value="Search">
        </form>
    </div>
  </div>

    <?php if(!empty($response)) { ?>
    <div class="response <?php echo $response[" type "]; ?>">
        <?php echo $response["message"]; ?> </div>
    <?php }?>
<?php getFooter() ?>
