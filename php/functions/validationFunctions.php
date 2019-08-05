<?php
function getKeyWordIfPresent() {
  return isset($_POST["keyword"]) ? $_POST["keyword"] : '';
}

function testInput($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
