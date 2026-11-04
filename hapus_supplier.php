<?php 
session_start();

if(!isset($_SESSION['session_login'])){
    header('Location: login.php');
    exit;
}

require 'function.php';

$id = $_GET["id"];

if(hapus_supplier($id) > 0){
    echo "<script>
            alert('Data supplier berhasil dihapus!');
            document.location.href = 'supplier.php';
          </script>
    ";
}else{
    echo "<script>
            alert('Data supplier gagal dihapus!');
            document.location.href = 'supplier.php';
          </script>
    ";
}
?>
