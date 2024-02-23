<?php
require '../../../../database/db.php';
$fil_dir = '../../../../upload_files/pengumuman_pictures/';

$judul      = $_POST['judul'];
$tanggal    = $_POST['tanggal'];
$keterangan = $_POST['keterangan'];




$query = mysqli_query($koneksi, "INSERT INTO pengumuman 
        (judul,tanggal,keterangan)
         VALUES 
         ('$judul','$tanggal','$keterangan')");


echo "
<script>
window.location='../../../index.php?page=pengumuman&msg=Berhasil menambahkan data pengumuman';
</script>
";
