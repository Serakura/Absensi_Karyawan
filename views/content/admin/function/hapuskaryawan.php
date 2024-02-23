<?php
require '../../../../database/db.php';
$nip = $_GET['nip'];
$hapus = mysqli_query($koneksi, "DELETE FROM karyawan WHERE nip='$nip'");
if ($hapus) {
?>
    <script>
        document.location = '../../../index.php?page=karyawan&msg=Berhasil menghapus data karyawan';
    </script>
<?php
} else {
echo "Error";
}

?>