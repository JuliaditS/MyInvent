<?php
include '../includes/config.php';
require('../includes/pdf/fpdf.php');


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
foreach ($header as $kolom) {
	$pdf->Cell($kolom['length'], 5, $kolom['label'], 1, '0', $kolom['align'], true);
}
$pdf->Ln();
 
#tampilkan data tabelnya
$pdf->SetFillColor(224,235,255);
$pdf->SetTextColor(0);
$pdf->SetFont('');
$fill=false;
foreach ($data as $baris) {
	$i = 0;
	foreach ($baris as $cell) {
		$pdf->Cell($header[$i]['length'], 5, $cell, 1, '0', $kolom['align'], $fill);
		$i++;
	}
	$fill = !$fill;
	$pdf->Ln();
}
 
#output file PDF
$pdf->Output();
?>