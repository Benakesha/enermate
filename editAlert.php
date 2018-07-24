<?php
    include "eepl_db.php";

    $id=$_GET['ids'];
    
      $sql="SELECT * from enermate_alert where id=$id";
      mysqli_query($conn,$sql);
      $result = $conn->query($sql);
      while($row = $result->fetch_assoc()) {
          $alertname=$row['alertname'];
          $alert_type=$row['alert_type'];
          $location=$row['location'];
          $define_event=$row['define_event'];
          $gtltlist=$row['gtltlist'];
          $simpleThresholdValue=$row['simpleThresholdValue'];
          $custom_event=$row['custom_event'];
          $duration= $row['duration'];
          $ondays=$row['ondays'];
          $starthour=$row['startHour'];
          $startmin=$row['startMin'];
          $endhour=$row['endHour'];
          $endmin=$row['endMin'];
          $repeatday=$row['repeatday'];
          $mobileno=$row['mobileno'];
          $email=$row['email'];
          $id=$row['id'];
    }
    echo $location."<br>".$alert_type;
 
?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
         <script src="jq/jquery-3.3.1.js"></script>
        <script src="https://use.fontawesome.com/268d490d38.js"></script>
        <link rel="stylesheet" href="custom.css">
        <link rel="stylesheet" href="vendor.css">
        <title>Alert - Enermate</title>
    </head>
    <body style="font-family: 'Lato', sans-serif; font-size: 14px; color: #333; margin: 0px;  padding: 0px;  background: #eef1f5;"><br/><br/>

        <div class="container-fluid">
            <form class="form-alert" role="form" id="addAlert" action="editAlertRow.php" method="post" 
            onsubmit="return validate_alert();">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-lg padding-5">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <strong>
                                        <i class="fa fa-bell-o"></i>
                                         &nbsp;
                                         <span>Add Alert</span>
                                    </strong>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel padding-5">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>Alert Name</label>
                                    <span class="red">*</span>&nbsp;&nbsp;<span class="red" id="aNameError"></span>
                                    <input type="text" name="alertName" id="aName" class="form-control" placeholder="Enter Event Name" autofocus="true" value="<?php echo $alertname;?>"> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel padding-5">
                            <dir class="panel-body">
                                <div class="form-group">
                                    <label>Alert Type</label>
                                    <div class="input-fa-list">
                                        <div class="input-fa-radio">
                                            <input type="radio" name="atype" id="at1" <?php echo ($alert_type == 'simple') ?  "checked" : "" ;  ?> value="simple">
                                            <label>Simple Alert</label>
                                        </div>
                                        <div class="input-fa-radio">
                                            <input type="radio" name="atype"   <?php echo ($alert_type == 'complex') ?  "checked" : "" ;  ?> value="complex" id="at2">
                                            <label>Advanced Alert</label>
                                        </div>
                                    </div>
                                     <span class="red" id="aTypeError"></span>
                                </div>
                            </dir>
                        </div>
                    </div>
                </div>
                <div class="row ng-scope" >
                    <div class="col-md-12">
                        <div class="panel padding-5">
                            <div class="panel-body">
                                <div class="form-group">
                                     <label>
                                         Location
                                     <span class="red">*</span>
                                     </label>
                                     &nbsp;&nbsp; <span class="red" id="ddListError"></span>
                                    <select class="form-control input-inline" style="height: 34px;" id="ddList" name="locationlist">
                                        <option value="select">Select</option>
                                        <option  value="PRODUCTION PANEL SMSB1" <?php if ($location == "PRODUCTION PANEL SMSB1" ) echo 'selected' ; ?>>PRODUCTION PANEL SMSB1</option>
                                        <option  value="SMSB3 TEST LAB" <?php if ($location == "SMSB3 TEST LAB" ) echo 'selected' ; ?>>SMSB-3 TEST LAB</option>
                                        <option  value="SMSB2 OFFICE" <?php if ($location == "SMSB-2 OFFICE" ) echo 'selected' ; ?> >SMSB-2 OFFICE</option>
                                        <option  value="AC CONTROL GROUND FLOOR" <?php if ($location == "A/C CONTROL GROUND FLOOR" ) echo 'selected' ; ?> >A/C CONTROL GROUND FLOOR</option>
                                        <option  value="AC PANEL TERRACE" <?php if ($location == "AC PANEL TERRACE" ) echo 'selected' ; ?> >AC PANEL TERRACE</option>
                                    </select>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label >Define Event</label> 
                                    <br> <span class="red" id="defineEventError"></span>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-5" style="text-align: left;">
                                            <label>
                                                <small>
                                                    Standard Event
                                                </small>
                                            </label>
                                            <br>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <div class="input-fa-radio">
                                                            <input type="radio" name="se" value="0" <?php echo ($define_event == '0') ?  "checked" : "" ;  ?> id="def1">
                                                            <label>&nbsp;&nbsp;M.D. Breach (KW)</label> <span class="red" id="defineEventInputError"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <select class="form-control" style="height: 34px;" id="gts" name="gtlist">
                                                        <option value="1" selected="selected">&gt;</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <input type="number" name="simpleThresholdValue0" class="form-control" placeholder="Value" value="<?php  if ($define_event == '0') echo $simpleThresholdValue ; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <div class="input-fa-radio">
                                                            <input type="radio" name="se" value="1" <?php echo ($define_event == '1') ?  "checked" : "" ;  ?> id="def2">
                                                            <label>&nbsp;&nbsp;P.F Penalty</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <select class="form-control" style="height: 34px;" id="lts" name="ltlist">
                                                        <option value="2" selected="selected">&lt;</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <input type="number" name="simpleThresholdValue1" class="form-control"  placeholder="Value" value="<?php  if ($define_event == '1') echo $simpleThresholdValue ; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                             <span class="red" id="defineEventInputError1"></span>
                                        </div>
                                        <div class="col-md-2 text-center font-red-flamingo">
                                            <br><br>
                                            <b>OR</b>
                                            <br>
                                            <br>
                                        </div>
                                        <div class="col-md-5">
                                            <label>
                                                <small>Custom Event</small>
                                            </label>
                                            <br>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-1">
                                                   <div class="form-group">
                                                        <div class="input-fa-radio">
                                                            <input type="radio" name="se" value="2" <?php echo ($define_event == '2') ?  "checked" : "" ;  ?> id="def3">
                                                            <label></label> 
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                     <select class="form-control" style="height:34px;" name="ces" id="ces">
                                                     <option value="select">Select</option>
                                                     <option <?php if ($custom_event == "FREQUENCY") echo 'selected' ; ?> label="FREQUENCY" value="FREQUENCY">FREQUENCY</option>
                                                     <option <?php if ($custom_event == "KWh (DELIVERED)") echo 'selected' ; ?> label="KWh (DELIVERED)" value="KWh (DELIVERED)">KWh (DELIVERED)</option>
                                                     <option <?php if ($custom_event == "KWh") echo 'selected' ; ?> label="KWh" value="KWh">KWh</option>
                                                     <option  <?php if ($custom_event == "KVAR") echo 'selected' ; ?>label="KVAR (Y PHASE)" value="KVAR (Y PHASE)">KVAR (Y PHASE)</option>
                                                     <option  <?php if ($custom_event == "KW (Y PHASE)") echo 'selected' ; ?> label="KW (Y PHASE)" value="KW (Y PHASE)">KW (Y PHASE)</option>
                                                    <!-- <option label="KW (R PHASE)" value="KW (R PHASE)">KW (R PHASE)</option>
                                                     <option label="KVA (Y PHASE)" value="KVA (Y PHASE)">KVA (Y PHASE)</option>
                                                     <option label="KVA (R PHASE)" value="KVA (R PHASE)">KVA (R PHASE)</option>
                                                     <option label="CURRENT (R PHASE)" value="CURRENT (R PHASE)">CURRENT (R PHASE)</option>
                                                     <option label="CURRENT (Y PHASE)" value="CURRENT (Y PHASE)">CURRENT (Y PHASE)</option>
                                                     <option label="CURRENT (B PHASE)" value="CURRENT (B PHASE)">CURRENT (B PHASE)</option>
                                                     <option label="POWER FACTOR (DELIVERED)" value="POWER FACTOR (DELIVERED)">POWER FACTOR (DELIVERED)</option>
                                                     <option label="KVAh" value="KVAh">KVAh</option>
                                                     <option label="KVARh (CAPACITIVE RECEIVED)" value="KVARh (CAPACITIVE RECEIVED)">KVARh (CAPACITIVE RECEIVED)</option>
                                                     <option label="CURRENT" value="CURRENT">CURRENT</option>
                                                     <option label="KW (B PHASE)" value="KW (B PHASE)">KW (B PHASE)</option>
                                                     <option label="KVAR (R PHASE)" value="KVAR (R PHASE)">KVAR (R PHASE)</option>
                                                     <option label="KVARh (INDUCTIVE RECEIVED)" value="KVARh (INDUCTIVE RECEIVED)">KVARh (INDUCTIVE RECEIVED)</option>
                                                     <option label="KVARh (INDUCTIVE DELIVERED)" value="KVARh (INDUCTIVE DELIVERED)">KVARh (INDUCTIVE DELIVERED)</option>
                                                     <option label="RISING DEMAND" value="RISING DEMAND">RISING DEMAND</option>
                                                     <option label="FORECAST DEMAND" value="FORECAST DEMAND">FORECAST DEMAND</option>
                                                     <option label="PRESENT DEMAND" value="PRESENT DEMAND">PRESENT DEMAND</option>
                                                     <option label="CURRENT (RECEIVED)" value="CURRENT (RECEIVED)">CURRENT (RECEIVED)</option>
                                                     <option label="POWER FACTOR (RECEIVED)" value="POWER FACTOR (RECEIVED)">POWER FACTOR (RECEIVED)</option>
                                                     <option label="POWER FACTOR (R PHASE)" value="POWER FACTOR (R PHASE)">POWER FACTOR (R PHASE)</option>
                                                     <option label="POWER FACTOR (Y PHASE)" value="POWER FACTOR (Y PHASE)">POWER FACTOR (Y PHASE)</option>
                                                     <option label="VA Max Demand" value="VA Max Demand">VA Max Demand</option>
                                                     <option label="Run Hours Import" value="Run Hours Import">Run Hours Import</option>
                                                     <option label="FORWARD_RUN_SECONDS" value="FORWARD_RUN_SECONDS">FORWARD_RUN_SECONDS</option>
                                                     <option label="VOLTAGE (LN R Phase)" value="VOLTAGE (LN R Phase)">VOLTAGE (LN R Phase)</option>
                                                     <option label="Run Hours Export" value="Run Hours Export">Run Hours Export</option>
                                                     <option label="RAW Power Factor" value="RAW Power Factor">RAW Power Factor</option>
                                                     <option label="VOLTAGE (LN Y PHASE)" value="VOLTAGE (LN Y PHASE)">VOLTAGE (LN Y PHASE)</option>
                                                     <option label="VOLTAGE (LN B PHASE)" value="VOLTAGE (LN B PHASE)">VOLTAGE (LN B PHASE)</option>
                                                     <option label="CURRENT (NEUTRAL)" value="CURRENT (NEUTRAL)">CURRENT (NEUTRAL)</option>
                                                     <option label="KVA" value="KVA">KVA</option>
                                                     <option label="VOLTAGE (LL)" value="VOLTAGE (LL)">VOLTAGE (LL)</option>
                                                     <option label="VOLTAGE (LL YB Phase)" value="VOLTAGE (LL YB Phase)">VOLTAGE (LL YB Phase)</option><option label="VOLTAGE (LL BR Phase)" value="VOLTAGE (LL BR Phase)">VOLTAGE (LL BR Phase)</option><option label="CURRENT(DELIVERED)" value="CURRENT(DELIVERED)">CURRENT(DELIVERED)</option>
                                                     <option label="VOLTAGE (LN)" value="VOLTAGE (LN)">VOLTAGE (LN)</option>
                                                     <option label="CURRENT THD (B PHASE)" value="CURRENT THD (B PHASE)">CURRENT THD (B PHASE)</option><option label="CURRENT THD (Y PHASE)" value="CURRENT THD (Y PHASE)">CURRENT THD (Y PHASE)</option><option label="VOLTAGE THD (Y PHASE)" value="VOLTAGE THD (Y PHASE)">VOLTAGE THD (Y PHASE)</option><option label="VOLTAGE THD (R PHASE)" value="VOLTAGE THD (R PHASE)">VOLTAGE THD (R PHASE)</option><option label="RAW POWER FACTOR (B PHASE)" value="RAW POWER FACTOR (B PHASE)">RAW POWER FACTOR (B PHASE)</option>
                                                     <option label="RAW POWER FACTOR (R PHASE)" value="RAW POWER FACTOR (R PHASE)">RAW POWER FACTOR (R PHASE)</option>
                                                     <option label="RAW POWER FACTOR (Y PHASE)" value="RAW POWER FACTOR (Y PHASE)">RAW POWER FACTOR (Y PHASE)</option>
                                                     <option label="POWER FACTOR" value="POWER FACTOR">POWER FACTOR</option>
                                                     <option label="VOLTAGE (LL RY Phase)" value="VOLTAGE (LL RY Phase)">VOLTAGE (LL RY Phase)</option><option label="KVAR" value="KVAR">KVAR</option>
                                                     <option label="KVA (B PHASE)" value="KVA (B PHASE)">KVA (B PHASE)</option>
                                                     <option label="KVAR (B PHASE)" value="KVAR (B PHASE)">KVAR (B PHASE)</option>
                                                     <option label="KVAh (DELIVERED)" value="KVAh (DELIVERED)">KVAh (DELIVERED)</option>
                                                     <option label="KVARh (CAPACITIVE DELIVERED)" value="KVARh (CAPACITIVE DELIVERED)">KVARh (CAPACITIVE DELIVERED)</option>
                                                     <option label="POWER FACTOR (B PHASE)" value="POWER FACTOR (B PHASE)">POWER FACTOR (B PHASE)</option>
                                                     <option label="KW" value="KW" selected="selected">KW</option>
                                                     <option label="CURRENT THD (R PHASE)" value="CURRENT THD (R PHASE)">CURRENT THD (R PHASE)</option><option label="VOLTAGE THD (B PHASE)" value="VOLTAGE THD (B PHASE)">VOLTAGE THD (B PHASE)</option> -->
                                                   </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <select class="form-control" style="height: 34px;" id="gtlts" name="gtltlist">
                                                           
                                                            <option  <?php if ($gtltlist == "3") echo 'selected' ; ?> value="3">&nbsp;&nbsp;&gt;</option>
                                                            <option  <?php if ($gtltlist == '4') echo 'selected' ; ?> value="4">&nbsp;&nbsp;&lt;</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input type="number" name="simpleThresholdValue2" placeholder="Value"  class="form-control" value="<?php  if ($define_event == '2') echo $simpleThresholdValue ; ?>">
                                                    </div>
                                                </div>
                                            </div> 
                                            <span class="red" id="defineEventInputError2"></span>     
                                        </div>
                                    </div>
                                </div>
                               
                               
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel padding-5">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>Duration<span class="red">*</span></label>&nbsp;<span class="red" id="durationError"></span>
                                    <div class="input-fa-list">
                                        <div class="input-fa-radio">
                                            <input type="radio" name="duration" value="2" <?php echo ($duration == '2') ?  "checked" : "" ;  ?> id="d1">
                                            <label>2 mins</label>
                                        </div>
                                        <div class="input-fa-radio">
                                            <input type="radio" name="duration" value="5" <?php echo ($duration == '5') ?  "checked" : "" ;  ?> id="d2">
                                            <label>5 mins</label>
                                        </div>
                                        <div class="input-fa-radio">
                                            <input type="radio" name="duration" value="15" <?php echo ($duration == '15') ?  "checked" : "" ;  ?> id="d3">
                                            <label>15 mins</label>
                                        </div>
                                        <div class="input-fa-radio">
                                            <input type="radio" name="duration" value="30" <?php echo ($duration == '30') ?  "checked" : "" ;  ?> id="d4">
                                            <label>30 mins</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>On Days<span class="red">*</span></label>&nbsp;
                                    <span class="red" id="onDayError"></span>
                                    <div class="input-fa-list">
                                        <div class="input-fa-radio">
                                            <input type="radio" name="day" value="-1"  <?php echo ($ondays == '-1') ?  "checked" : "" ;  ?> id="od1">
                                            <label>All</label>
                                        </div>
                                        <div class="input-fa-radio">
                                            <input type="radio" name="day" value="2" <?php echo ($ondays == '2') ?  "checked" : "" ;  ?>   id="od2">
                                            <label>Mon</label>
                                        </div>
                                         <div class="input-fa-radio">
                                            <input type="radio" name="day" value="3"  <?php echo ($ondays == '3') ?  "checked" : "" ;  ?>  id="od3">
                                            <label>Tue</label>
                                        </div>
                                         <div class="input-fa-radio">
                                            <input type="radio" name="day" value="4"  <?php echo ($ondays == '4') ?  "checked" : "" ;  ?>  id="od4">
                                            <label>Wed</label>
                                        </div>
                                         <div class="input-fa-radio">
                                            <input type="radio" name="day" value="5" <?php echo ($ondays == '5') ?  "checked" : "" ;  ?>  id="od5">
                                            <label>Thu</label>
                                        </div>
                                         <div class="input-fa-radio">
                                            <input type="radio" name="day" value="6"  <?php echo ($ondays == '6') ?  "checked" : "" ;  ?>  id="od6">
                                            <label>Fri</label>
                                        </div>
                                         <div class="input-fa-radio">
                                            <input type="radio" name="day" value="7" <?php echo ($ondays == '7') ?  "checked" : "" ;  ?>  id="od7">
                                            <label>Sat</label>
                                        </div>
                                         <div class="input-fa-radio">
                                            <input type="radio" name="day" value="1" <?php echo ($ondays == '1') ?  "checked" : "" ;  ?>  id="od8">
                                            <label>Sun</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>During Time<span class="red">*</span></label>&nbsp;<span class="red" id="duringTimeError"></span>
                                    <div class="row ">
                                        <div class="col-md-5">
                                            <div class="col-md-5 nopadding">
                                                <select class="form-control" style="height: 34px;"  id="strtHour" name="starthour">
                                                    <option value="select">Hour</option>
                                                    <option  <?php if ($starthour == "00") echo 'selected' ; ?> value="00">00</option>
                                                    <option   <?php if ($starthour == "01") echo 'selected' ; ?> value="01">01</option>
                                                    <option   <?php if ($starthour == "02") echo 'selected' ; ?> value="02">02</option>
                                                    <option   <?php if ($starthour == "03") echo 'selected' ; ?> value="03">03</option>
                                                    <option   <?php if ($starthour == "04") echo 'selected' ; ?> value="04">04</option>
                                                    <option   <?php if ($starthour == "05") echo 'selected' ; ?> value="05">05</option>
                                                    <option value="06"  <?php if ($starthour == "06") echo 'selected' ; ?> >06</option>
                                                    <option value="07"  <?php if ($starthour == "07") echo 'selected' ; ?> >07</option>
                                                    <option value="08"   <?php if ($starthour == "08") echo 'selected' ; ?>>08</option>
                                                    <option value="09"   <?php if ($starthour == "09") echo 'selected' ; ?>>09</option>
                                                    <option value="10"   <?php if ($starthour == "10") echo 'selected' ; ?>>10</option>
                                                    <option value="11"   <?php if ($starthour == "11") echo 'selected' ; ?>>11</option>
                                                    <option value="12"   <?php if ($starthour == "12") echo 'selected' ; ?>>12</option>
                                                    <option value="13"   <?php if ($starthour == "13") echo 'selected' ; ?>>13</option>
                                                    <option value="14"   <?php if ($starthour == "14") echo 'selected' ; ?>>14</option>
                                                    <option value="15"   <?php if ($starthour == "15") echo 'selected' ; ?>>15</option>
                                                    <option value="16"   <?php if ($starthour == "16") echo 'selected' ; ?>>16</option>
                                                    <option value="17"   <?php if ($starthour == "17") echo 'selected' ; ?>>17</option>
                                                    <option value="18"   <?php if ($starthour == "18") echo 'selected' ; ?>>18</option>
                                                    <option value="19"   <?php if ($starthour == "19") echo 'selected' ; ?>>19</option>
                                                    <option value="20"   <?php if ($starthour == "20") echo 'selected' ; ?>>20</option>
                                                    <option value="21"   <?php if ($starthour == "21") echo 'selected' ; ?>>21</option>
                                                    <option value="22"   <?php if ($starthour == "22") echo 'selected' ; ?>>22</option>
                                                    <option value="23"   <?php if ($starthour == "23") echo 'selected' ; ?>>23</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2 text-center nopadding">:</div>
                                            <div class="col-md-5 nopadding">
                                                <select class="form-control" style="height: 34px;" id="strtMin" name="startmin">
                                                    <option value="select">Min</option>
                                                    <option  <?php if ($startmin == "00") echo 'selected' ; ?> value="00">00</option>
                                                    <option  <?php if ($startmin == "30") echo 'selected' ; ?> value="30">30</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-2 text-center text-left-sm">to</div>
                                        <div class="col-md-5">
                                            <div class="col-md-5 nopadding">
                                                <select class="form-control" style="height: 34px;" id="endHour" name="endhour">
                                                     <option value="select">Hour</option>
                                                    <option  <?php if ($endhour == "00") echo 'selected' ; ?> value="00">00</option>
                                                    <option   <?php if ($endhour == "01") echo 'selected' ; ?> value="01">01</option>
                                                    <option   <?php if ($endhour == "02") echo 'selected' ; ?> value="02">02</option>
                                                    <option   <?php if ($endhour == "03") echo 'selected' ; ?> value="03">03</option>
                                                    <option   <?php if ($endhour == "04") echo 'selected' ; ?> value="04">04</option>
                                                    <option   <?php if ($endhour == "05") echo 'selected' ; ?> value="05">05</option>
                                                    <option value="06"  <?php if ($endhour == "06") echo 'selected' ; ?> >06</option>
                                                    <option value="07"  <?php if ($endhour == "07") echo 'selected' ; ?> >07</option>
                                                    <option value="08"   <?php if ($endhour == "08") echo 'selected' ; ?>>08</option>
                                                    <option value="09"   <?php if ($endhour == "09") echo 'selected' ; ?>>09</option>
                                                    <option value="10"   <?php if ($endhour == "10") echo 'selected' ; ?>>10</option>
                                                    <option value="11"   <?php if ($endhour == "11") echo 'selected' ; ?>>11</option>
                                                    <option value="12"   <?php if ($endhour == "12") echo 'selected' ; ?>>12</option>
                                                    <option value="13"   <?php if ($endhour == "13") echo 'selected' ; ?>>13</option>
                                                    <option value="14"   <?php if ($endhour == "14") echo 'selected' ; ?>>14</option>
                                                    <option value="15"   <?php if ($endhour == "15") echo 'selected' ; ?>>15</option>
                                                    <option value="16"   <?php if ($endhour == "16") echo 'selected' ; ?>>16</option>
                                                    <option value="17"   <?php if ($endhour == "17") echo 'selected' ; ?>>17</option>
                                                    <option value="18"   <?php if ($endhour == "18") echo 'selected' ; ?>>18</option>
                                                    <option value="19"   <?php if ($endhour == "19") echo 'selected' ; ?>>19</option>
                                                    <option value="20"   <?php if ($endhour == "20") echo 'selected' ; ?>>20</option>
                                                    <option value="21"   <?php if ($endhour == "21") echo 'selected' ; ?>>21</option>
                                                    <option value="22"   <?php if ($endhour == "22") echo 'selected' ; ?>>22</option>
                                                    <option value="23"   <?php if ($endhour == "23") echo 'selected' ; ?>>23</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2 text-center nopadding">:</div>
                                            <div class="col-md-5 nopadding">
                                                <select class="form-control" style="height: 34px;" id="endMin" name="endmin" >
                                                    <option value="select">Min</option>
                                                    <option  <?php if ($endmin == "00") echo 'selected' ; ?> value="00">00</option>
                                                    <option  <?php if ($endmin == "30") echo 'selected' ; ?> value="30">30</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div><span class="red" id="duringTimeHourError"></span>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label>Repeat Every<span class="red">*</span></label>
                                    &nbsp;<span class="red" id="repeatDayError"></span>
                                    <div class="input-fa-list">
                                        <div class="input-fa-radio">
                                            <input type="radio" name="thresholdDuration"  <?php echo ($repeatday == '30') ?  "checked" : "" ;  ?> value="30"  id="td1">
                                            <label>30 mins</label>
                                        </div>
                                        <div class="input-fa-radio">
                                            <input type="radio" name="thresholdDuration" <?php echo ($repeatday == '60') ?  "checked" : "" ;  ?> value="60"  id="td2">
                                            <label>1 hour</label>
                                        </div>
                                        <div class="input-fa-radio">
                                            <input type="radio" name="thresholdDuration" <?php echo ($repeatday == '360') ?  "checked" : "" ;  ?> value="360" id="td3">
                                            <label>6 hour</label>
                                        </div>
                                        <div class="input-fa-radio">
                                            <input type="radio" name="thresholdDuration" <?php echo ($repeatday == '1440') ?  "checked" : "" ;  ?> value="1440"  id="td4">
                                            <label>1 day</label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel padding-5">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>SMS Log</label> &nbsp;&nbsp;<span class="red" id="mobileError"></span>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Mobile Numbers" name="mobileNum"  maxlength="52" id="mNumber" value="<?php echo $mobileno;?>">
                                        <div class="input-group-addon">
                                            <i class="fa fa-bell-o" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                   <em class="help-block font-grey">comma separated, 4 mobile number allowed</em>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label>Email Log</label>&nbsp;&nbsp;<span class="red" id="emailError"></span>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Email Addresses" name="email" id="emailList" value="<?php echo $email;?>">
                                        <div class="input-group-addon">
                                            <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <em class="help-block font-grey">comma separated, 10 email  allowed</em>
                                </div>
                           </div>
                        </div>
                    </div>
                </div>
                 <div class="form-group">
                  <input type="text" name="id" value="<?php echo $id;?>" style="display:none;" class="form-control">
                </div>
                <br>

                <div class="row">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary" id="btnsave" 
                        name="form_submit">
                            &nbsp;&nbsp;SAVE&nbsp;&nbsp;
                        </button>
                         <button type="button" class="btn" id="btnreset">
                            &nbsp;&nbsp;RESET&nbsp;&nbsp;
                        </button>
                    </div>
                </div> 
            </form>
       </div>
       <div class="btn-group-float">
           <button class="btn btn-primary btn-lg btn-round">
               <i class="fa fa-line-chart"></i>Analyse
           </button>
       </div>
    <br>
    <br>  
    <div class="container-fluid ng-scope">
        <div class="row">
            <div class="col-md-12">
                <div class="footer text-center">
                    2018 © Enermate Energy Pvt Ltd.
                </div>
            </div>
        </div>
    </div><br><br>  

  
            

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  </body>
</html>
<script type="text/javascript">
   
   $('#btnreset').on('click', function()
    { 
        $('#addAlert').find('input:text,input:number,select').val('');
        $('#addAlert').find('input:radio, input:checkbox').prop('checked', false);
    });

    // submitting form
 
  function validate_alert(){ 

     //alert Name Validation
    var alertName= $('#aName').val();
    if(alertName == ''){
        document.getElementById('aNameError').innerText="Please provide alert name";
       // return false;
    }else{
         document.getElementById('aNameError').innerText = "";
        // return true;
    }

 //alert type validation
    var aType1=$('#at1').is(':checked');
    var aType2=$('#at2').is(':checked');

    if((aType1 == false) && (aType2 == false)){
        document.getElementById('aTypeError').innerText="Please select alert type";
        return false;
    }else if(aType1 == true){
        
         document.getElementById('aTypeError').innerText = "";
       //  return true;
    
    }else if(aType2 == true){
    
        document.getElementById('aTypeError').innerText = "";
      //  return true;
    
    }
 //Location  Validation    
    var ddList=$('#ddList option:selected').val();
    if(ddList == 'select'){

        document.getElementById('ddListError').innerText="Please select location";
        return false;
    }else{
        document.getElementById('ddListError').innerText = "";
        //return true;
    }

 //define event validation
     var def1=$('#def1').is(':checked');
     var def2=$('#def2').is(':checked');
     var def3=$('#def3').is(':checked');

         if((def1 == false) && (def2 == false) && (def3 == false)){
              document.getElementById('defineEventError').innerText="Please select standard or custom event";
             // return false;

         }else if(def1 == true){
                document.getElementById('defineEventError').innerText="";
                var stv0=$('#addAlert').find('input[name="simpleThresholdValue0"]').val();
                var gts=$("#gts option:selected").val();
                if(stv0 == ""){
                    document.getElementById('defineEventInputError').innerText="Provide M.D Breach value";
                       return false;
                    }else{
                        document.getElementById('defineEventInputError').innerText = "";
                 
                    }
        }else if(def2 == true){
                document.getElementById('defineEventError').innerText="";
                var stv1=$('#addAlert').find('input[name="simpleThresholdValue1"]').val();
                var lts=$("#lts option:selected").val();
                if(stv1 == ""){
                       document.getElementById('defineEventInputError1').innerText="Provide P.F Penalty value";
                       return false;
                }else{
                         document.getElementById('defineEventInputError1').innerText = "";
                     
                }
            
        }else if(def3 == true){
            document.getElementById('defineEventError').innerText="";
            var stv2=$('#addAlert').find('input[name="simpleThresholdValue2"]').val();
            var ces=$('#ces option:selected').val();
            
            if(ces == 'select'){
                document.getElementById('defineEventInputError2').innerText="Please select location";
                return false;
            }else{
               
               if(stv2 == ""){
                    document.getElementById('defineEventInputError2').innerText="Provide Custom Event value";
                    return false;
                }else{
                      document.getElementById('defineEventInputError2').innerText = "";
                 
                }

            }

        } 
            
            
    


    // Duration Validation           
       var duration1=$('#d1').is(':checked');
       var duration2=$('#d2').is(':checked');
       var duration3=$('#d3').is(':checked');
       var duration4=$('#d4').is(':checked');

       if((duration1 == false) && (duration2 == false) && (duration3 == false) && (duration4 == false)){
                document.getElementById('durationError').innerText ="Please select duration";
                return false;
       }else{
         document.getElementById('durationError').innerText = "";
        // return true;
       }
 




   //During Time Validation

    var strtHour=$('#strtHour option:selected').val();
    var strtMin=$('#strtMin option:selected').val();

    var endHour=$('#endHour option:selected').val();
    var endMin=$('#endMin option:selected').val();

    if((strtHour == 'select') || (strtMin == 'select') || (endHour == 'select') || (endMin == 'select')){
        document.getElementById('duringTimeError').innerText = "Please select start time and end time";
       // return false;
    }else{
        document.getElementById('duringTimeError').innerText = "";
        //turn true;
         if(strtHour == '00'){
            document.getElementById('duringTimeHourError').innerText ="start hour cann't be zero";
            return false;
        }else{
            document.getElementById('duringTimeHourError').innerText ="";
           //  return true;
        }
    }


   

 //Days Validation
    var day1= $('#od1').is(':checked'),
      day2= $('#od2').is(':checked'),
      day3= $('#od3').is(':checked'),
      day4= $('#od4').is(':checked'),
      day5= $('#od5').is(':checked'),
      day6= $('#od6').is(':checked'),
      day7= $('#od7').is(':checked'),
      day8= $('#od8').is(':checked');
  
 if((day1 == false) && (day2 == false) && (day3 == false) && (day4 == false) &&
       (day5 == false) && (day6 == false) && (day7 == false) && (day8 == false)){
         document.getElementById('onDayError').innerText ="Please select days";
        return false;
      }else{
        document.getElementById('onDayError').innerText ="";
       // return true;
       }
  
  
   //Repeat Alert

    var td1=$('#td1').is(':checked');
    var td2=$('#td2').is(':checked');
    var td3=$('#td3').is(':checked');
    var td4=$('#td4').is(':checked');

    if((td1 == false ) && (td2 == false) && (td3 == false) && (td4 == false)){
        document.getElementById('repeatDayError').innerText="Please select repeat time";
        return false;
    }else{
        document.getElementById('repeatDayError').innerText="";
       // return true;
    }

    //Mobile Number Validation

    var mNumber=$('#mNumber').val();
     if(mNumber == ""){
         document.getElementById('mobileError').innerText="";
         return true;
    }else{
        var marray=$('#mNumber').val().split(",");
        var mLen=marray.length;
       
        if(mLen <= 4){
            for (var i=0;i<marray.length;i++){
                var num=marray[i];
                //num.toString();
                var regm=num.match(/^\d{10}$/);
                if(regm){
                      document.getElementById('mobileError').innerText="";
                      //return true;
                      //console.log(num);
                }else{
                    document.getElementById('mobileError').innerText="Please enter valid mobile number";
                    return false;
                }
            }
        }else{
               document.getElementById('mobileError').innerText="max limit reached";
               return false;
         }
    }

    
    //Email Validation  /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
    var emailList=$('#emailList').val();
   
    if(emailList == ""){
        console.log("no emails");
    }else{
   
        var emailarray=$('#emailList').val().split(",");
        var eLen=emailarray.length;
        if(eLen <= 10){    
            for(var j=0;j<=emailarray.length;j++){
                var email=emailarray[j];

                var epreg=email.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/);
                if(epreg){
                    document.getElementById('emailError').innerText="";
                    //return true;
                }else{
                    document.getElementById('emailError').innerText="Please enter valid email";
                    return false; 
                }

             }
        }else{
           document.getElementById('emailError').innerText="max limit reached";
           return false;
        }
    }
}



 

</script>


