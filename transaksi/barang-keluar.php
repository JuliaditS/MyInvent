<?php
include '../includes/config.php';
$querykeluar = mysqli_query($conn, "SELECT `t_barang`.*, `t_transaksi`.*, `t_pembayaran`.*, `t_pembayaran`.`tipe` FROM `t_barang` LEFT JOIN `t_transaksi` ON `t_transaksi`.`kode_barang` = `t_barang`.`kode_barang` LEFT JOIN `t_pembayaran` ON `t_transaksi`.`id_pembayaran` = `t_pembayaran`.`id_pembayaran` WHERE `t_pembayaran`.`tipe` = 'keluar'");

$querymasuk = mysqli_query($conn, "SELECT `t_barang`.*, `t_transaksi`.*, `t_pembayaran`.*, `t_pembayaran`.`tipe` FROM `t_barang` LEFT JOIN `t_transaksi` ON `t_transaksi`.`kode_barang` = `t_barang`.`kode_barang` LEFT JOIN `t_pembayaran` ON `t_transaksi`.`id_pembayaran` = `t_pembayaran`.`id_pembayaran` WHERE `t_pembayaran`.`tipe` = 'keluar'");



include '../includes/header.php';
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="../dashboard.php">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownData" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Data
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownData">
                        <li><a class="dropdown-item" href="../user/index.php">Data User</a></li>
                        <li><a class="dropdown-item" href="../barang/index.php">Data Barang</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Transaksi
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="../transaksi/barang-masuk.php">Barang Masuk</a></li>
                        <li><a class="dropdown-item" href="../transaksi/barang-keluar.php">Barang Keluar</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="../keuangan/index.php">Keuangan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row mt-3">
        <div class="col-6 col-md-9">
            <div class="tbhdata__search">
                <a href="tambah-barang-keluar.php" class="btn btn-dark d-inline">Tambah Transaksi</a>
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
        <div class="col-md-12">
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
                while ($datakeluar = mysqli_fetch_array($querykeluar)) {
                    $no2 = $no2 + 1;
                    $totalharga2 = $datakeluar['jumlah'] * $datakeluar['harga'];
                ?>
                    <tr>
                        <td><?php echo $no2; ?></td>
                        <td><?php echo $datakeluar['nama']; ?></td>
                        <td><?php echo $datakeluar['jumlah']; ?></td>
                        <td>Rp. <?php echo $totalharga2; ?></td>
                        <td><?php echo $datakeluar['tanggal']; ?></td>
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