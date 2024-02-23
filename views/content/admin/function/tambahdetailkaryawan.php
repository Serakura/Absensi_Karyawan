<?php
require '../../../../database/db.php';
$nip       = $_POST['nip'];
$jabatan       = $_POST['jabatan'];
$gaji       = $_POST['gaji'];
$divisi     = $_POST['divisi'];
$tanggal_gabung = $_POST['tanggal_bergabung'];


$cek = mysqli_query($koneksi, "SELECT * FROM detail_karyawan WHERE nip='$nip'");

if (mysqli_num_rows($cek) > 0) {
?>
    <script>
        window.location = '../../../index.php?page=detail_karyawan&msg=Gagal menambahkan data detail karyawan karena nip sudah digunakan';
    </script>

<?php
} else {

    $query = mysqli_query($koneksi, "INSERT INTO detail_karyawan 
						(nip,jabatan,divisi,gaji,tanggal_bergabung)
 						VALUES 
 						('$nip','$jabatan','$divisi','$gaji','$tanggal_gabung')");


    echo "<script>
    window.location='../../../index.php?page=detail_karyawan&msg=Berhasil menambahkan data detail karyawan';
 	</script>";
}

?>