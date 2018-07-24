<?php 
  include "eepl_db.php";
  $date_array=Array();
 
  date_default_timezone_set('Asia/kolkata');
  $current_date=date("m/d/Y H:i A");
  echo $current_date;

  $sql="SELECT * from enermate_event";
  $result=$conn->query($sql);
   while($row = $result->fetch_assoc()) {

      $date=$row['dates'];
      $id=$row['id'];
     // $datetime = new DateTime($date);
     // $datetim = $datetime->format('d/m/Y H:i:s A');
      echo "<br>".$date;
     if($current_date == $date){
      echo "<br>sent<br>";

          $mobilenumber=Array(919632888779);//,919972968799,919449553545
          for($i=0;$i<count($mobilenumber);$i++){
              $x=$mobilenumber[$i];
              $username = urlencode('aels-enermat');
              $password = urlencode('123456');
              $numbers = urlencode($x);
              $sender = urlencode('EnerMa');
              $message = urlencode('Cargill device stopped or power failed from cron');
              $data='username='.$username.'&password='.$password.'&type=0&dlr=1&destination='.$numbers.'&source='.$sender.'&message='.$message;
              echo $data;
              $ch = curl_init('http://rt.airtelsms.com/sendsms/bulksms?'.$data);
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
              $response = curl_exec($ch);
              curl_close($ch);
              echo $response."<br>";

              $sql = "DELETE from enermate_event where id=$id";
                if(mysqli_query($conn, $sql)){
                    echo "Record was deleted successfully.";
                } 
                else{
                    echo "ERROR: Could not able to execute $sql. " 
                                                   . mysqli_error($conn);
                }
                mysqli_close($conn);
                header("location:corns.php");
              
          }
     }else{
      echo "<br>not sent<br>";
     }
   }

 ?>
<?php
 $url=$_SERVER['REQUEST_URI'];
 header("Refresh: 50; URL=\"" . $url . "\""); 
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
  <body style="font-family: 'Lato', sans-serif; font-size: 14px; color: #333; margin: 0px;  padding: 0px;  background: #eef1f5;" ><br/><br/>

      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

  </body>
  </html>
