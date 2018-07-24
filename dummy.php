<script type="text/javascript">
  

function startTime() {
    var today = new Date();
    var y=today.getFullYear();
    var mo=today.getMonth()+1;
    var d=today.getDate();

    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    var ampm = (h >= 12) ? "PM" : "AM";
    m = checkTime(m);
    s = checkTime(s);
   
    document.getElementById('txt').innerHTML =mo+"/"+d+"/"+y+" "+h + ":" + m +":"+s+" "+ampm;
   
    var time_val=document.getElementById('txt').innerHTML;
   // console.log(time_val);
   // checkcondition(time_val);
    var t = setTimeout(startTime,500);
}


function checkDates(dates){
    var dats=dates.replace(/^0+/,'');
    //console.log(dats);
    var today = new Date();
    var y=today.getFullYear();
    var mo=today.getMonth()+1;
        mo = checkTime(mo);
    var d=today.getDate();

    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    var ampm = (h >= 12) ? "PM" : "AM";
    m = checkTime(m);
    s = checkTime(s);
    var cur_date=d+"/"+mo+"/"+y+" "+h + ":" + m +":"+s+" "+ampm;
    
    if(cur_date == dats){

      console.log("message sent");
      $.ajax({
                type: 'POST',
                url:'http://rt.airtelsms.com/sendsms/bulksms?username=aels-enermat&password=123456&type=0&dlr=1&destination=919739881730&source=EnerMa&message=Bulk SMS',
                dataType:'jsonp',
                success: function(response) {
                    console.log(response);
                }
     });

    }else{
        console.log(cur_date+" "+dats);
    }

    setTimeout(checkDates,1000,dats);
}



function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}
</script>



<?php 
include "eepl_db.php";
$date_array=Array();

 $sql="SELECT * from enermate_event";
  $result=$conn->query($sql);
   while($row = $result->fetch_assoc()) {

      $date=$row['dates'];
      $id=$row['id'];
      $datetime = new DateTime($date);
      $datetim = $datetime->format('d/m/Y H:i:s A');
      
      echo "<script  type='text/javascript'>checkDates('$datetim');</script>";
   }

 ?>


<?php
include "eepl_db.php";
$date_array_alert=Array();
$sql1="SELECT * from enermate_alert";
$result1=$conn->query($sql1);
while($row1=$result1->fetch_assoc()){

  $gtltlists=$row1['gtltlist'];
  $thresholdValue=$row1['simpleThresholdValue'];
  $duration=$row1['duration'];
  $onday=$row1['ondays'];
  $startHour=$row1['startHour'];
  $startMin=$row1['startMin'];
  $endHour=$row1['endHour'];
  $endMin=$row1['endMin'];
  $repeatday=$row1['repeatday'];
  $mobileno=$row1['mobileno'];
  $email=$row1['email'];
 
}

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
  <body style="font-family: 'Lato', sans-serif; font-size: 14px; color: #333; margin: 0px;  padding: 0px;  background: #eef1f5;" onload="startTime()"><br/><br/>
    <div> <p id="txt" style="text-align: center; font-size: 20px;"></p> </div>


     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  </body>
  </html>
