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
                        <li class="breadcrumb-item"><a href="<?= base_url('adminaset'); ?>">Home</a></li>
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
                    <?php if (validation_errors()) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><?= validation_errors(); ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    <?php endif; ?>
                    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>

                    <div class="card card-olive shadow">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-auto mr-auto">
                                    <h5>Tabel <?= $title; ?></h5>
                                </div>
                                <div class="col-auto">
                                    <button type="button" class="btn btn-block bg-gradient-dark btn-sm" data-toggle="modal" data-target=".tambah_unit"><i class="fas fa-plus-circle"></i> Tambah Unit</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="data_unit">
                                <thead>
                                    <tr class="text-center" style="background-color: #17a2b8; color: azure">
                                        <th>No</th>
                                        <th>Nama Unit</th>
                                        <th>Kepala Unit</th>
                                        <!-- <th>Sarpras Unit (Optional)</th> -->
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($unit as $units) : ?>
                                        <?php if ($units['kepala_unit_id'] == 0) : ?>
                                            <tr>
                                                <td class="text-center"><?= $no; ?></td>
                                                <td><?= $units['nama_unit']; ?></td>
                                                <td>Belum Dipilih</td>
                                                <!-- <td>Belum Dipilih</td> -->
                                                <td class="text-center">
                                                    <a href="#" class="badge bg-warning" data-toggle="modal" data-target="#edit_unit<?= $units['id_unit']; ?>" onclick="edit_unit(<?= $units['id_unit']; ?>)"><i class="far fa-edit"></i> Edit
                                                    </a> | <a href="#" class="badge bg-danger delete-unit" data-unitid="<?= $units['id_unit']; ?>" data-toggle="modal" data-target="#hapus_unit<?= $units['id_unit']; ?>"><i class="far fa-trash-alt"></i> Hapus
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php elseif ($units['kepala_unit_id'] == 0) : ?>
                                            <tr>
                                                <td class="text-center"><?= $no; ?></td>
                                                <td><?= $units['nama_unit']; ?></td>
                                                <?php foreach ($pengguna as $user) : ?>
                                                    <?php if ($units['kepala_unit_id'] == $user['id_pengguna']) : ?>
                                                        <td><?= $user['nama']; ?></td>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                                <!-- <td>Belum Dipilih</td> -->
                                                <td class="text-center">
                                                    <a href="#" class="badge bg-warning" data-toggle="modal" data-target="#edit_unit<?= $units['id_unit']; ?>" onclick="edit_unit(<?= $units['id_unit']; ?>)"><i class="far fa-edit"></i> Edit
                                                    </a> | <a href="#" class="badge bg-danger delete-unit" data-unitid="<?= $units['id_unit']; ?>" data-toggle="modal" data-target="#hapus_unit<?= $units['id_unit']; ?>"><i class="far fa-trash-alt"></i> Hapus
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php else : ?>
                                            <tr>
                                                <td class="text-center"><?= $no; ?></td>
                                                <td><?= $units['nama_unit']; ?></td>
                                                <?php foreach ($pengguna as $user) : ?>
                                                    <?php if ($units['kepala_unit_id'] == $user['id_pengguna']) : ?>
                                                        <td><?= $user['nama']; ?></td>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                                <!-- <?php foreach ($pengguna as $user) : ?>
                                                    <?php if ($units['sarpras_unit_id'] == $user['id_pengguna']) : ?>
                                                        <td><?= $user['nama']; ?></td>
                                                    <?php endif; ?>
                                                <?php endforeach; ?> -->
                                                <td class="text-center">
                                                    <a href="#" class="badge bg-warning" data-toggle="modal" data-target="#edit_unit<?= $units['id_unit']; ?>" onclick="edit_unit(<?= $units['id_unit']; ?>)"><i class="far fa-edit"></i> Edit
                                                    </a> | <a href="#" class="badge bg-danger delete-unit" data-unitid="<?= $units['id_unit']; ?>" data-toggle="modal" data-target="#hapus_unit<?= $units['id_unit']; ?>"><i class="far fa-trash-alt"></i> Hapus
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php $no++;
                                    endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Insert -->
<div class="modal fade tambah_unit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?= base_url('adminaset/unit'); ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel">Tambah Unit Yayasan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="floating-label">Nama Unit</label>
                                    <input type="text" class="form-control" id="nama_unit" name="nama_unit" placeholder="Nama Unit Yayasan" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Kepala Unit</label>
                                    <select class="form-control select2" name="kepala_unit" id="kepala_unit" style="width: 100%;">
                                        <option>Pilih Kepala Unit</option>
                                        <?php foreach ($pengguna as $users) : ?>
                                            <?php if ($users['peran_id'] != 1) : ?>
                                                <?php if ($users['peran_id'] == 4) : ?>
                                                    <option value="<?= $users['id_pengguna']; ?>"><?= $users['nama']; ?> | <?= $users['jabatan_pengguna']; ?></option>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Sarpras Unit</label>
                                    <select class="form-control select2" name="sarpras_unit" id="sarpras_unit" style="width: 100%;">
                                        <option>Pilih Sarpras Unit</option>
                                        <?php foreach ($pengguna as $users) : ?>
                                            <?php if ($users['peran_id'] != 1) : ?>
                                                <?php if ($users['peran_id'] == 5) : ?>
                                                    <option value="<?= $users['id_pengguna']; ?>"><?= $users['nama']; ?> | <?= $users['jabatan_pengguna']; ?></option>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn  btn-danger btn-sm" data-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn  btn-primary btn-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<?php foreach ($unit as $units) : ?>
    <div class="modal fade" id="edit_unit<?= $units['id_unit']; ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="<?= base_url('adminaset/edit_unit/') . $units['id_unit']; ?>" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title h4" id="myLargeModalLabel">Edit Unit Yayasan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="floating-label">Nama Unit</label>
                                        <input type="hidden" name="id_unit" id="id_unit" value="<?= $units['id_unit']; ?>" autocomplete="off">
                                        <input type="text" class="form-control" id="nama_unit" name="nama_unit" placeholder="Nama Unit Yayasan" value="<?= $units['nama_unit']; ?>" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Kepala Unit</label>
                                        <select class="form-control select2" name="kepala_unit2" id="kepala_unit2<?= $units['id_unit']; ?>" style="width: 100%;">
                                            <option>Pilih Kepala Unit</option>
                                            <?php foreach ($pengguna as $users) : ?>
                                                <?php if ($units['kepala_unit_id'] == $users['id_pengguna']) : ?>
                                                    <?php if ($users['peran_id'] != 1) : ?>
                                                        <?php if ($users['peran_id'] == 4) : ?>
                                                            <option value="<?= $users['id_pengguna']; ?>" selected><?= $users['nama']; ?> | <?= $users['jabatan_pengguna']; ?></option>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                <?php else : ?>
                                                    <?php if ($users['peran_id'] != 1) : ?>
                                                        <?php if ($users['peran_id'] == 4) : ?>
                                                            <option value="<?= $users['id_pengguna']; ?>"><?= $users['nama']; ?> | <?= $users['jabatan_pengguna']; ?></option>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Sarpras Unit</label>
                                        <select class="form-control select2" name="sarpras_unit2" id="sarpras_unit2<?= $units['id_unit']; ?>" style="width: 100%;">
                                            <option>Pilih Sarpras Unit</option>
                                            <?php foreach ($pengguna as $users) : ?>
                                                <?php if ($units['sarpras_unit_id'] == $users['id_pengguna']) : ?>
                                                    <?php if ($users['peran_id'] != 1) : ?>
                                                        <?php if ($users['peran_id'] == 5) : ?>
                                                            <option value="<?= $users['id_pengguna']; ?>" selected><?= $users['nama']; ?> | <?= $users['jabatan_pengguna']; ?></option>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                <?php else : ?>
                                                    <?php if ($users['peran_id'] != 1) : ?>
                                                        <?php if ($users['peran_id'] == 5) : ?>
                                                            <option value="<?= $users['id_pengguna']; ?>"><?= $users['nama']; ?> | <?= $users['jabatan_pengguna']; ?></option>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn  btn-danger btn-sm" data-dismiss="modal">Keluar</button>
                        <button type="submit" class="btn  btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal Hapus -->
<?php foreach ($unit as $units) : ?>
    <div id="hapus_unit<?= $units['id_unit']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="hapus_unitTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hapus_unitTitle">Hapus Data Unit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="<?= base_url('adminaset/hapus_unit/') . $units['id_unit']; ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" value="<?= $units['id_unit']; ?>">
                        <div class="col-md-12">
                            <div class="alert alert-danger" role="alert">
                                <h4 class="alert-heading">Peringatan!!!</h4>
                                <p class="paragraf-unit1">Data Akan hilang permanen jika anda menekan tombol hapus.</p>
                                <p class="paragraf-unit2">Data <b><?= $units['nama_unit']; ?></b> digunakan pada :</p>
                                <div class="col-md-8">
                                    <div class="card card-warning text-dark">
                                        <div class="card-header">
                                            <h5>Unit <?= $units['nama_unit']; ?></h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    Jumlah data pada menu Sub Unit
                                                </div>
                                                <div class="col-md-4">
                                                    : <span><?= HitungData('inventory_sub_unit', 'unit_id', $units['id_unit']); ?></span> data.
                                                </div>
                                                <hr>
                                                <div class="col-md-8">
                                                    Jumlah data pada menu Aset
                                                </div>
                                                <div class="col-md-4">
                                                    : <span><?= HitungData('inventory_input_aset', 'aset_unit_id', $units['id_unit']); ?></span> data.
                                                </div>
                                                <hr>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <p class="mb-0 konfirmasi-unit1">
                                    Apakah anda akan tetap menghapus data Unit <strong><?= $units['nama_unit']; ?></strong> pada <?= $units['nama_gedung']; ?> ?</p>
                                <p class="mb-0 konfirmasi-unit2">
                                    Mohon data tersebut dihapus atau di mutasikan terlebih dahulu.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn  btn-secondary" data-dismiss="modal">Keluar</button>
                        <button type="submit" class="btn  btn-danger konfirmasi-hapus-unit">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>