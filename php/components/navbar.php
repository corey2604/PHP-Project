<?php
//A component class to load the navbar for the main pages of the application
function getNavbar($title) {
  //The title of the page is passed as a parameter to allow the current page to be marked as active on the navbar
  //Return the user's username or redirect them to the login screen if not currently logged in.
  $username = checkValidUser();?>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php">What Should I Watch</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="nav navbar-nav navbar-left mr-auto">
      <!--Based on the title of the page, a section of the navbar will be marked as active to aid with navigation-->
      <li class="nav-item <?php if ($title == "Search For Movie") { echo "active"; } ?>">
        <a class="nav-link" href="index.php">Search for movie</a>
      </li>
      <li class="nav-item <?php if ($title == "Currently Showing Movies") { echo "active"; } ?>">
        <a class="nav-link" href="currentlyShowing.php">Currently showing movies</a>
      </li>
      <li class="nav-item <?php if ($title == "My Movies") { echo "active"; } ?>">
        <a class="nav-link" href="myMovies.php">My Movies</a>
      </li>
      <li class="nav-item <?php if ($title == "My Recommendations") { echo "active"; } ?>">
        <a class="nav-link" href="myRecommendations.php">My Recommendations</a>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right justify-content-end">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-center" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <!-- The user's username is output in the navbar-->
          <span class="font-weight-light"> Welcome <?php echo $username ?>,</span><br>
          <span class="font-weight-bold">Manage Your Account</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="logout.php">Log Out</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="resetPassword.php">Reset Password</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
<?php
}
?>
