<?php
function getNavbar() { ?>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">What Should I Watch</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Search for movie <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="currentlyShowing.php">Currently showing movies</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="myMovies.php">My Movies</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="myRecommendations.php">My Recommendations</a>
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
