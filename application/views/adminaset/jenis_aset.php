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
                    <!-- <?= $this->session->flashdata('message'); ?> -->

                    <div class="card card-olive shadow">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-auto mr-auto">
                                    <h5>Tabel <?= $title; ?></h5>
                                </div>
                                <div class="col-auto">
                                    <button type="button" class="btn btn-block bg-gradient-dark btn-sm" data-toggle="modal" data-target=".tambah_jenis_aset"><i class="fas fa-plus-circle"></i></i> Tambah Jenis Aset</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="data_unit">
                                    <thead>
                                        <tr class="text-center" style="background-color: #17a2b8; color: azure">
                                            <th>Kode Aset</th>
                                            <th>Jenis Aset</th>
                                            <th>Kelompok Aset</th>
                                            <th>Umur Aset</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($jenis_aset as $ja) : ?>
                                            <tr>
                                                <td class="text-center"><?= $ja['kode_aset']; ?></td>
                                                <td><?= $ja['jenis_aset']; ?></td>
                                                <td><?= $ja['nama_kelompok']; ?></td>
                                                <td><?= $ja['umur_aset']; ?> Tahun</td>
                                                <td class="text-center">
                                                    <a href="#" class="badge bg-warning" data-toggle="modal" data-target=".edit_jenis_aset<?= $ja['id_jenis']; ?>" onclick="edit_jenis_aset(<?= $ja['id_jenis']; ?>)"><i class="far fa-edit"></i></i> Edit
                                                    </a> | <a href="#" class="badge bg-danger delete-jenis" data-jenisid="<?= $ja['id_jenis']; ?>" data-toggle="modal" data-target="#hapus_jenis_aset<?= $ja['id_jenis']; ?>"><i class="far fa-trash-alt"></i> Hapus
                                                    </a>
                                                </td>
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
    </section>
</div>

<!-- Modal Insert -->
<div class="modal fade tambah_jenis_aset">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?= base_url('adminaset/jenis_aset'); ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel">Tambah Jenis Aset</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Kelompok Aset</label>
                                    <select class="form-control select2" name="kelompok_id" id="kelompok_id" style="width: 100%;">
                                        <option>Pilih Kelompok Aset</option>
                                        <?php foreach ($kelompok as $kel) : ?>
                                            <option value="<?= $kel['id_kelompok']; ?>"><?= $kel['nama_kelompok']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="floating-label">Kode Aset</label>
                                    <input type="text" class="form-control" id="kode_aset" name="kode_aset" placeholder="Kode Aset" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="floating-label">Jenis Aset</label>
                                    <input type="text" class="form-control" id="jenis_aset" name="jenis_aset" placeholder="Jenis Aset" autocomplete="off">
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

<!-- Modal Edit -->
<?php foreach ($jenis_aset as $ja) : ?>
    <div class="modal fade edit_jenis_aset<?= $ja['id_jenis']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="<?= base_url('adminaset/edit_jenis_aset/') . $ja['id_jenis']; ?>" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title h4" id="myLargeModalLabel">Edit Jenis Aset</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="hidden" name="id_jenis" id="id_jenis" value="<?= $ja['id_jenis']; ?>">
                                        <label>Kelompok Aset</label>
                                        <select class="form-control select2" name="kelompok_id1" id="kelompok_id1<?= $ja['id_jenis']; ?>" style="width: 100%;">
                                            <option>Pilih Kelompok Aset</option>
                                            <?php foreach ($kelompok as $kel) : ?>
                                                <?php if ($ja['kelompok_id'] == $kel['id_kelompok']) : ?>
                                                    <option value="<?= $kel['id_kelompok']; ?>" selected><?= $kel['nama_kelompok']; ?></option>
                                                <?php else : ?>
                                                    <option value="<?= $kel['id_kelompok']; ?>"><?= $kel['nama_kelompok']; ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="floating-label">Kode Aset</label>
                                        <input type="text" class="form-control" id="kode_aset" name="kode_aset" placeholder="Kode Aset" autocomplete="off" value="<?= $ja['kode_aset']; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="floating-label">Jenis Aset</label>
                                        <input type="text" class="form-control" id="jenis_aset" name="jenis_aset" placeholder="Nama Sub Unit Yayasan" autocomplete="off" value="<?= $ja['jenis_aset']; ?>">
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
<?php foreach ($jenis_aset as $ja) : ?>
    <div id="hapus_jenis_aset<?= $ja['id_jenis']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="hapus_jenis_asetTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hapus_jenis_asetTitle">Hapus Jenis Aset</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="<?= base_url('adminaset/hapus_jenis_aset/') . $ja['id_jenis']; ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" value="<?= $ja['id_jenis']; ?>">
                        <div class="col-md-12">
                            <div class="alert alert-danger" role="alert">
                                <h4 class="alert-heading">Peringatan!!!</h4>
                                <p class="paragraf-jenis1">Data Akan hilang permanen jika anda menekan tombol hapus.</p>
                                <p class="paragraf-jenis2">Data <b><?= $ja['jenis_aset']; ?></b> digunakan pada :</p>
                                <div class="col-md-8">
                                    <div class="card card-lightblue text-dark">
                                        <div class="card-header">
                                            <h5><?= $ja['jenis_aset']; ?></h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    Jumlah data pada menu Aset
                                                </div>
                                                <div class="col-md-4">
                                                    : <span><?= HitungData('inventory_input_aset', 'jenis_aset_id', $ja['id_jenis']); ?></span> data.
                                                </div>
                                                <hr>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <p class="mb-0 konfirmasi-jenis1">
                                    Apakah anda akan tetap menghapus data <strong><?= $ja['jenis_aset']; ?></strong> pada <strong><?= $ja['nama_kelompok']; ?></strong> ?
                                </p>
                                <p class="mb-0 konfirmasi-jenis2">
                                    Mohon data tersebut dihapus terlebih dahulu.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn  btn-secondary" data-dismiss="modal">Keluar</button>
                        <button type="submit" class="btn  btn-danger konfirmasi-hapus-jenis">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>