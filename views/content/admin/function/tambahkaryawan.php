<?php
require '../../../../database/db.php';
$fil_dir = '../../../../upload_files/profile_pictures/';
$nama       = $_POST['nama'];
$nip        = $_POST['nip'];
$username   = $_POST['username'];
$password   = md5($_POST['password']);
$jenkel     = $_POST['jeniskelamin'];
$tempat     = $_POST['tempat_lahir'];
$tanggal    = $_POST['tanggal_lahir'];
$agama      = $_POST['agama'];
$alamat     = $_POST['alamat'];
$telp       = $_POST['telepon'];
$gambar     = $_FILES['foto']['name'];
$tmpgambar  = $_FILES['foto']['tmp_name'];

$cek_nip = mysqli_query($koneksi, "SELECT * FROM karyawan WHERE nip='$nip' AND username='$username'");

if (mysqli_num_rows($cek_nip) > 0) {
?>
    <script>
        window.location = '../../../index.php?page=karyawan&msg=Gagal menambahkan data karyawan karena NIP atau Username sudah digunakan';
    </script>


<?php
} else {
    if ($gambar == null) {
        $query = mysqli_query($koneksi, "INSERT INTO karyawan 
        (nama_karyawan,nip,username,password,jenis_kelamin,agama,tempat_lahir,tanggal_lahir,alamat,telp)
         VALUES 
         ('$nama','$nip','$username','$password','$jenkel','$agama','$tempat','$tanggal','$alamat','$telp')");


        echo "
<script>
window.location='../../../index.php?page=siswa&msg=Berhasil menambahkan data siswa';
</script>
";
    } else {
        $ekstensifile     = explode('.', $gambar);
        $ekstensifile    = strtolower(end($ekstensifile));
        if ($ekstensifile != 'png' && $ekstensifile != 'jpg' && $ekstensifile != 'jpeg') {
            echo "<script>
            window.location='../../../index.php?page=karyawan&msg=Gagal menambahkan data karyawan karena format gambar tidak sesuai';
                </script>";
        } else {
            $namaFileBaru  = uniqid() . '_' . $gambar;
            $pidah_folder = move_uploaded_file($tmpgambar, $fil_dir . $namaFileBaru);

            if ($pidah_folder) {
                $query = mysqli_query($koneksi, "INSERT INTO karyawan 
                (nama_karyawan,nip,username,password,jenis_kelamin,agama,tempat_lahir,tanggal_lahir,alamat,telp,foto)
                 VALUES 
                 ('$nama','$nip','$username','$password','$jenkel','$agama','$tempat','$tanggal','$alamat','$telp','$namaFileBaru')");
                echo "<script>
                    window.location='../../../index.php?page=karyawan&msg=Berhasil menambahkan data karyawan';
                </script>";
            } else {
                echo "<script>
                window.location='../../../index.php?page=karyawan&msg=Gagal menambahkan data karyawan';
            </script>";
            }
        }
    }
}

?>