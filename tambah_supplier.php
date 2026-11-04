<?php 
session_start();

if(!isset($_SESSION['session_login'])){
    header('Location: login.php');
    exit;
}

require 'function.php';

$judul = "Tambah Data Supplier";
$menu = "supplier";

if(isset($_POST["tambah"])){
    if(tambah_supplier($_POST) > 0){
        echo "<script>
                alert('Data supplier berhasil ditambahkan!');
                document.location.href = 'supplier.php';
              </script>
        ";
    }else{
        echo "<script>
                alert('Data supplier gagal ditambahkan!');
              </script>
        ";
        echo mysqli_error($conn);
    }
}

$aktifDashboard = "";
$aktifBarang = "";
$aktifKategori = "";
$aktifSupplier = "";
$aktifMasuk = "";

if($menu == "dashboard"){
    $aktifDashboard = "active";
}
if($menu == "barang"){
    $aktifBarang = "active";
}
if($menu == "kategori"){
    $aktifKategori = "active";
}
if($menu == "supplier"){
    $aktifSupplier = "active";
}
if($menu == "barang_masuk"){
    $aktifMasuk = "active";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $judul; ?> | Inventaris Barang</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <span class="nav-link">Halo, <b><?php echo $_SESSION['username']; ?></b></span>
            </li>
            <li class="nav-item">
                <a class="nav-link text-danger" href="logout.php" onclick="return confirm('Yakin ingin logout?')">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </li>
        </ul>
    </nav>

    <!-- Sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="dashboard.php" class="brand-link">
            <i class="fas fa-boxes brand-image" style="margin-left:18px; font-size:1.6rem;"></i>
            <span class="brand-text font-weight-light">Inventaris</span>
        </a>

        <div class="sidebar">
            <nav class="mt-3">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                    <li class="nav-item">
                        <a href="dashboard.php" class="nav-link <?php echo $aktifDashboard; ?>">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php" class="nav-link <?php echo $aktifBarang; ?>">
                            <i class="nav-icon fas fa-box"></i>
                            <p>Manajemen Barang</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="kategori.php" class="nav-link <?php echo $aktifKategori; ?>">
                            <i class="nav-icon fas fa-tags"></i>
                            <p>Manajemen Kategori</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="supplier.php" class="nav-link <?php echo $aktifSupplier; ?>">
                            <i class="nav-icon fas fa-truck"></i>
                            <p>Manajemen Supplier</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="barang_masuk.php" class="nav-link <?php echo $aktifMasuk; ?>">
                            <i class="nav-icon fas fa-dolly"></i>
                            <p>Barang Masuk</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <!-- Content -->
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <h1><?php echo $judul; ?></h1>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">

<div class="card">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group">
                <label for="kode_supplier">Kode Supplier</label>
                <input type="text" name="kode_supplier" id="kode_supplier" class="form-control" placeholder="Contoh: SP007" required>
            </div>

            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama supplier" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan email" required>
            </div>

            <div class="form-group">
                <label for="no_hp">No. HP</label>
                <input type="text" name="no_hp" id="no_hp" class="form-control" placeholder="Contoh: 081234567890" required>
            </div>

            <div class="form-group">
                <label for="gambar">Gambar</label>
                <input type="file" name="gambar" id="gambar" class="form-control-file">
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" name="tambah" class="btn btn-success"> Tambah Data </button>
            <a href="supplier.php" class="btn btn-secondary"> Kembali </a>
        </div>
    </form>
</div>

            </div>
        </section>
    </div>

    <footer class="main-footer">
        <strong>Sistem Informasi Inventaris Barang</strong> - UTS Pemrograman Internet
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/js/adminlte.min.js"></script>
</body>
</html>
