<?php
  $servername = "localhost";


  $dbname = "a_cool_name";
  $username = "a_cool_username";
  $password = "a_secure_password";
  


  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }


?>
