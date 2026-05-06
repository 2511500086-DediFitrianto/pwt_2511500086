<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Siswa</h1>
            </div>
        </div>
    </div>
</div>

<?php
include "config/koneksi.php";

if (isset($_GET['action']) && $_GET['action'] == "hapus") {
    $kd = $_GET['kd'];
    $query = mysqli_query($conn, "DELETE FROM skripsi_2511500086 WHERE id_skripsi086='$kd'");

    if ($query) {
        echo "<div class='alert alert-warning'>Berhasil Di Hapus</div>";
        echo '<meta http-equiv="refresh" content="1;url=starter.php?page=skripsi">';
    }
}
?>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <?php if($_SESSION['role'] == 'admin'){ ?>
                    <a href="?page=tambah_skripsi" class="btn btn-primary">Tambah</a>
                <?php } ?>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Id Skripsi</th>
                            <th>Judul Skripsi</th>
                            <th>Topik</th>
                            <th>Semester</th>
                            <th>Tahun ajaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 0;
                        $query = mysqli_query($conn, "SELECT * FROM skripsi_2511500086");
                        while ($result = mysqli_fetch_array($query)) {
                            $no++;
                            ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $result['id_skripsi086']; ?></td>
                            <td><?= $result['judul_skripsi086']; ?></td>
                            <td><?= $result['topik086']; ?></td>
                            <td><?= $result['semester086']; ?></td>
                            <td><?= $result['thn_ajaran086']; ?></td>                          
                            <td>
                                <?php if($_SESSION['role'] == 'admin'){ ?>
                                    <a href="starter.php?page=edit_skripsi&kd=<?= $result['id_skripsi086']; ?>">
                                        <span class="badge badge-warning">Edit</span>
                                    </a>
                                    <a href="starter.php?page=skripsi&action=hapus&kd=<?= $result['id_skripsi086']; ?>">
                                        <span class="badge badge-danger">Hapus</span>
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