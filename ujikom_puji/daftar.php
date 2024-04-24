<?php include 'koneksi.php'; ?>
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
                        <h4 class="card-title">Register</h4>
                        <p class="card-title">Daftar Akun</p>
                        <?php
                            //ambil data yang dikirim oleh form
                            $submit=@$_POST['submit'];
                            if($submit=='Daftar'){
                                $username=@$_POST['username'];
                                $password=@$_POST['password'];
                                $email=@$_POST['email'];
                                $nama_lengkap=@$_POST['nama_lengkap'];
                                $alamat=@$_POST['alamat'];
                                //mengecek apakah ada username dan email yang sama
                                //jika ada yang sama maka tidak bisa membuat akun atau gagal mendaftarkan akun
                                $cek=mysqli_num_rows(mysqli_query($conn, "SELECT * FROM user WHERE Username='username' OR Email='email' "));
                                if($cek==0){
                                    mysqli_query($conn, "INSERT INTO user VALUES('','$username','$password','$email','$nama_lengkap','$alamat')");                                echo 'Berhasil mendaftarkan akun, silahkan Login!';
                                    echo '<meta http-equiv="refresh" content="0.8; url=login.php">';
                                }else{
                                    echo 'Akun atau username sudah terpakai harap gunakan yang lain!';
                                    echo '<meta http-equiv="refresh" content="0.8; url=daftar.php">';
                                }
                            }
                        ?>
                        <form action="daftar.php" method="post">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" name="username" require>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" require>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" require>
                            </div>
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama_lengkap" require>
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text" class="form-control" name="alamat" require>
                            </div>
                            <input type="submit" value="Daftar" class="btn btn-success my-3" name="submit">
                            <p>Sudah punya akun? <a href="login.php">Login</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>