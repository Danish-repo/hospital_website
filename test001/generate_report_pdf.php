<?php
#--------------------------------------------------------------------------------------------------
# include fail2 yang penting
require 'fpdf182/fpdf.php';
require 'class_fpdfv01.php';
require 'tatarajah.php';
require 'Database.php';
include 'patient.php';
#--------------------------------------------------------------------------------------------------
# mula panggil data dari sql
$id=isset($_GET['id_patient']) ? $_GET['id_patient'] : die('ERROR: Record ID not found.');
$body1=new Database();
$link=$body1->MyDatabase();
$data=new patient($link);
$row = $data->ReadOneV02($id);
#--------------------------------------------------------------------------------------------------
# mula panggil fail pdf
$pdf = new FPDF();
#--------------------------------------------------------------------------------------------------
# setkan pembolehubah berdasarkan $pdf
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
# papar tajuk utama
//$pdf->Cell(40,10,'Hello World!');
$pdf->Cell(40,10,'Patient Details');
// Thickness of frame (1 mm)
$this->SetLineWidth(5);
#--------------------------------------------------------------------------------------------------
# papar output last
$pdf->Output();