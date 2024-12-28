<div class="content-wrapper">
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
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>

                    <div class="col-lg-12">
                        <div class="card card-olive shadow">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-auto mr-auto">
                                        <h5>Tabel Aset <?= $GETsub_unit['nama_sub_unit']; ?></h5>
                                    </div>
                                    <div class="col-auto">
                                        <a href="<?= base_url('subunit/input_aset'); ?>" type="button" class="btn  btn-block bg-gradient-dark btn-sm"><i class="fas fa-step-backward"></i> Kembali</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover" id="data_unit" style="width: 100%;">
                                    <thead>
                                        <tr class="text-center" style="background-color: #17a2b8; color: azure">
                                            <th>No</th>
                                            <th>Nama Sarana</th>
                                            <th>Lokasi Aset</th>
                                            <th>Jumlah</th>
                                            <th>Tahun Pengadaan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $no = 1;
                                        foreach ($aset_bySubUnit as $ia) : ?>
                                        <?php if($ia['aset_aktif'] == 1):?>
                                            <tr>
                                                <td class="text-center"><?= $no; ?></td>
                                                <td>
                                                    <?= $ia['nama_sarana']; ?>
                                                    <a href="#" data-toggle="modal" data-target="#nonaktif_aset<?= $ia['id_input_aset']; ?>" class="badge bg-success BtnAktifAset">Aktif</a>
                                                    <!-- <span class="badge bg-secondary BtnNonAktifAset">Non Aktif</span> -->
                                                </td>
                                                <td class="text-center">Unit <b><?= $ia['nama_unit']; ?></b> || Ruang <b><?= $ia['nama_ruang']; ?></b></td>
                                                <td class="text-center"><?= $ia['jumlah_aset']; ?></td>
                                                <td class="text-center"><?= $ia['tahun_pengadaan']; ?></td>
                                                <td class="text-center">
                                                    <a href="#" class="badge bg-lightblue AsetDetail" data-toggle="modal" data-target="#detail_aset<?= $ia['id_input_aset']; ?>" data-aset-aktif="<?= $ia['aset_aktif']; ?>"><i class="fas fa-info-circle"></i> Details
                                                    </a> |
                                                    <a href="<?= base_url('subunit/edit_aset/') . $ia['id_input_aset']; ?>" class="badge bg-warning btn-edit-aset"><i class="far fa-edit"></i> Edit
                                                    </a> |
                                                    <!-- <a href="#" class="badge bg-secondary DisableEditAset" ><i class="far fa-edit"></i> Edit </a> -->
                                                    <a href="#" class="badge bg-danger btn-hapus-aset" data-toggle="modal" data-target="#hapus_aset<?= $ia['id_input_aset']; ?>" ><i class="far fa-trash-alt"></i> Hapus
                                                    </a>
                                                    <!-- <a href="#" class="badge bg-secondary DisableHapusAset" ><i class="far fa-trash-alt"></i> Hapus </a> -->
                                                </td>
                                            </tr>
                                        <?php else:?>
                                            <tr>
                                                <td class="text-center"><?= $no; ?></td>
                                                <td>
                                                    <?= $ia['nama_sarana']; ?>
                                                    <span class="badge bg-secondary BtnNonAktifAset">Non Aktif</span>
                                                </td>
                                                <td class="text-center">Unit <b><?= $ia['nama_unit']; ?></b> || Ruang <b><?= $ia['nama_ruang']; ?></b></td>
                                                <td class="text-center"><?= $ia['jumlah_aset']; ?></td>
                                                <td class="text-center"><?= $ia['tahun_pengadaan']; ?></td>
                                                <td class="text-center">
                                                    <a href="#" class="badge bg-lightblue AsetDetail" data-toggle="modal" data-target="#detail_aset<?= $ia['id_input_aset']; ?>" data-aset-aktif="<?= $ia['aset_aktif']; ?>"><i class="fas fa-info-circle"></i> Details
                                                    </a> |
                                                    <a href="#" class="badge bg-secondary DisableEditAset" ><i class="far fa-edit"></i> Edit </a> |
                                                    <a href="#" class="badge bg-secondary DisableHapusAset" ><i class="far fa-trash-alt"></i> Hapus </a>
                                                </td>
                                            </tr>
                                        <?php endif;?>
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
    </section>
</div>


<!-- Modal Hapus -->
<?php foreach ($input_aset as $ia) : ?>
    <div id="hapus_aset<?= $ia['id_input_aset']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="hapus_asetTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hapus_asetTitle">Hapus Data Aset</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="<?= base_url('subunit/hapus_aset/') . $ia['id_input_aset']; ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" value="<?= $ia['id_input_aset']; ?>">
                        <input type="hidden" name="pic_id_edit" id="pic_id_edit" value="<?= $ia['pic_id']; ?>">
                        <div class="col-md-12">
                            <div class="alert alert-danger" role="alert">
                                <h4 class="alert-heading">Peringatan!!!</h4>
                                <?php $jumlahcekaset = HitungData('inventory_kondisi_aset', 'aset_id', $ia['id_input_aset']);
                                if ($jumlahcekaset == 0) : ?>
                                    <span>Data tersebut akan hilang permanen jika anda menekan tombol hapus.</span>
                                    <hr>
                                <?php else : ?>
                                    <p>Data aset <b><?= $ia['nama_sarana']; ?></b> memiliki <b>riwayat <?= $jumlahcekaset; ?> kali pengecekan.</b></p>
                                    <span>Data tersebut akan hilang permanen jika anda menekan tombol hapus.</span>
                                    <hr>
                                <?php endif; ?>
                                <p class="mb-0">
                                    Apakah anda akan tetap menghapus data aset <strong><?= $ia['nama_sarana']; ?></strong> yang berada di <strong><?= $ia['nama_gedung']; ?></strong>, Ruangan <strong><?= $ia['nama_ruang']; ?></strong>, pada Unit <strong><?= $ia['nama_unit']; ?></strong> Sub Unit <strong><?= $ia['nama_sub_unit']; ?></strong> ?
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

<!-- Modal Detail -->
<?php foreach ($input_aset as $ia) : ?>
    <div class="modal fade" id="detail_aset<?= $ia['id_input_aset']; ?>">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detail Aset</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <strong>Nama Aset : <?= $ia['nama_sarana']; ?></strong>
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Label Aset</label>
                                        <input type="text" class="form-control" value="<?= $ia['label_aset']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Lokasi Gedung dan Ruang</label>
                                        <input type="text" class="form-control" value="<?= $ia['nama_gedung']; ?> | Ruangan <?= $ia['nama_ruang']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Lokasi Unit dan Sub Unit</label>
                                        <input type="text" class="form-control" value="Unit <?= $ia['nama_unit']; ?> | <?= $ia['nama_sub_unit']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Jenis Aset</label>
                                        <input type="text" class="form-control" value="<?= $ia['nama_kelompok']; ?> | <?= $ia['jenis_aset']; ?> | Umur <?= $ia['umur_aset']; ?> Tahun" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Status Kepemilikan</label>
                                        <input type="text" class="form-control" value="<?= $ia['status_kepemilikan']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Penanggung Jawab</label>
                                        <input type="text" class="form-control" value="<?= $ia['nama']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Jumlah Aset</label>
                                        <input type="text" class="form-control" value="<?= $ia['jumlah_aset']; ?> <?= $ia['satuan_aset']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Tahun Pengadaan</label>
                                        <input type="text" class="form-control" value="<?= $ia['tahun_pengadaan']; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer row">
                    <div class="col-auto mr-auto">
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Keluar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal NonAktif -->
<?php foreach ($input_aset as $ia) : ?>
    <div id="nonaktif_aset<?= $ia['id_input_aset']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="nonaktif_asetTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="nonaktif_asetTitle">Nonaktif Aset</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="<?= base_url('subunit/nonaktif_aset/') . $ia['id_input_aset']; ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" value="<?= $ia['id_input_aset']; ?>">
                        <input type="hidden" name="pic_id_edit" id="pic_id_edit" value="<?= $ia['pic_id']; ?>">
                        <div class="col-md-12">
                            <div class="alert alert-danger" role="alert">
                                <h4 class="alert-heading">Peringatan!!!</h4>
                                <p class="mb-0">
                                Apakah anda akan menonaktifkan aset <strong><?= $ia['nama_sarana']; ?></strong> yang berada di <strong><?= $ia['nama_gedung']; ?></strong>, Ruangan <strong><?= $ia['nama_ruang']; ?></strong>, pada Unit <strong><?= $ia['nama_unit']; ?></strong> Sub Unit <strong><?= $ia['nama_sub_unit']; ?></strong> ?
                                </p>
                                <hr>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn  btn-secondary" data-dismiss="modal">Keluar</button>
                        <button type="submit" class="btn  btn-danger">Non Aktif</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
