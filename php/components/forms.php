<?php function getRegistrationForm() { ?>
  <div class="sidenav">
           <div class="login-main-text">
              <h2>Create Your Account<br></h2>
              <p>Create your account and start receiving personalised movie recommendations.</p>
           </div>
        </div>
        <div class="main">
           <div class="col-md-6 col-sm-12">
              <div class="login-form">
                 <form action="registerNew.php" method="post">
                    <div class="form-group">
                       <label>User Name</label>
                       <input type="text" class="form-control" id="email" name="email" placeholder="User Name">
                    </div>
                    <div class="form-group">
                       <label>Password</label>
                       <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                       <label>Confirm Password</label>
                       <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-black btn-block">Register</button>
                    <div class="text-center pt-2">Already have an account?</div>
                    <a onclick="window.location.href = 'login.php';" class="btn btn-secondary text-white btn-block">Log In</a>
                 </form>
              </div>
           </div>
        </div>
<?php } ?>

<?php function getLogInForm() { ?>
<div class="sidenav">
         <div class="login-main-text">
            <h2>Welcome to WhatShouldIWatch.com<br></h2>
            <p>Login or register here to search an archive of movies and receive personalised recommendations.</p>
         </div>
      </div>
      <div class="main">
         <div class="col-md-6 col-sm-12">
            <div class="login-form">
               <form action="member.php" method="post">
                  <div class="form-group">
                     <label>User Name</label>
                     <input type="text" class="form-control" id="email" name="email" placeholder="User Name">
                  </div>
                  <div class="form-group">
                     <label>Password</label>
                     <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                  </div>
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
           <input type="text" readonly class="form-control-plaintext" id="username" name="username" value="<?php echo $_SESSION['valid_user']; ?>">
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
