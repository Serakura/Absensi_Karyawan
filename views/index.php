<?php
session_start();
require '../database/db.php';
include '../assets/phpqrcode/qrlib.php';
if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
}

if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = "dashboard";
}

function rupiah($angka)
{

    $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include 'layouts/head.php';
    ?>

<body id="page-top">
    <?php if (isset($_GET['msg'])) { ?>
        <div aria-live="polite" aria-atomic="true" class="position-relative" data-autohide="false">
            <!-- Position it: -->
            <!-- - `.toast-container` for spacing between toasts -->
            <!-- - `.position-absolute`, `top-0` & `end-0` to position the toasts in the upper right corner -->
            <!-- - `.p-3` to prevent the toasts from sticking to the edge of the container  -->
            <div class="toast-container position-absolute top-0 end-0 p-3" style="z-index: 10;">

                <!-- Then put toasts within -->
                <div id="toast-delayer" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000" data-bs-delay="5000">
                    <div class="toast-header">
                        <strong class="me-auto">Bootstrap</strong>
                        <small class="text-muted">just now</small>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        <?= ($_GET['msg']); ?>
                    </div>
                </div>

            </div>
        </div>
    <?php } ?>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include 'layouts/sidebar.php' ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include 'layouts/navbar.php' ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h2 mb-0 text-dark text-capitalize font-weight-bold"><?php
                                                                                        if ($_SESSION['role'] != "admin") {
                                                                                            echo $page;
                                                                                        } else {
                                                                                            if ($page == "detail_karyawan") {
                                                                                                echo  "Detail Karyawan";
                                                                                            } else if ($page == "detail_absensi") {
                                                                                                echo  "Detail Absensi";
                                                                                            } else {
                                                                                                echo $page;
                                                                                            }
                                                                                        }

                                                                                        ?></h1>
                        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                    </div>

                    <!-- konten ditampilkan disini -->
                    <?php if ($page == 'profile') {
                        include "content/" . "all" . "/" . $page . ".php";
                    } else {
                        include "content/" . $_SESSION['role'] . "/" . $page . ".php";
                    } ?>
                    <!-- ini batas penutup konten -->

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Lembaga Bantuan Hukum Harapan</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin mau keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Tekan tombol "Logout" untuk keluar dari akunmu</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../function/funct_logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tambahdataabsensi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Absensi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="./content/admin/function/tambahabsensi.php" method="POST" enctype="multipart/form-data">
                        <?php
                        $usr = $_SESSION['username'];

                        $query = mysqli_query($koneksi, "SELECT kd_admin FROM admin WHERE username='$usr'");
                        while ($dt = mysqli_fetch_array($query)) {
                            $kd_admin = $dt['kd_admin'];
                        }
                        ?>
                        <div class="form-group">
                            <label for="tanggal" class="col-form-label">Tanggal:</label>
                            <input type="datetime-local" class="form-control" id="tanggal" name="tanggal" required>
                            <input type="text" class="form-control" id="kode" name="kode" value="<?= $kd_admin ?>" hidden>
                        </div>

                        <div class="form-group">
                            <label for="kegunaan" class="col-form-label">Kegunaan:</label>
                            <select id="kegunaan" class="form-control" name="kegunaan" required>
                                <option value="" selected>Pilih Kegunaan</option>
                                <option value="Absensi Masuk">Absensi Masuk</option>
                                <option value="Absensi Pulang">Absensi Pulang</option>
                            </select>
                        </div>

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" style="float: right;" class="btn btn-primary" onclick="">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tambahdatadetailkaryawan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Detail Karyawan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="./content/admin/function/tambahdetailkaryawan.php" method="POST">
                        <div class="form-group mb-3">
                            <label for="nip" class="col-form-label">Nama Karyawan:</label>
                            <select id="nip" class="form-control" name="nip" required>
                                <option value="" selected>Pilih Karyawan</option>
                                <?php
                                $query = mysqli_query($koneksi, "SELECT karyawan.* FROM karyawan 
                                LEFT JOIN detail_karyawan ON detail_karyawan.nip = karyawan.nip
                                WHERE detail_karyawan.nip IS NULL");
                                while ($wi = mysqli_fetch_array($query)) {
                                ?>
                                    <option value="<?php echo $wi['nip'] ?>"><?php echo $wi['nama_karyawan'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jabatan" class="col-form-label">Jabatan:</label>
                            <input type="text" class="form-control" id="jabatan" name="jabatan" required>
                        </div>
                        <div class="form-group">
                            <label for="gaji" class="col-form-label">Gaji:</label>
                            <input type="number" class="form-control" id="gaji" name="gaji" required>
                        </div>
                        <div class="form-group">
                            <label for="divisi" class="col-form-label">Divisi:</label>
                            <input type="text" class="form-control" id="divisi" name="divisi" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="tanggal_bergabung" class="col-form-label">Tanggal Bergabung:</label>
                            <input type="date" class="form-control" id="tanggal_bergabung" name="tanggal_bergabung" required>
                        </div>

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" style="float: right;" class="btn btn-primary" onclick="">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tambahdatakaryawan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Karyawan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="./content/admin/function/tambahkaryawan.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nama" class="col-form-label">Nama:</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="nip" class="col-form-label">NIP:</label>
                            <input type="text" class="form-control" id="nip" name="nip" required>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-form-label">Username:</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-form-label">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="jeniskelamin" class="col-form-label">Jenis Kelamin:</label>
                            <select id="jeniskelamin" class="form-control" name="jeniskelamin" required>
                                <option value="" selected>Pilih Jenis Kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="agama" class="col-form-label">Agama:</label>
                            <select id="agama" class="form-control" name="agama" required>
                                <option value="" selected>Pilih Agama</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Budha">Budha</option>
                                <option value="katolik">Katolik</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tempat_lahir" class="col-form-label">Tempat Lahir:</label>
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir" class="col-form-label">Tanggal Lahir:</label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                        </div>
                        <div class="form-group">
                            <label for="telepon" class="col-form-label">Telepon:</label>
                            <input type="number" class="form-control" id="telepon" name="telepon" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat" class="col-form-label">Alamat:</label>
                            <textarea class="form-control" id="alamat" name="alamat" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="foto" class="col-form-label">Foto:</label>
                            <input type="file" class="form-control" id="foto" name="foto" required>
                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" style="float: right;" class="btn btn-primary" onclick="">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="tambahdatapengumuman" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pengumuman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="./content/admin/function/tambahpengumuman.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="judul" class="col-form-label">Judul:</label>
                            <input type="text" class="form-control" id="judul" name="judul" required>
                        </div>

                        <div class="form-group">
                            <label for="tanggal" class="col-form-label">Tanggal:</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                        </div>
                        <div class="form-group">
                            <label for="keterangan" class="col-form-label">Keterangan:</label>
                            <textarea class="form-control" name="keterangan" id="keterangan" cols="30" rows="10"></textarea>
                        </div>

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" style="float: right;" class="btn btn-primary" onclick="">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include 'layouts/script.php' ?>
    <script>
        let scanner = new Instascan.Scanner({
            video: document.getElementById('preview')
        });
        Instascan.Camera.getCameras().then(function(cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                alert('No cameras found');
            }

        }).catch(function(e) {
            console.error(e);
        });

        scanner.addListener('scan', function(c) {
            document.getElementById('textqr').value = c;
            document.getElementById('formqr').submit();
        });
    </script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.4/js/dataTables.select.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#data-table').DataTable({
                select: false,
                search: {
                    caseInsensitive: false,
                    regex: true
                }
            });
        });
    </script>
    <script>
        var editor = CKEDITOR.replace('editor1', {
            extraPlugins: 'embed,autoembed,image2',
            height: 500,

            // Load the default contents.css file plus customizations for this sample.
            contentsCss: [
                'http://cdn.ckeditor.com/4.18.0/full-all/contents.css',
                'https://ckeditor.com/docs/ckeditor4/4.18.0/examples/assets/css/widgetstyles.css'
            ],
            // Setup content provider. See https://ckeditor.com/docs/ckeditor4/latest/features/media_embed
            embed_provider: '//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}',

            // Configure the Enhanced Image plugin to use classes instead of styles and to disable the
            // resizer (because image size is controlled by widget styles or the image takes maximum
            // 100% of the editor width).
            image2_alignClasses: ['image-align-left', 'image-align-center', 'image-align-right'],
            // image2_disableResizer: true,
            removeButtons: 'PasteFromWord'
        });
        CKFinder.setupCKEditor(editor);
        var editor1 = CKEDITOR.replace('editor2', {
            extraPlugins: 'embed,autoembed,image2',
            height: 200,

            // Load the default contents.css file plus customizations for this sample.
            contentsCss: [
                'http://cdn.ckeditor.com/4.18.0/full-all/contents.css',
                'https://ckeditor.com/docs/ckeditor4/4.18.0/examples/assets/css/widgetstyles.css'
            ],
            // Setup content provider. See https://ckeditor.com/docs/ckeditor4/latest/features/media_embed
            embed_provider: '//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}',

            // Configure the Enhanced Image plugin to use classes instead of styles and to disable the
            // resizer (because image size is controlled by widget styles or the image takes maximum
            // 100% of the editor width).
            image2_alignClasses: ['image-align-left', 'image-align-center', 'image-align-right'],
            // image2_disableResizer: true,
            removeButtons: 'PasteFromWord'
        });
        CKFinder.setupCKEditor(editor1);
    </script>
    <script>
        $('.toast').toast('show');
    </script>

</body>

</html>