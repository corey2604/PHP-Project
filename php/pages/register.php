<?php
  require_once(__DIR__.'/../whatShouldIWatchFunctions.php');
 ?>
<!doctype html>
<html>
<?php getHead("Register") ?>
<body>
<?php getNavbar() ?>
<?php getRegistrationForm() ?>
    <?php if(!empty($response)) { ?>
    <div class="response <?php echo $response[" type "]; ?>">
        <?php echo $response["message"]; ?> </div>
    <?php }?>
</body>

</html>
