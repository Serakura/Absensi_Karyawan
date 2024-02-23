<div class="container-fluid p-0">
    <button type="button" class="btn btn-primary ml-5 mb-2" data-toggle="modal" style="float:right;" data-target="#tambahdatadetailkaryawan" data-whatever="detailkaryawan">Tambah Data Detail Karyawan</button>
</div>



<div class="table-responsive border px-2 py-4">
    <table class="table table-bordered table-hover table-striped " id="data-table">
        <thead style="background-color: #4e73df;">
            <tr class="text-light">
                <th scope="col">No</th>
                <th scope="col">NIP</th>
                <th scope="col">Nama</th>
                <th scope="col">Jabatan</th>
                <th scope="col">Divisi</th>
                <th scope="col">Gaji</th>
                <th scope="col">Tanggal Bergabung</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT detail_karyawan.*,karyawan.nama_karyawan FROM detail_karyawan INNER JOIN karyawan ON karyawan.nip = detail_karyawan.nip";
            $data_kelas = mysqli_query($koneksi, $query);
            $nomor = 1;
            while ($d = mysqli_fetch_array($data_kelas)) {
            ?>
                <tr>
                    <td><?php echo $nomor++; ?></td>
                    <td><?php echo $d['nip']; ?></td>
                    <td><?php echo $d['nama_karyawan']; ?></td>
                    <td><?php echo $d['jabatan']; ?></td>
                    <td><?php echo $d['divisi']; ?></td>
                    <td><?php echo rupiah($d['gaji']); ?></td>
                    <td><?php echo date_format(date_create($d['tanggal_bergabung']), "d-m-Y"); ?></td>
                    <td>
                        <!-- ?page=hapusMobil&nopol_mobil= echo $data['nopol_mobil']; ?> -->
                        <a data-toggle="modal" data-target="#updatedatadetailkaryawan<?php echo $d['nip']; ?>" class="link"><img name="pencil" src="../assets/edit.png"></a>
                        <a href="./content/admin/function/hapusdetailkaryawan.php?kd_detailkaryawan=<?php echo $d['kd_detailkaryawan'] ?>" class="link"><img name="delete" src="../assets/delete.png" onclick="return confirm('Yakin Akan di Hapus ?')"></a>
                    </td>
                </tr>
                <!-- Update Data Guru -->
                <div class="modal fade" id="updatedatadetailkaryawan<?php echo $d['nip'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Update Data Detail Karyawan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php
                            $nip = $d['nip'];
                            $query = mysqli_query($koneksi, "SELECT * FROM detail_karyawan WHERE nip='$nip'");
                            while ($row = mysqli_fetch_array($query)) {
                            ?>
                                <div class="modal-body">
                                    <form action="./content/admin/function/updatedetailkaryawan.php" method="POST">
                                        <div class="form-group">
                                            <label for="jabatan" class="col-form-label">Nama Karyawan:</label>
                                            <input type="text" class="form-control" id="kode" name="kode" value="<?= $row['kd_detailkaryawan'] ?>" hidden>
                                            <input type="text" class="form-control" id="nama" name="nama" value="<?= $d['nama_karyawan'] ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="jabatan" class="col-form-label">Jabatan:</label>
                                            <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?= $row['jabatan'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="gaji" class="col-form-label">Gaji:</label>
                                            <input type="number" class="form-control" id="gaji" name="gaji" value="<?= $row['gaji'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="divisi" class="col-form-label">Divisi:</label>
                                            <input type="text" class="form-control" id="divisi" name="divisi" value="<?= $row['divisi'] ?>" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="tanggal_bergabung" class="col-form-label">Tanggal Bergabung:</label>
                                            <input type="date" class="form-control" id="tanggal_bergabung" name="tanggal_bergabung" value="<?= $row['tanggal_bergabung'] ?>" required>
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