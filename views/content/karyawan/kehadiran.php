<div class="container-fluid p-1">
    <div class="d-flex justify-content-between">
        <a href="./content/karyawan/function/downloaddatakehadiran.php?nip=<?php echo $nip_karyawan ?>" type="button" class="btn btn-primary mb-2 mr-2 "><i class="fas fa-fw fa-print mr-2"></i>Download Data Kehadiran</a>
    </div>

</div>
<div class="table-responsive border px-2 py-4">
    <table class="table table-bordered table-hover table-striped " id="data-table">
        <thead style="background-color: #4e73df;">
            <tr class="text-light">
                <th scope="col">No</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Kegunaan</th>
                <th scope="col">Waktu Absensi</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php

            $query = "SELECT detail_absensi.*,absensi.kegunaan,absensi.tanggal FROM detail_absensi 
            INNER JOIN karyawan ON karyawan.nip = detail_absensi.nip
            INNER JOIN absensi ON absensi.kd_absensi = detail_absensi.kd_absensi WHERE karyawan.nip='$nip_karyawan'
            ORDER BY absensi.tanggal DESC";

            $data_siswa = mysqli_query($koneksi, $query);
            $nomor = 1;
            while ($d = mysqli_fetch_array($data_siswa)) {
            ?>
                <tr>
                    <td><?php echo $nomor++; ?></td>
                    <td><?php echo date_format(date_create($d['tanggal']), "d-m-Y"); ?></td>
                    <td><?= $d['kegunaan'] ?></td>
                    <td><?php
                        if (!isset($d['waktu'])) {
                            echo NULL;
                        } else {
                            echo date_format(date_create($d['waktu']), "d-m-Y H:i");
                        }
                        ?></td>
                    <td><?php echo $d['status']; ?></td>

                </tr>
                <!-- Update Data Guru -->

            <?php
            }
            ?>
        </tbody>
    </table>

</div>