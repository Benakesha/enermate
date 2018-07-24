<?php 
include "eepl_db.php";
$date_array=Array();
//date_default_timezone_set('Asia/kolkata');
//$current_date=date("m/d/Y H:i A");
//echo $current_date;
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://use.fontawesome.com/268d490d38.js"></script>
    <link rel="stylesheet" href="custom.css">
    <link rel="stylesheet" href="vendor.css">
    <title>Alert - Enermate</title>
   
  </head>
  <body style="font-family: 'Lato', sans-serif; font-size: 14px; color: #333; margin: 0px;  padding: 0px;  background: #eef1f5;"><br/><br/>
  	<div> <p id="txt" style="text-align: center; font-size: 20px;"></p> </div>
  	<div class="container-fluid">
  		<div class="panel padding-5">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-6">
						<h3 class="panel-title">
							<i class="fa fa-bell-o">
							</i>
							&nbsp;
							<strong>Alerts</strong>
						</h3>
					</div>
					<div class="col-xs-6 text-right">
						<a href="<?php echo 'addAlert.php';?>">
							<i class="fa fa-plus-circle"></i>
					     	&nbsp;Add Alert
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="panel">
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-eco">
						<thead>
							<tr>
								<th>STATUS</th>
								<th>ALERT NAME</th>
								<th>SENSOR NAME</th>
								<th>SMS</th>
								<th>EMAIL</th>
								<th>ACTION</th>
							</tr>
						</thead>
						<?php
						 $sql= "SELECT * from enermate_alert ORDER BY id ASC LIMIT 5";
							$result = $conn->query($sql);
							 while($row = $result->fetch_assoc()) {

							 	 $alertname=$row['alertname'];
							 	 $location=$row['location'];
							 	 //$sensor=$row['sensor'];
							 	 $mobileno=$row['mobileno'];
							 	 $id=$row['id'];
							 	 $email=$row['email'];
							 
						 ?> 
						<tbody>
							<tr>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ON</td>
								<td><?php echo $alertname; ?></td>
								<td><?php echo $location; ?></td>
								<td><?php  $number=explode(',', $mobileno);
							 	 for($i=0;$i<count($number);$i++){
							 	 	$mobilenumber=$number[$i];
							 	 	echo $mobilenumber."<br>";
							 	 } ?></td>
								<td><?php $emailid=explode(',', $email);
							 	 for($i=0;$i<count($emailid);$i++){
							 	 	$emails=$emailid[$i];
							 	 	echo $emails."<br>";
							 	 } ?></td>
								<td>&nbsp;&nbsp;<a href="editAlert.php?ids=<?php echo $id;?>" id="<?php echo $id;?>" ><i class="fa fa-pencil-square-o" title="Edit Alert"></i></a>&nbsp;&nbsp;&nbsp;<a href="index.php" id="<?php echo $id;?>" onclick="deleteAlert(this.id)"><i class="fa fa-trash" title="Delete Alert"></i></a></td>
							</tr>	
						</tbody>
					<?php } ?>
					</table>
				</div>
			</div>
		</div>
		<div class="panel padding-5">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-6">
						<h3 class="panel-title">
							<i class="fa fa-calendar-o">
							</i>
							&nbsp;
							<strong>Events</strong>
						</h3>
					</div>
					<div class="col-xs-6 text-right">
						<a href="<?php echo 'addEvent.php';?>">
							<i class="fa fa-plus-circle"></i>
					     	&nbsp;Add Event
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="panel">
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-eco">
						<thead>
							<tr>
								<th>DATE</th>
								<th>EVENT NAME</th>
								<th>EVENT DETAILS</th>
								<th>SENSOR NAME</th>
								<th>ACTION</th>
							</tr>
						</thead>
						<?php
						    $sql= "SELECT * from enermate_event ORDER BY id ASC LIMIT 5";
							$result = $conn->query($sql);
							 while($row = $result->fetch_assoc()) {

							 	 $eventname=$row['eventname'];
							 	 $eventdetails=$row['eventdetail'];
							 	 $sensor=$row['sensor'];
							 	 $date=$row['dates'];
							 	 echo "date=".$date;
							 	 $id=$row['id'];
						    								 																			
						?>
						<tbody>	
							<tr>
								<td> <?php echo $date; ?> </td>
								<td> <?php echo $eventname; ?></td>
								<td> <?php echo $eventdetails; ?> </td>
								<td> <?php echo $sensor; ?> </td>
								<td>&nbsp;&nbsp;<a href="editEvent.php?ids=<?php echo $id;?>" id="<?php echo $id;?>" ><i class="fa fa-pencil-square-o" title="Edit Event"></i></a>&nbsp;&nbsp;&nbsp;<a href="index.php" id="<?php echo $id;?>" onclick="deleteEvent(this.id)"><i class="fa fa-trash" title="Delete Event"></i></a></td>
							</tr>
						</tbody>
					<?php } ?>
					</table>
				</div>
			</div>
		</div>
	</div>

  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  </body>
</html>
<script type="text/javascript">
	
function deleteEvent(ids){
			
        var eid=ids;
	 	$.ajax({
		    type: 'POST',
		    url: 'deleteEventRow.php',
		    dataType: 'json',
		    data: {
		        'data' : eid,
		    },
		     success: function(data)
           {
               console.log(data); // show response from the php script.
           }

		});
	
	   }


	function deleteAlert(ids){
			
	    var eid=ids;
	 	$.ajax({
		    type: 'POST',
		    url: 'deleteAlertRow.php',
		    dataType: 'json',
		    data: {
		        'data' : eid,
		    },
		     success: function(data)
           {
               console.log(data); // show response from the php script.
           }

		});
	
	   }

</script>