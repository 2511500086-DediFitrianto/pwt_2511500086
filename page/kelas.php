<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Kelas</h1>
            </div>
        </div>
    </div>
</div>

<?php
include "config/koneksi.php";

if (isset($_GET['action']) && $_GET['action'] == "hapus") {
    $kd = $_GET['kd'];
    $query = mysqli_query($conn, "DELETE FROM Kelas WHERE Id_kelas='$kd'");

    if ($query) {
        echo "<div class='alert alert-warning'>Berhasil Di Hapus</div>";
        echo '<meta http-equiv="refresh" content="1;url=starter.php?page=kelas">';
    }
}
?>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <?php if($_SESSION['role'] == 'admin'){ ?>
                    <a href="?page=tambah_kelas" class="btn btn-primary">Tambah</a>
                <?php } ?>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Id kelas</th>
                            <th>Nama kelas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 0;
                        $query = mysqli_query($conn, "SELECT * FROM Kelas");
                        while ($result = mysqli_fetch_array($query)) {
                            $no++;
                        ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $result['Id_kelas']; ?></td>
                            <td><?= $result['Nm_kelas']; ?></td>
                            <td>
                                <?php if($_SESSION['role'] == 'admin'){ ?>
                                    <a href="starter.php?page=edit_kelas&kd=<?= $result['Id_kelas']; ?>">
                                        <span class="badge badge-warning">Edit</span>
                                    </a>
                                    <a href="starter.php?page=kelas&action=hapus&kd=<?= $result['Id_kelas']; ?>">
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