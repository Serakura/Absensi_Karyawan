<?php
require '../../../../database/db.php';

$nip        = $_POST['nip'];
$alamat     = $_POST['alamat'];
$telp       = $_POST['telepon'];


$query = mysqli_query($koneksi, "UPDATE karyawan SET  alamat='$alamat', telp='$telp' WHERE nip='$nip'");


if ($query) {
    echo "<script>
        window.location='../../../index.php?page=profile&msg=Berhasil mengubah data diri';</script>";
} else {
    return false;
}
