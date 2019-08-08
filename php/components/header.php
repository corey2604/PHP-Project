<?php
function getHeader($title, $displayTitleText) { ?>
<!doctype html>
<html>
  <head>
      <title><?php echo $title ?></title>
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
  if ($title != "Log In" && $title != "Register" && $title != "Log Out") {
    getNavbar($title); ?>
    <span id="errorLocation"></span>
  <?php
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
