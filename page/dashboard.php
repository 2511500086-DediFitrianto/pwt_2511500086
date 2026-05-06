<?php
include "config/koneksi.php";

$jml_siswa = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM siswa"));
$jml_guru = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM guru"));
$jml_mapel = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM mapel"));
$jml_kelas = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM kelas"));
$jml_jadwal = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM jadwal_kelas"));
?>

<div class="row">

  <div class="col-lg-3 col-6">
    <div class="small-box bg-info">
      <div class="inner">
        <h3><?= $jml_siswa; ?></h3>
        <p>Data Siswa</p>
      </div>
      <div class="icon">
        <i class="fas fa-user-graduate"></i>
      </div>
      <a href="?page=siswa" class="small-box-footer">
        Lihat <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>

  <div class="col-lg-3 col-6">
    <div class="small-box bg-success">
      <div class="inner">
        <h3><?= $jml_guru; ?></h3>
        <p>Data Guru</p>
      </div>
      <div class="icon">
        <i class="fas fa-chalkboard-teacher"></i>
      </div>
      <a href="?page=guru" class="small-box-footer">
        Lihat <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>

  <div class="col-lg-3 col-6">
    <div class="small-box bg-warning">
      <div class="inner">
        <h3><?= $jml_mapel; ?></h3>
        <p>Mata Pelajaran</p>
      </div>
      <div class="icon">
        <i class="fas fa-book"></i>
      </div>
      <a href="?page=mapel" class="small-box-footer">
        Lihat <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>

  <div class="col-lg-3 col-6">
    <div class="small-box bg-danger">
      <div class="inner">
        <h3><?= $jml_kelas; ?></h3>
        <p>Kelas</p>
      </div>
      <div class="icon">
        <i class="fas fa-school"></i>
      </div>
      <a href="?page=kelas" class="small-box-footer">
        Lihat <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>

  <div class="col-lg-3 col-6">
    <div class="small-box bg-primary">
      <div class="inner">
        <h3><?= $jml_jadwal; ?></h3>
        <p>Jadwal</p>
      </div>
      <div class="icon">
        <i class="fas fa-calendar"></i>
      </div>
      <a href="?page=Jadwal_kelas" class="small-box-footer">
        Lihat <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>

</div>