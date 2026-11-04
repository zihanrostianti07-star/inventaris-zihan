<?php 
session_start();

if(!isset($_SESSION['session_login'])){
    header('Location: login.php');
    exit;
}

require 'function.php';

$id = $_GET["id"];

if(hapus_barang_masuk($id) > 0){
    echo "<script>
            alert('Data barang masuk berhasil dihapus!');
            document.location.href = 'barang_masuk.php';
          </script>
    ";
}else{
    echo "<script>
            alert('Data barang masuk gagal dihapus!');
            document.location.href = 'barang_masuk.php';
          </script>
    ";
}
?>
