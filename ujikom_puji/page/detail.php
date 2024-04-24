<?php 
error_reporting(E_ERROR | E_PARSE); // Menonaktifkan tampilan warning
$details=mysqli_query($conn, "SELECT * FROM foto INNER JOIN user ON foto.user_id=user.user_id WHERE foto.foto_id='$_GET[id]'");
$data=mysqli_fetch_array($details);
$likes=mysqli_num_rows(mysqli_query($conn, "SELECT * FROM like_foto WHERE foto_id='$_GET[id]'"));
$cek=mysqli_num_rows(mysqli_query($conn, "SELECT * FROM like_foto WHERE foto_id='$_GET[id]' AND user_id='$_SESSION[user_id]'"));
?>
<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="card">
                <!-- Tampilkan foto -->
                <img src="uploads/<?= $data['lokasi_file'] ?>" alt="<?= $data['judul_foto'] ?>" class="object-fit-cover">
                <div class="card-body">
                    <h3 class="card-title mb-0"><?= $data['judul_foto'] ?> <a href="<?php if(isset($_SESSION['user_id'])){echo '?url=like&&id='.$data['foto_id'].'';}else{echo 'login.php';} ?>" class="btn-dark btn btn-sm"><?php if($cek==0){echo 'Like'; }else{echo 'Dislike';} ?> <?= $likes ?></a></h3>
                    <small class="text-muted mb-3">by:<?= $data['username'] ?>, <?= $data['tanggal_unggah'] ?></small>
                    <p><?= $data['deskripsi_foto'] ?></p>
                    <?php 
                        //ambil data komentar
                        $submit=@$_POST['submit'];
                        if ($submit=='Kirim'){
                            $komentar=@$_POST['isi_komentar'];
                            $foto_id=@$_POST['foto_id'];
                            $user_id=@$_SESSION['user_id'];
                            $tanggal=date('Y-m-d');
                            $komen=mysqli_query($conn, "INSERT INTO komentar_foto VALUES('', '$foto_id', '$user_id', '$komentar', '$tanggal')");
                            header("Location: ?url=detail&&id=$foto_id");
                        }

                    ?>
                    <form action="?url=detail" method="post">
                        <div class="form-group d-flex flex-row">
                            <input type="hidden" name="foto_id" value="<?= $data['foto_id'] ?>">
                            <a href="?url=home" class="btn btn-secondary">Kembali</a>
                            <?php if(isset($_SESSION['user_id'])): ?>
                            <input type="text" name="isi_komentar" class="form-control" placeholder="Ketikan komentar...">
                            <input type="submit" value="Kirim" name="submit" class="btn btn-secondary">
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-6">
            <?php
                $komen=mysqli_query($conn, "SELECT * FROM komentar_foto INNER JOIN user ON komentar_foto.user_id=user.user_id INNER JOIN foto ON komentar_foto.foto_id=foto.foto_id WHERE komentar_foto.foto_id='$_GET[id]'");
                foreach($komen as $koment):
            ?>
                <p class="mb-0 fw-bold"><?= $koment['username'] ?></p>
                <p class="mb-1"><?= $koment['isi_komentar'] ?></p>
                <p class="text-muted small mb-0"><?= $koment['tanggal_komentar'] ?></p>
                <hr>
            <?php endforeach; ?>
        </div>
    </div>
</div>
