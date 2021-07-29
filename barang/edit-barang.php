<?php
include '../includes/header.php';
include 'navbar-barang.php';
include '../includes/config.php';

$pesan = ""; //diguanakan sebagai pesan eror validasi 
$kode_barang = $_GET['kode_barang']; //mengambil id_user
$ambil = mysqli_query($conn, "SELECT * FROM t_barang WHERE kode_barang = '$kode_barang'");
$data = mysqli_fetch_array($ambil);

if (isset($_POST['submit'])) {
    $kode_barang = htmlspecialchars($_POST['kode_barang']);
    $nama = htmlspecialchars($_POST['nama']);
    $stok = htmlspecialchars($_POST['stok']);
    $harga = htmlspecialchars($_POST['harga']);

    //validasi jika nama kosong
    if (empty($nama)) {
        $pesan = "<div class='alert alert-danger' role='alert'>
                          Nama barang tidak boleh kosong!
                        </div>";
    }

    //validasi jika stok kosong
    elseif (empty($stok)) {
        $pesan = "<div class='alert alert-danger' role='alert'>
                          Jumlah stok tidak boleh kosong!
                        </div>";
    }

    //validasi jika harga kosong
    elseif (empty($harga)) {
        $pesan = "<div class='alert alert-danger' role='alert'>
                          Harga tidak boleh kosong!
                        </div>";
    } else {
        $query = "UPDATE t_barang SET 
                    nama = '$nama',
                    stok = '$stok',
                    harga = '$harga'
                    WHERE kode_barang = '$kode_barang'";
        $update = mysqli_query($conn, $query); //mengubah data di tabel t_barang berdasarkan kode barang yang didapatkan
        if ($update) {

            $pesan = "<div class='alert alert-success' role='alert'>
                              Ubah data barang berhasil
                            </div>";
            header("Refresh: 2; url=index.php");
        } else {
            $pesan = "<div class='alert alert-success' role='alert'>
                              Ubah data barang gagal
                            </div>";
        }
    }
}

?>
<section id="cover">
    <div id="cover-caption">
        <div id="container" class="container mt-3">
            <h5 class="mb-3">Edit Barang</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="info-form">
                        <form action="" method="POST" class="form-inline justify-content-center">
                            <?= $pesan; ?>
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-md-3">
                                    <label class="col-form-label">Kode Barang</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" readonly name="kode_barang" value="<?= $data['kode_barang']; ?>" class="form-control"></input>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-md-3">
                                    <label class="col-form-label">Nama Barang</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="nama" value="<?= $data['nama']; ?>" class="form-control"></input>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-md-3">
                                    <label class="col-form-label">Jumlah</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="number" name="stok" value="<?= $data['stok']; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-md-3">
                                    <label class="col-form-label">Harga</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="harga" value="<?= $data['harga']; ?>" class="form-control">
                                </div>
                            </div>


                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-md-3">
                                    <label class="col-form-label"></label>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" name="submit" class="btn btn-dark ">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include '../includes/footer.php';
?>