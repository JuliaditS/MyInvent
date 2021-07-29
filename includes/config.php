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

?>