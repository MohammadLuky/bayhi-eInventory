<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <!-- <div class="navbar-custom-menu"> -->
    <!-- <ul class="nav navbar-nav ml-auto"> -->
    <ul class="navbar-nav ml-auto">

        <li class="nav-item">
            <div class="nav-link">
                <?php if ($this->session->userdata('peran_id') == 1) : ?>
                    <a class="btn btn-block bg-gradient-olive btn-sm" href="<?= base_url('admin/profil_pengguna'); ?>">
                        <i class="far fa-user-circle"></i>
                        <span>Setting Akun</span>
                    </a>
                <?php elseif ($this->session->userdata('peran_id') == 2) : ?>
                    <a class="btn btn-block bg-gradient-olive btn-sm" href="<?= base_url('adminaset/profil_pengguna'); ?>">
                        <i class="far fa-user-circle"></i>
                        <span>Setting Akun</span>
                    </a>
                <?php elseif ($this->session->userdata('peran_id') == 3) : ?>
                    <a class="btn btn-block bg-gradient-olive btn-sm" href="<?= base_url('adminatk/profil_pengguna'); ?>">
                        <i class="far fa-user-circle"></i>
                        <span>Setting Akun</span>
                    </a>
                <?php elseif ($this->session->userdata('peran_id') == 4) : ?>
                    <a class="btn btn-block bg-gradient-olive btn-sm" href="<?= base_url('unit/profil_pengguna'); ?>">
                        <i class="far fa-user-circle"></i>
                        <span>Setting Akun</span>
                    </a>
                <?php elseif ($this->session->userdata('peran_id') == 5) : ?>
                    <a class="btn btn-block bg-gradient-olive btn-sm" href="<?= base_url('subunit/profil_pengguna'); ?>">
                        <i class="far fa-user-circle"></i>
                        <span>Setting Akun</span>
                    </a>
                <?php endif; ?>
            </div>
        </li>
        <li class="nav-item">
            <div class="nav-link">
                <a class="btn bg-gradient-danger btn-block btn-sm" href="<?= base_url('auth/logout'); ?>">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Keluar</span>
                </a>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

<!-- <aside class="main-sidebar sidebar-dark-primary elevation-4"> -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <?php if ($this->session->userdata('peran_id') == 1) : ?>
        <a href="<?= base_url('admin'); ?>" class="brand-link">
            <img src="<?= base_url('assets/') ?>admin2/images/aset_atk.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Inventory Bayhi</span>
        </a>
    <?php elseif ($this->session->userdata('peran_id') == 2) : ?>
        <a href="<?= base_url('adminaset'); ?>" class="brand-link">
            <img src="<?= base_url('assets/') ?>admin2/images/aset_atk.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Inventory Bayhi</span>
        </a>
    <?php elseif ($this->session->userdata('peran_id') == 3) : ?>
        <a href="<?= base_url('adminatk'); ?>" class="brand-link">
            <img src="<?= base_url('assets/') ?>admin2/images/aset_atk.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Inventory Bayhi</span>
        </a>
    <?php elseif ($this->session->userdata('peran_id') == 4) : ?>
        <a href="<?= base_url('unit'); ?>" class="brand-link">
            <img src="<?= base_url('assets/') ?>admin2/images/aset_atk.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Inventory Bayhi</span>
        </a>
    <?php elseif ($this->session->userdata('peran_id') == 5) : ?>
        <a href="<?= base_url('subunit'); ?>" class="brand-link">
            <img src="<?= base_url('assets/') ?>admin2/images/aset_atk.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Inventory Bayhi</span>
        </a>
    <?php endif; ?>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url('assets/images/user/') . $peran['img'] ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="" class="d-block"><?= perpendekNama($peran['nama']); ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <?php if ($this->session->userdata('peran_id') == 1) : ?>
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="<?= base_url('admin'); ?>" class="nav-link <?= current_url() == base_url('admin') ? "active" : '' ?>">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">Master Data</li>
                    <li class="nav-item">
                        <a href="<?= base_url('admin/manajemen_pengguna'); ?>" class="nav-link <?= current_url() == base_url('admin/manajemen_pengguna') ? "active" : '' ?>">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Manajemen Pengguna
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('admin/TahunPeriode'); ?>" class="nav-link <?= current_url() == base_url('admin/TahunPeriode') ? "active" : '' ?>">
                            <i class="nav-icon fas fa-layer-group"></i>
                            <p>
                                Data Tahun Periode
                            </p>
                        </a>
                    </li>
                    <li class="nav-item <?= current_url() == base_url('admin/unit') || current_url() == base_url('admin/sub_unit') || current_url() == base_url('admin/gedung') || current_url() == base_url('admin/ruang') ? "menu-open" : '' ?>">
                        <a href="#" class="nav-link <?= current_url() == base_url('admin/unit') || current_url() == base_url('admin/sub_unit') || current_url() == base_url('admin/gedung') || current_url() == base_url('admin/ruang') ? "active" : '' ?>">
                            <i class="nav-icon fas fa-folder"></i>
                            <p>
                                Data Yayasan
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('admin/gedung'); ?>" class="nav-link <?= current_url() == base_url('admin/gedung') ? "active" : '' ?>">
                                    <i class="far fa-building nav-icon"></i>
                                    <p>Gedung</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('admin/ruang'); ?>" class="nav-link <?= current_url() == base_url('admin/ruang') ? "active" : '' ?>">
                                    <i class="fas fa-warehouse nav-icon"></i>
                                    <p>Ruangan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('admin/unit'); ?>" class="nav-link <?= current_url() == base_url('admin/unit') ? "active" : '' ?>">
                                    <i class="fas fa-landmark nav-icon"></i>
                                    <p>Unit</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('admin/sub_unit'); ?>" class="nav-link <?= current_url() == base_url('admin/sub_unit') ? "active" : '' ?>">
                                    <i class="fas fa-archway nav-icon"></i>
                                    <p>Sub Unit</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item <?= current_url() == base_url('admin/kelompok_aset') || current_url() == base_url('admin/jenis_aset') ? "menu-open" : '' ?>">
                        <a href="#" class="nav-link <?= current_url() == base_url('admin/kelompok_aset') || current_url() == base_url('admin/jenis_aset') ? "active" : '' ?>">
                            <i class="nav-icon fas fa-folder"></i>
                            <p>
                                Data Aset
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('admin/kelompok_aset'); ?>" class="nav-link <?= current_url() == base_url('admin/kelompok_aset') ? "active" : '' ?>">
                                    <i class="fas fa-project-diagram nav-icon"></i>
                                    <p>Kelompok Aset</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('admin/jenis_aset'); ?>" class="nav-link <?= current_url() == base_url('admin/jenis_aset') ? "active" : '' ?>">
                                    <i class="fas fa-boxes nav-icon"></i>
                                    <p>Jenis Aset</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('admin/atk'); ?>" class="nav-link <?= current_url() == base_url('admin/atk') ? "active" : '' ?>">
                            <i class=" nav-icon fas fa-briefcase"></i>
                            <p>
                                Data ATK
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">Input Data</li>
                    <li class="nav-item">
                        <a href="<?= base_url('admin/input_aset'); ?>" class="nav-link <?= current_url() == base_url('admin/input_aset') ? "active" : '' ?>">
                            <i class="fas fa-pen nav-icon"></i>
                            <p>
                                Input Data Aset
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('admin/mutasi_aset'); ?>" class="nav-link <?= current_url() == base_url('admin/mutasi_aset') ? "active" : '' ?>">
                            <i class="fas fa-pen nav-icon"></i>
                            <p>
                                Input Mutasi Aset
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('admin/PengajuanATK'); ?>" class="nav-link <?= current_url() == base_url('admin/PengajuanATK') ? "active" : '' ?>">
                            <i class="fas fa-truck-loading nav-icon"></i>
                            <p>
                                Pengajuan ATK
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('admin/PengambilanATK'); ?>" class="nav-link <?= current_url() == base_url('admin/PengambilanATK') ? "active" : '' ?>">
                            <i class="fas fa-truck-loading nav-icon"></i>
                            <p>
                                Pengambilan ATK
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('admin/kondisi_aset'); ?>" class="nav-link <?= current_url() == base_url('admin/kondisi_aset') ? "active" : '' ?>">
                            <i class="far fa-calendar-check nav-icon"></i>
                            <p>
                                Pengecekan Aset
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">Data Validasi / Approval</li>
                    <li class="nav-item">
                        <a href="<?= base_url('admin/DataValidasiPengajuanATK'); ?>" class="nav-link <?= current_url() == base_url('admin/DataValidasiPengajuanATK') ? "active" : '' ?>">
                            <i class="fas fa-clipboard-list nav-icon"></i>
                            <p>
                                Validasi Pengajuan ATK
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('admin/DataValidasiPengambilanATK'); ?>" class="nav-link <?= current_url() == base_url('admin/DataValidasiPengambilanATK') ? "active" : '' ?>">
                            <i class="fas fa-clipboard-list nav-icon"></i>
                            <p>
                                Validasi Pengambilan ATK
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">Rekapitulasi / Laporan Data</li>
                    <li class="nav-item">
                        <a href="<?= base_url('admin/rekap_aset'); ?>" class="nav-link <?= current_url() == base_url('admin/rekap_aset') ? "active" : '' ?>">
                            <i class="fas fa-clipboard-list nav-icon"></i>
                            <p>
                                Rekap Data Aset
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('admin/AsetNonAktif'); ?>" class="nav-link <?= current_url() == base_url('admin/AsetNonAktif') ? "active" : '' ?>">
                            <i class="fas fa-clipboard-list nav-icon"></i>
                            <p>
                                Rekap Aset NonAktif
                            </p>
                        </a>
                    </li>
                    <!-- <li class="nav-item">
                        <a href="<?= base_url('admin/DataAsetRusak'); ?>" class="nav-link <?= current_url() == base_url('admin/DataAsetRusak') ? "active" : '' ?>">
                            <i class="fas fa-clipboard-list nav-icon"></i>
                            <p>
                                Rekap Aset Rusak
                            </p>
                        </a>
                    </li> -->
                    <li class="nav-item">
                        <a href="<?= base_url('admin/rekap_kondisi'); ?>" class="nav-link <?= current_url() == base_url('admin/rekap_kondisi') ? "active" : '' ?>">
                            <i class="fas fa-clipboard-list nav-icon"></i>
                            <p>
                                Rekap Pengecekan Aset
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('admin/penyerapan_atk'); ?>" class="nav-link <?= current_url() == base_url('admin/penyerapan_atk') ? "active" : '' ?>">
                            <i class="fas fa-clipboard-list nav-icon"></i>
                            <p>
                                Penyerapan ATK
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
        <?php endif; ?>

        <?php if ($this->session->userdata('peran_id') == 2) : ?>
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="<?= base_url('adminaset'); ?>" class="nav-link <?= current_url() == base_url('adminaset') ? "active" : '' ?>">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">Master Data</li>
                    <li class="nav-item <?= current_url() == base_url('adminaset/unit') || current_url() == base_url('adminaset/sub_unit') || current_url() == base_url('adminaset/gedung') || current_url() == base_url('adminaset/ruang') ? "menu-open" : '' ?>">
                        <a href="#" class="nav-link <?= current_url() == base_url('adminaset/unit') || current_url() == base_url('adminaset/sub_unit') || current_url() == base_url('adminaset/gedung') || current_url() == base_url('adminaset/ruang') ? "active" : '' ?>">
                            <i class="nav-icon fas fa-folder"></i>
                            <p>
                                Data Yayasan
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('adminaset/gedung'); ?>" class="nav-link <?= current_url() == base_url('adminaset/gedung') ? "active" : '' ?>">
                                    <i class="far fa-building nav-icon"></i>
                                    <p>Gedung</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('adminaset/ruang'); ?>" class="nav-link <?= current_url() == base_url('adminaset/ruang') ? "active" : '' ?>">
                                    <i class="fas fa-warehouse nav-icon"></i>
                                    <p>Ruangan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('adminaset/unit'); ?>" class="nav-link <?= current_url() == base_url('adminaset/unit') ? "active" : '' ?>">
                                    <i class="fas fa-landmark nav-icon"></i>
                                    <p>Unit</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('adminaset/sub_unit'); ?>" class="nav-link <?= current_url() == base_url('adminaset/sub_unit') ? "active" : '' ?>">
                                    <i class="fas fa-archway nav-icon"></i>
                                    <p>Sub Unit</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item <?= current_url() == base_url('adminaset/kelompok_aset') || current_url() == base_url('adminaset/jenis_aset') ? "menu-open" : '' ?>">
                        <a href="#" class="nav-link <?= current_url() == base_url('adminaset/kelompok_aset') || current_url() == base_url('adminaset/jenis_aset') ? "active" : '' ?>">
                            <i class="nav-icon fas fa-folder"></i>
                            <p>
                                Data Aset
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('adminaset/kelompok_aset'); ?>" class="nav-link <?= current_url() == base_url('adminaset/kelompok_aset') ? "active" : '' ?>">
                                    <i class="fas fa-project-diagram nav-icon"></i>
                                    <p>Kelompok Aset</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('adminaset/jenis_aset'); ?>" class="nav-link <?= current_url() == base_url('adminaset/jenis_aset') ? "active" : '' ?>">
                                    <i class="fas fa-boxes nav-icon"></i>
                                    <p>Jenis Aset</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-header">Input Data</li>
                    <li class="nav-item">
                        <a href="<?= base_url('adminaset/input_aset'); ?>" class="nav-link <?= current_url() == base_url('adminaset/input_aset') ? "active" : '' ?>">
                            <i class="fas fa-pen nav-icon"></i>
                            <p>
                                Input Data Aset
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('adminaset/mutasi_aset'); ?>" class="nav-link <?= current_url() == base_url('adminaset/mutasi_aset') ? "active" : '' ?>">
                            <i class="fas fa-pen nav-icon"></i>
                            <p>
                                Input Mutasi Aset
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('adminaset/kondisi_aset'); ?>" class="nav-link <?= current_url() == base_url('adminaset/kondisi_aset') ? "active" : '' ?>">
                            <i class="far fa-calendar-check nav-icon"></i>
                            <p>
                                Pengecekan Aset
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">Rekapitulasi Data</li>
                    <li class="nav-item">
                        <a href="<?= base_url('adminaset/rekap_aset'); ?>" class="nav-link <?= current_url() == base_url('adminaset/rekap_aset') ? "active" : '' ?>">
                            <i class="fas fa-clipboard-list nav-icon"></i>
                            <p>
                                Rekap Data Aset
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('adminaset/AsetNonAktif'); ?>" class="nav-link <?= current_url() == base_url('adminaset/AsetNonAktif') ? "active" : '' ?>">
                            <i class="fas fa-clipboard-list nav-icon"></i>
                            <p>
                                Rekap Aset Non Aktif
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('adminaset/rekap_kondisi'); ?>" class="nav-link <?= current_url() == base_url('adminaset/rekap_kondisi') ? "active" : '' ?>">
                            <i class="fas fa-clipboard-list nav-icon"></i>
                            <p>
                                Rekap Pengecekan Aset
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
        <?php endif; ?>

        <?php if ($this->session->userdata('peran_id') == 3) : ?>
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="<?= base_url('adminatk'); ?>" class="nav-link <?= current_url() == base_url('adminatk') ? "active" : '' ?>">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">Master Data</li>
                    <li class="nav-item">
                        <a href="<?= base_url('adminatk/TahunPeriode'); ?>" class="nav-link <?= current_url() == base_url('adminatk/TahunPeriode') ? "active" : '' ?>">
                            <i class="nav-icon fas fa-layer-group"></i>
                            <p>
                                Data Tahun Periode
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('adminatk/unit'); ?>" class="nav-link <?= current_url() == base_url('adminatk/unit') ? "active" : '' ?>">
                            <i class="fas fa-landmark nav-icon"></i>
                            <p>
                                Data Unit
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('adminatk/atk'); ?>" class="nav-link <?= current_url() == base_url('adminatk/atk') ? "active" : '' ?>">
                            <i class=" nav-icon fas fa-briefcase"></i>
                            <p>
                                Data ATK
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">Data Validasi / Approval</li>
                    <li class="nav-item">
                        <a href="<?= base_url('adminatk/DataValidasiPengajuanATK'); ?>" class="nav-link <?= current_url() == base_url('adminatk/DataValidasiPengajuanATK') ? "active" : '' ?>">
                            <i class="fas fa-clipboard-list nav-icon"></i>
                            <p>
                                Validasi Pengajuan ATK
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('adminatk/DataValidasiPengambilanATK'); ?>" class="nav-link <?= current_url() == base_url('adminatk/DataValidasiPengambilanATK') ? "active" : '' ?>">
                            <i class="fas fa-clipboard-list nav-icon"></i>
                            <p>
                                Validasi Pengambilan ATK
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">Rekapitulasi / Laporan Data</li>
                    <li class="nav-item">
                        <a href="<?= base_url('adminatk/penyerapan_atk'); ?>" class="nav-link <?= current_url() == base_url('adminatk/penyerapan_atk') ? "active" : '' ?>">
                            <i class="fas fa-clipboard-list nav-icon"></i>
                            <p>
                                Penyerapan ATK
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
        <?php endif; ?>

        <?php if ($this->session->userdata('peran_id') == 4) : ?>
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="<?= base_url('unit'); ?>" class="nav-link <?= current_url() == base_url('unit') ? "active" : '' ?>">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <?php if ($GETunit != null) : ?>
                        <li class="nav-header">Data Aset</li>
                        <li class="nav-item">
                            <a href="<?= base_url('unit/rekap_aset'); ?>" class="nav-link <?= current_url() == base_url('unit/rekap_aset') ? "active" : '' ?>">
                                <i class="fas fa-clipboard-list nav-icon"></i>
                                <p>
                                    Rekap Data Aset
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('unit/rekap_kondisi'); ?>" class="nav-link <?= current_url() == base_url('unit/rekap_kondisi') ? "active" : '' ?>">
                                <i class="fas fa-clipboard-list nav-icon"></i>
                                <p>
                                    Rekap Kondisi Aset
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('unit/AsetNonAktif'); ?>" class="nav-link <?= current_url() == base_url('unit/AsetNonAktif') ? "active" : '' ?>">
                                <i class="fas fa-clipboard-list nav-icon"></i>
                                <p>
                                    Rekap Aset Non Aktif
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">Data ATK</li>
                        <li class="nav-item">
                            <a href="<?= base_url('unit/PengajuanATK'); ?>" class="nav-link <?= current_url() == base_url('unit/PengajuanATK') ? "active" : '' ?>">
                                <i class="fas fa-clipboard-list nav-icon"></i>
                                <p>
                                    Data Pengajuan ATK
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('unit/PengambilanATK'); ?>" class="nav-link <?= current_url() == base_url('unit/PengambilanATK') ? "active" : '' ?>">
                                <i class="fas fa-clipboard-list nav-icon"></i>
                                <p>
                                    Data Pengambilan ATK
                                </p>
                            </a>
                        </li>
                    <?php else : ?>
                        <li class="nav-header">Unit Belum Dipilih.</li>
                    <?php endif; ?>
                </ul>
            </nav>
        <?php endif; ?>

        <?php if ($this->session->userdata('peran_id') == 5) : ?>
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="<?= base_url('subunit'); ?>" class="nav-link <?= current_url() == base_url('subunit') ? "active" : '' ?>">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <?php if ($GETsub_unit != null) : ?>
                        <li class="nav-header">Input Data Aset</li>
                        <li class="nav-item">
                            <a href="<?= base_url('subunit/input_aset'); ?>" class="nav-link <?= current_url() == base_url('subunit/input_aset') ? "active" : '' ?>">
                                <i class="fas fa-pen nav-icon"></i>
                                <p>
                                    Input Data Aset
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('subunit/mutasi_aset'); ?>" class="nav-link <?= current_url() == base_url('subunit/mutasi_aset') ? "active" : '' ?>">
                                <i class="fas fa-pen nav-icon"></i>
                                <p>
                                    Input Mutasi Aset
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('subunit/kondisi_aset'); ?>" class="nav-link <?= current_url() == base_url('subunit/kondisi_aset') ? "active" : '' ?>">
                                <i class="far fa-calendar-check nav-icon"></i>
                                <p>
                                    Pengecekan Aset
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">Input Data ATK</li>
                        <li class="nav-item">
                            <a href="<?= base_url('subunit/PengajuanATK'); ?>" class="nav-link <?= current_url() == base_url('subunit/PengajuanATK') ? "active" : '' ?>">
                                <i class="fas fa-truck-loading nav-icon"></i>
                                <p>
                                    Input Pengajuan ATK
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('subunit/detail_pengajuanATKUnit'); ?>" class="nav-link <?= current_url() == base_url('subunit/detail_pengajuanATKUnit') ? "active" : '' ?>">
                                <i class="fas fa-truck-loading nav-icon"></i>
                                <p>
                                    Pengajuan ATK
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('subunit/input_pengambilanATK'); ?>" class="nav-link <?= current_url() == base_url('subunit/input_pengambilanATK') ? "active" : '' ?>">
                                <i class="fas fa-truck-loading nav-icon"></i>
                                <p>
                                    Pengambilan ATK
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">Rekapitulasi Data</li>
                        <li class="nav-item">
                            <a href="<?= base_url('subunit/AsetNonAktif'); ?>" class="nav-link <?= current_url() == base_url('subunit/AsetNonAktif') ? "active" : '' ?>">
                                <i class="fas fa-clipboard-list nav-icon"></i>
                                <p>
                                    Rekap Aset Non Aktif
                                </p>
                            </a>
                        </li>
                    <?php else : ?>
                        <li class="nav-header">Sub Unit Belum Dipilih.</li>
                    <?php endif; ?>
                </ul>
            </nav>
        <?php endif; ?>

    </div>
</aside>