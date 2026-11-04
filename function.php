<?php 
$conn = mysqli_connect("localhost", "root", "", "inventaris_zihan");

function query_db($query) {
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}
	return $rows;
}

/* ==================== BARANG ==================== */

function tambah_barang($data){
	global $conn;

	$kode_barang = $data['kode_barang'];
	$nama_barang = $data['nama_barang'];
	$merk = $data['merk'];
	$kategori = $data['kategori'];

	// upload gambar
	$gambar = upload_gambar($kode_barang, $nama_barang);
	if( !$gambar ){
		return false;
	}

	$query = "INSERT INTO barang(kode_barang, nama_barang, merk, kategori, gambar)
              VALUES ('$kode_barang', '$nama_barang', '$merk', '$kategori', '$gambar')
        	 ";

	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

function hapus_barang($id){
	global $conn;

	$query = "DELETE FROM barang WHERE id = $id";

	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

function edit_barang($data){
	global $conn;

	$id = $data["id"];
	$kode_barang = $data['kode_barang'];
	$nama_barang = $data['nama_barang'];
	$merk = $data['merk'];
	$kategori = $data['kategori'];
	$gambar_lama = $data['gambar_lama'];

	if( $_FILES['gambar']['error'] === 4 ){
		$gambar = $gambar_lama;
	}else{
		$gambar = upload_gambar($kode_barang, $nama_barang);
		if( !$gambar ){
			return false;
		}
	}

	$query = "UPDATE barang SET
			 kode_barang = '$kode_barang',
			 nama_barang = '$nama_barang',
			 merk = '$merk',
			 kategori = '$kategori',
			 gambar = '$gambar'
			 WHERE id = $id
	";

	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

// SEARCH BARANG
function cari_barang($keyword) {
	global $conn;

	$keyword = mysqli_real_escape_string($conn, $keyword);

	$query = "SELECT * FROM barang
			  WHERE
			  kode_barang LIKE '%$keyword%' OR
			  nama_barang LIKE '%$keyword%' OR
			  merk LIKE '%$keyword%' OR
			  kategori LIKE '%$keyword%'";

	return query_db($query);
}

/* ==================== SUPPLIER ==================== */

function tambah_supplier($data){
	global $conn;

	$kode_supplier = $data['kode_supplier'];
	$nama = $data['nama'];
	$email = $data['email'];
	$no_hp = $data['no_hp'];

	// upload gambar
	$gambar = upload_gambar($kode_supplier, $nama);
	if( !$gambar ){
		return false;
	}

	$query = "INSERT INTO supplier(kode_supplier, nama, email, no_hp, gambar)
              VALUES ('$kode_supplier', '$nama', '$email', '$no_hp', '$gambar')
        	 ";

	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

function hapus_supplier($id){
	global $conn;

	$query = "DELETE FROM supplier WHERE id = $id";

	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

function edit_supplier($data){
	global $conn;

	$id = $data["id"];
	$kode_supplier = $data['kode_supplier'];
	$nama = $data['nama'];
	$email = $data['email'];
	$no_hp = $data['no_hp'];
	$gambar_lama = $data['gambar_lama'];

	if( $_FILES['gambar']['error'] === 4 ){
		$gambar = $gambar_lama;
	}else{
		$gambar = upload_gambar($kode_supplier, $nama);
		if( !$gambar ){
			return false;
		}
	}

	$query = "UPDATE supplier SET
			 kode_supplier = '$kode_supplier',
			 nama = '$nama',
			 email = '$email',
			 no_hp = '$no_hp',
			 gambar = '$gambar'
			 WHERE id = $id
	";

	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

// SEARCH SUPPLIER
function cari_supplier($keyword) {
	global $conn;

	$keyword = mysqli_real_escape_string($conn, $keyword);

	$query = "SELECT * FROM supplier
			  WHERE
			  kode_supplier LIKE '%$keyword%' OR
			  nama LIKE '%$keyword%' OR
			  email LIKE '%$keyword%' OR
			  no_hp LIKE '%$keyword%'";

	return query_db($query);
}

/* ==================== KATEGORI ==================== */

function tambah_kategori($data){
	global $conn;

	$nama_kategori = $data['nama_kategori'];
	$keterangan = $data['keterangan'];

	$query = "INSERT INTO kategori(nama_kategori, keterangan)
              VALUES ('$nama_kategori', '$keterangan')
        	 ";

	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

function hapus_kategori($id){
	global $conn;

	$query = "DELETE FROM kategori WHERE id = $id";

	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

function edit_kategori($data){
	global $conn;

	$id = $data["id"];
	$nama_kategori = $data['nama_kategori'];
	$keterangan = $data['keterangan'];
	$nama_lama = $data['nama_lama'];

	$query = "UPDATE kategori SET
			 nama_kategori = '$nama_kategori',
			 keterangan = '$keterangan'
			 WHERE id = $id
	";

	mysqli_query($conn, $query);
	$hasil = mysqli_affected_rows($conn);
	mysqli_query($conn, "UPDATE barang SET kategori = '$nama_kategori' WHERE kategori = '$nama_lama'");

	return $hasil;
}

// SEARCH KATEGORI
function cari_kategori($keyword) {
	global $conn;

	$keyword = mysqli_real_escape_string($conn, $keyword);

	$query = "SELECT * FROM kategori
			  WHERE
			  nama_kategori LIKE '%$keyword%' OR
			  keterangan LIKE '%$keyword%'";

	return query_db($query);
}

/* ==================== BARANG MASUK ==================== */

function tambah_barang_masuk($data){
	global $conn;

	$tanggal = $data['tanggal'];
	$barang_id = $data['barang_id'];
	$supplier_id = $data['supplier_id'];
	$jumlah = $data['jumlah'];
	$keterangan = $data['keterangan'];

	$query = "INSERT INTO barang_masuk(tanggal, barang_id, supplier_id, jumlah, keterangan)
              VALUES ('$tanggal', '$barang_id', '$supplier_id', '$jumlah', '$keterangan')
        	 ";

	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

function hapus_barang_masuk($id){
	global $conn;

	$query = "DELETE FROM barang_masuk WHERE id = $id";

	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

function edit_barang_masuk($data){
	global $conn;

	$id = $data["id"];
	$tanggal = $data['tanggal'];
	$barang_id = $data['barang_id'];
	$supplier_id = $data['supplier_id'];
	$jumlah = $data['jumlah'];
	$keterangan = $data['keterangan'];

	$query = "UPDATE barang_masuk SET
			 tanggal = '$tanggal',
			 barang_id = '$barang_id',
			 supplier_id = '$supplier_id',
			 jumlah = '$jumlah',
			 keterangan = '$keterangan'
			 WHERE id = $id
	";

	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

// SEARCH BARANG MASUK
function cari_barang_masuk($keyword) {
	global $conn;

	$keyword = mysqli_real_escape_string($conn, $keyword);

	$query = "SELECT barang_masuk.*, barang.nama_barang, supplier.nama AS nama_supplier
			  FROM barang_masuk
			  JOIN barang ON barang_masuk.barang_id = barang.id
			  JOIN supplier ON barang_masuk.supplier_id = supplier.id
			  WHERE
			  barang_masuk.tanggal LIKE '%$keyword%' OR
			  barang.nama_barang LIKE '%$keyword%' OR
			  supplier.nama LIKE '%$keyword%' OR
			  barang_masuk.keterangan LIKE '%$keyword%'";

	return query_db($query);
}

// fungsi untuk upload gambar
function upload_gambar($kode, $nama){

	$namaFile = $_FILES['gambar']['name'];
	$ukuranFile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];
	if( $error === 4 ){
		echo "<script>
			alert('Kamu belum upload file, silakan upload file terlebih dahulu!');
			</script>
		";
		return false;
	}

	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if( !in_array($ekstensiGambar, $ekstensiGambarValid) ){
		echo "<script>
			alert('File yang kamu upload itu bukan jpg/jpeg/png!');
			</script>
		";
		return false;
	}

	if( $ukuranFile > 5000000 ){
		echo "<script>
			alert('File yang kamu upload terlalu besar ukurannya!');
			</script>
		";
		return false;
	}

	$namaFileBaru = $kode . "_" . $nama;
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;

	move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

	return $namaFileBaru;
}

// fungsi untuk registrasi
function registrasi($data){
	global $conn;

	$username = strtolower(stripslashes($data["username"]));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$konfirmasi_password = mysqli_real_escape_string($conn, $data["konfirmasi_password"]);
	$result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

	if(mysqli_fetch_assoc($result)){
		echo "<script>
				alert('Username sudah terdaftar! Gunakan username lainnya!');
			 </script>
		";
		return false;
	}

	// cek konfirmasi password
	if($password !== $konfirmasi_password ){
		echo "<script>
				alert('Konfirmasi password tidak sesuai!');
			 </script>
		";
		return false;
	}

	// enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);

	mysqli_query($conn, "INSERT INTO user(username, password) VALUES('$username', '$password')");
	return mysqli_affected_rows($conn);

}

?>
