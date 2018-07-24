<?php


$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'eepl123';
$db='enermate_db';

$conn = new mysqli($dbhost, $dbuser, $dbpass,$db);
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

?>