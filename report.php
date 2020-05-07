<?php
session_start();
if(!isset( $_SESSION['UserName']) ){header("location:index.php");}
include("config/validate.php");
include("config/db.php");
include("fpdf.php");

class report{
public 	$Driver_Name ;
public $Dispatch;
public $Allowance;
public $Barez_Com;
public $External_Comm;
public $Amount_left;
public $Total;
public $No_Passener;
public $Expenses;
public $error;
public $Vehicle;
public $Date;
public $Savin;
public $db;
	public $TIME;
	
	
	
	
	public function GetData (){
		
		if (isset($_POST['Preview']))
		
		{	
$Driver = $_POST['Name'];
$Dispatch = $_POST['Dis'];
$Expenses  = $_POST['Expen'];
$Allowance = $_POST['Allow'];
$Barezcomm = $_POST['Bacomm'];
$External = $_POST['Ext'];
$Date = $_POST['Date'];
$Vehicle= $_POST['Vehicle'];
$Savin = $_POST['Savings'];	

			
if(empty($Driver ) || empty( $Dispatch )||  empty( $Expenses )|| empty( $Barezcomm ) ||  empty($Allowance )|| empty( $External) || empty( $Date )  || empty( $Vehicle )){
				$this->error = " All filed aer required";
				
				}// End of iif empty
			
			else {		
		
	$validate = new validate();
	$this->Driver_Name =	$validate->letters($Driver);	
	$barez_comm = $validate->test_input($Barezcomm);
 	$this->Allowance = $validate->test_input($Allowance);
	$this->Dispatch = $validate->test_input($Dispatch);
	$this->Expenses = $validate->test_input($Expenses);
	$this->External_Comm = $validate->test_input($External);
 	$this->Date = $validate->test_input($Date);
 	$this->Vehicle = $validate->test_input($Vehicle);
    $this->Savin = $validate->test_input($Savin);
	$this->TIME = date("g:i:s");
	
	
	
	  $sql = "select * from ikorodubookin WHERE Date = '$this->Date' AND Vehicle = '$this->Vehicle' ";
	  $result = mysqli_query($this->db,$sql);
	
	  if (mysqli_num_rows($result) >0)  { 
	
	
	
   //   $this->Total = 
	       $sql = "select SUM(Amount) from ikorodubookin WHERE Date = '$this->Date' AND Vehicle = '$this->Vehicle' ";
		 
           $q = mysqli_query( $this->db,$sql);
		   
		 
		   
           $row = mysqli_fetch_array($q);

           $total_amt = $row[0];
           $this->Total = $total_amt;

	      $this->Amount_left =  $this->Total - ($this->Dispatch + $this->Allowance + $barez_comm +$this->Expenses+ $this->External_Comm); 
		
				 
				 if($this->Savin == 'YES'){ $this->Barez_Com = $barez_comm + 1000;}
				 
				 else {$this->Barez_Com = $barez_comm;}
				 
				     $sql = "select * from ikorodubookin WHERE Date = '$this->Date' AND Vehicle = '$this->Vehicle' ";
					  $result = mysqli_query($this->db,$sql);
					
		             $this->No_Passener =  mysqli_num_rows($result);
					 
					 
					 
					 
		$_SESSION['D'] =	$this->Driver_Name;
		$_SESSION['V'] =	$this->Vehicle;
		$_SESSION['DA'] =	$this->Date;
		$_SESSION['TM'] =	$this->TIME;
		$_SESSION['DIS'] =	$this->Dispatch;
		$_SESSION['E'] =   $this->Expenses;
		$_SESSION['A'] =	$this->Allowance;
		$_SESSION['B'] =	$this->Barez_Com;
		$_SESSION['EXT'] =	$this->External_Comm;
		$_SESSION['AMT'] =	$this->Amount_left;
		$_SESSION['S'] =	$this->Savin;
		$_SESSION['P']  = $this->No_Passener;
		$_SESSION['T']  = $this->Total;
		
		 header("location:preview_report.php");
		
	  }
		
				
	
		 
		 else  { $this->error =" *  Booking Not Found For Selected Date And Vehicle Number";} 
					 
					 
		   
					 
	}// end if not empty
			

			
			} // end of if set


	} // end of function 




}// end of class


$report = new report();
$report->db = $conn;
$report->GetData();





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
     
     
     <div class="col-lg-12">
     
   
     
   
     
      <div class="col-lg-5 wrapper">
          
          <!-------------- start form -------------------------->
          
      <h4 style="color:red;"> 
   <?php   echo  $report->error;?>
   </h4>
<form action="<?php echo htmlspecialchars("report.php");?>" method="post"  role="form">

      <!------------------------------------>

<div  class="col-md-6">

  <div class=" form-group ">
  
 
    
 <label for="Name">  NAME OF DRIVER :</label>
  <input type="text" 
  class="form-control" required name="Name" placeholder=" NAME OF DRIVER "/>
    

  </div>
  
  
  
  <div class="form-group">
    
  <label for="Savings">DRIVER SAVING :</label>
     
  <select  class="form-control" name="Savings" >
    
  <option  value="YES"> YES</option>
  <option  value="NO"> NO </option>
    
  </select>
    
    
  </div>
  
  

   
   
  <div class="form-group">
    
  <label for="Bacomm"> BAREZ COMMISSION : </label>
    
  <input  class="form-control" required  type="tel" name="Bacomm"  placeholder="  BAREZ COMMISSION  ">
    
    
  </div>
  
  
  
   
     <div class=" form-group ">
    
 <label for="Excomm"> EXTERNAL COMMISSION:</label>
  <input type="text" class="form-control" required name="Ext" placeholder="EXTERNAL COMMISSION"/>
    
    
  </div>
   

     <div class=" form-group ">
    
 <label for="Excomm"> DISPATCH:</label>
  <input type="text" class="form-control" required name="Dis" placeholder="DISPATCH"/>
    
    
  </div>
   

   
  

 
  </div>
  
  
  
    
     <div class=" col-lg-5">
     
     
       <div class="form-group">
    
  <label for="Expen"> EXPENSES:</label>
    
  <input  class="form-control" required  type="text" name="Expen"  placeholder="  EXPENSES ">
    
    
  </div>
  
  
  
  
  
  
  
    <div class="form-group">
    
  <label for="allow"> DAILY ALLOWANCE :</label>
    
  <input  class="form-control" required  type="tel" name="Allow"  placeholder="YDAILY ALLOWANCE">
    
    
  </div>
  
       <div class=" form-group ">
    
<label for="Vehicle">Vehicle Number :</label>
<select name="Vehicle" required class="form-control"
  <option  value=""> Vehicle Number </option>
  <option  value="APP-123-XS"> APP-123-XS</option>
  <option  value="APP-124-XS"> APP-124-X</option>
  <option  value="APP-162-XS">APP-162-XS</option>
  <option  value="APP-163-XS"> APP-163-XS</option> 
  <option  value="KLK-380-XA"> KLK-380-XA </option>
  <option  value="KLK-382-XA"> KLK-382-XA</option>
  <option  value="KLK-383-XA"> KLK-383-XA</option>
  <option  value="KLK-384-X"> KLK-384-XA</option>
  <option  value="KLK-385-XA"> KLK-385-XA</option>
  <option  value="KTU-45-XU"> KTU-45-XU</option>
  <option  value="EXTERNAL"> EXTERNAL</option>
    
    </select>
  </div>
  
  
  
  
   <div class="form-group">
  
  <label for="Date"> Date :</label>
  
 <input type="text"  name="Date" class="form-control" id="datepicker" placeholder="date">
  
  </div>
  
    
  
    <div class="form-group">
 
 <button class="btn form-control  btn-primary "  name="Preview"> PREVIEW  </button>
  
    
  </div>
  
     
     </div>
  
  
  
      </form> 
     
      
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
    
          
   <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"> -->
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
      <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="css/dist/js/jquery-ui.min.js"></script>
    <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">
    <script>
	
	     $(function() {
    $( "#datepicker" ).datepicker();
	
  });
  
  
	</script>