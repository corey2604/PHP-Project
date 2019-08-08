<?php
function getErrorMessage($errorMessage) {
 ?>
 <div class="alert alert-danger alert-dismissible fade show">
   <strong>Error!</strong> <?php echo $errorMessage; ?>
   <button type="button" class="close" data-dismiss="alert">&times;</button>
 </div>
 <?php
  }

  function getSuccessMessage($successMessage) {
   ?>
   <div class="alert alert-success alert-dismissible fade show">
     <strong>Success!</strong> <?php echo $successMessage; ?>
     <button type="button" class="close" data-dismiss="alert">&times;</button>
   </div>
   <?php
    }
  ?>
