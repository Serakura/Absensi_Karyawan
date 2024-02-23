<?php
require '../../../../database/db.php';
$kode_admin = $_POST['kode'];
$tanggal = $_POST['tanggal'];
$kegunaan = $_POST['kegunaan'];
$kode      = uniqid();



$query = mysqli_query($koneksi, "INSERT INTO absensi 
						(kd_absensi,kd_admin,tanggal,kegunaan)
 						VALUES 
 						('$kode','$kode_admin','$tanggal','$kegunaan')");

if ($query) {
    $query = mysqli_query($koneksi, "SELECT nip FROM karyawan");
    $status = "Tidak Absen";
    while ($data = mysqli_fetch_array($query)) {
        $nip = $data['nip'];
        $query1 = mysqli_query($koneksi, "INSERT INTO detail_absensi 
						(kd_absensi,nip,status)
 						VALUES 
 						('$kode','$nip','$status')");
    }
    echo "<script>
    window.location='../../../index.php?page=absensi&msg=Berhasil menambahkan data absensi';
 	</script>";
}
