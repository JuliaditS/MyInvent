<?php
include '../includes/config.php';
require('../includes/pdf/fpdf.php');
if (!isset($_SESSION["id_user"]))
    header("Location: ../index.php?error=2");


$query = "SELECT tanggal,COUNT(IF (tipe='masuk',id_pembayaran,NULL)) AS 'transaksi Masuk', COUNT(IF (tipe='keluar',id_pembayaran,NULL)) AS 'transaksi Keluar', (SUM(IF (tipe='keluar',total_harga,0))-SUM(IF (tipe='masuk',total_harga,0))) AS Pendapatan FROM `t_pembayaran` GROUP BY tanggal";
$sql = mysqli_query($conn, $query);
$data = array();
while ($row = mysqli_fetch_assoc($sql)) {
	array_push($data, $row);
}
 
#setting judul laporan dan header tabel
$judul = "LAPORAN DATA KEUANGAN";
$header = array(
		array("label"=>"Tanggal", "length"=>30, "align"=>"L"),
		array("label"=>"Transaksi Masuk", "length"=>50, "align"=>"L"),
		array("label"=>"Transaksi Keluar", "length"=>80, "align"=>"L"),
		array("label"=>"Pendapatan", "length"=>30, "align"=>"L")
	);
 
#sertakan library FPDF dan bentuk obje
$pdf = new FPDF();
$pdf->AddPage();
 
#tampilkan judul laporan
$pdf->SetFont('Arial','B','16');
$pdf->Cell(0,20, $judul, '0', 1, 'C');
 
#buat header tabel
$pdf->SetFont('Arial','','10');
$pdf->SetFillColor(255,0,0);
$pdf->SetTextColor(255);
$pdf->SetDrawColor(128,0,0);
// foreach ($header as $kolom) {
// 	$pdf->Cell($kolom['length'], 5, $kolom['label'], 1, '0', $kolom['align'], true);
// }
// $pdf->Ln();
$width_cell=array(20,50,40,40,40);
$pdf->Cell($width_cell[0],10,'No.',1,0,'C',true);
//Second header column//
$pdf->Cell($width_cell[1],10,'Tanggal',1,0,'C',true);
//Third header column//
$pdf->Cell($width_cell[2],10,'Transaksi Masuk',1,0,'C',true); 
//Fourth header column//
$pdf->Cell($width_cell[3],10,'Transaksi Keluar',1,0,'C',true);
//Third header column//
$pdf->Cell($width_cell[4],10,'Pendapatan',1,1,'C',true);
 
#tampilkan data tabelnya
$pdf->SetFillColor(224,235,255);
$pdf->SetTextColor(0);
$pdf->SetFont('');
$fill=false;

foreach ($sql as $row) {
	$i = 1;
	$pdf->Cell($width_cell[0],10,$i,1,0,'C',$fill);
	$pdf->Cell($width_cell[1],10,$row['tanggal'],1,0,'C',$fill);
	$pdf->Cell($width_cell[2],10,$row['transaksi Masuk'],1,0,'L',$fill);
	$pdf->Cell($width_cell[3],10,$row['transaksi Keluar'],1,0,'L',$fill);
	$pdf->Cell($width_cell[4],10,rupiah($row['Pendapatan']),1,0,'L',$fill);

	//to give alternate background fill  color to rows//
	$i++;
	$fill = !$fill;
}
 
#output file PDF
$pdf->Output();
?>