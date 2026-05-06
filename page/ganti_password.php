<?php
require_once "config/koneksi.php";

/** @var mysqli $koneksi */

if (!isset($_SESSION['username'])) {
    echo "<script>window.location='login.php';</script>";
    exit;
}

if (isset($_POST['simpan'])) {

    $Username = $_SESSION['username'];
    $p1 = $_POST['p1'];
    $pb = $_POST['pb'];

    $cek = mysqli_query($conn,
    "SELECT * FROM admin WHERE username='$Username' AND password='$p1'");

    if (mysqli_num_rows($cek) > 0) {

        mysqli_query($conn,
        "UPDATE admin SET password='$pb' WHERE username='$Username'");

        echo "<script>alert('Password berhasil diganti');</script>";

        if ($_SESSION['role'] == "guru") {
            echo "<script>window.location='starter.php?page=guru';</script>";
        } elseif ($_SESSION['role'] == "siswa") {
            echo "<script>window.location='starter.php?page=siswa';</script>";
        } else {
            echo "<script>window.location='starter.php?page=dashboard';</script>";
        }

        exit;

    } else {
        echo "<div class='alert alert-danger'>Password lama salah</div>";
    }
}
?>

<div class="content-header">
    <div class="container-fluid">
        <h1>Ganti Password</h1>
    </div>
</div>

<form method="POST">
    <input type="Password" name="p1" placeholder="Password Lama" class="form-control" required><br>
    <input type="Password" name="pb" placeholder="Password Baru" class="form-control" required><br>

    <button type="submit" name="simpan" class="btn btn-primary">
        Ganti Password
    </button>
</form>