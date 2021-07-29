<?php
    include '../includes/header.php';
    include '../includes/navbar.php';
    include '../includes/config.php';

    $pesan = "";
    $id_user = $_GET["id_user"];
    $ambil = mysqli_query($conn,"SELECT * FROM t_user WHERE id_user = $id_user");
    $data = mysqli_fetch_array($ambil);

    
    if(isset($_POST['submit'])){
        $id_user = htmlspecialchars($_POST['id_user']);
        $nama = htmlspecialchars($_POST['nama']);
        $username = htmlspecialchars($_POST['username']);

        if(empty($nama)){
            $pesan = "<div class='alert alert-danger' role='alert'>
                          Nama tidak boleh kosong!
                        </div>";
        }
        elseif(empty($username)){
            $pesan = "<div class='alert alert-danger' role='alert'>
                          Username tidak boleh kosong!
                        </div>";
        }else {
            $query = "UPDATE t_user SET 
                    nama = '$nama',
                    username = '$username'
                    WHERE id_user = $id_user ";
            $update = mysqli_query($conn, $query);
            if($update){
                
                $pesan = "<div class='alert alert-success' role='alert'>
                              Ubah data user berhasil
                            </div>";
                header("Refresh: 2; url=index.php");

            }else{
                $pesan = "<div class='alert alert-success' role='alert'>
                              Ubah data user gagal
                            </div>";
            }
            
        }
    
    }
      
?>
<section id="cover">
    <div id="cover-caption">
        <div id="container" class="container mt-3">
            <h5 class="mb-3">Edit User</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="info-form">
                        <form action="" method="POST" class="form-inline justify-content-center">
                            <?= $pesan; ?>
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-md-3">
                                    <label class="col-form-label">Nama User</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="hidden" name="id_user" value="<?= $data['id_user'] ?>">
                                    <input type="text" name="nama" value="<?= $data['nama'] ?>" class="form-control"></input>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-md-3">
                                    <label class="col-form-label">Username</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="username" value="<?= $data['username'] ?>" class="form-control">
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-md-3">
                                    <label class="col-form-label">Password</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" readonly value="<?= $data['password'] ?>" class="form-control">
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