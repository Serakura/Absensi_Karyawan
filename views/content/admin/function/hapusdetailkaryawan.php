<?php
require '../../../../database/db.php';
$kode = $_GET['kd_detailkaryawan'];
$hapus = mysqli_query($koneksi, "DELETE FROM detail_karyawan WHERE kd_detailkaryawan='$kode'");
if ($hapus) {
?>
    <script>
        document.location = '../../../?page=detail_karyawan&msg=Berhasil menghapus data detail karyawan';
    </script>
<?php
}

?>