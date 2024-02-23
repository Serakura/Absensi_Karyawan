<?php
require '../../../../database/db.php';
date_default_timezone_set('Asia/Jakarta');
$kode      = $_POST['textqr'];
$nip       = $_POST['nip'];
$tanggal    = date("Y-m-d H:i:s");

$query = mysqli_query($koneksi, "SELECT tanggal FROM absensi  WHERE kd_absensi='$kode' AND tanggal <= '$tanggal' AND tanggal+INTERVAL 1 HOUR >= '$tanggal'");
if (mysqli_num_rows($query) > 0) {
    $query = mysqli_query($koneksi, "SELECT status FROM detail_absensi  WHERE nip='$nip' AND kd_absensi='$kode'");
    while ($dt = mysqli_fetch_array($query)) {
        $status = $dt['status'];
    }
    if ($status == 'Tidak Absen') {
        $query = mysqli_query($koneksi, "UPDATE detail_absensi SET waktu='$tanggal',status='Ada' WHERE nip='$nip' AND kd_absensi='$kode'");


        if ($query) {
            echo "<script>
        window.location='../../../index.php?page=absensi&msg=Berhasil melakukan scan absensi';</script>";
        } else {
            return false;
        }
    } else {
        echo "<script>
        window.location='../../../index.php?page=absensi&msg=Gagal melakukan scan absensi karena sudah melakukan absensi';</script>";
    }
} else {
    echo "<script>
    window.location='../../../index.php?page=absensi&msg=Gagal melakukan scan absensi karena bukan waktunya untuk absen!';</script>";
}
