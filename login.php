<?php
include 'includes/config.php';
include 'includes/header-login.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($conn === false) {
        header("Location: ?page=&&error=1");
    } else {
        $username = $_POST["username"];
        $sql = mysqli_query($conn, "SELECT * FROM t_user WHERE username='$username'");
        if (mysqli_num_rows($sql) == 0) {
            header("Location: ?page=&&error=3");
        } else {
            $password = $_POST["password"];
            $sql1 = mysqli_query($conn, "SELECT * FROM t_user WHERE username='$username' and password=md5('$password')");
            if (mysqli_num_rows($sql1) == 0) {
                header("Location: ?page=&&error=4");
            } else {
                $data = mysqli_fetch_array($sql1);
                session_start();
                $_SESSION["id_user"] = $data["id_user"];
                $_SESSION["username"] = $data["username"];
                $_SESSION["nama"] = $data["nama"];
                $_SESSION["cypherMethod"] = 'AES-256-CBC';
                $_SESSION["key"] = random_bytes(32);
                $_SESSION["iv"] = openssl_random_pseudo_bytes(openssl_cipher_iv_length($_SESSION["cypherMethod"]));
                header("location: dashboard.php");
            }
        }
    }
}
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <div class="login-form mt-4 p-4">
                <!-- alert gagal login -->
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Username atau password salah
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <form action="login.php" method="POST" class="row g-3">
                    <h5 class="title text-center header__login">Log in</h5>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="username" placeholder="Username" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" />
                    </div>
                    <input type="submit" value="Log in" class="btn btn-dark btn__login solid rounded mt-4 py-3" />
                    <div class="col-12">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<?php
include 'includes/footer.php'
?>