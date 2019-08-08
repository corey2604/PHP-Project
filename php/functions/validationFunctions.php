<?php
function checkValidUser() {
  session_start();
// see if somebody is logged in and notify them if not
  if (isset($_SESSION['valid_user']))  {
      return $_SESSION['valid_user'];
  } else {
     // If they are not logged in then automatically re-direct the user to the login screen
     header("Location: login.php");
  }
}

function getPostValueIfPresent($value) {
  return isset($_POST[$value]) ? $_POST[$value] : '';
}

function getKeyWordIfPresent() {
  return isset($_POST["keyword"]) ? $_POST["keyword"] : '';
}

function testInput($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function filled_out($form_vars) {

  // test that each variable has a value
  foreach ($form_vars as $key => $value) {
     if ((!isset($key)) || ($value == '')) {
        return false;
     }
  }
  return true;
}

function valid_email($address) {
  // check an email address is possibly valid
  if (preg_match('/^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/', $address)) {
    return true;
  } else {
    return false;
  }
}

function validateRegistrationForm()
{
    $valid = true;
    $errorMessage = array();
    foreach ($_POST as $key => $value) {
        if (empty($_POST[$key])) {
            $valid = false;
        }
    }

    if($valid == true) {
        if ($_POST['password'] != $_POST['confirm_password']) {
            $errorMessage[] = 'Passwords should be same.';
            $valid = false;
        }

        if (! isset($error_message)) {
            if (! filter_var($_POST["userEmail"], FILTER_VALIDATE_EMAIL)) {
                $errorMessage[] = "Invalid email address.";
                $valid = false;
            }
        }
    }
    else {
        $errorMessage[] = "All fields are required.";
    }

    if ($valid == false) {
        return $errorMessage;
    }
    return;
}
?>
