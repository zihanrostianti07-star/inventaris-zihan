<?php 
session_start();

    require 'function.php';

    if(isset($_POST['login'])){

        // var_dump($_POST);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = $_POST['password'];

        $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username' ");

        // cek username
        if(mysqli_num_rows($result) === 1){

            // cek password
            $row = mysqli_fetch_assoc($result);
            if(password_verify($password, $row['password'])){
                // set session
                $_SESSION['session_login'] = true;
                $_SESSION['username'] = $username;

                header('Location: dashboard.php');
                exit;
            }else{
                echo "<script>
                    alert('Password yang kamu masukkan salah!');
                    </script>
                ";  
            }
        }else{
            echo "<script>
                alert('Username yang kamu masukkan salah atau tidak ditemukan!');
                </script>
            ";
        }

    }

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Inventaris Barang</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body class="page-register">

    <div class="container">
        <div class="form-card">

            <div class="brand">
                <div class="brand-icon"><i class="fas fa-boxes"></i></div>
                <h3>Selamat Datang</h3>
                <p>Silakan login untuk masuk ke sistem inventaris</p>
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

                <!-- Button -->
                <div class="button-group">
                    <button type="submit" name="login" class="btn btn-edit"> Login </button>
                    <p class="pindah">Belum punya akun? <a href="registrasi.php">Registrasi di sini</a></p>
                </div>
            </form>
        </div>
    </div>

</body>

</html>