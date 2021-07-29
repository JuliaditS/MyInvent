<?php
include '../includes/header.php';
?>
<?php
include '../includes/navbar.php';
?>

<div class="container">
    <div class="row mt-3">
        <div class="col-6 col-md-9">
            <div class="tbhdata__search">
                <a href="tambah-transaksi.php" class="btn btn-dark d-inline">Tambah Transaksi</a>
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
        <div class="col-md-6">
            <h5>Barang Masuk</h5>
            <table class="table table-striped table-hover">
                <tr>
                    <th class="col-md-1">No</th>
                    <th class="col-md-2">Nama Barang</th>
                    <th class="col-md-2">Jumlah</th>
                    <th class="col-md-2">Total Harga</th>
                    <th class="col-md-1">Tanggal</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Buku Tulis</td>
                    <td>120</td>
                    <td>Rp. 120.000</td>
                    <td>21/02/2021</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>pensil</td>
                    <td>50</td>
                    <td>Rp. 120.000</td>
                    <td>21/02/2021</td>
                </tr>

            </table>

        </div>
        <div class="col-md-6">
            <h5>Barang Keluar</h5>
            <table class="table table-striped table-hover">
                <tr>
                    <th class="col-md-1">No</th>
                    <th class="col-md-2">Nama Barang</th>
                    <th class="col-md-2">Jumlah</th>
                    <th class="col-md-2">Total Harga</th>
                    <th class="col-md-1">Tanggal</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Penggaris</td>
                    <td>500</td>
                    <td>Rp. 120.000</td>
                    <td>21/02/2021</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Penghapus</td>
                    <td>200</td>
                    <td>Rp. 120.000</td>
                    <td>21/02/2021</td>
                </tr>
            </table>
        </div>
    </div>
</div>
</div>
</div>



<?php
include '../includes/footer.php';
?>