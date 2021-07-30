<?php
include '../includes/header.php';
include '../includes/config.php';
if (!isset($_SESSION["id_user"]))
    header("Location: ../index.php?error=2");
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

<section id="cover">
    <div id="cover-caption">
        <div id="container" class="container mt-3">
            <h5 class="mb-3">Tambah Transaksi Barang Keluar</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="info-form">
                        <form action="" class="form-inline justify-content-center">
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-md-3">
                                    <label class="col-form-label">Total Harga</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control format-angka" readonly=""></input>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-md-3">
                                    <label class="col-form-label">Uang Pembayaran</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control format-angka">
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-md-3">
                                    <label class="col-form-label">Uang Kembalian</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control format-angka" readonly="">
                                </div>
                            </div>
                            
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
                            $sql="SELECT * FROM t_barang WHERE Stok != 0";
                            $res=$db->query($sql);
                            $data = $res->fetch_all(MYSQLI_ASSOC);
                            $res->free();
                            foreach ($data as $barisdata) {
                                ?>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="<?php echo $barisdata['kode_barang']; ?>" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                <?php echo $barisdata['nama']; ?>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <?php echo $barisdata['harga']; ?>
                                    </td>
                                    <td>
                                        <?php echo $barisdata['stok']; ?>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="jumlah">
                                    </td>
                                </tr>

                                <?php
                            }
                         ?>
                        
                        
                    </table>
                </div>
                </form>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-dark ">Simpan</button>
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