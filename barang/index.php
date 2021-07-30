<?php
include '../includes/header.php';
include 'navbar-barang.php';
include '../includes/config.php';
if (!isset($_SESSION["id_user"]))
    header("Location: ../index.php?error=2");


?>

<div class="container">
    <div class="row mt-5">
        <div class="col-6 col-md-9">
            <div class="tbhdata__search">
                <a href="tambah-barang.php" class="btn btn-dark d-inline">Tambah Barang</a>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <form class="d-flex justify-end" action="" method="GET">
                <input class="form-control me-2" type="text" name="dicari" placeholder="Masukkan kata kunci..." aria-label="Search" value="<?php echo isset($_GET["dicari"]) ? $_GET["dicari"] : ""; ?>">
                <input class="btn btn-dark" type="submit" value="Cari">
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
            $data_barang = getListBarang(Null,Null,$tipe,$cari);
            $halaman = (isset($_GET['halaman']))?(int)$_GET['halaman'] : 1;
            $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;
            $previous = $halaman - 1;
            $next = $halaman + 1;

            $jumlah_data = count($data_barang);
            $total_halaman = ceil($jumlah_data / $batas);

            $databaris = getListBarang($halaman_awal,$batas,$tipe,$cari); // ambil seluruh baris data
            $i = $halaman_awal+1;
        foreach ($databaris as $data) { ?>
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