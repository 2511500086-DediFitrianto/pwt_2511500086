<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tambah Data Jadwal</h1>
            </div>
        </div>
    </div>
</div>

<?php
include "config/koneksi.php";
include "config/cek_admin.php";

if ($_SESSION['role'] != 'admin') {
    echo "<script>
            alert('Akses ditolak!');
            window.location='starter.php?page=jadwal_kelas';
          </script>";
    exit;
}

if (isset($_POST['tambah'])) {

    $Id_kelas   = $_POST['Id_kelas'];
    $Kd_guru    = $_POST['Kd_guru'];
    $Thn_ajaran = $_POST['Thn_ajaran'];
    $Semester   = $_POST['Semester'];

    $insert = mysqli_query($conn, "
        INSERT INTO jadwal_kelas
        (
            Id_kelas,
            Kd_guru,
            Thn_ajaran,
            Semester
        )
        VALUES
        (
            '$Id_kelas',
            '$Kd_guru',
            '$Thn_ajaran',
            '$Semester'
        )
    ");

    if ($insert) {

        $Id_jadwal = mysqli_insert_id($conn);

        $kd_mapel    = $_POST['kd_mapel'];
        $hari        = $_POST['hari'];
        $jam_mulai   = $_POST['jam_mulai'];
        $jam_selesai = $_POST['jam_selesai'];

        for ($i = 0; $i < count($kd_mapel); $i++) {

            mysqli_query($conn, "
                INSERT INTO detailjadwal
                (
                    Id_jadwal,
                    kd_mapel,
                    Hari,
                    Jam_mulai,
                    Jam_selesai
                )
                VALUES
                (
                    '$Id_jadwal',
                    '$kd_mapel[$i]',
                    '$hari[$i]',
                    '$jam_mulai[$i]',
                    '$jam_selesai[$i]'
                )
            ");
        }

        echo '
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <h5><i class="icon fas fa-check"></i> Info</h5>
            <h4>Berhasil Disimpan</h4>
        </div>';

        echo '<meta http-equiv="refresh" content="1;url=starter.php?page=jadwal_kelas">';

    } else {

        echo '
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <h5><i class="icon fas fa-exclamation-triangle"></i> Error</h5>
            <h4>Gagal Disimpan</h4>
            ' . mysqli_error($conn) . '
        </div>';
    }
}
?>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">

                <form method="POST">

                    <div class="form-group">
                        <label>Kelas</label>
                        <select name="Id_kelas" class="form-control" required>
                            <option value="">-- Pilih Kelas --</option>

                            <?php
                            $kelas = mysqli_query($conn, "SELECT * FROM Kelas");
                            while ($k = mysqli_fetch_array($kelas)) {
                            ?>
                                <option value="<?= $k['Id_kelas']; ?>">
                                    <?= $k['Nm_kelas']; ?>
                                </option>
                            <?php } ?>

                        </select>
                    </div>

                    <div class="form-group">
                        <label>Guru</label>
                        <select name="Kd_guru" class="form-control" required>
                            <option value="">-- Pilih Guru --</option>

                            <?php
                            $guru = mysqli_query($conn, "SELECT * FROM guru");
                            while ($g = mysqli_fetch_array($guru)) {
                            ?>
                                <option value="<?= $g['Kd_guru']; ?>">
                                    <?= $g['Nm_guru']; ?>
                                </option>
                            <?php } ?>

                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tahun Ajaran</label>
                        <input type="text"
                               name="Thn_ajaran"
                               class="form-control"
                               placeholder="Contoh : 2025/2026"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Semester</label>
                        <select name="Semester" class="form-control" required>
                            <option value="">-- Pilih Semester --</option>
                            <option value="ganjil">Ganjil</option>
                            <option value="genap">Genap</option>
                        </select>
                    </div>

                    <hr>

                    <h5>Detail Jadwal</h5>

                    <div id="detail-container">

                        <div class="row">

                            <div class="col-md-3">
                                <label>Mata Pelajaran</label>
                                <select name="kd_mapel[]" class="form-control" required>

                                    <option value="">-- Pilih Mapel --</option>

                                    <?php
                                    $mapel = mysqli_query($conn, "SELECT * FROM mapel");
                                    while ($m = mysqli_fetch_array($mapel)) {
                                    ?>
                                        <option value="<?= $m['kd_mapel']; ?>">
                                            <?= $m['nm_mapel']; ?>
                                        </option>
                                    <?php } ?>

                                </select>
                            </div>

                            <div class="col-md-3">
                                <label>Hari</label>
                                <select name="hari[]" class="form-control" required>
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                    <option value="Sabtu">Sabtu</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label>Jam Mulai</label>
                                <input type="time"
                                       name="jam_mulai[]"
                                       class="form-control"
                                       required>
                            </div>

                            <div class="col-md-3">
                                <label>Jam Selesai</label>
                                <input type="time"
                                       name="jam_selesai[]"
                                       class="form-control"
                                       required>
                            </div>

                        </div>

                    </div>

                    <br>

                    <div class="card-footer">

                        <input type="submit"
                               name="tambah"
                               value="Simpan"
                               class="btn btn-primary">

                        <a href="starter.php?page=jadwal_kelas"
                           class="btn btn-secondary">
                            Batal
                        </a>

                    </div>

                </form>

            </div>
        </div>
    </div>
</section>