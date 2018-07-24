<?php 

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'eepl123';
$db='enermate_db';


$conn = new mysqli($dbhost, $dbuser, $dbpass,$db);
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}else{
		echo "connect";
		$ids=$_POST['data'];
		echo $ids;

		$sql = "DELETE from enermate_event where id=$ids";
		if(mysqli_query($conn, $sql)){
    		echo "Record was deleted successfully.";
		} 
		else{
		    echo "ERROR: Could not able to execute $sql. " 
		                                   . mysqli_error($conn);
		}
		mysqli_close($conn);
			

}


?>