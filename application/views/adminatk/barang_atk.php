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
                    <?php if (validation_errors()) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><?= validation_errors(); ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    <?php endif; ?>
                    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>


                    <div class="col-lg-8">
                        <div class="callout callout-danger">
                            <h5>Pemberitahuan!!</h5>

                            <p>Data barang ATK dibawah ini adalah barang dan harga yang telah disetujui pemerintah Kota Pasuruan. Jika barang yang dibutuhkan belum / tidak ada silahkan untuk menambahkan barang dengan fitur tambah barang.</p>
                        </div>
                    </div>
                    <!-- <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card card-outline card-lightblue shadow">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-auto mr-auto">
                                                <h5>Import Data Aset</h5>
                                                <a href="<?= base_url('assets/file_format/format_barang_atk.xlsx'); ?>" class="badge bg-info"> Download Format Import Aset</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <?= form_open_multipart('adminatk/UploadBarangATK'); ?>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="floating-label">Pilih File Format</label>
                                                    <div class="custom-file">
                                                        <div class="row">
                                                            <div class="col-md-10">
                                                                <input type="file" class="custom-file-input" id="import_data_aset" name="import_data_aset" accept=".xlsx, .xls">
                                                                <label class="custom-file-label" for="import_data_aset">Choose file</label>
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
                    </div> -->

                    <div class="col-lg-12">
                        <div class="card card-olive shadow ">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-auto mr-auto">
                                        <h5>Tabel <?= $title; ?></h5>
                                    </div>
                                    <div class="col-auto">
                                        <button type="button" class="btn bg-gradient-info btn-sm" data-toggle="modal" data-target=".tambah_atk"><i class="fas fa-plus-circle"></i> Tambah Barang ATK</button> |
                                        <a href="<?= base_url('adminatk/stokATK') ?>" class="btn bg-gradient-warning text-dark btn-sm"><i class="fas fa-database"></i> Stok ATK</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" id="data_unit">
                                        <thead>
                                            <tr class="text-center" style="background-color: #17a2b8; color: azure">
                                                <th class="text-center">Kode Barang</th>
                                                <th class="text-center">Nama Barang</th>
                                                <th class="text-center">Satuan Barang</th>
                                                <th class="text-center">Harga Satuan</th>
                                                <th class="text-center">Keterangan Barang</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($BarangATK as $atk) : ?>
                                                <tr>
                                                    <td class="text-center"><?= $atk['kode_barang']; ?></td>
                                                    <td><?= $atk['nama_barang']; ?></td>
                                                    <td class="text-center"><?= $atk['satuan_barang']; ?></td>
                                                    <td class="text-center"><?= buatRupiah($atk['satuan_harga']); ?></td>
                                                    <td class="text-center"><?= $atk['ket_barang']; ?></td>
                                                    <td class="text-center">
                                                        <a href="#" class="badge bg-warning" data-toggle="modal" data-target=".edit_atk<?= $atk['id_atk']; ?>" onclick="edit_satuan_brg(<?= $atk['id_atk']; ?>)"><i class="far fa-edit"></i> Edit
                                                        </a> | <a href="#" class="badge bg-danger delete-atk" data-toggle="modal" data-atkid="<?= $atk['id_atk']; ?>" data-target="#hapus_atk<?= $atk['id_atk']; ?>"><i class="far fa-trash-alt"></i> Hapus
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
        </div>
    </section>
</div>

<!-- Modal Insert -->
<div class="modal fade tambah_atk" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?= base_url('adminatk/atk'); ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel">Tambah Barang ATK</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="floating-label">Kode Barang</label>
                                    <input type="text" class="form-control" id="kode_barang" name="kode_barang" placeholder="Kode Barang" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="floating-label">Nama Barang</label>
                                    <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Nama Barang" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Satuan Barang</label>
                                    <select class="form-control select2" style="width: 100%;" id="satuan_barang" name="satuan_barang">
                                        <option value="">Pilih Satuan Barang</option>
                                        <?php foreach ($satuan_brg as $sb) : ?>
                                            <option value="<?= $sb; ?>"><?= $sb; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="floating-label">Harga Satuan</label>
                                    <input type="number" class="form-control" name="satuan_harga" placeholder="Harga Satuan" autocomplete="off">
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
<?php foreach ($BarangATK as $atk) : ?>
    <div class="modal fade edit_atk<?= $atk['id_atk']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="<?= base_url('adminatk/edit_atk/') . $atk['id_atk']; ?>" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title h4" id="myLargeModalLabel">Edit Unit Yayasan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="floating-label">Kode Barang</label>
                                        <input type="hidden" name="id_atk" id="id_atk" value="<?= $atk['id_atk']; ?>" autocomplete="off">
                                        <input type="text" class="form-control" id="kode_barang" name="kode_barang" placeholder="Kode Barang" value="<?= $atk['kode_barang']; ?>" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="floating-label">Nama Barang</label>
                                        <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Nama Barang" value="<?= $atk['nama_barang']; ?>" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="floating-label">Satuan Barang</label>
                                        <select class="form-control select2" id="satuan_barang1<?= $atk['id_atk']; ?>" name="satuan_barang1">
                                            <option value="">Pilih Satuan Barang</option>
                                            <?php foreach ($satuan_brg as $sb) : ?>
                                                <?php if ($atk['satuan_barang'] == $sb) : ?>
                                                    <option value="<?= $sb; ?>" selected><?= $sb; ?></option>
                                                <?php else : ?>
                                                    <option value="<?= $sb; ?>"><?= $sb; ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <?php if ($atk['ket_barang'] == 'bayhi') : ?>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="floating-label">Harga Satuan</label>
                                            <input type="number" class="form-control" id="satuan_harga" name="satuan_harga" placeholder="Harga Satuan" value="<?= $atk['satuan_harga']; ?>" autocomplete="off">
                                        </div>
                                    </div>
                                <?php elseif ($atk['ket_barang'] == 'pemerintah') : ?>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="floating-label">Harga Satuan</label>
                                            <input type="number" class="form-control" id="satuan_harga" name="satuan_harga" placeholder="Harga Satuan" value="<?= $atk['satuan_harga']; ?>" autocomplete="off" readonly>
                                        </div>
                                    </div>
                                <?php endif; ?>
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
<?php foreach ($BarangATK as $atk) : ?>
    <div id="hapus_atk<?= $atk['id_atk']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="hapus_atkTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hapus_atkTitle">Hapus Data Unit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="<?= base_url('adminatk/hapus_atk/') . $atk['id_atk']; ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" value="<?= $atk['id_atk']; ?>">
                        <div class="col-md-12">
                            <div class="alert alert-danger" role="alert">
                                <h4 class="alert-heading">Peringatan!!!</h4>
                                <p class="paragraf-atk1">Data Akan hilang permanen jika anda menekan tombol hapus.</p>
                                <p class="paragraf-atk2">Data <b><?= $atk['nama_barang']; ?></b> digunakan pada :</p>
                                <div class="col-md-8">
                                    <div class="card card-warning text-dark">
                                        <div class="card-header">
                                            <h5><?= $atk['nama_barang']; ?></h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    Jumlah data pada menu Pengajuan ATK
                                                </div>
                                                <div class="col-md-4">
                                                    : <span><?= HitungData('inventory_pengajuan_atk', 'atk_pengajuan_id', $atk['id_atk']); ?></span> data.
                                                </div>
                                                <hr>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <p class="mb-0 konfirmasi-atk1">
                                    Apakah anda akan tetap menghapus data ATK <strong><?= $atk['nama_barang']; ?></strong> pada Unit <strong><?= $atk['nama_barang']; ?></strong> ?</p>
                                <p class="mb-0 konfirmasi-atk2">
                                    Mohon data barang dihapus terlebih dahulu pada menu pengajuan barang ATK.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn  btn-secondary" data-dismiss="modal">Keluar</button>
                        <button type="submit" class="btn  btn-danger konfirmasi-hapus-atk">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>