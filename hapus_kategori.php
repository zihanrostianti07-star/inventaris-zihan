<?php 
session_start();

if(!isset($_SESSION['session_login'])){
    header('Location: login.php');
    exit;
}

require 'function.php';

$id = $_GET["id"];

if(hapus_kategori($id) > 0){
    echo "<script>
            alert('Data kategori berhasil dihapus!');
            document.location.href = 'kategori.php';
          </script>
    ";
}else{
    echo "<script>
            alert('Data kategori gagal dihapus!');
            document.location.href = 'kategori.php';
          </script>
    ";
}
?>
