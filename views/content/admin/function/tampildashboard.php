<?php
require '../database/db.php';

$karyawan = mysqli_query($koneksi, "SELECT nip  FROM karyawan");
$pengumuman  = mysqli_query($koneksi, "SELECT kd_pengumuman FROM pengumuman");
$tanggal = date("d-m-Y");
