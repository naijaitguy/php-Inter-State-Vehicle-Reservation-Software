<title>TICKET</title>
<?php
session_start();

if(!isset( $_SESSION['Name']) ){header("location:index.php");}

include("config/validate.php");
include("config/db.php");
include("fpdf.php");


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
public $Vehicle;


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
	$this->Vehicle = $_SESSION['Vehicle'];
	
	
	
	
	  //Initialize the  columns and the total

$column_name = "";
$column_dest = "";
$column_amount = "";
$column_date = "";
$column_seat = "";
$column_vehicle = "";



$seat =  $_SESSION['No_Of_Ticket'];
$name = $_SESSION['Name'];		
$destination =  $_SESSION['Destination'];
$amount = $_SESSION['Amount'].' Naira';	
$Date = $_SESSION['Date'];	
$vehicle =  $_SESSION['Vehicle'];

	
	$column_name = $column_name.$name."\n";
	$column_date = $column_date.$Date."\n";
	$column_seat = $column_seat.$seat."\n";
	$column_amount = $column_amount.$amount."\n";
	$column_dest = $column_dest.$destination."\n";
	
		$column_vehicle = $column_vehicle.$vehicle."\n";
	


//Create a new PDF file
$pdf=new FPDF();
$pdf->AddPage();


//First create each Field Name
//Gray color filling each Field Name box
$pdf->SetFillColor(232,232,232);

//Bold Font for Field Name
$pdf->SetFont('Arial','B',14);
$pdf->SetY(0);
$pdf->SetX(1);


$pdf->Header();
$image="img/myicon.png" ;


$pdf->Image($image, 1, $pdf->GetY(),50);

$pdf->SetY(5);

$pdf->SetFont('Arial','',9);
$pdf->SetY(15);
$pdf->SetX(2);

$pdf->Cell(50,4,'visit www.naijaitguys.com.ng');

$pdf->SetY(18);
$pdf->SetX(2);


$pdf->Cell(50,4,'to book online ');

$pdf->SetY(23);
$pdf->SetX(2);

$pdf->Cell(50,3,'Call : 08156678190 ');

  

$pdf->SetFont('Arial','',11);
$pdf->SetY(30);
$pdf->SetX(5);

$pdf->Cell(50,3,'NAME:  '.$column_name);
$pdf->SetY(35);
$pdf->SetX(5);

 
//$pdf->Cell(50,6,'DESTINATION',1,0,'L',1);
$pdf->MultiCell(50,4,'DEST:			'. $column_dest);
$pdf->SetX(5);

//$pdf->Cell(50,6,'AM0UNT',1,0,'L',1);
$pdf->MultiCell(50,6,'AMOUNT:'.$column_amount);

  $pdf->SetX(5);
  
  //$pdf->Cell(50,6,'SEAT NUMBER',1,0,'L',1);
$pdf->MultiCell(50,4,'SEAT NO:			'.$column_seat);
$pdf->SetX(5);

 
  //$pdf->Cell(50,6,'SEAT NUMBER',1,0,'L',1);
$pdf->MultiCell(50,6,'VEHICLE  NO:'.$column_vehicle);
$pdf->SetX(5);


// $pdf->Cell(50,6,'DATE',1,0,'L',1);
$pdf->MultiCell(50,6,'DATE:			'.$column_date);
$pdf->SetX(5);
  
  
  
  $pdf->SetFont('Arial','',9);
$pdf->SetY(65);
$pdf->SetX(2);

$pdf->Cell(50,6,'Note: No Refund After Payment.  ');


$pdf->SetY(68);
$pdf->SetX(2);
$pdf->Cell(50,6,'luggages are kept at owners risk  ');
$pdf->SetY(20);



  
  

  
$pdf->Ln();

//Now show the 3 columns


//Create lines (boxes) for each ROW (Product)
//If you don't use the following code, you don't create the lines separating each row
//$i = 0;
//$pdf->SetY($Y_Table_Position);
//while ($i < $Y_Table_Position)
{
//	$pdf->SetX($Y_Table_Position);
	//$pdf->MultiCell(0,6,'',1);
	//$i = $i +1;
}

$pdf->Output(); 
	
	
	
	
	
	
	
	
	
	
	
	
				
}/// #end of function





}// #end of class


$print = new print_();
$print->GetRecord();
?>