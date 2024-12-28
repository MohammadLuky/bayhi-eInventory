<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $title; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('adminatk'); ?>">Home</a></li>
                        <li class="breadcrumb-item active"><?= $title; ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-8">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $jumlah_unit; ?></h3>

                            <p>Data Unit</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <a href="<?= base_url('adminatk/unit'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-8">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $jumlah_atk; ?></h3>

                            <p>Data ATK</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-swatchbook"></i>
                        </div>
                        <a href="<?= base_url('adminatk/atk'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-8">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <?php if ($dataunit == null) : ?>
                                <h3>0<sup style="font-size: 20px">%</sup></h3>
                                <p>Persentase Penyerapan ATK</p>
                            <?php else : ?>
                                <h3><?= number_format($persentase_total); ?><sup style="font-size: 20px">%</sup></h3>
                                <p>Persentase Penyerapan ATK</p>
                                <div class="progress">
                                    <?php if ($persentase_total < 35) : ?>
                                        <div class="progress-bar bg-warning progress-bar-striped" role="progressbar" aria-valuenow="<?= $persentase_total; ?>" aria-valuemin="0" aria-valuemax="100" style="width: 30%">
                                        </div>
                                    <?php elseif ($persentase_total <= 35 && $persentase_total <= 70) : ?>
                                        <div class="progress-bar bg-info progress-bar-striped" role="progressbar" aria-valuenow="<?= $persentase_total; ?>" aria-valuemin="0" aria-valuemax="100" style="width: 30%">
                                        </div>
                                    <?php elseif ($persentase_total <= 71) : ?>
                                        <div class="progress-bar bg-success progress-bar-striped" role="progressbar" aria-valuenow="<?= $persentase_total; ?>" aria-valuemin="0" aria-valuemax="100" style="width: 30%">
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="icon">
                            <i class="fas fa-money-check-alt"></i>
                        </div>
                        <a href="<?= base_url('adminatk/penyerapan_atk'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-widget widget-user">
                        <div class="widget-user-header text-white" style="background: url('<?= base_url('assets') ?>/images/auth/bg-bayhi2.jpg') center center;">
                            <h3><b>Selamat Datang!!</b></h3>
                            <h3 class="widget-user-username text-left"><?= $peran['nama']; ?></h3>
                            <h5 class="widget-user-desc text-left"><?= $peran['ket_peran']; ?> | <?= $peran['jabatan_pengguna']; ?></h5>
                        </div>
                        <div class="widget-user-image">
                            <img class="img-circle" src="<?= base_url('assets/images/user/') . $peran['img'] ?>" alt="User Avatar">
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="callout callout-info">
                                        <h5>E-Inventory</h5>

                                        <p>Sistem informasi terkait pendataan aset dan barang habis pakai yaitu ATK (Alat Tulis Kantor).</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>