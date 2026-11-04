<?php 
session_start();

if(!isset($_SESSION['session_login'])){
    header('Location: login.php');
    exit;
}

require 'function.php';

$judul = "Daftar Barang Masuk";
$menu = "barang_masuk";

// pagination
$jumlahDataPerHalaman = 5;
$jumlahData = count(query_db("SELECT * FROM barang_masuk"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);

if(isset($_GET["halaman"])){
    $halamanAktif = $_GET["halaman"];
}else{
    $halamanAktif = 1;
}
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

// search
if(isset($_POST["cari"])){
    $keyword = $_POST["keyword"];
    $barang_masuk = cari_barang_masuk($keyword);
    $sedangCari = true;
    $awalData = 0;
}else{
    $keyword = "";
    $barang_masuk = query_db("SELECT barang_masuk.*, barang.nama_barang, supplier.nama AS nama_supplier
                              FROM barang_masuk
                              JOIN barang ON barang_masuk.barang_id = barang.id
                              JOIN supplier ON barang_masuk.supplier_id = supplier.id
                              LIMIT $awalData, $jumlahDataPerHalaman");
    $sedangCari = false;
}

$nomor = $awalData + 1;


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
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <form action="" method="post" class="form-inline">
                    <input type="text" name="keyword" class="form-control mr-2" placeholder="Cari barang masuk..." value="<?php echo $keyword; ?>" autocomplete="off">
                    <button type="submit" name="cari" class="btn btn-primary mr-1">Cari</button>
                    <a href="barang_masuk.php" class="btn btn-secondary">Reset</a>
                </form>
            </div>
            <div class="col-md-6 text-md-right mt-2 mt-md-0">
                <a href="tambah_barang_masuk.php" class="btn btn-success">+ Tambah Data</a>
            </div>
        </div>
    </div>

    <div class="card-body table-responsive p-0">
        <table class="table table-hover table-bordered text-nowrap">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Nama Barang</th>
                    <th>Supplier</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if(count($barang_masuk) == 0) : ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted">Data tidak ditemukan.</td>
                    </tr>
                <?php endif; ?>

                <?php foreach($barang_masuk as $data) : ?>
                <tr>
                    <td><?php echo $nomor; ?></td>
                    <td><?php echo $data["tanggal"]; ?></td>
                    <td><?php echo $data["nama_barang"]; ?></td>
                    <td><?php echo $data["nama_supplier"]; ?></td>
                    <td><?php echo $data["jumlah"]; ?></td>
                    <td><?php echo $data["keterangan"]; ?></td>
                    <td>
                        <a href="edit_barang_masuk.php?id=<?php echo $data["id"]; ?>" class="btn btn-sm btn-primary">Edit</a>
                        <a href="hapus_barang_masuk.php?id=<?php echo $data["id"]; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
                <?php $nomor++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <?php if($sedangCari == false) : ?>
    <div class="card-footer">
        <ul class="pagination justify-content-center mb-0">

            <!-- tombol Prev -->
            <?php if($halamanAktif > 1) : ?>
                <li class="page-item"><a class="page-link" href="?halaman=<?php echo $halamanAktif - 1; ?>">&larr; Prev</a></li>
            <?php else : ?>
                <li class="page-item disabled"><span class="page-link">&larr; Prev</span></li>
            <?php endif; ?>

            <!-- nomor halaman -->
            <?php for($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                <?php if($i == $halamanAktif) : ?>
                    <li class="page-item active"><a class="page-link" href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php else : ?>
                    <li class="page-item"><a class="page-link" href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php endif; ?>
            <?php endfor; ?>

            <!-- tombol Next -->
            <?php if($halamanAktif < $jumlahHalaman) : ?>
                <li class="page-item"><a class="page-link" href="?halaman=<?php echo $halamanAktif + 1; ?>">Next &rarr;</a></li>
            <?php else : ?>
                <li class="page-item disabled"><span class="page-link">Next &rarr;</span></li>
            <?php endif; ?>

        </ul>
    </div>
    <?php endif; ?>
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
