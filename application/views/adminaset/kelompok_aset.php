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
                                    <button type="button" class="btn btn-block bg-gradient-dark btn-sm" data-toggle="modal" data-target=".tambah_kelompok"><i class="fas fa-plus-circle"></i></i> Tambah Kelompok Aset</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="data_unit" style="width: 100%;">
                                <thead>
                                    <tr class="text-center" style="background-color: #17a2b8; color: azure">
                                        <th>No</th>
                                        <th>Nama Kelompok</th>
                                        <th>Umur Aset</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($kelompok as $kel) : ?>
                                        <tr>
                                            <td class="text-center"><?= $no; ?></td>
                                            <td><?= $kel['nama_kelompok']; ?></td>
                                            <td><?= $kel['umur_aset']; ?> Tahun</td>
                                            <td class="text-center">
                                                <a href="#" class="badge bg-warning" data-toggle="modal" data-target=".edit_kelompok<?= $kel['id_kelompok']; ?>"><i class="far fa-edit"></i></i> Edit
                                                </a> | <a href="#" class="badge bg-danger delete-kelompok" data-kelompokid="<?= $kel['id_kelompok']; ?>" data-toggle="modal" data-target="#hapus_kelompok<?= $kel['id_kelompok']; ?>"><i class="far fa-trash-alt"></i> Hapus
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
<div class="modal fade tambah_kelompok" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?= base_url('adminaset/kelompok_aset'); ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel">Tambah Kelompok Aset</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="floating-label">Nama Kelompok Aset</label>
                                    <input type="text" class="form-control" id="nama_kelompok" name="nama_kelompok" placeholder="Nama Kelompok Aset" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="floating-label">Umur Aset</label>
                                    <input type="number" class="form-control" id="umur_aset" name="umur_aset" placeholder="Umur Aset" autocomplete="off">
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
<?php foreach ($kelompok as $kel) : ?>
    <div class="modal fade edit_kelompok<?= $kel['id_kelompok']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="<?= base_url('adminaset/edit_kelompok_aset/') . $kel['id_kelompok']; ?>" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title h4" id="myLargeModalLabel">Edit Kelompok Aset</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="floating-label">Nama Kelompok Aset</label>
                                        <input type="hidden" name="id_kelompok" id="id_kelompok" value="<?= $kel['id_kelompok']; ?>" autocomplete="off">
                                        <input type="text" class="form-control" id="nama_kelompok" name="nama_kelompok" placeholder="Nama Unit Yayasan" value="<?= $kel['nama_kelompok']; ?>" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="floating-label">Umur Aset</label>
                                        <input type="number" class="form-control" id="umur_aset" name="umur_aset" placeholder="(Optional)" value="<?= $kel['umur_aset']; ?>" autocomplete="off">
                                    </div>
                                </div>
                                <!-- <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="floating-label">Keterangan</label>
                                        <input type="text" class="form-control" id="ket" name="ket" placeholder="(Optional)" value="<?= $kel['ket']; ?>" autocomplete="off">
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
<?php foreach ($kelompok as $kel) : ?>
    <div id="hapus_kelompok<?= $kel['id_kelompok']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="hapus_kelompokTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hapus_kelompokTitle">Hapus Data Kelompok Aset</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="<?= base_url('adminaset/hapus_kelompok/') . $kel['id_kelompok']; ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" value="<?= $kel['id_kelompok']; ?>">
                        <div class="col-md-12">
                            <div class="alert alert-danger" role="alert">
                                <h4 class="alert-heading">Peringatan!!!</h4>
                                <p class="paragraf-kelompok1">Data Akan hilang permanen jika anda menekan tombol hapus.</p>
                                <p class="paragraf-kelompok2">Data <b><?= $kel['nama_kelompok']; ?></b> digunakan pada :</p>
                                <div class="col-md-8">
                                    <div class="card card-lightblue text-dark">
                                        <div class="card-header">
                                            <h5><?= $kel['nama_kelompok']; ?></h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    Jumlah data pada menu Jenis Aset
                                                </div>
                                                <div class="col-md-4">
                                                    : <span><?= HitungData('inventory_jenis_aset', 'kelompok_id', $kel['id_kelompok']); ?></span> data.
                                                </div>
                                                <hr>
                                                <div class="col-md-8">
                                                    Jumlah data pada menu Aset
                                                </div>
                                                <div class="col-md-4">
                                                    : <span><?= HitungData('inventory_input_aset', 'jenis_kelompok_id', $kel['id_kelompok']); ?></span> data.
                                                </div>
                                                <hr>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <p class="mb-0 konfirmasi-kelompok1">
                                    Apakah anda akan tetap menghapus data <strong><?= $kel['nama_kelompok']; ?></strong> ?
                                </p>
                                <p class="mb-0 konfirmasi-kelompok2">
                                    Mohon data tersebut dihapus terlebih dahulu.
                                </p>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn  btn-secondary" data-dismiss="modal">Keluar</button>
                        <button type="submit" class="btn  btn-danger konfirmasi-hapus-kelompok">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>