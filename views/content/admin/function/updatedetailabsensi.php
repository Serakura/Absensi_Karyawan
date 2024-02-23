<?php
require '../../../../database/db.php';

$kode       = $_POST['kd_detailabsensi'];
$waktu       = $_POST['waktu'];
$status      = $_POST['status'];
$kd = $_POST['kd_absensi'];



$query = mysqli_query($koneksi, "UPDATE detail_absensi SET waktu='$waktu',status='$status' WHERE kd_detailabsensi='$kode'");


if ($query) {
    echo "<script>
    window.location='../../../index.php?page=detail_absensi&kd_absensi=$kd&msg=Berhasil mengupdate data akses absensi';</script>";
} else {
    return false;
}
