<?php
$host = "localhost";
$port = "8889";
$user = "root";
$pass = "root";
$db   = "db_mahasiswa";

$conn = mysqli_connect($host, $user, $pass, $db, $port);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>