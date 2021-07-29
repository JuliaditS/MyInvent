<?php
include '../includes/header.php';
include '../includes/navbar.php';
?>

<div class="container">
    <div class="row mt-5">
        <div class="col-6 col-md-9">
            <div class="tbhdata__search">
                <a href="tambah-barang.php" class="btn btn-dark d-inline">Tambah Barang</a>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <form class="d-flex justify-end">
                <input class="form-control me-2" type="search" placeholder="Masukkan kata kunci..." aria-label="Search">
                <button class="btn btn-dark" type="submit">Search</button>
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
        <tr>
            <td>1</td>
            <td>Pulpen</td>
            <td>1200 Pcs</td>
            <td>12.000</td>
            <td>
                <a href="edit-barang.php" class="btn btn-warning"><i class='bx bx-edit'></i></a>
                <a href="" class="btn btn-danger"><i class='bx bx-trash'></i></a>
            </td>
        </tr>
        <tr>
            <td>2</td>
            <td>Buku tulis</td>
            <td>120 pcs</td>
            <td>12.000</td>
            <td>
                <a href="f235.php" class="btn btn-warning"><i class='bx bx-edit'></i></a>
                <a href="" class="btn btn-danger"><i class='bx bx-trash'></i></a>
            </td>
        </tr>

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