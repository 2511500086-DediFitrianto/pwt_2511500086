<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Jadwal Kelas</h1>
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
        window.location='starter.php?page=Jadwal_kelas';
    </script>";
    exit;
}

if(isset($_POST['tambah'])){
    $Id_kelas   = $_POST['Id_kelas'];
    $Thn_ajaran = $_POST['Thn_ajaran'];
    $Semester   = $_POST['Semester'];

    $insert = mysqli_query($conn, "
    INSERT INTO jadwal_kelas 
    (Id_kelas, Thn_ajaran, Semester)
    VALUES 
    ('$Id_kelas','$Thn_ajaran','$Semester')
    ");

    if ($insert) {
        echo '<div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <h5><i class="icon fas fa-check"></i> Info</h5>
        <h4>Berhasil Disimpan</h4></div>';
        echo '<meta http-equiv="refresh" content="1;url=starter.php?page=jadwal_kelas">';
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
                <form method="POST">

                    <div class="form-group">
                        <label>Kode Kelas</label>
                        <input type="text" name="Id_kelas" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Tahun Ajaran</label>
                        <input type="text" name="Thn_ajaran" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Semester</label>
                        <select name="Semester" class="form-control" required>
                            <option value="">-- Pilih Semester --</option>
                            <option value="ganjil">Ganjil</option>
                            <option value="genap">Genap</option>
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