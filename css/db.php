<?php
  $servername = "localhost";

  //$username = "root";
  //$password = "Ju948979123!";
  //$dbname = "ju";
  $dbname = "isxk_rmbi";
  $username = "isxk_rmbi";
  $password = "aePee0Seroo@";
  


  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }


?>
