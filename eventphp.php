<?php
if( isset($_POST['submit_form']))
{
function validate_data($data)
 {
  //$data = preg_replace('/;/g', '', $data);
  $data = trim($data);
  $data = stripslashes($data);
  $data = strip_tags($data);
  $data = htmlspecialchars($data);
  //$data = mysqli_real_escape_string($data);
  return $data;    
 }

 $eventName =validate_data($_POST['eventName']);
 $eventDetails =validate_data($_POST['eventDetails']);
 $sensor = validate_data($_POST['sensorId']);
 $dates= validate_data($_POST['startDate']);
 
 echo $eventName."<br>".$eventDetails."<br>".$sensor."<br>".$dates;

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'eepl123';
$db='enermate_db';


$conn = new mysqli($dbhost, $dbuser, $dbpass,$db);
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
else{
   echo "success";
   $insertdata="INSERT INTO enermate_event VALUES (null,'$eventName','$eventDetails','$sensor','$dates')";
   mysqli_query($conn,$insertdata);
   header("location:index.php");

}
}/*
 $insertdata="INSERT INTO enermate_event VALUES('$eventName','$eventDetails','$sensor','$dates',1)";
 mysqli_query($insertdata);
}*/
?>