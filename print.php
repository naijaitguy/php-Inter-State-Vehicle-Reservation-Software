<?php
session_start();

if(!isset( $_SESSION['Name']) ){header("location:index.php");}

include("config/validate.php");
include("config/db.php");
//include("fpdf.php");


class print_{
public $empty_erro;
public $Name ;
public $Phone ;
public $Amount  ;
public $Destination ;
public $Next_Of_Kin_Name ;
public $Next_Of_Kin_Phone ;
public $Address;
public $No_Of_Ticket;
public $Gender;
public $Date;


public function GetRecord()
{
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
				
}/// #end of function





}// #end of class


$print = new print_();
$print->GetRecord();
?>

<!DOCTYPE html>
<html lang="en"><!-- InstanceBegin template="/Templates/index.dwt.php" codeOutsideHTMLIsLocked="false" -->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="">
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>BAREZ EXPRESS BOOKING PORTAL</title>
    <!-- InstanceEndEditable -->
    <link rel="stylesheet" type="text/css" href="css/dist/css/bootstrap.min.css">
   <script src="css/dist/js/bootstrap.js"></script>
   <script src="css/dist/js/npm.js"></script>
   <script src="css/dist/js/jquery.js"></script>
   <script src="css/dist/js/jquery.cycle.all.js"></script>
   <link rel="stylesheet" type="text/css" href="css/STYLE.CSS">
   <link rel="stylesheet" type="text/css" href="css/dist/js/jquery-ui.theme.min.css">
   <script src="css/dist/js/modernizr.custom.86080.js"></script>
   <!-- InstanceBeginEditable name="head" -->
   <!-- InstanceEndEditable -->
  </head>

  <body class="body">

    <!-- Fixed navbar -->
    <nav role="navigation">
      <div class="container"  style=" background-color:#03C;">
      
      <img  class="img-responsive img-rounded" src="img/BAREZ%20NEW.png" >
        <div class="navbar-header">
  
          <a class="navbar-brand" href="index.php"> BAREZ EXPRESS BOOKING PORTAL</a>
        </div>
        
          <ul class="nav navbar-nav" >
          
            <li><a href="index.php">HOME</a></li>
            <li><a href="profile.php"> PROFILE</a></li>
             <li><a href="report.php">REPORT </a></li>
            <li><a href="booking.php">BOOKING </a></li>
         <li><a href="logout.php">LOG OUT</a></li>
         
          </ul>
          
          <div class="user">
           <?php  if(isset( $_SESSION['UserName']) )
	  
	  {
		
			 
	            
					   
		  echo "Welcome Back"."   ". $_SESSION['UserName']."<p>";
					   
					   
		echo "	You Last Log In On ". "".$_SESSION['Last'];
		  
		  
		  }
      
         ?> 
         
         </div>
        </div><!--/.nav-collapse -->
   
    </nav>
    
    <!----------------------END OF BANNER--->
    
    <!-------------->
    
    <div class="container cont ">
    
    
    
    
     <!--------------><!-- InstanceBeginEditable name="EditRegion1" -->
     
     
     
     
     <div class="row">
     
     
     
       <div class="col-md-5 col-xs-offset-3">
     
   <table class="table table-bordered table-responsive table-hover">
   
  <tr>
    <td>full Name:</td>
    <td><?php echo 	 $print->Name; ?></td>
  </tr>


  
    <tr>
    <td> Destination: </td>
    <td ><?php echo $print->Destination ?></td>
  </tr>
  
  
    <tr>
    <td >Seat Number: </td>
    <td ><?php echo $print->No_Of_Ticket ?> </td>
  </tr>
 
  
  <tr>
    <td >Departure date :</td>
    <td ><?php echo $print->Date ?></td>
    
  </tr>
 
   
  
  <tr>
  
    <td >Amount: </td>
    
    <td ><?php echo $print->Amount." "." Naira Only. "; ?></td>
    
  </tr>
  
  
  
   <form action="print.php" method="post" role="form">
  

<tr>
  
    
   <td width="203"><button type="submit" name="Print" class="btn  btn-lg  btn-success"> Print Ticket </button></td>
    
  </tr>
  
  
 </form>
  
</table>
     
     </div>
     
     
     
     </div>
     <!-- InstanceEndEditable --><!-------------->
    
    
    
   
    
    
    <div class="row text-center panel-footer">
    
    
    POWERED BY SMART SOL LTD  &copy; - 2017  ALL RIGHT RESERVED 
    
    </div>
    
    
    <!-------------->
    
    </div>
    
    
    <!--------------- >
    
    
    
    
    
    
     
    
    
    
      <!-------------->
    
    
    
    <!-------------->
    
    
    </body>
    
    <!-- InstanceEnd --></html>