<div class="container">
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-5">
            <h4>Upload</h4>
            <?php 
                $submit = @$_POST['submit'];
                $fotoid = @$_GET['fotoid'];
                if($submit == 'Upload'){
                    $judul_foto = @$_POST['judul_foto'];
                    $deskripsi_foto = @$_POST['deskripsi_foto'];
                    $lokasi_file = @$_FILES['lokasi_file']['name'];
                    $tmp_foto = @$_FILES['lokasi_file']['tmp_name'];
                    $tanggal = date('Y-m-d');
                    $user_id = @$_SESSION['user_id'];
                    // Periksa apakah file yang diunggah adalah gambar dengan ekstensi yang diizinkan
                    $allowed_extensions = array('jpg', 'png', 'gif');
                    $file_extension = strtolower(pathinfo($lokasi_file, PATHINFO_EXTENSION));
                    if(in_array($file_extension, $allowed_extensions)){
                        if(move_uploaded_file($tmp_foto, 'uploads/'.$lokasi_file)) {
                            $conn = mysqli_query($conn, "INSERT INTO foto (judul_foto, deskripsi_foto, tanggal_unggah, lokasi_file, user_id) VALUES ('$judul_foto', '$deskripsi_foto', '$tanggal', '$lokasi_file', '$user_id')");
                            echo 'Gambar berhasil di upload!';
                            echo '<meta http-equiv="refresh" content="0.8; url=?url=upload">';
                        }else{
                            echo 'Terjadi kesalahan saat mengupload gambar!';
                            echo '<meta http-equiv="refresh" content="0.8; url=?url=upload">';
                        }
                    } else {
                        echo 'File harus berupa *.jpg *.png *.gif!';
                    }
                } elseif(isset($_GET['edit'])) {
                    if($submit == "Edit"){
                        $judul_foto = @$_POST['judul_foto'];
                        $deskripsi_foto = @$_POST['deskripsi_foto'];
                        $lokasi_file = @$_FILES['lokasi_file']['name'];
                        $tmp_foto = @$_FILES['lokasi_file']['tmp_name'];
                        $tanggal = date('Y-m-d');
                        $user_id = @$_SESSION['user_id'];
                        if(strlen($lokasi_file) == 0){
                            $update = mysqli_query($conn, "UPDATE foto SET judul_foto='$judul_foto', deskripsi_foto='$deskripsi_foto', tanggal_unggah='$tanggal' WHERE foto_id='$fotoid'");
                            if($update){
                                echo 'Gambar berhasil di edit!';
                                echo '<meta http-equiv="refresh" content="0.8; url=?url=upload">';
                            }else{
                                echo 'Gambar gagal di edit!';
                                echo '<meta http-equiv="refresh" content="0.8; url=?url=upload">';
                            }
                        } else {
                            // Pastikan file yang diunggah adalah gambar dengan ekstensi yang diizinkan
                            $allowed_extensions = array('jpg', 'png', 'gif');
                            $file_extension = strtolower(pathinfo($lokasi_file, PATHINFO_EXTENSION));
                            if(in_array($file_extension, $allowed_extensions)){
                                if(move_uploaded_file($tmp_foto, "uploads/".$lokasi_file)){
                                    $update = mysqli_query($conn, "UPDATE foto SET judul_foto='$judul_foto', deskripsi_foto='$deskripsi_foto', lokasi_file='$lokasi_file', tanggal_unggah='$tanggal' WHERE foto_id='$fotoid'");
                                    if($update){
                                        echo 'Gambar berhasil di edit!';
                                        echo '<meta http-equiv="refresh" content="0.8; url=?url=upload">';
                                    }else{
                                        echo 'Gambar gagal di edit!';
                                        echo '<meta http-equiv="refresh" content="0.8; url=?url=upload">';
                                    }
                                } else {
                                    echo 'Terjadi kesalahan saat mengupload gambar!';
                                    echo '<meta http-equiv="refresh" content="0.8; url=?url=upload">';
                                }
                            } else {
                                echo 'File harus berupa *.jpg *.png *.gif!';
                            }
                        }
                    }
                } elseif(isset($_GET['hapus'])) {
                    $delete = mysqli_query($conn, "DELETE FROM foto WHERE foto_id='$fotoid'");
                    if($delete){
                        echo 'Gambar berhasil di hapus!';
                        echo '<meta http-equiv="refresh" content="0.8; url=?url=upload">';
                    }else{
                        echo 'Gambar gagal di hapus!';
                        echo '<meta http-equiv="refresh" content="0.8; url=?url=upload">';
                    }
                }
                $statement = mysqli_prepare($conn, "SELECT * FROM foto WHERE foto_id=?");
                mysqli_stmt_bind_param($statement, "i", $fotoid);
                mysqli_stmt_execute($statement);
                $result = mysqli_stmt_get_result($statement);
                $val = mysqli_fetch_array($result);
                            ?> 
            <?php if(!isset($_GET['edit']) && !isset($_GET['hapus'])): ?>
            <form action="?url=upload" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Judul Foto</label>
                    <input type="text" class="form-control" name="judul_foto" required>
                </div>
                <div class="form-group">
                    <label>Deskripsi Foto</label>
                    <textarea name="deskripsi_foto" class="form-control" cols="30" rows="5" required></textarea>
                </div>
                <div class="form-group">
                    <label>Pilih Gambar</label>
                    <input type="file" name="lokasi_file" class="form-control" required accept=".jpg,.png,.gif">
                    <small class="text-danger">File harus berupa *.jpg *.png *.gif</small>
                </div>
                <input type="submit" value="Upload" class="btn btn-success my-3" name="submit">
            </form>
            <?php elseif(isset($_GET['edit'])): ?>
                <form action="?url=upload&&edit&&fotoid=<?= $val['foto_id'] ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Judul Foto</label>
                    <input type="text" class="form-control" value="<?= $val['judul_foto'] ?>" name="judul_foto" required>
                </div>
                <div class="form-group">
                    <label>Deskripsi Foto</label>
                    <textarea name="deskripsi_foto" class="form-control" cols="30" rows="5" required><?= $val['deskripsi_foto'] ?></textarea>
                </div>
                <div class="form-group">
                    <label>Pilih Gambar</label>
                    <input type="file" name="lokasi_file" class="form-control" accept=".jpg,.png,.gif">
                    <small class="text-danger">File harus berupa *.jpg *.png *.gif</small>
                </div>
                <input type="submit" value="Edit" class="btn btn-success my-3" name="submit">
            </form>
            <?php endif; ?>
        </div>
        <div class="col-7">
            <div class="row">
                <?php 
                    $fotos = mysqli_query($conn, "SELECT * FROM foto WHERE user_id='".@$_SESSION['user_id']."'");
                    foreach ($fotos as $foto):
                ?>
                    <div class="col-6 col-md-4 col-lg-3 mb-4">
                        <div class="card">
                            <img src="uploads/<?= $foto['lokasi_file'] ?>" class="object-fit-cover" style="aspect-ratio: 16/9;">
                            <div class="card-body">
                                <p class="small"><?= $foto['judul_foto'] ?></p>
                                <a href="?url=upload&&edit&&fotoid=<?= $foto['foto_id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                <a href="?url=upload&&hapus&&fotoid=<?= $foto['foto_id'] ?>" class="btn btn-sm btn-danger">Hapus</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
