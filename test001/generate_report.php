<?php
#--------------------------------------------------------------------------------------------------
# include fail2 yang penting
require 'fpdf182/fpdf.php';
require 'class_fpdfv01.php';
require 'tatarajah.php';
require 'Database.php';
require 'patient.php';
#--------------------------------------------------------------------------------------------------
# mula panggil data dari sql
$id = isset($_GET['id_patient']) ? $_GET['id_patient'] : die('ERROR: Record ID not found.');
$body1 = new Database();
$link = $body1->MyDatabase();
$body2 = new patient($link);
$row = $body2->ReadOneV02($id);
//semakPembolehubah($row,'row');# semak nilai $row wujud atau tidak
#--------------------------------------------------------------------------------------------------
# mula panggil fail pdf
//$pdf = new FPDF();
$pdf = new PDF( 'P', 'mm', 'A4' ); // A4, portrait, measurements in mm.
#--------------------------------------------------------------------------------------------------
# setkan pembolehubah berdasarkan $pdf
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
# papar tajuk utama
//$pdf->Cell(40,10,'Hello World!');
$pdf->Cell(30,10,'Patient Details');
#--------------------------------------------------------------------------------------------------
# buat line - http://www.fpdf.org/en/script/script33.php
$pdf->SetLineWidth(2);
$pdf->SetDash(); //restores no dash
$pdf->Line(10,20,190,20);
$pdf->Ln(50);
#-------------------------------------------------------------------------------------------------
//Fields Name position
$Y_Fields_Name_position = 20;
//Bold Font for Field Name
$pdf->SetFont('Arial',null,12);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(10);
$pdf->Ln();//*/
#-------------------------------------------------------------------------------------------------
# papar data $row
$pdf->Cell(20,10,'ID',0);
$pdf->Cell(40,10,'Name',0);
$pdf->Cell(80,10,'Description',0);
$pdf->Cell(40,10,'Admission',0);
$pdf->Ln();
#-------------------------------------------------------------------------------------------------
# papar data $row
$pdf->Cell(20,10,$row['id_patient'],0);
$pdf->Cell(40,10,$row['patient_name'],0);
$pdf->Cell(80,10,$row['description'],0);
$pdf->Cell(40,10,$row['admission'],0);
$pdf->Ln();
#-------------------------------------------------------------------------------------------------
# papar output last
$pdf->Output();