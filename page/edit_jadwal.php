<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Data Jadwal</h1>
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

$kd = $_GET['kd'];

$edit = mysqli_fetch_array(mysqli_query($conn, "
    SELECT *
    FROM jadwal_kelas
    WHERE Id_jadwal='$kd'
"));

if (!$edit) {
    echo "<div class='alert alert-danger'>Data tidak ditemukan.</div>";
    exit;
}

if (isset($_POST['update'])) {

    $Id_kelas = $_POST['Id_kelas'];
    $Kd_guru = $_POST['Kd_guru'];
    $Thn_ajaran = $_POST['Thn_ajaran'];
    $Semester = $_POST['Semester'];

    $update = mysqli_query($conn, "
        UPDATE jadwal_kelas SET
            Id_kelas='$Id_kelas',
            Kd_guru='$Kd_guru',
            Thn_ajaran='$Thn_ajaran',
            Semester='$Semester'
        WHERE Id_jadwal='$kd'
    ");

    if ($update) {

        //hapus detail lama
        mysqli_query($conn, "
            DELETE FROM detailjadwal
            WHERE Id_jadwal='$kd'
        ");

        $kd_mapel = $_POST['kd_mapel'];
        $hari = $_POST['hari'];
        $jam_mulai = $_POST['jam_mulai'];
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
                    '$kd',
                    '$kd_mapel[$i]',
                    '$hari[$i]',
                    '$jam_mulai[$i]',
                    '$jam_selesai[$i]'
                )
            ");
        }

        echo '
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h5><i class="icon fas fa-check"></i> Info</h5>
            <h4>Data berhasil diupdate.</h4>
        </div>';

        echo '<meta http-equiv="refresh" content="1;url=starter.php?page=jadwal_kelas">';

    } else {

        echo '
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h5><i class="icon fas fa-times"></i> Error</h5>
            <h4>Gagal Update</h4>
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

                                <option value="<?= $k['Id_kelas']; ?>" <?= ($edit['Id_kelas'] == $k['Id_kelas']) ? 'selected' : ''; ?>>

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
                                <option value="<?= $g['Kd_guru']; ?>" <?= ($edit['Kd_guru'] == $g['Kd_guru']) ? 'selected' : ''; ?>>
                                    <?= $g['Nm_guru']; ?>
                                </option>
                            <?php } ?>
                        </select>

                    </div>

                    <div class="form-group">
                        <label>Tahun Ajaran</label>
                        <input type="text" name="Thn_ajaran" class="form-control" value="<?= $edit['Thn_ajaran']; ?>"
                            required>
                    </div>

                    <div class="form-group">

                        <label>Semester</label>

                        <select name="Semester" class="form-control" required>
                            <option value="ganjil" <?= ($edit['Semester'] == "ganjil") ? 'selected' : ''; ?>>
                                Ganjil
                            </option>
                            <option value="genap" <?= ($edit['Semester'] == "genap") ? 'selected' : ''; ?>>
                                Genap
                            </option>
                        </select>

                    </div>
                    <hr>
                    <h5>Detail Jadwal</h5>
                    <div id="detail-container">
                        <?php

                        $detail = mysqli_query($conn, "SELECT * FROM detailjadwal WHERE Id_jadwal='$kd'");

                        while ($d = mysqli_fetch_array($detail)) {

                            ?>

                            <div class="row detail-item mb-3">
                                <div class="col-md-3">
                                    <label>Mata Pelajaran</label>
                                    <select name="kd_mapel[]" class="form-control" required>
                                        <option value="">-- Pilih Mapel --</option>
                                        <?php
                                        $mapel = mysqli_query($conn, "SELECT * FROM mapel");
                                        while ($m = mysqli_fetch_array($mapel)) {
                                            ?>

                                            <option value="<?= $m['kd_mapel']; ?>"
                                                <?= ($d['kd_mapel'] == $m['kd_mapel']) ? 'selected' : ''; ?>>
                                                <?= $m['nm_mapel']; ?>

                                            </option>

                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label>Hari</label>
                                    <select name="hari[]" class="form-control" required>

                                        <?php

                                        $hari = array(
                                            "Senin",
                                            "Selasa",
                                            "Rabu",
                                            "Kamis",
                                            "Jumat",
                                            "Sabtu"
                                        );

                                        foreach ($hari as $h) {

                                            ?>

                                            <option value="<?= $h; ?>" <?= ($d['Hari'] == $h) ? 'selected' : ''; ?>>

                                                <?= $h; ?>

                                            </option>

                                        <?php } ?>

                                    </select>

                                </div>

                                <div class="col-md-2">

                                    <label>Jam Mulai</label>

                                    <input type="time" name="jam_mulai[]" class="form-control"
                                        value="<?= $d['Jam_mulai']; ?>" required>

                                </div>

                                <div class="col-md-2">

                                    <label>Jam Selesai</label>

                                    <input type="time" name="jam_selesai[]" class="form-control"
                                        value="<?= $d['Jam_selesai']; ?>" required>

                                </div>

                                <div class="col-md-2">

                                    <label>&nbsp;</label>

                                    <button type="button" class="btn btn-danger btn-block hapus-detail">

                                        Hapus

                                    </button>

                                </div>

                            </div>

                        <?php } ?>

                    </div>

                    <br>

                    <button type="button" id="tambah-detail" class="btn btn-success">

                        Tambah Detail

                    </button>

                    <hr>

                    <div class="card-footer">

                        <input type="submit" name="update" value="Update" class="btn btn-primary">

                        <a href="starter.php?page=jadwal_kelas" class="btn btn-secondary">

                            Batal

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</section>