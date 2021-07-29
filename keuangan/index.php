<?php
include '../includes/header.php';
?>
<?php
include 'navbar-keuangan.php';
?>

<div class="container">
    <div class="row mt-3">
        <!-- <div class="col-6 col-md-9">
            <div class="tbhdata__search">
                <a href="tambah-transaksi.php" class="btn btn-dark d-inline">Tambah Transaksi</a>
            </div>
        </div> -->

        <!-- <div class="col-6 col-md-3">
            <form class="d-flex justify-end">
                <input class="form-control me-2" type="search" placeholder="Masukkan kata kunci..." aria-label="Search">
                <button class="btn btn-dark" type="submit">Search</button>
            </form>
        </div> -->
    </div>
</div>


<div class="container mt-3">
    <h5>Keuangan</h5>
    <table class="table table-striped table-hover">
        <tr>
            <th class="col-md-1">No</th>
            <th class="col-md-2">Tanggal</th>
            <th class="col-md-2">Barang masuk</th>
            <th class="col-md-2">Barang keluar</th>
            <th class="col-md-1">Pendapatan</th>
        </tr>
        <tr>
            <td>1</td>
            <td>12/22/2021</td>
            <td>120</td>
            <td>22</td>
            <td>400.000</td>
        </tr>
        <tr>
            <td>2</td>
            <td>12/22/2021</td>
            <td>120</td>
            <td>22</td>
            <td>400.000</td>
        </tr>
    </table>
</div>



<?php
include '../includes/footer.php';
?>