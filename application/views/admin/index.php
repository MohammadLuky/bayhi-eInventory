<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $title; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
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
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $jumlah_gedung; ?></h3>

                            <p>Data Gedung</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <a href="<?= base_url('admin/gedung'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $jumlah_aset; ?></h3>

                            <p>Data Aset</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-boxes"></i>
                        </div>
                        <a href="<?= base_url('admin/rekap_aset'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?= $jumlah_atk; ?></h3>

                            <p>Data ATK</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-swatchbook"></i>
                        </div>
                        <a href="<?= base_url('admin/atk'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <?php if ($dataunit == null) : ?>
                                <h3>0<sup style="font-size: 20px">%</sup></h3>
                                <p>Persentase Penyerapan ATK</p>
                            <?php else : ?>
                                <h3><?= number_format($persentase_total); ?><sup style="font-size: 20px">%</sup></h3>
                                <p>Persentase Penyerapan ATK</p>
                                <div class="progress">
                                    <?php if ($persentase_total <= 14) : ?>
                                        <div class="progress-bar bg-warning progress-bar-striped" role="progressbar" aria-valuenow="<?= $persentase_total; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $persentase_total; ?>%">
                                        </div>
                                    <?php elseif ($persentase_total <= 15 && $persentase_total <= 34) : ?>
                                        <div class="progress-bar bg-navy progress-bar-striped" role="progressbar" aria-valuenow="<?= $persentase_total; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $persentase_total; ?>%">
                                        </div>
                                    <?php elseif ($persentase_total <= 35 && $persentase_total <= 70) : ?>
                                        <div class="progress-bar bg-info progress-bar-striped" role="progressbar" aria-valuenow="<?= $persentase_total; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $persentase_total; ?>%">
                                        </div>
                                    <?php elseif ($persentase_total <= 71 && $persentase_total == 100) : ?>
                                        <div class="progress-bar bg-success progress-bar-striped" role="progressbar" aria-valuenow="<?= $persentase_total; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $persentase_total; ?>%">
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="icon">
                            <i class="fas fa-money-check-alt"></i>
                        </div>
                        <a href="<?= base_url('admin/penyerapan_atk'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
            <!-- <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-olive">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-auto mr-auto">
                                    <h5>Informasi Aplikasi</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="text-danger h3">* Informasi tentang kekurangan atau menu yang belum dikerjakan.</p>
                            <div class="text-danger">
                                <span>1. Menjumlah semua nominal aset. <b class="badge bg-success"><i class="fas fa-check-circle"></i> SUDAH</b></span>
                                <br>
                                <span>2. Rekapitulasi jumlah aset per ruangan, berisi nama aset, jumlah aset, jenis aset, kondisi aset, tindakan, tanggal kondisi, .<b class="badge bg-success"><i class="fas fa-check-circle"></i> SUDAH</b></span>
                                <br>
                                <span>3. Menu Cek Kondisi aset menggunakan filter masih error.<b class="badge bg-success"><i class="fas fa-check-circle"></i> SUDAH</b></span>
                                <br>
                                <span>4. Tampilan Rekap bisa lebih simple dengan filterisasi.<b class="badge bg-success"><i class="fas fa-check-circle"></i> SUDAH</b></span>
                                <br>
                                <span>5. Mengganti Laporan PDF menjadi Excel.<b class="badge bg-success"><i class="fas fa-check-circle"></i> SUDAH</b></span>
                                <br>
                                <span>6. Membuat tampilan dashboard.<b class="badge bg-warning"><i class="fas fa-sync-alt"></i> ON PROCESS</b></span>
                                <br>
                                <span><b>7. Menu ATK masih belum ada.</b></span>
                                <br>
                                <span>
                                    <b>
                                        8. Membuat analisa relasi antar tabel, misal jika menghapus aset maka hilang semua inputan seperti cek kondisi aset.<span class="badge bg-warning"><i class="fas fa-sync-alt"></i> ON PROCESS</span>
                                    </b>
                                    <br>
                                    <span>Permasalahan : </span>
                                    <br>
                                    <span>1. Kondisi Jika Data Gedung diHapus maka relasi data gedung menjadi nilai 0 <b class="text-info">Case Warna Biru</b></span>
                                    <br>
                                    <span>2. Jika Mutasi atau berpindah tempat maka nilai data berubah sesuai dengan ID tempat tujuan <b class="text-success">Case Warna Hijau</b></span>
                                    <br>
                                    <span>*. Menu Gedung => data gedung dihapus <b class="badge bg-info"><i class="fas fa-check-circle"></i> DONE</b></span>
                                    <br>
                                    <span>*. Menu Ruang => pada data gedung di hapus tabel row berwarna merah -> diganti dengan adanya validasi data untuk menghapus atau mutasi data. <b class="badge bg-info"><i class="fas fa-check-circle"></i> DONE</b></span>
                                    <br>
                                    <span>*. Menu Unit => pada data gedung di hapus tabel row berwarna merah -> diganti dengan adanya validasi data untuk menghapus atau mutasi data. <b class="badge bg-info"><i class="fas fa-check-circle"></i> DONE</b></span>
                                    <br>
                                    <span>*. Menu Sub Unit => pada data gedung di hapus tabel row berwarna merah -> diganti dengan adanya validasi data untuk menghapus atau mutasi data. <b class="badge bg-info"><i class="fas fa-check-circle"></i> DONE</b></span>
                                    <br>
                                    <span>*. Menu Input Aset => pada data gedung di hapus tabel row berwarna merah -> diganti dengan adanya validasi data untuk menghapus atau mutasi data. <b class="badge bg-info"><i class="fas fa-check-circle"></i> DONE</b></span>
                                    <br>
                                    <span>*. Menu Jenis Aset => pada data gedung di hapus tabel row berwarna merah -> diganti dengan adanya validasi data untuk menghapus atau mutasi data. <b class="badge bg-info"><i class="fas fa-check-circle"></i> DONE</b></span>
                                    <br>
                                    <span>*. Menu Kelompok Aset => pada data gedung di hapus tabel row berwarna merah -> diganti dengan adanya validasi data untuk menghapus atau mutasi data. <b class="badge bg-info"><i class="fas fa-check-circle"></i> DONE</b></span>
                                    <br>
                                </span>
                                <br>
                                <span><b>9. Membuat menu setiap role users. <span class="badge bg-warning"><i class="fas fa-sync-alt"></i> ON PROCESS</span></b>
                                    <br>
                                    <span><b>
                                            Edit data aset masih memakai select2, seharusnya select2 disable dan terpilih sub unit yang aktif pada akun tersebut.<b class="badge bg-success"><i class="fas fa-check-circle"></i> DONE</b>
                                        </b>
                                    </span>
                                </span>
                                <br>
                                <span><b>10. Fungsi edit belum bisa pada menu cek kondisi & Input Aset.</b> <i class="fas fa-sync-alt badge bg-info"> OPTIONAL</i></span>
                                <br>
                                <span><b>11. Menu Mutasi Barang.</b></span>
                                <br>
                                <span><b>12. Fungsi Upload data di input data aset dan data ATK. <span class="badge bg-success"><i class="fas fa-check-circle"></i> DONE Input Aset </span> | <span class="badge bg-warning"><i class="fas fa-sync-alt"></i> ON PROCESS Data ATK</span></b></span>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </section>
</div>