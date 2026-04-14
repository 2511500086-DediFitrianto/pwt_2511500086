<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Mata Pelajaran</h1>
            </div>
        </div>
    </div>
</div>

<?php
include "config/koneksi.php";
$kd = $_GET['kd'];
$edit = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM jadwal_kelas WHERE Id_jadwal='$kd'"));

if(isset($_POST['tambah'])){
    $Id_kelas = $_POST['Id_kelas'];
    $Thn_ajaran = $_POST['Thn_ajaran'];
    $Semester = $_POST['Semester'];

    $insert = mysqli_query($conn, "UPDATE jadwal_kelas SET Id_kelas='$Id_kelas', Thn_ajaran='$Thn_ajaran', Semester='$Semester' WHERE Id_jadwal='$kd_mapel'");

    if ($insert) {
        echo '<div class="alert alert-info-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Berhasil Disimpan</h4></div>';
        echo '<meta http-equiv="refresh" content="1;url=starter.php?page=Jadwal_kelas">';
    } else {
        echo '<div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Gagal Disimpan</h4></div>';
    }
}
?>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body p-2">
                <form method="POST">

                    <div class="form-group">
                        <label>ID Jadwal</label>
                        <input type="text" value="<?= $edit['Id_jadwal']; ?>" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label>Kode Kelas</label>
                        <input type="number" name="Id_kelas" value="<?= $edit['Id_kelas']; ?>" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Tahun Ajaran</label>
                        <input type="text" name="Thn_ajaran" value="<?= $edit['Thn_ajaran']; ?>" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Semester</label>
                        <select name="Semester" class="form-control" required>
                            <option value="ganjil" <?= ($edit['Semester']=='ganjil')?'selected':''; ?>>Ganjil</option>
                            <option value="genap" <?= ($edit['Semester']=='genap')?'selected':''; ?>>Genap</option>
                        </select>
                    </div>

                    <div class="card-footer">
                        <input type="submit" class="btn btn-primary" name="tambah" value="Simpan">
                        <a href="starter.php?page=jadwal_kelas" class="btn btn-secondary">Batal</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>