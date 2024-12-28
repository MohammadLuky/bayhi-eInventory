<div class="content-wrapper">
    <!-- Content Header (Page header) -->
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
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
                    <?php if ($this->session->flashdata('error')) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><?= $this->session->flashdata('error'); ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    <?php endif; ?>

                    <div class="col-12">
                        <div class="card card-outline card-olive shadow">
                            <form action="<?= base_url('admin/edit_pengambilanATK/') . $getPengambilanATK['id_pengambilan']; ?>" method="post">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-auto mr-auto">
                                            <h5>Edit Pengambilan ATK</h5>
                                        </div>
                                        <div class="col-auto">
                                            <a href="<?= base_url('admin/input_pengambilanATK/') . $getPengambilanATK['unit_pengambilan_id']; ?>" type="button" class="btn bg-gradient-dark btn-sm"><i class="fas fa-list-alt"></i> ATK Pengambilan <?= $getPengambilanATK['nama_unit']; ?></a> |
                                            <a href="" class="btn bg-gradient-dark btn-sm" onclick="refreshPage()"><i class="fas fa-sync"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="floating-label">Nama Unit</label>
                                                <input class="form-control" value="<?= $getPengambilanATK['nama_unit']; ?>" readonly>
                                                <input type="hidden" class="form-control" id="id_unit_pengambilan" name="id_unit_pengambilan" value="<?= $getPengambilanATK['unit_pengambilan_id']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Tanggal Pengajuan</label>
                                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="tanggal_pengambilan_atk" id="tanggal_pengambilan_atk" value="<?= $getPengambilanATK['tanggal_pengambilan']; ?>" autocomplete="off" />
                                                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                                <?= form_error('tanggal_pengambilan_atk', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="floating-label">Tahun Periode</label>
                                                <input type="number" class="form-control" id="tahun_periode" name="tahun_periode" placeholder="Isikan Nominal Harga" autocomplete="off" value="<?= $getPengambilanATK['tahun_pengambilan']; ?>" readonly>
                                                <?= form_error('tahun_periode', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="floating-label">Nama Barang</label>
                                                <input type="text" class="form-control" id="nama_barang_pengambilan" name="nama_barang_pengambilan" autocomplete="off" value="<?= $getPengambilanATK['nama_barang']; ?>" readonly>
                                            </div>
                                        </div>
                                        <?php
                                        $totalDiambil = HitungTotalID_ByKriteria($getPengambilanATK['atk_pengambilan_id'], 'jumlah_pengambilan_atk', 'atk_pengambilan_id', 'inventory_pengambilan_atk', 'approval', 'status_pengambilan_atk');
                                        ?>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="floating-label">Sisa Pengajuan ATK</label>
                                                <input type="number" class="form-control" id="jumlah_atk_diambil1" name="jumlah_atk_diambil1" placeholder="Jumlah Pengajuan ATK" autocomplete="off" value="<?= $totalDiambil; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="floating-label">Satuan Barang</label>
                                                <input type="text" class="form-control" id="satuan_barang_diambil" name="satuan_barang_diambil" placeholder="Satuan Barang" autocomplete="off" value="<?= $getBarangPengajuan['satuan_atk_pengajuan']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="floating-label">Harga Pengajuan Satuan ATK</label>
                                                <input type="number" class="form-control" id="harga_satuan_atk_pengambilan1" name="harga_satuan_atk_pengambilan1" placeholder="Harga Pengajuan ATK" value="<?= $getBarangPengajuan['harga_pengajuan_atk']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="floating-label">Jumlah Pengajuan ATK</label>
                                                <input type="number" class="form-control" id="jumlah_atk_pengajuan" name="jumlah_atk_pengajuan" placeholder="Jumlah Pengajuan ATK" autocomplete="off" value="<?= $getBarangPengajuan['jumlah_pengajuan_atk']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="floating-label">Satuan Barang</label>
                                                <input type="text" class="form-control" id="satuan_barang_pengajuan" name="satuan_barang_pengajuan" placeholder="Jumlah Pengajuan ATK" autocomplete="off" value="<?= $getBarangPengajuan['satuan_atk_pengajuan']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="floating-label">Total Pengajuan Harga</label>
                                                <input type="number" class="form-control" id="total_harga_pengambilan1" name="total_harga_pengambilan1" placeholder="Total Harga" value="<?= $getBarangPengajuan['total_pengajuan_atk']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="floating-label">Harga Satuan ATK</label>
                                                <input type="number" class="form-control" id="harga_satuan_atk_pengambilan3" name="harga_satuan_atk_pengambilan3" placeholder="Harga ATK" value="<?= $getPengambilanATK['harga_pengambilan_atk']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="floating-label">Jumlah ATK</label>
                                                <input type="number" class="form-control" id="jumlah_atk_pengambilan2" name="jumlah_atk_pengambilan2" placeholder="Jumlah ATK" autocomplete="off" value="<?= $getPengambilanATK['jumlah_pengambilan_atk']; ?>">
                                                <?= form_error('jumlah_atk_pengambilan2', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="floating-label">Satuan Barang</label>
                                                <input type="text" class="form-control" id="satuan_barang_pengajuan2" name="satuan_barang_pengambilan2" placeholder="Jumlah Pengajuan ATK" autocomplete="off" value="<?= $getPengambilanATK['satuan_atk_pengambilan']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="floating-label">Total Harga</label>
                                                <input type="number" class="form-control" id="total_harga_pengambilan3" name="total_harga_pengambilan3" placeholder="Total Harga" autocomplete="off" value="<?= $getPengambilanATK['total_pengambilan_atk']; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-auto mr-auto"></div>
                                        <div class="col-auto">
                                            <button class="btn btn-info" type="submit">Ubah Data</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>