<?php

$hostname = "localhost";
$username = "root";
$password = "EAA?43@B8d,uk!/Z";
$dbname = "posts";

$dbconnection = mysqli_connect($hostname, $username, $password, $dbname);

if (!$dbconnection) {
  die("Bad connection error: " . mysqli_connect_error());
}

?>
