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
                    <!-- <?= $this->session->flashdata('message'); ?> -->

                    <div class="card card-olive shadow">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-auto mr-auto">
                                    <h5>Tabel <?= $title; ?></h5>
                                </div>
                                <div class="col-auto">
                                    <button type="button" class="btn btn-block bg-gradient-dark btn-sm" data-toggle="modal" data-target="#tambah_sub_unit"><i class="fas fa-plus-circle"></i> Tambah Sub Unit</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="data_unit">
                                <thead>
                                    <tr class="text-center" style="background-color: #17a2b8; color: azure">
                                        <th>No</th>
                                        <th>Gedung dan Ruang</th>
                                        <th>Lokasi Unit</th>
                                        <th>Nama Sub Unit</th>
                                        <th>PIC Sub Unit</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($sub_unit as $sub) : ?>
                                        <tr>
                                            <td class="text-center"><?= $no; ?></td>
                                            <td><?= $sub['nama_gedung']; ?> | <?= $sub['nama_ruang']; ?></td>
                                            <td><?= $sub['nama_unit']; ?></td>
                                            <td><?= $sub['nama_sub_unit']; ?></td>
                                            <td><?= $sub['nama']; ?></td>
                                            <td class="text-center">
                                                <a href="#" class="badge bg-warning" data-toggle="modal" data-target="#edit_sub_unit<?= $sub['id_sub_unit']; ?>" onclick="edit_sub_unit(<?= $sub['id_sub_unit']; ?>)"><i class="far fa-edit"></i></i> Edit
                                                </a> | <a href="#" class="badge bg-danger delete-subunit" data-subunitid="<?= $sub['id_sub_unit']; ?>" data-toggle="modal" data-target="#hapus_sub_unit<?= $sub['id_sub_unit']; ?>"><i class="far fa-trash-alt"></i> Hapus
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
    </section>
</div>

<div class="modal fade" id="tambah_sub_unit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?= base_url('admin/sub_unit'); ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Sub Unit Yayasan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Ruang</label>
                                    <select class="form-control select2" style="width: 100%;" name="ruang_sub_unit" id="ruang_sub_unit">
                                        <option value="">Pilih Ruang</option>
                                        <?php foreach ($ruang as $ruangs) : ?>
                                            <option value="<?= $ruangs['id_ruang']; ?>" data-text="<?= $ruangs['gedung_id']; ?>"><?= $ruangs['nama_gedung']; ?> | <?= $ruangs['nama_ruang']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <input type="hidden" name="ruang_sub_unit_text" id="ruang_sub_unit_text">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Unit Yayasan</label>
                                    <select class="form-control select2" name="unit_id" id="unit_id" style="width: 100%;">
                                        <option value="">Pilih Unit Yayasan</option>
                                        <?php foreach ($unit as $units) : ?>
                                            <option value="<?= $units['id_unit']; ?>">
                                                <?= $units['nama_unit']; ?> ||
                                                <?php foreach ($pengguna as $user) : ?>
                                                    <?php if ($units['kepala_unit_id'] == $user['id_pengguna']) : ?>
                                                        <?= $user['nama']; ?>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </option>
                                        <?php endforeach; ?>
                                        <!-- <?php foreach ($unit as $units) : ?>
                                            <option value="<?= $units['id_unit']; ?>" data-picsubunit="<?= $units['nama']; ?>" data-idpicsubunit="<?= $units['sarpras_unit_id']; ?>"><?= $units['nama_unit']; ?></option>
                                        <?php endforeach; ?> -->
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>PIC Sub Unit</label>
                                    <select class="form-control select2" name="pic_subunit" id="pic_subunit" style="width: 100%;">
                                        <option value="">Pilih PIC Sub Unit</option>
                                        <?php foreach ($pengguna as $users) : ?>
                                            <?php if ($users['peran_id'] != 1) : ?>
                                                <?php if ($users['peran_id'] == 5) : ?>
                                                    <option value="<?= $users['id_pengguna']; ?>"><?= $users['nama']; ?> | <?= $users['jabatan_pengguna']; ?></option>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                    <!-- <label class="floating-label">PIC Sub Unit</label>
                                    <input type="hidden" class="form-control" id="IDpic_subunit" name="IDpic_subunit" readonly>
                                    <input type="text" class="form-control" id="pic_subunit_1" name="pic_subunit_1" placeholder="PIC Sub Unit Yayasan" autocomplete="off" readonly> -->
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="floating-label">Nama Sub Unit</label>
                                    <input type="text" class="form-control" id="nama_sub_unit" name="nama_sub_unit" placeholder="Nama Sub Unit Yayasan" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<?php foreach ($sub_unit as $sub) : ?>
    <div class="modal fade" id="edit_sub_unit<?= $sub['id_sub_unit']; ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="<?= base_url('admin/edit_sub_unit/') . $sub['id_sub_unit']; ?>" method="post">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Sub Unit Yayasan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="hidden" name="id_sub_unit" id="id_sub_unit" value="<?= $sub['id_sub_unit']; ?>">
                                        <label>Ruang</label>
                                        <select class="form-control select2" style="width: 100%;" name="ruang_sub_unit1" id="ruang_sub_unit1<?= $sub['id_sub_unit']; ?>" disabled>
                                            <option>Pilih Ruang</option>
                                            <?php foreach ($ruang as $ruangs) : ?>
                                                <?php if ($sub['ruang_sub_unit_id'] == $ruangs['id_ruang']) : ?>
                                                    <option value="<?= $ruangs['id_ruang']; ?>" data-text="<?= $ruangs['gedung_id']; ?>" selected><?= $ruangs['nama_gedung']; ?> | <?= $ruangs['nama_ruang']; ?></option>
                                                <?php else : ?>
                                                    <option value="<?= $ruangs['id_ruang']; ?>" data-text="<?= $ruangs['gedung_id']; ?>"><?= $ruangs['nama_gedung']; ?> | <?= $ruangs['nama_ruang']; ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                        <input type="hidden" name="ruang_sub_unit1_text" id="ruang_sub_unit1_text<?= $sub['id_sub_unit']; ?>" value="<?= $sub['gedung_id']; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Unit Yayasan</label>
                                        <select class="form-control select2" name="unit_id1" id="unit_id1<?= $sub['id_sub_unit']; ?>" style="width: 100%;" disabled>
                                            <option>Pilih Unit Yayasan</option>
                                            <?php foreach ($unit as $units) : ?>
                                                <?php if ($sub['unit_id'] == $units['id_unit']) : ?>
                                                    <option value="<?= $units['id_unit']; ?>" selected><?= $units['nama_unit']; ?></option>
                                                <?php else : ?>
                                                    <option value="<?= $units['id_unit']; ?>"><?= $units['nama_unit']; ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>PIC Sub Unit</label>
                                        <select class="form-control select2" name="pic_subunit1" id="pic_subunit1<?= $sub['id_sub_unit']; ?>" style="width: 100%;">
                                            <option>Pilih PIC Sub Unit</option>
                                            <?php foreach ($pengguna as $users) : ?>
                                                <?php if ($sub['subunit_pic_id'] == $users['id_pengguna']) : ?>
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
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="floating-label">Nama Sub Unit</label>
                                        <input type="text" class="form-control" id="nama_sub_unit" name="nama_sub_unit" placeholder="Nama Sub Unit Yayasan" autocomplete="off" value="<?= $sub['nama_sub_unit']; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Keluar</button>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal Hapus -->
<?php foreach ($sub_unit as $sub) : ?>
    <div id="hapus_sub_unit<?= $sub['id_sub_unit']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="hapus_sub_unitTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hapus_sub_unitTitle">Hapus Data Sub Unit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="<?= base_url('admin/hapus_sub_unit/') . $sub['id_sub_unit']; ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" value="<?= $sub['id_sub_unit']; ?>">
                        <div class="col-md-12">
                            <div class="alert alert-danger" role="alert">
                                <h4 class="alert-heading">Peringatan!!!</h4>
                                <p class="paragraf-subunit1">Data Akan hilang permanen jika anda menekan tombol hapus.</p>
                                <p class="paragraf-subunit2">Data <b><?= $sub['nama_sub_unit']; ?></b> digunakan pada :</p>
                                <div class="col-md-8">
                                    <div class="card card-warning text-dark">
                                        <div class="card-header">
                                            <h5><?= $sub['nama_sub_unit']; ?></h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    Jumlah data pada menu Aset
                                                </div>
                                                <div class="col-md-4">
                                                    : <span><?= HitungData('inventory_input_aset', 'aset_sub_unit_id', $sub['id_sub_unit']); ?></span> data.
                                                </div>
                                                <hr>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <p class="mb-0 konfirmasi-subunit1">
                                    Apakah anda akan tetap menghapus data Sub Unit <strong><?= $sub['nama_sub_unit']; ?></strong> pada Unit <strong><?= $sub['nama_unit']; ?></strong> Ruang <strong><?= $sub['nama_ruang']; ?></strong> Gedung <strong><?= $sub['nama_gedung']; ?></strong>?</p>
                                <p class="mb-0 konfirmasi-subunit2">
                                    Mohon data tersebut dihapus atau di mutasikan terlebih dahulu.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn  btn-secondary" data-dismiss="modal">Keluar</button>
                        <button type="submit" class="btn  btn-danger konfirmasi-hapus-subunit">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>