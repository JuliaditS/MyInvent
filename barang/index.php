<?php
include '../includes/header.php';
include 'navbar-barang.php';
include '../includes/config.php';

//mengambil data pada t_barang
$dataBarang = mysqli_query($conn, "SELECT * FROM t_barang");

//mengambil data pada t_barang jika user menekan tombol cari
if (isset($_POST['cari'])) {
    $katakunci = $_POST['katakunci'];
    $dataBarang = mysqli_query($conn, "SELECT * FROM t_barang 
                                        WHERE nama LIKE '%$katakunci%' OR harga LIKE  '%$katakunci%'");
}
?>

<div class="container">
    <div class="row mt-5">
        <div class="col-6 col-md-9">
            <div class="tbhdata__search">
                <a href="tambah-barang.php" class="btn btn-dark d-inline">Tambah Barang</a>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <form class="d-flex justify-end" action="" method="POST">
                <input class="form-control me-2" type="text" name="katakunci" placeholder="Masukkan kata kunci..." aria-label="Search">
                <button class="btn btn-dark" type="submit" name="cari">Cari</button>
            </form>
        </div>
    </div>
</div>

<div class="container mt-3">
    <table class="table table-striped table-hover">
        <tr>
            <th class="col-md-2">No</th>
            <th class="col-md-2">Nama Barang</th>
            <th class="col-md-2">Jumlah</th>
            <th class="col-md-2">Harga</th>
            <th class="col-md-1">Aksi</th>
        </tr>
        <?php
        $i = 1;
        foreach ($dataBarang as $data) { ?>
            <tr>
                <td><?= $i; ?></td>
                <td><?= $data['nama']; ?></td>
                <td><?= $data['stok']; ?></td>
                <td><?= rupiah($data['harga']); ?></td>
                <td>
                    <a href="edit-barang.php?kode_barang=<?php echo $data["kode_barang"]; ?>" class="btn btn-warning"><i class='bx bx-edit'></i></a>
                    <a href="hapus-barang.php?kode_barang=<?php echo $data["kode_barang"]; ?>" onclick="return confirm('Yakin?')" class="btn btn-danger"><i class='bx bx-trash'></i></a>
                </td>
            </tr>
        <?php $i++;
        } ?>

    </table>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                    < Previous</a> </li> <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">4</a></li>
            <li class="page-item"><a class="page-link" href="#">5</a></li>
            <li class="page-item">
                <a class="page-link" href="#">Next ></a>
            </li>
        </ul>
    </nav>
</div>



<?php
include '../includes/footer.php';
?>