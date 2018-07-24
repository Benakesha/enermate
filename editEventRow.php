
<?php  

include "eepl_db.php";

if(isset($_POST['submit_form'])){

	$id=$_POST['id'];
	$eventName=$_POST['eventName'];
	$eventDetails=$_POST['eventDetails'];
	$sensor=$_POST['sensorId'];
	$date=$_POST['startDate'];
	
	echo $id."<br>".$eventName."<br>".$eventDetails."<br>".$sensor."<br>".$date;

	$sql= "UPDATE enermate_event SET eventname='$eventName',eventdetail='$eventDetails',sensor='$sensor',dates='$date' where id='$id'";

	 $result1=mysqli_query($conn,$sql);
    
    }
    if(isset($result1)){
    header("location:index.php");
    }


//}

?>