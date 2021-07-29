<?php  
    include '../includes/header.php';
    include '../includes/navbar.php';
    include '../includes/config.php';

    $pesan = ""; //diguanakan sebagai pesan eror validasi 
    if(isset($_POST['submit'])){
        $nama = htmlspecialchars($_POST['nama']);
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        $cekUser = mysqli_query($conn, "SELECT username FROM t_user WHERE username = '$username'");

        //validasi jika nama kosong
        if(empty($nama)){
            $pesan = "<div class='alert alert-danger' role='alert'>
                          Nama wajib diisi!
                        </div>";
        }

        elseif(!preg_match("/^[a-zA-Z ]*$/",$nama)){
            $pesan = "<div class='alert alert-danger' role='alert'>
                          Nama hanya boleh berupa huruf!
                        </div>";
        }

        //validasi jika username kosong
        elseif(empty($username)){
            $pesan = "<div class='alert alert-danger' role='alert'>
                          Username wajib diisi!
                        </div>";
        }

        //validasi jika password kosong
        elseif(empty($password)){
            $pesan = "<div class='alert alert-danger' role='alert'>
                          Password wajib diisi
                        </div>";
            
        }

        //validasi jika password kurang dari 8 karakter
        elseif(strlen($password) < 8) {
            $pesan = "<div class='alert alert-danger' role='alert'>
                      Password harus 8 karakter
                    </div>";
            
        }

        //mengecek apakah username yang dimasukan sudah ada atau belum
        elseif(mysqli_fetch_assoc($cekUser)){
            $pesan = "<div class='alert alert-danger' role='alert'>
                      Username sudah ada, silahkan gunakan username lain!
                    </div>";         
        }else{
            $md5 = md5($password);

            //memasukan data ke tabel t_user
            $masuk = mysqli_query($conn,"INSERT INTO t_user VALUES(null,'$username','$md5','$nama')");
            if($masuk){
                $pesan = "<div class='alert alert-success' role='alert'>
                          Tambah data pegawai berhasil
                        </div>";
                header("Refresh: 2, url=index.php");
            }else{
                $pesan = "<div class='alert alert-danger' role='alert'>
                          Tambah data pegawai gagal
                        </div>";
            }
        }
    }
?>
<section id="cover">
    <div id="cover-caption">
        <div id="container" class="container mt-3">
            <h5 class="mb-3">Tambah User</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="info-form">
                        <form action="" method="POST" class="form-inline justify-content-center">
                            <?php echo $pesan; ?>
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-md-3">
                                    <label class="col-form-label">Nama User</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="nama" class="form-control"></input>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-md-3">
                                    <label class="col-form-label">Username</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="username" class="form-control">
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-md-3">
                                    <label class="col-form-label">Password</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="password" name="password" class="form-control">
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