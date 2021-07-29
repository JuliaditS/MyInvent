<?php
include '../includes/header.php';
include '../includes/config.php';

//mengambil data pada tabel user
$dataUser = mysqli_query($conn, "SELECT * FROM t_user");

//mengambil data pada tabel user jika user menekan tombol cari
if (isset($_POST['cari'])) {
    $katakunci = $_POST['katakunci'];
    $dataUser = mysqli_query($conn, "SELECT * FROM t_user 
                                        WHERE nama LIKE '%$katakunci%' OR username LIKE  '%$katakunci%'");
}
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
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row mt-5">
        <div class="col-6 col-md-9">
            <div class="tbhdata__search">
                <a href="tambah-user.php" class="btn btn-dark d-inline">Tambah User</a>
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
            <th class="col-md-2">Nama User</th>
            <th class="col-md-2">Username</th>
            <th class="col-md-1">Aksi</th>
        </tr>
        <?php
        $i = 1;
        foreach ($dataUser as $data) { ?>
            <tr>
                <td><?= $i; ?></td>
                <td><?= htmlspecialchars($data['nama']); ?></td>
                <td><?= htmlspecialchars($data['username']); ?></td>
                <td>
                    <a href="edit-user.php?id_user=<?php echo $data["id_user"]; ?>" class="btn btn-warning"><i class='bx bx-edit'></i></a>
                    <a href="hapus-user.php?id_user=<?php echo $data["id_user"]; ?>" onclick="return confirm('Yakin?')" class="btn btn-danger"><i class='bx bx-trash'></i></a>
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