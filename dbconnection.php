<?php
// Create connection
$con=mysqli_connect("localhost","root","","clinic");

// Check connection
if (!$con)
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>