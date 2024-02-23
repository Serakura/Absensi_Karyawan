<?php
require '../../../../database/db.php';

$kd         = $_POST['kd_pengumuman'];
$judul      = $_POST['judul'];
$tanggal    = $_POST['tanggal'];
$keterangan = $_POST['keterangan'];



$query = mysqli_query($koneksi, "UPDATE pengumuman SET judul='$judul',tanggal='$tanggal',keterangan='$keterangan'WHERE kd_pengumuman='$kd'");
echo "<script>
    window.location='../../../index.php?page=pengumuman&msg=Berhasil mengupdate data pengumuman';</script>";
