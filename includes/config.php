<?php 
	session_start();
	$host       =   "localhost";
	$user       =   "root";
	$password   =   "";
	$database   =   "siabangade";
	$conn = mysqli_connect($host, $user, $password, $database);
		if($conn === false){
			die("ERROR: Could not connect. " . mysqli_connect_error());
		}
 	
 	function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,0,',','.');
	return $hasil_rupiah;
 
	}
?>

