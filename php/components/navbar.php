<?php
function getNavbar($title) { ?>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php">What Should I Watch</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item <?php if ($title == "Search for movie") { ?>active<?php } ?>">
        <a class="nav-link" href="index.php">Search for movie <span class="sr-only"><?php if ($title = "Search for movie") { ?>(current)<?php } ?></span></a>
      </li>
      <li class="nav-item <?php if ($title == "Currently Showing Movies") { ?>active<?php } ?>">
        <a class="nav-link" href="currentlyShowing.php">Currently showing movies<span class="sr-only"><?php if ($title = "Currently Showing Movies") { ?>(current)<?php } ?></span></a>
      </li>
      <li class="nav-item <?php if ($title == "My Movies") { ?>active<?php } ?>">
        <a class="nav-link" href="myMovies.php">My Movies<span class="sr-only"><?php if ($title = "My Movies") { ?>(current)<?php } ?></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="myRecommendations.php">My Recommendations<span class="sr-only"><?php if ($title = "My Movies") { ?>(current)<?php } ?></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Log Out</a>
      </li>
    </ul>
  </div>
</nav>
<?php
 checkValidUser();
}
?>
