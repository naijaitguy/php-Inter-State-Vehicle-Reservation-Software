<?php
//SHOW A DATABASE ON A PDF FILE
//CREATED BY: Carlos Vasquez S.
//E-MAIL: cvasquez@cvs.cl
//CVS TECNOLOGIA E INNOVACION
//SANTIAGO, CHILE

require('fpdf.php');

//Connect to your database
include("config/validate.php");
include("config/db.php");
//Select the Products you want to show in your PDF file

   $query = " SELECT * FROM booking  ";
			  
			  /* --------------check if Transaction ID  exist in the database---- 
			   $query = " SELECT * FROM booking WHERE Date = '$this->Date' AND Vehicle = '$this->Vehicle' ";      
	    -------------*/
	         $result = mysqli_query($conn,$query);


//Initialize the 3 columns and the total
$column_phone = "";
$column_name = "";
$column_price = "";
$column_gender = "";
$column_address = "";
$column_kin_name = "";
$column_kin_phone = "";


//For each row, add the field to the corresponding column

  while($row = mysqli_fetch_assoc($result))
{
	$name = $row["Name"];
	$phone = $row['Phone'];
$address = $row["Address"];
	$gender = $row["Gender"];
    $total = $row['Amount'];
	
	$kin_name = $row['KinName'];
	  $kin_phone = $row['KinPhone'];

	$column_phone = $column_phone.$phone."\n";
	$column_name = $column_name.$name."\n";
	$column_gender = $column_gender.$gender."\n";
	$column_address = $column_address.$address."\n";
	$column_kin_name = $column_kin_name.$kin_name."\n";
	$column_kin_phone = $column_kin_phone.$kin_phone."\n";
	

}


//Convert the Total Price to a number with (.) for thousands, and (,) for decimals.


//Create a new PDF file
$pdf=new FPDF();
$pdf->AddPage();




//Fields Name position
$Y_Fields_Name_position = 10;
//Table position, under Fields Name
$Y_Table_Position = 16;



//First create each Field Name
//Gray color filling each Field Name box



$pdf->SetFillColor(232,232,232);
//Bold Font for Field Name
$pdf->SetFont('Arial','B',8);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(15);



$pdf->Cell(10,6,'S/N',1,0,'L',1);
$pdf->SetX(25);

$pdf->Cell(40,6,'PASSENGER NAME',1,0,'L',1);


$pdf->Cell(17,6,'GENDER',1,0,'L',1);



$pdf->Cell(20,6,'PHONE',1,0,'L',1);


$pdf->Cell(33,6,'ADDRESS ',1,0,'L',1);


$pdf->Cell(33,6,'KIN NAME',1,0,'L',1);


$pdf->Cell(20,6,'KIN PHONE',1,0,'L',1);


$pdf->Ln();

//Now show the 3 columns
$pdf->SetFont('Arial','',6);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(15);

$pdf->MultiCell(10,6,$column_code,1);
  $pdf->SetY($Y_Table_Position);
 $pdf->SetX(25);

$pdf->MultiCell(40,6,$column_name,1);
$pdf->SetY($Y_Table_Position);

 $pdf->SetX(65);


$pdf->MultiCell(17,6,$column_gender,1);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(82);


$pdf->MultiCell(20,6,$column_phone,1);
  $pdf->SetY($Y_Table_Position);
 $pdf->SetX(102);


$pdf->MultiCell(33,6,$column_address,1);
  $pdf->SetY($Y_Table_Position);
$pdf->SetX(135);


$pdf->MultiCell(33,6,$column_kin_name,1);
  $pdf->SetY($Y_Table_Position);

$pdf->SetX(168);

$pdf->MultiCell(20,6,$column_kin_phone,1);
  $pdf->SetY($Y_Table_Position);



//$pdf->MultiCell(30,6,$column_address,1);
//$pdf->SetX(135);

//Create lines (boxes) for each ROW (Product)
//If you don't use the following code, you don't create the lines separating each row
$i = 0;
$pdf->SetY($Y_Table_Position);
while ($i < 15)
{
	$pdf->SetX(15);
	$pdf->MultiCell(173,6,'',1);
	$i = $i +1;
}

$pdf->Output();
?>


     </html>