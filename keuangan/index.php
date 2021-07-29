<?php
include '../includes/config.php';
include '../includes/header.php';
include 'navbar-keuangan.php';
if(isset($_POST['cari'])){
    $cari = $_POST['cari'];
    $pendapat = mysqli_query($conn, "SELECT tanggal,COUNT(IF (tipe='masuk',id_pembayaran,NULL)) AS 'transaksi Masuk', COUNT(IF (tipe='keluar',id_pembayaran,NULL)) AS 'transaksi Keluar', (SUM(IF (tipe='keluar',total_harga,0))-SUM(IF (tipe='masuk',total_harga,0))) AS Pendapatan FROM `t_pembayaran` where tanggal like '%$cari%' GROUP BY tanggal");
}else{
    $pendapat = mysqli_query($conn, "SELECT tanggal,COUNT(IF (tipe='masuk',id_pembayaran,NULL)) AS 'transaksi Masuk', COUNT(IF (tipe='keluar',id_pembayaran,NULL)) AS 'transaksi Keluar', (SUM(IF (tipe='keluar',total_harga,0))-SUM(IF (tipe='masuk',total_harga,0))) AS Pendapatan FROM `t_pembayaran` GROUP BY tanggal");
}

?>

<div class="container">
    <div class="row mt-3">
        <div class="col-6 col-md-9">
            <div class="tbhdata__search">
                <a href="cetak.php" class="btn btn-dark d-inline">Cetak</a>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <form action="index.php" method="POST" class="d-flex justify-end">
                <input class="form-control me-2" name="cari" type="search" placeholder="Masukkan kata kunci..." aria-label="Search">
                <button class="btn btn-dark" namevalue="$cari" type="submit">Search</button>
            </form>
        </div>
    </div>
</div>


<div class="container mt-3">
    <h5>Keuangan</h5>
    <table class="table table-striped table-hover">
        <tr>
            <th class="col-md-1">No</th>
            <th class="col-md-2">Tanggal</th>
            <th class="col-md-2">Transaksi masuk</th>
            <th class="col-md-2">Transaksi keluar</th>
            <th class="col-md-1">Pendapatan</th>
        </tr>
        <?php 
        $no = 0;
        while($data = mysqli_fetch_array($pendapat)){
            $no = $no + 1; 
        ?>
        <tr>
            <td><?php echo $no;?></td>
            <td><?php echo $data['tanggal'];?></td>
            <td><?php echo $data['transaksi Masuk'];?> </td>
            <td><?php echo $data['transaksi Keluar'];?></td>
            <td><?php echo $data['Pendapatan'];?></td>
        </tr>
        <?php } ?>
    </table>
</div>



<?php
include '../includes/footer.php';
?>