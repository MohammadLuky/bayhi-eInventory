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
                </div><!-- /.col -->
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


                    <div class="card card-lightblue shadow">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-auto mr-auto">
                                    <table class="table table-sm">
                                        <h5>Pengecekan Berkala Aset</h5>
                                        <tbody>
                                            <tr>
                                                <td>Nama Aset</td>
                                                <td>:</td>
                                                <td><strong><em><?= $get_aset['nama_sarana']; ?> </em></strong></td>
                                            </tr>
                                            <tr>
                                                <td>Lokasi Aset</td>
                                                <td>:</td>
                                                <td><em>Unit <b><?= $get_aset['nama_unit']; ?></b> | Ruang <b><?= $get_aset['nama_ruang']; ?></b></em></td>
                                            </tr>
                                            <tr>
                                                <td>Jumlah Aset</td>
                                                <td>:</td>
                                                <td><strong><?= $get_aset['jumlah_aset']; ?></strong></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-auto">
                                    <a href="<?= base_url('admin/kondisi_aset'); ?>" type="button" class="btn  btn-block bg-gradient-dark btn-sm"><i class="fas fa-step-backward"></i> Kembali</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="col-md-12">
                                <form action="<?= base_url('admin/cek_kondisi_aset/') . $get_aset['id_input_aset']; ?>" method="post">
                                    <div class="card card-outline card-olive">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-auto mr-auto">
                                                    <h3 class="card-title">Input Kondisi</h3>
                                                </div>
                                                <div class="col-auto">
                                                    <button type="button" class="btn bg-gradient-dark btn-block btn-sm" onclick="refreshPage()"><i class="fas fa-sync"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <input type="hidden" name="aset_id" id="aset_id" value="<?= $get_aset['id_input_aset']; ?>">
                                                    <input type="hidden" class="form-control" name="nama_sarana" id="nama_sarana" value="<?= $get_aset['nama_sarana']; ?>" readonly>
                                                    <div class="form-group">
                                                        <input type="hidden" name="pic_kondisi_id" id="pic_kondisi_id" value="<?= $get_aset['pic_id']; ?>">
                                                        <input type="hidden" name="unit_kondisi_id" id="unit_kondisi_id" value="<?= $get_aset['aset_unit_id']; ?>">
                                                        <input type="hidden" name="subunit_kondisi_id" id="subunit_kondisi_id" value="<?= $get_aset['aset_sub_unit_id']; ?>">
                                                        <label class="floating-label">Penanggung Jawab</label>
                                                        <input type="text" class="form-control" id="nama_pic" name="nama_pic" value="<?= $get_aset['nama']; ?>" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Tanggal Pengecekan</label>
                                                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                            <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="tanggal_cek" id="tanggal_cek" value="<?= set_value('tanggal_cek'); ?>" autocomplete="off" />
                                                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                            </div>
                                                        </div>
                                                        <?= form_error('tanggal_cek', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label>Kondisi Aset</label>
                                                            <select class="form-control select2" name="kondisi_aset" id="kondisi_aset" style="width: 100%;">
                                                                <option value="pilih">Pilih Kondisi</option>
                                                                <?php foreach ($pilih_kondisi as $kondisi) : ?>
                                                                    <option value="<?= $kondisi; ?>"><?= $kondisi; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                            <?= form_error('kondisi_aset', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12" id="input_tindakan">
                                                        <div class="form-group">
                                                            <label class="floating-label">Keterangan</label>
                                                            <input type="text" class="form-control" id="ket_kondisi_aset" name="ket_kondisi_aset" autocomplete="off" placeholder="Isikan Kondisi Aset saat ini." value="<?= set_value('ket_kondisi_aset'); ?>">
                                                            <?= form_error('ket_kondisi_aset', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="floating-label">Jumlah Aset</label>
                                                            <input type="number" class="form-control" id="jumlah_aset" name="jumlah_aset" autocomplete="off" placeholder="Isikan jumlah aset baik atau tidak baik." value="<?= set_value('jumlah_aset'); ?>">
                                                            <?= form_error('jumlah_aset', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
                                                        </div>
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
                                    </div>
                                </form>
                            </div>
                        </div>
                        <hr>
                        <br>
                        <div class="col-md-12">
                            <div class="card card-olive shadow">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-auto mr-auto">
                                            <h3 class="card-title">Tabel Kondisi</h3>
                                        </div>
                                        <div class="col-auto">
                                            <a href="<?= base_url('admin/laporanKondisi/') . $get_aset['id_input_aset']; ?>" class="btn bg-gradient-dark btn-block btn-sm"><i class="fas fa-file-pdf"></i> Cetak Laporan</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-hover" id="data_aset">
                                        <thead>
                                            <tr class="text-center" style="background-color: #17a2b8; color: azure">
                                                <th>No</th>
                                                <th>Nama Aset</th>
                                                <th>Kondisi Aset</th>
                                                <th>Jumlah Aset</th>
                                                <th>Keterangan</th>
                                                <th>Tanggal Cek</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1;
                                            foreach ($kondisi_per_aset as $kpa) : ?>
                                                <tr>
                                                    <td class="text-center"><?= $no; ?></td>
                                                    <td><?= $kpa['nama_sarana']; ?></td>
                                                    <td class="text-center">
                                                        <?php if ($kpa['kondisi_aset'] == 'Baik') : ?>
                                                            <span class="badge bg-success"><?= $kpa['kondisi_aset']; ?></span>
                                                        <?php elseif ($kpa['kondisi_aset'] == 'Rusak Ringan') : ?>
                                                            <span class="badge bg-warning"><?= $kpa['kondisi_aset']; ?></span>
                                                        <?php elseif ($kpa['kondisi_aset'] == 'Rusak Berat') : ?>
                                                            <span class="badge bg-danger"><?= $kpa['kondisi_aset']; ?></span>
                                                        <?php else : ?>
                                                            <span class="badge bg-lightblue"><?= $kpa['kondisi_aset']; ?></span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="text-center"><?= $kpa['jumlah_aset_kondisi']; ?></td>
                                                    <td><?= $kpa['ket_kondisi_aset']; ?></td>
                                                    <td class="text-center"><?= tanggal_indonesia_format($kpa['tanggal_cek']); ?></td>
                                                    <td class="text-center">
                                                        <a href="#" class="badge bg-danger" data-toggle="modal" data-target="#hapus_kondisi<?= $kpa['id_kondisi']; ?>"><i class="far fa-trash-alt"></i> Hapus
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php $no++;
                                            endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php foreach ($kondisi_per_aset as $kpa) : ?>
    <div id="hapus_kondisi<?= $kpa['id_kondisi']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="hapus_kondisi" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title" id="hapus_kondisi">Hapus Data Kondisi Aset</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="<?= base_url('admin/hapus_kondisi/') . $kpa['id_kondisi']; ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" value="<?= $kpa['aset_id']; ?>" name="aset_id" id="aset_id">
                        <input type="hidden" name="id_kondisi" id="id_kondisi" value="<?= $kpa['id_kondisi']; ?>">
                        <div class="col-md-12">
                            <div class="alert alert-info" role="alert">
                                <h4 class="alert-heading">Peringatan!!!</h4>
                                <p class="mb-0">
                                    Apakah anda akan tetap menghapus catatan kondisi aset <strong><?= $kpa['nama_sarana']; ?></strong> yang berjumlah <strong><?= $kpa['jumlah_aset_kondisi']; ?></strong> pada <strong><?= $kpa['nama_unit']; ?></strong> ?
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