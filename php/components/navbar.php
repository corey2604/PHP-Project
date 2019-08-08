<?php
function getNavbar($title) {
  //Return the user's username or redirect them to the login screen if not currently logged in.
  $username = checkValidUser();?>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php">What Should I Watch</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="nav navbar-nav navbar-left mr-auto">
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
    </ul>
    <ul class="nav navbar-nav navbar-right justify-content-end">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-center" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="font-weight-light"> Welcome <?php echo $username ?>,</span><br>
          <span class="font-weight-bold">Manage Your Account</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="logout.php">Log Out</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
<?php
}
?>
