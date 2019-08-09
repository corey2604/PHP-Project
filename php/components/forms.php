<?php
//A component class used to display the forms associated with user account management e.g. Register, Login, Password reset
function getRegistrationForm($usernameErr, $passwordErr, $confirmPasswordErr, $registerErr) {
//This method receives any associated errors from form validation as parameters and will output these errors under their associated fields
  ?>
  <div class="sidenav">
           <div class="login-main-text">
              <h2>Create Your Account<br></h2>
              <p>Create your account and start receiving personalised movie recommendations.</p>
           </div>
        </div>
        <div class="main">
           <div class="col-md-6 col-sm-12">
              <div class="login-form">
                 <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <div class="form-group">
                       <label>User Name</label>
                       <input type="text" class="form-control" id="email" name="email" placeholder="User Name">
                       <?php
                       //This provides an example of how error messages are output with their associated fields
                       if (!empty($usernameErr)) { echo getErrorMessage($usernameErr); } ?>
                    </div>
                    <div class="form-group">
                       <label>Password</label>
                       <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                       <?php if (!empty($passwordErr)) { echo getErrorMessage($passwordErr); } ?>
                    </div>
                    <div class="form-group">
                       <label>Confirm Password</label>
                       <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Password">
                       <?php if (!empty($confirmPasswordErr)) { echo getErrorMessage($confirmPasswordErr); } ?>
                    </div>
                    <?php if (!empty($registerErr)) { echo getErrorMessage($registerErr); } ?>
                    <button type="submit" class="btn btn-black btn-block">Register</button>
                    <div class="text-center pt-2">Already have an account?</div>
                    <a onclick="window.location.href = 'login.php';" class="btn btn-secondary text-white btn-block">Log In</a>
                 </form>
              </div>
           </div>
        </div>
<?php } ?>

<?php function getLogInForm($usernameErr, $passwordErr, $loginErr) {
  //This method receives any associated errors from form validation as parameters and will output these errors under their associated fields
  ?>
<div class="sidenav">
         <div class="login-main-text">
            <h2>Welcome to WhatShouldIWatch.com<br></h2>
            <p>Login or register here to search an archive of movies and receive personalised recommendations.</p>
         </div>
      </div>
      <div class="main">
         <div class="col-md-6 col-sm-12">
            <div class="login-form">
               <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                  <div class="form-group">
                     <label>User Name</label>
                     <input type="text" class="form-control" id="email" name="email" placeholder="User Name">
                      <?php
                      //This provides an example of how error messages are output with their associated fields
                      if (!empty($usernameErr)) { echo getErrorMessage($usernameErr); } ?>
                  </div>
                  <div class="form-group">
                     <label>Password</label>
                     <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                      <?php if (!empty($passwordErr)) { echo getErrorMessage($passwordErr); } ?>
                  </div>
                  <?php if (!empty($loginErr)) { echo getErrorMessage($loginErr); } ?>
                  <button type="submit" class="btn btn-black btn-block">Login</button>
                  <div class="text-center pt-2">Don't have an account?</div>
                  <a onclick="window.location.href = 'register.php';" class="btn btn-secondary text-white btn-block">Register</a>
               </form>
            </div>
         </div>
      </div>

<?php }

function getPasswordResetForm() { ?>
  <div class="form">
     <form action="reset.php" method="post">
        <div class="form-group">
           <label>User Name</label>
           <!--This field is set to be read-only as the username is already supplied from the session and should not be altered-->
           <input type="text" readonly class="form-control-plaintext" id="username" name="username" value="<?php echo getUsernameFromId($_SESSION['userId']); ?>">
        </div>
        <div class="form-group">
           <label>Original Password</label>
           <input type="password" class="form-control" id="original_password" name="original_password" placeholder="Original Password">
        </div>
        <div class="form-group">
           <label>New Password</label>
           <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New Password">
        </div>
        <div class="form-group">
           <label>Confirm New Password</label>
           <input type="password" class="form-control" id="new_password_confirm" name="new_password_confirm" placeholder="Confirm New Password">
        </div>
        <button type="submit" class="btn btn-black btn-block">Update</button>
     </form>
  </div>

<?php } ?>
