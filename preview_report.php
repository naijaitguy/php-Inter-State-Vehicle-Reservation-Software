<?php
session_start();
if(!isset( $_SESSION['TM'] ) ){header("location:report.php");}
include("config/validate.php");
include("config/db.php");


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
	
	
	public function GetData () {
		

	$this->Driver_Name =$_SESSION['D'];
	$this->Barez_Com = $_SESSION['B'];              
 	$this->Allowance = $_SESSION['A'];
	$this->Dispatch = $_SESSION['DIS'];
	$this->Expenses = $_SESSION['E'];
	$this->External_Comm = $_SESSION['EXT'];
 	$this->Date = $_SESSION['DA'];
 	$this->Vehicle = $_SESSION['V'];
    $this->Savin = $_SESSION['S'];
	$this->Total = $_SESSION['T'];
	$this->Amount_left = $_SESSION['AMT'];
	$this->TIME = $_SESSION['TM'];
	$this->No_Passener =$_SESSION['P'];
	
	
	
	if(isset($_POST['cancle'])){ header("location:report.php");}
		 
		 
		 
		 
		 
		 if(isset($_POST['save'])){
			 
			 	$this->Driver_Name =$_SESSION['D'];
	$this->Barez_Com = $_SESSION['B'];              
 	$this->Allowance = $_SESSION['A'];
	$this->Dispatch = $_SESSION['DIS'];
	$this->Expenses = $_SESSION['E'];
	$this->External_Comm = $_SESSION['EXT'];
 	$this->Date = $_SESSION['DA'];
 	$this->Vehicle = $_SESSION['V'];
    $this->Savin = $_SESSION['S'];
	$this->Total = $_SESSION['T'];
	$this->Amount_left = $_SESSION['AMT'];
	$this->TIME = $_SESSION['TM'];
	$this->No_Passener =$_SESSION['P'];
	
	header("location:print_report.php");
			 
			  }
		 
		 
		}
		





}



$report = new report();
$report->GetData();
?>

   
    <?php
 include("header.php");
?>    <!-------------->
  
    
    <!----------------------END OF BANNER--->
    
    <!-------------->
    
    <div class="container cont ">
    
    
    
    
     <!-------------->
     <div class="row">
     
     
     
     <div class="  col-lg-6 "  style="margin:15px;">
     
<form  action="" method="post"  role="form"> 
     
     <table   class=" table table-responsive table-bordered"  width="200" border="2" cellspacing="5" cellpadding="5">
     
     <caption class="text-center text-primary" >  BAREZ EXPRESS REPORT </caption>
  <tr>
  
  
    <td>DRIVER NAME </td>
    <td> <?php echo  $report->Driver_Name ?></td>
  </tr>
  <tr>
    <td>VEHICLE NO :</td>
    <td> <?php echo  $report->Vehicle ?></td>
  </tr>
  
    <tr>
    <td> DATE: </td>
    <td> <?php echo  $report->Date ?></td>
    
    </tr>
  <tr>
    <td>NO OF PASSENGERS</td>
    <td> <?php echo  $report->No_Passener; ?> </td>
  </tr>
  <tr>
    <td>TOTAL </td>
    <td> <?php echo " NGN"."  ". $report->Total; ?></td>
  </tr>
  <tr>
    <td>DISPATCH </td>
    <td> <?php  echo" NGN"."  ". $report->Dispatch;  ?></td>
  </tr>
  <tr>
    <td>DID HE SAVE </td>
    <td> <?php echo  $report->Savin ?></td>
  </tr>
  <tr>
    <td>BARE COMMISSION</td>
    <td> <?php echo " NGN". "  ".$report->Barez_Com; ?>;</td>
  </tr>
  <tr>
    <td>EXTERNAL COMMISSION </td>
    <td> <?php echo " NGN"."  ". $report->External_Comm; ?></td>
  </tr>
  <tr>
    <td>EXPENSES </td>
    <td> <?php echo " NGN". "  ".$report->Expenses; ?></td>
  </tr>
  <tr>
    <td>ALLOWANCE </td>
    <td> <?php echo " NGN". "  ".$report->Allowance; ?></td>
  </tr>
  
    <tr>
    <td> AMOUNT LEFT: </td>
    <td> <?php echo " NGN"."  ".  $report->Amount_left ?></td>
  </tr>
  
  
  
   <td><button type="submit" name="cancle" class="BTN btn-danger btn-lg	"> MAKE CHANGES  </button> </td>
     <td><button type="submit" name="save" class="BTN btn-success btn-lg	"> SAVE REPORT  </button> </td>
  </tr>
</table>

     
     
  </form>   
     
     
     </div>
     
     
     
     
     </div>
     <!-------------->
    
    
    
   
    
    
    <div class="row text-center panel-footer">
    
    
    POWERED BY SMART SOL LTD  &copy; - 2017  ALL RIGHT RESERVED 
    
    </div>
    
    
    <!-------------->
    
    </div>
    
    
    <!--------------- >
    
    
    
    
    
    
     
    
    
    
      <!-------------->
    
    
    
    <!-------------->
    
    
    </body>
    </html>