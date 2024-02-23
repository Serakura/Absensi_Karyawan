<?php
require '../../../../database/db.php';
$fil_dir = '../../../../upload_files/profile_pictures/';
$kode = $_GET['kd_absensi'];

$query = mysqli_query($koneksi, "DELETE FROM detail_absensi WHERE kd_absensi = '$kode'");

if ($query) {
    $file_path = $fil_dir . $kode . ".png";
    @unlink($file_path);
    $query = mysqli_query($koneksi, "DELETE FROM absensi WHERE kd_absensi = '$kode'");
    echo "<script>
    window.location='../../../index.php?page=absensi&msg=Berhasil menghapus data absensi!';
 	</script>";
} else {
    echo "<script>
    window.location='../../../index.php?page=absensi&msg=Gagal menghapus data absensi!';
 	</script>";
}
