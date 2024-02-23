<?php
require '../database/db.php';
session_start();
function cekLogin($username, $password, $tahap)
{
    global $koneksi;
    $kolom = "";
    switch ($tahap) {
        case 1:
            $kolom = "username";
            $role = "admin";
            $target = "admin";
            break;

        case 2:
            $kolom = "username";
            $role = "karyawan";
            $target = "karyawan";
            break;

        default:
?>

            <script>
                alert('Username & Password mungkin salah!');
                document.location = "../index.php";
            </script>

        <?php

            break;
    }
    $query = mysqli_query($koneksi, "SELECT * FROM $role WHERE $kolom='$username' AND password='$password'");
    if (mysqli_num_rows($query) == 0) {
        $tahap++;

        cekLogin($username, $password, $tahap);
    } else {
        $result = mysqli_fetch_assoc($query);



        $_SESSION['username'] = $result[$kolom];
        $_SESSION['role'] = $role;

        ?>

        <script>
            alert("Selamat Datang di Sistem Absensi Karyawan");
        </script>

<?php
        header('Location: ../views/index.php');
    }
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = md5($password);

    cekLogin($username, $password, 1);
}
?>