<?php 
session_start();
if(!isset( $_SESSION['Name_D']) ){header("location:booking.php");}
include("config/validate.php");
include("config/db.php");
include("fpdf.php");
class P_manifest
{
	
public $Name
 ;
public $Phone ;
public $seatno;
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
	
   $query = " SELECT * FROM ikorodubookin WHERE Date = '$this->Date' AND Vehicle = '$this->Vehicle' "; 
			  
			  /* --------------check if Transaction ID  exist in the database---- 
			   $query = " SELECT * FROM booking WHERE Date = '$this->Date' AND Vehicle = '$this->Vehicle' ";      
	    -------------*/
		
	
	         $result = mysqli_query($this->db,$query);
			 
			 if(mysqli_num_rows($result) > 0)
			 
	               {
		
//Initialize the 3 columns and the total
$column_phone = "";
$column_name = "";
$column_price = "";
$column_gender = "";
$column_address = "";
$column_kin_name = "";
$column_kin_phone = "";
$column_kin_phone = "";
$column_serial = "";
$column_dest = "";
$column_seatno = "";
//$column_date = "";
	$sn = 0;
$vehicle_D = $_SESSION['Vehicle_D'];
$DATE = 	$_SESSION['Date_D'] ;
  while($row = mysqli_fetch_assoc($result))
  {
	  
	  
	 
	$name = $row["Name"];
	$phone = $row['Phone'];
    $address = $row["Address"];
	$gender = $row["Gender"];
    $total = $row['Amount'];
	//$DATE = 	$_SESSION['Date'];
$destination =  $row['Destination'];
	$sn++;
	$kin_name = $row['KinName'];
	$seatno = $row['SeatNo'];
	  $kin_phone = $row['KinPhone'];

   $column_seatno = $column_seatno.$seatno."\n";
	$column_phone = $column_phone.$phone."\n";
	$column_name = $column_name.$name."\n";
	$column_gender = $column_gender.$gender."\n";
	$column_address = $column_address.$address."\n";
	$column_kin_name = $column_kin_name.$kin_name."\n";
	$column_kin_phone = $column_kin_phone.$kin_phone."\n";
	$column_serial = $column_serial.$sn."\n";
	$column_dest = $column_dest.$destination."\n";
	//	$column_date = $column_date.$DATE."\n";
	

}


//Convert the Total Price to a number with (.) for thousands, and (,) for decimals.

$image="img/myicon.png" ;
//Create a new PDF file
$pdf=new FPDF('L');

$pdf->SetAuthor(' Naija IT Guys');
$pdf->SetTitle( $DATE." -- ".$vehicle_D);


$pdf->AddPage();
//$pdf->SetDisplayMode(real,'default');

//Fields Name position
$Y_Fields_Name_position = 10;
//Table position, under Fields Name
$Y_Table_Position = 16;






//First create each Field Name
//Gray color filling each Field Name box

$pdf->SetFillColor(210,105,35);
//Bold Font for Field Name
$pdf->SetFont('','B',30);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(40);


$pdf->Header('Content-type: application/pdf');
//header('Content-type: application/pdf');
$image="img/myicon.png"  ;

$pdf->Image($image, 5, $pdf->GetY(), 33.78);


$pdf->Cell(245,25,' THE NAIJA IT GUYS PASSENGERS MANIFEST  ',5,4,'L',5);
$pdf->SetFont('Arial','B',10);

$pdf->Header();
$pdf->Cell(245,13,' SAGAM ROAD,IKORODU,LAGOS.(08090410537)  www.naiajitguys.com.ng   Email: contact@naiajitguys.com.ng', 5,4,'L',5);
$pdf->SetX(1);
//$pdf->SetFont('Arial','B',15);



//Fields Name position
$Y_Fields_Name_position = 50;
//Table position, under Fields Name
$Y_Table_Position = 36;


//First create each Field Name
//Gray color filling each Field Name box
$pdf->SetFillColor(232,232,232);
//Bold Font for Field Name
$pdf->SetFont('Arial','B',8);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(15);


$pdf->Header();
$pdf->Cell(10,6,'S/N',1,0,'L',1);
//$pdf->SetX(25);

$pdf->Cell(45,6,'  PASSENGER NAME',1,0,'L',1);


$pdf->Cell(15,6,' SEX',1,0,'L',1);



$pdf->Cell(30,6,' PHONE',1,0,'L',1);

$pdf->Cell(25,6,'  DESTINATION',1,0,'L',1);


$pdf->Cell(60,6,'  ADDRESS ',1,0,'L',1);


$pdf->Cell(40,6,' NEXT OF KIN NAME',1,0,'L',1);


$pdf->Cell(40,6,'  NEXT OF KIN PHONE NO',1,0,'L',1);

$pdf->Cell(15,6,'  SEAT NO',1,0,'L',1);

$pdf->Ln();

//Now show the 3 columns
$pdf->SetFont('Arial','',8);
$pdf->SetY(56);
$Y_Table_Position = 56;
$pdf->SetX(15);



$pdf->MultiCell(10,6,$column_serial,1);
  $pdf->SetY($Y_Table_Position);
 $pdf->SetX(25);

$pdf->MultiCell(45,6,$column_name,1);
$pdf->SetY($Y_Table_Position);

 $pdf->SetX(70);


$pdf->MultiCell(15,6,$column_gender,1);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(85);


$pdf->MultiCell(30,6,$column_phone,1);
  $pdf->SetY($Y_Table_Position);
 $pdf->SetX(115);



$pdf->MultiCell(25,6,$column_dest,1);
  $pdf->SetY($Y_Table_Position);
 $pdf->SetX(140);


$pdf->MultiCell(60,6,$column_address,1);
  $pdf->SetY($Y_Table_Position);
$pdf->SetX(200);


$pdf->MultiCell(40,6,$column_kin_name,1);
  $pdf->SetY($Y_Table_Position);

$pdf->SetX(240);

$pdf->MultiCell(40,6,$column_kin_phone,1);
  $pdf->SetY($Y_Table_Position);

$pdf->SetX(280);

$pdf->MultiCell(15,6,$column_seatno,1);
  $pdf->SetY($Y_Table_Position);



//$pdf->MultiCell(30,6,$column_address,1);
//$pdf->SetX(135);

//Create lines (boxes) for each ROW (Product)
//If you don't use the following code, you don't create the lines separating each row


$i = 0;
$pdf->SetY($Y_Table_Position);
while ($i < $sn)
{
	$pdf->SetX(15);
	$pdf->MultiCell(280,6,'',1);
	$i = $i +1;
}





$pdf->SetFont('Arial','B',8);
$pdf->SetY(165);
$pdf->SetX(15);

$date_p = "  DATE :".   $_SESSION['Date_D'] ;
$pdf->Cell(60,8,$date_p,1,0,'L');

$vehicle = "  VEHICLE NUMBER : "   .$_SESSION['Vehicle_D'];
$pdf->Cell(75,8,$vehicle,1,0);
$pdf->Cell(50,8,'  BUS COLOUR : WHITE ',1);
$pdf->Cell(76,8,'  ROUTE : LAGOS TO PORT-HARCOURT ',1);





$pdf->SetFont('Arial','B',8);
$pdf->SetY(175);
$pdf->SetX(15);

$pdf->Cell(55,10,'MANAGER NAME : --------------------  ',1,0,'L',1);
$pdf->Cell(65,10,'MANAGER SIGN ______________________',1,0,'L',1);

$pdf->Cell(95,10,'DRIVER NAME :                           ',1,0,'L',1);
$pdf->Cell(60,10,'DRIVER SIGN ______________________',1,0,'L',1);



$pdf->Output('MANIFES.pdf','I');


				   }

 
  }

 }
				
				
				
			

	
	

	


$manifest = new P_manifest();
$manifest->db= $conn;
$manifest->Manifest();

session_destroy();	
?>
