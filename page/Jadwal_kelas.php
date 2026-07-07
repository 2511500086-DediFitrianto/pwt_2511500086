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

if (isset($_GET['action']) && $_GET['action'] == "hapus") {
    $kd = $_GET['kd'];
    mysqli_query($conn, "DELETE FROM detailjadwal WHERE Id_jadwal='$kd'");
    $hapus = mysqli_query($conn, "DELETE FROM jadwal_kelas WHERE Id_jadwal='$kd'");

    if ($hapus) {
        echo '
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            Data berhasil dihapus.
        </div>';

        echo '<meta http-equiv="refresh" content="1;url=starter.php?page=jadwal_kelas">';
    }
}
?>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">

                <?php if ($_SESSION['role'] == "admin") { ?>

                    <a href="starter.php?page=tambah_jadwal" class="btn btn-primary mb-3">
                        Tambah
                    </a>

                <?php } ?>
                <table class="table table-bordered table-striped">
                    <thead class="text-center">

                        <tr>

                            <th width="5%">No</th>
                            <th width="10%">ID Jadwal</th>
                            <th>Guru</th>
                            <th>Tahun Ajaran</th>
                            <th>Semester</th>
                            <th>Detail Jadwal</th>
                            <th width="15%">Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php

                        $no = 1;

                        $query = mysqli_query($conn, "SELECT jk.*, g.Nm_guru FROM jadwal_kelas jk LEFT JOIN guru g ON jk.Kd_guru = g.Kd_guru ORDER BY jk.Id_jadwal DESC");

                        while ($result = mysqli_fetch_assoc($query)) {

                        ?>

                            <tr>

                                <td class="text-center"><?= $no++; ?></td>
                                <td><?= $result['Id_jadwal']; ?></td>
                                <td><?= $result['Nm_guru']; ?></td>
                                <td><?= $result['Thn_ajaran']; ?></td>
                                <td><?= ucfirst($result['Semester']); ?></td>

                                <td>

                                    <ul class="mb-0">
                                        <?php
                                        $detail = mysqli_query($conn, "SELECT d.*, m.nm_mapel FROM detailjadwal d LEFT JOIN mapel m ON d.kd_mapel = m.kd_mapel WHERE d.Id_jadwal = '".$result['Id_jadwal']."'");

                                        while ($d = mysqli_fetch_assoc($detail)) {

                                            echo "<li>
                                                    <b>{$d['nm_mapel']}</b>
                                                    <br>
                                                    {$d['Hari']}
                                                    |
                                                    {$d['Jam_mulai']} - {$d['Jam_selesai']}
                                                  </li>";

                                        }

                                        ?>

                                    </ul>

                                </td>

                                <td class="text-center">

                                    <?php if ($_SESSION['role'] == "admin") { ?>

                                        <a href="starter.php?page=edit_jadwal&kd=<?= $result['Id_jadwal']; ?>"
                                           class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

                                        <a href="starter.php?page=jadwal_kelas&action=hapus&kd=<?= $result['Id_jadwal']; ?>"
                                           class="btn btn-danger btn-sm"
                                           onclick="return confirm('Yakin ingin menghapus data ini ?')">
                                            Hapus
                                        </a>

                                    <?php } ?>

                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>