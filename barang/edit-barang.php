<?php
include '../includes/header.php';
include '../includes/navbar.php';
?>
<section id="cover">
    <div id="cover-caption">
        <div id="container" class="container mt-3">
            <h5 class="mb-3">Edit Barang</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="info-form">
                        <form action="" class="form-inline justify-content-center">
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-md-3">
                                    <label class="col-form-label">Nama Barang</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" value="2" class="form-control"></input>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-md-3">
                                    <label class="col-form-label">Jumlah</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" value="15" class="form-control">
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-md-3">
                                    <label class="col-form-label">Harga</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" value="12000" class="form-control">
                                </div>
                            </div>


                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-md-3">
                                    <label class="col-form-label"></label>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-dark ">Simpan</button>
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