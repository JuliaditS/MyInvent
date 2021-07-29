<?php
include 'includes/header.php';
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <div class="login-form mt-4 p-4">
                <form action="" method="" class="row g-3">
                    <h5 class="title text-center header__login">Log in</h5>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Username" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password" />
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