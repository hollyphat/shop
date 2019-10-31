<?php
ini_set("display_errors","off");
session_start();
$row = $_SESSION['print'];
//echo $row;
//print_r($_SESSION);

header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0",false);
header("pragma: no-cache");

include("fpdf_protection.php");

	$pdf = new FPDF_Protection('P','mm','A4');
	//Open file
	$pdf->Open();
	$pdf->AliasNbPages(); 

	// set document view mode
	//$pdf->SetDisplayMode('fullpage');
	$pdf->SetLeftMargin(15);

	// Document Settings
	$pdf->SetTitle("E-MARKET RECEIPT");
	$pdf->SetAuthor("Femi");
	$pdf->SetCreator("Oduduwa University, Ile-Ife.");
	
	//Add First Page
	$pdf->AddPage();

//	$pdf->Image('./images/log.jpg',10,200,305);
	
	$pdf->SetY($pdf->GetY()+4);
	
	$pdf->SetFont('Times','B',18);
	$pdf->SetX($pdf->GetX()+60);
    $pdf->Cell(30,5,'E-MARKET RECEIPT',0,1);
	
 	$pdf->SetFont('Times','B',12);
 	$pdf->SetX($pdf->GetX()+60);
    $pdf->Cell(30,6,'Oduduwa University Ile-Ife',0,1);
 
	$pdf->SetFont('Times','I',9);
	$pdf->SetX($pdf->GetX()+60);
    $pdf->Cell(30,3,'www.e-market.com',0,1);
	
	$pdf->SetY($pdf->GetY()+4);
	$pdf->SetX(-500);
	
	$pdf->SetDrawColor(226,226,5);
	$pdf->SetFillColor(226,226,5);
	$pdf->SetLineWidth(0.4);
	$pdf->SetX($pdf->GetX()-20);
    $pdf->Cell(400,0,'',1,1);
	
	$pdf->SetY($pdf->GetY()+1);
	$pdf->SetX(-500);

 	$pdf->SetDrawColor(72,73,113);
	$pdf->SetFillColor(72,73,113);
	$pdf->SetLineWidth(0.4);
	$pdf->SetX($pdf->GetX()-20);
    $pdf->Cell(400,0,'',1,1);
	
	$pdf->SetY($pdf->GetY()+1);
	$pdf->SetX(-500);

 	$pdf->SetDrawColor(255,83,0);
	$pdf->SetFillColor(255,83,0);
	$pdf->SetLineWidth(0.4);
	$pdf->SetX($pdf->GetX()-20);
    $pdf->Cell(400,0,'',1,1);
	
	

$pdf->Image('images/home/logo.jpg',15,10,50);

	
	
	$pdf->SetFont('Times','BU',16);
 $pdf->SetX($pdf->GetX()+10);
 $pdf->Cell(10,0,'',0,1);
	$pdf->SetY($pdf->GetY()+15);
	
	$pdf->SetFont('Times','BU',16);
 $pdf->SetX($pdf->GetX()+10);
 $pdf->Cell(20,0,'E-MARKET PAYMENT RECEIPT CONFIRMATION',0,1);
	$pdf->SetY($pdf->GetY()+10);

$pdf->SetFont('Times','',15);
 $pdf->SetX($pdf->GetX()+30);
 $pdf->Cell(20,0,'Thank you for your order, here is a recap of your order',0,1);
	$pdf->SetY($pdf->GetY()+10);
	
	$pdf->SetFont('Times','B',11);
	  $pdf->SetX($pdf->GetX()+10);
    $pdf->Cell(20,0,'Order Date:',0,0,'L');
	
	$pdf->SetFont('Times','',11);
	  $pdf->SetX($pdf->GetX()+45);
    $pdf->Cell(40,0,date("d - m - Y"),0,1,'L');
	
	$pdf->SetY($pdf->GetY()+8);

	
	$pdf->SetFont('Times','B',11);
	  $pdf->SetX($pdf->GetX()+10);
    $pdf->Cell(20,0,'Order Number:',0,0,'L');
	
	$pdf->SetFont('Times','',11);
	  $pdf->SetX($pdf->GetX()+45);
    $pdf->Cell(40,0,$_SESSION['orderids'],0,1,'L');
		$pdf->SetY($pdf->GetY()+8);
	
		$pdf->SetFont('Times','B',15);
 $pdf->SetX($pdf->GetX()+50);
 $pdf->Cell(40,0,'SHIPPING INFORMATION',0,1);
	$pdf->SetY($pdf->GetY()+5);
		$pdf->SetY($pdf->GetY()+5);

	
	$pdf->SetFont('Times','B',11);
	  $pdf->SetX($pdf->GetX()+10);
    $pdf->Cell(20,0,'Name:',0,0,'L');
	
	$pdf->SetFont('Times','',11);
	  $pdf->SetX($pdf->GetX()+45);
    $pdf->Cell(40,0,$_SESSION['shipname'],0,1,'L');
		$pdf->SetY($pdf->GetY()+8);

$pdf->SetFont('Times','B',11);
	  $pdf->SetX($pdf->GetX()+10);
    $pdf->Cell(20,0,'Address:',0,0,'L');
	
	$pdf->SetFont('Times','',11);
	  $pdf->SetX($pdf->GetX()+45);
    $pdf->Cell(40,0,$_SESSION['shipadd'],0,1,'L');
		$pdf->SetY($pdf->GetY()+8);

	$pdf->SetFont('Times','B',15);
 $pdf->SetX($pdf->GetX()+50);
 $pdf->Cell(40,0,'...................................................',0,1);
	$pdf->SetY($pdf->GetY()+5);
		$pdf->SetY($pdf->GetY()+5);

		$pdf->SetFont('Times','B',15);
 $pdf->SetX($pdf->GetX()+50);
 $pdf->Cell(40,0,'INVENTORY INFORMATION',0,1);
	$pdf->SetY($pdf->GetY()+5);
		$pdf->SetY($pdf->GetY()+5);

$pdf->SetFont('Times','B',11);
	  $pdf->SetX($pdf->GetX()+10);
    $pdf->Cell(20,0,'Qty',0,0,'L');
	
	$pdf->SetFont('Times','B',11);
	  $pdf->SetX($pdf->GetX()+10);
    $pdf->Cell(20,0,'Name',0,0,'L');
	
	$pdf->SetFont('Times','B',11);
	  $pdf->SetX($pdf->GetX()+50);
    $pdf->Cell(20,0,'Price',0,0,'L');

$pdf->SetFont('Times','B',11);
	  $pdf->SetX($pdf->GetX()+20);
    $pdf->Cell(20,0,'Total Price',0,0,'L');
		$pdf->SetY($pdf->GetY()+12);



//$con = mysql_connect("localhost","root","") or die("");
//	mysql_select_db("shop", $con);
include_once("php/all.php");
	$order_id = $_SESSION['orderids'];
	//$order = 14;
	$sql = "SELECT * FROM orders WHERE orderid='$order_id'";
	$rs = mysql_query($sql) or die(mysql_error());
	
	while($details = mysql_fetch_array($rs)){
/*
$pdf->SetFont('Times','B',11);
	  $pdf->SetX($pdf->GetX()+10);
    $pdf->Cell(20,0,$details,0,0,'L');
	*/
	$prodnum = $details["prodnum"];
	$prod = "SELECT * FROM inventory WHERE id='$prodnum'";
	$prod2 = mysql_query($prod);
	$prod33 = mysql_fetch_array($prod2);
	extract ($prod33);
	$pdf->SetFont('Times','',11);
	  $pdf->SetX($pdf->GetX()+10);
    $pdf->Cell(20,0,$details['qty'],0,0,'L');
	
		$pdf->SetFont('Times','',11);
	  $pdf->SetX($pdf->GetX()+10);
    $pdf->Cell(20,0,$InvName,0,0,'L');
	
	$pdf->SetFont('Times','',11);
	  $pdf->SetX($pdf->GetX()+50);
    $pdf->Cell(20,0,number_format($InvPrice,2,"."," "),0,0,'L');

$tps = $details['qty']*$InvPrice;
$pdf->SetFont('Times','',11);
	  $pdf->SetX($pdf->GetX()+20);
    $pdf->Cell(20,0,number_format($tps,2,"."," "),0,0,'L');
		$pdf->SetY($pdf->GetY()+12);
	
	}
		$pdf->SetFont('Times','',11);
	  $pdf->SetX($pdf->GetX()+20);
    $pdf->Cell(20,0,'Your total before shipping is: ',0,0,'L');

$pdf->SetFont('Times','B',11);
	  $pdf->SetX($pdf->GetX()+56);
    $pdf->Cell(20,0,number_format($_SESSION["cart_t"],2,"."," "),0,0,'L');
	
		$pdf->SetY($pdf->GetY()+12);
	
		$pdf->SetFont('Times','',11);
	  $pdf->SetX($pdf->GetX()+20);
    $pdf->Cell(20,0,'Tax:',0,0,'L');

$pdf->SetFont('Times','B',11);
	  $pdf->SetX($pdf->GetX()+26);
    $pdf->Cell(20,0,number_format($_SESSION["tex"],2,"."," "),0,0,'L');
	

$pdf->SetFont('Times','',11);
	  $pdf->SetX($pdf->GetX()+20);
    $pdf->Cell(20,0,'Shipping Cost:',0,0,'L');

$pdf->SetFont('Times','B',11);
	  $pdf->SetX($pdf->GetX()+26);
    $pdf->Cell(20,0,'Free',0,0,'L');
	

		$pdf->SetY($pdf->GetY()+12);
		
		$pdf->SetFont('Times','',11);
	  $pdf->SetX($pdf->GetX()+20);
    $pdf->Cell(20,0,'Your final cost:',0,0,'L');

$pdf->SetFont('Times','B',11);
	  $pdf->SetX($pdf->GetX()+26);
    $pdf->Cell(20,0,number_format($_SESSION["gtotal"],2,"."," "),0,0,'L');

    $pdf->SetFont('Times','B',11);
    $pdf->SetY($pdf->GetY()+18);
    $pdf->Cell(20,0,'',0,0,'L');


	$pdf->SetFont('Times','BU',11);
	  $pdf->SetX($pdf->GetX()+5);
    $pdf->Cell(20,0,'                                      ',0,0,'L');
	
	$pdf->SetFont('Times','BU',11);
	  $pdf->SetX($pdf->GetX()+75);
    $pdf->Cell(40,0,'                                      ',0,1,'L');
	
	$pdf->SetFont('Times','B',11);
    $pdf->SetY($pdf->GetY()+5);
    $pdf->Cell(20,0,'',0,0,'L');


	$pdf->SetFont('Times','B',11);
	  $pdf->SetX($pdf->GetX()+5);
    $pdf->Cell(20,0,'  Customer Signature',0,0,'L');
	
	$pdf->SetFont('Times','B',11);
	  $pdf->SetX($pdf->GetX()+75);
    $pdf->Cell(40,0,'      Seller Signature',0,1,'L');

    $pdf->SetY($pdf->GetY()+10);
	$pdf->SetFont('Times','BU',11);
	  $pdf->SetX($pdf->GetX()+5);
    $pdf->Cell(20,0,'Note: Not valid unless signed by both Customer and Seller',0,0,'L');
	
	$pdf->SetFont('Times','B',11);
	  $pdf->SetX($pdf->GetX()+75);
    $pdf->Cell(40,0,'',0,1,'L');
	

	$pdf->SetY($pdf->GetY()+8);
    
	
	$pdf->SetY($pdf->GetY()+12);
	$pdf->SetY(-28);


	
	$pdf->SetX(-500);
	 $pdf->SetDrawColor(226,226,5);
	 $pdf->SetFillColor(226,226,5);
	 $pdf->SetLineWidth(0.4);
	  $pdf->SetX($pdf->GetX()-20);
    $pdf->Cell(400,0,'',1,1);
	
	$pdf->SetY($pdf->GetY()+1);

	$pdf->SetX(-500);
 	$pdf->SetDrawColor(72,73,113);
	 $pdf->SetFillColor(72,73,113);
	 $pdf->SetLineWidth(0.4);
	  $pdf->SetX($pdf->GetX()-20);
    $pdf->Cell(400,0,'',1,1);

	$pdf->SetY($pdf->GetY()+5);
	
	$pdf->SetFont('Times','B',9);
	  $pdf->SetX($pdf->GetX());
    $pdf->Cell(20,0,date("Y").' (C) Oduduwa University Ile-Ife. All right reserved.',0,0,'L');

	
	$pdf->Output();
//print_r($prod33);
?>
