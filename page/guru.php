<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Guru</h1>
            </div>
        </div>
    </div>
</div>

<?php
include "config/koneksi.php";

if (isset($_GET['action']) && $_GET['action'] == "hapus") {
    $kd = $_GET['kd'];
    $query = mysqli_query($conn, "DELETE FROM guru WHERE Kd_guru='$kd'");

    if ($query) {
        echo "<div class='alert alert-warning'>Berhasil Di Hapus</div>";
        echo '<meta http-equiv="refresh" content="1;url=starter.php?page=guru">';
    }
}
?>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <?php if($_SESSION['role'] == 'admin'){ ?>
                    <a href="?page=tambah_guru" class="btn btn-primary">Tambah</a>
                <?php } ?>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Kd Guru</th>
                            <th>Id User</th>
                            <th>Nama Guru</th>
                            <th>Jenis Kelamin</th>
                            <th>Pendidikan Terakhir</th>
                            <th>No HP</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 0;
                        $query = mysqli_query($conn, "SELECT * FROM guru");
                        while ($result = mysqli_fetch_array($query)) {
                            $no++;
                            ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $result['Kd_guru']; ?></td>
                            <td><?= $result['Id_user']; ?></td>
                            <td><?= $result['Nm_guru']; ?></td>
                            <td><?= $result['Jenkel']; ?></td>
                            <td><?= $result['Pend_terakhir']; ?></td>
                            <td><?= $result['Hp']; ?></td>
                            <td><?= $result['Alamat']; ?></td>
                            <td>
                                <?php if($_SESSION['role'] == 'admin'){ ?>
                                    <a href="starter.php?page=edit_guru&kd=<?= $result['Kd_guru']; ?>">
                                        <span class="badge badge-warning">Edit</span>
                                    </a>
                                    <a href="starter.php?page=guru&action=hapus&kd=<?= $result['Kd_guru']; ?>">
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