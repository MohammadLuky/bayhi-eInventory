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
                        <li class="breadcrumb-item"><a href="<?= base_url('subunit'); ?>">Home</a></li>
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
                            <form action="<?= base_url('subunit/input_pengajuanATK'); ?>" method="post">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-auto mr-auto">
                                            <h5>Input Aset</h5>
                                        </div>
                                        <div class="col-auto">
                                            <a href="<?= base_url('subunit/PengajuanATK'); ?>" type="button" class="btn bg-gradient-dark btn-sm"><i class="fas fa-list-alt"></i> Data Pengajuan</a> |
                                            <a href="" class="btn bg-gradient-dark btn-sm" onclick="refreshPage()"><i class="fas fa-sync"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="floating-label">Unit</label>
                                                <select class="form-control" name="pilih_unit_atk" id="pilih_unit_atk" style="width: 100%;">
                                                    <option value="">Pilih Unit</option>
                                                    <?php foreach ($DataUnit as $unit) : ?>
                                                        <option value="<?= $unit['id_unit']; ?>">
                                                            <?= $unit['nama_unit']; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <?= form_error('pilih_unit_atk', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Tanggal Pengajuan</label>
                                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="tanggal_pengajuan_atk" id="tanggal_pengajuan_atk" value="<?= set_value('tanggal_pengajuan_atk'); ?>" autocomplete="off" />
                                                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                                <?= form_error('tanggal_pengajuan_atk', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="floating-label">Tahun Periode</label>
                                                <input type="number" class="form-control" id="tahun_periode" name="tahun_periode" placeholder="Isikan Nominal Harga" autocomplete="off" value="<?= date('Y'); ?>" readonly>
                                                <?= form_error('tahun_periode', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="floating-label">Nama Barang</label>
                                                <select class="form-control" name="pilih_atk" id="pilih_atk" style="width: 100%;">
                                                    <option value="">Pilih Barang ATK</option>
                                                    <?php foreach ($BarangATK as $atk) : ?>
                                                        <option value="<?= $atk['id_atk']; ?>" data-harga="<?= $atk['satuan_harga']; ?>">
                                                            <?= $atk['nama_barang']; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <?= form_error('pilih_atk', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="floating-label">Harga Satuan ATK</label>
                                                <input type="number" class="form-control" id="harga_satuan_atk_pengajuan" name="harga_satuan_atk_pengajuan" placeholder="Harga ATK" value="" readonly>
                                                <?= form_error('harga_satuan_atk_pengajuan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="floating-label">Jumlah ATK</label>
                                                <input type="number" class="form-control" id="jumlah_atk" name="jumlah_atk" placeholder="Jumlah ATK" autocomplete="off" value="<?= set_value('jumlah_atk'); ?>">
                                                <?= form_error('jumlah_atk', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="floating-label">Satuan Barang</label>
                                                <select class="form-control" name="satuan_barang" id="satuan_barang" style="width: 100%;">
                                                    <option value="">Pilih Satuan ATK</option>
                                                    <?php foreach ($satuan_barang as $satuan) : ?>
                                                        <option value="<?= $satuan; ?>">
                                                            <?= $satuan; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <?= form_error('satuan_barang', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="floating-label">Total Harga</label>
                                                <input type="number" class="form-control" id="total_harga_pengajuan" name="total_harga_pengajuan" placeholder="Total Harga" autocomplete="off" value="<?= set_value('total_harga_pengajuan'); ?>" readonly>
                                                <?= form_error('total_harga_pengajuan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-auto mr-auto"></div>
                                        <div class="col-auto">
                                            <button class="btn btn-info" type="submit">Simpan</button>
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