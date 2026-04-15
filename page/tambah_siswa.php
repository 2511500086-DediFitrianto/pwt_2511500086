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
//kode otomatis
$carikode = mysqli_query($conn,"select max(Nis) from Siswa") or die (mysqli_error($conn));
$datakode = mysqli_fetch_array($carikode);
if($datakode[0] != NULL) {
    $nilaikode = substr($datakode[0], 2);
    $kode = (int) $nilaikode;
    $kode = $kode + 1;
    $hasilkode = "00" . str_pad($kode, 3, "0", STR_PAD_LEFT);
} else {
    $hasilkode = "001";
}

if(isset($_POST['tambah'])){
    $Nis = $_POST['Nis'];
    $Id_user = $_POST['Id_user'];
    $Nm_siswa = $_POST['Nm_siswa'];
    $Jenkel = $_POST['Jenkel'];
    $Hp = $_POST['Hp'];
    $Id_kelas = $_POST['Id_kelas'];

    $insert = mysqli_query($conn, "INSERT INTO Siswa values ('$Nis','$Id_user','$Nm_siswa','$Jenkel','$Hp','$Id_kelas')");
    $insertuser = mysqli_query($conn, "INSERT INTO admin (username, password, role) values ('$Nis','12345','siswa')");

    if ($insert) {
        echo '<div class="alert alert-info-dismissible">
        <button type="button" class="close" data-dismiss="alert"
            aria-hidden="true">×</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Berhasil Disimpan</h4></div>';
        echo '<meta http-equiv="refresh" content="1;url=starter.php?page=siswa">';
    } else {
        echo '<div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert"
            aria-hidden="true">×</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Nis sudah dipakai, Gagal Disimpan</h4></div>';
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
                            <label for="Nis">NIS</label>
                            <input type="text" name="Nis" id="Nis" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="Id_user">ID User</label>
                            <input type="number" name="Id_user" id="Id_user" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="Nm_siswa">Nama Siswa</label>
                            <input type="text" name="Nm_siswa" id="Nm_siswa" class="form-control">
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
                            <label for="Hp">No HP</label>
                            <input type="text" name="Hp" id="Hp" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label for="Id_kelas">ID Kelas</label>
                            <select type="text" name="Id_kelas" id="Id_kelas" class="form-control">
                                <option value="">-- Pilih --</option>
                                <?php
                                $query = mysqli_query($conn, "SELECT * FROM kelas");
                                while ($result = mysqli_fetch_array($query)) {
                                    echo "<option value='" . $result['Id_kelas'] . "'>" . $result['Nm_kelas'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="card-footer">
                            <input type="submit" class="btn btn-primary" name="tambah" value="Simpan">
                            <a href="starter.php?page=siswa" class="btn btn-secondary">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>