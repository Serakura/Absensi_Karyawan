<?php
require '../../../../database/db.php';

$kode       = $_POST['kode'];
$jabatan       = $_POST['jabatan'];
$gaji      = $_POST['gaji'];
$divisi     = $_POST['divisi'];
$tanggal_gabung       = $_POST['tanggal_bergabung'];



$query = mysqli_query($koneksi, "UPDATE detail_karyawan SET jabatan='$jabatan',gaji='$gaji',divisi='$divisi',tanggal_bergabung='$tanggal_gabung' WHERE kd_detailkaryawan='$kode'");


if ($query) {
    echo "<script>
    
    window.location='../../../index.php?page=detail_karyawan&msg=Berhasil mengupdate data detail karyawan';</script>";
} else {
    return false;
}
