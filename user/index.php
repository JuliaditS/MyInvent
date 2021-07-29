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
            <form class="d-flex justify-end" action="" method="GET">
                <input class="form-control me-2" type="text" name="dicari" placeholder="Masukkan kata kunci..." aria-label="Search" value="<?php echo isset($_GET["dicari"]) ? $_GET["dicari"] : ""; ?>">
                <input type="button" class="btn btn-dark" type="submit" value="Cari">
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
        if (!isset($_GET["dicari"])) {
                $tipe = "semua";
                $cari = Null;
            } else {
                $tipe = "cari";
                $cari = $_GET["dicari"];
                if ($cari=="")
                    $tipe = "semua";
            }
            $batas=10;
            $data_barang = getListUser(Null,Null,$tipe,$cari);
            $halaman = (isset($_GET['halaman']))?(int)$_GET['halaman'] : 1;
            $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;
            $previous = $halaman - 1;
            $next = $halaman + 1;

            $jumlah_data = count($data_barang);
            $total_halaman = ceil($jumlah_data / $batas);

            $dataUser = getListUser($halaman_awal,$batas,$tipe,$cari); // ambil seluruh baris data
            $i = $halaman_awal+1;
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
              <li class="page-item <?php if($halaman==1) echo "disabled"; ?>"><a class="page-link" <?php if($halaman > 1){ echo "href='?halaman=$previous&dicari=$cari'"; } ?>>Previous</a></li>
              <?php 
              for($x=1;$x<=$total_halaman;$x++){
               ?>
              <li class="page-item <?php if($halaman==$x) echo "active"; ?>"><a class="page-link" href="?halaman=<?php echo $x."&dicari=".$cari ?>"><?php echo $x; ?></a></li>
              <?php 
              }
               ?>
              <li class="page-item <?php if($halaman>=$total_halaman) echo "disabled"; ?>"><a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?halaman=$next&dicari=$cari'"; } ?>>Next</a></li>
            </ul>
    </nav>
</div>



<?php
include '../includes/footer.php';
?>