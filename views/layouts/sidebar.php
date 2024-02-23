<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center py-5" href="index.php?page=dashboard ">
        <div class="sidebar-brand-icon">
            <i class="fas fa-fw fa-school"></i>
        </div>
        <div class="sidebar-brand-text mx-3">
            Sistem Absensi Karyawan
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <?php
    if ($_SESSION['role'] == "admin") {
    ?>
        <!-- Nav Item - Dashboard -->


        <li class=" nav-item">
            <a class="nav-link" href="index.php?page=dashboard">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
        <hr class="sidebar-divider my-0">

        <li class="nav-item">
            <a class="nav-link" href="index.php?page=karyawan">
                <i class="fas fa-fw fa-user"></i>
                <span>Karyawan</span></a>
        </li>

        <hr class="sidebar-divider my-0">

        <li class="nav-item">
            <a class="nav-link" href="index.php?page=detail_karyawan">
                <i class="fas fa-fw fa-eye"></i>
                <span>Detail Karyawan</span></a>
        </li>
        <hr class="sidebar-divider my-0">
        <li class="nav-item">
            <a class="nav-link" href="index.php?page=absensi">
                <i class="fas fa-fw fa-list"></i>
                <span>Absensi</span></a>
        </li>

        <hr class="sidebar-divider my-0">


        <li class="nav-item">
            <a class="nav-link" href="index.php?page=pengumuman">
                <i class="fas fa-fw fa-bell"></i>
                <span>Pengumuman</span></a>
        </li>

    <?php
    }
    ?>




    <?php
    if ($_SESSION['role'] == "karyawan") {
    ?>
        <li class="nav-item px-3 d-none d-md-block">
            <?php
            $username = $_SESSION['username'];
            $query = mysqli_query($koneksi, "SELECT nip,nama_karyawan,foto FROM karyawan WHERE username='$username'");
            while ($rw = mysqli_fetch_array($query)) {
                $nip_karyawan = $rw['nip'];
            ?>
                <img src="../upload_files/profile_pictures/<?php echo $rw['foto'] ?>" class="img-thumbnail profile" alt="">
                <br>
                <p class=" text-center h6 fw-bold text-capitalize mt-3" style="color: white;"><?php echo $rw['nama_karyawan'] ?></p>
                <p class=" text-center mt-1" style="color: white;"><?php echo $rw['nip'] ?></p>
            <?php

            } ?>
        </li>
        <hr class="sidebar-divider my-0">

        <li class="nav-item">
            <a class="nav-link" href="index.php?page=dashboard">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
        <hr class="sidebar-divider my-0">
        <li class="nav-item">
            <a class="nav-link" href="index.php?page=absensi">
                <i class="fas fa-fw fa-user"></i>
                <span>Absensi</span></a>
        </li>
        <hr class="sidebar-divider my-0">
        <li class="nav-item">
            <a class="nav-link" href="index.php?page=kehadiran">
                <i class="fas fa-fw fa-user"></i>
                <span>Kehadiran</span></a>
        </li>
        <hr class="sidebar-divider my-0">
        <li class="nav-item">
            <a class="nav-link" href="index.php?page=pengumuman">
                <i class="fas fa-fw fa-book"></i>
                <span>Pengumuman</span></a>
        </li>

    <?php
    }
    ?>




    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none ">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>