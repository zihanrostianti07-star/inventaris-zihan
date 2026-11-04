CREATE DATABASE IF NOT EXISTS inventaris;
USE inventaris;

CREATE TABLE IF NOT EXISTS user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS kategori (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(50) NOT NULL,
    keterangan VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS barang (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_barang VARCHAR(20) NOT NULL,
    nama_barang VARCHAR(150) NOT NULL,
    merk VARCHAR(100) NOT NULL,
    kategori VARCHAR(50) NOT NULL,
    gambar VARCHAR(255) NOT NULL DEFAULT ''
);

CREATE TABLE IF NOT EXISTS supplier (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_supplier VARCHAR(20) NOT NULL,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    no_hp VARCHAR(50) NOT NULL,
    gambar VARCHAR(255) NOT NULL DEFAULT ''
);

CREATE TABLE IF NOT EXISTS barang_masuk (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tanggal DATE NOT NULL,
    barang_id INT NOT NULL,
    supplier_id INT NOT NULL,
    jumlah INT NOT NULL,
    keterangan VARCHAR(255) NOT NULL DEFAULT ''
);

INSERT INTO kategori (nama_kategori, keterangan) VALUES
('Elektronik', 'Perangkat elektronik dan komputer'),
('Furnitur', 'Meja, kursi, dan perabot kantor'),
('ATK', 'Alat tulis kantor dan perlengkapan habis pakai'),
('Perangkat Jaringan', 'Router, switch, kabel LAN, dan access point'),
('Peralatan Laboratorium', 'Alat praktikum dan perlengkapan laboratorium'),
('Alat Kebersihan', 'Sapu, pel, dan perlengkapan kebersihan'),
('Perlengkapan Elektrikal', 'Stop kontak, lampu, dan kabel listrik');

INSERT INTO barang (kode_barang, nama_barang, merk, kategori, gambar) VALUES
('BR001', 'Laptop', 'Asus', 'Elektronik', 'BR001_Laptop.jpg'),
('BR002', 'Printer', 'Epson', 'Elektronik', ''),
('BR003', 'Proyektor', 'Epson', 'Elektronik', ''),
('BR004', 'Meja Kerja', 'Olympic', 'Furnitur', ''),
('BR005', 'Kursi Kantor', 'Chitose', 'Furnitur', ''),
('BR006', 'Spidol Whiteboard', 'Snowman', 'ATK', ''),
('BR007', 'Kertas A4', 'Sidu', 'ATK', '');

INSERT INTO supplier (kode_supplier, nama, email, no_hp, gambar) VALUES
('SP001', 'PT Sinar Jaya', 'sinarjaya@gmail.com', '081234567801', 'SP001_PT Sinar Jaya.jpg'),
('SP002', 'CV Maju Bersama', 'majubersama@gmail.com', '081234567802', ''),
('SP003', 'Toko Elektronik Purwakarta', 'tokoelektronik@gmail.com', '081234567803', ''),
('SP004', 'UD Berkah Furnitur', 'berkahfurnitur@gmail.com', '081234567804', ''),
('SP005', 'PT Alat Tulis Nusantara', 'atknusantara@gmail.com', '081234567805', ''),
('SP006', 'CV Sumber Rezeki', 'sumberrezeki@gmail.com', '081234567806', '');

INSERT INTO barang_masuk (tanggal, barang_id, supplier_id, jumlah, keterangan) VALUES
('2026-10-05', 1, 3, 5, 'Pengadaan laptop laboratorium'),
('2026-10-08', 2, 3, 2, 'Printer ruang administrasi'),
('2026-10-12', 4, 4, 10, 'Meja kerja ruang kelas'),
('2026-10-15', 5, 4, 20, 'Kursi kantor ruang kelas'),
('2026-10-20', 6, 5, 50, 'Spidol untuk perkuliahan'),
('2026-10-25', 7, 5, 30, 'Kertas A4 kebutuhan administrasi'),
('2026-11-01', 3, 3, 3, 'Proyektor ruang seminar');
