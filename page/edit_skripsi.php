<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Data Siswa</h1>
            </div>
        </div>
    </div>
</div>

<?php
include "config/koneksi.php";
include "config/cek_admin.php";
if($_SESSION['role'] != 'admin'){
    echo "<script>
        alert('Akses ditolak!');
        window.location='starter.php?page=siswa';
    </script>";
    exit;
}
$kd = $_GET['kd'];
$edit = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM skripsi_2511500086 WHERE id_skripsi086='$kd'"));

if(isset($_POST['tambah'])){
    $id_skripsi086 = $_POST['id_skripsi086'];
    $judul_skripsi086 = $_POST['judul_skripsi086'];
    $topik086 = $_POST['topik086'];
    $semester086 = $_POST['semester086'];
    $tahun_ajaran086 = $_POST['thn_ajaran086'];

    $insert = mysqli_query($conn, "UPDATE skripsi_2511500086 SET id_skripsi086='$id_skripsi086', judul_skripsi086='$judul_skripsi086', topik086='$topik086', semester086='$semester086', thn_ajaran086='$tahun_ajaran086' WHERE id_skripsi086='$kd'");

    if ($insert) {
        echo '<div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <h5><i class="icon fas fa-check"></i> Info</h5>
        <h4>Berhasil Disimpan</h4></div>';
        echo '<meta http-equiv="refresh" content="1;url=starter.php?page=skripsi">';
    } else {
        echo '<div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <h5><i class="icon fas fa-exclamation-triangle"></i> Error</h5>
        <h4>Gagal Disimpan</h4>';
        echo mysqli_error($conn);
        echo '</div>';
    }
}
?>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body p-2">
                <form method="POST" action="">

                    <div class="form-group">
                        <label>ID Skripsi</label>
                        <input type="text" name="id_skripsi086" value="<?= $edit['id_skripsi086']; ?>" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label>Judul Skripsi</label>
                        <input type="text" name="judul_skripsi086" value="<?= $edit['judul_skripsi086']; ?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Topik</label>
                        <input type="text" name="topik086" value="<?= $edit['topik086']; ?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Semester</label>
                        <input type="text" name="semester086" value="<?= $edit['semester086']; ?>" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label>Tahun Ajaran</label>
                        <input type="text" name="thn_ajaran086" value="<?= $edit['thn_ajaran086']; ?>" class="form-control">
                    </div>
                    <div class="card-footer">
                        <input type="submit" class="btn btn-primary" name="tambah" value="Simpan">
                        <a href="starter.php?page=siswa" class="btn btn-secondary">Batal</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>