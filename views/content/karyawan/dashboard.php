<?php
include './content/admin/function/tampildashboard.php';
?>
<div class="row">
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            <h6>Jumlah Karyawan</h6>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
                                                                            if ($karyawan) {
                                                                                $sis = mysqli_num_rows($karyawan);
                                                                                if ($sis) {
                                                                                    echo $sis;
                                                                                }
                                                                            } else {
                                                                                echo 'gagal';
                                                                            }
                                                                            ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            <h6>Jumlah Pengumuman</h6>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
                                                                            if ($pengumuman) {
                                                                                $sis = mysqli_num_rows($pengumuman);
                                                                                if ($sis) {
                                                                                    echo $sis;
                                                                                }
                                                                            } else {
                                                                                echo 'gagal';
                                                                            }
                                                                            ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            <h6>Tanggal</h6>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
                                                                            echo $tanggal;
                                                                            ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-xl-7 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h5 class="m-0 font-weight-bold text-primary">Pengumuman</h5>

            </div>
            <!-- Card Body -->
            <div class="card-body">
                <?php
                $query = mysqli_query($koneksi, "SELECT * FROM pengumuman ORDER BY tanggal");
                while ($d = mysqli_fetch_array($query)) {
                ?>
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <h4 class="card-title"><?php echo $d['judul'] ?></h4>
                                    <p class="card-text"><?php echo substr($d['keterangan'], 0, 150) . "...." ?></p>
                                    <p class="card-text"><small class="text-muted"><?php echo date_format(date_create($d['tanggal']), "d-m-Y") ?></small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="col-xl-5 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h5 class="m-0 font-weight-bold text-primary">Visi & Misi Perusahaan</h5>

            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="container text-center px-5 py-2">
                    <h4 class="text text-center font-weight-bold text-primary mt-2">Visi</h4>
                    <p class="h5 text-start">“Menentukan arah trans politik, ekonomi, sosial, budaya, dan transformasi politik yang berkeadilan gender dengan berbasis gerakan rakyat, serta menjamin dan melindungi rakyat dalam memenuhi hak-hak ekonomi, sosial dan budaya serta kebebasan dasar manusia.”</p>
                    <h4 class="text text-center font-weight-bold text-primary mt-3">Misi</h4>
                    <p class="h5 text-start">1) Mendorong transformasi politik yang berlandaskan gerakan rakyat yang berkeadilan gender.</p>
                    <p class="h5 text-start">2) Mempromosikan dan memperjuangkan terjaminnya hak-hak ekonomi, sosial. budaya yang mesti dilakukan.</p>
                    <p class="h5 text-start">3) Memperkuat penegakan dan perlindungan hak-hak sipil dan politik, untuk mendukung upaya mempromosikan dan memperjuangkan hak-hak sipil dan politik.</p>
                </div>

            </div>
        </div>
    </div>
</div>