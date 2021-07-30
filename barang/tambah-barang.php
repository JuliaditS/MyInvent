<?php
include '../includes/header.php';
include 'navbar-barang.php';
include '../includes/config.php';
if (!isset($_SESSION["id_user"]))
    header("Location: ../index.php?error=2");

//membuat kode otomatis
$query = mysqli_query($conn, "SELECT MAX(kode_barang) as kode_terbesar FROM t_barang");
$data  = mysqli_fetch_array($query);
$kodeBarang  = $data['kode_terbesar'];
$urutan = (int)substr($kodeBarang, 5, 5);
$urutan++;
$huruf = "BRG";
$KodeBaru = $huruf . sprintf("%05s", $urutan);

$pesan = ""; //diguanakan sebagai pesan eror validasi 
if (isset($_POST['submit'])) {
    $kode_barang = htmlspecialchars($_POST['kode_barang']);
    $nama = htmlspecialchars($_POST['nama']);
    $harga = htmlspecialchars($_POST['harga']);
    $stok = htmlspecialchars($_POST['stok']);
    $cekNama = mysqli_query($conn, "SELECT nama FROM t_barang WHERE nama = '$nama'");

    //validasi jika nama barang kosong
    if (empty($nama)) {
        $pesan = "<div class='alert alert-danger' role='alert'>
                          Nama barang wajib diisi!
                        </div>";
    }

    //validasi jika harga kosong
    elseif (empty($harga)) {
        $pesan = "<div class='alert alert-danger' role='alert'>
                          Harga wajib diisi!
                        </div>";
    }

    //validasi jika stok kosong
    elseif (empty($stok)) {
        $pesan = "<div class='alert alert-danger' role='alert'>
                          Jumlah stok wajib diisi!
                        </div>";
    } else {
        $harga = $harga * 1000;

        //memasukan data ke tabel t_barang
        $masuk = mysqli_query($conn, "INSERT INTO t_barang VALUES('$kode_barang','$nama','$harga','$stok')");

        if ($masuk) {
            $pesan = "<div class='alert alert-success' role='alert'>
                          Tambah data barang berhasil
                        </div>";
            header("Refresh: 2, url=index.php");
        } else {
            $pesan = "<div class='alert alert-danger' role='alert'>
                          Tambah data barang gagal
                        </div>";
        }
    }
}

?>
<section id="cover">
    <div id="cover-caption">
        <div id="container" class="container mt-3">
            <h5 class="mb-3">Tambah Barang</h5>
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
                                    <input class="form-control" type="text" readonly name="kode_barang" value="<?= $KodeBaru; ?>">
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-md-3">
                                    <label class="col-form-label">Nama Barang</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="nama" class="form-control"></input>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-md-3">
                                    <label class="col-form-label">Jumlah</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="number" min="1" name="stok" class="form-control">
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-md-3">
                                    <label class="col-form-label">Harga</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="harga" class="form-control format-angka">
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-md-3">
                                    <label class="col-form-label"></label>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" name="submit" class="btn btn-dark ">Tambah</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js"></script>
<script>
    $(document).ready(function() {
        // Format mata uang.
        $('.format-angka').mask('0.000.000.000', {
            reverse: true
        });
    })
</script>
<?php
include '../includes/footer.php';
?>