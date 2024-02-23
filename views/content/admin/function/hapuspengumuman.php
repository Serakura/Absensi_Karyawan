<?php
require '../../../../database/db.php';

$kd = $_GET['kd_pengumuman'];

$hapus = mysqli_query($koneksi, "DELETE FROM pengumuman WHERE kd_pengumuman='$kd'");
if ($hapus) {

?>

    <script>
        document.location = '../../../?page=pengumuman&msg=Berhasil menghapus data pengumuman';
    </script>
<?php
}

?>