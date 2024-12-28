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
                                    <button type="button" class="btn btn-block bg-gradient-dark btn-sm" data-toggle="modal" data-target=".tambah_ruang"><i class="fas fa-plus-circle"></i> Tambah Ruang</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="data_unit">
                                <thead>
                                    <tr class="text-center" style="background-color: #17a2b8; color: azure">
                                        <th>No</th>
                                        <th>Lokasi Gedung</th>
                                        <th>Nama Ruang</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($ruang as $ru) : ?>
                                        <tr>
                                            <td class="text-center"><?= $no; ?></td>
                                            <td><?= $ru['nama_gedung']; ?></td>
                                            <td><?= $ru['nama_ruang']; ?></td>
                                            <td class="text-center">
                                                <a href="#" class="badge bg-warning" data-toggle="modal" data-target=".edit_ruang<?= $ru['id_ruang']; ?>" onclick="edit_ruang(<?= $ru['id_ruang']; ?>)"><i class="far fa-edit"></i>Edit
                                                </a> | <a href="#" class="badge bg-danger delete-ruang" data-ruangid="<?= $ru['id_ruang']; ?>" data-toggle="modal" data-target="#hapus_ruang<?= $ru['id_ruang']; ?>"><i class="far fa-trash-alt"></i> Hapus
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

<!-- Modal Insert -->
<div class="modal fade tambah_ruang">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?= base_url('adminaset/ruang'); ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel">Tambah Ruang Yayasan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Gedung Yayasan</label>
                                    <select class="form-control select2" name="gedung_id" id="gedung_id" style="width: 100%;">
                                        <option>Pilih Gedung Yayasan</option>
                                        <?php foreach ($gedung as $ge) : ?>
                                            <option value="<?= $ge['id_gedung']; ?>"><?= $ge['nama_gedung']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="floating-label">Nama Ruang</label>
                                    <input type="text" class="form-control" id="nama_ruang" name="nama_ruang" placeholder="Nama Ruang Yayasan" autocomplete="off">
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
<?php foreach ($ruang as $ru) : ?>
    <div class="modal fade edit_ruang<?= $ru['id_ruang']; ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="<?= base_url('adminaset/edit_ruang/') . $ru['id_ruang']; ?>" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title h4" id="myLargeModalLabel">Edit Ruang Yayasan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="hidden" name="id_ruang" id="id_ruang" value="<?= $ru['id_ruang']; ?>">
                                        <label>Gedung Yayasan</label>
                                        <select class="form-control select2" name="gedung_id1" id="gedung_id1<?= $ru['id_ruang']; ?>" style="width: 100%;">
                                            <option>Pilih Gedung Yayasan</option>
                                            <?php foreach ($gedung as $ge) : ?>
                                                <?php if ($ru['gedung_id'] == $ge['id_gedung']) : ?>
                                                    <option value="<?= $ge['id_gedung']; ?>" selected><?= $ge['nama_gedung']; ?></option>
                                                <?php else : ?>
                                                    <option value="<?= $ge['id_gedung']; ?>"><?= $ge['nama_gedung']; ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="floating-label">Nama Ruang</label>
                                        <input type="text" class="form-control" id="nama_ruang" name="nama_ruang" placeholder="Nama Ruang Yayasan" autocomplete="off" value="<?= $ru['nama_ruang']; ?>">
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
<?php foreach ($ruang as $ru) : ?>
    <div id="hapus_ruang<?= $ru['id_ruang']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="hapus_ruangTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hapus_ruangTitle">Hapus Data Ruang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="<?= base_url('adminaset/hapus_ruang/') . $ru['id_ruang']; ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" value="<?= $ru['id_ruang']; ?>">
                        <div class="col-md-12">
                            <div class="alert alert-danger" role="alert">
                                <h4 class="alert-heading">Peringatan!!!</h4>
                                <p class="paragraf-ruang1">Data Akan hilang permanen jika anda menekan tombol hapus.</p>
                                <p class="paragraf-ruang2">Data <b><?= $ru['nama_ruang']; ?></b> digunakan pada :</p>
                                <div class="col-md-8">
                                    <div class="card card-warning text-dark">
                                        <div class="card-header">
                                            <h5><?= $ru['nama_ruang']; ?></h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    Jumlah data pada menu Sub Unit
                                                </div>
                                                <div class="col-md-4">
                                                    : <span><?= HitungData('inventory_sub_unit', 'ruang_sub_unit_id', $ru['id_ruang']); ?></span> data.
                                                </div>
                                                <hr>
                                                <div class="col-md-8">
                                                    Jumlah data pada menu Aset
                                                </div>
                                                <div class="col-md-4">
                                                    : <span><?= HitungData('inventory_input_aset', 'lokasi_ruang_id', $ru['id_ruang']); ?></span> data.
                                                </div>
                                                <hr>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <p class="mb-0 konfirmasi-ruang1">
                                    Apakah anda akan tetap menghapus data Ruang <strong><?= $ru['nama_ruang']; ?></strong> pada Unit <strong><?= $ru['nama_gedung']; ?></strong> ?</p>
                                <p class="mb-0 konfirmasi-ruang2">
                                    Mohon data tersebut dihapus atau di mutasikan terlebih dahulu.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn  btn-secondary" data-dismiss="modal">Keluar</button>
                        <button type="submit" class="btn  btn-danger konfirmasi-hapus-ruang">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>