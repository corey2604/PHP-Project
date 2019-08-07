<?php function getRegistrationForm() { ?>
  <h2>Register here</h2>
  <div class="search-form-container">
      <form id="registrationForm" method="post" action="registerNew.php">
          <div class="input-row">
            <div class="form-group">
              Email : <input class="input-field" type="text" id="email" name="email" placeholder="">
            </div>
            <div class="form-group">
              Password : <input class="input-field" type="password" id="password" name="password" placeholder="">
            </div>
            <div class="form-group">
              Confirm Password : <input class="input-field" type="password" id="confirm_password" name="confirm_password" placeholder="">
            </div>
          </div>

          <input class="btn-submit" type="submit" name="submit" value="Search">
      </form>
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
                  <button type="submit" class="btn btn-black">Login</button>
                  <button type="submit" class="btn btn-secondary">Register</button>
               </form>
            </div>
         </div>
      </div>

<?php } ?>
