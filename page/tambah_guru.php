<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tambah Data Guru</h1>
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
//kode otomatis
$carikode = mysqli_query($conn,"select max(Kd_guru) from guru") or die (mysqli_error($conn));
$datakode = mysqli_fetch_array($carikode);
if($datakode[0] != NULL) {
    $nilaikode = substr($datakode[0], 2);
    $kode = (int) $nilaikode;
    $kode = $kode + 1;
    $hasilkode = "G-" . str_pad($kode, 3, "0", STR_PAD_LEFT);
} else {
    $hasilkode = "G-001";
}
$_SESSION["KODE"] = $hasilkode;

if(isset($_POST['tambah'])){
    $Kd_guru = $_POST['Kd_guru'];
    $Id_user = $_POST['Id_user'];
    $Nm_guru = $_POST['Nm_guru'];
    $Jenkel = $_POST['Jenkel'];
    $Pend_terakhir = $_POST['Pend_terakhir'];
    $Hp = $_POST['Hp'];
    $Alamat = $_POST['Alamat'];

    $insert = mysqli_query($conn, "INSERT INTO guru values ('$Kd_guru','$Id_user','$Nm_guru','$Jenkel','$Pend_terakhir','$Hp','$Alamat')");
    $insertuser = mysqli_query($conn, "INSERT INTO admin (username, password, role) values ('$Kd_guru','12345','guru')");

    if ($insert) {
        echo '<div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <h5><i class="icon fas fa-check"></i> Info</h5>
        <h4>Berhasil Disimpan</h4></div>';
        echo '<meta http-equiv="refresh" content="1;url=starter.php?page=guru">';
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
                            <label for="Kd_guru">Kode Guru</label>
                            <input type="text" name="Kd_guru" value="<?= $hasilkode; ?>" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="Id_user">ID User</label>
                            <input type="text" name="Id_user" id="Id_user" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="Nm_guru">Nama Guru</label>
                            <input type="text" name="Nm_guru" id="Nm_guru" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label for="Jenkel">Jenis Kelamin</label>
                            <select name="Jenkel" id="Jenkel" class="form-control">
                                <option value="">-- Pilih --</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="Pend_terakhir">Pendidikan Terakhir</label>
                            <input type="text" name="Pend_terakhir" id="Pend_terakhir" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label for="Hp">No HP</label>
                            <input type="text" name="Hp" id="Hp" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label for="Alamat">Alamat</label>
                            <textarea name="Alamat" id="Alamat" class="form-control"></textarea>
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