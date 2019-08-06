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
  <h2>Log In</h2>
  <div class="search-form-container">
      <form id="registrationForm" method="post" action="member.php">
          <div class="input-row">
            <div class="form-group">
              Email : <input class="input-field" type="text" id="email" name="email" placeholder="">
            </div>
            <div class="form-group">
              Password : <input class="input-field" type="password" id="password" name="password" placeholder="">
            </div>
          </div>

          <input class="btn-submit" type="submit" name="submit" value="Search">
      </form>
  </div>
<?php } ?>
