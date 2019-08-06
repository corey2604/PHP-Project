<?php
function connectToDatabase() {
  $host = 'localhost';
  $username = 'B00652935';
  $password = 'NuQ3Kngv';
  $database = 'b00652935';
  $db = new mysqli($host, $username, $password, $database);
  if (mysqli_connect_errno())
  {
    echo "<div class=\"container\"><div class=\"alert alert-danger\">Could not connect to database</div></div>";
  } else {
    return $db;
  }
}

function register_user($email, $password){
  // connect to db
 $conn = connectToDatabase();

 // check if username is unique
 $result = $conn->query("select * from projectusers where username='".$email."'");
 if (!$result) {
   throw new Exception('Could not execute query');
 }

 if ($result->num_rows>0) {
   throw new Exception('That username is taken - go back and choose another one.');
 }

 // if ok, put in db
 $result = $conn->query("insert into projectusers(username, password, reg_date) values
                        ('".$email."', sha1('".$password."'), now())");
 if (!$result) {
   throw new Exception('Could not register you in database - please try again later.');
 }

 return true;
}

function login($username, $password) {
// check username and password with db
// if yes, return true
// else throw exception

  // connect to db
  $conn = connectToDatabase();

  // check if username is unique
  $result = $conn->query("select * from projectusers
                         where username='".$username."'
                         and password = sha1('".$password."')");
  if (!$result) {
     throw new Exception('Could not log you in.');
  }

  if ($result->num_rows>0) {
     return true;
  } else {
     throw new Exception('Could not log you in.');
  }
}
?>
