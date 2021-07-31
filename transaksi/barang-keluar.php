<?php
include '../includes/config.php';
if (!isset($_SESSION["id_user"]))
    header("Location: ../index.php?error=2");
$querykeluar = mysqli_query($conn, "SELECT id_pembayaran,`tanggal`,total_harga,uang_pembayaran,uang_kembalian  FROM `t_pembayaran` WHERE tipe = 'keluar' ORDER BY tanggal desc");



include '../includes/header.php';
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">MyInvent</a>
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
                    <th class="col-md-2">Id Pembayaran</th>
                    <th class="col-md-2">tanggal</th>
                    <th class="col-md-2">Uang Pembayaran</th>
                    <th class="col-md-2">Uang Kembalian</th>
                    <th class="col-md-2">Total Harga</th>
                    <th class="col-md-1">Aksi</th>
                </tr>
                <?php
                $batas=10;
            $data_barang = getListTransaksi(Null,Null,"keluar");
            $halaman = (isset($_GET['halaman']))?(int)$_GET['halaman'] : 1;
            $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;
            $previous = $halaman - 1;
            $next = $halaman + 1;

            $jumlah_data = count($data_barang);
            $total_halaman = ceil($jumlah_data / $batas);

            $databaris = getListTransaksi($halaman_awal,$batas,"keluar"); // ambil seluruh baris data
            $i = $halaman_awal+1;
        foreach ($databaris as $datakeluar) { ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $datakeluar['id_pembayaran']; ?></td>
                        <td><?php echo $datakeluar['tanggal']; ?></td>
                        <td><?php echo rupiah($datakeluar['uang_pembayaran']); ?></td>
                        <td><?php echo rupiah($datakeluar['uang_kembalian']); ?></td>
                        <td><?php echo rupiah($datakeluar['total_harga']); ?></td>
                        <td>
                            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#detail<?php echo $datakeluar['id_pembayaran']; ?>">
                                Detail
                            </button>
                            <div class="modal fade" id="detail<?php echo $datakeluar['id_pembayaran']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Detail Transaksi</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <?php
                                            $sql = "SELECT t_barang.nama AS 'nama', t_barang.harga AS 'harga', t_transaksi.jumlah, (t_barang.harga*t_transaksi.jumlah) AS 'Total Harga' FROM t_transaksi JOIN t_barang ON t_transaksi.kode_barang=t_barang.kode_barang WHERE id_pembayaran = " . $datakeluar['id_pembayaran'];
                                            $query = mysqli_query($conn, $sql);

                                            ?>

                                            <table class="table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="col-md-1">No</th>
                                                        <th class="col-md-2">Nama</th>
                                                        <th class="col-md-2">Harga</th>
                                                        <th class="col-md-2">Jumlah</th>
                                                        <th class="col-md-2">Total Harga</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $nos = 0;
                                                    while ($data = mysqli_fetch_array($query)) {
                                                        $nos = $nos+ 1;
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $nos; ?></td>
                                                            <td><?php echo $data['nama']; ?></td>
                                                            <td><?php echo rupiah($data['harga']); ?></td>
                                                            <td><?php echo $data['jumlah']; ?></td>
                                                            <td><?php echo rupiah($data['Total Harga']); ?></td>
                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>


                <?php $i++;
                }
                ?>
            </table>
            <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
              <li class="page-item <?php if($halaman==1) echo "disabled"; ?>"><a class="page-link" <?php if($halaman > 1){ echo "href='?halaman=$previous"; } ?>>Previous</a></li>
              <?php 
              for($x=1;$x<=$total_halaman;$x++){
               ?>
              <li class="page-item <?php if($halaman==$x) echo "active"; ?>"><a class="page-link" href="?halaman=<?php echo $x?>"><?php echo $x; ?></a></li>
              <?php 
              }
               ?>
              <li class="page-item <?php if($halaman>=$total_halaman) echo "disabled"; ?>"><a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?halaman=$next'"; } ?>>Next</a></li>
            </ul>
        </div>
    </div>
</div>
</div>
</div>



<?php
include '../includes/footer.php';
?>