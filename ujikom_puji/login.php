<?php 
include 'koneksi.php'; 
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Galeri | Puji Indah Pratiwi 12 RPL 2</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Login</h4>
                        <p class="card-title">Login Akun</p>
                        <?php
                        // Ambil data yang dikirim oleh form
                        $submit = @$_POST['submit'];
                        if($submit == 'Login') {
                            $username = $_POST['username'];
                            $password = $_POST['password'];
                            // Prepared statement untuk mencegah SQL Injection
                            $query = "SELECT user_id, Username, Password, Email, Nama_Lengkap FROM user WHERE Username=? AND Password=?";
                            $stmt = mysqli_prepare($conn, $query);
                            mysqli_stmt_bind_param($stmt, "ss", $username, $password);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_store_result($stmt);
                            $cek = mysqli_stmt_num_rows($stmt);
                            if($cek != 0) {
                                // Ambil data dari database untuk membuat session
                                mysqli_stmt_bind_result($stmt, $user_id, $db_username, $db_password, $email, $nama_lengkap);
                                mysqli_stmt_fetch($stmt);
                                echo 'Login berhasil!';
                                $_SESSION['username'] = $db_username;
                                $_SESSION['user_id'] = $user_id;
                                $_SESSION['email'] = $email;
                                $_SESSION['nama_lengkap'] = $nama_lengkap;
                                echo '<meta http-equiv="refresh" content="0.8; url=./">';
                            } else {
                                echo 'Login gagal!';
                                echo '<meta http-equiv="refresh" content="0.8; url=login.php">';
                            }
                            mysqli_stmt_close($stmt);
                        }
                        ?>
                        <form action="login.php" method="post">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" name="username" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                            <input type="submit" value="Login" class="btn btn-success my-3" name="submit">
                            <p>Belum punya akun? <a href="daftar.php">Register</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
