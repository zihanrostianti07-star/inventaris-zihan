<?php 
    require 'function.php';

    if(isset($_POST["register"])){
        
        if(registrasi($_POST) > 0){
            echo "<script>
                    alert('User baru berhasil ditambahkan!');
                 </script>
            ";
        }else{
            echo mysqli_error($conn);
        }
        
    }

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi | Inventaris Barang</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body class="page-register">

    <div class="container">
        <div class="form-card">

            <div class="brand">
                <div class="brand-icon"><i class="fas fa-boxes"></i></div>
                <h3>Buat Akun Baru</h3>
                <p>Daftar untuk mengelola data inventaris barang</p>
            </div>

            <form action="" method="post">
                <!-- Username -->
                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="input-icon">
                        <i class="fas fa-user"></i>
                        <input type="text" name="username" id="username" placeholder="Masukkan username" required>
                    </div>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" id="password" placeholder="Masukkan password" required>
                    </div>
                </div>

                <!-- Konfirmasi Password -->
                <div class="form-group">
                    <label for="password2">Konfirmasi Password</label>
                    <div class="input-icon">
                        <i class="fas fa-check-circle"></i>
                        <input type="password" name="konfirmasi_password" id="password2" placeholder="Masukkan kembali password" required>
                    </div>
                </div>

                <!-- Button -->
                <div class="button-group">
                    <button type="submit" name="register" class="btn btn-edit"> Registrasi </button>
                    <p class="pindah">Sudah punya akun? <a href="login.php">Login di sini</a></p>
                </div>
            </form>
        </div>
    </div>

</body>

</html>