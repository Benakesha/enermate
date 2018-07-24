 <?php

    include "eepl_db.php";
      $id=$_GET['ids'];
 	
 	  $sql="SELECT * from enermate_event where id=$id";
      mysqli_query($conn,$sql);
      $result = $conn->query($sql);
	  while($row = $result->fetch_assoc()) {
	  	  $eventname=$row['eventname'];
	 	  $eventdetails=$row['eventdetail'];
		  $sensor=$row['sensor'];
		  $date=$row['dates'];
		  $id=$row['id'];
	}
  ?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="datetime1/css/bootstrap-datetimepicker.min.css" />
     <link rel="stylesheet" href="datetime1/css/bootstrap-datetimepicker.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <script src="datetime1/js/bootstrap-datetimepicker.min.js"></script>
     <script src="datetime1/js/bootstrap-datetimepicker.js"></script>
    <script src="https://use.fontawesome.com/268d490d38.js"></script>
         
        <title>Alert - Enermate</title>
    </head>
    <body style="font-family: 'Lato', sans-serif; font-size: 14px; color: #333; margin: 0px;  padding: 0px;  background: #eef1f5;"><br/><br/>

    	<div class="container-fluid">
    		<form class="form-alert" role="form" id="addEventForm" action="editEventRow.php"
             method="POST" onsubmit="return validate_fn();">

    			<div class="row">
    				<div class="col-md-12">
    					<div class="panel padding-5">
    						<div class="panel-heading">
    							<h3 class="panel-title">
    								<i class="fa fa-calendar-o"></i>
                                    &nbsp;<span>Add Event</span>
    							</h3>
    						</div>
    					</div>
    				</div>
    			</div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel padding-5">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>Event Name
                                        <span class="red">*</span>
                                    </label><span class="red" id="eNameError"></span>
                                    <input type="text" class="form-control" placeholder="Event Name" name="eventName" autofocus id="eName" value="<?php echo $eventname;?>">
                                </div>
                                <div class="form-group">
                                    <label>Event Details</label><span class="red" id="eDetailsError"></span>
                                    <textarea class="form-control textarea-no-resize" placeholder="Write event description here..." name="eventDetails" id="eDetails"><?php echo $eventdetails; ?>
                                    	 
                                    </textarea >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel padding-5">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>Sensor
                                        <span class="red">*</span>
                                    </label><span class="red" id="sensorError"></span>
                                    <select class="form-control input-large" name="sensorId" required="required" style="height: 34px;" id="sensor">
                                        <option value="select" selected="selected">Select</option>
                                        <option <?php if ($sensor == "PRODUCTION PANEL SMSB1" ) echo 'selected' ; ?> value="PRODUCTION PANEL SMSB1">PRODUCTION PANEL SMSB1</option> 
                                        <option <?php if ($sensor == "SMSB3 TEST LAB" ) echo 'selected' ; ?> value="SMSB3 TEST LAB">SMSB-3 TEST LAB</option>
                                        <option <?php if ($sensor == "SMSB2 OFFICE" ) echo 'selected' ; ?> value="SMSB2 OFFICE">SMSB-2 OFFICE</option>
                                        <option <?php if ($sensor == "AC CONTROL GROUND FLOOR" ) echo 'selected' ; ?> value="AC CONTROL GROUND FLOOR">A/C CONTROL GROUND FLOOR</option>
                                        <option <?php if ($sensor == "AC PANEL TERRACE" ) echo 'selected' ; ?> value="AC PANEL TERRACE">AC PANEL TERRACE</option>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Date and Time
                                        <span class="red">*</span>
                                    </label>&nbsp;<span class="red" id="dateError"></span>
                                       <div class="input-append date" >
                                        <input size="16" type="text" id="startDate" name="startDate"  readonly class="form-control" value="<?php echo $date;?>">
                                        <span class="add-on"><i class="icon-th"></i></span>
                                    </div> 
                                       
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                	<input type="text" name="id" value="<?php echo $id; ?>" style="display:none;" class="form-control">
                </div>
                <hr>
                <br/><br/><br/>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary" name="submit_form" id="btnsave1"  >&nbsp;&nbsp;SAVE&nbsp;&nbsp;</button>&nbsp;&nbsp;
                        <button type="button" class="btn" id="btnreset1">&nbsp;&nbsp;RESET&nbsp;&nbsp;</button>
                    </div>
                </div>
    		</form>
    	</div>
        <div class="btn-group-float">
            <button class="btn btn-primary btn-lg btn-round">
                <i class="fa fa-line-chart">
                    Analyse
                </i>
            </button>
        </div><br/>
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="footer text-center">
                    2018 &copy;Enermate Energy Private Ltd.
                </div>
            </div>
        </div>
  
   
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

    </body>
</html>

<script type="text/javascript">

  $("#startDate").datetimepicker({
        format: "mm/dd/yyyy hh:ii P",
        autoclose: true,
        todayBtn: true,
        startDate: "2018-05-1 00:00",
        minuteStep: 10
    });
 

    $('#btnreset1').on('click',function(){
           
        $('#addEventForm').find('input:text,textarea,select').val('');
          //  $('#addEventForm').find('input:radio, input:checkbox').prop('checked', false);

    });

          
   function validate_fn(){
        
            var eventName = $('#eName').val();
          //  var txtVal = $('#txtDate').val();
            var eventDetails = $('#eDetails').val();
            var sensorname = $('#sensor option:selected').val();
       		


            if(eventName == ""){
               document.getElementById('eNameError').innerText="Please enter event name";
               return false;
            }else{
                enamePreg=/^[a-zA-Z]+$/;
                var name= eventName.match(enamePreg);
                if(name){
                    document.getElementById('eNameError').innerText="";
                    return true;
                }else{
                    document.getElementById('eNameError').innerText="Event name should be alphabetics";
                    return false;
                }
            }
            //
            //event detail
            //
            var eventDetails = $('#eDetails').val();

            //
            //sensor
            //
            var sensorname = $('#sensor option:selected').val();
            if(sensorname == 'select'){
               document.getElementById('sensorError').innerText="Please select sensor name";
               return false;
            }else{
                document.getElementById('sensorError').innerText="";
                return true;
            }


         
     }

</script>
