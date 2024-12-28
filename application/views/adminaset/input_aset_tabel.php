<div class="content-wrapper">
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
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>

                    <div class="col-lg-5">
                        <div class="card card-lightblue shadow">
                            <div class="card-header">
                                <h5>Filterisasi</h5>
                            </div>
                            <div class="card-body">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="floating-label">
                                            <h5>Filterisasi Sub Unit</h5>
                                        </label>
                                        <select class="form-control" name="filter_subUnit" id="filter_subUnit" style="width: 100%;">
                                            <option value="0">Pilih Sub Unit</option>
                                            <?php foreach ($sub_unit as $sb) : ?>
                                                <option value="<?= $sb['id_sub_unit']; ?>"><?= $sb['nama_unit']; ?> || <?= $sb['nama_sub_unit']; ?> - <?= $sb['nama_ruang']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="card card-olive shadow">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-auto mr-auto">
                                        <h5>Tabel Aset</h5>
                                    </div>
                                    <div class="col-auto">
                                        <a href="<?= base_url('adminaset/input_aset'); ?>" type="button" class="btn  btn-block bg-gradient-dark btn-sm"><i class="fas fa-step-backward"></i> Kembali</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="callout callout-info col-lg-6">
                                    <div class="form-group row col-lg-12">
                                        <label class="col-sm-4 col-form-label">Cari Aset :</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="searchInput" placeholder="Ketik Nama Aset">
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-bordered table-hover" id="TabelHasilInput" style="width: 100%;">
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
        </div>
    </section>
</div>

<!-- Modal Hapus -->
<?php foreach ($input_aset as $ia) : ?>
    <div id="hapus_aset<?= $ia['id_input_aset']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="hapus_asetTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hapus_asetTitle">Hapus Data Aset</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="<?= base_url('adminaset/hapus_aset/') . $ia['id_input_aset']; ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" value="<?= $ia['id_input_aset']; ?>">
                        <input type="hidden" name="pic_id_edit" id="pic_id_edit" value="<?= $ia['pic_id']; ?>">
                        <div class="col-md-12">
                            <div class="alert alert-danger" role="alert">
                                <h4 class="alert-heading">Peringatan!!!</h4>
                                <?php $jumlahcekaset = HitungData('inventory_kondisi_aset', 'aset_id', $ia['id_input_aset']);
                                if ($jumlahcekaset == 0) : ?>
                                    <span>Data tersebut akan hilang permanen jika anda menekan tombol hapus.</span>
                                    <hr>
                                <?php else : ?>
                                    <p>Data aset <b><?= $ia['nama_sarana']; ?></b> memiliki <b>riwayat <?= $jumlahcekaset; ?> kali pengecekan.</b></p>
                                    <span>Data tersebut akan hilang permanen jika anda menekan tombol hapus.</span>
                                    <hr>
                                <?php endif; ?>
                                <p class="mb-0">
                                    Apakah anda akan tetap menghapus data aset <strong><?= $ia['nama_sarana']; ?></strong> yang berada di <strong><?= $ia['nama_gedung']; ?></strong>, Ruangan <strong><?= $ia['nama_ruang']; ?></strong>, pada Unit <strong><?= $ia['nama_unit']; ?></strong> Sub Unit <strong><?= $ia['nama_sub_unit']; ?></strong> ?
                                </p>
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

<!-- Modal Detail -->
<?php foreach ($input_aset as $ia) : ?>
    <div class="modal fade" id="detail_aset<?= $ia['id_input_aset']; ?>">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detail Aset</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <strong>Aset <?= $ia['nama_sarana']; ?></strong>
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Label Aset</label>
                                        <input type="text" class="form-control" value="<?= $ia['label_aset']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Lokasi Gedung dan Ruang</label>
                                        <input type="text" class="form-control" value="<?= $ia['nama_gedung']; ?> | Ruangan <?= $ia['nama_ruang']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Lokasi Unit dan Sub Unit</label>
                                        <input type="text" class="form-control" value="Unit <?= $ia['nama_unit']; ?> | <?= $ia['nama_sub_unit']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jenis Aset</label>
                                        <input type="text" class="form-control" value="<?= $ia['nama_kelompok']; ?> | <?= $ia['jenis_aset']; ?> | Umur <?= $ia['umur_aset']; ?> Tahun" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Status Kepemilikan</label>
                                        <input type="text" class="form-control" value="<?= $ia['status_kepemilikan']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Penanggung Jawab</label>
                                        <input type="text" class="form-control" value="<?= $ia['nama']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Jumlah Aset</label>
                                        <input type="text" class="form-control" value="<?= $ia['jumlah_aset']; ?> <?= $ia['satuan_aset']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Tahun Pengadaan</label>
                                        <input type="text" class="form-control" value="<?= $ia['tahun_pengadaan']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Harga Perolehan</label>
                                        <input type="text" class="form-control" value="<?= buatRupiah($ia['harga_perolehan']); ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Total Perolehan</label>
                                        <input type="text" class="form-control" value="<?= buatRupiah($ia['total_perolehan']); ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <?php
                                $tahun_berjalan = date('Y');
                                $susut_pertahun = $ia['harga_perolehan'] / $ia['umur_aset'];
                                $harga_tahun_berjalan = $ia['harga_perolehan'] - (($tahun_berjalan - $ia['tahun_pengadaan']) * $susut_pertahun);
                                $harga_total_aset = $harga_tahun_berjalan * $ia['jumlah_aset'];
                                ?>
                                <div class="col-md-12">
                                    <span class="text-navy">
                                        <h5><strong>Perhitungan Penyusutan Aset</strong></h5>
                                    </span>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Tahun Berjalan</label>
                                        <input type="text" class="form-control" value="<?= $tahun_berjalan; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Jumlah Aset</label>
                                        <input type="text" class="form-control" value="<?= $ia['jumlah_aset']; ?> <?= $ia['satuan_aset']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Penyusutan Aset Per Tahun</label>
                                        <input type="text" class="form-control" value="<?= buatRupiah($susut_pertahun); ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Harga Aset Per Tahun</label>
                                        <input type="text" class="form-control" value="<?= buatRupiah($harga_tahun_berjalan); ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-black">
                                            <strong>Harga Total Aset Tahun Berjalan</strong>
                                        </label>
                                        <input type="text" class="form-control" value="<?= buatRupiah($harga_total_aset); ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-black">
                                            <strong>Terbilang</strong>
                                        </label>
                                        <p><em><?= terbilang($harga_total_aset); ?> Rupiah.</em></p>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer row">
                    <div class="col-auto mr-auto">
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Keluar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal NonAktif -->
<?php foreach ($input_aset as $ia) : ?>
    <div id="nonaktif_aset<?= $ia['id_input_aset']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="nonaktif_asetTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="nonaktif_asetTitle">Nonaktif Aset</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="<?= base_url('adminaset/nonaktif_aset/') . $ia['id_input_aset']; ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" value="<?= $ia['id_input_aset']; ?>">
                        <input type="hidden" name="pic_id_edit" id="pic_id_edit" value="<?= $ia['pic_id']; ?>">
                        <div class="col-md-12">
                            <div class="alert alert-danger" role="alert">
                                <h4 class="alert-heading">Peringatan!!!</h4>
                                <p class="mb-0">
                                Apakah anda akan menonaktifkan aset <strong><?= $ia['nama_sarana']; ?></strong> yang berada di <strong><?= $ia['nama_gedung']; ?></strong>, Ruangan <strong><?= $ia['nama_ruang']; ?></strong>, pada Unit <strong><?= $ia['nama_unit']; ?></strong> Sub Unit <strong><?= $ia['nama_sub_unit']; ?></strong> ?
                                </p>
                                <hr>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn  btn-secondary" data-dismiss="modal">Keluar</button>
                        <button type="submit" class="btn  btn-danger">Non Aktif</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>