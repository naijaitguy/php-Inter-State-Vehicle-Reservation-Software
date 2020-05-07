<?php 
session_start();
?>
    
     <?php
 include("header.php");
?>  

    <!-------------->
    
    <div class="container cont ">
    
     <!-------------->
     
     <div class="row " style="margin:10px; padding-right:5px;">
     
        <!------------------->
     <div class=" col-lg-3">
     
     Bus Color :  White
     
     </div>
     
     
     <!------------------->
     
        <!------------------->
     <div class=" col-lg-3">
     Vehicle Number:  <?php echo  "   ". $_SESSION['Vehicle_D']; ?> 
     
     </div>
     
     
     <!------------------->
     
     
     
       <!------------------->
     <div class=" col-lg-3">
     Departure Terminal:   Lagos ( Ikorodu)  </div>
     
     
     <!------------------->
     
     
       <!------------------->
     <div class=" col-lg-3">
     Destination:     Port Harcourt 
     
     </div>
     
     
     <!------------------->
     
     </div>
     
     <div class="row">
     
     <div class="col-lg-12">
  
  <table class="table table-hover table-responsive table-bordered table-condensed"  style="background-color:#CCC; color:#000;">
 <thead class="table"  ; style="color:#FFF; background-color:#F60;">
 <tr >
    <th >S/N  </th>
    <th >Name </th>
      <th >Gender </th>
    <th >Phone</th>
    <th >Address</th>
    <th >Destination</th>
	<th >Next Of Kin Name </th>
	<th >Next Of Kin Phone</th>
	<th >Seat Number</th>
	</thead>
  </tr>
     
 
 <?php 

if(!isset( $_SESSION['Name_D']) ){header("location:booking.php");}
include("config/validate.php");
include("config/db.php");
include("fpdf.php");
class P_manifest
{
	
public $Name
 ;
public $Phone ;
public $Amount  ;
public $Destination ;
public $Next_Of_Kin_Name ;
public $Next_Of_Kin_Phone ;
public $Address;
public $No_Of_Ticket;
public $Gender;
public $db;
public $Date;
public $Vehicle;
public $sn;
	
public function Manifest() { 

	$this->Vehicle = $_SESSION['Vehicle_D'];
					
	$this->Date =	$_SESSION['Date_D'] ;
	$this->sn = 1;
	

			
			 $query = " SELECT * FROM ikorodubookin";    
			  
	
	         $result = mysqli_query($this->db,$query);
			 
			 if(mysqli_num_rows($result) > 0)
			 
	               {
					   
						 
						   while($row = mysqli_fetch_assoc($result)){
				
				
		   /* 	$this->No_Of_Ticket = $output['SeatNo'];
				$this->Name = $output['Name'];
				$this->Address = $output['Address'];
				$this->Destination = $output['Destination'];
				$this->Gender = $output['Gender'];
				$this->Next_Of_Kin_Name = $output['KinName'];
				$this->Amount = $output['Amount'];
				$this->Next_Of_Kin_Phone = $output['KinPhone'];
				$this->No_Of_Ticket = $output['SeatNo'];
				$this->Vehicle = $output['Vehicle'];
				$this->Phone = $output['Phone'];
				
				*/

	
  echo "<tr>";
  echo "<td>".$this->sn."</td>";
  $this->sn++;
  echo "<td>".$row['Name']."</td>";
    echo "<td>".$row['Gender']."</td>";
  echo "<td>".$row['Phone']."</td>";
  echo "<td>".$row['Address']."</td>";
  echo "<td>".$row['Destination']."</td>";
    echo "<td>".$row['KinName']."</td>";
	  echo "<td>".$row['KinPhone']."</td>";
	    echo "<td>".$row['SeatNo']."</td>";
		 
  echo "</tr>\n";
 
  }

 }
				
				
				
			

}
	

}


$manifest = new P_manifest();
$manifest->db= $conn;
$manifest->Manifest();

?>

     
</table>     

     </div>
   </div>
     
     
     
     
     
     
        <div class="row">
     
     
       <!------------------->
     <div class=" col-lg-3">
     
    Manager's Signature.........................
     
     </div>
     
     
     <!------------------->
     
     
     
        <!------------------->
     <div class=" col-lg-3">
     
    Driver's Name.........................
     
     </div>
     
     
     <!------------------->
     
        <!------------------->
     <div class=" col-lg-3">
  Driver's Signature.........................
     
     </div>
     
     
     <!------------------->
     
     
          <!------------------->
     <div class=" col-lg-3">
  Date : <?php   echo"  ". $manifest->Date; ?> 
     
     </div>
     
     
     <!------------------->
     
     
     
      
     
     </div>
     <!-------------->
    
    
    
   
     
    
<?php include("footer.php"); ?>
    
    
    
    
    <!-------------->
    
    </div>
    
    
    <!--------------- >
    
    
    
    
    
    
     
    
    
    
      <!-------------->
    
    
    
    <!-------------->
    
    
    </body>
    </html>