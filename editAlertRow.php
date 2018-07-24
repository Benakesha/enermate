
<?php  

include "eepl_db.php";

if(isset($_POST['form_submit']))
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

 $id=$_POST['id'];
 //$id=validate_data($ids);
 $alertname =validate_data($_POST['alertName']);
 $alert_type =validate_data($_POST['atype']);
 $location = validate_data($_POST['locationlist']);
 $duration=validate_data($_POST['duration']);
 $ondays=validate_data($_POST['day']);
 $starthour=validate_data($_POST['starthour']);
 $startmin=validate_data($_POST['startmin']);
 $endhour=validate_data($_POST['endhour']);
 $endmin=validate_data($_POST['endmin']);
 $repeatday=validate_data($_POST['thresholdDuration']);

 $se= $_POST['se'];

 if($se == 0){
    $custom_event='';
    $define_event= validate_data($se);//define_event
    $gtltlist= validate_data($_POST['gtlist']);
    $simpleThresholdValue=validate_data($_POST['simpleThresholdValue0']);
     //echo $seval."<br>".$ceval."<br>".$gtltlist."<br>".$simpleThresholdValue."<br>";

 }else if($se == 1){
    $custom_event='';
    $define_event=validate_data($se);
    $gtltlist= validate_data($_POST['ltlist']);
    $simpleThresholdValue=validate_data($_POST['simpleThresholdValue1']);
    // echo $seval."<br>".$ceval."<br>".$gtltlist."<br>".$simpleThresholdValue."<br>";
 }else if($se == 2){
    $define_event=validate_data($se);
    $gtltlist= validate_data($_POST['gtltlist']);
    $custom_event= validate_data($_POST['ces']);
    $simpleThresholdValue=validate_data($_POST['simpleThresholdValue2']);
    //echo $seval."<br>".$ceval."<br>".$gtltlist."<br>".$simpleThresholdValue."<br>";
 }
 $email=$_POST['email'];
 $mobilenumber=$_POST['mobileNum'];
 echo $mobilenumber;
if($email == "" && $mobilenumber == ""){
   $insertdata="UPDATE enermate_alert SET alertname='$alertname',alert_type='$alert_type',location='$location',define_event='$define_event',gtltlist='$gtltlist',simpleThresholdValue='$simpleThresholdValue',custom_event='$custom_event',duration='$duration',ondays='$ondays',startHour=$starthour,startMin=$startmin,endHour=$endhour,endMin=$endmin,repeatday='$repeatday',mobileno='',email=''  where id=$id";
   $result1=mysqli_query($conn,$insertdata);	
    //mysqli_query($conn,$insertdata);
}else{
  $insertdata="UPDATE enermate_alert SET alertname='$alertname',alert_type='$alert_type',location='$location',define_event='$define_event',gtltlist='$gtltlist',simpleThresholdValue='$simpleThresholdValue',custom_event='$custom_event',duration='$duration',ondays='$ondays',startHour=$starthour,startMin=$startmin,endHour=$endhour,endMin=$endmin,repeatday='$repeatday',mobileno='$mobilenumber',email='$email' where id=$id";
  $result1=mysqli_query($conn,$insertdata);
   
}
    
}
 
  if(isset($result1)){
     header("location:index.php");
  }


?>