<?php 
    include '../includes/config.php';

    $kode_barang = $_GET["kode_barang"]; //megambil kode barang
    $hapus = mysqli_query($conn,"DELETE FROM t_barang WHERE kode_barang='$kode_barang'"); //menghapus data di t_user berdasarkan kode barang yang didapat

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