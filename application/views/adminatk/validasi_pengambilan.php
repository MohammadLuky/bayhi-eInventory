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
                        <li class="breadcrumb-item"><a href="<?= base_url('adminatk'); ?>">Home</a></li>
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

                    <div class="col-lg-5">
                        <div class="card card-lightblue shadow">
                            <div class="card-header">
                                <h5>Filterisasi</h5>
                            </div>
                            <div class="card-body">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="floating-label">
                                            <h5>Filterisasi Unit</h5>
                                        </label>
                                        <select class="form-control select2" name="filterPengambilanATKUnit" id="filterPengambilanATKUnit" style="width: 100%;">
                                            <option value="0">Pilih Unit</option>
                                            <?php foreach ($DataUnit as $unit) : ?>
                                                <option value="<?= $unit['id_unit']; ?>"><?= $unit['nama_unit']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php if (validation_errors()) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><?= validation_errors(); ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    <?php endif; ?>
                    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>

                    <div class="col-lg-12">
                        <div class="card card-olive shadow ">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-auto mr-auto">
                                        <h5>Tabel <?= $title; ?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="callout callout-info col-lg-6">
                                    <div class="form-group row col-lg-12">
                                        <label class="col-sm-4 col-form-label">Cari Barang ATK :</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="searchInput" placeholder="Ketik Nama Barang ATK">
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-bordered table-hover" id="TabelPengambilanATK" style="width: 100%;">
                                    <thead>
                                        <tr class="text-center" style="background-color: #17a2b8; color: azure">
                                            <th class="text-center align-middle" style="width: 10%;">Aksi</th>
                                            <th class="text-center align-middle" style="width: 8%;">Tahun Periode</th>
                                            <th class="text-center align-middle" style="width: 14%;">Tanggal Pengambilan</th>
                                            <th class="text-center align-middle" style="width: 16%;">Nama Unit</th>
                                            <th class="text-center align-middle" style="width: 16%;">Nama Barang ATK</th>
                                            <th class="text-center align-middle" style="width: 10%;">Jumlah Pengambilan ATK</th>
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
        </div>
    </section>
</div>

<?php foreach ($DataPengambilanATK as $pengambilanATK) : ?>
    <div id="ajukan_pengambilanATK<?= $pengambilanATK['id_pengambilan']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ajukan_pengambilanATK" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title" id="ajukan_pengambilanATK">Pengajuan Pengambilan Barang ATK</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="<?= base_url('adminatk/approve_pengambilanATK/') . $pengambilanATK['id_pengambilan']; ?>" method="post">
                    <input type="hidden" class="form-control" id="id_unit_pengambilan" name="id_unit_pengambilan" value="<?= $pengambilanATK['id_pengambilan']; ?>">
                    <div class="modal-body">
                        <input type="hidden" value="<?= $pengambilanATK['id_pengambilan']; ?>">
                        <input type="hidden" name="id_pengambilan" id="id_pengambilan" value="<?= $pengambilanATK['id_pengambilan']; ?>">
                        <div class="col-md-12">
                            <div class="alert alert-info" role="alert">
                                <h4 class="alert-heading">Peringatan!!!</h4>
                                <p class="mb-0">
                                    Apakah anda akan tetap mengajukan pengambilan barang <strong><?= $pengambilanATK['nama_barang']; ?></strong> yang berjumlah <strong><?= $pengambilanATK['jumlah_pengambilan_atk']; ?></strong> <strong><?= $pengambilanATK['satuan_atk_pengambilan']; ?></strong> pada <strong><?= $pengambilanATK['nama_unit']; ?></strong> ?
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn  btn-secondary" data-dismiss="modal">Keluar</button>
                        <button type="submit" class="btn  btn-danger">Ajukan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>