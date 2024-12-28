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
                            <form action="<?= base_url('subunit/input_pengambilanATK/') . $getUnit['id_unit']; ?>" method="post">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-auto mr-auto">
                                            <h5>Input Aset</h5>
                                        </div>
                                        <div class="col-auto">
                                            <a href="<?= base_url('subunit/DataATKunit'); ?>" type="button" class="btn bg-gradient-dark btn-sm"><i class="fas fa-list-alt"></i> Data Pengambilan</a> |
                                            <a href="" class="btn bg-gradient-dark btn-sm" onclick="refreshPage()"><i class="fas fa-sync"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="floating-label">Nama Unit</label>
                                                <input class="form-control" value="<?= $getUnit['nama_unit']; ?>" readonly>
                                                <input type="hidden" class="form-control" id="id_unit_pengambilan" name="id_unit_pengambilan" value="<?= $getUnit['id_unit']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Tanggal Pengajuan</label>
                                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="tanggal_pengambilan_atk" id="tanggal_pengambilan_atk" value="<?= set_value('tanggal_pengambilan_atk'); ?>" autocomplete="off" />
                                                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                                <?= form_error('tanggal_pengambilan_atk', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-5">
                                            <div class="form-group">
                                                <label class="floating-label">Tahun Periode</label>
                                                <input type="number" class="form-control" id="tahun_periode" name="tahun_periode" placeholder="Isikan Nominal Harga" autocomplete="off" value="<?= date('Y'); ?>" readonly>
                                                <?= form_error('tahun_periode', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="floating-label">Nama Barang</label>
                                                <select class="form-control" name="pilih_atk_pengambilan" id="pilih_atk_pengambilan" style="width: 100%;">
                                                    <option value="">Pilih Barang ATK</option>
                                                    <?php foreach ($DataATK as $atk) :
                                                        $totalPengajuan = HitungTotalID_ByTwoCategory($atk['atk_pengajuan_id'], 'jumlah_pengajuan_atk', 'atk_pengajuan_id', 'inventory_pengajuan_atk', 'approval', 'status_pengajuan_atk', $GETsub_unit['unit_id'], 'unit_pengajuan_id');
                                                        $totalPengambilan = HitungTotalID_ByTwoCategory($atk['atk_pengajuan_id'], 'jumlah_pengambilan_atk', 'atk_pengambilan_id', 'inventory_pengambilan_atk', 'approval', 'status_pengambilan_atk', $GETsub_unit['unit_id'], 'unit_pengambilan_id');
                                                        $SisaATK = $totalPengajuan - $totalPengambilan;
                                                    ?>
                                                        <?php if ($SisaATK == 0) : ?>
                                                            <option value="<?= $atk['id_atk']; ?>" data-hargapengajuan="<?= $atk['harga_pengajuan_atk']; ?>" data-jumlahpengajuan="<?= $atk['jumlah_pengajuan_atk']; ?>" data-satuanbarang1="<?= $atk['satuan_atk_pengajuan']; ?>" data-totalpengajuan="<?= $atk['total_pengajuan_atk']; ?>" data-hargabrg1="<?= $atk['satuan_harga']; ?>" disabled>
                                                                <?= $atk['nama_barang']; ?>
                                                            </option>
                                                        <?php else : ?>
                                                            <option value="<?= $atk['id_atk']; ?>" data-hargapengajuan="<?= $atk['harga_pengajuan_atk']; ?>" data-jumlahpengajuan="<?= $atk['jumlah_pengajuan_atk']; ?>" data-satuanbarang1="<?= $atk['satuan_atk_pengajuan']; ?>" data-totalpengajuan="<?= $atk['total_pengajuan_atk']; ?>" data-hargabrg1="<?= $atk['satuan_harga']; ?>">
                                                                <?= $atk['nama_barang']; ?>
                                                            </option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </select>
                                                <?= form_error('pilih_atk_pengambilan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="floating-label">ATK Sudah Diambil</label>
                                                <input type="number" class="form-control" id="jumlah_atk_diambil" name="jumlah_atk_diambil" placeholder="Jumlah Pengajuan ATK" autocomplete="off" value="" readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="floating-label">Satuan Barang</label>
                                                <input type="text" class="form-control" id="satuan_barang_diambil" name="satuan_barang_diambil" placeholder="Satuan Barang" autocomplete="off" value="" readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="floating-label">Harga Pengajuan Satuan ATK</label>
                                                <input type="number" class="form-control" id="harga_satuan_atk_pengambilan1" name="harga_satuan_atk_pengambilan1" placeholder="Harga Pengajuan ATK" value="" readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="floating-label">Jumlah Pengajuan ATK</label>
                                                <input type="number" class="form-control" id="jumlah_atk_pengajuan" name="jumlah_atk_pengajuan" placeholder="Jumlah Pengajuan ATK" autocomplete="off" value="" readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="floating-label">Satuan Barang</label>
                                                <input type="text" class="form-control" id="satuan_barang_pengajuan" name="satuan_barang_pengajuan" placeholder="Jumlah Pengajuan ATK" autocomplete="off" value="" readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="floating-label">Total Pengajuan Harga</label>
                                                <input type="number" class="form-control" id="total_harga_pengambilan1" name="total_harga_pengambilan1" placeholder="Total Harga" value="" readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="floating-label">Harga Satuan ATK</label>
                                                <input type="number" class="form-control" id="harga_satuan_atk_pengambilan2" name="harga_satuan_atk_pengambilan2" placeholder="Harga ATK" value="" readonly>
                                                <?= form_error('harga_satuan_atk_pengambilan2', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="floating-label">Jumlah ATK</label>
                                                <input type="number" class="form-control" id="jumlah_atk_pengambilan" name="jumlah_atk_pengambilan" placeholder="Jumlah ATK" autocomplete="off" value="<?= set_value('jumlah_atk_pengambilan'); ?>">
                                                <?= form_error('jumlah_atk_pengambilan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="floating-label">Satuan Barang</label>
                                                <select class="form-control" name="satuan_barang_pengambilan" id="satuan_barang_pengambilan" style="width: 100%;">
                                                    <option value="">Pilih Satuan ATK</option>
                                                    <?php foreach ($satuan_barang as $satuan) : ?>
                                                        <option value="<?= $satuan; ?>">
                                                            <?= $satuan; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <?= form_error('satuan_barang_pengambilan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="floating-label">Total Harga</label>
                                                <input type="number" class="form-control" id="total_harga_pengambilan2" name="total_harga_pengambilan2" placeholder="Total Harga" autocomplete="off" value="<?= set_value('total_harga_pengambilan2'); ?>" readonly>
                                                <?= form_error('total_harga_pengambilan2', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
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

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header bg-olive">
                                <h5>Tabel <?= $title; ?></h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover" id="data_unit" style="width: 100%;">
                                    <thead>
                                        <tr class="text-center" style="background-color: #17a2b8; color: azure">
                                            <th class="text-center align-middle" style="width: 10%;">Aksi</th>
                                            <th class="text-center align-middle" style="width: 8%;">Tahun Periode</th>
                                            <th class="text-center align-middle" style="width: 14%;">Tanggal Pengambilan</th>
                                            <th class="text-center align-middle" style="width: 16%;">Nama Unit</th>
                                            <th class="text-center align-middle" style="width: 16%;">Nama Barang ATK</th>
                                            <th class="text-center align-middle" style="width: 10%;">Jumlah Pengambilan ATK</th>
                                            <th class="text-center align-middle" style="width: 10%;">Harga Satuan</th>
                                            <th class="text-center align-middle" style="width: 10%;">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        $jumlahtotalpengajuan = 0;
                                        foreach ($DataPengambilanATK as $pengambilanATK) :
                                            $totalpengajuan = $pengambilanATK['total_pengambilan_atk'];
                                            $jumlahtotalpengajuan += $totalpengajuan;
                                        ?>
                                            <tr>
                                                <?php if ($pengambilanATK['status_pengambilan_atk'] == 'pengajuan') : ?>
                                                    <td class="text-center">
                                                        <span class="badge bg-info"><i class="fas fa-spinner fa-spin"></i> Proses Pengajuan</span>
                                                    </td>
                                                <?php elseif ($pengambilanATK['status_pengambilan_atk'] == 'approval') : ?>
                                                    <td class="text-center">
                                                        <span class="badge bg-success"><i class="far fa-check-circle"></i> Pengambilan Berhasil</span>
                                                    </td>
                                                <?php elseif ($pengambilanATK['status_pengambilan_atk'] == 'revisi') : ?>
                                                    <td class="text-center">
                                                        <em class="text-danger">Revisi</em>
                                                        <a href="<?= base_url('subunit/edit_pengambilanATK/') . $pengambilanATK['id_pengambilan'] ?>" class="badge bg-warning"><i class="far fa-edit"></i> Edit
                                                        </a> |
                                                        <a href="#" class="badge bg-navy" data-toggle="modal" data-target="#ajukan_pengambilanATK<?= $pengambilanATK['id_pengambilan']; ?>"><i class="fas fa-paper-plane"></i> Ajukan
                                                        </a>
                                                    </td>
                                                <?php elseif ($pengambilanATK['status_pengambilan_atk'] == 'pengisian') : ?>
                                                    <td class="text-center">
                                                        <a href="<?= base_url('subunit/edit_pengambilanATK/') . $pengambilanATK['id_pengambilan'] ?>" class="badge bg-warning"><i class="far fa-edit"></i> Edit
                                                        </a> |
                                                        <a href="#" class="badge bg-danger" data-toggle="modal" data-target="#hapus_pengambilanATK<?= $pengambilanATK['id_pengambilan']; ?>"><i class="far fa-trash-alt"></i> Hapus
                                                        </a> |
                                                        <a href="#" class="badge bg-navy" data-toggle="modal" data-target="#ajukan_pengambilanATK<?= $pengambilanATK['id_pengambilan']; ?>"><i class="fas fa-paper-plane"></i> Ajukan
                                                        </a>
                                                    </td>
                                                <?php endif; ?>
                                                <td class="text-center"><?= $pengambilanATK['tahun_pengambilan']; ?></td>
                                                <td class="text-center"><?= tanggal_indonesia_format($pengambilanATK['tanggal_pengambilan']); ?></td>
                                                <td><?= $pengambilanATK['nama_unit']; ?></td>
                                                <td><?= $pengambilanATK['nama_barang']; ?></td>
                                                <td class="text-center"><?= $pengambilanATK['jumlah_pengambilan_atk']; ?> <?= $pengambilanATK['satuan_atk_pengambilan']; ?></td>
                                                <td class="text-center"><?= buatRupiah($pengambilanATK['harga_pengambilan_atk']); ?> </td>
                                                <td class="text-center"><?= buatRupiah($pengambilanATK['total_pengambilan_atk']); ?> </td>
                                            </tr>
                                        <?php $no++;
                                        endforeach; ?>
                                    </tbody>
                                    <tr style="background-color: lemonchiffon;">
                                        <td class="text-center" colspan="7"><b>Total Pengambilan</b></td>
                                        <td class="text-center">
                                            <b>
                                                <?= buatRupiah($jumlahtotalpengajuan); ?>
                                            </b>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php foreach ($DataPengambilanATK as $pengambilanATK) : ?>
    <div id="hapus_pengambilanATK<?= $pengambilanATK['id_pengambilan']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="hapus_pengambilanATK" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title" id="hapus_pengambilanATK">Hapus Data Pengambilan Barang ATK</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="<?= base_url('subunit/hapus_pengambilanATK/') . $pengambilanATK['id_pengambilan']; ?>" method="post">
                    <input type="hidden" class="form-control" id="id_unit_pengambilan" name="id_unit_pengambilan" value="<?= $getUnit['id_unit']; ?>">
                    <div class="modal-body">
                        <input type="hidden" value="<?= $pengambilanATK['id_pengambilan']; ?>">
                        <input type="hidden" name="id_pengambilan" id="id_pengambilan" value="<?= $pengambilanATK['id_pengambilan']; ?>">
                        <div class="col-md-12">
                            <div class="alert alert-info" role="alert">
                                <h4 class="alert-heading">Peringatan!!!</h4>
                                <p class="mb-0">
                                    Apakah anda akan tetap menghapus data barang <strong><?= $pengambilanATK['nama_barang']; ?></strong> yang berjumlah <strong><?= $pengambilanATK['jumlah_pengambilan_atk']; ?></strong> <strong><?= $pengambilanATK['satuan_atk_pengambilan']; ?></strong> pada <strong><?= $pengambilanATK['nama_unit']; ?></strong> ?
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn  btn-secondary" data-dismiss="modal">Keluar</button>
                        <button type="submit" class="btn  btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?php foreach ($DataPengambilanATK as $pengambilanATK) : ?>
    <div id="ajukan_pengambilanATK<?= $pengambilanATK['id_pengambilan']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ajukan_pengambilanATK" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title" id="ajukan_pengambilanATK">Pengajuan Pengambilan Barang ATK</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="<?= base_url('subunit/pengajuan_pengambilanATK/') . $pengambilanATK['id_pengambilan']; ?>" method="post">
                    <input type="hidden" class="form-control" id="id_unit_pengambilan" name="id_unit_pengambilan" value="<?= $getUnit['id_unit']; ?>">
                    <div class="modal-body">
                        <input type="hidden" value="<?= $pengambilanATK['id_pengambilan']; ?>">
                        <input type="hidden" name="id_pengambilan" id="id_pengambilan" value="<?= $pengambilanATK['id_pengambilan']; ?>">
                        <div class="col-md-12">
                            <div class="alert alert-info" role="alert">
                                <h4 class="alert-heading">Peringatan!!!</h4>
                                <p class="mb-0">
                                    Apakah anda akan tetap mengajukan pengambilan barang <strong><?= $pengambilanATK['nama_barang']; ?></strong> yang berjumlah <strong><?= $pengambilanATK['jumlah_pengambilan_atk']; ?></strong> <strong><?= $pengambilanATK['satuan_atk_pengambilan']; ?></strong> pada <strong><?= $pengambilanATK['nama_unit']; ?></strong> ?
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn  btn-secondary" data-dismiss="modal">Keluar</button>
                        <button type="submit" class="btn  btn-danger">Ajukan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>