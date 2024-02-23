<div class="container-fluid p-1">
    <div class="d-flex justify-content-between">
        <a href="./index.php?page=absensi" class="btn btn-primary"><i class="fas fa-arrow-left mr-2 mb-2"></i>Kembali</a>
        <a href="./content/admin/function/downloaddatadetailabsensi.php?kd_absensi=<?php echo $_GET['kd_absensi'] ?>" type="button" class="btn btn-primary mb-2 mr-2 "><i class="fas fa-fw fa-print mr-2"></i>Download Data Detail Absensi</a>
    </div>

</div>
<div class="table-responsive border px-2 py-4">
    <table class="table table-bordered table-hover table-striped " id="data-table">
        <thead style="background-color: #4e73df;">
            <tr class="text-light">
                <th scope="col">No</th>
                <th scope="col">Nama Karyawan</th>
                <th scope="col">Waktu Absensi</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $kd_absensi = $_GET['kd_absensi'];
            $query = "SELECT detail_absensi.*,karyawan.nama_karyawan FROM detail_absensi 
            INNER JOIN karyawan ON karyawan.nip = detail_absensi.nip WHERE kd_absensi='$kd_absensi'";

            $data_siswa = mysqli_query($koneksi, $query);
            $nomor = 1;
            while ($d = mysqli_fetch_array($data_siswa)) {
            ?>
                <tr>
                    <td><?php echo $nomor++; ?></td>
                    <td><?php echo $d['nama_karyawan']; ?></td>
                    <td><?php
                        if (!isset($d['waktu'])) {
                            echo NULL;
                        } else {
                            echo date_format(date_create($d['waktu']), "d-m-Y h:i");
                        }
                        ?></td>
                    <td><?php echo $d['status']; ?></td>
                    <td>
                        <!-- ?page=hapusMobil&nopol_mobil= echo $data['nopol_mobil']; ?> -->
                        <a data-toggle="modal" data-target="#updatedatadetailabsensi<?php echo $d['kd_detailabsensi']; ?>" class="link"><img name="pencil" src="../assets/edit.png"></a>

                    </td>
                </tr>
                <!-- Update Data Guru -->
                <div class="modal fade" id="updatedatadetailabsensi<?php echo $d['kd_detailabsensi'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Update Data Detail Absensi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php
                            $kd = $d['kd_detailabsensi'];
                            $query = mysqli_query($koneksi, "SELECT detail_absensi.*,absensi.tanggal FROM detail_absensi
                            INNER JOIN absensi ON absensi.kd_absensi = detail_absensi.kd_absensi WHERE kd_detailabsensi='$kd'");
                            while ($row = mysqli_fetch_array($query)) {
                            ?>
                                <div class="modal-body">
                                    <form action="./content/admin/function/updatedetailabsensi.php" method="POST">
                                        <div class="form-group">
                                            <label for="nip" class="col-form-label">Nama Karyawan:</label>
                                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $d['nama_karyawan']; ?>" disabled>
                                            <input type="hidden" class="form-control" id="kd_detailabsensi" name="kd_detailabsensi" value="<?php echo $row['kd_detailabsensi']; ?>">
                                            <input type="hidden" class="form-control" id="kd_absensi" name="kd_absensi" value="<?php echo $row['kd_absensi']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="nip" class="col-form-label">Absensi Tanggal:</label>
                                            <input type="date" class="form-control" id="nama" name="nama" value="<?php echo $row['tanggal']; ?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="nip" class="col-form-label">Waktu Absen:</label>
                                            <input type="datetime-local" class="form-control" id="waktu" name="waktu" value="<?php echo $row['waktu']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="status" class="col-form-label">Status:</label>
                                            <select id="status" class="form-control" name="status" value="<?php echo $row['status']; ?>" required>
                                                <option value="">Pilih Status Absensi</option>
                                                <option value="Ada" <?php if ($row['status'] == "Ada") {
                                                                        echo 'selected';
                                                                    } ?>>Ada</option>
                                                <option value="Alpha" <?php if ($row['status'] == "Alpha") {
                                                                            echo 'selected';
                                                                        } ?>>Alpha</option>
                                                <option value="Sakit" <?php if ($row['status'] == "Sakit") {
                                                                            echo 'selected';
                                                                        } ?>>Sakit</option>
                                                <option value="Izin" <?php if ($row['status'] == "Izin") {
                                                                            echo 'selected';
                                                                        } ?>>Izin</option>
                                                <option value="Tidak ABsen" <?php if ($row['status'] == "Tidak Absen") {
                                                                                echo 'selected';
                                                                            } ?>>Tidak Absen</option>

                                            </select>
                                        </div>

                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        <button type="submit" style="float: right;" class="btn btn-primary" onclick="">Kirim</button>
                                    </form>
                                <?php
                            }
                                ?>
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