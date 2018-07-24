
<?php 
date_default_timezone_set('Asia/kolkata');
$current_date=date("m/d/Y H:i A");
//echo $current_date;

include "eepl_db.php";
 

$sql="SELECT * from enermate_alert";
$result=$conn->query($sql);
while($row = $result->fetch_assoc()){
  $id=$row['id'];
  $define_event=$row['define_event'];
  $gtltlist=$row['gtltlist'];
  $simpleThresholdValue=$row['simpleThresholdValue'];
  $mobileno=$row['mobileno'];
  $email=$row['email'];
  $duration=$row['duration'];
  $ondays=$row['ondays'];
  $startHour=$row['startHour'];
  $endHour=$row['endHour'];
  $startMin=$row['startMin'];
  $endMin=$row['endMin'];
  $repeatday=$row['repeatday'];
  $define_event1=(int)$define_event;

   //echo "define_event=".$define_event."<br>gtltlist=".$gtltlist."<br>simpleThresholdValue=".number_format($simpleThresholdValue)."<br>duration=".$duration."<br>ondays=".$ondays."<br>startHour=".$startHour."<br>startMin=".$startMin."<br>endHour=".$endHour."<br>endMin=".$endMin."<br>repeatday=".$repeatday."<br>mobileno=".$mobileno."<br>email=".$email."<br>";


  $sql1="SELECT * from modbusnarayana ORDER BY Time DESC LIMIT 1";
  $result1=$conn->query($sql1);
  while($row1 = $result1->fetch_assoc()){
         $Reactive_Export=$row1['Reactive_Export'];
         $time=$row1['Time'];
         $pf=$row1['PF'];
        //echo number_format($Reactive_Export)." ".$time."<br>".number_format($simpleThresholdValue)."<br>";

        // if(number_format($simpleThresholdValue) ==  number_format($Reactive_Export)){
        //     echo "equal<br>";
        // }
         
         if($define_event1 == 0){

            if($Reactive_Export > number_format($simpleThresholdValue)){

                echo "condition reached send message";
                if($duration == 2 || $duration == 5 || $duration == 15 || $duration == 30){
                            
                            //repeatTime();                  
                }
                if($ondays == 0 || $ondays == 1 || $ondays == 2 || $ondays == 3 || $ondays == 4 || $ondays == 5 || $ondays == 6) {

                          //repeatDays();
                }
                if($repeatday == 30 || $repeatday == 60 || $repeatday == 360 || $repeatday == 1440){

                        //repeatEvery();

                } 
            } 

        }else if($define_event1 == 1){

            if($pf <= number_format($simpleThresholdValue)){

                echo "condition reached send message";
                if($duration == 2 || $duration == 5 || $duration == 15 || $duration == 30){
                            
                            //repeatTime();                  
                }
                if($ondays == 0 || $ondays == 1 || $ondays == 2 || $ondays == 3 || $ondays == 4 || $ondays == 5 || $ondays ==6) {

                          //repeatDays();
                }
                if($repeatday == 30 || $repeatday == 60 || $repeatday == 360 || $repeatday == 1440){

                        //repeatEvery();

                } 
            } 


        }else if($define_event1 == 2){
 //echo "condition reached send message";
            /*if($gtltlist == 3){

             

            }else if($gtltlist == 4){

            }*/
  
        }
  }

 
 }

 

?>
