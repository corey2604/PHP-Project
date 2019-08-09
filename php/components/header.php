<?php
//A component class for supplying the main header of each page
function getHeader($title, $displayTitleText) {
  //Each page will supply it's own title and a boolean value to indicate if title text should be output as a heading
  ?>
<!DOCTYPE html>
<html>
  <head>
      <title><?php echo $title ?></title>
      <!--Link the associated stylesheets and scripts-->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      <script src="../../js/ajaxFunctions.js" type="text/javascript"></script>
      <link rel="stylesheet" type="text/css" href="../../css/login.css">
      <link rel="stylesheet" type="text/css" href="../../css/movies.css">
  </head>
  <body>
  <?php
  //If the user is attempting to log in, register or log out then the navbar should not be present
  //These pages have their own design/styling which does not require the navbar
  if ($title != "Log In" && $title != "Register" && $title != "Log Out") {
    getNavbar($title); ?>
    <!--This is a hidden span where success or error messages will be output if required e.g. on successfully adding a movie to a user's favourites-->
    <span id="alertLocation"></span>
  <?php
    //Output a main heading if determined by the boolean value passed from the loaded page
    if ($displayTitleText) {
  ?>
  <h1 class="text-center pt-5 font-weight-bold"><?php echo $title ?></h1>
  <hr>
  <?php
    }
  }?>
 <div class="container">
<?php }
?>
