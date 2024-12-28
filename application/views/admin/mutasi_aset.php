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

                    <div class="card card-olive shadow">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-auto mr-auto">
                                    <h5>Tabel Aset</h5>
                                </div>
                                <div class="col-auto">
                                    <a href="<?= base_url('admin/input_aset'); ?>" type="button" class="btn  btn-block bg-gradient-dark btn-sm"><i class="fas fa-step-backward"></i> Kembali</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="data_aset">
                                <thead>
                                    <tr class="text-center" style="background-color: #17a2b8; color: azure">
                                        <th>No</th>
                                        <th>Nama Sarana</th>
                                        <th>Lokasi Aset</th>
                                        <th>Jumlah</th>
                                        <th>Harga Perolehan</th>
                                        <th>Total Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Hapus -->
<!-- <?php foreach ($input_aset as $ia) : ?>
    <div id="hapus_aset<?= $ia['id_input_aset']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="hapus_asetTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hapus_asetTitle">Hapus Data Pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="<?= base_url('admin/hapus_aset/') . $ia['id_input_aset']; ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" value="<?= $ia['id_input_aset']; ?>">
                        <input type="hidden" name="pic_id_edit" id="pic_id_edit" value="<?= $ia['pic_id']; ?>">
                        <div class="col-md-12">
                            <div class="alert alert-danger" role="alert">
                                <h4 class="alert-heading">Peringatan!!!</h4>
                                <p>Data Akan hilang selamanya jika anda menekan tombol hapus.</p>
                                <hr>
                                <p class="mb-0">
                                    Apakah anda akan tetap menghapus data aset <strong><?= $ia['nama_sarana']; ?></strong> yang berada di <strong><?= $ia['nama_gedung']; ?></strong>, Ruangan <strong><?= $ia['nama_ruang']; ?></strong>, pada Unit <strong><?= $ia['nama_unit']; ?></strong> Sub Unit <strong><?= $ia['nama_sub_unit']; ?></strong> ?</p>
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
<?php endforeach; ?> -->