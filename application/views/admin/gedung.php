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

                    <?php if (validation_errors()) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><?= validation_errors(); ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    <?php endif; ?>
                    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>

                    <div class="col-lg-6">
                        <div class="card card-lightblue shadow">
                            <div class="card-header">
                                <h5>Form Tambah Gedung</h5>
                            </div>
                            <form action="<?= base_url('admin/gedung'); ?>" method="post">
                                <div class="card-body">
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="floating-label">Nama Gedung Yayasan</label>
                                                    <input type="text" class="form-control" id="nama_gedung" name="nama_gedung" placeholder="Nama Gedung Yayasan" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-auto mr-auto">
                                            </div>
                                            <div class="col-auto">
                                                <button type="submit" class="btn btn-block bg-gradient-lightblue btn-sm"><i class="fas fa-plus-circle"></i> Tambah Gedung</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="card card-olive shadow ">
                            <div class="card-header">
                                <div class="row">
                                    <h5>Tabel <?= $title; ?></h5>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover" id="data_unit">
                                    <thead>
                                        <tr class="text-center" style="background-color: #17a2b8; color: azure">
                                            <th class="text-center">No</th>
                                            <th class="text-center">Nama Gedung</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($gedung as $g) : ?>
                                            <tr>
                                                <td class="text-center"><?= $no; ?></td>
                                                <td><?= $g['nama_gedung']; ?></td>
                                                <!-- <td><?= $g['ket_gedung']; ?></td> -->
                                                <td class="text-center">
                                                    <a href="#" class="badge bg-warning" data-toggle="modal" data-target=".edit_gedung<?= $g['id_gedung']; ?>"><i class="far fa-edit"></i> Edit
                                                    </a> |
                                                    <a href="#" class="badge bg-danger delete-gedung" data-toggle="modal" data-gedungid="<?= $g['id_gedung']; ?>" data-target="#hapus_gedung<?= $g['id_gedung']; ?>"><i class="far fa-trash-alt"></i> Hapus
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
    </section>
</div>

<!-- Modal Edit -->
<?php foreach ($gedung as $g) : ?>
    <div class="modal fade edit_gedung<?= $g['id_gedung']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="<?= base_url('admin/edit_gedung/') . $g['id_gedung']; ?>" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title h4" id="myLargeModalLabel">Edit Gedung Yayasan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-12">
                                    <input type="hidden" value="<?= $g['id_gedung']; ?>" name="id_gedung">
                                    <div class="form-group">
                                        <label class="floating-label">Nama Gedung</label>
                                        <input type="text" class="form-control" id="nama_gedung" name="nama_gedung" placeholder="Nama Gedung Yayasan" autocomplete="off" value="<?= $g['nama_gedung']; ?>">
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
<?php foreach ($gedung as $g) : ?>
    <div id="hapus_gedung<?= $g['id_gedung']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="hapus_gedungTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hapus_gedungTitle">Hapus Data Gedung</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                <form action="<?= base_url('admin/hapus_gedung/') . $g['id_gedung']; ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" value="<?= $g['id_gedung']; ?>" id="id_gudang1" name="id_gudang1">
                        <div class="col-md-12">
                            <div class="alert alert-danger" role="alert">
                                <h4 class="alert-heading">Peringatan!!!</h4>
                                <p class="paragraf-gedung1">Data Akan hilang permanen jika anda menekan tombol hapus.</p>
                                <p class="paragraf-gedung2">Data <b><?= $g['nama_gedung']; ?></b> digunakan pada :</p>
                                <div class="col-md-8">
                                    <div class="card card-warning text-dark">
                                        <div class="card-header">
                                            <h5><?= $g['nama_gedung']; ?></h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    Jumlah data pada menu Ruang
                                                </div>
                                                <div class="col-md-4">
                                                    : <span><?= HitungData('inventory_ruang', 'gedung_id', $g['id_gedung']); ?></span> data.
                                                </div>
                                                <hr>
                                                <div class="col-md-8">
                                                    Jumlah data pada menu Sub Unit
                                                </div>
                                                <div class="col-md-4">
                                                    : <span><?= HitungData('inventory_sub_unit', 'gedung_sub_unit_id', $g['id_gedung']); ?></span> data.
                                                </div>
                                                <hr>
                                                <div class="col-md-8">
                                                    Jumlah data pada menu Aset
                                                </div>
                                                <div class="col-md-4">
                                                    : <span><?= HitungData('inventory_input_aset', 'lokasi_gedung_id', $g['id_gedung']); ?></span> data.
                                                </div>
                                                <hr>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <p class="mb-0 konfirmasi-gedung1">
                                    Apakah anda akan tetap menghapus data <strong><?= $g['nama_gedung']; ?></strong> ?</p>
                                <p class="mb-0 konfirmasi-gedung2">
                                    Mohon data tersebut dihapus atau di mutasikan terlebih dahulu.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn  btn-secondary" data-dismiss="modal">Keluar</button>
                        <button type="submit" class="btn  btn-danger konfirmasi-hapus-gedung">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>