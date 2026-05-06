<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Data Guru</h1>
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
        window.location='starter.php?page=guru';
    </script>";
    exit;
}
$kd = $_GET['kd'];
$edit = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM guru WHERE Kd_guru='$kd'"));

if(isset($_POST['tambah'])){
    $Kd_guru = $_POST['Kd_guru'];
    $Id_user = $_POST['Id_user'];
    $Nm_guru = $_POST['Nm_guru'];
    $Jenkel = $_POST['Jenkel'];
    $Pend_terakhir = $_POST['Pend_terakhir'];
    $Hp = $_POST['Hp'];
    $Alamat = $_POST['Alamat'];

    $insert = mysqli_query($conn, "UPDATE guru SET Id_user='$Id_user', Nm_guru='$Nm_guru', Jenkel='$Jenkel', Pend_terakhir='$Pend_terakhir', Hp='$Hp', Alamat='$Alamat' WHERE Kd_guru='$Kd_guru'");

    if ($insert) {
        echo '<div class="alert alert-info-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Berhasil Disimpan</h4></div>';
        echo '<meta http-equiv="refresh" content="1;url=starter.php?page=guru">';
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
            <div class="card-body">
                <div class="card-body p-2">
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="Kd_guru">Kode Guru</label>
                            <input type="text" name="Kd_guru" value="<?= $edit['Kd_guru']; ?>" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="Id_user">ID User</label>
                            <input type="text" name="Id_user" id="Id_user" value="<?= $edit['Id_user']; ?>" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="Nm_guru">Nama Guru</label>
                            <input type="text" name="Nm_guru" id="Nm_guru" value="<?= $edit['Nm_guru']; ?>" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label for="Jenkel">Jenis Kelamin</label>
                            <select name="Jenkel" id="Jenkel" class="form-control">
                                <option value="">-- Pilih --</option>
                                <option value="L" <?= ($edit['Jenkel'] == 'L') ? 'selected' : '' ?>>Laki-laki</option>
                                <option value="P" <?= ($edit['Jenkel'] == 'P') ? 'selected' : '' ?>>Perempuan</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="Pend_terakhir">Pendidikan Terakhir</label>
                            <input type="text" name="Pend_terakhir" id="Pend_terakhir" value="<?= $edit['Pend_terakhir']; ?>" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label for="Hp">No HP</label>
                            <input type="text" name="Hp" id="Hp" value="<?= $edit['Hp']; ?>" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label for="Alamat">Alamat</label>
                            <textarea name="Alamat" id="Alamat" class="form-control"><?= $edit['Alamat']; ?></textarea>
                        </div>
                        <div class="card-footer">
                            <input type="submit" class="btn btn-primary" name="tambah" value="Simpan">
                            <a href="starter.php?page=guru" class="btn btn-secondary">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>                    