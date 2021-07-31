<?php
include '../includes/header.php';
include '../includes/config.php';
if (!isset($_SESSION["id_user"]))
    header("Location: ../index.php?error=2");

$pesan = "";
if (isset($_POST['submit'])) {
    //getarray
    $kdbrg = $_POST['kode_barang'];
    $jumlah = $_POST['jumlah'];
    $total = $_POST['total'];
    $bayar = $_POST['bayar'];
    $kemb  = $_POST['kembalian'];
    $iduser = $_SESSION['id_user'];
    $date  = date("Y-m-d");
    mysqli_query($conn, "INSERT INTO `t_pembayaran` (`id_pembayaran`, `total_harga`, `uang_pembayaran`, `uang_kembalian`, `tanggal`, `tipe`, `id_user`) VALUES (NULL, '$total', '$bayar', '$kemb', '$date', 'masuk', '$iduser')");



    $no = -1;
    foreach ($kdbrg as $vkdbrg) {
        $no = $no + 1;
        $jumlahs = $jumlah[$no];
        $id_pem = mysqli_num_rows(mysqli_query($conn, "Select * from t_pembayaran"));
        mysqli_query($conn, "INSERT INTO `t_transaksi` (`id_pembayaran`, `kode_barang`, `jumlah`) VALUES ($id_pem, '$vkdbrg', '$jumlahs')");
        mysqli_error($conn);
        $tmpbarang = mysqli_fetch_array(mysqli_query($conn, "select * from t_barang where kode_barang='$vkdbrg'"));
        $tmpstok = $jumlah[$no] + $tmpbarang['stok'];
        mysqli_query($conn, "UPDATE `t_barang` SET `stok` = '$tmpstok' WHERE `t_barang`.`kode_barang` = '$vkdbrg'");
    }
    $pesan = "<div class='alert alert-success' role='alert'>
                          Tambah transaksi barang masuk berhasil!
                        </div>";
    header("Refresh: 2; url=barang-masuk.php");
}


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

<section id="cover">
    <div id="cover-caption">
        <div id="container" class="container mt-3">
            <h5 class="mb-3">Tambah Transaksi Barang Masuk</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="info-form">
                        <form action="" method="POST" class="form-inline justify-content-center">
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-md-3">
                                    <label class="col-form-label">Total Harga</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" id="totalharga" name="total" class="form-control format-angka" readonly=""></input>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-md-3">
                                    <label class="col-form-label">Uang Pembayaran</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" required class="form-control" id="uangbayar" name="bayar" onkeyup="pembayaran(this)">
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-md-3">
                                    <label class="col-form-label">Uang Kembalian</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control format-angka" name="kembalian" id="uangkembali" readonly="">
                                </div>
                            </div>
                            <?= $pesan; ?>

                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-md-3">
                                    <label class="col-form-label"></label>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <table class="table table-striped table-hover table-bordered">
                        <tr>
                            <th class="col-md-2">Nama</th>
                            <th class="col-md-2">Harga</th>
                            <th class="col-md-1">Stok</th>
                            <th class="col-md-2">Jumlah</th>
                        </tr>
                        <?php
                        $db = dbConnect();
                        $sql = "SELECT * FROM t_barang";
                        $res = $db->query($sql);
                        $data = $res->fetch_all(MYSQLI_ASSOC);
                        $res->free();
                        foreach ($data as $barisdata) {
                        ?>
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="<?php echo $barisdata['kode_barang']; ?>" id="<?php echo $barisdata['kode_barang']; ?>" name="kode_barang[]" onclick="myFunction(this)">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            <?php echo $barisdata['nama']; ?>
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <?php echo $barisdata['harga']; ?> <input type="hidden" id="harga<?php echo $barisdata['kode_barang']; ?>" value="<?php echo $barisdata['harga']; ?>">
                                </td>
                                <td>
                                    <?php echo $barisdata['stok']; ?><input type="hidden" id="stok<?php echo $barisdata['kode_barang']; ?>" value="<?php echo $barisdata['stok']; ?>">
                                </td>
                                <td>
                                    <input type="number" min="1" id="jumlah<?php echo $barisdata['kode_barang']; ?>" class="form-control" name="jumlah[]" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onchange="nambahangka(this)" onkeyup="nambahangka(this)" disabled>
                                </td>
                            </tr>

                        <?php
                        }
                        ?>


                    </table>
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-dark " name="submit">Simpan</button>
                </div>
                </form>
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

    function pembayaran(angka) {
        var hilangkantitik = angka.value.replace(".", "");
        var hilangkantitik2 = hilangkantitik.replace(".", "");
        var uangbayar = (hilangkantitik2.replace(".", "") * 1);
        var totalharga = document.getElementById("totalharga").value;
        if (uangbayar < totalharga) {
            document.getElementById("uangkembali").value = "Uang kurang";
        } else {
            document.getElementById("uangkembali").value = uangbayar - totalharga;
        }
    }
    var ha = document.getElementById("totalharga").value;

    function nambahangka(angka) {
        var totalharga = document.getElementById("totalharga").value;
        var kodebarang = angka.id.substring(6);
        var hargabarang = document.getElementById("harga" + kodebarang).value;
        var totalhargasementara = hargabarang * angka.value;
        document.getElementById("totalharga").value = ha + totalhargasementara;
        // var checkbox=document.getElementById(kodebarang);
        // if (checkbox.checked==true) {
        //     document.getElementById("totalharga").value = totalharga + totalhargasementara;
        // } else {

        // }
    }

    function myFunction(test) {
        // Get the checkbox
        var checkBox = test.value;
        var hargabarang = document.getElementById("harga" + test.value).value;
        var totalhargasementara = hargabarang * document.getElementById("jumlah" + test.value).value;
        // Get the output text
        // var text = document.getElementById("jumlah");
        ha = (document.getElementById("totalharga").value * 1);
        // If the checkbox is checked, display the output text
        if (test.checked == true) {
            document.getElementById("jumlah" + test.value).disabled = false;
            document.getElementById("jumlah" + test.value).value = "1";
            totalhargasementara = hargabarang * document.getElementById("jumlah" + test.value).value;
            document.getElementById("totalharga").value = ha + totalhargasementara;
        } else {
            document.getElementById("totalharga").value = ha - totalhargasementara;
            document.getElementById("jumlah" + test.value).value = "";
            document.getElementById("jumlah" + test.value).disabled = true;
        }
    }
</script>
<?php
include '../includes/footer.php';
?>