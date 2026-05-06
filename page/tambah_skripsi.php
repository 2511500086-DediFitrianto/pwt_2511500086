<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tambah Data Siswa</h1>
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
        window.location='starter.php?page=skripsi';
    </script>";
    exit;
}
//kode otomatis
$carikode = mysqli_query($conn,"select max(id_skripsi086) from skripsi_2511500086") or die (mysqli_error($conn));
$datakode = mysqli_fetch_array($carikode);
if($datakode[0] != NULL) {
    $nilaikode = substr($datakode[0], 2);
    $kode = (int) $nilaikode;
    $kode = $kode + 1;
    $hasilkode = "S" . str_pad($kode, 3, "0", STR_PAD_LEFT);
} else {
    $hasilkode = "S001";
}

if(isset($_POST['tambah'])){
    $id_skripsi086 = $_POST['id_skripsi086'];
    $judul_skripsi086 = $_POST['judul_skripsi086'];
    $topik086 = $_POST['topik086'];
    $semester086 = $_POST['semester086'];
    $tahun_ajaran086 = $_POST['thn_ajaran086'];

    $insert = mysqli_query($conn, "INSERT INTO skripsi_2511500086 values ('$id_skripsi086','$judul_skripsi086','$topik086','$semester086','$tahun_ajaran086')");

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
            <div class="card-body">
                <div class="card-body p-2">
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="id_skripsi086">ID Skripsi</label>
                            <input type="text" name="id_skripsi086" id="id_skripsi086" class="form-control" value="<?= $hasilkode; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="judul_skripsi086">Judul Skripsi</label>
                            <input type="text" name="judul_skripsi086" id="judul_skripsi086" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="topik086">Topik</label>
                            <input type="text" name="topik086" id="topik086" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="semester086">Semester</label>
                            <select name="semester086" id="semester086" class="form-control">
                                <option value="">-- Pilih --</option>
                                <option value="Gasal">Gasal</option>
                                <option value="Genap">Genap</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="thn_ajaran086">Tahun Ajaran</label>
                            <select name="thn_ajaran086" id="thn_ajaran086" class="form-control">
                                <option value="">-- Pilih --</option>
                                <option value="2022/2023">2022/2023</option>
                                <option value="2023/2024">2023/2024</option>
                                <option value="2024/2025">2024/2025</option>
                                <option value="2024/2025">2025/2025</option>
                            </select>
                        </div>
                        
                        <div class="card-footer">
                            <input type="submit" class="btn btn-primary" name="tambah" value="Simpan">
                            <a href="starter.php?page=skripsi" class="btn btn-secondary">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>