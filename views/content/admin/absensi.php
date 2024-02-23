<div class="container-fluid p-0">
    <button type="button" class="btn btn-primary ml-5 mb-2" data-toggle="modal" style="float:right;" data-target="#tambahdataabsensi" data-whatever="absensi">Tambah Data Absensi</button>
</div>

<div class="table-responsive border px-2 py-4">
    <table class="table table-bordered table-hover table-striped " id="data-table">
        <thead style="background-color: #4e73df;">
            <tr class="text-light">
                <th scope="col">No</th>
                <th scope="col">Pembuat</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Kegunaan</th>
                <th scope="col">Barcode</th>
                <th scope="col">Detail Absensi</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT absensi.*, admin.nama_admin FROM absensi 
            INNER JOIN admin ON admin.kd_admin = absensi.kd_admin ORDER BY absensi.tanggal ASC";
            $data = mysqli_query($koneksi, $query);
            $nomor = 1;
            while ($d = mysqli_fetch_array($data)) {
            ?>
                <tr>
                    <td><?php echo $nomor++; ?></td>
                    <td><?php echo $d['nama_admin']; ?></td>
                    <td><?php echo date_format(date_create($d['tanggal']), "d-m-Y H:i"); ?></td>
                    <td><?php echo $d['kegunaan']; ?></td>
                    <td><a data-toggle="modal" data-target="#barcode<?php echo $d['kd_absensi']; ?>" class="btn btn-primary">Show Barcode</a></td>
                    <td>
                        <a href="index.php?page=detail_absensi&kd_absensi=<?= $d['kd_absensi'] ?>" class="btn btn-primary">Lihat Detail</a>
                    </td>
                    <td>
                        <!-- ?page=hapusMobil&nopol_mobil= echo $data['nopol_mobil']; ?> -->

                        <a href="./content/admin/function/hapusabsensi.php?kd_absensi=<?php echo $d['kd_absensi'] ?>" class="link"><img name="delete" src="../assets/delete.png" onclick="return confirm('Yakin Akan di Hapus ?')"></a>
                    </td>
                </tr>


                <div class="modal fade" id="barcode<?php echo $d['kd_absensi'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">QR CODE ABSENSI</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body text-center">
                                <?php
                                $penyimpanan = "../upload_files/qrcode/";
                                QRcode::png($d['kd_absensi'], $penyimpanan . $d['kd_absensi'] . ".png", QR_ECLEVEL_H, 10, 5);

                                ?>
                                <img src="../upload_files/qrcode/<?= $d['kd_absensi'] ?>.png" alt="qrcode" class="img img-thumbnail text-center">
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>