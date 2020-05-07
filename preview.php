<?php
session_start();

if(!isset( $_SESSION['Name']) ){header("location:index.php");}

include("config/validate.php");
include("config/db.php");


class preview{
public $empty_erro;
public $Name ;
public $Email ;
public $Phone ;
public $Amount  ;
public $Destination ;
public $Next_Of_Kin_Name ;
public $Next_Of_Kin_Phone ;
public $Address;
public $No_Of_Ticket;
public $Gender;
public $Date;
public $Vehicle;
public $ticketer;
public $db;

public function GetRecord()
{

	$this->Email =$_SESSION['Email'];	
	$this->Name =$_SESSION['Name'];			
	$this->Address = $_SESSION['Address'];
	$this->Amount =  $_SESSION['Amount'];
	$this->Destination = $_SESSION['Destination'];
	$this->Gender= $_SESSION['Gender'];
	$this->Next_Of_Kin_Name = $_SESSION['Next_Of_Kin_Name'];
	$this->Next_Of_Kin_Phone = $_SESSION['Next_Of_Kin_Phone'];
	$this->No_Of_Ticket = $_SESSION['No_Of_Ticket'];
	$this->Date = $_SESSION['Date'];
	$this->Phone = $_SESSION['Phone'];
	$this->Vehicle= $_SESSION['Vehicle'];
	$this->ticketer = $_SESSION['UserName'] ;
	
				
}/// #end of function				
				public function Print_()
				{
					if (isset($_POST['Print']))
					{ $this->Name =$_SESSION['Name'];
					
							
				 $query = " SELECT * FROM ikorodubookin WHERE Date = '$this->Date' AND Vehicle = '$this->Vehicle'AND SeatNo = '$this->No_Of_Ticket'  ";
			  
			  /* --------------check if Transaction ID  exist in the database-----------------*/
		
	
	         $result = mysqli_query($this->db,$query);
			 
			 
			 if(mysqli_num_rows($result) > 0)
			 
			 { 
			 header("location:booking.php");
	
			 }
			 else{
					
					
	$sql   = "INSERT INTO ikorodubookin (ID,Email,Name,Phone,Gender,Destination,KinName,KinPhone,Amount, Address,Vehicle,Date,SeatNo,Ticketer)VALUES                 ('','$this->Email','$this->Name','$this->Phone','$this->Gender','$this->Destination','$this->Next_Of_Kin_Name','$this->Next_Of_Kin_Phone','$this->Amount','$this->Address','$this->Vehicle','$this->Date','$this->No_Of_Ticket','$this->ticketer')";
	
			  if( mysqli_query($this->db,$sql));
			 
	               {    header("location:receipt_pdf.php");   }
					
					
					
					
					
						 }
					
					
					}
				}
				
				public function cancel()
				
				{  
				
				if (isset($_POST['Cancel'])){ 	header("location:booking.php"); }
				
				}
				





}// #end of class


$preview = new preview();
$preview->db = $conn;
$preview->GetRecord();
$preview->Print_();
$preview->cancel();
?>

   
 <?php
 include("header.php");
?>    <!-------------->
    
    <div class="container cont ">
    
    
    
    
     <!-------------->
     <div class="row">
     
     <div class="col-md-4 col-xs-offset-4">
     
   <table class="table table-bordered table-responsive table-hover">
   
  <tr>
    <td>full Name:</td>
    <td><?php echo 	  $preview->Name; ?></td>
  </tr>

  <tr>
    <td>Email Add :</td>
    <td><?php echo 	  $preview->Email; ?></td>
  </tr>



<tr>
    <td width="115">Address: </td>
    <td width="203"><?php echo $preview->Address; ?></td>
  </tr>


  <tr>
    <td>Gender:</td>
    <td><?php echo   $preview->Gender ; ?></td>
  </tr>
  <tr>
    <td>Phone No:</td>
    <td><?php 	echo  $preview->Phone; ?></td>
  </tr>
 
  <tr>
    <td> Next of Kin Names:</td>
    <td><?php  echo $preview->Next_Of_Kin_Name; ?></td>
  </tr>
  
 <tr>
    <td>Next of Kin Phone No:</td>
    <td><?php 	echo $preview->Next_Of_Kin_Phone; ?></td>
  </tr>
  
    <tr>
    <td width="115"> Destination Terminal: </td>
    <td width="203"><?php echo $preview->Destination; ?></td>
  </tr>
  
  
    <tr>
    <td width="115">Seat Number: </td>
    <td width="203"><?php echo $preview->No_Of_Ticket; ?></td>
  </tr>
 
  
  <tr>
    <td width="115">Departure date :</td>
    <td width="203"><?php echo $preview->Date; ?></td>
    
  </tr>
 

  
  <tr>
  
    <td width="115">Amount: </td>
    
    <td width="203"><?php echo $preview->Amount." "." Naira Only. "; ?></td>
    
  </tr>
  
  
  
   <tr>
  
    <td width="115">Vehicle Number : </td>
    
    <td width="203"><?php echo $preview->Vehicle; ?></td>
    
  </tr>
  
  
   <form action="preview.php" method="post" role="form">
  

<tr>
  
 
  
    <td width="115"><button type="submit" name="Cancel" class="btn  btn-lg btn-danger"> Cancel Booking</button> </td>
    
   <td width="203"><button type="submit" name="Print" class="btn  btn-lg  btn-success">Proceed To Print Ticket </button></td>
    
  </tr>
  
  
 </form>
  
</table>
     
     </div>
     
     
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