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
	
	
	public function GetData ()
		
{
				
	$this->Driver_Name =	$_SESSION['D'];
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
	
				
					 
					 
					 
				 
				     $query = " SELECT  * FROM report WHERE DATE = '$this->Date' AND VEHICLE = '$this->Vehicle' ";
			  
			  /* --------------check if Transaction ID  exist in the database-----------------*/
		
		
		
		
		
	         $result = mysqli_query($this->db,$query);
			 
			 if(mysqli_num_rows($result) > 0)
			 
			 { $_SESSION['report'] = " * REPORT ALREADY EXIST";   header("location:booking.php");}
			 
			 else{
			 
				 /*
				 	$sql = "select Amount from booking WHERE Date = '$this->Date' AND Vehicle = '$this->Vehicle' ";
                     $q = mysqli_query( $this->db,$sql);
				 */
				 					
	$sql   = "INSERT INTO report (Id,DRIVER,VEHICLE, DATE,TOTAL,DISPATCH,EXPENSES,ALLOWANCE, BAREZ_COMM,EXTERNAL_COMM,AMOUNT_LEFT,SAVE,NO_PASSENGERS,TIME) VALUES                 ('','$this->Driver_Name','$this->Vehicle','$this->Date','$this->Total','$this->Dispatch','$this->Expenses','$this->Allowance','$this->Barez_Com','$this->External_Comm','$this->Amount_left','$this->Savin','$this->No_Passener','$this->TIME'
	
	)";
	
			  if( mysqli_query($this->db,$sql));
			 
	               {    $this->pdf_report();  }
			 }

		
		}// end of report method

			public function pdf_report ()
			{
				
				
				//Initialize the 3 columns and the total
$column_total = "";
$column_name = "";
$column_dispatch = "";
$column_barezcomm = "";
$column_externalcomm = "";
$column_amountleft = "";
$column_savin = "";
$column_allowance = "";
$column_expenses = "";
$column_date = "";
$column_vehicle = "";
$column_row = "";
$column_time = "";
       
	$column_row = $column_row.$this->No_Passener  ."\n";
	$column_time = $column_time.$this->TIME  ."\n";
	$column_total = $column_total.$this->Total."\n";
	$column_name = $column_name.$this->Driver_Name."\n";
	$column_dispatch = $column_dispatch.$this->Dispatch."\n";
	$column_barezcomm = $column_barezcomm.$this->Barez_Com."\n";
	$column_externalcomm = $column_externalcomm.$this->External_Comm."\n";
	$column_amountleft = $column_amountleft.$this->Amount_left."\n";
	$column_savin = $column_savin.$this->Savin."\n";
	$column_allowance = $column_allowance.$this->Allowance."\n";
	$column_expenses = $column_expenses.$this->Expenses."\n";
	$column_date = $column_date.$this->Date."\n";	
	$column_vehicle = $column_vehicle.$this->Vehicle."\n";



//Convert the Total Price to a number with (.) for thousands, and (,) for decimals.

$image="img/BAREZ NEW.png";
//Create a new PDF file
$pdf=new FPDF();

//$pdf->SetAuthor(' barez express');
//$pdf->SetTitle( $DATE." -- ".$vehicle_D);



$pdf->AddPage("L");
//$pdf->SetDisplayMode(real,'default');

$pdf->SetFont('Arial','',25);


$pdf->Header();
$image="img/small-2238-10781703.png" ;

$pdf->Image($image, 10, $pdf->GetY(), 15.78);

$pdf->SetY(18);
$Y_Table_Position = 14;
$pdf->SetX(25);

$pdf->Cell(30,15,'  BAREZ EXPRESS LOADING REPORT  ',4,'L',5);

$pdf->SetFont('Arial','B',10);
$pdf->SetY(40);
$pdf->SetX(15);

 //$pdf->Cell(50,6,'SEAT NUMBER',1,0,'L',1);
 
$pdf->MultiCell(60,4,'DRIVER NAME :			'.$column_name);

$pdf->SetX(15);
 
  //$pdf->Cell(50,6,'SEAT NUMBER',1,0,'L',1);
$pdf->MultiCell(60,6,'VEHICLE  NO:			'.$column_vehicle);


$pdf->SetX(15);
 
  //$pdf->Cell(50,6,'SEAT NUMBER',1,0,'L',1);
$pdf->MultiCell(60,6,' NO OF PASSENGERS:			'.$column_row);

$pdf->SetX(15);


 
  //$pdf->Cell(50,6,'SEAT NUMBER',1,0,'L',1);
$pdf->MultiCell(60,6,'TOTAL AMOUNT:			'."NGN ".$column_total);

$pdf->SetX(15);
 
  //$pdf->Cell(50,6,'SEAT NUMBER',1,0,'L',1);
$pdf->MultiCell(60,6,' DISPATCH :			'."NGN ".$column_dispatch);

$pdf->SetX(15);


  //$pdf->Cell(50,6,'SEAT NUMBER',1,0,'L',1);
$pdf->MultiCell(60,6,' DID HE SAVE ? :			'.$column_savin);

$pdf->SetX(15);
 
 
  //$pdf->Cell(50,6,'SEAT NUMBER',1,0,'L',1);
$pdf->MultiCell(60,6,' BAREZ COMMISSION :			'."NGN ".$column_barezcomm);

$pdf->SetX(15);
 
  //$pdf->Cell(50,6,'SEAT NUMBER',1,0,'L',1);
$pdf->MultiCell(60,6,' EXTERNAL COMMISION :			'."NGN ".$column_externalcomm);


$pdf->SetX(15);
 
  //$pdf->Cell(50,6,'SEAT NUMBER',1,0,'L',1);
$pdf->MultiCell(60,6,' EXPENSES :			'."NGN ".$column_expenses);

$pdf->SetX(15);
 
  //$pdf->Cell(50,6,'SEAT NUMBER',1,0,'L',1);
$pdf->MultiCell(60,6,' DAILY ALLOWANCE :			'."NGN ".$column_allowance);

$pdf->SetX(15);
 
  //$pdf->Cell(50,6,'SEAT NUMBER',1,0,'L',1);
$pdf->MultiCell(60,6,' AMOUNT LEFT :			'."NGN ".$column_amountleft);


$pdf->SetX(15);

  //$pdf->Cell(50,6,'SEAT NUMBER',1,0,'L',1);
$pdf->MultiCell(66,6,' DATE :			'.$column_date);


$pdf->SetX(15);

  //$pdf->Cell(50,6,'SEAT NUMBER',1,0,'L',1);
$pdf->MultiCell(66,6,' TIME :			'.$column_time);


$pdf->Output('REPORT.pdf','I');


				   

				
				
				
				
				
				
				
				}
	
	}// end of class
	$report = new report();
	$report->db = $conn;
$report->GetData();


?>