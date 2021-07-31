<?php
include 'includes/config.php';
include 'includes/header.php';
include 'includes/navbar.php';
if (!isset($_SESSION["id_user"]))
    header("Location: index.php?error=2");
$query = mysqli_query($conn, "SELECT COUNT(IF (tipe='masuk',id_pembayaran,NULL)) AS 'Barang Masuk', COUNT(IF (tipe='keluar',id_pembayaran,NULL)) AS 'Barang Keluar',(SUM(IF (tipe='keluar',total_harga,0))) AS pendapatan, (SUM(IF (tipe='keluar',total_harga,0))-SUM(IF (tipe='masuk',total_harga,0))) AS Keuntungan FROM `t_pembayaran` ");
$data = mysqli_fetch_array($query);
?>
<div class="container mt-1">
    <div class="row justify-content-between text-white text-center mt-4">
        <div class="col-md-2 bg-primary box__dashboard">
            <i class='bx bx-arrow-from-top box__dashboard'></i> Barang Masuk <h2><?php echo $data['Barang Masuk']; ?></h2>
        </div>
        <div class="col-md-2 bg-info box__dashboard mt-1">
            <i class='bx bx-arrow-from-bottom'></i> Barang Keluar <h2><?php echo $data['Barang Keluar']; ?></h2>
        </div>
        <div class="col-md-2 bg-warning box__dashboard mt-1">
            <i class='bx bx-transfer'></i> Jumlah Transaksi <h2><?php echo $data['Barang Keluar'] + $data['Barang Masuk']; ?></h2>
        </div>
        <div class="col-md-2 bg-dark box__dashboard mt-1">
            <i class='bx bx-money'></i> Pendapatan <h2><?php echo $data['pendapatan']; ?></h2>
        </div>
        <div class="col-md-2 bg-danger box__dashboard mt-1">
            <i class='bx bx-plus-circle'></i> Keuntungan <h2><?php echo $data['Keuntungan']; ?></h2>
        </div>
    </div>

</div>


<?php
include 'includes/footer.php';
?>