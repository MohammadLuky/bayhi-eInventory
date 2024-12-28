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

                    <?php if (validation_errors()) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><?= validation_errors(); ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    <?php endif; ?>

                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card card-outline card-lightblue shadow">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-auto mr-auto">
                                                <h5>Import Data Pengguna</h5>
                                                <a href="<?= base_url('assets/file_format/format_pengguna.xlsx'); ?>" class="badge bg-info"> Download Format Import Pengguna</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <?= form_open_multipart('admin/UploadPengguna'); ?>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="floating-label">Pilih File Format</label>
                                                    <div class="custom-file">
                                                        <div class="row">
                                                            <div class="col-md-10">
                                                                <input type="file" class="custom-file-input" id="import_data_pengguna" name="import_data_pengguna" accept=".xlsx, .xls">
                                                                <label class="custom-file-label" for="import_data_pengguna">Choose file</label>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <button class="btn btn-info" type="submit">Upload</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?= form_close(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card card-outline card-olive">
                        <form action="<?= base_url('admin/manajemen_pengguna'); ?>" method="post">
                            <div class="card-header">
                                <h5>Input Pengguna</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="floating-label">Nama Pengguna</label>
                                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Pengguna" autocomplete="off" value="<?= set_value('nama'); ?>">
                                            <?= form_error('nama', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Peran Pengguna <a href="" class="badge badge-pill badge-success" data-toggle="modal" data-target=".tambah_peran"> Tambah Peran Pengguna</a> </label>
                                            <select class="form-control select2" name="peran_id" id="peran_id" style="width: 100%;">
                                                <option>Pilih Peran Pengguna</option>
                                                <?php foreach ($ket_peran as $kt) : ?>
                                                    <?php if ($kt['id_peran'] != 10) : ?>
                                                        <option value="<?= $kt['id_peran']; ?>"><?= $kt['peran']; ?> | <?= $kt['ket_peran']; ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="floating-label">Jabatan Pengguna</label>
                                            <input type="text" class="form-control" id="jabatan_pengguna" name="jabatan_pengguna" placeholder="Jabatan Pengguna" autocomplete="off" value="<?= set_value('jabatan_pengguna'); ?>">
                                            <?= form_error('jabatan_pengguna', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="floating-label">Username</label>
                                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" autocomplete="off" value="<?= set_value('username'); ?>">
                                            <?= form_error('username', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="floating-label">Password</label>
                                            <input type="password" class="form-control" id="password1" name="password1" placeholder="Password">
                                            <?= form_error('password1', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="floating-label">Verikasi Password</label>
                                            <input type="password" class="form-control" id="password2" name="password2" placeholder="Verifikasi Password">
                                            <?= form_error('password2', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-auto mr-auto"></div>
                                    <div class="col-auto">
                                        <button class="btn btn-info btn-sm" type="submit">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-olive shadow">
                        <div class="card-header">
                            <h5>Tabel Pengguna</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="data_unit">
                                <thead>
                                    <tr class="text-center" style="background-color: #17a2b8; color: azure">
                                        <th>No</th>
                                        <th>Nama Pengguna</th>
                                        <th>Peran</th>
                                        <th>Jabatan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($pengguna as $user) : ?>
                                        <?php if ($user['peran_id'] == 1) : ?>
                                            <tr>
                                                <td class="text-center"><?= $no; ?></td>
                                                <td><?= $user['nama']; ?></td>
                                                <td><?= $user['ket_peran']; ?></td>
                                                <td><?= $user['jabatan_pengguna']; ?></td>
                                                <td class="text-center">
                                                    <a href="#" class="badge bg-warning" data-toggle="modal" data-target=".edit_pengguna<?= $user['id_pengguna']; ?>" onclick="edit_peran(<?= $user['id_pengguna']; ?>)"><i class="far fa-edit"></i> Edit </a>
                                                </td>
                                            </tr>
                                        <?php elseif ($user['peran_id'] == 10) : ?>
                                            <tr style="background-color: crimson;" class="text-white">
                                                <td class="text-center"><?= $no; ?></td>
                                                <td><?= $user['nama']; ?></td>
                                                <td>Atur Role Pengguna</td>
                                                <td><?= $user['jabatan_pengguna']; ?></td>
                                                <td class="text-center">
                                                    <a href="#" class="badge bg-warning" data-toggle="modal" data-target=".edit_pengguna<?= $user['id_pengguna']; ?>" onclick="edit_peran(<?= $user['id_pengguna']; ?>)"><i class="far fa-edit"></i> Edit </a> |
                                                    <a href="#" class="badge bg-info" data-toggle="modal" data-target="#hapus_pengguna<?= $user['id_pengguna']; ?>"><i class="far fa-trash-alt"></i> Hapus
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php else : ?>
                                            <tr>
                                                <td class="text-center"><?= $no; ?></td>
                                                <td><?= $user['nama']; ?></td>
                                                <td><?= $user['ket_peran']; ?></td>
                                                <td><?= $user['jabatan_pengguna']; ?></td>
                                                <td class="text-center">
                                                    <a href="#" class="badge bg-warning" data-toggle="modal" data-target=".edit_pengguna<?= $user['id_pengguna']; ?>" onclick="edit_peran(<?= $user['id_pengguna']; ?>)"><i class="far fa-edit"></i> Edit
                                                    </a> | <a href="#" class="badge bg-danger" data-toggle="modal" data-target="#hapus_pengguna<?= $user['id_pengguna']; ?>"><i class="far fa-trash-alt"></i> Hapus
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



<!-- Modal Edit -->
<?php foreach ($pengguna as $user) : ?>
    <div class="modal fade edit_pengguna<?= $user['id_pengguna']; ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="<?= base_url('admin/edit_pengguna/') . $user['id_pengguna']; ?>" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title h4" id="myLargeModalLabel">Edit Pengguna Akun</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="floating-label">Nama Pengguna</label>
                                        <input type="hidden" value="<?= $user['id_pengguna']; ?>" name="id_pengguna">
                                        <input type="text" class="form-control" id="nama_edit" name="nama_edit" placeholder="Nama Pengguna" autocomplete="off" value="<?= $user['nama']; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Peran Pengguna</label>
                                        <select class="form-control select2" name="peran_id1" id="peran_id1<?= $user['id_pengguna']; ?>" style="width: 100%;">
                                            <option>Pilih Peran Pengguna</option>
                                            <?php foreach ($ket_peran as $kt) : ?>
                                                <?php if ($user['peran_id'] == $kt['id_peran']) : ?>
                                                    <option value="<?= $kt['id_peran']; ?>" selected><?= $kt['peran']; ?> | <?= $kt['ket_peran']; ?></option>
                                                <?php else : ?>
                                                    <option value="<?= $kt['id_peran']; ?>"><?= $kt['peran']; ?> | <?= $kt['ket_peran']; ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="floating-label">Jabatan Pengguna</label>
                                        <input type="hidden" value="<?= $user['id_pengguna']; ?>" name="id_pengguna">
                                        <input type="text" class="form-control" id="jabatan_pengguna_edit" name="jabatan_pengguna_edit" placeholder="Jabatan Pengguna" autocomplete="off" value="<?= $user['jabatan_pengguna']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="floating-label">Username</label>
                                        <input type="text" class="form-control" placeholder="Username" autocomplete="off" value="<?= $user['username']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="floating-label">Password</label>
                                        <input type="text" class="form-control" placeholder="Password" value="<?= $user['pass_tampil']; ?>" readonly>
                                    </div>
                                </div>
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
<?php foreach ($pengguna as $user) : ?>
    <div id="hapus_pengguna<?= $user['id_pengguna']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="hapus_penggunaTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hapus_penggunaTitle">Hapus Data Pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="<?= base_url('admin/hapus_pengguna/') . $user['id_pengguna']; ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" value="<?= $user['id_pengguna']; ?>">
                        <div class="col-md-12">
                            <div class="alert alert-danger" role="alert">
                                <h4 class="alert-heading">Peringatan!!!</h4>
                                <p>Data Akan hilang selamanya jika anda menekan tombol hapus.</p>
                                <hr>
                                <p class="mb-0">
                                    Apakah anda akan tetap menghapus pengguna <strong><?= $user['nama']; ?></strong> ?</p>
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

<div class="modal fade tambah_peran" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?= base_url('admin/tambah_peran'); ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel">Tambah Peran Pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="floating-label">Peran</label>
                                <input type="text" class="form-control" id="peran" name="peran" placeholder="Peran" autocomplete="off" value="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="floating-label">Keterangan Peran</label>
                                <input type="text" class="form-control" id="ket_peran" name="ket_peran" placeholder="Keterangan Peran" autocomplete="off" value="">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Tabel Pengguna</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered" id="data_peran">
                                            <thead>
                                                <tr class="text-center">
                                                    <th scope="col">ID Peran</th>
                                                    <th scope="col">Peran</th>
                                                    <th scope="col">Ket Peran</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($ket_peran as $kp) : ?>
                                                    <tr>
                                                        <td class="text-center"><?= $kp['id_peran']; ?></td>
                                                        <td><?= $kp['peran']; ?></td>
                                                        <td><?= $kp['ket_peran']; ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
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