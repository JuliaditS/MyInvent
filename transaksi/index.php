<?php
include '../includes/config.php';
$querykeluar = mysqli_query($conn,"SELECT `t_barang`.*, `t_transaksi`.*, `t_pembayaran`.*, `t_pembayaran`.`tipe` FROM `t_barang` LEFT JOIN `t_transaksi` ON `t_transaksi`.`kode_barang` = `t_barang`.`kode_barang` LEFT JOIN `t_pembayaran` ON `t_transaksi`.`id_pembayaran` = `t_pembayaran`.`id_pembayaran` WHERE `t_pembayaran`.`tipe` = 'keluar'");

$querymasuk = mysqli_query($conn,"SELECT `t_barang`.*, `t_transaksi`.*, `t_pembayaran`.*, `t_pembayaran`.`tipe` FROM `t_barang` LEFT JOIN `t_transaksi` ON `t_transaksi`.`kode_barang` = `t_barang`.`kode_barang` LEFT JOIN `t_pembayaran` ON `t_transaksi`.`id_pembayaran` = `t_pembayaran`.`id_pembayaran` WHERE `t_pembayaran`.`tipe` = 'keluar'");



include '../includes/header.php';
include '../includes/navbar.php';
?>

<div class="container">
    <div class="row mt-3">
        <div class="col-6 col-md-9">
            <div class="tbhdata__search">
                <a href="tambah-transaksi.php" class="btn btn-dark d-inline">Tambah Transaksi</a>
            </div>
        </div>

        <!-- <div class="col-6 col-md-3">
            <form class="d-flex justify-end">
                <input class="form-control me-2" type="search" placeholder="Masukkan kata kunci..." aria-label="Search">
                <button class="btn btn-dark" type="submit">Search</button>
            </form>
        </div> -->
    </div>
</div>


<div class="container mt-3">
    <div class="row">
        <div class="col-md-6">
            <h5>Barang Masuk</h5>
            <table class="table table-striped table-hover">
                <tr>
                    <th class="col-md-1">No</th>
                    <th class="col-md-2">Nama Barang</th>
                    <th class="col-md-2">Jumlah</th>
                    <th class="col-md-2">Total Harga</th>
                    <th class="col-md-1">Tanggal</th>
                </tr>
            <?php 
            $no = 0;
            while($datamasuk = mysqli_fetch_array($querymasuk)){
            $no = $no + 1;
            $totalharga = $datamasuk['jumlah'] * $datamasuk['harga'];
            ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $datamasuk['nama'];?></td>
                    <td><?php echo $datamasuk['jumlah'];?></td>
                    <td>Rp. <?php echo $totalharga;?></td>
                    <td><?php echo $datamasuk['tanggal'];?></td>
                </tr>
            <?php
            }
            ?>
            </table>

        </div>
        <div class="col-md-6">
            <h5>Barang Keluar</h5>
            <table class="table table-striped table-hover">
                <tr>
                    <th class="col-md-1">No</th>
                    <th class="col-md-2">Nama Barang</th>
                    <th class="col-md-2">Jumlah</th>
                    <th class="col-md-2">Total Harga</th>
                    <th class="col-md-1">Tanggal</th>
                </tr>
                <?php 
                $no2 = 0;
                while($datakeluar = mysqli_fetch_array($querykeluar)){
                $no2 = $no2 + 1;
                $totalharga2 = $datakeluar['jumlah'] * $datakeluar['harga'];
                ?>
                    <tr>
                        <td><?php echo $no2; ?></td>
                        <td><?php echo $datakeluar['nama'];?></td>
                        <td><?php echo $datakeluar['jumlah'];?></td>
                        <td>Rp. <?php echo $totalharga2;?></td>
                        <td><?php echo $datakeluar['tanggal'];?></td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
</div>
</div>
</div>



<?php
include '../includes/footer.php';
?>