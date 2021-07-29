<?php 
    include '../includes/config.php';

    $id_user = $_GET["id_user"]; //megambil id_user
    $hapus = mysqli_query($conn,"DELETE FROM t_user WHERE id_user=$id_user"); //menghapus data di t_user berdasarkan id_user yang didapat

    if($hapus){
        echo "
        <script>
            alert('Data berhasil di hapus');
            document.location.href = 'index.php';
        </script>";
        
    } else {
       echo "
        <script>
            alert('Data gagal di hapus');
            document.location.href = 'index.php';
        </script>";
       
    }
 ?>