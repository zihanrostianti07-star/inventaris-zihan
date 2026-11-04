<?php 
session_start();

if(!isset($_SESSION['session_login'])){
    header('Location: login.php');
    exit;
}

require 'function.php';

$judul = "Dashboard";
$menu = "dashboard";

$total_barang = count(query_db("SELECT * FROM barang"));
$total_supplier = count(query_db("SELECT * FROM supplier"));
$total_kategori = count(query_db("SELECT * FROM kategori"));
$total_merk = count(query_db("SELECT DISTINCT merk FROM barang"));
$grafik_kategori = query_db("SELECT kategori, COUNT(*) AS jumlah FROM barang GROUP BY kategori");
$grafik_merk = query_db("SELECT merk, COUNT(*) AS jumlah FROM barang GROUP BY merk");
$barang_terbaru = query_db("SELECT * FROM barang ORDER BY id DESC LIMIT 5");
$supplier_terbaru = query_db("SELECT * FROM supplier ORDER BY id DESC LIMIT 5");

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

<!-- Kotak ringkasan -->
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?php echo $total_barang; ?></h3>
                <p>Total Barang</p>
            </div>
            <div class="icon"><i class="fas fa-box"></i></div>
            <a href="index.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?php echo $total_supplier; ?></h3>
                <p>Total Supplier</p>
            </div>
            <div class="icon"><i class="fas fa-truck"></i></div>
            <a href="supplier.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?php echo $total_kategori; ?></h3>
                <p>Kategori Barang</p>
            </div>
            <div class="icon"><i class="fas fa-tags"></i></div>
            <a href="kategori.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3><?php echo $total_merk; ?></h3>
                <p>Merk Barang</p>
            </div>
            <div class="icon"><i class="fas fa-copyright"></i></div>
            <a href="index.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<!-- Grafik -->
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chart-area mr-1"></i> Jumlah Barang per Kategori</h3>
            </div>
            <div class="card-body">
                <div style="position: relative; height: 300px;">
                    <canvas id="grafikKategori"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chart-pie mr-1"></i> Barang per Merk</h3>
            </div>
            <div class="card-body">
                <div style="position: relative; height: 300px;">
                    <canvas id="grafikMerk"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Data terbaru -->
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">5 Barang Terbaru</h3>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                    <tr>
                        <th>Kode</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                    </tr>
                    <?php foreach($barang_terbaru as $data) : ?>
                    <tr>
                        <td><?php echo $data["kode_barang"]; ?></td>
                        <td><?php echo $data["nama_barang"]; ?></td>
                        <td><?php echo $data["kategori"]; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <div class="card-footer text-center">
                <a href="index.php">Lihat semua barang</a>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">5 Supplier Terbaru</h3>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                    <tr>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>No. HP</th>
                    </tr>
                    <?php foreach($supplier_terbaru as $data) : ?>
                    <tr>
                        <td><?php echo $data["kode_supplier"]; ?></td>
                        <td><?php echo $data["nama"]; ?></td>
                        <td><?php echo $data["no_hp"]; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <div class="card-footer text-center">
                <a href="supplier.php">Lihat semua supplier</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
    var labelKategori = [
        <?php foreach($grafik_kategori as $data) : ?>
            "<?php echo $data["kategori"]; ?>",
        <?php endforeach; ?>
    ];
    var jumlahKategori = [
        <?php foreach($grafik_kategori as $data) : ?>
            <?php echo $data["jumlah"]; ?>,
        <?php endforeach; ?>
    ];

    var labelMerk = [
        <?php foreach($grafik_merk as $data) : ?>
            "<?php echo $data["merk"]; ?>",
        <?php endforeach; ?>
    ];
    var jumlahMerk = [
        <?php foreach($grafik_merk as $data) : ?>
            <?php echo $data["jumlah"]; ?>,
        <?php endforeach; ?>
    ];

    new Chart(document.getElementById("grafikKategori"), {
        type: "line",
        data: {
            labels: labelKategori,
            datasets: [{
                label: "Jumlah Barang",
                data: jumlahKategori,
                fill: true,
                tension: 0.4,
                borderColor: "#007bff",
                backgroundColor: "rgba(0, 123, 255, 0.3)"
            }]
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 } }
            }
        }
    });

    new Chart(document.getElementById("grafikMerk"), {
        type: "doughnut",
        data: {
            labels: labelMerk,
            datasets: [{
                data: jumlahMerk,
                backgroundColor: ["#17a2b8", "#28a745", "#ffc107", "#dc3545", "#6f42c1", "#fd7e14", "#20c997", "#6c757d"]
            }]
        },
        options: {
            maintainAspectRatio: false
        }
    });
</script>

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
