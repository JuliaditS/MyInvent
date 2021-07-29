<?php 
	session_start();
	$host       =   "localhost";
	$user       =   "root";
	$password   =   "123";
	$database   =   "siabangade";
	$conn = mysqli_connect($host, $user, $password, $database);
		if($conn === false){
			die("ERROR: Could not connect. " . mysqli_connect_error());
		}
 	
 	function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,0,',','.');
	return $hasil_rupiah;
 
	}

define("DEVELOPMENT", TRUE);
function dbConnect()
{
	$db = new mysqli("localhost", "root", "", "siabangade"); // Sesuaikan dengan konfigurasi server anda.
	return $db;
}

function getListBarang($halaman_awal=Null, $batas=Null, $tipe="semua", $cari=Null)
{
	$db = dbConnect();
	if ($db->connect_errno == 0) {
		if ($tipe=="semua")
			$sql = "SELECT * FROM t_barang ORDER BY nama ".(($halaman_awal==Null&&$batas==Null) ? "" : "limit $halaman_awal, $batas");
		else
			$sql = "SELECT * FROM t_barang WHERE nama like '%$cari%' OR stok like '%$cari%' OR harga like '%$cari%' ORDER BY nama ".(($halaman_awal==Null&&$batas==Null) ? "" : "limit $halaman_awal, $batas");  
		$res = $db->query($sql);
		if ($res) {
			$data = $res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		} else
			return FALSE;
	} else
		return FALSE;
}

function getListUser($halaman_awal=Null, $batas=Null, $tipe="semua", $cari=Null)
{
	$db = dbConnect();
	if ($db->connect_errno == 0) {
		if ($tipe=="semua")
			$sql = "SELECT * FROM t_user ORDER BY nama ".(($halaman_awal==Null&&$batas==Null) ? "" : "limit $halaman_awal, $batas");
		else
			$sql = "SELECT * FROM t_user WHERE username like '%$cari%' OR nama like '%$cari%' ORDER BY nama ".(($halaman_awal==Null&&$batas==Null) ? "" : "limit $halaman_awal, $batas");  
		$res = $db->query($sql);
		if ($res) {
			$data = $res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		} else
			return FALSE;
	} else
		return FALSE;
}
?>