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
            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
            <div class="flash-data-wrong" data-flashdata="<?= $this->session->flashdata('message_password'); ?>"></div>
            <div class="flash-data-ok" data-flashdata="<?= $this->session->flashdata('message_password_ok'); ?>"></div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card card-outline card-olive">
                        <?= form_open_multipart('admin/profil_pengguna'); ?>
                        <div class="card-header">
                            <h5>Edit Profil Pengguna</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="floating-label">Nama Pengguna</label>
                                        <input type="text" class="form-control" id="nama_profil" name="nama_profil" value="<?= $peran['nama']; ?>">
                                        <?= form_error('nama_profil', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="floating-label">Peran Pengguna</label>
                                        <?php foreach ($ket_peran as $kt) : ?>
                                            <?php if ($peran['peran_id'] == $kt['id_peran']) : ?>
                                                <input type="text" value="<?= $kt['ket_peran']; ?>" class="form-control" readonly>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="floating-label">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" value="<?= $peran['username']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="floating-label">Password Aktif</label>
                                        <input type="text" class="form-control" id="password" name="password" value="<?= $peran['pass_tampil']; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="floating-label col-sm-3">Gambar</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <img src="<?= base_url('assets/images/user/') . $peran['img']; ?>" class="img-thumbnail">
                                        </div>
                                    </div>
                                    </br>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="image" name="image">
                                                <label class="custom-file-label" for="image">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-auto mr-auto"></div>
                                <div class="col-auto">
                                    <button class="btn btn-info btn-sm" type="submit">Ubah Profil</button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-outline card-olive">
                        <div class="card-header">
                            <h5>Edit Password Pengguna</h5>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('admin/ubah_password'); ?>" method="post">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label">Password Sekarang</label>
                                            <input type="password" class="form-control" id="pass_sekarang" name="pass_sekarang" placeholder="Password">
                                            <?= form_error('pass_sekarang', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label">Password Baru</label>
                                            <input type="password" class="form-control" id="pass_new1" name="pass_new1" placeholder="Password">
                                            <?= form_error('pass_new1', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label">Konfirmasi Password Baru</label>
                                            <input type="password" class="form-control" id="pass_new2" name="pass_new2" placeholder="Verifikasi Password">
                                            <?= form_error('pass_new2', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-auto mr-auto"></div>
                                    <div class="col-auto">
                                        <button class="btn btn-info btn-sm" type="submit">Ubah Password</button>
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