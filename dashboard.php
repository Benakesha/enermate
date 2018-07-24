<script src="Scripts/amcharts.js"></script>
<script src="Scripts/gauge.js"></script>
<?php include "eepl_db.php"; ?>
<?php

date_default_timezone_set("Asia/calcutta");   
 
    $Da=date("d");   
    $mo=date("m");                                    
    $Ye=date("Y");
    $x1=Array();  $x1a=Array(); $x1ad=Array();
    $x2=Array(); $x2a=Array(); $x2b=Array(); $x2d=Array();
    $x3=Array(); $x3a=Array(); $x3b=Array(); $x3d=Array();
    $x4=Array();$x4a=Array();$x4b=Array(); $x4d=Array();
   
    
    ?>
    
    
         
 
     
     
         
         
         
         	
    
    <?php
         
 if ($C>=50.00 && $C<50.05)      
 {                                                                 

$RDC=50.05-$C;

$rate=$RDC* 35.6 *100;
                          
}

elseif ($C>=50.05 && $C <50.1)      
 {                                                                 

$RDC=50.05-$C;

$rate=0;
                                       	
                         
}

elseif ($C>=49.70 && $C<50.00)      
{                                                                 


$RDC=50.00-$C;

$rate=($RDC* 20.84 *100)+178;


}

elseif ($C<49.7 && $C>= 49.0)      
{                                                                 

$RDC=50.5-$C;

$rate=824.04;
                                     	                        
}
 
 elseif ($C>= 50.10)      
{                                                                 

$RDC=50.5-$C;

$rate=-178.00;
                                       	                        
}  
        
?>
<?php
$rate1 = number_format($rate, 2);
?>






<?php 

  date_default_timezone_set("Asia/calcutta");   
  $Da1 = date('Y-m-01');
  $CurrentDate= date("Y-m-d");
 
  $FullDateFrom=date("Y-m-d",strtotime($Da1));	
  $FullDateTo=date("Y-m-d",strtotime($CurrentDate));
 
 
 // $con=mysql_connect('localhost','enermate','eepl12345#')or die(mysql_error());
 // mysql_select_db('enermate_db',$con) or die(mysql_error());
  
   $sql="select id,Frequncy,ACTIVE_POWER,2Active_Import,Active_Import,Voltage_BR,Voltage_RY,Voltage_YB,Current_R,Current_Y,Current_B,Timeslot,Time,Date,PF, 2Current_R, 2Current_Y,2Current_B,2ACTIVE_POWER,2PF from modbusmanagement1 where Date(Time)>= '$FullDateFrom' and Date(Time)<='$FullDateTo'";
  $res=mysqli_query($conn,$sql) or die(mysqli_error()); 
   
       $slot=0;
       $BLOCK=0;
       $READ=1;
       $ActualExp=0;
       $Frequency=0;
       $INI=0;
       $INI2=0;
       $INI3=0;
       $NN=1;
       $INITIME=0;
       $INIDAY=0;
       $INIDAY2=0;
       $INIDAY3=0;
       $initime=0;
       $finaltime=0;
       $timediff=0;
       $lasttime=0;
       $lastmin=0;
       $lastsec=0;
       $lasthour=0;
       $lastimport=0;
       $importactualfinal=0;
       $importactualfinal15mins=0;
       $importactual=0;
        while($row1=mysqli_fecth_assoc($res))
        {
          // echo "hello";
           $row=$row1;
           $slot+=1;
           if( $READ==1)
           {
          	 $INI=$row['Active_Import'];
          	 $INIDAY=$row['Active_Import'];
           	 $INIDAY2=$row['2Active_Import'];
          	 $INI2=$row['2Active_Import'];
         	 $INIDAY3=$row['3Active_Import'];
          	 $INI3=$row['3Active_Import'];
          	 $INIHOUR1=date_format($date,"H");
         	 $INIHOUR2=date_format($date,"H");
           }
         	
         	$Current_R1=$row['Current_R'];
			$Current_Y1=$row['Current_Y'];
			$Current_B1=$row['Current_B'];
			$Voltage_RY1=$row['Voltage_RY'];
		        $Voltage_YB1=$row['Voltage_YB'];
		        $Voltage_BR1=$row['Voltage_BR'];
		         $Frequency1=$row['Frequncy'];
			$PF1=$row['PF'];
			$ACTIVE_POWER1=$row['ACTIVE_POWER']/1000;
			//$ACTIVE_POWER1 = number_format($ACTIVE_POWER1, 0);
			
			$Current_R2=$row['2Current_R'];
			$Current_Y2=$row['2Current_Y'];
			$Current_B2=$row['2Current_B'];
			$Active_Import2=$row['2Active_Import'];
			$PF2=$row['2PF'];
			$ACTIVE_POWER2=$row['2ACTIVE_POWER']/1000;
         	
         	
         	
         	  $ActualExp+=$row['Active_Import'];
         	  $Frequency+=$row['Frequncy'];
          	  $Frequency+=$row['block'];
         	  $UDIFF+=$row['UNITSDIFF'];
         	  $UIPEN+= $row['UIPEN'];
         	  $UIEXC+= $row['UIEXC'];
          	  $UNITS=($row['Active_Import']-$INI)/1000;
          	  $UNITS2=($row['2Active_Import']-$INI2)/1000;
         
         // if($selectVal == 'report1' or $selectVal == 'report2'){
           	$UNITS3=($row['3Active_Import']-$INI3);
          //}else if($selectVal == 'report3' or $selectVal == 'report4'){
          // 	$UNITS3=($row['3Active_Import']-$INI3)/1000;
          //}  
               	 $HOUR=date_format($date,"H")-$INIHOUR1;
          	 $avgkw=($UNITS/(1000 * $HOUR));
         	 $avgkw1=($UNITS/(1000 * ($HOUR+1)));
                 $avgkw2=($UNITS2/(1000 * $HOUR));
           	 $avgkw22=($UNITS2/(1000 * ($HOUR+1)));
              	 $avgkw3=($UNITS3/(1000 * $HOUR));
          	 $avgkw33=($UNITS3/(1000 * ($HOUR+1)));
               	$UNITSDAY= ($row['Active_Import']-$INIDAY)/1000;
           	$UNITSDAY= number_format($UNITSDAY, 0);
           	$UNITSDAY2= ($row['2Active_Import']-$INIDAY2)/1000;
           	$UNITSDAY2= number_format($UNITSDAY2,0);
               
          // if($selectVal == 'report1' or $selectVal == 'report2'){
          	 $UNITSDAY3= ($row['3Active_Import']-$INIDAY3);
           //}else if($selectVal == 'report3' or $selectVal == 'report4'){
          // 	 $UNITSDAY3= ($row['3Active_Import']-$INIDAY3)/1000;
	 //  }
	 	$UNITSDAY3= number_format($UNITSDAY3, 0);
           	$FEQLAST=$row['Frequncy'];
           	$READ++;
           	$HOUR=$INIHOUR;
          	$initime=date_create_from_format("Y-m-d H:i:s",$row['Time']);
           	$inimin=(date_format($initime,"i"));
           	$inisec=(date_format($initime,"s"));
           	$inihour=(date_format($initime,"H"));
           	$diffhour=$inihour-$lasthour;
           	$diffmin=$inimin-$lastmin;
           	$diffsec=$inisec-$lastsec;
           	$timediff= (($diffhour*60*60)+($diffmin*60)+($diffsec))/(3600);
          	$importactual=$row['ACTIVE_POWER']*$timediff;
           	$importactualfinal=$importactual+$lastimport;
          	$importactualfinal15mins=$importactualfinal-$lastimport;
           	$importactualfinal = number_format($importactualfinal, 0);
           	$importactualfinal15mins = number_format($importactualfinal15mins, 0);
          	$avgkw = number_format($avgkw, 2);
         	$avgkw1 = number_format($avgkw1, 2);
          	$avgkw2 = number_format($avgkw2, 2);
           	$avgkw22 = number_format($avgkw22, 2);
         	$avgkw3 = number_format($avgkw3, 2);
	   	$avgkw33 = number_format($avgkw33, 2);
	  	$date=date_create_from_format("Y-m-d H:i:s",$row['Time']);
        if ($FEQLAST>0)
           {  	$SCHLAST=$row['Schedule'];
           }
        if ($NN==1)
          {   	 $INIHOUR=date_format($date,"H");
         	 $INIMIN=date_format($date,"i");
          }
       if((date_format($date,"H")==0) or (date_format($date,"H")==1) or (date_format($date,"H")==2)or (date_format($date,"H")==3)or (date_format($date,"H")==4)or (date_format($date,"H")==5) )
           {	 $INIHOUR=date_format($date,"H");
         	 $INITMIN=date_format($date,"i");
           }
       if ( (date_format($date,"H") != $INIHOUR)&& (date_format($date,"i") != $INIMIN) )
           {     $NN=1;
           }
            if ((((date_format($date,"H")==0) or (date_format($date,"H")==1)  or (date_format($date,"H")==2)or (date_format($date,"H")==3)or (date_format($date,"H")==4) or (date_format($date,"H")==5) ) and $NN==1)  )
        
         {
         if ($BLOCK>0)
           { 
          if ($BLOCK==1)
           {  	$avgkw=$avgkw1;
           	$DATESLOT=date_format($date,"d")-1;
           	
           }else{
           	 $DATESLOT=date_format($date,"d");
           	
           }
         if(date_format($date,"H")==0)
           {
           	$slot1kw=$UNITS+$slot1kw;
          	$slotlastkw=$UNITS;
           }elseif(date_format($date,"H")==6 )
             { 
             	$slot2kw=$UNITS+$slot2kw;
             }elseif(date_format($date,"H")==18 )
               {
           	$slot3kw+=$UNITS;
               }elseif(date_format($date,"H")==22 )
               {
           	$slot4kw+=$UNITS;
               }           
          $UNITS= number_format($UNITS, 0);
      
        		$x1[]=$UNITS;
        		
        		$x1a[]=$UNITS2;
        		$x1ad[]= $DATESLOT.'-'.date_format($date,"m").'-'.date_format($date,"y") ;
        		
        		
        		
         }
  	 $NN++;
  	 $INI=$row['Active_Import'];
  	 $INI2=$row['2Active_Import'];
  	 $INI3=$row['3Active_Import'];
   	 $INIHOUR1=date_format($date,"H");
  	 $BLOCK++;
   if ($BLOCK==2)
   {
  	 $BLOCK=1;
   }
  	$lasttime=date_create_from_format("Y-m-d H:i:s",$row['Time']);
        $lastmin=(date_format($lasttime,"i"));
        $lastsec=(date_format($lasttime,"s"));
        $lasthour=(date_format($lasttime,"H"));
        $lastimport=$importactual+$lastimport;	
   }
 	}$x1[]= $UNITS; 
 	$x1a[]=$UNITS2;
 	$x1ad[]=date_format($date,"d").'-'.date_format($date,"m").'-'.date_format($date,"y");
 	
 	  
 ?>         
 
 <?php 

  date_default_timezone_set("Asia/calcutta");   
  $Da1 = date('Y-m-01');
  $CurrentDate= date("Y-m-d");
 
  $FullDateFrom=date("Y-m-d",strtotime($Da1));	
  $FullDateTo=date("Y-m-d",strtotime($CurrentDate));
 
 
 // $con=mysql_connect('localhost','enermate','eepl12345#')or die(mysql_error());
  //mysql_select_db('enermate_db',$con) or die(mysql_error());
  
   $sql="select id,Frequncy,ACTIVE_POWER,2Active_Import,Active_Import,3Active_Import,Voltage_BR,Voltage_RY,Voltage_YB,Current_R,Current_Y,Current_B,Timeslot,Time, Date,PF,2Current_R,2Current_Y,2Current_B,2ACTIVE_POWER,2PF,3Current_R,3Current_Y,3Current_B,3Active_Import,3ACTIVE_POWER,3PF from modbusmanagement2 where Date(Time)>= '$FullDateFrom' and Date(Time)<='$FullDateTo'";
  $res=mysqli_query($conn,$sql) or die(mysqli_error()); 
   
       $slot=0;
       $BLOCK=0;
       $READ=1;
       $ActualExp=0;
       $Frequency=0;
       $INI=0;
       $INI2=0;
       $INI3=0;
       $NN=1;
       $INITIME=0;
       $INIDAY=0;
       $INIDAY2=0;
       $INIDAY3=0;
       $initime=0;
       $finaltime=0;
       $timediff=0;
       $lasttime=0;
       $lastmin=0;
       $lastsec=0;
       $lasthour=0;
       $lastimport=0;
       $importactualfinal=0;
       $importactualfinal15mins=0;
       $importactual=0;
        while($row1=mysqli_fecth_assoc($res))
        {
          // echo "hello";
           $row=$row1;
           $slot+=1;
           if( $READ==1)
           {
          	 $INI=$row['Active_Import'];
          	 $INIDAY=$row['Active_Import'];
           	 $INIDAY2=$row['2Active_Import'];
          	 $INI2=$row['2Active_Import'];
         	 $INIDAY3=$row['3Active_Import'];
          	 $INI3=$row['3Active_Import'];
          	 $INIHOUR1=date_format($date,"H");
         	 $INIHOUR2=date_format($date,"H");
           }
           $Current_R3=$row['Current_R'];
		$Current_Y3=$row['Current_Y'];
		$Current_B3=$row['Current_B'];
		
		$Active_Import3=$row['Active_Import'];
		$PF3=$row['PF'];
		$ACTIVE_POWER3=$row['ACTIVE_POWER']/1000;
		
		$Current_R4=$row['2Current_R'];
		$Current_Y4=$row['2Current_Y'];
		$Current_B4=$row['2Current_B'];
		$Active_Import4=$row['2Active_Import'];
		$PF4=$row['2PF'];
		$ACTIVE_POWER4=$row['2ACTIVE_POWER']/1000;
		
		$Current_R5=$row['3Current_R'];
		$Current_Y5=$row['3Current_Y'];
		$Current_B5=$row['3Current_B'];
		$Active_Import5=$row['3Active_Import'];
		$PF5=$row['3PF'];
		$ACTIVE_POWER5=$row['3ACTIVE_POWER'];
		
		//$ACTIVE_POWER3 = number_format($ACTIVE_POWER3, 0);
		//$ACTIVE_POWER4 = number_format($ACTIVE_POWER4, 0);
               //  $ACTIVE_POWER5 = number_format($ACTIVE_POWER5, 0);
		
           
           
         	  $ActualExp+=$row['Active_Import'];
         	  $Frequency+=$row['Frequncy'];
          	  $Frequency+=$row['block'];
         	  $UDIFF+=$row['UNITSDIFF'];
         	  $UIPEN+= $row['UIPEN'];
         	  $UIEXC+= $row['UIEXC'];
          	  $UNITS=($row['Active_Import']-$INI)/1000;
          	  $UNITS2=($row['2Active_Import']-$INI2)/1000;
         
         // if($selectVal == 'report1' or $selectVal == 'report2'){
           	$UNITS3=($row['3Active_Import']-$INI3);
          //}else if($selectVal == 'report3' or $selectVal == 'report4'){
          // 	$UNITS3=($row['3Active_Import']-$INI3)/1000;
          //}  
               	 $HOUR=date_format($date,"H")-$INIHOUR1;
          	 $avgkw=($UNITS/(1000 * $HOUR));
         	 $avgkw1=($UNITS/(1000 * ($HOUR+1)));
                 $avgkw2=($UNITS2/(1000 * $HOUR));
           	 $avgkw22=($UNITS2/(1000 * ($HOUR+1)));
              	 $avgkw3=($UNITS3/(1000 * $HOUR));
          	 $avgkw33=($UNITS3/(1000 * ($HOUR+1)));
               	$UNITSDAY= ($row['Active_Import']-$INIDAY)/1000;
           	$UNITSDAY= number_format($UNITSDAY, 0);
           	$UNITSDAY2= ($row['2Active_Import']-$INIDAY2)/1000;
           	$UNITSDAY2= number_format($UNITSDAY2, 0);
               
          // if($selectVal == 'report1' or $selectVal == 'report2'){
          	 $UNITSDAY3= ($row['3Active_Import']-$INIDAY3);
           //}else if($selectVal == 'report3' or $selectVal == 'report4'){
          // 	 $UNITSDAY3= ($row['3Active_Import']-$INIDAY3)/1000;
	 //  }
	 	$UNITSDAY3= number_format($UNITSDAY3, 0);
           	$FEQLAST=$row['Frequncy'];
           	$READ++;
           	$HOUR=$INIHOUR;
          	$initime=date_create_from_format("Y-m-d H:i:s",$row['Time']);
           	$inimin=(date_format($initime,"i"));
           	$inisec=(date_format($initime,"s"));
           	$inihour=(date_format($initime,"H"));
           	$diffhour=$inihour-$lasthour;
           	$diffmin=$inimin-$lastmin;
           	$diffsec=$inisec-$lastsec;
           	$timediff= (($diffhour*60*60)+($diffmin*60)+($diffsec))/(3600);
          	$importactual=$row['ACTIVE_POWER']*$timediff;
           	$importactualfinal=$importactual+$lastimport;
          	$importactualfinal15mins=$importactualfinal-$lastimport;
           	$importactualfinal = number_format($importactualfinal, 0);
           	$importactualfinal15mins = number_format($importactualfinal15mins, 0);
          	$avgkw = number_format($avgkw, 2);
         	$avgkw1 = number_format($avgkw1, 2);
          	$avgkw2 = number_format($avgkw2, 2);
           	$avgkw22 = number_format($avgkw22, 2);
         	$avgkw3 = number_format($avgkw3, 2);
	   	$avgkw33 = number_format($avgkw33, 2);
	  	$date=date_create_from_format("Y-m-d H:i:s",$row['Time']);
        if ($FEQLAST>0)
           {  	$SCHLAST=$row['Schedule'];
           }
        if ($NN==1)
          {   	 $INIHOUR=date_format($date,"H");
         	 $INIMIN=date_format($date,"i");
          }
       if((date_format($date,"H")==0) or (date_format($date,"H")==1) or (date_format($date,"H")==2)or (date_format($date,"H")==3)or (date_format($date,"H")==4)or (date_format($date,"H")==5) )
           {	 $INIHOUR=date_format($date,"H");
         	 $INITMIN=date_format($date,"i");
           }
       if ( (date_format($date,"H") != $INIHOUR)&& (date_format($date,"i") != $INIMIN) )
           {     $NN=1;
           }
            if ((((date_format($date,"H")==0) or (date_format($date,"H")==1)  or (date_format($date,"H")==2)or (date_format($date,"H")==3)or (date_format($date,"H")==4) or (date_format($date,"H")==5) ) and $NN==1)  )
        
         {
         if ($BLOCK>0)
           { 
          if ($BLOCK==1)
           {  	$avgkw=$avgkw1;
           	$DATESLOT=date_format($date,"d")-1;
           }else{
           	 $DATESLOT=date_format($date,"d");
           }
         if(date_format($date,"H")==0)
           {
           	$slot1kw=$UNITS+$slot1kw;
          	$slotlastkw=$UNITS;
           }elseif(date_format($date,"H")==6 )
             { 
             	$slot2kw=$UNITS+$slot2kw;
             }elseif(date_format($date,"H")==18 )
               {
           	$slot3kw+=$UNITS;
               }elseif(date_format($date,"H")==22 )
               {
           	$slot4kw+=$UNITS;
               }           
          $UNITS= number_format($UNITS, 0);
      
        		$x2[]=$UNITS;
        		$x2a[]=$UNITS2;
        		$x2b[]=$UNITS3;
        		$x2d[]= $DATESLOT.'-'.date_format($date,"m").'-'.date_format($date,"y") ;
        		
         } 
  	 $NN++;
  	 $INI=$row['Active_Import'];
  	 $INI2=$row['2Active_Import'];
  	 $INI3=$row['3Active_Import'];
   	 $INIHOUR1=date_format($date,"H");
  	 $BLOCK++;
   if ($BLOCK==2)
   {
  	 $BLOCK=1;
   }
  	$lasttime=date_create_from_format("Y-m-d H:i:s",$row['Time']);
        $lastmin=(date_format($lasttime,"i"));
        $lastsec=(date_format($lasttime,"s"));
        $lasthour=(date_format($lasttime,"H"));
        $lastimport=$importactual+$lastimport;	
   }
 	}$x2[]= $UNITS; 
 	 $x2a[]=$UNITS2;
 	 $x2b[]=$UNITS3;
 	$x2d[]=date_format($date,"d").'-'.date_format($date,"m").'-'.date_format($date,"y");
 	  
 ?>       
 
 <?php 

  date_default_timezone_set("Asia/calcutta");   
  $Da1 = date('Y-m-01');
  $CurrentDate= date("Y-m-d");
 
  $FullDateFrom=date("Y-m-d",strtotime($Da1));	
  $FullDateTo=date("Y-m-d",strtotime($CurrentDate));
 
 
 // $con=mysql_connect('localhost','enermate','eepl12345#')or die(mysql_error());
 // mysql_select_db('enermate_db',$con) or die(mysql_error());
  
   $sql="select id,Frequncy,ACTIVE_POWER,2Active_Import,Active_Import,3Active_Import,Voltage_BR,Voltage_RY,Voltage_YB,Current_R,Current_Y,Current_B,Timeslot,Time, Date,PF,2Current_R,2Current_Y,2Current_B,2ACTIVE_POWER,2PF,3Current_R,3Current_Y,3Current_B,3Active_Import,3ACTIVE_POWER,3PF from modbusmanagement3  where Date(Time)>= '$FullDateFrom' and Date(Time)<='$FullDateTo'";
  $res=mysqli_query($conn,$sql) or die(mysqli_error()); 
   
       $slot=0;
       $BLOCK=0;
       $READ=1;
       $ActualExp=0;
       $Frequency=0;
       $INI=0;
       $INI2=0;
       $INI3=0;
       $NN=1;
       $INITIME=0;
       $INIDAY=0;
       $INIDAY2=0;
       $INIDAY3=0;
       $initime=0;
       $finaltime=0;
       $timediff=0;
       $lasttime=0;
       $lastmin=0;
       $lastsec=0;
       $lasthour=0;
       $lastimport=0;
       $importactualfinal=0;
       $importactualfinal15mins=0;
       $importactual=0;
        while($row1=mysqli_fecth_assoc($res))
        {
          // echo "hello";
           $row=$row1;
           $slot+=1;
           if( $READ==1)
           {
          	 $INI=$row['Active_Import'];
          	 $INIDAY=$row['Active_Import'];
           	 $INIDAY2=$row['2Active_Import'];
          	 $INI2=$row['2Active_Import'];
         	 $INIDAY3=$row['3Active_Import'];
          	 $INI3=$row['3Active_Import'];
          	 $INIHOUR1=date_format($date,"H");
         	 $INIHOUR2=date_format($date,"H");
           }
           
              $Current_R6=$row['Current_R'];
		$Current_Y6=$row['Current_Y'];
		$Current_B6=$row['Current_B'];
		$Voltage_RY6=$row['Voltage_RY'];
		$Voltage_YB6=$row['Voltage_YB'];
		$Voltage_BR6=$row['Voltage_BR'];
		//$Frequency=$row['Frequncy'];
		
		$Active_Import6=$row['Active_Import'];
		$PF6=$row['PF'];
		$ACTIVE_POWER6=$row['ACTIVE_POWER']/1000;
		
		$Current_R7=$row['2Current_R'];
		$Current_Y7=$row['2Current_Y'];
		$Current_B7=$row['2Current_B'];
		$Active_Import7=$row['2Active_Import'];
		$PF7=$row['2PF'];
		$ACTIVE_POWER7=$row['2ACTIVE_POWER']/1000;  
		
		$Current_R8=$row['3Current_R'];
		$Current_Y8=$row['3Current_Y'];
		$Current_B8=$row['3Current_B'];
		$Active_Import8=$row['3Active_Import'];
		$PF8=$row['3PF'];
		$ACTIVE_POWER8=$row['3ACTIVE_POWER']/1000;
		
	//	$ACTIVE_POWER6 = number_format($ACTIVE_POWER6, 0);
	//	$ACTIVE_POWER7 = number_format($ACTIVE_POWER7, 0);
         //        $ACTIVE_POWER8 = number_format($ACTIVE_POWER8, 0);  
           
           
           
           
         	  $ActualExp+=$row['Active_Import'];
         	  $Frequency+=$row['Frequncy'];
          	  $Frequency+=$row['block'];
         	  $UDIFF+=$row['UNITSDIFF'];
         	  $UIPEN+= $row['UIPEN'];
         	  $UIEXC+= $row['UIEXC'];
          	  $UNITS=($row['Active_Import']-$INI)/1000;
          	  $UNITS2=($row['2Active_Import']-$INI2)/1000;
         
         // if($selectVal == 'report1' or $selectVal == 'report2'){
           	$UNITS3=($row['3Active_Import']-$INI3)/1000;
          //}else if($selectVal == 'report3' or $selectVal == 'report4'){
          // 	$UNITS3=($row['3Active_Import']-$INI3)/1000;
          //}  
               	 $HOUR=date_format($date,"H")-$INIHOUR1;
          	 $avgkw=($UNITS/(1000 * $HOUR));
         	 $avgkw1=($UNITS/(1000 * ($HOUR+1)));
                 $avgkw2=($UNITS2/(1000 * $HOUR));
           	 $avgkw22=($UNITS2/(1000 * ($HOUR+1)));
              	 $avgkw3=($UNITS3/(1000 * $HOUR));
          	 $avgkw33=($UNITS3/(1000 * ($HOUR+1)));
               	$UNITSDAY= ($row['Active_Import']-$INIDAY)/1000;
           	$UNITSDAY= number_format($UNITSDAY, 0);
           	$UNITSDAY2= ($row['2Active_Import']-$INIDAY2)/1000;
           	$UNITSDAY2= number_format($UNITSDAY2, 0);
               
          // if($selectVal == 'report1' or $selectVal == 'report2'){
          	 $UNITSDAY3= ($row['3Active_Import']-$INIDAY3)/1000;
           //}else if($selectVal == 'report3' or $selectVal == 'report4'){
          // 	 $UNITSDAY3= ($row['3Active_Import']-$INIDAY3)/1000;
	 //  }
	 	$UNITSDAY3= number_format($UNITSDAY3, 0);
           	$FEQLAST=$row['Frequncy'];
           	$READ++;
           	$HOUR=$INIHOUR;
          	$initime=date_create_from_format("Y-m-d H:i:s",$row['Time']);
           	$inimin=(date_format($initime,"i"));
           	$inisec=(date_format($initime,"s"));
           	$inihour=(date_format($initime,"H"));
           	$diffhour=$inihour-$lasthour;
           	$diffmin=$inimin-$lastmin;
           	$diffsec=$inisec-$lastsec;
           	$timediff= (($diffhour*60*60)+($diffmin*60)+($diffsec))/(3600);
          	$importactual=$row['ACTIVE_POWER']*$timediff;
           	$importactualfinal=$importactual+$lastimport;
          	$importactualfinal15mins=$importactualfinal-$lastimport;
           	$importactualfinal = number_format($importactualfinal, 0);
           	$importactualfinal15mins = number_format($importactualfinal15mins, 0);
          	$avgkw = number_format($avgkw, 2);
         	$avgkw1 = number_format($avgkw1, 2);
          	$avgkw2 = number_format($avgkw2, 2);
           	$avgkw22 = number_format($avgkw22, 2);
         	$avgkw3 = number_format($avgkw3, 2);
	   	$avgkw33 = number_format($avgkw33, 2);
	  	$date=date_create_from_format("Y-m-d H:i:s",$row['Time']);
        if ($FEQLAST>0)
           {  	$SCHLAST=$row['Schedule'];
           }
        if ($NN==1)
          {   	 $INIHOUR=date_format($date,"H");
         	 $INIMIN=date_format($date,"i");
          }
       if((date_format($date,"H")==0) or (date_format($date,"H")==1) or (date_format($date,"H")==2)or (date_format($date,"H")==3)or (date_format($date,"H")==4)or (date_format($date,"H")==5) )
           {	 $INIHOUR=date_format($date,"H");
         	 $INITMIN=date_format($date,"i");
           }
       if ( (date_format($date,"H") != $INIHOUR)&& (date_format($date,"i") != $INIMIN) )
           {     $NN=1;
           }
            if ((((date_format($date,"H")==0) or (date_format($date,"H")==1)  or (date_format($date,"H")==2)or (date_format($date,"H")==3)or (date_format($date,"H")==4) or (date_format($date,"H")==5) ) and $NN==1)  )
        
         {
         if ($BLOCK>0)
           { 
          if ($BLOCK==1)
           {  	$avgkw=$avgkw1;
           	$DATESLOT=date_format($date,"d")-1;
           }else{
           	 $DATESLOT=date_format($date,"d");
           }
         if(date_format($date,"H")==0)
           {
           	$slot1kw=$UNITS+$slot1kw;
          	$slotlastkw=$UNITS;
           }elseif(date_format($date,"H")==6 )
             { 
             	$slot2kw=$UNITS+$slot2kw;
             }elseif(date_format($date,"H")==18 )
               {
           	$slot3kw+=$UNITS;
               }elseif(date_format($date,"H")==22 )
               {
           	$slot4kw+=$UNITS;
               }           
          $UNITS= number_format($UNITS, 0);
      
        		$x3[]=$UNITS;
        		$x3a[]=$UNITS2;
        		$x3b[]=$UNITS3;
        		$x3d[]= $DATESLOT.'-'.date_format($date,"m").'-'.date_format($date,"y") ;
        		
         } 
  	 $NN++;
  	 $INI=$row['Active_Import'];
  	 $INI2=$row['2Active_Import'];
  	 $INI3=$row['3Active_Import'];
   	 $INIHOUR1=date_format($date,"H");
  	 $BLOCK++;
   if ($BLOCK==2)
   {
  	 $BLOCK=1;
   }
  	$lasttime=date_create_from_format("Y-m-d H:i:s",$row['Time']);
        $lastmin=(date_format($lasttime,"i"));
        $lastsec=(date_format($lasttime,"s"));
        $lasthour=(date_format($lasttime,"H"));
        $lastimport=$importactual+$lastimport;	
   }
 	}$x3[]=$UNITS;
        $x3a[]=$UNITS2;
        $x3b[]=$UNITS3;
 	 $x3d[]=date_format($date,"d").'-'.date_format($date,"m").'-'.date_format($date,"y"); 
 ?>       
 
 <?php 

  date_default_timezone_set("Asia/calcutta");   
  $Da1 = date('Y-m-01');
  $CurrentDate= date("Y-m-d");
 
  $FullDateFrom=date("Y-m-d",strtotime($Da1));	
  $FullDateTo=date("Y-m-d",strtotime($CurrentDate));
 
 
  //$con=mysql_connect('localhost','enermate','eepl12345#')or die(mysql_error());
  //mysql_select_db('enermate_db',$con) or die(mysql_error());
  
   $sql="select id,Frequncy,ACTIVE_POWER,2Active_Import,Active_Import,3Active_Import,Voltage_BR,Voltage_RY,Voltage_YB,Current_R,Current_Y,Current_B,Timeslot,Time, Date,PF,2Current_R,2Current_Y,2Current_B,2ACTIVE_POWER,2PF,3Current_R,3Current_Y,3Current_B,3Active_Import,3ACTIVE_POWER,3PF from modbusmanagement4 where Date(Time)>= '$FullDateFrom' and Date(Time)<='$FullDateTo'";
  $res=mysqli_query($conn,$sql) or die(mysqli_error()); 
   
       $slot=0;
       $BLOCK=0;
       $READ=1;
       $ActualExp=0;
       $Frequency=0;
       $INI=0;
       $INI2=0;
       $INI3=0;
       $NN=1;
       $INITIME=0;
       $INIDAY=0;
       $INIDAY2=0;
       $INIDAY3=0;
       $initime=0;
       $finaltime=0;
       $timediff=0;
       $lasttime=0;
       $lastmin=0;
       $lastsec=0;
       $lasthour=0;
       $lastimport=0;
       $importactualfinal=0;
       $importactualfinal15mins=0;
       $importactual=0;
        while($row1=mysqli_fecth_assoc($res))
        {
          // echo "hello";
           $row=$row1;
           $slot+=1;
           if( $READ==1)
           {
          	 $INI=$row['Active_Import'];
          	 $INIDAY=$row['Active_Import'];
           	 $INIDAY2=$row['2Active_Import'];
          	 $INI2=$row['2Active_Import'];
         	 $INIDAY3=$row['3Active_Import'];
          	 $INI3=$row['3Active_Import'];
          	 $INIHOUR1=date_format($date,"H");
         	 $INIHOUR2=date_format($date,"H");
           }
           
           $Current_R9=$row['Current_R'];
		$Current_Y9=$row['Current_Y'];
		$Current_B9=$row['Current_B'];
		$Active_Import9=$row['Active_Import'];
		$PF9=$row['PF'];
		$ACTIVE_POWER9=$row['ACTIVE_POWER']/1000;
		
		$Current_R10=$row['2Current_R'];
		$Current_Y10=$row['2Current_Y'];
		$Current_B10=$row['2Current_B'];
		$Active_Import10=$row['2Active_Import'];
		$PF10=$row['2PF'];
		$ACTIVE_POWER10=$row['2ACTIVE_POWER']/1000;  
		
		$Current_R11=$row['3Current_R'];
		$Current_Y11=$row['3Current_Y'];
		$Current_B11=$row['3Current_B'];
		$Active_Import11=$row['3Active_Import'];
		$PF11=$row['3PF'];
		$ACTIVE_POWER11=$row['3ACTIVE_POWER']/1000;
		
		$Voltage_RY11=$row['Voltage_RY'];
		$Voltage_YB11=$row['Voltage_YB'];
		$Voltage_BR11=$row['Voltage_BR'];
		$Freq11=$row['Voltage_BR'];
		
		
		//$ACTIVE_POWER9 = number_format($ACTIVE_POWER9, 0);
              //   $ACTIVE_POWER10 = number_format($ACTIVE_POWER10, 0);
                // $ACTIVE_POWER11 = number_format($ACTIVE_POWER11, 0);
		
           
           
           
           
           
         	  $ActualExp+=$row['Active_Import'];
         	  $Frequency+=$row['Frequncy'];
          	  $Frequency+=$row['block'];
         	  $UDIFF+=$row['UNITSDIFF'];
         	  $UIPEN+= $row['UIPEN'];
         	  $UIEXC+= $row['UIEXC'];
          	  $UNITS=($row['Active_Import']-$INI)/1000;
          	  $UNITS2=($row['2Active_Import']-$INI2)/1000;
         
         // if($selectVal == 'report1' or $selectVal == 'report2'){
           	$UNITS3=($row['3Active_Import']-$INI3)/1000;
          //}else if($selectVal == 'report3' or $selectVal == 'report4'){
          // 	$UNITS3=($row['3Active_Import']-$INI3)/1000;
          //}  
               	 $HOUR=date_format($date,"H")-$INIHOUR1;
          	 $avgkw=($UNITS/(1000 * $HOUR));
         	 $avgkw1=($UNITS/(1000 * ($HOUR+1)));
                 $avgkw2=($UNITS2/(1000 * $HOUR));
           	 $avgkw22=($UNITS2/(1000 * ($HOUR+1)));
              	 $avgkw3=($UNITS3/(1000 * $HOUR));
          	 $avgkw33=($UNITS3/(1000 * ($HOUR+1)));
               	$UNITSDAY= ($row['Active_Import']-$INIDAY)/1000;
           	$UNITSDAY= number_format($UNITSDAY, 0);
           	$UNITSDAY2= ($row['2Active_Import']-$INIDAY2)/1000;
           	$UNITSDAY2= number_format($UNITSDAY2, 0);
               
          // if($selectVal == 'report1' or $selectVal == 'report2'){
          	 $UNITSDAY3= ($row['3Active_Import']-$INIDAY3)/1000;
           //}else if($selectVal == 'report3' or $selectVal == 'report4'){
          // 	 $UNITSDAY3= ($row['3Active_Import']-$INIDAY3)/1000;
	 //  }
	 	$UNITSDAY3= number_format($UNITSDAY3, 0);
           	$FEQLAST=$row['Frequncy'];
           	$READ++;
           	$HOUR=$INIHOUR;
          	$initime=date_create_from_format("Y-m-d H:i:s",$row['Time']);
           	$inimin=(date_format($initime,"i"));
           	$inisec=(date_format($initime,"s"));
           	$inihour=(date_format($initime,"H"));
           	$diffhour=$inihour-$lasthour;
           	$diffmin=$inimin-$lastmin;
           	$diffsec=$inisec-$lastsec;
           	$timediff= (($diffhour*60*60)+($diffmin*60)+($diffsec))/(3600);
          	$importactual=$row['ACTIVE_POWER']*$timediff;
           	$importactualfinal=$importactual+$lastimport;
          	$importactualfinal15mins=$importactualfinal-$lastimport;
           	$importactualfinal = number_format($importactualfinal, 0);
           	$importactualfinal15mins = number_format($importactualfinal15mins, 0);
          	$avgkw = number_format($avgkw, 2);
         	$avgkw1 = number_format($avgkw1, 2);
          	$avgkw2 = number_format($avgkw2, 2);
           	$avgkw22 = number_format($avgkw22, 2);
         	$avgkw3 = number_format($avgkw3, 2);
	   	$avgkw33 = number_format($avgkw33, 2);
	  	$date=date_create_from_format("Y-m-d H:i:s",$row['Time']);
        if ($FEQLAST>0)
           {  	$SCHLAST=$row['Schedule'];
           }
        if ($NN==1)
          {   	 $INIHOUR=date_format($date,"H");
         	 $INIMIN=date_format($date,"i");
          }
       if((date_format($date,"H")==0) or (date_format($date,"H")==1) or (date_format($date,"H")==2)or (date_format($date,"H")==3)or (date_format($date,"H")==4)or (date_format($date,"H")==5) )
           {	 $INIHOUR=date_format($date,"H");
         	 $INITMIN=date_format($date,"i");
           }
       if ( (date_format($date,"H") != $INIHOUR)&& (date_format($date,"i") != $INIMIN) )
           {     $NN=1;
           }
            if ((((date_format($date,"H")==0) or (date_format($date,"H")==1)  or (date_format($date,"H")==2)or (date_format($date,"H")==3)or (date_format($date,"H")==4) or (date_format($date,"H")==5) ) and $NN==1)  )
        
         {
         if ($BLOCK>0)
           { 
          if ($BLOCK==1)
           {  	$avgkw=$avgkw1;
           	$DATESLOT=date_format($date,"d")-1;
           }else{
           	 $DATESLOT=date_format($date,"d");
           }
         if(date_format($date,"H")==0)
           {
           	$slot1kw=$UNITS+$slot1kw;
          	$slotlastkw=$UNITS;
           }elseif(date_format($date,"H")==6 )
             { 
             	$slot2kw=$UNITS+$slot2kw;
             }elseif(date_format($date,"H")==18 )
               {
           	$slot3kw+=$UNITS;
               }elseif(date_format($date,"H")==22 )
               {
           	$slot4kw+=$UNITS;
               }           
          $UNITS= number_format($UNITS, 0);
      
        		$x4[]=$UNITS;
        		$x4a[]=$UNITS2;
        		$x4b[]=$UNITS3;
        		$x4d[]= $DATESLOT.'-'.date_format($date,"m").'-'.date_format($date,"y") ;
        		
         }
  	 $NN++;
  	 $INI=$row['Active_Import'];
  	 $INI2=$row['2Active_Import'];
  	 $INI3=$row['3Active_Import'];
   	 $INIHOUR1=date_format($date,"H");
  	 $BLOCK++;
   if ($BLOCK==2)
   {
  	 $BLOCK=1;
   }
  	$lasttime=date_create_from_format("Y-m-d H:i:s",$row['Time']);
        $lastmin=(date_format($lasttime,"i"));
        $lastsec=(date_format($lasttime,"s"));
        $lasthour=(date_format($lasttime,"H"));
        $lastimport=$importactual+$lastimport;	
   }
 	}$x4[]=$UNITS;
       	$x4a[]=$UNITS2;
      	$x4b[]=$UNITS3;
 	$x4d[]=date_format($date,"d").'-'.date_format($date,"m").'-'.date_format($date,"y");
 	
 	
 	  
 ?>       	
 	
 	
<div class="row">
        <div class="col-lg-12">
            <h4 style="color:#ff0000;margin-top:20px;">* Click on tiles to get values</h4>
	</div>
	<div class="col-lg-12">
		<div class="col-lg-3 col-lg-offset-1" id="m1" style="border:1px solid black;background:#F18241;font-size:15px;color:Green;margin-top:15px;margin-right:20px;text-align:center;box-shadow:5px 5px 5px 5px #a8a8a8;">
			<h3><b>6.6KV Voltmeter-1</b></h3>
		</div>
		<div class="col-lg-3" id="m2" style="border:1px solid black;background:#52B137;font-size:15px;color:#FFFFFF;margin-top:15px;margin-right:20px;text-align:center;box-shadow:5px 5px 5px 5px #a8a8a8;">
			<h3><b>6.6KV Voltmeter-2</b></h3>
		</div>
		<div class="col-lg-3" id="m3" style="border:1px solid black;background:#F18241;font-size:15px;color:#FFFFFF;margin-top:15px;margin-right:20px;text-align:center;box-shadow:5px 5px 5px 5px #a8a8a8;">
			<h3><b>66KV Voltmeter-3</b></h3>
		</div>
	</div>
	
	<br>
	<div class="col-lg-12">
		<div class="col-lg-3 col-lg-offset-1" id="c1" style="border:1px solid black;background:#52B137;font-size:15px;color:Green;margin-top:15px;margin-right:20px;text-align:center;box-shadow:5px 5px 5px 5px #a8a8a8;">
			<h3><b>I/C-1 METER-1</b></h3>
		</div>
		<div class="col-lg-3 " id="c8" style="border:1px solid black;background:#F18241;font-size:15px;color:Green;margin-top:15px;margin-right:20px;text-align:center;box-shadow:5px 5px 5px 5px #a8a8a8;">
			<h3><b>LRF-I/C METER-8</b></h3>
		</div>
		<div class="col-lg-3 " id="c11" style="border:1px solid black;background:#52B137;font-size:15px;color:Green;margin-top:15px;margin-right:20px;text-align:center;box-shadow:5px 5px 5px 5px #a8a8a8;">
			<h3><b>66KV I/C METER-11</b></h3>
		</div>
		
	</div>
	
	<br>
	<div class="col-lg-12">
		<div class="col-lg-3" id="c5" style="border:1px solid black;background:#F18241;font-size:15px;color:Green;margin-top:15px;text-align:center; width:150px;margin-right:5px;box-shadow:5px 5px 5px 5px #a8a8a8;">
			<h3><b>O2 Plant METER-5</b></h3>
		</div>
		<div class="col-lg-3 col-lg-offset-1" id="c2" style="border:1px solid black;background:#52B137;font-size:15px;color:Green;margin-top:15px;text-align:center;width:150px;box-shadow:5px 5px 5px 5px #a8a8a8;">
			<h3><b>EOF METER-2</b></h3>
		</div>
		
		<div class="col-lg-3 col-lg-offset-1" id="c6" style="border:1px solid black;background:#52B137;font-size:15px;color:Green;margin-top:15px;text-align:center; width:150px;margin-right:5px;box-shadow:5px 5px 5px 5px #a8a8a8;">
			<h3><b>LRF-1 METER-6</b></h3>
		</div>
		<div class="col-lg-3 col-lg-offset-2" id="c9" style="border:1px solid black;background:#F18241;font-size:15px;color:Green;margin-top:15px;text-align:center;width:150px;box-shadow:5px 5px 5px 5px #a8a8a8;">
			<h3><b>RMS-1 Meter-9</b></h3>
		</div>
	</div>
	<br>
	
	<div class="col-lg-12">
		<div class="col-lg-3" id="c4" style="border:1px solid black;background:#52B137;font-size:15px;color:Green;margin-top:15px;text-align:center; width:150px;margin-right:5px;box-shadow:5px 5px 5px 5px #a8a8a8;">
			<h3><b>IPH -2 METER-4</b></h3>
		</div>
		<div class="col-lg-3 col-lg-offset-1" id="c3" style="border:1px solid black;background:#F18241;font-size:15px;color:Green;margin-top:15px;text-align:center;width:150px;box-shadow:5px 5px 5px 5px #a8a8a8;">
			<h3><b>IPH-1 METER-3</b></h3>
		</div>
		
		<div class="col-lg-3 col-lg-offset-1" id="c7" style="border:1px solid black;background:#F18241;font-size:15px;color:Green;margin-top:15px;text-align:center; width:150px;margin-right:5px;box-shadow:5px 5px 5px 5px #a8a8a8;">
			<h3><b>LRF-2 METER-7</b></h3>
		</div>
		<div class="col-lg-3 col-lg-offset-2" id="c10" style="border:1px solid black;background:#52B137;font-size:15px;color:Green;margin-top:15px;text-align:center;width:150px;box-shadow:5px 5px 5px 5px #a8a8a8;">
			<h3><b>RMS-2 Meter-10</b></h3>
		</div>
	</div>
	
</div>
<br/>
<br/>
<div class="row">
	
	<div class="col-lg-12" id="m" style="display:none;">
		<div id="g1" class="col-lg-4 " style="padding-right:5px;"></div>
		<div id="g2" class="col-lg-4 " style="padding-right:5px;"></div>
		<div id="g3" class="col-lg-4 " style="padding-right:5px;"></div>
		<div id="g4" class="col-lg-4"  style="padding-right:5px;"></div>
		<div id="g5" class="col-lg-4"  style="padding-right:5px;"></div>
		<div id="g6" class="col-lg-4"  style="padding-right:5px;"></div>
	
	</div>
	
	
	<div class="col-lg-12" id="v" style="display:none;">
		<div id="v1" class="col-lg-3 " style="padding-right:5px;"></div>
		<div id="v2" class="col-lg-3 " style="padding-right:5px;"></div>
		<div id="v3" class="col-lg-3 " style="padding-right:5px;"></div>
		<div id="v4" class="col-lg-3"  style="padding-right:5px;"></div>
	
	</div>

</div>
<br>
<div class="row">
	<div class="col-lg-12" id="ma" style="display:none;padding-bottom-:20px;">
		<div id="chartdiv" style="width:100%; height:100%;"></div>
	</div>
</div>

 <br/><br/><br/><br/>
 <script src="JustGuage/justgage.js"></script>
 <script src="JustGuage/raphael.js"></script>
 <script language="javascript" type="text/javascript" src="Bargraph/jquery.min.js"></script>
 <script language="javascript" type="text/javascript" src="Bargraph/jquery.jqplot.min.js"></script>
 <link rel="stylesheet" type="text/css" href="Bargraph/jquery.jqplot.css" />
 
  <script language="javascript" type="text/javascript" src="Bargraph/jqplot.barRenderer.js"></script>
 
  <script language="javascript" type="text/javascript" src="Bargraph/jqplot.barRenderer.min.js"></script>
  <script language="javascript" type="text/javascript" src="Bargraph/jqplot.pointLabels.js"></script>
  <script language="javascript" type="text/javascript" src="Bargraph/jqplot.cursor.js"></script>
 <script language="javascript" type="text/javascript" src="Bargraph/jqplot.highlighter.js"></script>
 
 

 <script>
 	
 $(document).ready(function(){
 	
 	var g1,g2,g3,g4,g5,g6,chartdiv;
 	var v1,v2,v3,v4; 
 	
 	var Voltage_RY='<?php echo $Voltage_RY1  ;?> ';
  	var Voltage_YB ='<?php echo $Voltage_YB1 ;?> ';  
  	var Voltage_BR ='<?php echo $Voltage_BR1;?> ';
  	var Freguency='<?php echo $Frequency1;?> ';
  	
  	var Voltage_RY6='<?php echo $Voltage_RY6 ;?> ';
  	var Voltage_YB6 ='<?php echo $Voltage_YB6 ;?> ';  
  	var Voltage_BR6 ='<?php echo $Voltage_BR6;?>';
  	var Freguency6='<?php echo $Frequency1;?>';
  	
  	var Voltage_RY11='<?php echo $Voltage_RY11 ;?> ';
  	var Voltage_YB11 ='<?php echo $Voltage_YB11 ;?> ';  
  	var Voltage_BR11 ='<?php echo $Voltage_BR11;?>';
  	var Frequency11='<?php echo $Frequency1  ;?>';
  	
        var current_r='<?php echo $Current_R1 ;?>';
	var current_y= '<?php echo $Current_Y1 ;?>';
	var current_b='<?php echo $Current_B1 ;?>';
	var active_power= '<?php echo $ACTIVE_POWER1;?>';
	var pf='<?php echo $PF1 ;?>';
	var active_import= '<?php echo $Active_Import1;?>'; 
	
	var current_r1='<?php echo $Current_R2 ;?>';
	var current_y1= '<?php echo $Current_Y2 ;?>';
	var current_b1='<?php echo $Current_B2 ;?>';
	var active_power1= '<?php echo $ACTIVE_POWER2;?>';
	var pf1='<?php echo $PF2;?>';
	var active_import1= '<?php echo $Active_Import2;?>';
	
	var current_r3='<?php echo $Current_R3;?>';
	var current_y3= '<?php echo $Current_Y3;?>';
	var current_b3='<?php echo $Current_B3;?>';
	var active_power3= '<?php echo $ACTIVE_POWER3;?>';
	var pf3='<?php echo $PF3;?>';
	var active_import3= '<?php echo $Active_Import3;?>';
	
	var current_r4='<?php echo $Current_R4;?>';
	var current_y4= '<?php echo $Current_Y4;?>';
	var current_b4='<?php echo $Current_B4;?>';
	var active_power4= '<?php echo $ACTIVE_POWER4;?>';
	var pf4='<?php echo $PF4 ;?>';
	var active_import4= '<?php echo $Active_Import4;?>';
	
	var current_r5='<?php echo $Current_R5;?>';
	var current_y5= '<?php echo $Current_Y5;?>';
	var current_b5='<?php echo $Current_B5;?>';
	var active_power5= '<?php echo $ACTIVE_POWER5;?>';
	var pf5='<?php echo $PF5 ;?>';
	var active_import5= '<?php echo $Active_Import5;?>';
	
	var current_r6='<?php echo $Current_R6;?>';
	var current_y6= '<?php echo $Current_Y6;?>';
	var current_b6='<?php echo $Current_B6;?>';
	var active_power6= '<?php echo $ACTIVE_POWER6;?>';
	var pf6='<?php echo $PF6 ;?>';
	var active_import6= '<?php echo $Active_Import6;?>';
	
	var current_r7='<?php echo $Current_R7;?>';
	var current_y7= '<?php echo $Current_Y7;?>';
	var current_b7='<?php echo $Current_B7;?>';
	var active_power7= '<?php echo $ACTIVE_POWER7;?>';
	var pf7='<?php echo $PF7 ;?>';
	var active_import7= '<?php echo $Active_Import7;?>';
	
	var current_r8='<?php echo $Current_R8;?>';
	var current_y8= '<?php echo $Current_Y8;?>';
	var current_b8='<?php echo $Current_B8;?>';
	var active_power8= '<?php echo $ACTIVE_POWER8;?>';
	var pf8='<?php echo $PF8 ;?>';
	var active_import8= '<?php echo $Active_Import8;?>';
	
	var current_r9='<?php echo $Current_R9;?>';
	var current_y9= '<?php echo $Current_Y9;?>';
	var current_b9='<?php echo $Current_B9;?>';
	var active_power9= '<?php echo $ACTIVE_POWER9;?>';
	var pf9='<?php echo $PF9;?>';
	var active_import9= '<?php echo $Active_Import9;?>';
	
	var current_r10='<?php echo $Current_R10;?>';
	var current_y10= '<?php echo $Current_Y10;?>';
	var current_b10='<?php echo $Current_B10;?>';
	var active_power10= '<?php echo $ACTIVE_POWER10;?>';
	var pf10='<?php echo $PF10 ;?>';
	var active_import10= '<?php echo $Active_Import10;?>';
	
	var current_r11='<?php echo $Current_R11;?>';
	var current_y11= '<?php echo $Current_Y11;?>';
	var current_b11='<?php echo $Current_B11;?>';
	var active_power11= '<?php echo $ACTIVE_POWER11;?>';
	var pf11='<?php echo $PF11 ;?>';
	var active_import11= '<?php echo $Active_Import11;?>';
	
  	$('#m1').on('click',function(){
 		$('#v1,#v2,#v3,#v4').html('');
 		$('#v').show();
 		$('#m,#ma').hide();
 		
 		var v1 = new JustGage({
		         id: "v1", 
		         value: Voltage_RY ,
		         formatNumber:true,
		         min:0,
		         max:10000,
		         label: "VOLTAGE_RY",        
		         pointer:1,
		       
		         customSectors : [ {"lo":0,"hi":10000,"color":"#FF0000"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
  			
  			
  			
		         
		 });
		        
		 var v2 = new JustGage({
		 	  id: "v2", 
		          value: Voltage_YB,
		          formatNumber:true,
		          min: 0,
		          max: 10000,
		          label: "VOLTAGE_YB",
		          pointer:1,
		        
		          customSectors : [
                   			 {"lo":0,"hi":10000,"color":"#FED300"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
  			
		      
		});
		 var v3 = new JustGage({
		          id: "v3", 
		          value:Voltage_BR,
		          formatNumber:true,
		          min: 0,
		          max: 10000,
		          label: "VOLTAGE_BR",
		          pointer:1,
		       
		          customSectors : [
                   			 {"lo":0,"hi":10000,"color":"#0000FF"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
  			
		 });
			
		 var v4 = new JustGage({
		          id: "v4", 
		          value: Freguency,
		          formatNumber:true,
		         
		          min: 49,
		          max:51 ,
		          label: "FREQUENCY",
		           pointer:1,
		         
		          customSectors : [
                   			 {"lo":49,"hi":51,"color":"#00ff00"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
		   });	
 			
 	});
 	
 	$('#m2').on('click',function(){
 		$('#v1,#v2,#v3,#v4').html('');
 		$('#v').show();
 		$('#m,#ma').hide();
 		
 		var v1 = new JustGage({
		         id: "v1", 
		         value: Voltage_RY6,
		         formatNumber:true,
		         min:0,
		         max:10000,
		         label: "VOLTAGE_RY",        
		         pointer:1,
		       
		         customSectors : [ {"lo":0,"hi":10000,"color":"#FF0000"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
  			
  			
  			
		         
		 });
		        
		 var v2 = new JustGage({
		 	  id: "v2", 
		          value: Voltage_YB6,
		          formatNumber:true,
		          min: 0,
		          max: 10000,
		          label: "VOLTAGE_YB",
		          pointer:1,
		        
		          customSectors : [
                   			 {"lo":0,"hi":10000,"color":"#FED300"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
  			
		      
		});
		 var v3 = new JustGage({
		          id: "v3", 
		          value:Voltage_BR6,
		          formatNumber:true,
		          min: 0,
		          max: 10000,
		          label: "VOLTAGE_BR",
		          pointer:1,
		       
		          customSectors : [
                   			 {"lo":0,"hi":10000,"color":"#0000FF"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
  			
		 });
			
		 var v4 = new JustGage({
		          id: "v4", 
		          value: Freguency6,
		          formatNumber:true,
		         
		          min: 49,
		          max: 51,
		          label: "FREQUENCY",
		           pointer:1,
		         
		          customSectors : [
                   			 {"lo":49,"hi":51,"color":"#00ff00"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
		   });	
 			
 	});
 	$('#m3').on('click',function(){
 		$('#v1,#v2,#v3,#v4').html('');
 		$('#v').show();
 		$('#m,#ma').hide();
 		
 		var v1 = new JustGage({
		         id: "v1", 
		         value: Voltage_RY11,
		         formatNumber:true,
		         min:0,
		         max:70000,
		         label: "VOLTAGE_RY",        
		         pointer:1,
		       
		         customSectors : [ {"lo":0,"hi":70000,"color":"#FF0000"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
  			
  			
  			
		         
		 });
		        
		 var v2 = new JustGage({
		 	  id: "v2", 
		          value: Voltage_YB11,
		          formatNumber:true,
		          min: 0,
		          max: 70000,
		          label: "VOLTAGE_YB",
		          pointer:1,
		        
		          customSectors : [
                   			 {"lo":0,"hi":70000,"color":"#FED300"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
  			
		      
		});
		 var v3 = new JustGage({
		          id: "v3", 
		          value:Voltage_BR11,
		          formatNumber:true,
		          min: 0,
		          max: 70000,
		          label: "VOLTAGE_BR",
		          pointer:1,
		       
		          customSectors : [
                   			 {"lo":0,"hi":70000,"color":"#0000FF"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
  			
		 });
			
		 var v4 = new JustGage({
		          id: "v4", 
		          value: Frequency11,
		          formatNumber:true,
		         
		          min: 49,
		          max: 51,
		          label: "FREQUENCY",
		           pointer:1,
		         
		          customSectors : [
                   			 {"lo":49,"hi":51,"color":"#00ff00"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
		   });	
 			
 	});
 	
 	$('#c1').on('click',function(){
 		$('#g1,#g2,#g3,#g4,#g5,#g6,#chartdiv').html('');
 		$('#m,#ma').show();
 	 	$('#v').hide();
 	 	
 	 	var g1 = new JustGage({
		         id: "g1", 
		         value: current_r ,
		         formatNumber:true,
		         min:0,
		         max:1400,
		         label: "CURRENT_R",        
		         pointer:1,
		       
		        customSectors : [
                   			 {"lo":0,"hi":1400,"color":"#FF0000"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
  			
		         
		 });
		        
		 var g2 = new JustGage({
		 	  id: "g2", 
		          value: current_y,
		          formatNumber:true,
		          min: 0,
		          max: 1400,
		          label: "CURRENT_Y",
		          pointer:1,
		       
		          customSectors : [
                   			 {"lo":0,"hi":1400,"color":"#FED300"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
  			
		      
		});
		 var g3 = new JustGage({
		          id: "g3", 
		          value:current_b,
		          formatNumber:true,
		          min: 0,
		          max: 1400,
		          label: "CURRENT_B",
		          pointer:1,
		       
		           customSectors : [
                   			 {"lo":0,"hi":1400,"color":"#0000FF"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			valueFontSize:10,
  			labelFontColor: "#008055"
  			
		 });
			
		 var g4 = new JustGage({
		          id: "g4", 
		          value: active_power,
		          formatNumber:true,
		          min: 0,
		          max: 16000,
		          label: "ACTIVE_POWER",
		           pointer:1,
		       
		          customSectors : [
                   			 {"lo":0,"hi":16000,"color":"#00FF00"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
  			
		         
		   });
		        
		 var g5 = new JustGage({
		          id: "g5", 
		          value: pf,
		          formatNumber:true,
		          min: -1.00,
		          max: 1.00,
		          label: "PF",
		          pointer:1,
		           customSectors : [  {"lo":-1,"hi":1,"color":"#9B1C17"},
                   			 
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
		         
		 });
		 var g6 = new JustGage({
		          id: "g6", 
		          value:active_import,
		          formatNumber:true,
		      
		          min: 0,
		          max: 50000000,
		          label: "Kwh Counter",
		           pointer:1,
		       
		          valueFontColor: "#86B107",
  			  labelFontColor: "#008055"
  			
		        
		});
		
		
	        
      	 	/*var x1a="";
       		var xa1=[];
        	for(var i=0;i<x1.length;i++){
                x1a=x1[i];
                x1a=x1a.split(',').join('');
                var x1b= parseInt(x1a);
                xa1.push(x1b);
               }
               */
               var x=<?php echo json_encode($x1); ?>;	
                var xf=[];
		var x1a="";	
		for(var i = 0; i < x.length; i += 1){
    			x1a=x[i].toString();
    			console.log(x1a);
	                x1a=x1a.split(',').join('');
	                var x1b= parseFloat(x1a);
	                xf.push(x1b);
		}
		
                $.jqplot.config.enablePlugins = true;
        	plot1 = $.jqplot('chartdiv', [xf], {
        	 	title: '<h4>Meter1 Incomer-1</h4>',
           		animate: !$.jqplot.use_excanvas,
           		 seriesColors:['#F66803'],
           		seriesDefaults:{
               			renderer:$.jqplot.BarRenderer,
               			pointLabels: { show: false,formatString:'%.3f' },
               			rendererOptions: {
                			barPadding: 1,      // number of pixels between adjacent groups of bars.
                			barWidth: 30     // width of the bars.  null to calculate automatically.
            			}
            		},
            		
           		 axes: {
                		xaxis: {
                    			renderer: $.jqplot.CategoryAxisRenderer,
                     			label:'DAY WISE TOTAL CONSUMPTION'
                    
                			}
            			},
            		            			
           	 	highlighter: {
           	 		 show: true,
           	 		 sizeAdjust: 7.5, 
           	 		 
           	 		 tooltipLocation: 'n',
           	 		 tooltipAxes: 'both',
           	 		 formatString:'Day %d , Total consumption is  %d'
           	 		
       				 
      			},
      			cursor: {
       				 show: false,
      				 //tooltipLocation:'n'
      			}
        		});
     
	 	});

	$('#c2').on('click',function(){
 		$('#g1,#g2,#g3,#g4,#g5,#g6,#chartdiv').html('');
 		$('#m,#ma').show();
 	 	$('#v').hide();
 			
		var g1 = new JustGage({
		          id: "g1", 
		          value: current_r1 ,
		          formatNumber:true,
		          min: 0,
		          max: 1400,
		          label: "CURRENT_R",
		           pointer:1,
		      
		         customSectors : [
                   			 {"lo":0,"hi":1400,"color":"#FF0000"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
		});
		        
		var g2 = new JustGage({
		          id: "g2", 
		          value: current_y1,
		          formatNumber:true,
		          min: 0,
		          max: 1400,
		          label: "CURRENT_Y",
		          pointer:1,
		       
		            customSectors : [
                   			 {"lo":0,"hi":1400,"color":"#FED300"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
		});
		var g3 = new JustGage({
		          id: "g3", 
		          value:current_b1,
		          formatNumber:true,
		          min: 0,
		          max: 1400,
		          label: "CURRENT_B",
		           pointer:1,
		        
		             customSectors : [
                   			 {"lo":0,"hi":1400,"color":"#0000FF"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
		 });
		        
		  var g4 = new JustGage({
		          id: "g4", 
		          value: active_power1,
		          formatNumber:true,
		          min: 0,
		          max: 16000,
		          label: "ACTIVE_POWER",
		           pointer:1,
		        
		           customSectors : [
                   			 {"lo":0,"hi":16000,"color":"#00FF00"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
  			
		 });
		        
		 var g5 = new JustGage({
		          id: "g5", 
		          value: pf1,
		          formatNumber:true,
		          min: -1,
		          max: 1,
		          label: "PF",
		           pointer:1,
		            customSectors : [
                  			 {"lo":-1,"hi":1,"color":"#9B1C17"},
                   			 
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
		 });
		var g6 = new JustGage({
		          id: "g6", 
		          value:active_import1,
		          formatNumber:true,
		          min: 0,
		          max: 5000000000,
		          label: "ACTIVE_IMPORT",
		          pointer:1,
		        
		             customSectors : [
                   			 {"lo":0,"hi":5000000000,"color":"#AA00FF"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
  			
		});
		var x=<?php echo json_encode($x1a); ?>;	
		var x1ad=<?php echo json_encode($x1ad);?>;
		
		 var xf=[];
		var x1a="";	
		for(var i = 0; i < x.length; i += 1){
    			x1a=x[i].toString();
    			
	                x1a=x1a.split(',').join('');
	                var x1b= parseFloat(x1a);
	                xf.push(x1b);
		}
		
                $.jqplot.config.enablePlugins = true;
        	plot1 = $.jqplot('chartdiv', [xf], {
        	 	title: '<h4>Meter2 Energy Optimizing Furnace</h4>',
           		animate: !$.jqplot.use_excanvas,
           		 seriesColors:['#F66803'],
           		seriesDefaults:{
               			renderer:$.jqplot.BarRenderer,
               			pointLabels: { show: false,formatString:'%.3f' },
               			rendererOptions: {
                			barPadding: 1,      // number of pixels between adjacent groups of bars.
                			barWidth: 30     // width of the bars.  null to calculate automatically.
            			}
            		},
           		 axes: {
                		xaxis: {
                    			renderer: $.jqplot.CategoryAxisRenderer,
                     			label:'DAY WISE TOTAL CONSUMPTION'
                    
                			}
            			},
           	 	highlighter: {
           	 		 show: true,
           	 		 sizeAdjust: 7.5, 
           	 		 
           	 		 tooltipLocation: 'n',
           	 		 tooltipAxes: 'both',
           	 		 formatString:'Day %d , Total consumption is  %d'
           	 		
       				 
      			},
      			cursor: {
       				 show: false,
      				 //tooltipLocation:'n'
      			}
        		});
	});
	
	$('#c3').on('click',function(){
 		$('#g1,#g2,#g3,#g4,#g5,#g6,#chartdiv').html('');
 		$('#m,#ma').show();
 	 	$('#v').hide();
 	 	
		var g1 = new JustGage({
		          id: "g1", 
		          value: current_r3 ,
		          formatNumber:true,
		          min: 0,
		          max: 1400,
		          label: "CURRENT_R",
		           pointer:1,
		        
		         customSectors : [
                   			 {"lo":0,"hi":1400,"color":"#FF0000"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
		});
		        
		var g2 = new JustGage({
		          id: "g2", 
		          value: current_y3,
		          formatNumber:true,
		          min: 0,
		          max: 1400,
		          label: "CURRENT_Y",
		          pointer:1, 
		            customSectors : [
                   			 {"lo":0,"hi":1400,"color":"#FED300"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
		});
		var g3 = new JustGage({
		          id: "g3", 
		          value:current_b3,
		          formatNumber:true,
		          min: 0,
		          max: 1400,
		          label: "CURRENT_B",
		           pointer:1,
		        
		             customSectors : [
                   			 {"lo":0,"hi":1400,"color":"#0000FF"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
		 });
		        
		  var g4 = new JustGage({
		          id: "g4", 
		          value: active_power3,
		          formatNumber:true,
		          min: 0,
		          max: 16000,
		          label: "ACTIVE_POWER",
		           pointer:1,
		       
		           customSectors : [
                   			 {"lo":0,"hi":16000,"color":"#00FF00"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
  			
		 });
		        
		 var g5 = new JustGage({
		          id: "g5", 
		          value: pf3,
		          formatNumber:true,
		          min: -1,
		          max: 1,
		          label: "PF",
		           pointer:1,
		            customSectors : [
                  			 {"lo":-1,"hi":1,"color":"#9B1C17"},
                   			 
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
		 });
		var g6 = new JustGage({
		          id: "g6", 
		          value:active_import3,
		          formatNumber:true,
		          min: 0,
		          max: 5000000000,
		          label: "ACTIVE_IMPORT",
		          pointer:1,
		         
		             customSectors : [
                   			 {"lo":0,"hi":5000000000,"color":"#AA00FF"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
  			
		});
		
		var x=<?php echo json_encode($x2); ?>;	
		var x2d=<?php echo json_encode($x2d);?>;
		
		var xf=[];
		var x1a="";	
		for(var i = 0; i < x.length; i += 1){
    			x1a=x[i].toString();
    			console.log(x1a);
	                x1a=x1a.split(',').join('');
	                var x1b= parseFloat(x1a);
	                xf.push(x1b);
		}
		
		
		 $.jqplot.config.enablePlugins = true;
        	 plot1 = $.jqplot('chartdiv', [xf], {
        	 	title: '<h4>Meter3 IPH-1</h4>',
           		animate: !$.jqplot.use_excanvas,
           		 seriesColors:['#F66803'],
           		seriesDefaults:{
               			renderer:$.jqplot.BarRenderer,
               			pointLabels: { show: false,formatString:'%.3f' },
               			rendererOptions: {
                			barPadding: 1,      // number of pixels between adjacent groups of bars.
                			barWidth: 30     // width of the bars.  null to calculate automatically.
            			}
            		},
           		 axes: {
                		xaxis: {
                    			renderer: $.jqplot.CategoryAxisRenderer,
                     			label:'DAY WISE TOTAL CONSUMPTION'
                    
                			}
            			},
           	 highlighter: {
           	 		 show: true,
           	 		 sizeAdjust: 7.5, 
           	 		 
           	 		 tooltipLocation: 'n',
           	 		 tooltipAxes: 'both',
           	 		 formatString:'Day %d , Total consumption is  %d'
           	 		
       				 
      			},
      			cursor: {
       				 show: false,
      				 //tooltipLocation:'n'
      			}
        		});
			
	});
	$('#c4').on('click',function(){
 		$('#g1,#g2,#g3,#g4,#g5,#g6,#chartdiv').html('');
 		$('#m,#ma').show();
 	 	$('#v').hide();
 			
		var g1 = new JustGage({
		          id: "g1", 
		          value: current_r4 ,
		          formatNumber:true,
		          min: 0,
		          max: 1400,
		          label: "CURRENT_R",
		           pointer:1,
		      
		         customSectors : [
                   			 {"lo":0,"hi":1400,"color":"#FF0000"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
		});
		        
		var g2 = new JustGage({
		          id: "g2", 
		          value: current_y4,
		          formatNumber:true,
		          min: 0,
		          max: 1400,
		          label: "CURRENT_Y",
		          pointer:1,
		       
		            customSectors : [
                   			 {"lo":0,"hi":1400,"color":"#FED300"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
		});
		var g3 = new JustGage({
		          id: "g3", 
		          value:current_b4,
		          formatNumber:true,
		          min: 0,
		          max: 1400,
		          label: "CURRENT_B",
		           pointer:1,
		       
		             customSectors : [
                   			 {"lo":0,"hi":1400,"color":"#0000FF"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
		 });
		        
		  var g4 = new JustGage({
		          id: "g4", 
		          value: active_power4,
		          formatNumber:true,
		          min: 0,
		          max: 16000,
		          label: "ACTIVE_POWER",
		           pointer:1,
		       
		           customSectors : [
                   			 {"lo":0,"hi":16000,"color":"#00FF00"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
  			
		 });
		        
		 var g5 = new JustGage({
		          id: "g5", 
		          value: pf4,
		          formatNumber:true,
		          min: -1,
		          max: 1,
		          label: "PF",
		           pointer:1,
		            customSectors : [
                  			 {"lo":-1,"hi":1,"color":"#9B1C17"},
                   			 
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
		 });
		var g6 = new JustGage({
		          id: "g6", 
		          value:active_import4,
		          formatNumber:true,
		          min: 0,
		          max: 5000000000,
		          label: "ACTIVE_IMPORT",
		          pointer:1,
		        
		             customSectors : [
                   			 {"lo":0,"hi":5000000000,"color":"#AA00FF"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
  			
  			
  			
		});
		var x=<?php echo json_encode($x2a); ?>;	
		var x2d=<?php echo json_encode($x2d);?>;
		
		 var xf=[];
		var x1a="";	
		for(var i = 0; i < x.length; i += 1){
    			x1a=x[i].toString();
    			
	                x1a=x1a.split(',').join('');
	                var x1b= parseFloat(x1a);
	                xf.push(x1b);
		}
		
		
 		$.jqplot.config.enablePlugins = true;
        	plot1 = $.jqplot('chartdiv', [xf], {
        	 	title: '<h4>Meter4 IPH-2</h4>',
           		animate: !$.jqplot.use_excanvas,
           		seriesColors:['#F66803'],
           		seriesDefaults:{
               			renderer:$.jqplot.BarRenderer,
               			pointLabels: { show: false,formatString:'%.3f' },
               			rendererOptions: {
                			barPadding: 1,      // number of pixels between adjacent groups of bars.
                			barWidth: 30     // width of the bars.  null to calculate automatically.
            			}
            		},
           		 axes: {
                		xaxis: {
                    			renderer: $.jqplot.CategoryAxisRenderer,
                     			label:'DAY WISE TOTAL CONSUMPTION'
                    
                			}
            			},
           	 highlighter: {
           	 		 show: true,
           	 		 sizeAdjust: 7.5, 
           	 		 
           	 		 tooltipLocation: 'n',
           	 		 tooltipAxes: 'both',
           	 		 formatString:'Day %d , Total consumption is  %d'
           	 		
       				 
      			},
      			cursor: {
       				 show: false,
      				 //tooltipLocation:'n'
      			}
        		});		
	});
	$('#c5').on('click',function(){
 		$('#g1,#g2,#g3,#g4,#g5,#g6,#chartdiv').html('');
 		$('#m,#ma').show();
 	 	$('#v').hide();
 	 	
 	 	var g1 = new JustGage({
		         id: "g1", 
		         value: current_r5,
		         formatNumber:true,
		         min:0,
		         max:1400,
		         label: "CURRENT_R",        
		         pointer:1,
		       
		         customSectors : [
                   			 {"lo":0,"hi":1400,"color":"#FF0000"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
		 });
		        
		 var g2 = new JustGage({
		 	  id: "g2", 
		          value: current_y5,
		          formatNumber:true,
		          min: 0,
		          max: 1400,
		          label: "CURRENT_Y",
		          pointer:1,
		       
		            customSectors : [
                   			 {"lo":0,"hi":1400,"color":"#FED300"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
		      
		});
		 var g3 = new JustGage({
		          id: "g3", 
		          value:current_b5,
		          formatNumber:true,
		          min: 0,
		          max: 1400,
		          label: "CURRENT_B",
		          pointer:1,
		        
		        customSectors : [
                   			 {"lo":0,"hi":1400,"color":"#0000FF"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
		 });
			
		 var g4 = new JustGage({
		          id: "g4", 
		          value: active_power5,
		          formatNumber:true,
		          min: 0,
		          max: 16000,
		          label: "ACTIVE_POWER",
		           pointer:1,
		       
		           customSectors : [
                  			 {"lo":0,"hi":16000,"color":"#00ff00"},
                   			
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
		   });
		        
		 var g5 = new JustGage({
		          id: "g5", 
		          value: pf5,
		          formatNumber:true,
		          min: -1,
		          max: 1,
		          label: "PF",
		          pointer:1,
		           customSectors : [
                  			 {"lo":-1,"hi":1,"color":"#9B1C17"},
                   			 
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
		 });
		 var g6 = new JustGage({
		          id: "g6", 
		          value:active_import5,
		          formatNumber:true,
		          min: 0,
		          max: 50000000000,
		          label: "ACTIVE_IMPORT",
		           pointer:1,
		        
		           customSectors : [
                   			 {"lo":0,"hi":50000000000,"color":"#9B1C17"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
  			
		});
		var x=<?php echo json_encode($x2b); ?>;	
		var x2d=<?php echo json_encode($x2d);?>;
		
                 var xf=[];
		var x1a="";	
		for(var i = 0; i < x.length; i += 1){
    			x1a=x[i].toString();
    			
	                x1a=x1a.split(',').join('');
	                var x1b= parseFloat(x1a);
	                xf.push(x1b);
		}
		
		
                 $.jqplot.config.enablePlugins = true;
        	 plot1 = $.jqplot('chartdiv', [xf], {
        	 	title: '<h4>Meter5 OXYGEN PLANT</h4>',
        	 	
           		animate: !$.jqplot.use_excanvas,
           		seriesColors:['#F66803'],
           		seriesDefaults:{
               			renderer:$.jqplot.BarRenderer,
               			pointLabels: { show: false,formatString:'%.3f' },
               			rendererOptions: {
                			barPadding: 1,      // number of pixels between adjacent groups of bars.
                			barWidth: 30     // width of the bars.  null to calculate automatically.
            			}
            		},
           		 axes: {
                		xaxis: {
                    			renderer: $.jqplot.CategoryAxisRenderer,
                     			label:'DAY WISE TOTAL CONSUMPTION'
                    
                			}
            			},
            		highlighter: {
           	 		 show: true,
           	 		 sizeAdjust: 7.5, 
           	 		 
           	 		 tooltipLocation: 'n',
           	 		 tooltipAxes: 'both',
           	 		 formatString:'Day %d , Total consumption is  %d'
           	 		
       				 
      			},
      			cursor: {
       				 show: false,
      				 //tooltipLocation:'n'
      			}	
        		});
	 });
	 
	 $('#c6').on('click',function(){
 		$('#g1,#g2,#g3,#g4,#g5,#g6,#chartdiv').html('');
 		$('#m,#ma').show();
 	 	$('#v').hide();
 	 	
		var g1 = new JustGage({
		          id: "g1", 
		          value: current_r6 ,
		          formatNumber:true,
		          min: 0,
		          max: 1400,
		          label: "CURRENT_R",
		           pointer:1,
		       
		         customSectors : [
                   			 {"lo":0,"hi":1400,"color":"#FF0000"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
		});
		        
		var g2 = new JustGage({
		          id: "g2", 
		          value: current_y6,
		          formatNumber:true,
		          min: 0,
		          max: 1400,
		          label: "CURRENT_Y",
		          pointer:1,
		        
		            customSectors : [
                   			 {"lo":0,"hi":1400,"color":"#FED300"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
		});
		var g3 = new JustGage({
		          id: "g3", 
		          value:current_b6,
		          formatNumber:true,
		          min: 0,
		          max: 1400,
		          label: "CURRENT_B",
		           pointer:1,
		        
		             customSectors : [
                   			 {"lo":0,"hi":1400,"color":"#0000FF"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
		 });
		        
		  var g4 = new JustGage({
		          id: "g4", 
		          value: active_power6,
		          formatNumber:true,
		          min: 0,
		          max: 16000,
		          label: "ACTIVE_POWER",
		           pointer:1,
		        
		           customSectors : [
                   			 {"lo":0,"hi":16000,"color":"#00FF00"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
  			
		 });
		        
		 var g5 = new JustGage({
		          id: "g5", 
		          value: pf6,
		          formatNumber:true,
		          min: -1,
		          max: 1,
		          label: "PF",
		           pointer:1,
		            customSectors : [
                  			 {"lo":-1,"hi":1,"color":"#9B1C17"},
                   	
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
		 });
		var g6 = new JustGage({
		          id: "g6", 
		          value:active_import6,
		          formatNumber:true,
		          min: 0,
		          max: 5000000000,
		          label: "ACTIVE_IMPORT",
		          pointer:1,
		        
		             customSectors : [
                   			 {"lo":0,"hi":5000000000,"color":"#AA00FF"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
  			
		});
		var x=<?php echo json_encode($x3); ?>;	
		var x2d=<?php echo json_encode($x3d);?>;
		
		var xf=[];
		var x1a="";	
		for(var i = 0; i < x.length; i += 1){
    			x1a=x[i].toString();
    			console.log(x1a);
	                x1a=x1a.split(',').join('');
	                var x1b= parseFloat(x1a);
	                xf.push(x1b);
		}
		
		
              
                $.jqplot.config.enablePlugins = true;
        	plot1 = $.jqplot('chartdiv', [xf], {
        	 	title: '<h4>Meter6 Laddle Refining Furnace-1</h4>',
           		animate: !$.jqplot.use_excanvas,
           		 seriesColors:['#F66803'],
           		seriesDefaults:{
               			renderer:$.jqplot.BarRenderer,
               			pointLabels: { show: false,formatString:'%.3f' },
               			rendererOptions: {
                			barPadding: 1,      // number of pixels between adjacent groups of bars.
                			barWidth: 30,
                			
            			},
            			
            		},
           		 axes: {
                		xaxis: {
                    			renderer: $.jqplot.CategoryAxisRenderer,
                     			label:'DAY WISE TOTAL CONSUMPTION'
                    
                			}
            			},
            			
           	 	highlighter: {
           	 		 show: true,
           	 		 sizeAdjust: 7.5, 
           	 		 
           	 		 tooltipLocation: 'n',
           	 		 tooltipAxes: 'both',
           	 		 formatString:'Day %d , Total consumption is  %d'
           	 		
       				 
      			},
      			cursor: {
       				 show: false,
      				 //tooltipLocation:'n'
      			}
        		});
			
	});
	
	$('#c7').on('click',function(){
 		$('#g1,#g2,#g3,#g4,#g5,#g6,#chartdiv').html('');
 		$('#m,#ma').show();
 	 	$('#v').hide();
 			
		var g1 = new JustGage({
		          id: "g1", 
		          value: current_r7,
		          formatNumber:true,
		          min: 0,
		          max: 1400,
		          label: "CURRENT_R",
		           pointer:1,
		     
		         customSectors : [
                   			 {"lo":0,"hi":1400,"color":"#FF0000"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
		});
		        
		var g2 = new JustGage({
		          id: "g2", 
		          value: current_y7,
		          formatNumber:true,
		          min: 0,
		          max: 1400,
		          label: "CURRENT_Y",
		          pointer:1,
		       
		            customSectors : [
                   			 {"lo":0,"hi":1400,"color":"#FED300"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
		});
		var g3 = new JustGage({
		          id: "g3", 
		          value:current_b7,
		          formatNumber:true,
		          min: 0,
		          max: 1400,
		          label: "CURRENT_B",
		           pointer:1,
		        
		             customSectors : [
                   			 {"lo":0,"hi":1400,"color":"#0000FF"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
		 });
		        
		  var g4 = new JustGage({
		          id: "g4", 
		          value: active_power7,
		          formatNumber:true,
		          min: 0,
		          max: 16000,
		          label: "ACTIVE_POWER",
		           pointer:1,
		       
		           customSectors : [
                   			 {"lo":0,"hi":16000,"color":"#00FF00"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
  			
		 });
		        
		 var g5 = new JustGage({
		          id: "g5", 
		          value: pf7,
		          formatNumber:true,
		          min: -1,
		          max: 1,
		          label: "PF",
		           pointer:1,
		            customSectors : [
                  			 {"lo":-1,"hi":1,"color":"#9B1C17"},
                   			 
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
		 });
		var g6 = new JustGage({
		          id: "g6", 
		          value:active_import7,
		          formatNumber:true,
		          min: 0,
		          max: 5000000000,
		          label: "ACTIVE_IMPORT",
		          pointer:1,
		       
		             customSectors : [
                   			 {"lo":0,"hi":5000000000,"color":"#AA00FF"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
  			
		});
		var x=<?php echo json_encode($x3a); ?>;	
		var x2d=<?php echo json_encode($x3d);?>;
		
		
                 var xf=[];
		var x1a="";	
		for(var i = 0; i < x.length; i += 1){
    			x1a=x[i].toString();
    			
	                x1a=x1a.split(',').join('');
	                var x1b= parseFloat(x1a);
	                xf.push(x1b);
		}
		
              
                $.jqplot.config.enablePlugins = true;
        	plot1 = $.jqplot('chartdiv', [xf], {
        	 	title: '<h4>Meter7 Laddle Refining Furnace -2 </h4>',
           		animate: !$.jqplot.use_excanvas,
           		seriesColors:['#F66803'],
           		seriesDefaults:{
               			renderer:$.jqplot.BarRenderer,
               			pointLabels: { show: false,formatString:'%.3f' },
               			rendererOptions: {
                			barPadding: 1,      // number of pixels between adjacent groups of bars.
                			barWidth: 30     // width of the bars.  null to calculate automatically.
            			}
            		},
           		 axes: {
                		xaxis: {
                    			renderer: $.jqplot.CategoryAxisRenderer,
                     			label:'DAY WISE TOTAL CONSUMPTION'
                    
                			}
            			},
           	 	highlighter: {
           	 		 show: true,
           	 		 sizeAdjust: 7.5, 
           	 		 
           	 		 tooltipLocation: 'n',
           	 		 tooltipAxes: 'both',
           	 		 formatString:'Day %d , Total consumption is  %d'
           	 		
       				 
      			},
      			cursor: {
       				 show: false,
      				 //tooltipLocation:'n'
      			}
        		});
			
	});
	
	$('#c8').on('click',function(){
 		$('#g1,#g2,#g3,#g4,#g5,#g6,#chartdiv').html('');
 		$('#m,#ma').show();
 	 	$('#v').hide();
 			
		var g1 = new JustGage({
		          id: "g1", 
		          value: current_r8,
		          formatNumber:true,
		          min: 0,
		          max: 1400,
		          label: "CURRENT_R",
		           pointer:1,
		        
		         customSectors : [
                   			 {"lo":0,"hi":1400,"color":"#FF0000"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
		});
		        
		var g2 = new JustGage({
		          id: "g2", 
		          value: current_y8,
		          formatNumber:true,
		          min: 0,
		          max: 1400,
		          label: "CURRENT_Y",
		          pointer:1,
		        
		            customSectors : [
                   			 {"lo":0,"hi":1400,"color":"#FED300"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
		});
		var g3 = new JustGage({
		          id: "g3", 
		          value:current_b8,
		          formatNumber:true,
		          min: 0,
		          max: 1400,
		          label: "CURRENT_B",
		           pointer:1,
		       
		             customSectors : [
                   			 {"lo":0,"hi":1400,"color":"#0000FF"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
		 });
		        
		  var g4 = new JustGage({
		          id: "g4", 
		          value: active_power8,
		          formatNumber:true,
		          min: 0,
		          max: 16000,
		          label: "ACTIVE_POWER",
		           pointer:1,
		        
		           customSectors : [
                   			 {"lo":0,"hi":16000,"color":"#00FF00"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
  			
		 });
		        
		 var g5 = new JustGage({
		          id: "g5", 
		          value: pf8,
		          formatNumber:true,
		          min: -1,
		          max: 1,
		          label: "PF",
		           pointer:1,
		            customSectors : [
                  			 {"lo":-1,"hi":1,"color":"#9B1C17"},
                   			 
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
		 });
		var g6 = new JustGage({
		          id: "g6", 
		          value:active_import8,
		          formatNumber:true,
		          min: 0,
		          max: 5000000000,
		          label: "ACTIVE_IMPORT",
		          pointer:1,
		       
		             customSectors : [
                   			 {"lo":0,"hi":5000000000,"color":"#AA00FF"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
  			
		});
		var x=<?php echo json_encode($x3b); ?>;	
		var x2d=<?php echo json_encode($x3d);?>;
		
		
                 var xf=[];
		var x1a="";	
		for(var i = 0; i < x.length; i += 1){
    			x1a=x[i].toString();
    			
	                x1a=x1a.split(',').join('');
	                var x1b= parseFloat(x1a);
	                xf.push(x1b);
		}
		
              
                 $.jqplot.config.enablePlugins = true;
        	plot1 = $.jqplot('chartdiv', [xf], {
        	 	title: '<h4>Meter8  LRF Incomer</h4>',
           		animate: !$.jqplot.use_excanvas,
           		seriesColors:['#F66803'],
           		seriesDefaults:{
               			renderer:$.jqplot.BarRenderer,
               			pointLabels: { show: false,formatString:'%.3f' },
               			rendererOptions: {
                			barPadding: 1,      // number of pixels between adjacent groups of bars.
                			barWidth: 30     // width of the bars.  null to calculate automatically.
            			}
            		},
           		 axes: {
                		xaxis: {
                    			renderer: $.jqplot.CategoryAxisRenderer,
                     			label:'DAY WISE TOTAL CONSUMPTION'
                    
                			}
            			},
           	 	highlighter: {
           	 		 show: true,
           	 		 sizeAdjust: 7.5, 
           	 		 
           	 		 tooltipLocation: 'n',
           	 		 tooltipAxes: 'both',
           	 		 formatString:'Day %d , Total consumption is  %d'
           	 		
       				 
      			},
      			cursor: {
       				 show: false,
      				 //tooltipLocation:'n'
      			}
        		});
	});
	

 	$('#c9').on('click',function(){
 		$('#g1,#g2,#g3,#g4,#g5,#g6,#chartdiv').html('');
 		$('#m,#ma').show();
 	 	$('#v').hide();
 	 	
 	 	var g1 = new JustGage({
		         id: "g1", 
		         value: current_r9,
		         formatNumber:true,
		         min:0,
		         max:1400,
		         label: "CURRENT_R",        
		         pointer:1,
		       
		          customSectors : [
                   			 {"lo":0,"hi":1400,"color":"#FF0000"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
		 });
		        
		 var g2 = new JustGage({
		 	  id: "g2", 
		          value: current_y9,
		          formatNumber:true,
		          min: 0,
		          max: 1400,
		          label: "CURRENT_Y",
		          pointer:1,
		        
		          customSectors : [
                   			 {"lo":0,"hi":1400,"color":"#FED300"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
		      
		});
		 var g3 = new JustGage({
		          id: "g3", 
		          value:current_b9,
		          formatNumber:true,
		          min: 0,
		          max: 1400,
		          label: "CURRENT_B",
		          pointer:1,
		       
		          customSectors : [
                   			 {"lo":0,"hi":1400,"color":"#0000FF"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
		 });
			
		 var g4 = new JustGage({
		          id: "g4", 
		          value: active_power9,
		          formatNumber:true,
		          min: 0,
		          max: 16000,
		          label: "ACTIVE_POWER",
		           pointer:1,
		       
		           customSectors : [
                   			 {"lo":0,"hi":16000,"color":"#00FF00"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
  			
		   });
		        
		 var g5 = new JustGage({
		          id: "g5", 
		          value: pf9,
		          formatNumber:true,
		          min: -1,
		          max: 1,
		          label: "PF",
		          pointer:1,
		           customSectors : [
                  			 {"lo":-1,"hi":1,"color":"#9B1C17"},
                   			 
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
		 });
		 var g6 = new JustGage({
		          id: "g6", 
		          value:active_import9,
		          formatNumber:true,
		          min: 0,
		          max: 5000000000,
		          label: "ACTIVE_IMPORT",
		           pointer:1,
		        
		           customSectors : [
                   			 {"lo":0,"hi":5000000000,"color":"#AA00FF"},
                   			],
  			levelColorsGradient: false,
		          valueFontColor: "#86B107",
  			  labelFontColor: "#008055"
  			
		});
		var x=<?php echo json_encode($x4); ?>;
		var xf=[];
		var x1a="";	
		for(var i = 0; i < x.length; i += 1){
    			x1a=x[i].toString();
    			
	                x1a=x1a.split(',').join('');
	                var x1b= parseFloat(x1a);
	                xf.push(x1b);
		}
		
		var x2d=<?php echo json_encode($x4d);?>;
		
		
                $.jqplot.config.enablePlugins = true;
            	plot1 = $.jqplot('chartdiv', [xf], {
            		title: '<h4>Meter9 Rolling Mill-1</h4>',
           		animate: !$.jqplot.use_excanvas,
           		seriesColors:['#F66803'],
           		seriesDefaults:{
                            	renderer:$.jqplot.BarRenderer,
              			pointLabels: { show: false,formatString:'%.3f' },
                		rendererOptions: {
                			barPadding: 1,      // number of pixels between adjacent groups of bars.
                			barWidth: 30     // width of the bars.  null to calculate automatically.
            			}
           		},
          		axes: {
                		xaxis: {
                     			renderer: $.jqplot.CategoryAxisRenderer,
                     			label:'DAY WISE TOTAL CONSUMPTION'
                   			}
            			},  
            
            		highlighter: {
           	 		 show: true,
           	 		 sizeAdjust: 7.5, 
           	 		 
           	 		 tooltipLocation: 'n',
           	 		 tooltipAxes: 'both',
           	 		 formatString:'Day %d , Total consumption is  %d'
           	 		
       				 
      			},
      			cursor: {
       				 show: false,
      				 //tooltipLocation:'n'
      			}
           	});
	 });
	 
	 $('#c10').on('click',function(){
 		$('#g1,#g2,#g3,#g4,#g5,#g6,#chartdiv').html('');
 		$('#m,#ma').show();
 	 	$('#v').hide();
 	 	
		var g1 = new JustGage({
		          id: "g1", 
		          value: current_r10,
		          formatNumber:true,
		          min: 0,
		          max: 1400,
		          label: "CURRENT_R",
		           pointer:1,
		     
		         customSectors : [
                   			 {"lo":0,"hi":1400,"color":"#FF0000"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
		});
		        
		var g2 = new JustGage({
		          id: "g2", 
		          value: current_y10,
		          formatNumber:true,
		          min: 0,
		          max: 1400,
		          label: "CURRENT_Y",
		          pointer:1,
		       
		            customSectors : [
                   			 {"lo":0,"hi":1400,"color":"#FED300"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
		});
		var g3 = new JustGage({
		          id: "g3", 
		          value:current_b10,
		          formatNumber:true,
		          min: 0,
		          max: 1400,
		          label: "CURRENT_B",
		           pointer:1,
		         
		             customSectors : [
                   			 {"lo":0,"hi":1400,"color":"#0000FF"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
		 });
		        
		  var g4 = new JustGage({
		          id: "g4", 
		          value: active_power10,
		          formatNumber:true,
		          min: 0,
		          max: 16000,
		          label: "ACTIVE_POWER",
		           pointer:1,
		         
		           customSectors : [
                   			 {"lo":0,"hi":16000,"color":"#00FF00"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
  			
		 });
		        
		 var g5 = new JustGage({
		          id: "g5", 
		          value: pf10,
		          formatNumber:true,
		          min: -1,
		          max: 1,
		          label: "PF",
		           pointer:1,
		            customSectors : [
                  			 {"lo":-1,"hi":1,"color":"#9B1C17"},
                   			 
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
		 });
		var g6 = new JustGage({
		          id: "g6", 
		          value:active_import10,
		          formatNumber:true,
		          min: 0,
		          max: 5000000000,
		          label: "ACTIVE_IMPORT",
		          pointer:1,
		        
		             customSectors : [
                   			 {"lo":0,"hi":5000000000,"color":"#AA00FF"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
  			
		});
		var x=<?php echo json_encode($x4a); ?>;	
		var x2d=<?php echo json_encode($x4d);?>;
		
		
                 var xf=[];
		var x1a="";	
		for(var i = 0; i < x.length; i += 1){
    			x1a=x[i].toString();
    			
	                x1a=x1a.split(',').join('');
	                var x1b= parseFloat(x1a);
	                xf.push(x1b);
		}
		
              
                $.jqplot.config.enablePlugins = true;
            	plot1 = $.jqplot('chartdiv', [xf], {
            		title: '<h4>Meter10 Rolling Mill-2 </h4>',
           		animate: !$.jqplot.use_excanvas,
           		seriesColors:['#F66803'],
           		seriesDefaults:{
                            	renderer:$.jqplot.BarRenderer,
              			pointLabels: { show: false,formatString:'%.3f' },
                	rendererOptions: {
                		barPadding: 1,      // number of pixels between adjacent groups of bars.
                		barWidth: 30     // width of the bars.  null to calculate automatically.
            			}
           		},
          		axes: {
                		xaxis: {
                     			renderer: $.jqplot.CategoryAxisRenderer,
                     			label:'DAY WISE TOTAL CONSUMPTION'
                   			}
            			},  
            
            	highlighter: {
           	 		 show: true,
           	 		 sizeAdjust: 7.5, 
           	 		 
           	 		 tooltipLocation: 'n',
           	 		 tooltipAxes: 'both',
           	 		 formatString:'Day %d , Total consumption is  %d'
           	 		
       				 
      			},
      			cursor: {
       				 show: false,
      				 //tooltipLocation:'n'
      			}
           	});
			
	});
	$('#c11').on('click',function(){
 		$('#g1,#g2,#g3,#g4,#g5,#g6,#chartdiv').html('');
 		$('#m,#ma').show();
 	 	$('#v').hide();
 			
		var g1 = new JustGage({
		          id: "g1", 
		          value: current_r11,
		          formatNumber:true,
		          min: 0,
		          max: 1400,
		          label: "CURRENT_R",
		           pointer:1,
		        
		         customSectors : [
                   			 {"lo":0,"hi":1400,"color":"#FF0000"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
		});
		        
		var g2 = new JustGage({
		          id: "g2", 
		          value: current_y11,
		          formatNumber:true,
		          min: 0,
		          max: 1400,
		          label: "CURRENT_Y",
		          pointer:1,
		        
		            customSectors : [
                   			 {"lo":0,"hi":1400,"color":"#FED300"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
		});
		var g3 = new JustGage({
		          id: "g3", 
		          value:current_b11,
		          formatNumber:true,
		          min: 0,
		          max: 1400,
		          label: "CURRENT_B",
		           pointer:1,
		        
		             customSectors : [
                   			 {"lo":0,"hi":1400,"color":"#0000FF"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
		 });
		        
		  var g4 = new JustGage({
		          id: "g4", 
		          value: active_power11,
		          formatNumber:true,
		          min: 0,
		          max: 16000,
		          label: "ACTIVE_POWER",
		           pointer:1,
		       
		           customSectors : [
                   			 {"lo":0,"hi":16000,"color":"#00FF00"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
  			
		 });
		        
		 var g5 = new JustGage({
		          id: "g5", 
		          value: pf11,
		          formatNumber:true,
		          min: -1,
		          max: 1,
		          label: "PF",
		           pointer:1,
		            customSectors : [
                  			 {"lo":-1,"hi":1,"color":"#9B1C17"},
                   			 
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
		 });
		var g6 = new JustGage({
		          id: "g6", 
		          value:active_import11,
		          formatNumber:true,
		          min: 0,
		          max: 5000000000,
		          label: "ACTIVE_IMPORT",
		          pointer:1,
		         
		             customSectors : [
                   			 {"lo":0,"hi":5000000000,"color":"#AA00FF"},
                   			],
  			levelColorsGradient: false,
  			valueFontColor: "#86B107",
  			labelFontColor: "#008055"
  			
		});
		var x=<?php echo json_encode($x4b); ?>;	
		var x2d=<?php echo json_encode($x4d);?>;
		
		
                 var xf=[];
		var x1a="";	
		for(var i = 0; i < x.length; i += 1){
    			x1a=x[i].toString();
    			
	                x1a=x1a.split(',').join('');
	                var x1b= parseFloat(x1a);
	               
	                xf.push(x1b);
		}
		
		
                $.jqplot.config.enablePlugins = true;
            	plot1 = $.jqplot('chartdiv', [xf], {
            		title: '<h4>Meter11 - 66 KV Incomer Panel</h4>',
           		animate: !$.jqplot.use_excanvas,
           		seriesColors:['#F66803'],
           		seriesDefaults:{
                            	renderer:$.jqplot.BarRenderer,
              			pointLabels: { show: false,formatString:'%.3f' },
                		rendererOptions: {
                			barPadding: 1,      // number of pixels between adjacent groups of bars.
                			barWidth: 30     // width of the bars.  null to calculate automatically.
            			}
           		},
          		axes: {
                		xaxis: {
                     			renderer: $.jqplot.CategoryAxisRenderer,
                     			label:'DAY WISE TOTAL CONSUMPTION'
                   			}
            			},  
            highlighter: {
           	 		 show: true,
           	 		 sizeAdjust: 7.5, 
           	 		 
           	 		 tooltipLocation: 'n',
           	 		 tooltipAxes: 'both',
           	 		 formatString:'Day %d , Total consumption is  %d'
           	 		
       				 
      			},
      			cursor: {
       				 show: false,
      				 //tooltipLocation:'n'
      			}
           	});
			
	});
	
	
       
   
       

});
window.setInterval(function () {   
	location.reload();
},60000);

</script>




	