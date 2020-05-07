<?php
session_start();
if(!isset( $_SESSION['UserName']) ){header("location:index.php");}
include("config/validate.php");
include("config/db.php");

class preview{
public $empty_erro;
public $Email;
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
public $Vehicle;
public $Vehicle_D;
public $Name_D;
public $db;
public $Date_D;
public $seat_erro;
public $manifest_error;
public $report_r;
///fuction start


public function GetRecord()
{


if(isset($_POST['Submit']))
			
			{
$Email = $_POST['Email'];				
$Name = $_POST['Name'];
$Phone = $_POST['Phone'];
$Amount = $_POST['Amount'];
$Destination = $_POST['Dest'];
$Next_Of_Kin_Name  = $_POST['Name_Kin'];
$Next_Of_Kin_Phone = $_POST['Phone_Kin'];
$Address = $_POST['Address'];
$No_Of_Ticket = $_POST['Ticket'];
$Gender = $_POST['Gender'];
$Vehicle = $_POST['Vehicle'];
$Date = $_POST['Date'];
				
		
				
if( empty($Name)|| empty($Phone)||empty($Address)||empty($Amount)||empty($Destination)||empty($Gender)||empty($Vehicle)||empty($Date))

{ $this->empty_erro = " *All Fields Are Required  ";

}

				else
				{  
				
				$validate = new validate();
				
	$this->Email =	$validate->test_input($Email);	
	$this->Name =	$validate->test_input($Name);	
	$this->Vehicle = $validate->test_input($Vehicle);				
	$this->Address = $validate->test_input($Address);
	$this->Amount =  $validate->test_input($Amount);
	$this->Destination = $validate->test_input($Destination);
	$this->Gender= $validate->letters($Gender);
	$this->Next_Of_Kin_Name = $validate->test_input($Next_Of_Kin_Name);
	$this->Next_Of_Kin_Phone = $validate->test_input($Next_Of_Kin_Phone);
	$this->No_Of_Ticket = $validate->test_input($No_Of_Ticket);
	$this->Date = $Date;
	$this->Phone = $Phone;
				
				 $query = " SELECT * FROM ikorodubookin WHERE Date = '$this->Date' AND Vehicle = '$this->Vehicle'AND SeatNo = '$this->No_Of_Ticket'  ";
			  
			  /* --------------check if Transaction ID  exist in the database-----------------*/
		
	
	         $result = mysqli_query($this->db,$query);
			 
			 if(mysqli_num_rows($result) > 0)
			 { 
			 
			$this->seat_erro  = " *  Seat Number  $this->No_Of_Ticket Is Already occupied   "; 
	
			 }
			 else{
			    
				$_SESSION['Email'] = $this->Email;
				$_SESSION['Name'] = $this->Name;
				$_SESSION['Address'] = $this->Address;
				$_SESSION['Destination'] = $this->Destination;
				$_SESSION['Gender'] = $this->Gender;
				$_SESSION['Next_Of_Kin_Name'] = $this->Next_Of_Kin_Name;
				$_SESSION['Amount'] = $this->Amount;
				$_SESSION['Next_Of_Kin_Phone'] = $this->Next_Of_Kin_Phone;
				$_SESSION['No_Of_Ticket'] = $this->No_Of_Ticket;
				$_SESSION['Vehicle'] = $this->Vehicle;
				$_SESSION['Phone'] = $this->Phone;
				$_SESSION['Date'] = $this->Date;
				
				header("location:preview.php");
			
			 }
				
				 }//#End of if empty -----------------------

			
			}//#End of if is set
			
}/// #end of function



///////------------------------------////////////
	
public function Manifest() 

{ 

if(isset($_POST['Manifest'])){

$Vehicle = $_POST['Vehicle'];
$Date = $_POST['Date'];
				

if( empty($Vehicle)|| empty($Date)){ 

$this->manifest_error = " * All Fields Are Requied . ";}

else


{
	
	$validate = new validate();
				
				
	$this->Date_D =	$validate->test_input($Date);	
	$this->Vehicle_D= $validate->test_input($Vehicle);	
	
	
	  $query = " SELECT * FROM ikorodubookin WHERE Date = '$this->Date_D' AND Vehicle = '$this->Vehicle_D' ";
			  
			  /* --------------check if Transaction ID  exist in the database-----------------*/
		
	
	         $result = mysqli_query($this->db,$query);
			 
			 if(mysqli_num_rows($result) > 0)
			 { 
			 
		
					   
					   while ($output = mysqli_fetch_array($result))
			
			         {
						 
			//     $_SESSION['total_amt'] = $total_amt;
		
				$_SESSION['Name_D'] = $output['Name'];
				$_SESSION['Vehicle_D'] = $output['Vehicle'];
				$_SESSION['Date_D'] = $output['Date'];
			 
			 header("location:manifest_pdf.php");
			}
			 
			   }
			 
			 
			  else { $this->manifest_error = " * Manifest Not Found Check the date And vehicle Number And  try Again";}
			 
			 
}}}
////----------------------------------------------///

	
public function Report() { 

if(isset($_POST['Report'])){

$Vehicle = $_POST['Vehicle_r'];
$Date = $_POST['Date_r'];
				

if( empty($Vehicle)|| empty($Date)){ 

$this->report_r= " * All Fields Are Requied . ";}

else


{
	
	$validate = new validate();
				
				
	$this->Date_D =	$validate->test_input($Date);	
	$this->Vehicle_D= $validate->test_input($Vehicle);	
	
	
	  $query = " SELECT * FROM report WHERE Date = '$this->Date_D' AND Vehicle = '$this->Vehicle_D' ";
			  
			  /* --------------check if Transaction ID  exist in the database-----------------*/
		
	
	         $result = mysqli_query($this->db,$query);
			 
			 if(mysqli_num_rows($result) > 0)
			 { 
			 
		
					   
					   while ($output = mysqli_fetch_array($result))
			
			         {
						 
		$_SESSION['D'] =	$output['DRIVER'];
		$_SESSION['V'] =	$output['VEHICLE'];
		$_SESSION['DA'] =	$output['DATE'];
		$_SESSION['T'] =	$output['TOTAL'];
		$_SESSION['DIS'] =	$output['DISPATCH'];
		$_SESSION['E'] =   $output['EXPENSES'];
		$_SESSION['A'] =	$output['ALLOWANCE'];
		$_SESSION['B'] =	$output ['BAREZ_COMM'];
		$_SESSION['EXT'] =	$output ['EXTERNAL_COMM'];
		$_SESSION['AMT'] =	$output ['AMOUNT_LEFT'];
		$_SESSION['S'] =	$output ['SAVE'];
		$_SESSION['P']  = $output ['NO_PASSENGERS'];
				$_SESSION['TM']  = $output ['TIME'];
				
			 header("location:re-print_report.php");
			}
			 
			   }
			 
			 
			  else { $this->report_r = " * Report Not Found Check the date And vehicle Number And  try Again";}
			 
}}}

///-----------------------------------------------------//

}// #end of class


$preview = new preview();
$preview->db = $conn;
$preview->Manifest();
$preview->GetRecord();
$preview->Report();

?>

      
 <?php
 include("header.php");
?>    <!-------------->
  
    <!-------------->
    
    <div class="container cont ">
    
    
    
    
     <!-------------->
     <div class="row">
     
     
    
    
          <div class=" col-lg-12 ">
          
         <div class="col-lg-7 wrapper">
          
          <!-------------- start form -------------------------->
          
      
<form action="<?php echo htmlspecialchars("booking.php");?>" method="post"  role="form">

      <!------------------------------------>

<div  class="col-md-6">

 <h4 style="color:#F00"> <?php  echo  $preview->empty_erro; ?></h4> 
   
  <div class=" form-group ">
    
 <label for="Name"> Full Name :</label>
  <input type="text" class="form-control" required name="Name" placeholder="Your Full Name Here"/>
    
    
  </div>
  
  
     
  <div class=" form-group ">
    
 <label  for="Email">  Email :</label>
  <input  type="email" class="form-control"  name="Email" placeholder="Your Email Here"/>
    
    
  </div>
  
  
  <div class="form-group">
    
  <label for="Gender"> Gender :</label>
     
  <select  class="form-control" name="Gender" >
    
  <option  value="Male"> Male</option>
  <option  value="Female"> Female</option>
    
  </select>
    
    
  </div>
  
  
  
  
   <div class="form-group">
    
  <label for="Address"> Address :</label>
    
  <input  class="form-control"   required name="Address"  placeholder="Your Address Here">
    
    
  </div>
   
   
  <div class="form-group">
    
  <label for="phone"> Phone Number : </label>
    
  <input  class="form-control" required  type="tel" name="Phone"  placeholder="Phone Number Here">
    
    
  </div>
  
  
  
   
     <div class=" form-group ">
    
 <label for="Name_Kin">Next Of Kin  Full Name :</label>
  <input type="text" class="form-control" required name="Name_Kin" placeholder="Next of Kin Full Name Here"/>
    
    
  </div>
   
   
   
  <div class="form-group">
    
  <label for="phone_Kin"> Next of Kin Phone Number:</label>
    
  <input  class="form-control" required  type="tel" name="Phone_Kin"  placeholder="Your Phone Number Here">
    
    
  </div>
  
  
  </div>
  
  <!------------------------------------->
  <div class="col-md-6">
  
    <h4 style="color:#F00;"> <?php echo $preview->empty_erro;  ?>  </h4>
  
  <div class="form-group">
   
    <label for="from">Destination Terminal : </label>
    
    <select  name="Dest" id="cat"   required class="form-control"  >
    
    
    
     <option value=""> Select Destination Terminal : </option>
     <option  value="PHC"> Lagos - PHC </option>
     <option  value="BENIN"> Lagos - BENIN </option>
      <option  value="WARRI"> Lagos - WARRI </option>
           <option  value="UGHELLI"> Lagos - UGHELLI </option>
      <option  value="BAYELSA">Lagos -  BAYELSA</option>
       <option  value="ASABA"> LAGOS - ASABA </option>
       <option  value="AGBOR">  Lagos - AGBOR </option>
       <option  value="UMUNEDE"> Lagos - UMUNEDE </option>
       <option  value="IHIALA">Lagos -  IHIALA </option>
        <option  value="OWERRI"> Lagos - OWERRI </option>
    <option  value="ISEILUKU"> Lagos - ISEILUKU </option>
     <option  value="ONITSHA"> Lagos - ONITSHA </option>
     <option  value="UMAHIA"> Lagos - UMAHIA </option>
     <option  value="ABA"> Lagos - ABA </option>
     <option  value="ENUGU"> Lagos - ENUGU </option>

    
     </select>
     </div>
     
     
     
     
       <div class="form-group">
    
  <label for="phone"> Seat  Number :</label>
    
  <select name="Ticket" required class="form-control" >
    
  <option  value=""> Select Seat No </option>
  <option  value="1"> 01</option>
  <option  value="2"> 02</option>
  <option  value="3"> 03</option>
  <option  value="4"> 04</option> 
  <option  value="5"> 05</option>
  <option  value="6"> 06</option>
  <option  value="7"> 07</option>
  <option  value="8"> 08</option>
  <option  value="9"> 09</option>
  <option  value="10"> 10</option>
  <option  value="11"> 11</option>
  <option  value="12"> 12</option>
  <option  value="13"> 13</option>
  <option  value="14"> 14</option>
  <option  value="15"> 15</option>
  
  </select>
    
    <h4 style="color:#F00"> <?php  echo  $preview->seat_erro; ?></h4>  </div>
  
  
      
     
     
     

   
     <div class=" form-group ">
    
 <label for="FirstName"> Amount :</label>
  <input  type="text"  class="form-control"  name="Amount" id="amt"/>
    
    
  </div>
   
   
 
   
   
   
   
     <div class=" form-group ">
    
<label for="Vehicle">Vehicle Number :</label>
<select name="Vehicle" required class="form-control"
  <option  value=""> Vehicle Number </option>
  <option  value="AYP-123-XS"> AYP-123-XS</option>
  <option  value="AYP-124-XS"> AYP-124-X</option>
  <option  value="AYP-162-XS">AYP-162-XS</option>
  <option  value="AYP-163-XS"> AYP-163-XS</option> 
  <option  value="KAK-380-XA"> KAK-380-XA </option>
  <option  value="KAK-382-XA"> KAK-382-XA</option>
  <option  value="KAK-383-XA"> KAK-383-XA</option>
  <option  value="KK-384-X"> KAK-384-XA</option>
  <option  value="KAK-385-XA"> KAK-385-XA</option>
  <option  value="KMU-45-XU"> KMU-45-XU</option>
  <option  value="EXTERNAL"> EXTERNAL</option>
    
    </select>
  </div>
  
  
  
  
   <div class="form-group">
  
  <label for="Date"> Date :</label>
  
 <input type="text"  name="Date" class="form-control" id="datepicker" placeholder="date">
  
  </div>

   
  <div class="form-group">
 
 <button class="btn form-control  btn-primary "  name="Submit"> PROCEED  </button>
  
    
  </div>
  
 
  
 </div>
    
   <!---------------------------------------------------->
</form>

    </div><!----end of form----------->
    
    <!--------------->
    <div class="col-lg-3 manifest">
    
    
        PRINT MANIFEST HERE 
    
    <h4 style="color:#F00;"> <?php echo $preview->manifest_error; ?>  </h4>
    
    <form method="post" action=" <?php echo htmlspecialchars("booking.php");?>" role="form">
    
    <div class="form-group-sm">
    
    <label for="Vehicle Number"> Vehicle Number :</label>
    
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
    
       <div class="form-group-sm">
       
       
       <label for=" Date"> Date </label>
       
       <input type="text"  name="Date" id="datepicker2" class=" form-control" required>
    
    </div><br>
    
    
       <div class="form-group">
       
       <button class="btn  btn-primary" type="submit" name="Manifest"> Proceed To Print Manifest</button>
    
    </div>
    
    
    
    </form>
    
    
    
    
      <!--------------->
    
    PRINT REPORT HERE 
    
    <h4 style="color:#F00;"> <?php echo $preview->report_r; if (isset($_SESSION['report'])){ echo $_SESSION['report'];} ?>  </h4>
    
    <form method="post" action=" <?php echo htmlspecialchars("booking.php");?>" role="form">

    <div class="form-group-sm">
    
    <label for="Vehicle Number"> Vehicle Number :</label>
    
<select name="Vehicle_r" required class="form-control"
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
    
       <div class="form-group-sm">
       
       
       <label for=" Date_r"> Date </label>
       
       <input type="text"  name="Date_r" id="datepicker3" class=" form-control" required>
    
    </div><br>
    
    
       <div class="form-group">
       
       <button class="btn  btn-primary" type="submit" name="Report"> PROCEED TO PRINT REPORT</button>
    
    </div>
    
    
    
    </form>
    
    
    
 
   

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
      
   <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"> -->
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
      <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="css/dist/js/jquery-ui.min.js"></script>
    <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">
    <script>
	
	
	$(document).ready(function() {
  $('#cat').change(function() {
    var dest = $('#cat').val();
   switch(dest)
{
  case "PHC": 
    $('#amt').val(' 4500.00');
    break;
	
	
      case "OWERRI": 
      $('#amt').val('4000.00');
    break;
	
	
  case "BAYELSA": 
      $('#amt').val(' 4000.00');
    break;
	
	case "BENIN": 
      $('#amt').val(' 2500.00');
    break;
	
	
		case "AGBOR": 
      $('#amt').val(' 3500.00');
    break;
	
			case "ONITSHA": 
      $('#amt').val(' 3500.00');
    break;
	
			case "ASABA": 
      $('#amt').val(' 3500.00');
    break;
	
		case "IHIALA": 
      $('#amt').val(' 4000.00'); 
    break;
	
      case "WARRI": 
      $('#amt').val('3500.00');
    break;
	
		
      case "UHELLI": 
      $('#amt').val('3500.00');
    break;
	
	      case "UMUNEDE": 
      $('#amt').val('3500.00');
    break;

      case "UMAHIA": 
      $('#amt').val('4500.00');
    break;
	
	    case "ENUGU": 
      $('#amt').val('4500.00');
    break;
	
	    case "ABA": 
      $('#amt').val('4500.00');
    break;
}

  });
});

    
   
   
     $(function() {
    $( "#datepicker" ).datepicker();
	
  });
  
  
     
     $(function() {
    $( "#datepicker2" ).datepicker();
	
  });

  
     $(function() {
    $( "#datepicker3" ).datepicker();
	
  });


	</script>
    
    